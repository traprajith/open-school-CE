<?php

class CoursesController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Managecourse','ReqTest01','Edit','Deactivatedbatches','Duplicatebatch','Commonsubjects'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','deactivate'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate(){		
		$model=new Courses;
		$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
		if(Yii::app()->user->year){
			$year = Yii::app()->user->year;
		}else{
			$year = $current_academic_yr->config_value;
		}

		if(isset($_POST['Courses'])){	
			$old_timetable_format	= $model->timetable_format;
			$model->attributes=$_POST['Courses'];	
			if($_POST['Courses']['exam_format'] == null){
				$configuration = Configurations::model()->findByAttributes(array('id'=>41));
				if($configuration->config_value == 1){
					$model->exam_format=1;
				}
				if($configuration->config_value == 2){
					$model->exam_format=2;
				}
			}
			
			if(Configurations::model()->timetableConfig()!=-1){ // timetable format is not selected as course level
				$model->timetable_format	= $old_timetable_format;
			}
			
			$model->academic_yr_id=$year;
			$model->validate();
			
			if($model->save()){	
				$this->redirect(array('/courses'));
			}						
		}
		
		$this->render('create',array(
			'model'=>$model
		));
	}
	
	public function actionAllcourses()
	{
		if(isset($_POST['year']))
		{
			//$posts = Courses::model()->findAll("is_deleted =:x and academic_yr_id =:y", array(':x'=>0,':y'=>$_POST['year']));
			//$this->redirect(array('allcourses','posts'=>$posts));
		}
		$this->render('allcourse');	
	}
	
	public function actionEdit() {
		$model=$this->loadModel($_GET['val1']);
		// Ajax Validation enabled
		$this->performAjaxValidation($model);
		// Flag to know if we will render the form or try to add 
		// new jon.
		$flag=true;
		if(isset($_POST['Courses'])){      
			$flag=false;
			$old_timetable_format	= $model->timetable_format;
			$model=$this->loadModel($_GET['val1']);
			$model->attributes=$_POST['Courses'];
			Yii::app()->clientScript->scriptMap=array(
				'jquery.js'=>false,
				'jquery.min.js' => false,
			);
			
			
			if(Configurations::model()->timetableConfig()!=-1){ // timetable format is not selected as course level
				$model->timetable_format	= $old_timetable_format;
			}
			
			if($model->save()){		
				echo CJSON::encode(array('status'=>'success',));
				exit;    
			}else{
				echo CJSON::encode(array('status'=>'error',));
				exit;   
			}		
		}
				
		if($flag) {
			Yii::app()->clientScript->scriptMap=array(
				'jquery.js'=>false,
				'jquery.min.js' => false,
			);
			$this->renderPartial('update',array('model'=>$model,'val1'=>$_GET['val1']),false,true);
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Courses']))
		{
			$model->attributes=$_POST['Courses'];
			
			if($_POST['Courses']['exam_format'] == null)
			{
				$configuration = Configurations::model()->findByAttributes(array('id'=>41));
				if($configuration->config_value == 1)
				{
					$model->exam_format=1;
				}
				if($configuration->config_value == 2)
				{
					$model->exam_format=2;
				}
				
			}
			if(isset($_POST['sem_system']))
			{
				$model->semester_enabled = 1;
			}
			else
			{
				$model->semester_enabled = 0;
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionReqTest01()
	{
		$val = $_GET['val1'];
		//echo $val;
		$this->renderPartial('batchestocourses', array('val'=>$val));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id);
			//$this->is_deleted =1;
			$id = Yii::app()->request->getQuery('id');
			$model = Courses::model()->findByPk($id);
			$model->is_deleted = 1;
			$model->save(false);
 
                                

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}
	
	public function actionDeactivate($id)
	{
		if(Yii::app()->request->isPostRequest){		
			$model = Courses::model()->findByPk($id);
			$model->is_deleted = 1; 
			if($model->save()){ // Course Deleted			
				// Batch Deletion
				$batches = Batches::model()->findAllByAttributes(array('course_id'=>$id)); //Selecting all batches under the course with id = $id
				foreach($batches as $batch){					
					// Student Deletion
					$students = Students::model()->findAllByAttributes(array('batch_id'=>$batch->id));					
					if($students){
						foreach($students as $student){
							$student->saveAttributes(array('batch_id'=>NULL));
						}
					}
					
					//Remove batch - student relation
					$batch_students = BatchStudents::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					if($batch_students){
						foreach($batch_students as $batch_student){
							$batch_student->delete();
						}
					}
					
					// Subject Association Deletion
					$subjects = Subjects::model()->findAllByAttributes(array('batch_id'=>$batch->id));
					foreach($subjects as $subject){
						EmployeesSubjects::model()->DeleteAllByAttributes(array('subject_id'=>$subject->id));
						 $subject->delete();
					}
					
                    $batch->saveAttributes(array('is_active'=>0, 'is_deleted'=>1, 'employee_id'=>' '));					
				}
				
				Yii::app()->user->setFlash('success', Yii::t('app','Selected course is deleted!'));
            	$this->redirect(array('managecourse'));
			}
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Courses');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Courses('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Courses']))
			$model->attributes=$_GET['Courses'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionManagecourse()
	{
		
      $this->render('managecourse');
	}
	public function actionCommonsubjects(){
		 $this->render('commonsubjects');
	}
	public function actionDeactivatedbatches()
	{
		
      $this->render('deactivatedbatches');
	}
	public function actionDuplicatebatch()
	{
	  if(!empty($_POST))
	  {
		  $parent_batch = $_REQUEST['bid'];
		  $new_batch = $_REQUEST['new_bid'];
		  if($_POST['Students']==1)
		  {
			  $parent_model = BatchStudents::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['bid']));
			  foreach($parent_model as $parent_item)
			  {
			  	$new_model = new BatchStudents;
			  	$new_model->student_id = $parent_item->student_id;
				$new_model->batch_id = $new_batch;
				$new_model->academic_yr_id = $parent_item->academic_yr_id;
				$new_model->status = $parent_item->status;
				$new_model->result_status = $parent_item->result_status;
				$new_model->save();
			  }
			  
			   /*$student_details = Students::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['bid']));
			   foreach($student_details as $student_detail)
			   {
				   $new_student = new Students;
				   
			   }*/
			  
                          
		  }
		  if($_POST['Subjects']==1)
		  {
			  $parent_model = Subjects::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['bid'],'elective_group_id'=>0));
			  foreach($parent_model as $parent_item)
			  {
			  	$new_model = new Subjects;
			  	$new_model->name = $parent_item->name;
				$new_model->code = $parent_item->code;
				$new_model->batch_id = $new_batch;
				$new_model->no_exams = $parent_item->no_exams;
				$new_model->max_weekly_classes = $parent_item->max_weekly_classes;
				$new_model->elective_group_id = $parent_item->elective_group_id;
				$new_model->is_deleted = $parent_item->is_deleted;
				$new_model->created_at = $parent_item->created_at;
				$new_model->updated_at = $parent_item->updated_at;
				$new_model->save();
				
				$old_sub = EmployeesSubjects::model()->findByAttributes(array('subject_id'=>$parent_item->id));
				if($old_sub->employee_id!=NULL)
				{
					$new_sub = new EmployeesSubjects;
					$new_sub->employee_id = $old_sub->employee_id;
					$new_sub->subject_id = $new_model->id;
					$new_sub->save();
				}
				
			  }		
			  
			  
			  
			    
		  }
		  
		  
		  if($_POST['Electives']==1)
		  {
                      
			//save data to elective groups by changing batch id
			
			  $elective_group_model= ElectiveGroups::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['bid']));
			  if($elective_group_model)
			  {
				  foreach ($elective_group_model as $elec_group_data)
				  {
					  $elective_group= new ElectiveGroups;
					  $elective_group->name= $elec_group_data->name;
					  $elective_group->code= $elec_group_data->code;
					  $elective_group->batch_id= $new_batch;
					  $elective_group->is_deleted= 0;
					  $elective_group->created_at= date('Y-m-d');
					  $elective_group->updated_at="";
					  $num_class = Subjects::model()->findByAttributes(array('elective_group_id'=>$elec_group_data->id));
					  $elective_group->max_weekly_classes=$num_class->max_weekly_classes;
					  $elective_group->save();
                                          
					  $criteria = new CDbCriteria;
					  $criteria->condition = 'batch_id=:bid and elective_group_id=:eid';
					  $criteria->params=array(':bid'=>$_REQUEST['bid'],':eid'=>$elec_group_data->id);
					  $parent_model = Subjects::model()->findAll($criteria);
					  foreach($parent_model as $parent_item)
					  {
							$new_model = new Subjects;
							$new_model->name = $parent_item->name;
							$new_model->code = $parent_item->code;
							$new_model->batch_id = $new_batch;
							$new_model->no_exams = $parent_item->no_exams;
							$new_model->max_weekly_classes = $parent_item->max_weekly_classes;
							$new_model->elective_group_id = $elective_group->id;
							$new_model->is_deleted = $parent_item->is_deleted;
							$new_model->created_at = $parent_item->created_at;
							$new_model->updated_at = $parent_item->updated_at;
							$new_model->save();

					  }
					  
					  
						$parent_model = Electives::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['bid'],'elective_group_id'=>$elec_group_data->id));
						foreach($parent_model as $parent_item)
						{
							  $new_model = new Electives;
							  $new_model->elective_group_id = $elective_group->id;
							  $new_model->batch_id = $new_batch;
							  $new_model->name = $parent_item->name;
							  $new_model->code = $parent_item->code;
							  $new_model->is_deleted = $parent_item->is_deleted;
							  $new_model->created_at = $parent_item->created_at;
							  $new_model->updated_at = $parent_item->updated_at;
							  $new_model->save();
							  
							  $elective_sub = EmployeeElectiveSubjects::model()->findByAttributes(array('elective_id'=>$parent_item->id));
							  
						      $sub_id = Subjects::model()->findByAttributes(array('elective_group_id'=>$elective_group->id));
							  
							  $new_emp = new EmployeeElectiveSubjects;
							  
							  $new_emp->employee_id = $elective_sub->employee_id;
							  $new_emp->elective_id = $new_model->id;
							  $new_emp->subject_id = $sub_id->id;
							  $new_emp->save();
						}	
				  }
			  }
																									 
			 
			  
			  
		  }
		  
		  $this->redirect(array('/courses'));
	  }
      $this->render('duplicatebatch');
	  
	}
	
	public function actionBatchname()
	{			
		$data=Batches::model()->findAll('id<>:bid AND course_id=:id AND is_active=:x AND is_deleted=:y',array(':bid'=>$_GET['bid'], ':id'=>(int) $_POST['cid'],':x'=>1,':y'=>0));
		echo CHtml::tag('option', array('value' => 0), CHtml::encode('Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), true);
		$data=CHtml::listData($data,'id','name');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
		}
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Courses::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	 public function actionManage()
	{
		$model=new Coursemanager;
		if(isset($_POST['assign']))
		{
			
			   if(isset($_POST['user']) and $_POST['user']!=NULL)
				{ 
				$user = $_POST['user'];
				}
			    if(isset($_POST['cid']) and $_POST['cid']!=NULL)
				{ 
					// var_dump($_POST['cid']);
					 $no_of_course = count($_POST['cid']);
					 for($i=0;$i<$no_of_course;$i++)
				     {
				     $model=new Coursemanager;
					//print_r($_POST['cid'][$i]); exit;
					 $model->user_id = $user;
					 $model->course = $_POST['cid'][$i]; 
					 $model->save();
			         }
			    }
		}
		$this->render('manage',array('model'=>$model,'id'=>$model->id));
	}
	
		
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='courses-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
