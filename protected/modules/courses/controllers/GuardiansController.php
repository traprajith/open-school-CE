<?php

class GuardiansController extends RController
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
				'actions'=>array('index','view','Addguardian'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','guardiandelete','search'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		if(isset($_REQUEST['id']) and $_REQUEST['id'] != NULL){
			$this->render('view',array('model'=>$this->loadModel($id)));
		}
		else{
			throw new CHttpException(400, Yii::t('app','Invalid request. Please do not repeat this request again.'));
		}
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model					= new Guardians;
		$settings				= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
        $check_flag 			= 0;
		$guardian_exist_flag 	= 0; 
		//In case of Already Existing Parent			
		if($_POST['student_id']){ //Search based on Siblings
			$current_student_guradians = Guardians::model()->getGuardians($_REQUEST['id']);			
			$criteria 				= new CDbCriteria;		
			$criteria->join 		= 'JOIN guardian_list t1 ON t.id = t1.guardian_id'; 
			$criteria->condition 	= 't1.student_id=:student_id AND t.is_delete=:is_delete';
			$criteria->params 		= array(':student_id'=>$_POST['student_id'],'is_delete'=>0);
			
			$guardians 				= Guardians::model()->findAll($criteria);//This is for checking, the guardians are already assigned
				
			$criteria->addNotInCondition('t.id', $current_student_guradians);			
			$criteria->order		= 't.id ASC';
			$existing_guardians 	= Guardians::model()->findAll($criteria);	
			
			if($guardians){
				foreach($guardians as $guardian1){
					if(in_array($guardian1->id, $current_student_guradians)){
						$guardian_exist_flag = 1;
					}
				}
			}
		}
		elseif($_POST['guardian_id']){	//Search based on Parent Name
			$existing_guardians = '';	
			$current_student_guradians = Guardians::model()->getGuardians($_REQUEST['id']);	
			if(!in_array($_POST['guardian_id'], $current_student_guradians)){	
				$existing_guardians		= Guardians::model()->findAllByAttributes(array('id'=>$_POST['guardian_id']));			
			}
			if(in_array($_POST['guardian_id'], $current_student_guradians)){
				$guardian_exist_flag = 1;
			}
		}
		elseif($_POST['guardian_mail']){ //Search based on Parent email
			$current_student_guradians = Guardians::model()->getGuardians($_REQUEST['id']);	
			$existing_guardians = '';
			if(!in_array($_POST['guardian_mail'], $current_student_guradians)){	
				$existing_guardians		= Guardians::model()->findAllByAttributes(array('id'=>$_POST['guardian_mail']));			
			}	
			if(in_array($_POST['guardian_mail'], $current_student_guradians)){
				$guardian_exist_flag = 1;
			}								
		}
		
		if($existing_guardians!=NULL){			           
			$this->render('create',array('existing_guardians'=>$existing_guardians,'radio_flag'=>1));	
			exit;
		}		
		elseif((isset($_POST['student_id']) or isset($_POST['guardian_id']) or isset($_POST['guardian_mail'])) and ($existing_guardians==NULL)){			
			if($guardian_exist_flag == 1){ //if existing guardian already added to the new student
				Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Guardian Already Assigned!"));
			}
			else{
				Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Guardian Not Found..!"));
			}
		}
		
		if(isset($_POST['ex_submit_btn'])){			
			$current_student = Students::model()->findByPk($_REQUEST['id']);
			if(count($_POST['ex_guardian_id']) > 0 and $current_student != NULL){								
				for($i = 0; $i < count($_POST['ex_guardian_id']); $i++){
					if($current_student->parent_id == 0){ //Save Primary Guradian
						$current_student->saveAttributes(array('parent_id'=>$_POST['ex_guardian_id'][$i]));
					}
					if($current_student->immediate_contact_id == NULL){
						$current_student->saveAttributes(array('immediate_contact_id'=>$_POST['ex_guardian_id'][$i]));
					}
					$guardian 		= Guardians::model()->findByPk($_POST['ex_guardian_id'][$i]); 
					$is_relation	= GuardianList::model()->findByAttributes(array('student_id'=>$current_student->id, 'guardian_id'=>$_POST['ex_guardian_id'][$i]));
					if($is_relation == NULL){
						$guardian_list 	= new GuardianList;
						$guardian_list->guardian_id = $_POST['ex_guardian_id'][$i];
						$guardian_list->student_id	= $current_student->id;
						$guardian_list->relation	= $guardian->relation;
						$guardian_list->save();
					}
				}	
				if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
					$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['id'],'status'=>1));			
				}
				else{
					$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['id']));			
				}
			}
		}
		
		//In case of New Parent
		if(isset($_POST['Guardians']))
		{                                              
			$model->attributes 	= $_POST['Guardians'];
			$model->ward_id		= $_POST['Guardians']['ward_id'];
			if($_POST['Guardians']['relation']== 'Others' and $_POST['Guardians']['relation_other'] != NULL)
			{
				$model->relation		= $_POST['Guardians']['relation_other'];
				$model->relation_other	= $model->relation;
			}
			
			if(isset($_POST['Guardians']['dob']) and $_POST['Guardians']['dob']!=NULL){
				$model->dob = date('Y-m-d',strtotime($_POST['Guardians']['dob']));
			}
			
			//dynamic fields
			$fields   = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			$fields   = FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			         			
			if($_POST['Guardians']['user_create']==1){
				$check_flag = 1;
			}
			
			if($model->save()){				
				//Save data to guardian list table - for multiple guardian referance
				$guardian_list				= new GuardianList;
				$guardian_list->student_id	= $model->ward_id;
				$guardian_list->guardian_id	= $model->id;
				$guardian_list->relation	= $model->relation;
				$guardian_list->save();
                            				
				$student = Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
				if($student->parent_id == 0){					
					$student->saveAttributes(array('parent_id'=>$model->id));					
					
					//send previously generated invoices, if any
					Yii::app()->getModule("fees")->sendInvoicesForNewStudent($_REQUEST['id']);
				}
				if($student->immediate_contact_id == NULL){					
					$student->saveAttributes(array('immediate_contact_id'=>$model->id));				
				}
				
				if($_POST['Guardians']['user_create']==0 and $model->email != NULL){                                    
					//adding user for current guardian
					$user			= new User;
					$profile		= new Profile;
					$user->username = substr(md5(uniqid(mt_rand(), true)), 0, 10);
					$user->email 	= $model->email;
					$user->activkey	= UserModule::encrypting(microtime().$model->first_name);
					$password 		= substr(md5(uniqid(mt_rand(), true)), 0, 10);
                    $salt			= User::model()->getSalt();          
					$user->password	= UserModule::encrypting($salt.$password);
					if(isset($model->mobile_phone)){
						$user->mobile_number	= $model->mobile_phone;
					}
					$user->superuser	= 0;
					$user->status		= 1;
                    $user->salt			= $salt;
					
					if($user->save()){						
						//Assign role
						$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
						$authorizer->authManager->assign('parent', $user->id);
					
						//Profile
						$profile->firstname = $model->first_name;
						$profile->lastname 	= $model->last_name;
						$profile->user_id	= $user->id;
						$profile->save();
					
						//Saving user id to guardian table.
						$model->saveAttributes(array('uid'=>$user->id));					
					
						//SMS Notification
						$notification = NotificationSettings::model()->findByAttributes(array('id'=>3));
						$college=Configurations::model()->findByPk(1);
						$to = '';
						if($notification->sms_enabled=='1' and $notification->parent_1 == '1'){ // Checking if SMS is enabled.						
							if($model->mobile_phone){
								$to = $model->mobile_phone;	
							}
						
							if($to!=''){ 							
								$from 			= $college->config_value;
								$template		= SystemTemplates::model()->findByPk(1);
								$message 		= $template->template;
								$message 		= str_replace("<School Name>",$college->config_value,$message);
								
								$template		= SystemTemplates::model()->findByPk(2);
								$login_message 	= $template->template;
								$login_message 	= str_replace("<School Name>",$college->config_value,$login_message);
								$login_message 	= str_replace("<Password>",$password,$login_message);
								
								SmsSettings::model()->sendSms($to,$from,$message);
								SmsSettings::model()->sendSms($to,$from,$login_message);
							} 
						} 
						
						//Mail Notifiaction	
						if($notification->mail_enabled == '1' and $notification->parent_1 == '1'){						
							$template	= EmailTemplates::model()->findByPk(2);
							$subject 	= $template->subject;
							$message 	= $template->template;				
							$subject 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$subject);																	
							$message 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$message);
							$message 	= str_replace("{{EMAIL}}",$model->email,$message);
							$message 	= str_replace("{{PASSWORD}}",$password,$message);
							
							UserModule::sendMail($model->email,$subject,$message);						
						}
						//Message Notification	
						if($notification->msg_enabled == '1' and $notification->parent_1 == '1'){						
							$to 		= $model->uid;
							$subject 	= Yii::t('app','Welcome to').' '.$college->config_value;
							$message 	= Yii::t('app','Hi, Welcome to').' '.$college->config_value.'.'.Yii::t('app','We are looking forward to your esteemed presence and cooperation with our organization.');
							
							NotificationSettings::model()->sendMessage($to,$subject,$message);
						}					
					}
				}
				if(isset($_POST['which_btn']) and $_POST['which_btn']==1){ //In case of Save & Continue Button click
					$this->redirect(array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id']));
				}else{
					if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
						$this->redirect(array('create','id'=>$_REQUEST['id'],'status'=>1));//In case of adding guardians from student profile
					}
					else{
						$this->redirect(array('create','id'=>$_REQUEST['id']));//In case of Save & Add Another Button click
					}
				}
			}
		}

		$fields   = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
		foreach ($fields as $key => $field) {			
			if($field->form_field_type == 6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
		}
	
		$fields   = FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
		foreach ($fields as $key => $field) {			
			if($field->form_field_type==6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
		}
		
		$this->render('create',array('model'=>$model,'check_flag'=>$check_flag));		
	}
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{		
		$model		= $this->loadModel($id);
		$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));		
		if(isset($_POST['Guardians'])){                                
			$old_model 			= $model->attributes;
			$model->attributes 	= $_POST['Guardians'];
			if($_POST['Guardians']['relation']== 'Others' and $_POST['Guardians']['relation_other'] != NULL){
				$model->relation		= $_POST['Guardians']['relation_other'];
				$model->relation_other	= $model->relation;
			}
			if(isset($_POST['Guardians']['dob']) and $_POST['Guardians']['dob']!=NULL){
				$model->dob = date('Y-m-d',strtotime($_POST['Guardians']['dob']));
			}			
			//dynamic fields
			$fields   = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			$fields   = FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			if($model->save()){
				if($model->id != 0){
					//Update User table
					$user	= User::model()->findByPk($model->uid);
					if($user){
						$user->email			= $model->email;
						$user->mobile_number	= $model->mobile_phone;
						$user->save();
					}
					
					//Update Profile table
					$profile = Profile::model()->findByAttributes(array('user_id'=>$model->uid));
					if($profile){
						$profile->firstname	= $model->first_name;
						$profile->lastname	= $model->last_name;
						$profile->save();
					}
				}
                //In case of update from student registration
				if(isset($_REQUEST['sid']) and $_REQUEST['sid'] != NULL){
					$guardian_list	= GuardianList::model()->findByAttributes(array('student_id'=>$_REQUEST['sid'],'guardian_id'=>$model->id));
					if($guardian_list){
						$guardian_list->saveAttributes(array('relation'=>$model->relation));
					}
					else{
						$guardian_list				= new GuardianList;
						$guardian_list->student_id	= $_REQUEST['sid'];
						$guardian_list->guardian_id	= $model->id;
						$guardian_list->relation	= $model->relation;
						$guardian_list->save();
					}
				}				
				
				if(isset($_REQUEST['sid']) and $_REQUEST['sid'] != NULL){	 //In case of update from student registration	
					Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Guardian Updated Successfully!"));	
					if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){	
						$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid'], 'status'=>1));
					}	
					else{	
                		$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid']));                    
					}
				}
				else{
					//In case of update from guardian list			
					//Saving to activity feed
					$results = array_diff_assoc($_POST['Guardians'],$old_model); // To get the fields that are modified.					
					foreach($results as $key => $value){
						if($key != 'updated_at'){							
							if($key == 'country_id'){
								$value 				= Countries::model()->findByAttributes(array('id'=>$value));
								$value 				= $value->name;								
								$old_model_value 	= Countries::model()->findByAttributes(array('id'=>$old_model[$key]));
								$old_model[$key] 	= $old_model_value->name;
							}							
							//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
							ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'15',$model->id,ucfirst($model->first_name).' '.ucfirst($model->last_name),$model->getAttributeLabel($key),$old_model[$key],$value); 
						}
					}															
					$this->redirect(array('/students/guardians/view','id'=>$model->id));
				}
			}                        
		}
		
		if($model->dob != NULL and $model->dob == '0000-00-00'){
			$model->dob = '';
		}
		if($settings!=NULL and $model->dob!=NULL and $model->dob != '0000-00-00'){				
			$date1=date($settings->displaydate,strtotime($model->dob));
			$model->dob=$date1;
		}
		
		$fields   = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
        foreach ($fields as $key => $field) {			
			if($field->form_field_type==6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
        }
		
		$fields   = FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
        foreach ($fields as $key => $field) {			
			if($field->form_field_type==6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
        }
		
		$this->render('update',array('model'=>$model));
	}        	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){	
			$model = Guardians::model()->findByAttributes(array('id'=>$id));			
			if($model->saveAttributes(array('is_delete'=>1))){
				if($model->uid != 0 or $model->uid != '' or $model->uid != NULL){
					$user = User::model()->findByPk($model->uid);
					if($user){									
						$user->delete();							
					}
					$profile = Profile::model()->findByAttributes(array('user_id'=>$model->uid));
					if($profile){
						$profile->delete();
					}
					$model->saveAttributes(array('uid'=>0));
				}
				
				//Remove primary contact
				$students = Students::model()->findAllByAttributes(array('parent_id'=>$model->id));
				if($students){
					foreach($students as $student){
						$student->saveAttributes(array('parent_id'=>0));
					}
				}
				
				//Remove Immidiate contact
				$students = Students::model()->findAllByAttributes(array('immediate_contact_id'=>$model->id));
				if($students){
					foreach($students as $student){
						$student->saveAttributes(array('immediate_contact_id'=>0));
					}
				}
				
				//Remove guardian relation
				$guardian_lists = GuardianList::model()->findAllByAttributes(array('guardian_id'=>$model->id));
				if($guardian_lists){
					foreach($guardian_lists as $guardian_list){
						$guardian_list->delete();
					}
				}
			}
			
			//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
			ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'16',$model->id,ucfirst($model->first_name).' '.ucfirst($model->last_name),$model->getAttributeLabel($key),$old_model[$key],$value); 
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax'])){
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
			}
		}
		else{
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
		}
	}
        
    //Remove guardian in the time of student registration     
	public function actionRemoveGuardian()
	{
		if(Yii::app()->request->isPostRequest){
			$guardian_list = GuardianList::model()->findByAttributes(array('student_id'=>$_REQUEST['sid'], 'guardian_id'=>$_REQUEST['id']));
			if($guardian_list){
				if($guardian_list->delete()){
					$student = Students::model()->findByPk($_REQUEST['sid']);
					if($student){
						if($student->parent_id == $_REQUEST['id']){
							$student->saveAttributes(array('parent_id'=>0));
						}
						if($student->immediate_contact_id == $_REQUEST['id']){
							$student->saveAttributes(array('immediate_contact_id'=>NULL));
						}
					}
					Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Guardian Removed Successfully!"));
				}				
			}
			if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){	
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid'], 'status'=>1));
			}
			else{
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid']));
			}
		}
		else{
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
		}
	}
	
	//Set guradian as Primary Contact
	public function actionMakePrimary()
	{
		if(Yii::app()->request->isPostRequest){
			if($_REQUEST['id'] != NULL and $_REQUEST['sid'] != NULL){
				$student = Students::model()->findByPk($_REQUEST['sid']);
				if($student){
					if($student->saveAttributes(array('parent_id'=>$_REQUEST['id']))){
						Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Action Performed Successfully!"));	
					}
				}
			}
			if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){	
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid'], 'status'=>1));
			}
			else{
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid']));			
			}
		}
		else{
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
		}
	}
	
	//Set guradian as Emergency Contact
	public function actionMakeEmergency()
	{
		if(Yii::app()->request->isPostRequest){
			if($_REQUEST['id'] != NULL and $_REQUEST['sid'] != NULL){
				$student = Students::model()->findByPk($_REQUEST['sid']);
				if($student){
					if($student->saveAttributes(array('immediate_contact_id'=>$_REQUEST['id']))){
						Yii::app()->user->setFlash('errorMessage',Yii::t('app',"Action Performed Successfully!"));	
					}
				}
			}	
			if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){	
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid'], 'status'=>1));
			}
			else{
				$this->redirect(array('/students/guardians/create','id'=>$_REQUEST['sid']));			
			}
		}
		else{
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Guardians');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Guardians('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Guardians']))
			$model->attributes=$_GET['Guardians'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Guardians::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='guardians-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionSearch()
        {
            if(isset($_GET['name']) and $_GET['name']!=NULL)
		{
			$name_lists = array();
			$criteria = new CDbCriteria;
			if((substr_count( $_GET['name'],' '))==0)
			{ 	
				$criteria->condition='first_name LIKE :name or middle_name LIKE :name or last_name LIKE :name';
				$criteria->params[':name'] = $_GET['name'].'%';
			}
			else if((substr_count( $_GET['name'],' '))>=1)
			{
				$name=explode(" ",$_GET['name']);
				$criteria->condition='first_name LIKE :name or middle_name LIKE :name or last_name LIKE :name';
				$criteria->params[':name'] = $name[0].'%';
				$criteria->condition=$criteria->condition.' and '.'(first_name LIKE :name1 or middle_name LIKE :name1 or last_name LIKE :name1)';
				$criteria->params[':name1'] = $name[1].'%';			
			}
			$names = Students::model()->findAll($criteria);
			foreach($names as $student_name)
			{
                            $list_model= GuardianList::model()->findAllByAttributes(array('student_id'=>$student_name->id));
                            foreach($list_model as $data)
                            {
				$name_lists[] = $data->guardian_id;
                            }
			}  
                        
                        $criteria2= new CDbCriteria();
			$criteria2->addInCondition('id', $name_lists); 
                        $total = Guardians::model()->count($criteria2);
                        $pages = new CPagination($total);
                        $pages->setPageSize(Yii::app()->params['listPerPage']);
                        $pages->applyLimit($criteria2);
                        
                        
                        
                        $model = Guardians::model()->findAll($criteria2);                                                
                        $this->render('search',array('model'=>$model,                                       
                                        'pages' => $pages,
                                        'item_count'=>$total,
                                        'page_size'=>Yii::app()->params['listPerPage'],)) ;

                                        }	
            else {
                                            $this->render('search');
                
            }
                
            
        }
}
