
<?php

class StudentsController extends RController
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
				'actions'=>array('index','view','manage','Website','savesearch','events','attentance','Assesments','DisplaySavedImage','Fees','Payfees','Pdf','Printpdf','Remove','Search','inactive','active','deletes','Document','electives','removeelective','Courses','Flag'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','batch','add','delete_student','Delete_all'),
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
		//$this->layout='';
		//header("Content-type: image/jpeg");
		//echo $model->photo_data;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionPrintpdf()
	{
		//$this->layout='';
		//header("Content-type: image/jpeg");
		//echo $model->photo_data;
		$this->render('printpdf',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));
	}
	public function actionPdf()
    {
		$student 	= Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$filename 	= $student->first_name.' '.$student->last_name.' Profile.pdf';		
		Yii::app()->osPdf->generate("application.modules.students.views.students.printpdf", $filename, array('model'=>$this->loadModel($_REQUEST['id'])));
	}
	public function actionDisplaySavedImage()
		{
			$model=$this->loadModel($_GET['id']);
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Content-Transfer-Encoding: binary');
			header('Content-length: '.$model->photo_file_size);
			header('Content-Type: '.$model->photo_content_type);
			header('Content-Disposition: attachment; filename='.$model->photo_file_name);
			echo $model->photo_data;
		}
	
	public function actionRemove()
	{		
		$model 					= Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));	
		$file_name 				= $model->photo_file_name;	
		$model->photo_file_name = NULL;		
		if($model->save()){
			$path = 'uploadedfiles/student_profile_image/'.$model->id.'/'.$file_name;
			if(file_exists($path)){		
				unlink($path);									
				Yii::app()->user->setFlash('successMessage', "Action performed successfully");
			}
		}
		if(isset($_REQUEST['status'])){
			$this->redirect(array('update','id'=>$_REQUEST['id'],'status'=>$_REQUEST['status']));
		}else{
			$this->redirect(array('update','id'=>$_REQUEST['id']));
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 
	public function actionCreate()
	{
		$model		= new Students;
		$roles 		= Rights::getAssignedRoles(Yii::app()->user->Id);		
		$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if(isset($_POST['Students'])){
			$model->attributes	= $_POST['Students'];
			$list = $_POST['Students'];			
			if(isset($_POST['Students']['admission_date']) and $_POST['Students']['admission_date'] != NULL){
				$model->admission_date	= date('Y-m-d',strtotime($_POST['Students']['admission_date']));
			}
			if(isset($_POST['Students']['date_of_birth']) and $_POST['Students']['date_of_birth'] != NULL){
				$model->date_of_birth	= date('Y-m-d',strtotime($_POST['Students']['date_of_birth']));
			}
			
			//dynamic fields
			$fields   = FormFields::model()->getDynamicFields(1, 1, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type == 6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			$fields   = FormFields::model()->getDynamicFields(1, 2, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type == 6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
						 
			if($file=CUploadedFile::getInstance($model,'photo_data')){
				$file_name = DocumentUploads::model()->getFileName($file->name);	
				if(key($roles)!=NULL and (key($roles) == 'Admin')){						
					$model->photo_file_name = $file_name;				
				}
      		}     
			$model->created_at = date('Y-m-d H:i:s');
			
			if($model->save()){
								
				//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
				ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'3',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL); 
				
			//Add image to the folder
				if($file_name!=NULL){															
					if(!is_dir('uploadedfiles/')){
						mkdir('uploadedfiles/');
					}
					if(!is_dir('uploadedfiles/student_profile_image/')){
						mkdir('uploadedfiles/student_profile_image/');
					}
					if(!is_dir('uploadedfiles/student_profile_image/'.$model->id)){
						mkdir('uploadedfiles/student_profile_image/'.$model->id);
					}
					//compress the image
					$info = getimagesize($_FILES['Students']['tmp_name']['photo_data']); 
					if($info['mime'] == 'image/jpeg'){
						$image = imagecreatefromjpeg($_FILES['Students']['tmp_name']['photo_data']);
					}elseif($info['mime'] == 'image/gif'){
						$image = imagecreatefromgif($_FILES['Students']['tmp_name']['photo_data']);
					}elseif($info['mime'] == 'image/png'){
						$image = imagecreatefrompng($_FILES['Students']['tmp_name']['photo_data']);
					}
					
					$temp_file_name = $_FILES['Students']['tmp_name']['photo_data'];					
					$destination_file = 'uploadedfiles/student_profile_image/'.$model->id.'/'.$file_name;
					imagejpeg($image, $destination_file, 30);		
					
					//Insert Data in document_uploads table
					DocumentUploads::model()->insertData(1, $model->id, $file_name, 6);				
				}
				$salt	= User::model()->getSalt();
				//adding user for current student
				if($model->email!=NULL){
					$user			= new User;
					$profile		= new Profile;
					$user->username = substr(md5(uniqid(mt_rand(), true)), 0, 10);
					$user->email 	= $model->email;
					$user->activkey	= UserModule::encrypting(microtime().$model->first_name);
					$password 		= substr(md5(uniqid(mt_rand(), true)), 0, 10);
					$user->password	= UserModule::encrypting($salt.$password);
					if(isset($model->phone1)){
						$user->mobile_number = $model->phone1;
					}
					$user->salt			= $salt;
					$user->superuser	= 0;
					$user->status		= 1;					
					if($user->save()){											
						//assign role
						$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
						$authorizer->authManager->assign('student', $user->id); 
						
						//profile
						$profile->firstname = $model->first_name;
						$profile->lastname 	= $model->last_name;
						$profile->user_id	= $user->id;
						$profile->save();
						
						//saving user id to students table.
						$model->saveAttributes(array('uid'=>$user->id));
						
						// for sending sms
						$notification 	= NotificationSettings::model()->findByAttributes(array('id'=>3));
						$college		= Configurations::model()->findByPk(1);
						$to = '';
						if($notification->sms_enabled=='1' and $notification->student=='1'){ // Checking if SMS is enabled.						
							if($model->phone1){
								$to = $model->phone1;	
							}
							elseif($model->phone2){
								$to = $model->phone2;
							}
							if($to!=''){ // Send SMS if phone number is provided									
								$from 		= $college->config_value;
								$template	= SystemTemplates::model()->findByPk(3);
								$message 	= $template->template;
								$message 	= str_replace("<School Name>",$college->config_value,$message);
								
								$template		= SystemTemplates::model()->findByPk(4);
								$login_message 	= $template->template;
								$login_message 	= str_replace("<School Name>",$college->config_value,$login_message);
								$login_message 	= str_replace("<Password>",$password,$login_message);
								SmsSettings::model()->sendSms($to,$from,$message);
								SmsSettings::model()->sendSms($to,$from,$login_message);
							} // End send SMS
						} // End check if SMS is enabled
					//mail		
						if($notification->mail_enabled == '1'  and $notification->student == '1'){								
							$template	= EmailTemplates::model()->findByPk(1);
							$subject 	= $template->subject;
							$message 	= $template->template;
							$subject 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$subject);							
							$message 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$message);
							$message 	= str_replace("{{EMAIL}}",$model->email,$message);
							$message 	= str_replace("{{PASSWORD}}",$password,$message);
							
							UserModule::sendMail($model->email,$subject,$message);
						}
					//send message	
						if($notification->msg_enabled == '1' and $notification->student=='1'){								
							$to 		= $model->uid;
							$subject 	= Yii::t('app','Welcome to').' '.$college->config_value;
							$message 	= Yii::t('app','Hi, Welcome! Your study at').' '.$college->config_value.' '.Yii::t('app','is an important time of discovery, and we\'re here to support you along the way.');
							NotificationSettings::model()->sendMessage($to,$subject,$message);							
						}														
					}
				}								  
				// Saving to batch_student table to get current and previous batches of the student
				if($model->batch_id){
					$current_academic_yr = Configurations::model()->findByPk(35);				  
					$student_batches = BatchStudents::model()->findAll('student_id=:x AND batch_id=:y',array(':x'=>$model->id,':y'=>$model->batch_id));					  
					if($student_batches==NULL){
						$old_students = BatchStudents::model()->findAll('student_id=:x',array(':x'=>$model->id));
						foreach($old_students as $old_student){
							$old_student->status = 0;
							$old_student->save();
						} 
						$new_batch 					= new BatchStudents;
						$new_batch->student_id 		= $model->id;
						$new_batch->batch_id 		= $model->batch_id;
						$new_batch->academic_yr_id 	= $current_academic_yr->config_value;
						$new_batch->status 			= 1;
						$new_batch->save();						  
					}	
                                        if($model->batch_id!=NULL)
                                        {
                                            //generate existing invoices for new student    
                                            Yii::app()->getModule("fees")->sendInvoicesForNewStudent($model->id);
                                        }
				}
							  				
				$this->redirect(array('guardians/create','id'=>$model->id));
			}
		}
		
		
		if($model->admission_date!=NULL and $settings!=NULL){
			$date1					= date($settings->displaydate,strtotime($model->admission_date));
			$model->admission_date 	= $date1;
		}

		if($model->date_of_birth!=NULL and $settings!=NULL){
			$date2					= date($settings->displaydate,strtotime($model->date_of_birth));
			$model->date_of_birth	= $date2;
		}
		$fields   = FormFields::model()->getDynamicFields(1, 1, "forAdminRegistration");
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
		
		$fields   = FormFields::model()->getDynamicFields(1, 2, "forAdminRegistration");
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
		
		$this->render('create',array('model'=>$model));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$id				= $_REQUEST['id'];		
		$roles 			= Rights::getAssignedRoles(Yii::app()->user->Id);
		$model			= $this->loadModel($id);		
		$old_batch_id 	= $model->batch_id;				
		$settings		= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		
		if(isset($_POST['Students'])){ 
			$old_model 			= $model->attributes; // For activity feed				
			$model->attributes	= $_POST['Students'];			
			if($_POST['Students']['admission_date'] != NULL){
				$model->admission_date	= date('Y-m-d',strtotime($_POST['Students']['admission_date']));
			}
			if($_POST['Students']['date_of_birth'] != NULL){
				$model->date_of_birth	= date('Y-m-d',strtotime($_POST['Students']['date_of_birth']));
			}
			//dynamic fields
			$fields   = FormFields::model()->getDynamicFields(1, 1, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type == 6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			$fields   = FormFields::model()->getDynamicFields(1, 2, "forAdminRegistration");
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));
					}
				}
			}
			
			if($file=CUploadedFile::getInstance($model,'photo_data')){
				$file_name = DocumentUploads::model()->getFileName($file->name);	
				if(key($roles)!=NULL and (key($roles) == 'Admin')){						
					$model->photo_file_name = $file_name;				
				}							
      		}	
			if($model->validate()){			
				if($model->save()){ 			
					//save new email id to user table
					if($model->uid != 0){					
						$usr_model	= User::model()->findByPk($model->uid);
						if($usr_model){
							$usr_model->email			= $model->email;						
							$usr_model->mobile_number	= $model->phone1;					
							$usr_model->save();
						}
						$profile = Profile::model()->findByAttributes(array('user_id'=>$model->uid));
						if($profile){
							$profile->firstname = $model->first_name;
							$profile->lastname 	= $model->last_name;
							$profile->save();
						} 
					}
					  
					//Add image to the folder
					if($file_name!=NULL){
						if(!is_dir('uploadedfiles/')){
							mkdir('uploadedfiles/');
						}
						if(!is_dir('uploadedfiles/student_profile_image/')){
							mkdir('uploadedfiles/student_profile_image/');
						}
						if(!is_dir('uploadedfiles/student_profile_image/'.$model->id)){
							mkdir('uploadedfiles/student_profile_image/'.$model->id);
						}
						//compress the image
						$info = getimagesize($_FILES['Students']['tmp_name']['photo_data']); 
						if($info['mime'] == 'image/jpeg'){
							$image = imagecreatefromjpeg($_FILES['Students']['tmp_name']['photo_data']);
						}elseif($info['mime'] == 'image/gif'){
							$image = imagecreatefromgif($_FILES['Students']['tmp_name']['photo_data']);
						}elseif($info['mime'] == 'image/png'){
							$image = imagecreatefrompng($_FILES['Students']['tmp_name']['photo_data']);
						}
						
						$temp_file_name = $_FILES['Students']['tmp_name']['photo_data'];					
						$destination_file = 'uploadedfiles/student_profile_image/'.$model->id.'/'.$file_name;
						imagejpeg($image, $destination_file, 30);	
						
						//Insert Data in document_uploads table
						DocumentUploads::model()->insertData(1, $model->id, $file_name, 6);		
					}
					
					
					// Saving to activity feed
					$results = array_diff_assoc($_POST['Students'],$old_model); // To get the fields that are modified.
					
					foreach($results as $key => $value){
						if($key != 'updated_at'){
							if($key == 'batch_id'){
								$value 				= Batches::model()->findByAttributes(array('id'=>$value));
								$value 				= $value->name.'-'.$value->course123->course_name;							
								$old_model_value 	= Batches::model()->findByAttributes(array('id'=>$old_model[$key]));
								$old_model[$key] 	= $old_model_value->name.'-'.$old_model_value->course123->course_name;;
							}
							elseif($key == 'gender'){
								if($value == 'F'){
									$value = 'Female';
								}
								else{
									$value = 'Male';
								}
								if($old_model[$key] == 'F'){
									$old_model[$key] = 'Female';
								}
								else{
									$old_model[$key] = 'Male';
								}
							}
							elseif($key == 'student_category_id'){
								$value 				= StudentCategories::model()->findByAttributes(array('id'=>$value));
								$value 				= $value->name;							
								$old_model_value 	= StudentCategories::model()->findByAttributes(array('id'=>$old_model[$key]));
								$old_model[$key] 	= $old_model_value->name;
							}
							elseif($key == 'nationality_id' or $key == 'country_id'){
								$value 				= Countries::model()->findByAttributes(array('id'=>$value));
								$value 				= $value->name;							
								$old_model_value 	= Countries::model()->findByAttributes(array('id'=>$old_model[$key]));
								$old_model[$key] 	= $old_model_value->name;
							}						
							//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
							ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'4',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),$model->getAttributeLabel($key),$old_model[$key],$value); 												
						}
					}	
					//END saving to activity feed
									
					// Saving to batch_student table to get current and previous batches of the student					
					if($model->batch_id != NULL){ 					  					  
						if($old_batch_id != $model->batch_id){ 					     
							if($old_batch_id!=NULL){ 
								$change = BatchStudents::model()->findByAttributes(array('student_id'=>$model->id,'batch_id'=>$old_batch_id));
								if($change != NULL){ 
									$change->result_status 	= 3;
									$change->status 		= 0;                                                      
									$change->save();
								}
							}						  						  
							$checkprevious = BatchStudents::model()->findByAttributes(array('student_id'=>$model->id,'batch_id'=>$model->batch_id));
							if($checkprevious!=NULL){ 
								$checkprevious->result_status 	= 0;
								$checkprevious->status 			= 1;
								$checkprevious->save();
							}
							else{ 							
								$current_academic_yr = Configurations::model()->findByPk(35);
								$new_batch = new BatchStudents;							
								$new_batch->student_id 		= $model->id;
								$new_batch->batch_id 		= $model->batch_id;
								$new_batch->academic_yr_id 	= $current_academic_yr->config_value;
								$new_batch->status 			= 1;	
								$new_batch->result_status	= 0;
								$new_batch->roll_no			= 0;								
								$new_batch->save();																
							}						   					  
						}					  
					}
					else{					  
						if($old_batch_id!=NULL){ 
							$change = BatchStudents::model()->findByAttributes(array('student_id'=>$model->id,'batch_id'=>$old_batch_id));
							if($change){
								$change->result_status 	= 3;
								$change->status 		= 0;                                                      
								$change->save();								
							}
						}
					}
						  
					if($_REQUEST['status']==1){
						$this->redirect(array('view','id'=>$model->id));                                    		
					}
					else{
						$this->redirect(array('guardians/create','id'=>$model->id));
					}				
				}
			}
		}
		if($model->admission_date!=NULL and $settings!=NULL){
			$date1=date($settings->displaydate,strtotime($model->admission_date));
			$model->admission_date=$date1;
		}

		if($model->date_of_birth!=NULL and $settings!=NULL){
			$date2=date($settings->displaydate,strtotime($model->date_of_birth));
			$model->date_of_birth=$date2;
		}
		$fields   = FormFields::model()->getDynamicFields(1, 1, "forAdminRegistration");
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
		
		$fields   = FormFields::model()->getDynamicFields(1, 2, "forAdminRegistration");
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
	/*delete student( in student list ) is_active=0 and is_delete=1 and the user table status=0  */
	public function actionDelete_student()
	{
		if(Yii::app()->request->isPostRequest){
			$id		= $_REQUEST['id'];
			$model	= $this->loadModel($id);
			if($model->saveAttributes(array('is_active'=>0, 'is_deleted'=>1))){
				//Remove student user
				if($model->uid != 0){
					$user = User::model()->findByAttributes(array('id'=>$model->uid));
					if($user){
						$user->delete();
					}
					$profile = Profile::model()->findByAttributes(array('user_id'=>$model->uid));
					if($profile){
						$profile->delete();
					}
					$model->saveAttributes(array('uid'=>0));
				}
				//Change batch related datas
				$batch_students	= BatchStudents::model()->findAllByAttributes(array('student_id'=>$id));
				if($batch_students){
					foreach($batch_students as $batch_student){
						$batch_student->saveAttributes(array('status'=>0, 'result_status'=>2));
					}
				}								
								
				//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
				ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'7',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
												
				//remove guardian	
				$criteria 				= new CDbCriteria;		
				$criteria->join 		= 'JOIN guardians t1 ON t.guardian_id = t1.id'; 
				$criteria->condition 	= 't.student_id=:student_id AND t1.is_delete=:is_delete';
				$criteria->params 		= array(':student_id'=>$_REQUEST['id'],'is_delete'=>0);
				$guardians 	= GuardianList::model()->findAll($criteria);		
				
				if($guardians){						
					foreach($guardians as $guardian){
						$guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));						
						if($guardian_detail!=NULL){
							$criteria 				= new CDbCriteria;		
							$criteria->join 		= 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
							$criteria->condition 	= 't1.guardian_id=:guardian_id and t.is_active=:is_active and is_deleted=:is_deleted';
							$criteria->params 		= array(':guardian_id'=>$guardian_detail->id,':is_active'=>1,'is_deleted'=>0);
							$active_students 		= Students::model()->findAll($criteria);
							
							if($active_students == NULL){
								if($guardian_detail->saveAttributes(array('is_delete'=>1))){
									//Remove primary contact
									$students = Students::model()->findAllByAttributes(array('parent_id'=>$guardian_detail->id));
									if($students){
										foreach($students as $student){
											$student->saveAttributes(array('parent_id'=>0));
										}
									}
									
									//Remove Immidiate contact
									$students = Students::model()->findAllByAttributes(array('immediate_contact_id'=>$guardian_detail->id));
									if($students){
										foreach($students as $student){
											$student->saveAttributes(array('immediate_contact_id'=>0));
										}
									}
									//Remove guardian relation
									$guardian_lists = GuardianList::model()->findAllByAttributes(array('guardian_id'=>$guardian_detail->id));
									if($guardian_lists){
										foreach($guardian_lists as $guardian_list){
											$guardian_list->delete();
										}
									}
									
									//Remove guardian user
									if($guardian_detail->uid != 0 or $guardian_detail->uid != NULL or $guardian_detail->uid != ''){
										if($guardian_detail->saveAttributes(array('uid'=>0))){
											$guardian_user = User::model()->findByPk($guardian_detail->uid);
											if($guardian_user){									
												$guardian_user->delete();							
											}
											$guardian_profile = Profile::model()->findByAttributes(array('user_id'=>$guardian_detail->uid));
											if($guardian_profile){
												$guardian_profile->delete();
											}
										}										
									}
								}
							}
						}						
					}
				}
				//Remove student-guardian relation
				$guardian_lists = GuardianList::model()->findAllByAttributes(array('student_id'=>$model->id));
				if($guardian_lists){
					foreach($guardian_lists as $guardian_list){
						$guardian_list->delete();
					}
				}												
			}
			$this->redirect(array('/students/students/manage'));
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}		
	}
	public function actionDelete_all()
	{
		if(Yii::app()->request->isPostRequest){			
			$datas = $_POST['id'];		
			foreach($datas as $data){
				$model	= Students::model()->findByAttributes(array('id'=>$data));
				if($model->saveAttributes(array('is_active'=>0, 'is_deleted'=>1))){
					//Remove student user
					if($model->uid != 0){
						$user = User::model()->findByAttributes(array('id'=>$model->uid));
						if($user){
							$user->delete();
						}
						$profile = Profile::model()->findByAttributes(array('user_id'=>$model->uid));
						if($profile){
							$profile->delete();
						}
						$model->saveAttributes(array('uid'=>0));
					}
					//Change bacth related datas
					$batch_students	= BatchStudents::model()->findAllByAttributes(array('student_id'=>$data));
					if($batch_students){
						foreach($batch_students as $batch_student){
							$batch_student->saveAttributes(array('status'=>0, 'result_status'=>2));
						}
					}
								
					//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
					ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'7',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
													
					//remove guardian
					$criteria 				= new CDbCriteria;		
					$criteria->join 		= 'JOIN guardians t1 ON t.guardian_id = t1.id'; 
					$criteria->condition 	= 't.student_id=:student_id AND t1.is_delete=:is_delete';
					$criteria->params 		= array(':student_id'=>$data,'is_delete'=>0);
					$guardians 	= GuardianList::model()->findAll($criteria); 			
					
					if($guardians){						
						foreach($guardians as $guardian){
							$guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
							if($guardian_detail!=NULL){
								$criteria 				= new CDbCriteria;		
								$criteria->join 		= 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
								$criteria->condition 	= 't1.guardian_id=:guardian_id and t.is_active=:is_active and is_deleted=:is_deleted';
								$criteria->params 		= array(':guardian_id'=>$guardian_detail->id,':is_active'=>1,'is_deleted'=>0);
								$active_students 		= Students::model()->findAll($criteria);
								
								if($active_students == NULL){
									if($guardian_detail->saveAttributes(array('is_delete'=>1))){
										//Remove primary contact
										$students = Students::model()->findAllByAttributes(array('parent_id'=>$guardian_detail->id));
										if($students){
											foreach($students as $student){
												$student->saveAttributes(array('parent_id'=>0));
											}
										}
										
										//Remove Immidiate contact
										$students = Students::model()->findAllByAttributes(array('immediate_contact_id'=>$guardian_detail->id));
										if($students){
											foreach($students as $student){
												$student->saveAttributes(array('immediate_contact_id'=>0));
											}
										}
										//Remove guardian relation
										$guardian_lists = GuardianList::model()->findAllByAttributes(array('guardian_id'=>$guardian_detail->id));
										if($guardian_lists){
											foreach($guardian_lists as $guardian_list){
												$guardian_list->delete();
											}
										}
										//Remove guardian user
										if($guardian_detail->uid != 0 or $guardian_detail->uid != NULL or $guardian_detail->uid != ''){
											if($guardian_detail->saveAttributes(array('uid'=>0))){
												$guardian_user = User::model()->findByPk($guardian_detail->uid);
												if($guardian_user){									
													$guardian_user->delete();							
												}
												$guardian_profile = Profile::model()->findByAttributes(array('user_id'=>$guardian_detail->uid));
												if($guardian_profile){
													$guardian_profile->delete();
												}
											}											
										}
									}
								}
							}						
						}
					}
					//Remove student-guardian relation
					$guardian_lists = GuardianList::model()->findAllByAttributes(array('student_id'=>$data));
					if($guardian_lists){
						foreach($guardian_lists as $guardian_list){
							$guardian_list->delete();
						}
					}															
				}								
			}
	   		echo CJSON::encode(array('status'=>'success'));
			exit;		  
		}
		else{
			echo CJSON::encode(array('status'=>'error'));
			exit;
		}
	}
	
	//end sele student in student list
	public function actionAssesments()
	{
		$model=new Students;
			$this->render('assesments',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));

	}
	public function actionAttentance()
	{
		if(Configurations::model()->studentAttendanceMode() != 2){	
			$model=new Students;
			$this->render('attentance',array(
				'model'=>$this->loadModel($_REQUEST['id']),
			));
		}
		else{
			$this->redirect(array('studentAttentance/subwiseattentance', 'id'=>$_REQUEST['id']));
		}
	}
	public function actionElectives()
	{
		$model=new Students;
			$this->render('electives',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));

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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Performs the Advance search.
	 * By Rajith
	 */
	 public function actionManage()
	 {
		 if(Yii::app()->user->year)
		{
			$year = Yii::app()->user->year;
		}
		else
		{
			$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
			$year = $current_academic_yr->config_value;
		}
		
		$model=new Students;
		$criteria = new CDbCriteria;		
		$criteria->condition='t.is_deleted=:is_del';
		$criteria->params = array(':is_del'=>0);
		if(isset($_REQUEST['val']))
		{
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :match or t.last_name LIKE :match or t.middle_name LIKE :match)';		 
		 $criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
		{
		if((substr_count( $_REQUEST['name'],' '))==0)
		 { 	
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name or t.last_name LIKE :name or t.middle_name LIKE :name)';
		 $criteria->params[':name'] = $_REQUEST['name'].'%';
		}
		else if((substr_count( $_REQUEST['name'],' '))>=1)
		{
		 $name=explode(" ",$_REQUEST['name']);
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name or t.last_name LIKE :name or t.middle_name LIKE :name)';
		 $criteria->params[':name'] = $name[0].'%';
		 $criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name1 or t.last_name LIKE :name1 or t.middle_name LIKE :name1)';
		 $criteria->params[':name1'] = $name[1].'%';
		 	
		}
		}
		
		
		if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
		{
		 $criteria->condition=$criteria->condition.' and '.'t.admission_no LIKE :admissionnumber';
		 $criteria->params[':admissionnumber'] = $_REQUEST['admissionnumber'].'%';
		}
		
		//For Roll number & batch
		if((isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL) or (isset($_REQUEST['rollnumber']) and $_REQUEST['rollnumber']!=NULL))
		{
			
			if($_REQUEST['Students']['batch_id'] != NULL and $_REQUEST['rollnumber'] != NULL){
				$criteria->join			= 'JOIN `batch_students` `t1` ON `t`.`id` = `t1`.`student_id`'; 
				$criteria->condition	= $criteria->condition.' and (`t1`.`status`=:batch_status and `t1`.`result_status`=:result_status and `t1`.`batch_id`=:batch_id and `t1`.`roll_no`=:roll_no)';
				$criteria->params[':batch_status']	= 1;
				$criteria->params[':result_status']	= 0;
				$criteria->params[':batch_id']		= $_REQUEST['Students']['batch_id'];
				$criteria->params[':roll_no']		= $_REQUEST['rollnumber'];
				
			}
			else if($_REQUEST['Students']['batch_id'] != NULL){
				$criteria->join			= 'JOIN `batch_students` `t1` ON `t`.`id` = `t1`.`student_id`'; 
				$criteria->condition	= $criteria->condition.' and (`t1`.`status`=:batch_status and `t1`.`result_status`=:result_status and `t1`.`batch_id`=:batch_id)';
				$criteria->params[':batch_status']	= 1;
				$criteria->params[':result_status']	= 0;
				$criteria->params[':batch_id']		= $_REQUEST['Students']['batch_id'];								
			}
			else if($_REQUEST['rollnumber'] != NULL){
				$criteria->join			= 'JOIN `batch_students` `t1` ON `t`.`id` = `t1`.`student_id` JOIN `batches` `t2` ON `t2`.`id` = `t1`.`batch_id`'; 
				$criteria->condition	= $criteria->condition.' and (`t1`.`status`=:batch_status and `t1`.`result_status`=:result_status and `t1`.`roll_no`=:roll_no and `t2`.`is_active`=:is_active and `t2`.`is_deleted`=:is_deleted)';
				$criteria->params[':batch_status']	= 1;
				$criteria->params[':result_status']	= 0;				
				$criteria->params[':roll_no']		= $_REQUEST['rollnumber'];
				$criteria->params[':is_active']		= 1;
				$criteria->params[':is_deleted']	= 0;
				
			}						
		}
		
		if(isset($_REQUEST['Students']['gender']) and $_REQUEST['Students']['gender']!=NULL)
		{
			$model->gender = $_REQUEST['Students']['gender'];
			$criteria->condition=$criteria->condition.' and '.'t.gender = :gender';
		    $criteria->params[':gender'] = $_REQUEST['Students']['gender'];
		}
		
		if(isset($_REQUEST['Students']['blood_group']) and $_REQUEST['Students']['blood_group']!=NULL)
		{
			$model->blood_group = $_REQUEST['Students']['blood_group'];
			$criteria->condition=$criteria->condition.' and '.'t.blood_group = :blood_group';
		    $criteria->params[':blood_group'] = $_REQUEST['Students']['blood_group'];
		}
		
		if(isset($_REQUEST['Students']['country_id']) and $_REQUEST['Students']['country_id']!=NULL)
		{
			$model->country_id = $_REQUEST['Students']['country_id'];
			$criteria->condition=$criteria->condition.' and '.'t.country_id = :country_id';
		    $criteria->params[':country_id'] = $_REQUEST['Students']['country_id'];
		}
		
		
		if(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']!=NULL)
		{
			  
			  $model->dobrange = $_REQUEST['Students']['dobrange'] ;
			  if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
			  {
				  if($_REQUEST['Students']['dobrange']=='2')
				  {  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'t.date_of_birth = :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  if($_REQUEST['Students']['dobrange']=='1')
				  {  
				  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'t.date_of_birth < :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  if($_REQUEST['Students']['dobrange']=='3')
				  {  
					  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
					  $criteria->condition=$criteria->condition.' and '.'t.date_of_birth > :date_of_birth';
					  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']==NULL)
		{
			  if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
			  {
				  $model->date_of_birth = $_REQUEST['Students']['date_of_birth'];
				  $criteria->condition=$criteria->condition.' and '.'t.date_of_birth = :date_of_birth';
				  $criteria->params[':date_of_birth'] = date('Y-m-d',strtotime($_REQUEST['Students']['date_of_birth']));
			  }
		}
		
		
		if(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']!=NULL)
		{
			  
			  $model->admissionrange = $_REQUEST['Students']['admissionrange'] ;
			  if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  {
				  if($_REQUEST['Students']['admissionrange']=='2')
				  {  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'t.admission_date = :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  if($_REQUEST['Students']['admissionrange']=='1')
				  {  
				  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'t.admission_date < :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  if($_REQUEST['Students']['admissionrange']=='3')
				  {  
					  $model->admission_date = $_REQUEST['Students']['admission_date'];
					  $criteria->condition=$criteria->condition.' and '.'t.admission_date > :admission_date';
					  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
				  }
				  
			  }
		}
		elseif(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']==NULL)
		{
			  if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  {
				  $model->admission_date = $_REQUEST['Students']['admission_date'];
				  $criteria->condition=$criteria->condition.' and '.'t.admission_date = :admission_date';
				  $criteria->params[':admission_date'] = date('Y-m-d',strtotime($_REQUEST['Students']['admission_date']));
			  }
		}
		
		if(isset($_REQUEST['Students']['status']) and $_REQUEST['Students']['status']!=NULL)
		{			
			$model->status = $_REQUEST['Students']['status'];
			if($_REQUEST['Students']['status'] != 'all'){
				$criteria->condition =  $criteria->condition.' and t.is_active=:status';			
				$criteria->params[':status'] = $_REQUEST['Students']['status'];
			}
		}else{
			$criteria->condition =  $criteria->condition.' and t.is_active=:status';	
			$criteria->params[':status'] = 1;
		}
		
		//accademic status check 
		if(isset($_REQUEST['Students']['academic_yr']))
		{
			$model->academic_yr = $_REQUEST['Students']['academic_yr'];
		}
		if(!isset($_REQUEST['Students']['academic_yr']) or $_REQUEST['Students']['academic_yr']==NULL)
		{
			$model->academic_yr = $_REQUEST['Students']['academic_yr'];
			$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
			$students	=array();
			foreach($batch_stu as $stu)
			{
				$students[]	=	$stu->student_id;
			}
			$criteria->addInCondition('t.id',$students);
		}
		else{
			$criteria->condition =  $criteria->condition.' and t.is_active=:status';	
			$criteria->params[':status'] = 1;
		}
		//end
		$criteria->order = 't.first_name ASC';
		
                $page_size  =   60;
                if(isset($_REQUEST['size']) && $_REQUEST['size']!=NULL)
                {
                    $page_size  =   $_REQUEST['size'];
                }
                
		$students_list = Students::model()->findAll($criteria);

		$total = Students::model()->count($criteria);
		$pages = new CPagination($total);
                $pages->setPageSize($page_size);
                $pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
		
		
		if(isset($_GET['print'])){
			$student 	= Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
			$filename 	= 'student-list.pdf';		
			Yii::app()->osPdf->generate("application.modules.students.views.students.studentpdf", $filename, array('students'=>$students_list));
		}
		else{
			$this->render('manage',array('model'=>$model,
				'list'=>$posts,
				'pages' => $pages,
				'item_count'=>$total,
				'page_size'=>$page_size
			));
		}
	 }
	public function actionIndex()
	{
		if(Yii::app()->user->year)
		{
			$year = Yii::app()->user->year;
		}
		else
		{
			$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
			$year = $current_academic_yr->config_value;
		}	
		
		$criteria = new CDbCriteria; 
		$criteria->compare('is_deleted',0);
		$criteria->condition = 'is_active=:is_active and is_deleted = :is_deleted';
		$criteria->params = array(':is_active'=>1,'is_deleted'=>0);
		//accademic status check
		$batch_stu = BatchStudents::model()->findAllByAttributes(array('result_status'=>0,'status'=>1,'academic_yr_id'=>$year));
                $students	=array();
                foreach($batch_stu as $stu)
                {
                        $students[]	=	$stu->student_id;
                }
                $criteria->addInCondition('id',$students);
		//end
		$total = Students::model()->count($criteria);
		$criteria->order = 'id DESC';
		$criteria->limit = '10';
		$posts = Students::model()->findAll($criteria);
		
		$this->render('index',array(
			'total'=>$total,'list'=>$posts
		));
	}
	
	public function actionSavesearch()
	{
		$dataProvider=new CActiveDataProvider('Students');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	public function actionPayfees()
	{
		$list  = FinanceFees::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$list->fees_paid = $_REQUEST['fees'];
		$list->is_paid = 1;
		$list->save();
		$this->redirect(array('fees','id'=>$list->student_id));
	}
	public function actionFees($id)
	{
		//$model= new Students;
		$this->render('fees',array(
			'model'=>$this->loadModel($id),
		));
		//$this->render('fees',array('model'=>$model));
	}
	public function actionEvents()
	{
		$this->render('events');
	}
	
	public function actionAdd() {
		
		if (isset($_POST['title'])) {
			$data[MENU_TITLE] = trim($_POST['title']);
			if (!empty($data[MENU_TITLE])) {
				$data[MENU_URL] = $_POST['url'];
				$data[MENU_CLASS] = $_POST['class'];
				$data[MENU_GROUP] = $_POST['group_id'];
				$data[MENU_POSITION] = Menu::model()->get_last_position($_POST['group_id']);
				$data[MENU_POSITION] = $data[MENU_POSITION]+1;
				if (Menu::model()->insert(MENU_TABLE, $data)) {
					$data[MENU_ID] = $this->db->Insert_ID();
					$response['status'] = 1;
					$li_id = 'menu-'.$data[MENU_ID];
					$response['li'] = '<li id="'.$li_id.'" class="sortable">'.Menu::model()->get_label($data).'</li>';
					$response['li_id'] = $li_id;
				} else {
					$response['status'] = 2;
					$response['msg'] = Yii::t('app','Add menu error.');
				}
			} else {
				$response['status'] = 3;
			}
			echo 'eee';
			header('Content-type: application/json');
			echo json_encode($response);
		}
	}
	public function actionWebsite()
	{
		$group_id = 1;
		if (isset($_GET['group_id'])) {
			$group_id = (int)$_GET['group_id'];
		}
		$menu = Menu::model()->get_menu($group_id);
		$data['menu_ul'] = '<ul id="easymm"></ul>';
		if ($menu) {

			include 'includes/tree.php';
			$tree = new Tree;

			foreach ($menu as $row) {
				$tree->add_row(
					$row[MENU_ID],
					$row[MENU_PARENT],
					' id="menu-'.$row[MENU_ID].'" class="sortable"',
					Menu::model()->get_label($row)
				);
			}

			$data['menu_ul'] = $tree->generate_list('id="easymm"');
		}
		$data['group_id'] = $group_id;
		$data['group_title'] = Menu::model()->get_menu_group_title($group_id);
		$data['menu_groups'] = Menu::model()->get_menu_groups();
		//$this->view('menu', $data);
		$this->render('website',$data);
	}
	
	public function actionBatch()
	{				
                //$data=Batches::model()->findAll('course_id=:id AND is_deleted=:x AND is_active=:y', array(':id'=>(int) $_POST['cid'],':x'=>'0',':y'=>1));                                  
                $data   = Batches::model()->findAllByAttributes(array('course_id'=>(int) $_POST['cid'],'is_deleted'=>0,'is_active'=>1),array('order'=>'name ASC'));  
		$batch_label = Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");		  
		echo CHtml::tag('option', array('value' => 0), CHtml::encode(Yii::t('app','Select')." ".$batch_label), true);
 
         $data=CHtml::listData($data,'id','name');
		  foreach($data as $value=>$name)
		  {
			  echo CHtml::tag('option',
						 array('value'=>$value),CHtml::encode($name),true);
		  }
	}
        
        //for delete progressing batch of a student from student profile
        public function actionBatchdelete($id,$sid)
        {            
			$model 			= BatchStudents::model()->findByPk($id);						
			if($model){
				$batch_id	= $model->batch_id;
				$student	= Students::model()->findByPk($model->student_id);
				if($model->delete()){
					if($batch_id == $student->batch_id){
						$student->saveAttributes(array('batch_id'=>NULL));
					}
				}
				$this->redirect(array('courses','id'=>$sid));
			}
			else{                     
				throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
			}
            
        }
        
        //for change status of student batch - list of all status
        public function actionListstatus()
        {
            $model = BatchStudents::model()->findByAttributes(array('id'=>$_REQUEST['id']));     
            if(isset($_POST['BatchStudents']) and $_POST['BatchStudents']['result_status']!=NULL) 
            { 
                $model = BatchStudents::model()->findByPk($_POST['BatchStudents']['id']);    
                $model->result_status = $_POST['BatchStudents']['result_status'];	
				if($_POST['BatchStudents']['result_status'] == 0){
					$model->status	= 1;
				}
				else{
					$model->status	= 0;
				}
				if($model->save())
				{
					echo CJSON::encode(array(
							'status'=>'success',                                					
					));
					exit;
				}
            }
            $this->renderPartial('list_batch',array('model'=>$model),false,true);
        }



        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Students('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Students']))
			$model->attributes=$_GET['Students'];

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
		$model=Students::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
	}
	public function actionSearch()
	{
	
		$model=new Students;
		$criteria = new CDbCriteria;
		 $criteria->condition='first_name LIKE :match or middle_name LIKE :match or last_name LIKE :match';
		 $criteria->params = array(':match' => $_POST['char'].'%');
		  $criteria->order = 'first_name ASC';
		 $total = Students::model()->count($criteria);
		$pages = new CPagination($total);
        $pages->setPageSize(Yii::app()->params['listPerPage']);
        $pages->applyLimit($criteria);  // the trick is here!
		$posts = Students::model()->findAll($criteria);
		
		$emp=new Employees;
		$criteria_1 = new CDbCriteria;
		 $criteria_1->condition='first_name LIKE :match or middle_name LIKE :match or last_name LIKE :match';
		 $criteria_1->params = array(':match' => $_POST['char'].'%');
		 $criteria_1->order = 'first_name ASC';
		 $tot = Employees::model()->count($criteria_1);
		$pages_1 = new CPagination($total);
        $pages_1->setPageSize(Yii::app()->params['listPerPage']);
        $pages_1->applyLimit($criteria_1);  // the trick is here!
		$posts_1 = Employees::model()->findAll($criteria_1);
		
		 
		$this->render('search',array('model'=>$model,
		'list'=>$posts,
		'posts'=>$posts_1,
		'pages' => $pages,
		'item_count'=>$total,
		'page_size'=>10,)) ;
		
		//$stud = Students::model()->findAll('first_name LIKE '.$_POST['char']);
		//echo count($stud);
		//exit;
	//print_r($_POST);	
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='students-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionInactive()
	{
		$model		 = Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
		$batch_stu	 = BatchStudents::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
		foreach($batch_stu as $batch_s){
			$batch_s->roll_no=NULL;
			$batch_s->save();
		}
		$model->saveAttributes(array('is_active'=>'0'));
		//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
		ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'5',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
		if($model->uid and $model->uid!=NULL and $model->uid!=0)
		{
			$user = User::model()->findByPk($model->uid); // Making student user inactive
			if($user!=NULL and $user->status == 1){
				$user->saveAttributes(array('status'=>'0'));
			}
		}
		
		/*$guardian = Guardians::model()->findByAttributes(array('ward_id'=>$_REQUEST['sid']));
		if($guardian)
		{
				if($guardian->uid and $guardian->uid!=NULL and $guardian->uid!=0){
					$parent_user = User::model()->findByPk($guardian->uid); // Making parent user inactive
					$parent_user->saveAttributes(array('status'=>'0'));
				}
		}*/
		
		//Make Parent inactive		
		$guardians = GuardianList::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
		if($guardians){						
			foreach($guardians as $guardian){
				$guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
				if($guardian_detail!=NULL and $guardian_detail->uid != 0){
					$criteria = new CDbCriteria;		
					$criteria->join = 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
					$criteria->condition = 't1.guardian_id=:guardian_id and t.is_active=:is_active';
					$criteria->params = array(':guardian_id'=>$guardian_detail->id,':is_active'=>1);
					$active_students = Students::model()->findAll($criteria);
					
					if($active_students == NULL){
						$guardian_user = User::model()->findByPk($guardian_detail->uid);
						if($guardian_user!=NULL and $guardian_user->status == 1){
							$guardian_user->saveAttributes(array('status'=>0));										
						}
						$guardian_detail->saveAttributes(array('is_delete'=>1));
					}
				}
			}
		}
		
		
		$this->redirect(array('/courses/batches/batchstudents','id'=>$_REQUEST['id']));
	}
	
	public function actionActive()
	{
		$model = Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
		$model->saveAttributes(array('is_active'=>'1'));
		
		//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
		ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'6',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
		if($model->uid and $model->uid!=NULL and $model->uid!=0)
		{
			$user = User::model()->findByPk($model->uid); // Making student user active
			if($user!=NULL and $user->status == 0){
				$user->saveAttributes(array('status'=>'1'));
			}
		}
		
		/*$guardian = Guardians::model()->findByAttributes(array('ward_id'=>$_REQUEST['sid']));
		
		if($guardian->uid and $guardian->uid!=NULL and $guardian->uid!=0)
		{
			$parent_user = User::model()->findByPk($guardian->uid); // Making parent user active
			$parent_user->saveAttributes(array('status'=>'1'));
		}*/
		
		// Making parent user active
		$guardians = GuardianList::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
		if($guardians){						
			foreach($guardians as $guardian){
				$guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
				if($guardian_detail!=NULL and $guardian_detail->is_delete == 1){
					$guardian_detail->saveAttributes(array('is_delete'=>0));
				}
				if($guardian_detail!=NULL and $guardian_detail->uid != 0){
					$guardian_user = User::model()->findByPk($guardian_detail->uid);
					if($guardian_user!=NULL and $guardian_user->status == 0){
						$guardian_user->saveAttributes(array('status'=>1));										
					}								
				}
			}
		}
		$this->redirect(array('/courses/batches/batchstudents','id'=>$_REQUEST['id']));
	}
	
	public function actionDeletes()
	{
		if(Yii::app()->request->isPostRequest){
			$model = Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
			$model->saveAttributes(array('is_active'=>0, 'is_deleted'=>1));
			//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
			ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'7',$model->id,ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name),NULL,NULL,NULL);
			
			if($model->uid and $model->uid!=NULL and $model->uid!=0) // Deleting student user
			{
				$user = User::model()->findByPk($model->uid);
				if($user)
				{
					if($user->status == 1){
						$user->saveAttributes(array('status'=>0));
					}
				}
			}
			//remove guardian			
			$guardians = GuardianList::model()->findAllByAttributes(array('student_id'=>$_REQUEST['sid']));
			if($guardians){						
				foreach($guardians as $guardian){
					$guardian_detail = Guardians::model()->findByAttributes(array('id'=>$guardian->guardian_id));
					if($guardian_detail!=NULL and $guardian_detail->uid != 0){
						$criteria = new CDbCriteria;		
						$criteria->join = 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
						$criteria->condition = 't1.guardian_id=:guardian_id and t.is_active=:is_active and is_deleted=:is_deleted';
						$criteria->params = array(':guardian_id'=>$guardian_detail->id,':is_active'=>1,'is_deleted'=>0);
						$active_students = Students::model()->findAll($criteria);
						
						if($active_students == NULL){
							$guardian_user = User::model()->findByPk($guardian_detail->uid);
							if($guardian_user!=NULL){									
								$guardian_user->saveAttributes(array('status'=>'0'));							
							}
							$guardian_detail->saveAttributes(array('is_delete'=>1));
						}
					}
					
				}
			}
			$examscores = ExamScores::model()->DeleteAllByAttributes(array('student_id'=>$_REQUEST['sid']));
			$this->redirect(array('/courses/batches/batchstudents','id'=>$_REQUEST['id']));
			}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
	
	public function actionDocument()
	{
		$this->render('document',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));
	}
	
	public function actionCourses()
	{
		$this->render('courses',array(
			'model'=>$this->loadModel($_REQUEST['id']),
		));
	}
	
	public function actionRemoveelective()
	{
		if(Yii::app()->request->isPostRequest){
			if(isset($_REQUEST['elective']) and ($_REQUEST['elective']!=NULL))
			{
			$elective	=	StudentElectives::model()->findByPk($_REQUEST['elective']);
			$subject	=	Subjects::model()->findByAttributes(array('elective_group_id'=>$elective->elective_group_id));
			$exams		=	Exams::model()->findAllByAttributes(array('subject_id'=>$subject->id));
			foreach($exams as $exam)
			{
				
				$examscr = ExamScores::model()->deleteAllByAttributes(array('exam_id'=>$exam->id,'student_id'=>$_REQUEST['id']));
			}
			$StudentElectives = StudentElectives::model()->deleteAllByAttributes(array('id'=>$_REQUEST['elective']));
			
			
			
			$this->redirect(array('/students/students/electives','id'=>$_REQUEST['id']));
			}
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
	public function actionLog()
	{
		
		$criteria = new CDbCriteria;
		$criteria->order = 'date DESC';
		$criteria->condition='user_id=:x AND user_type=:type';
		$criteria->params = array(':x'=>$_REQUEST['id'],':type'=>1);
		$model1 = new LogComment;
		$total = LogComment::model()->count($criteria); // Count feeds
		$pages = new CPagination($total);
		$pages->setPageSize(Yii::app()->params['listPerPage']);
		$pages->applyLimit($criteria);
		
		$feeds = LogComment::model()->findAll($criteria); // Get feeds
		$this->render('log',array(
			'model'=>$this->loadModel($_REQUEST['id']),
			'model1'=>$model1,
			'comments'=>$feeds,
			'pages'=>$pages,
			'criteria'=>$criteria,
			
			
			));
	}
	public function actionachievements()
	{
		
		$model1 = new Achievements;
		$this->render('achievements',array(
			'model'=>$this->loadModel($_REQUEST['id']),
			'model1'=>$model1,
			'comments'=>$feeds,
			'pages'=>$pages,
			'criteria'=>$criteria,
			
			
			));
	}
	public function actionFlags()
	{
		$this->renderPartial('flags',array('id'=>$_REQUEST['id']),false,true);
	}
	
	public function actionTest(){
		$model = new Students;
		if(!empty($_POST)){
			$model->attributes = $_POST['Students'];
			$model->date_of_birth = $_POST['date_of_birth'];
			var_dump($model->attributes);exit;
			$model->validate();
		}
		$this->render('test',array('model'=>$model));
	}
	
}
