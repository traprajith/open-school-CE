<?php
/**
* Rights authorization item controller class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @since 0.5
*/
class AuthItemController extends RController
{
	/**
	* @property RAuthorizer
	*/
	private $_authorizer;
	/**
	* @property CAuthItem the currently loaded data model instance.
	*/
	private $_model;

	/**
	* Initializes the controller.
	*/
	public function init()
	{
		$this->_authorizer = $this->module->getAuthorizer();
		$this->layout = $this->module->layout;
		$this->defaultAction = 'permissions';

		// Register the scripts
		$this->module->registerScripts();
	}

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl'
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // Allow superusers to access Rights
				'actions'=>array(
					'permissions',
					'operations',
					'tasks',
					'roles',
					'generate',
					'create',
					'update',
					'delete',
					'removeChild',
					'assign',
					'revoke',
					'sortable',
					'assignRole',
					'manageRoles',
					'editRole',
					'deleteRole',
				),
				'users'=>$this->_authorizer->getSuperusers(),
			),
			array('deny', // Deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	* Displays the permission overview.
	*/
	public function actionPermissions()
	{
		$dataProvider = new RPermissionDataProvider('permissions');

		// Get the roles from the data provider
		$roles = $dataProvider->getRoles();
		$roleColumnWidth = $roles!==array() ? 75/count($roles) : 0;

		// Initialize the columns
		$columns = array(
			array(
    			'name'=>'description',
	    		'header'=>Rights::t('core', 'Item'),
				'type'=>'raw',
    			'htmlOptions'=>array(
    				'class'=>'permission-column',
    				'style'=>'width:25%',
	    		),
    		),
		);

		// Add a column for each role
    	foreach( $roles as $roleName=>$role )
    	{
    		$columns[] = array(
				'name'=>strtolower($roleName),
    			'header'=>$role->getNameText(),
    			'type'=>'raw',
    			'htmlOptions'=>array(
    				'class'=>'role-column',
    				'style'=>'width:'.$roleColumnWidth.'%',
    			),
    		);
		}

		$view = 'permissions';
		$params = array(
			'dataProvider'=>$dataProvider,
			'columns'=>$columns,
		);

		// Render the view
		isset($_POST['ajax'])===true ? $this->renderPartial($view, $params) : $this->render($view, $params);
	}

	/**
	* Displays the operation management page.
	*/
	public function actionOperations()
	{
		Yii::app()->user->rightsReturnUrl = array('authItem/operations');
		
		$dataProvider = new RAuthItemDataProvider('operations', array(
			'type'=>CAuthItem::TYPE_OPERATION,
			'sortable'=>array(
				'id'=>'RightsOperationTableSort',
				'element'=>'.operation-table',
				'url'=>$this->createUrl('authItem/sortable'),
			),
		));

		// Render the view
		$this->render('operations', array(
			'dataProvider'=>$dataProvider,
			'isBizRuleEnabled'=>$this->module->enableBizRule,
			'isBizRuleDataEnabled'=>$this->module->enableBizRuleData,
		));
	}

	/**
	* Displays the operation management page.
	*/
	public function actionTasks()
	{
		Yii::app()->user->rightsReturnUrl = array('authItem/tasks');
		
		$dataProvider = new RAuthItemDataProvider('tasks', array(
			'type'=>CAuthItem::TYPE_TASK,
			'sortable'=>array(
				'id'=>'RightsTaskTableSort',
				'element'=>'.task-table',
				'url'=>$this->createUrl('authItem/sortable'),
			),
		));

		// Render the view
		$this->render('tasks', array(
			'dataProvider'=>$dataProvider,
			'isBizRuleEnabled'=>$this->module->enableBizRule,
			'isBizRuleDataEnabled'=>$this->module->enableBizRuleData,
		));
	}

	/**
	* Displays the role management page.
	*/
	public function actionRoles()
	{
		Yii::app()->user->rightsReturnUrl = array('authItem/roles');
		
		$dataProvider = new RAuthItemDataProvider('roles', array(
			'type'=>CAuthItem::TYPE_ROLE,
			'sortable'=>array(
				'id'=>'RightsRoleTableSort',
				'element'=>'.role-table',
				'url'=>$this->createUrl('authItem/sortable'),
			),
		));

		// Render the view
		$this->render('roles', array(
			'dataProvider'=>$dataProvider,
			'isBizRuleEnabled'=>$this->module->enableBizRule,
			'isBizRuleDataEnabled'=>$this->module->enableBizRuleData,
		));
	}

	/**
	* Displays the generator page.
	*/
	public function actionGenerate()
	{
		// Get the generator and authorizer
		$generator = $this->module->getGenerator();

		// Createh the form model
		$model = new GenerateForm();

		// Form has been submitted
		if( isset($_POST['GenerateForm'])===true )
		{
			// Form is valid
			$model->attributes = $_POST['GenerateForm'];
			if( $model->validate()===true )
			{
				$items = array(
					'tasks'=>array(),
					'operations'=>array(),
				);

				// Get the chosen items
				foreach( $model->items as $itemname=>$value )
				{
					if( (bool)$value===true )
					{
						if( strpos($itemname, '*')!==false )
							$items['tasks'][] = $itemname;
						else
							$items['operations'][] = $itemname;
					}
				}

				// Add the items to the generator as tasks and operations and run the generator.
				$generator->addItems($items['tasks'], CAuthItem::TYPE_TASK);
				$generator->addItems($items['operations'], CAuthItem::TYPE_OPERATION);
				if( ($generatedItems = $generator->run())!==false && $generatedItems!==array() )
				{
					/*Yii::app()->getUser()->setFlash($this->module->flashSuccessKey,
						Rights::t('core', 'Authorization items created.')*/
						Yii::app()->getUser()->setFlash($this->module->flashSuccessKey,
						Yii::t('app', 'Authorization items created.')
					);
					$this->redirect(array('authItem/permissions'));
				}
			}
		}

		// Get all items that are available to be generated
		$items = $generator->getControllerActions();

		// We need the existing operations for comparason
		$authItems = $this->_authorizer->getAuthItems(array(
			CAuthItem::TYPE_TASK,
			CAuthItem::TYPE_OPERATION,
		));
		$existingItems = array();
		foreach( $authItems as $itemName=>$item )
			$existingItems[ $itemName ] = $itemName;

		Yii::app()->clientScript->registerScript('rightsGenerateItemTableSelectRows',
			"jQuery('.generate-item-table').rightsSelectRows();"
		);

		// Render the view
		$this->render('generate', array(
			'model'=>$model,
			'items'=>$items,
			'existingItems'=>$existingItems,
		));
	}

	/**
	* Creates an authorization item.
	* @todo add type validation.
	*/
	public function actionCreate()
	{
		$type = $this->getType();
		
		// Create the authorization item form
		$formModel = new AuthItemForm('create');

		if( isset($_POST['AuthItemForm'])===true )
		{
			$formModel->attributes = $_POST['AuthItemForm'];
			if( $formModel->validate()===true )
			{
				// Create the item
				$item = $this->_authorizer->createAuthItem($formModel->name, $type, $formModel->description, $formModel->bizRule, $formModel->data);
				$item = $this->_authorizer->attachAuthItemBehavior($item);

				// Set a flash message for creating the item
				/*Yii::app()->user->setFlash($this->module->flashSuccessKey,
					Rights::t('core', ':name created.', array(':name'=>$item->getNameText()))
				);*/
				Yii::app()->user->setFlash($this->module->flashSuccessKey,
					Yii::t('app', ':name created.', array(':name'=>$item->getNameText()))
				);

				// Redirect to the correct destination
				$this->redirect(Yii::app()->user->getRightsReturnUrl(array('authItem/permissions')));
			}
		}

		// Render the view
		$this->render('create', array(
			'formModel'=>$formModel,
		));
	}

	/**
	* Updates an authorization item.
	*/
	public function actionUpdate()
	{
		// Get the authorization item
		$model = $this->loadModel();
		$itemName = $model->getName();
		
		// Create the authorization item form
		$formModel = new AuthItemForm('update');

		if( isset($_POST['AuthItemForm'])===true )
		{
			$formModel->attributes = $_POST['AuthItemForm'];
			if( $formModel->validate()===true )
			{
				// Update the item and load it
				$this->_authorizer->updateAuthItem($itemName, $formModel->name, $formModel->description, $formModel->bizRule, $formModel->data);
				$item = $this->_authorizer->authManager->getAuthItem($formModel->name);
				$item = $this->_authorizer->attachAuthItemBehavior($item);

				// Set a flash message for updating the item
				/*Yii::app()->user->setFlash($this->module->flashSuccessKey,
					Rights::t('core', ':name updated.', array(':name'=>$item->getNameText()))
				);*/
				Yii::app()->user->setFlash($this->module->flashSuccessKey,
					Yii::t('app', ':name updated.', array(':name'=>$item->getNameText()))
				);

				// Redirect to the correct destination
				$this->redirect(Yii::app()->user->getRightsReturnUrl(array('authItem/permissions')));
			}
		}
		
		$type = Rights::getValidChildTypes($model->type);
		$exclude = array($this->module->superuserName);
		$childSelectOptions = Rights::getParentAuthItemSelectOptions($model, $type, $exclude);
		
		if( $childSelectOptions!==array() )
		{
			$childFormModel = new AuthChildForm();
		
			// Child form is submitted and data is valid
			if( isset($_POST['AuthChildForm'])===true )
			{
				$childFormModel->attributes = $_POST['AuthChildForm'];
				if( $childFormModel->validate()===true )
				{
					// Add the child and load it
					$this->_authorizer->authManager->addItemChild($itemName, $childFormModel->itemname);
					$child = $this->_authorizer->authManager->getAuthItem($childFormModel->itemname);
					$child = $this->_authorizer->attachAuthItemBehavior($child);

					// Set a flash message for adding the child
					/*Yii::app()->user->setFlash($this->module->flashSuccessKey,
						Rights::t('core', 'Child :name added.', array(':name'=>$child->getNameText()))
					);*/
					Yii::app()->user->setFlash($this->module->flashSuccessKey,
						Yii::t('app', 'Child :name added.', array(':name'=>$child->getNameText()))
					);

					// Reidrect to the same page
					$this->redirect(array('authItem/update', 'name'=>urlencode($itemName)));
				}
			}
		}
		else
		{
			$childFormModel = null;
		}

		// Set the values for the form fields
		$formModel->name = $model->name;
		$formModel->description = $model->description;
		$formModel->type = $model->type;
		$formModel->bizRule = $model->bizRule!=='NULL' ? $model->bizRule : '';
		$formModel->data = $model->data!==null ? serialize($model->data) : '';

		$parentDataProvider = new RAuthItemParentDataProvider($model);
		$childDataProvider = new RAuthItemChildDataProvider($model);

		// Render the view
		$this->render('update', array(
			'model'=>$model,
			'formModel'=>$formModel,
			'childFormModel'=>$childFormModel,
			'childSelectOptions'=>$childSelectOptions,
			'parentDataProvider'=>$parentDataProvider,
			'childDataProvider'=>$childDataProvider,
		));
	}

	/**
	 * Deletes an operation.
	 */
	public function actionDelete()
	{
		// We only allow deletion via POST request
		if( Yii::app()->request->isPostRequest===true )
		{
			$itemName = $this->getItemName();
			
			// Load the item and save the name for later use
			$item = $this->_authorizer->authManager->getAuthItem($itemName);
			$item = $this->_authorizer->attachAuthItemBehavior($item);

			// Delete the item
			$this->_authorizer->authManager->removeAuthItem($itemName);

			// Set a flash message for deleting the item
			/*Yii::app()->user->setFlash($this->module->flashSuccessKey,
				Rights::t('core', ':name deleted.', array(':name'=>$item->getNameText()))
			);*/
			Yii::app()->user->setFlash($this->module->flashSuccessKey,
				Yii::t('app', ':name deleted.', array(':name'=>$item->getNameText()))
			);

			// If AJAX request, we should not redirect the browser
			if( isset($_POST['ajax'])===false )
				$this->redirect(Yii::app()->user->getRightsReturnUrl(array('authItem/permissions')));
		}
		else
		{
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
		}
	}

	/**
	* Removes a child from an authorization item.
	*/
	public function actionRemoveChild()
	{
		// We only allow deletion via POST request
		if( Yii::app()->request->isPostRequest===true )
		{
			$itemName = $this->getItemName();
			$childName = $this->getChildName();
			
			// Remove the child and load it
			$this->_authorizer->authManager->removeItemChild($itemName, $childName);
			$child = $this->_authorizer->authManager->getAuthItem($childName);
			$child = $this->_authorizer->attachAuthItemBehavior($child);

			// Set a flash message for removing the child
			/*Yii::app()->user->setFlash($this->module->flashSuccessKey,
				Rights::t('core', 'Child :name removed.', array(':name'=>$child->getNameText()))
			);*/
			Yii::app()->user->setFlash($this->module->flashSuccessKey,
				Yii::t('app', 'Child :name removed.', array(':name'=>$child->getNameText()))
			);

			// If AJAX request, we should not redirect the browser
			if( isset($_POST['ajax'])===false )
				$this->redirect(array('authItem/update', 'name'=>urlencode($itemName)));
		}
		else
		{
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
		}
	}

	/**
	* Adds a child to an authorization item.
	*/
	public function actionAssign()
	{
		// We only allow deletion via POST request
		if( Yii::app()->request->isPostRequest===true )
		{
			$model = $this->loadModel();
			$childName = $this->getChildName();
			
			if( $childName!==null && $model->hasChild($childName)===false )
				$model->addChild($childName);

			// if AJAX request, we should not redirect the browser
			if( isset($_POST['ajax'])===false )
				$this->redirect(array('authItem/permissions'));
		}
		else
		{
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
		}
	}

	/**
	* Removes a child from an authorization item.
	*/
	public function actionRevoke()
	{
		// We only allow deletion via POST request
		if( Yii::app()->request->isPostRequest===true )
		{
			$model = $this->loadModel();
			$childName = $this->getChildName();
			if( $childName!==null && $model->hasChild($childName)===true )
				$model->removeChild($childName);

			// if AJAX request, we should not redirect the browser
			if( isset($_POST['ajax'])===false )
				$this->redirect(array('authItem/permissions'));
		}
		else
		{
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
		}
	}

	/**
	* Processes the jui sortable.
	*/
	public function actionSortable()
	{
		// We only allow sorting via POST request
		if( Yii::app()->request->isPostRequest===true )
		{
			$this->_authorizer->authManager->updateItemWeight($_POST['result']);
		}
		else
		{
			throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
		}
	}
	
	/**
	* @return string the item name or null if not set.
	*/
	public function getItemName()
	{
		return isset($_GET['name'])===true ? urldecode($_GET['name']) : null;
	}
	
	/**
	* @return string the child name or null if not set.
	*/
	public function getChildName()
	{
		return isset($_GET['child'])===true ? urldecode($_GET['child']) : null;
	}
	
	/**
	 * Returns the authorization item type after validation.
	 * @return int the type.
	 */
	public function getType()
	{
		$type = $_GET['type'];
		$validTypes = array(CAuthItem::TYPE_OPERATION, CAuthItem::TYPE_TASK, CAuthItem::TYPE_ROLE);
		if( in_array($type, $validTypes)===true )
			return $type;
		else
			throw new CException(Yii::t('app', 'Invalid authorization item type.'));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	*/
	public function loadModel()
	{
		if( $this->_model===null )
		{
			$itemName = $this->getItemName();
			
			if( $itemName!==null )
			{
				$this->_model = $this->_authorizer->authManager->getAuthItem($itemName);
				$this->_model = $this->_authorizer->attachAuthItemBehavior($this->_model);
			}

			if( $this->_model===null )
				throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
		}

		return $this->_model;
	}
	public function actionAssignRole()
	{
		$this->layout = 'rights.views.layouts.main_config';
		$model=new UserRoles;
		                    //Default
							$controller['default'] = array("Mailbox.Ajax","Mailbox.Message","Mailbox.News","Dashboard.Default","Dashboard.Index", 'Hr.MyPayslip','Hr.Leaves', 'Hr.Salary');
							//Home
							$controller[1] = array("Cal.Cron","Cal.EventsType","Cal.Main","ActivityFeed","Complaints");
							//Students
							$controller[2] = array("Students.Achievements","Students.Default","Students.Guardians","Students.Savedsearches","Students.StudentAdditionalFields",
  "Students.StudentAttentance","Students.StudentCategories","Students.StudentCategory","Students.StudentDocument","Students.StudentLeave","Students.StudentPreviousDatas","Students.Students","Students.LogCategory","Students.Logcomment","Onlineadmission.Admin","Onlineadmission.Default","Onlineadmission.Registration","Onlineadmission.WaitinglistStudents","Savedsearches");
							//Employees
							$controller[3] = array("Employees.Achievements","Employees.Leaves","EmployeeElectives","Employees.Default","Employees.EmployeeAttendances","Employees.EmployeeCategories","Employees.EmployeeDepartments","Employees.EmployeeElectiveSubjects","Employees.EmployeeGrades","Employees.EmployeeLeaveTypes","Employees.EmployeePositions","Employees.Employees","Employees.EmployeesSubjects","Employees.LogCategory","Employees.Logcomment","Employees.Savedsearches","Employees.EmployeeDocument","Employees.TeacherSubjectAttendance");
							//Courses
							$controller[4] = array("Courses","Courses.Batches","Courses.ClassTiming","Courses.ClassTimings","Courses.Courses","Courses.Default","Courses.Defaultsubjects","Courses.ElectiveExams","Courses.ElectiveGroups","Courses.Electives","Courses.ElectiveScores","Courses.Exam","Courses.ExamGroups","Courses.Exams","Courses.ExamScores","Courses.GradingLevels","Courses.StudentAttentance","Courses.StudentElectives","Courses.Subject","Courses.SubjectName","Courses.SubjectsCommonPool","Courses.SubjectNameAjax","Courses.Subjects","Courses.TimetableEntries","Courses.Weekdays");
							//Examination
							$controller[5] = array("Examination.Default","Examination.ElectiveGroups","Examination.Exam","Examination.ElectiveExams","Examination.ExamGroups","Examination.ElectiveScores","Examination.Exams","Examination.ExamScores","Examination.GradingLevels","Examination.Result");
							//Attendance
							$controller[6] = array("Attendance.Default","Attendance.EmployeeAttendances","Attendance.EmployeeLeaveTypes","Attendance.StudentAttentance","Attendance.SubjectAttendance","Attendances");
							//Timetable
							$controller[7] = array("Timetable.ClassTiming","Timetable.Default","Timetable.TeachersTimetable","Timetable.TimetableEntries","Timetable.view","Timetable.Weekdays");
							//Fees
							$controller[8] = array("Fees.Create","Fees.Dashboard","Fees.Invoices","Fees.Subscriptions","Fees.View","Fees.Gateways","Fees.PaymentTypes","Fees.Paypal","Fees.Remove","Fees.Taxes","Fees.Transactions");
							//Report
							$controller[9] = array("Report.Default","Report.Notification","Reports");
							//Settings
							$controller[10] = array("Configurations","AcademicYears","AttendanceSettings","CommonClassTimings","NotificationSettings","PreviousYearSettings","SmsCount","SmsSettings","StudentDocumentList","OnlineRegisterSettings","Themes","UserSettings","Holidays.Cron","Holidays.Main","Translate.Edit","Translate.Generate","Translate.Translate");
							//Hostel
							$controller[11] = array("Hostel.Allotment","Hostel.Default","Hostel.Floor","Hostel.FoodInfo","Hostel.Hosteldetails","Hostel.MessFee","Hostel.MessManage","Hostel.Registration","Hostel.Room","Hostel.RoomDetails","Hostel.Roomrequest","Hostel.Settings","Hostel.Vacate");
							//Transport
							$controller[12] = array("Transport.BusLog","Transport.Default","Transport.DriverDetails","Transport.FuelConsumption","Transport.RouteDetails","Transport.StopDetails","Transport.Transportation","Transport.VehicleDetails","Transport.Devices");
							//Library
							$controller[13] = array("Library.Authors","Library.Book","Library.BookFine","Library.BorrowBook","Library.Category","Library.Default","Library.Publication","Library.ReturnBook","Library.Settings");
							//Downloads
							$controller[14] = array("Downloads.Default","Downloads.FileCategory","Downloads.FileUploads","Downloads.Students","Downloads.Teachers");
							//Import
							$controller[15] = array("Importcsv.Default","Importcsv.Users");
							//Export
							$controller[16] = array("Export.Default");
							//Notifications
							$controller[18] = array("Notifications.Default","EmailTemplates","Sms.ContactGroup","Sms.Contactgroups","Sms.Contacts","Sms.Default","Sms.Send","Sms.Systemtemplates","Sms.Templates","SmsSettings");
							
							//Purchase
							$controller[21] = array("Purchase.MaterialRequistion", "Purchase.Sale");
							//HR
							$controller[22] = array("Hr.Default","Hr.MyPayslip","Hr.LeaveRequests","Hr.Leaves", "Hr.Staff", "Hr.LeaveTypes", "Hr.Payslip", "Hr.Salary");
		
		if(isset($_GET['id']) and $_GET['id']!=NULL)
		{
			   $time_setting = UserSettings::model()->findByPk(1);	
			   $roles=Rights::getAssignedRoles($_GET['id']);
			   if(sizeof($roles)==0)
			   {
				  $role=new RoleForm;
		  
				  
				  if(isset($_POST['RoleForm']))
				  {
					  $role->attributes=$_POST['RoleForm'];
					  if($role->validate())
					  {
						  //Assign Role
						  $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
                          $authorizer->authManager->assign($role->name, $_GET['id']);
						  
                          $user_time = new UserSettings;
						  $user_time->user_id = $_GET['id'];
						  $user_time->dateformat 	= $time_setting->dateformat;
						  $user_time->displaydate 	= $time_setting->displaydate;
						  $user_time->timezone 		= $time_setting->timezone;
						  $user_time->timeformat 	= $time_setting->timeformat;
						  $user_time->name_format 	= $time_setting->name_format;
						  $user_time->language 		= $time_setting->language;
						  $user_time->save();
						  
								
						  
						  $this->redirect(array('assignment/user','id'=>$_GET['id']));
					  }
				  }
				  if(isset($_POST['UserRoles']))
				  {
					  $model->attributes=$_POST['UserRoles'];
					  if($model->save())
					  {
						  //Create New Role and assign items
						  $this->_authorizer->createAuthItem($model->name, 2, $model->description, '', '');
						  
						  $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
                          $authorizer->authManager->assign($model->name, $_GET['id']); 
						  
						  foreach($model->modules as $module)
						  {
							  
							  $ModuleAccess = new ModuleAccess;
							  $ModuleAccess->role_id = $model->id;
							  $ModuleAccess->module_id = $module;
							  $ModuleAccess->save(); //Module Access Saved
							  
							  //Entry In rights
							  
							  foreach($controller[$module] as $itemname)
							  {
								  $this->_authorizer->authManager->addItemChild($model->name, $itemname.'.*');
							  }
							  
						  }
						  //default
						  
						  $this->_authorizer->authManager->addItemChild($model->name, 'Configurations.DisplaySavedImage');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Configurations.DisplayLogoImage');
						  $this->_authorizer->authManager->addItemChild($model->name, 'AcademicYears.*');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.New');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Inbox');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Sent');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Trash');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Reply');
						  $this->_authorizer->authManager->addItemChild($model->name, 'News.*');
						  
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Close');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Create');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Delete');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Display');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Feedback');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Feedbacklist');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Reopen');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Update');
						  
						  						  
						  foreach($controller['default'] as $itemname)
						  {
								$this->_authorizer->authManager->addItemChild($model->name, $itemname.'.*');
						  }
						  
						  $user_time = new UserSettings;
						  $user_time->user_id = $_GET['id'];
						  $user_time->dateformat 	= $time_setting->dateformat;
						  $user_time->displaydate 	= $time_setting->displaydate;
						  $user_time->timezone 		= $time_setting->timezone;
						  $user_time->timeformat 	= $time_setting->timeformat;
						  $user_time->name_format 	= $time_setting->name_format;
						  $user_time->language 		= $time_setting->language;
						  $user_time->save();
						  
						  
						  $this->redirect(array('assignment/user','id'=>$_GET['id']));
					  }
				  }
			  }
			  else
			  {
				  $this->redirect(array('assignment/user','id'=>$_GET['id']));
			  }
		}
		else
		{
			if(isset($_POST['UserRoles']))
			{
				$model->attributes=$_POST['UserRoles'];
				if($model->save())
				{
					$this->_authorizer->createAuthItem($model->name, 2, $model->description, '', '');
					      foreach($model->modules as $module)
						  {
							  
							  $ModuleAccess = new ModuleAccess;
							  $ModuleAccess->role_id = $model->id;
							  $ModuleAccess->module_id = $module;
							  $ModuleAccess->save(); //Module Access Saved
							  
							  //Entry In rights
							  
							  foreach($controller[$module] as $itemname)
							  {
								  $this->_authorizer->authManager->addItemChild($model->name, $itemname.'.*');
							  }
							  
						  }
						  //default
						  
						  $this->_authorizer->authManager->addItemChild($model->name, 'Configurations.DisplaySavedImage');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Configurations.DisplayLogoImage');
						  $this->_authorizer->authManager->addItemChild($model->name, 'AcademicYears.*');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.New');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Inbox');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Sent');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Trash');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Mailbox.Message.Reply');
						  $this->_authorizer->authManager->addItemChild($model->name, 'News.*');
						  
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Close');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Create');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Delete');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Display');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Feedback');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Feedbacklist');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Reopen');
						  $this->_authorizer->authManager->addItemChild($model->name, 'Complaints.Update');
						  

						  foreach($controller['default'] as $itemname)
						  {
								$this->_authorizer->authManager->addItemChild($model->name, $itemname.'.*');
						  }
						  
					      	$this->redirect(array('/rights/authItem/manageroles'));
						 
				}
			}
		}
		$this->render('assignRole', array(
			'model'=>$model,'role'=>$role,
		));
		
	}
	
	public function actionManageRoles(){
		$this->layout = 'rights.views.layouts.main_config';
		
		$criteria = new CDbCriteria;
		$criteria->condition = "id !=:x";
		$criteria->params = array(':x'=>1);
		
		$total = UserRoles::model()->count($criteria);
		$pages = new CPagination($total);
        $pages->setPageSize(Yii::app()->params['listPerPage']);
        $pages->applyLimit($criteria);  // the trick is here!
		
		$posts = UserRoles::model()->findAll($criteria);
		$this->render('managerole', array(
			'posts'=>$posts,
			'pages' => $pages,
			'item_count'=>$total,
			'page_size'=>Yii::app()->params['listPerPage'],
		));
	}
	
	public function actionEditrole($rid){
		
		$this->layout = 'rights.views.layouts.main_config';
		$model_old= UserRoles::model()->findByAttributes(array('id'=>$rid));
		$auth_assignments = AuthAssignment::model()->findAllByAttributes(array('itemname'=>$model_old->name));
		
		//Saving user ids for inserting later
		$user_ids = array();
		foreach($auth_assignments as $auth_assignment){
			$user_ids[] = $auth_assignment->userid;
		}
		
		$modules_access = ModuleAccess::model()->findAllByAttributes(array('role_id'=>$model_old->id));
		
		//Saving module list for inserting later
		$modules = array();
		foreach($modules_access as $module_access){
			$modules[] = $module_access->module_id;			
		}
				
		if(isset($_POST['UserRoles']) and $_POST['UserRoles']!=NULL){
			
			if($_POST['UserRoles']['name'] != $model_old->name or $_POST['UserRoles']['description'] != $model_old->description or $_POST['UserRoles']['modules'] != NULL){
				
				//Updating details in User Roles Table
				
				$user_role = UserRoles::model()->findByAttributes(array('id'=>$_POST['UserRoles']['id']));
				$user_role->saveAttributes(array('name'=>$_POST['UserRoles']['name'],'description'=>$_POST['UserRoles']['description']));
				
				/* Start deleting existing data from related tables */
				
					/* Deleting Role */
					
					$itemName = $model_old->name;
				
					// Load the item and save the name for later use
					$item = $this->_authorizer->authManager->getAuthItem($itemName);
					$item = $this->_authorizer->attachAuthItemBehavior($item);
		
					// Delete the item
					$this->_authorizer->authManager->removeAuthItem($itemName);
					
					/* End deleting Role */
					
					/* Revoke users */
					
					Yii::app()->runController('/rights/assignment/revokemultiple/rname/'.$model_old->name);
					
					/* End revoke users */
					
					/* Deleting Module access */
						
						foreach($modules_access as $module_access){
							$module_access->delete();
						}
						
					/* End deleting module access*/
				
				/* End deletion process */
				
				/* Start inserting new values */
				
					//Default
							$controller['default'] = array("Mailbox.Ajax","Mailbox.Message","Mailbox.News","Dashboard.Default","Dashboard.Index", "Hr.MyPayslip","Hr.Leaves", "Hr.Salary");
							//Home
							$controller[1] = array("Cal.Cron","Cal.EventsType","Cal.Main","ActivityFeed","Complaints");
							//Students
							$controller[2] = array("Students.Achievements","Students.Default","Students.Guardians","Students.Savedsearches","Students.StudentAdditionalFields",
  "Students.StudentAttentance","Students.StudentCategories","Students.StudentCategory","Students.StudentDocument","Students.StudentLeave","Students.StudentPreviousDatas","Students.Students","Students.LogCategory","Students.Logcomment","Onlineadmission.Admin","Onlineadmission.Default","Onlineadmission.Registration","Onlineadmission.WaitinglistStudents","Savedsearches");
							//Employees
							$controller[3] = array("Employees.Achievements","Employees.Leaves","EmployeeElectives","Employees.Default","Employees.EmployeeAttendances","Employees.EmployeeCategories","Employees.EmployeeDepartments","Employees.EmployeeElectiveSubjects","Employees.EmployeeGrades","Employees.EmployeeLeaveTypes","Employees.EmployeePositions","Employees.Employees","Employees.EmployeesSubjects","Employees.LogCategory","Employees.Logcomment","Employees.Savedsearches","Employees.EmployeeDocument","Employees.TeacherSubjectAttendance");
							//Courses
							$controller[4] = array("Courses","Courses.Batches","Courses.ClassTiming","Courses.ClassTimings","Courses.Courses","Courses.Default","Courses.Defaultsubjects","Courses.ElectiveExams","Courses.ElectiveGroups","Courses.Electives","Courses.ElectiveScores","Courses.Exam","Courses.ExamGroups","Courses.Exams","Courses.ExamScores","Courses.GradingLevels","Courses.StudentAttentance","Courses.StudentElectives","Courses.Subject","Courses.SubjectName","Courses.SubjectsCommonPool","Courses.SubjectNameAjax","Courses.Subjects","Courses.TimetableEntries","Courses.Weekdays");
							//Examination
							$controller[5] = array("Examination.Default","Examination.ElectiveGroups","Examination.Exam","Examination.ElectiveExams","Examination.ExamGroups","Examination.ElectiveScores","Examination.Exams","Examination.ExamScores","Examination.GradingLevels","Examination.Result");
							//Attendance
							$controller[6] = array("Attendance.Default","Attendance.EmployeeAttendances","Attendance.EmployeeLeaveTypes","Attendance.StudentAttentance","Attendance.SubjectAttendance","Attendances");
							//Timetable
							$controller[7] = array("Timetable.ClassTiming","Timetable.Default","Timetable.TeachersTimetable","Timetable.TimetableEntries","Timetable.view","Timetable.Weekdays");
							//Fees
							$controller[8] = array("Fees.Create","Fees.Dashboard","Fees.Invoices","Fees.Subscriptions","Fees.View","Fees.Gateways","Fees.PaymentTypes","Fees.Paypal","Fees.Remove","Fees.Taxes","Fees.Transactions");
							//Report
							$controller[9] = array("Report.Default","Report.Notification","Reports");
							//Settings
							$controller[10] = array("Configurations","AcademicYears","AttendanceSettings","CommonClassTimings","NotificationSettings","PreviousYearSettings","SmsCount","SmsSettings","StudentDocumentList","OnlineRegisterSettings","Themes","UserSettings","Holidays.Cron","Holidays.Main","Translate.Edit","Translate.Generate","Translate.Translate");
							//Hostel
							$controller[11] = array("Hostel.Allotment","Hostel.Default","Hostel.Floor","Hostel.FoodInfo","Hostel.Hosteldetails","Hostel.MessFee","Hostel.MessManage","Hostel.Registration","Hostel.Room","Hostel.RoomDetails","Hostel.Roomrequest","Hostel.Settings","Hostel.Vacate");
							//Transport
							$controller[12] = array("Transport.BusLog","Transport.Default","Transport.DriverDetails","Transport.FuelConsumption","Transport.RouteDetails","Transport.StopDetails","Transport.Transportation","Transport.VehicleDetails","Transport.Devices");
							//Library
							$controller[13] = array("Library.Authors","Library.Book","Library.BookFine","Library.BorrowBook","Library.Category","Library.Default","Library.Publication","Library.ReturnBook","Library.Settings");
							//Downloads
							$controller[14] = array("Downloads.Default","Downloads.FileCategory","Downloads.FileUploads","Downloads.Students","Downloads.Teachers");
							//Import
							$controller[15] = array("Importcsv.Default","Importcsv.Users");
							//Export
							$controller[16] = array("Export.Default");
							//Notifications
							$controller[18] = array("Notifications.Default","EmailTemplates","Sms.ContactGroup","Sms.Contactgroups","Sms.Contacts","Sms.Default","Sms.Send","Sms.Systemtemplates","Sms.Templates","SmsSettings");
							
							//Purchase
							$controller[21] = array("Purchase.MaterialRequistion", "Purchase.Sale");
							//HR
							$controller[22] = array("Hr.Default","Hr.MyPayslip","Hr.LeaveRequests","Hr.Leaves", "Hr.Staff", "Hr.LeaveTypes", "Hr.Payslip", "Hr.Salary");
					
						  
						  $this->_authorizer->createAuthItem($user_role->name, 2, $user_role->description, '', '');
						  
						  foreach($user_ids as $user_id){
						   	$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
                          	$authorizer->authManager->assign($user_role->name, $user_id);
						  }
							
						  $modules = $_POST['UserRoles']['modules'];
						  	
						  foreach($modules as $module)
						  {
							  
							  $ModuleAccess = new ModuleAccess;
							  $ModuleAccess->role_id = $user_role->id;
							  $ModuleAccess->module_id = $module;
							  $ModuleAccess->save(); //Module Access Saved
							  
							  //Entry In rights
							  
							  foreach($controller[$module] as $itemname)
							  {
								  $this->_authorizer->authManager->addItemChild($user_role->name, $itemname.'.*');
							  }
							  
						  }
						  //default
						  
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Configurations.DisplaySavedImage');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Configurations.DisplayLogoImage');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'AcademicYears.*');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Mailbox.Message.New');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Mailbox.Message.Inbox');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Mailbox.Message.Sent');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Mailbox.Message.Trash');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Mailbox.Message.Reply');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'News.*');
						  
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Close');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Create');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Delete');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Display');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Feedback');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Feedbacklist');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Reopen');
						  $this->_authorizer->authManager->addItemChild($user_role->name, 'Complaints.Update');
						  
		
						  foreach($controller['default'] as $itemname)
						  {
								$this->_authorizer->authManager->addItemChild($user_role->name, $itemname.'.*');
						  }
		
				/* End inserting new values */				
				
			}
			
			$this->redirect(array('/rights/authItem/manageroles'));
		}
	
		$this->render('editrole', array(
			'model'=>$model_old,
		));
	}
	
	
	public function actionDeleterole($rid){
		if(Yii::app()->request->isPostRequest)
		{
			$role = UserRoles::model()->findByAttributes(array('id'=>$rid));
			$modules_access = ModuleAccess::model()->findAllByAttributes(array('role_id'=>$role->id));
			
			/* Start deleting existing data from related tables */
					
				/* Deleting Role details*/
				
				$itemName = $role->name;
			
				// Load the item and save the name for later use
				$item = $this->_authorizer->authManager->getAuthItem($itemName);
				$item = $this->_authorizer->attachAuthItemBehavior($item);
		
				// Delete the item
				$this->_authorizer->authManager->removeAuthItem($itemName);
				
				/* End deleting Role details */
				
				/* Revoke users */
				
				Yii::app()->runController('/rights/assignment/revokemultiple/rname/'.$role->name);
				
				/* End revoke users */
				
				/* Deleting Module access */
					
					foreach($modules_access as $module_access){
						$module_access->delete();
					}
					
				/* End deleting module access*/
				
				$role->delete();
			
			/* End deletion process */
			
			$this->redirect(array('/rights/authItem/manageroles'));
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
}
