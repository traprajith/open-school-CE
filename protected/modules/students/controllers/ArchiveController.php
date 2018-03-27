<?php
class ArchiveController extends RController
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
//Student Archive managemnet
	public function actionStudents()
	{
		$criteria							= new CDbCriteria;
		$criteria->condition 				= 'is_deleted=:is_deleted AND type=:type';
		$criteria->params[':is_deleted']	= 1;
		$criteria->params[':type']			= 0;
		
		if(isset($_REQUEST['val'])){
			$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :match OR last_name LIKE :match OR middle_name LIKE :match)';			
			$criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL){
			if((substr_count( $_REQUEST['name'],' '))==0){ 	
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name OR last_name LIKE :name OR middle_name LIKE :name)';
				$criteria->params[':name'] 	= $_REQUEST['name'].'%';
			}
			else if((substr_count( $_REQUEST['name'],' '))>=1){
				$name						= explode(" ",$_REQUEST['name']);
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name OR last_name LIKE :name OR middle_name LIKE :name)';
				$criteria->params[':name']  = $name[0].'%';
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name1 OR last_name LIKE :name1 OR middle_name LIKE :name1)';
				$criteria->params[':name1'] = $name[1].'%';			
			}
		}
		
		if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL){
			$criteria->condition					= $criteria->condition.' AND '.'admission_no LIKE :admissionnumber';
			$criteria->params[':admissionnumber'] 	= $_REQUEST['admissionnumber'].'%';
		}
		
		if(isset($_REQUEST['email']) and $_REQUEST['email']!=NULL){
			$criteria->condition			= $criteria->condition.' AND '.'email=:email';
			$criteria->params[':email'] 	= $_REQUEST['email'];
		}
		
		if(isset($_REQUEST['phone_no']) and $_REQUEST['phone_no']!=NULL){
			$criteria->condition			= $criteria->condition.' AND '.'phone1=:phone1';
			$criteria->params[':phone1'] 	= $_REQUEST['phone_no'];
		}
				
		$criteria->order = 'first_name ASC';
				
		$total 	= Students::model()->count($criteria);
		$pages 	= new CPagination($total);
		$pages->setPageSize(20);
		$pages->applyLimit($criteria);  
		$students = Students::model()->findAll($criteria);
		//In case of restore btn click
		
		if(isset($_POST) and ($_POST['restore_btn'] or isset($_REQUEST['flag']))){
			if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of single restore
				$student_ids = array($_REQUEST['id']);
			}
			if(isset($_POST['student_id']) and $_POST['student_id']!=NULL){ //In case of common restore
				$student_ids = $_POST['student_id'];
			}			
			if(count($student_ids) > 0){
				$restore_success 	= 0;				
				$restore_failed		= array();
				for($i = 0; $i < count($student_ids); $i++){
					$email_flag		= 0;
					$phone_flag		= 0;					
					$model 			= Students::model()->findByPk($student_ids[$i]);					
					$is_email_exist	= Students::model()->checkEmailDuplicate('student', $student_ids[$i]);
					$is_phone_exist	= Students::model()->checkPhoneDuplicate('student', $student_ids[$i]);
					
					if($is_email_exist == NULL and $is_phone_exist == NULL){
						if($model->saveAttributes(array('is_active'=>1, 'is_deleted'=>0))){
							$restore_success = $restore_success + 1;
						}
					}
					else{						
						if($is_email_exist){
							$email_flag = 1;
						}
						if($is_phone_exist){
							$phone_flag = 1;
						}
						$restore_failed[] = array('name'=>$model->studentFullName('forStudentProfile'), 'email'=>$email_flag, 'phone'=>$phone_flag);	
					}
				}
				
				Yii::app()->user->setFlash('success', $restore_success.' '.Yii::t('app','Student(s) Restored'));
				if(count($restore_failed) > 0){
					Yii::app()->user->setFlash('error', Yii::t('app','Restore action failed for the following student(s):'));
					for($i = 0; $i < count($restore_failed); $i++){
						$error_msg = '';						
						if($restore_failed[$i]['email'] == 1 and $restore_failed[$i]['phone'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Students::model()->getAttributeLabel('email').' & '.Students::model()->getAttributeLabel('phone1').' '.Yii::t('app','already in use');							
						}
						elseif($restore_failed[$i]['email'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Students::model()->getAttributeLabel('email').' '.Yii::t('app','already in use');
						}
						elseif($restore_failed[$i]['phone'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Students::model()->getAttributeLabel('phone1').' '.Yii::t('app','already in use');
						}
						if($error_msg){
							Yii::app()->user->setFlash($i, $error_msg);
						}
					}
				}				
			}
			$this->redirect(array('students'));
		}
		 
		$this->render('students', array('students'=>$students, 'pages' => $pages, 'item_count'=>$total, 'page_size'=>20));
	}
	
	//Delete Student Permenantly
	public function actionDeleteStudent()
	{
		if(Yii::app()->request->isPostRequest){
			
			if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL){ //In case of single delete				
				$id		= array($_REQUEST['id']);
			}
			if(isset($_POST['student_id']) and $_POST['student_id']!=NULL){ //In case of common delete
				$id 	= $_POST['student_id']; 	
			}			
			if(count($id) > 0){
				for($i = 0; $i < count($id); $i++){					
					$model 	= Students::model()->findByPk($id[$i]);
					$uid	= $model->uid;
					if($model->delete()){
						//Delete user & profile details
						if($uid != 0){
							$user = User::model()->findByAttributes(array('id'=>$uid));
							if($user){
								$user->delete();
							}
							$profile = Profile::model()->findByAttributes(array('user_id'=>$uid));
							if($profile){
								$profile->delete();
							}					
						}
						//Delete batch relations
						$batch_students	= BatchStudents::model()->findAllByAttributes(array('student_id'=>$id[$i]));
						if($batch_students){
							foreach($batch_students as $batch_student){
								$batch_student->delete();
							}
						}
						//Delete relations
						$guardian_lists = GuardianList::model()->findAllByAttributes(array('student_id'=>$id[$i]));
						if($guardian_lists){
							foreach($guardian_lists as $guardian_list){
								$guardian_list->delete();
							}
						}
						
						//Delete electives
						$electives = StudentElectives::model()->findAllByAttributes(array('id'=>$id[$i]));
						if($electives){
							foreach($electives as $elective){
								$elective->delete();
							}
						}
						//Delete Profile Image
						$dirPath = 'uploadedfiles/student_profile_image/'.$id[$i];
						if (is_dir($dirPath)) {					
							if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
								$dirPath .= '/';
							}
							$files = glob($dirPath . '*', GLOB_MARK);
							foreach ($files as $file) {
								if (is_dir($file)) {
									self::deleteDir($file);
								} else {
									unlink($file);
								}
							}
							rmdir($dirPath);
						}
						//Delete Documents
						$dirPath = 'uploadedfiles/student_document/'.$id[$i];
						if (is_dir($dirPath)) {					
							if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
								$dirPath .= '/';
							}
							$files = glob($dirPath . '*', GLOB_MARK);
							foreach ($files as $file) {
								if (is_dir($file)) {
									self::deleteDir($file);
								} else {
									unlink($file);
								}
							}
							rmdir($dirPath);
						}
					}
				}
			}
			$this->redirect(array('students'));
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}
	
	//Update Student's email & phone
	public function actionUpdateStudent()
	{
		if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL){
			$id = $_REQUEST['id'];
		}
		if(isset($_REQUEST['Students']['id']) and $_REQUEST['Students']['id']!=NULL){
			$id = $_REQUEST['Students']['id'];			
		}
		$model = Students::model()->findByPk($id);
		if(isset($_POST['Students'])){
			$model->email 	= $_POST['Students']['email'];
			$model->phone1	= $_POST['Students']['phone1'];
			if($model->save()){
				if($model->uid != 0){					
					$usr_model	= User::model()->findByPk($model->uid);
					if($usr_model){
						$usr_model->email			= $model->email;						
						$usr_model->mobile_number	= $model->phone1;					
						$usr_model->save();
					}
				}

				echo CJSON::encode(array(
					'status'=>'success',
					'flag'=>true,				
				));
				exit;
			}
			else{
				echo CJSON::encode(array(
					'status'=>'error',
					'errors'=>CActiveForm::validate($model),
				));
				exit;
			}
		}
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('updateStudent', array('model'=>$model), false, true);				
	}

//Guardian Archive management	
	public function actionGuardians()
	{
		$criteria							= new CDbCriteria;
		$criteria->condition 				= 'is_delete=:is_delete';
		$criteria->params[':is_delete']		= 1;
		
		if(isset($_REQUEST['val'])){
			$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :match OR last_name LIKE :match)';			
			$criteria->params[':match'] = $_REQUEST['val'].'%';
		}
		
		if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL){
			if((substr_count( $_REQUEST['name'],' '))==0){ 	
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name OR last_name LIKE :name)';
				$criteria->params[':name'] 	= $_REQUEST['name'].'%';
			}
			else if((substr_count( $_REQUEST['name'],' '))>=1){
				$name						= explode(" ",$_REQUEST['name']);
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name OR last_name LIKE :name)';
				$criteria->params[':name']  = $name[0].'%';
				$criteria->condition		= $criteria->condition.' AND '.'(first_name LIKE :name1 OR last_name LIKE :name1)';
				$criteria->params[':name1'] = $name[1].'%';			
			}
		}		
		
		if(isset($_REQUEST['email']) and $_REQUEST['email']!=NULL){
			$criteria->condition			= $criteria->condition.' AND '.'email=:email';
			$criteria->params[':email'] 	= $_REQUEST['email'];
		}
		
		if(isset($_REQUEST['phone_no']) and $_REQUEST['phone_no']!=NULL){
			$criteria->condition				= $criteria->condition.' AND '.'mobile_phone=:mobile_phone';
			$criteria->params[':mobile_phone'] 	= $_REQUEST['phone_no'];
		}
				
		$criteria->order = 'first_name ASC';
				
		$total 		= Guardians::model()->count($criteria);
		$pages 		= new CPagination($total);
		$pages->setPageSize(20);
		$pages->applyLimit($criteria);  
		$guardians 	= Guardians::model()->findAll($criteria);
		//In case of restore btn click
		if(isset($_POST) and ($_POST['restore_btn'] or isset($_REQUEST['flag']))){
			if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of single restore
				$guardian_ids = array($_REQUEST['id']);
			}
			if(isset($_POST['guardian_id']) and $_POST['guardian_id']!=NULL){ //In case of common restore
				$guardian_ids = $_POST['guardian_id'];
			}	
			if(count($guardian_ids) > 0){				
				$restore_success 	= 0;				
				$restore_failed		= array();
				for($i = 0; $i < count($guardian_ids); $i++){
					$email_flag		= 0;
					$phone_flag		= 0;
					$model = Guardians::model()->findByPk($guardian_ids[$i]);
					$is_email_exist	= Students::model()->checkEmailDuplicate('guardian', $guardian_ids[$i]);
					$is_phone_exist	= Students::model()->checkPhoneDuplicate('guardian', $guardian_ids[$i]);
					if($is_email_exist == NULL and $is_phone_exist == NULL){
						if($model->saveAttributes(array('is_delete'=>0))){
							$restore_success = $restore_success + 1;
						}
					}
					else{						
						if($is_email_exist){
							$email_flag = 1;
						}
						if($is_phone_exist){
							$phone_flag = 1;
						}
						$restore_failed[] = array('name'=>$model->parentFullName('forStudentProfile'), 'email'=>$email_flag, 'phone'=>$phone_flag);	
					}
				}
				
				Yii::app()->user->setFlash('success', $restore_success.' '.Yii::t('app','Guardian(s) Restored'));
				if(count($restore_failed) > 0){
					Yii::app()->user->setFlash('error', Yii::t('app','Restore action failed for the following guardian(s):'));
					for($i = 0; $i < count($restore_failed); $i++){
						$error_msg = '';						
						if($restore_failed[$i]['email'] == 1 and $restore_failed[$i]['phone'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Guardians::model()->getAttributeLabel('email').' & '.Guardians::model()->getAttributeLabel('mobile_phone').' '.Yii::t('app','already in use');							
						}
						elseif($restore_failed[$i]['email'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Guardians::model()->getAttributeLabel('email').' '.Yii::t('app','already in use');
						}
						elseif($restore_failed[$i]['phone'] == 1){
							$error_msg	= $restore_failed[$i]['name'].' : '.Guardians::model()->getAttributeLabel('mobile_phone').' '.Yii::t('app','already in use');
						}
						if($error_msg){
							Yii::app()->user->setFlash($i, $error_msg);
						}
					}
				}					
			}
			$this->redirect(array('guardians'));
		}		 
		$this->render('guardians', array('guardians'=>$guardians, 'pages' => $pages, 'item_count'=>$total, 'page_size'=>20));
	}
	
	//Update Guardian's email & mobile number
	public function actionUpdateGuardian()
	{
		if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL){
			$id = $_REQUEST['id'];
		}
		if(isset($_REQUEST['Guardians']['id']) and $_REQUEST['Guardians']['id']!=NULL){
			$id = $_REQUEST['Guardians']['id'];			
		}
		$model = Guardians::model()->findByPk($id);
		if(isset($_POST['Guardians'])){
			$model->email 			= $_POST['Guardians']['email'];
			$model->mobile_phone	= $_POST['Guardians']['mobile_phone'];
			if($model->save()){
				if($model->uid != 0){					
					$usr_model	= User::model()->findByPk($model->uid);
					if($usr_model){
						$usr_model->email			= $model->email;						
						$usr_model->mobile_number	= $model->mobile_phone;					
						$usr_model->save();
					}
				}

				echo CJSON::encode(array(
					'status'=>'success',
					'flag'=>true,				
				));
				exit;
			}
			else{
				echo CJSON::encode(array(
					'status'=>'error',
					'errors'=>CActiveForm::validate($model),
				));
				exit;
			}
		}
		Yii::app()->clientScript->scriptMap['jquery.js'] = false;
		Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;
		$this->renderPartial('updateGuardian', array('model'=>$model), false, true);				
	}
	
	//Delete Guardian Permenantly
	public function actionDeleteGuardian()
	{
		if(Yii::app()->request->isPostRequest){			
			if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL){ //In case of single delete				
				$id		= array($_REQUEST['id']);
			}
			if(isset($_POST['guardian_id']) and $_POST['guardian_id']!=NULL){ //In case of common delete
				$id 	= $_POST['guardian_id']; 	
			}			
			if(count($id) > 0){
				for($i = 0; $i < count($id); $i++){					
					$model 	= Guardians::model()->findByPk($id[$i]);
					$uid	= $model->uid;
					if($model->delete()){
						//Delete user & profile details
						if($uid != 0){
							$user = User::model()->findByAttributes(array('id'=>$uid));
							if($user){
								$user->delete();
							}
							$profile = Profile::model()->findByAttributes(array('user_id'=>$uid));
							if($profile){
								$profile->delete();
							}					
						}
						
						//Delete relations
						$guardian_lists = GuardianList::model()->findAllByAttributes(array('guardian_id'=>$id[$i]));
						if($guardian_lists){
							foreach($guardian_lists as $guardian_list){
								$guardian_list->delete();
							}
						}
						
						//Remove primary contact
						$students = Students::model()->findAllByAttributes(array('parent_id'=>$id[$i]));
						if($students){
							foreach($students as $student){
								$student->saveAttributes(array('parent_id'=>0));
							}
						}
						
						//Remove Immidiate contact
						$students = Students::model()->findAllByAttributes(array('immediate_contact_id'=>$id[$i]));
						if($students){
							foreach($students as $student){
								$student->saveAttributes(array('immediate_contact_id'=>0));
							}
						}												
					}
				}
			}
			$this->redirect(array('guardians'));
		}
		else{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
	}				
}

?>
