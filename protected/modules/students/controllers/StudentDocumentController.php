<?php

class StudentDocumentController extends RController
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
				'actions'=>array('index','view','notify'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','download','approve','disapprove'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//echo $_POST['StudentDocument']['sid'];exit;
		$model=new StudentDocument;
		$flag = 1;
		$valid_file_types = array('image/jpeg','image/png','application/pdf','application/msword','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
		 // Creating the array of valid file types
		$files_not_saved = '';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['StudentDocument']))
		{
			
			$list = $_POST['StudentDocument'];
			$no_of_documents = count($list['doc_type']); // Counting the number of files uploaded (No of rows in the form)
			
			
			
			for($i=0;$i<$no_of_documents;$i++) //Iterating the documents uploaded
			{
				$obj_img			=	 $_FILES['StudentDocument']['name']['file'][$i];
				
				if($obj_img!=NULL){
				$file_name = DocumentUploads::model()->getFileName($obj_img);
				
				}
			
				
				$model=new StudentDocument;
				$model->student_id = $_POST['StudentDocument']['student_id'][0];
				$model->doc_type = $_POST['StudentDocument']['doc_type'][$i];
				$model->title = $_POST['StudentDocument']['title'][$i];
				$extension = end(explode('.',$_FILES['StudentDocument']['name']['file'][$i])); // Get extension of the file
				//$model->file = $this->generateRandomString(rand(6,10)).'.'.$extension; // Generate random string as filename
				$model->file		=	$file_name;
				$model->file_type = $_FILES['StudentDocument']['type']['file'][$i];
				$model->is_approved = 1;
				$model->uploaded_by = Yii::app()->user->Id;
				$file_size = $_FILES['StudentDocument']['size']['file'][$i];
				if($model->student_id!='' and $model->doc_type!='' and $model->file!='' and $model->file_type!='') // Checking if Document name and file is uploaded
				{
					if(in_array($model->file_type,$valid_file_types)) // Checking file type
					{
						if($file_size <= 5242880) // Checking file size
						{
							if(!is_dir('uploadedfiles/')) // Creating uploaded file directory
							{
								mkdir('uploadedfiles/');
							}
							if(!is_dir('uploadedfiles/student_document/')) // Creating student_document directory
							{
								mkdir('uploadedfiles/student_document/');
							}
							if(!is_dir('uploadedfiles/student_document/'.$model->student_id)) // Creating student directory for saving the files
							{
								mkdir('uploadedfiles/student_document/'.$model->student_id);
							}
							$temp_file_loc = $_FILES['StudentDocument']['tmp_name']['file'][$i];
							$destination_file = 'uploadedfiles/student_document/'.$model->student_id.'/'.$file_name;
							if(move_uploaded_file($temp_file_loc,$destination_file)) // Saving the files to the folder
							{
								
								if($model->save()) // Saving the model to database
								{
									if($obj_img!=NULL){	
									DocumentUploads::model()->insertData(3, $model->id, $file_name, 5);	
									}
									$flag = 1;
								}
								else // If model not saved
								{
									
									$flag = 0;
									if(file_exists($destination_file))
									{
										unlink($destination_file);
									}
									$files_not_saved = $files_not_saved.', '.$file_name;
									Yii::app()->user->setFlash('errorMessage',Yii::t('app','File(s)').' '.$files_not_saved.' '.Yii::t('app','was not saved to the database. Please try again.'));
									continue;
								}
							}
							else // If file not saved to the directory
							{
								$flag = 0;
								$files_not_saved = $files_not_saved.', '.$file_name;
								Yii::app()->user->setFlash('errorMessage',Yii::t('app','File(s)').' '.$files_not_saved.' '.Yii::t('app','was not saved. Please try again.'));
								continue;
							}
						}
						else // If file size is too large. Greater than 5 MB
						{
							$flag = 0;
							Yii::app()->user->setFlash('errorMessage',Yii::t('app','File size must not exceed 5MB!'));
						}
					}
					else // If file type is not valid
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage',Yii::t('app','Only files with these extensions are allowed: jpg, png, pdf, doc, txt.'));
					}
				}
				elseif($model->doc_type=='' and $model->file_type!='') // If document name is empty
				{
					$flag = 0;
					Yii::app()->user->setFlash('errorMessage',Yii::t('app','Document Name cannot be empty!'));
					//$this->redirect(array('create','model'=>$model,'id'=>$_REQUEST['id']));
				}
				elseif($model->doc_type!='' and $model->file_type=='') // If file is not selected
				{
					$flag = 0;
					Yii::app()->user->setFlash('errorMessage',Yii::t('app','File is not selected!'));
					
				}
				elseif($model->student_id=='' and $model->doc_type=='' and $model->file=='' and $model->file_type=='')
				{
					$flag=1;
				}
			}
			if($flag == 1) // If no errors, go to next step of the student registration
			{
				//$this->redirect(array('view','id'=>$model->id));
				if($_POST['StudentDocument']['document']==1)
				{
					$this->redirect(array('students/document','id'=>$_POST['StudentDocument']['sid']));
				}
				else
				{
				
					$this->redirect(array('students/view','id'=>$_POST['StudentDocument']['sid']));
				}
			}
			else // If errors are present, redirect to the same page
			{
				if($_POST['StudentDocument']['document']==1)
				{
					$this->redirect(array('students/document','id'=>$_POST['StudentDocument']['sid']));
				}
				else
				{
					$this->redirect(array('create','id'=>$_POST['StudentDocument']['sid']));
				}
			}
		} // END isset

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{		
		$model=$this->loadModel($_REQUEST['document_id']);//Here $_REQUEST['id'] is student ID and $_REQUEST['document_id'] is document ID
		$old_model = $model->attributes;
		$old_file_name = $model->file;
		$flag = 1; // If 1, no errors. If 0, some error is present.
		$valid_file_types = array('image/jpeg','image/png','application/pdf','application/msword','text/plain'); // Creating the array of valid file types
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['StudentDocument']))
		{
			$obj_img			=	 $_FILES['StudentDocument']['name']['file'][$i];
				if($obj_img!=NULL){
				$file_name = DocumentUploads::model()->getFileName($obj_img);
				}
				
				
			$list = $_POST['StudentDocument'];
			//var_dump($list);exit;
			$model->student_id = $list['student_id'];
			$model->title = $list['title'];
			$model->doc_type = $list['doc_type'];
			if($model->doc_type!=NULL and $model->student_id!=NULL)
			{
				if($_FILES['StudentDocument']['name']['file']!=NULL)
				{
					
					$extension = end(explode('.',$_FILES['StudentDocument']['name']['file'])); // Get extension of the file
					$model->file = $file_name; 
					$model->file_type = $_FILES['StudentDocument']['type']['file'];
					$file_size = $_FILES['StudentDocument']['size']['file'];
					if(in_array($model->file_type,$valid_file_types)) // Checking file type
					{
						if($file_size <= 5242880) // Checking file size
						{
							if(!is_dir('uploadedfiles/')) // Creating uploaded file directory
							{
								mkdir('uploadedfiles/');
							}
							if(!is_dir('uploadedfiles/student_document/')) // Creating student_document directory
							{
								mkdir('uploadedfiles/student_document/');
							}
							if(!is_dir('uploadedfiles/student_document/'.$model->student_id)) // Creating student directory for saving the files
							{
								mkdir('uploadedfiles/student_document/'.$model->student_id);
							}
							$temp_file_loc = $_FILES['StudentDocument']['tmp_name']['file'];
							//echo $temp_file_loc;exit;
							$destination_file = 'uploadedfiles/student_document/'.$model->student_id.'/'.$file_name;
							
							if(move_uploaded_file($temp_file_loc,$destination_file)) // Saving the files to the folder
							{
								$flag = 1;
								
							}
							else // If file not saved to the directory
							{
								$flag = 0;								
								Yii::app()->user->setFlash('errorMessage',Yii::t('app','File').' '.$file_name.' '.Yii::t('app','was not saved. Please try again.'));
							}
						}
						else // If file size is too large. Greater than 5 MB
						{
							$flag = 0;
							Yii::app()->user->setFlash('errorMessage',Yii::t('app','File size must not exceed 5MB!'));
						}
					}
					else // If file type is not valid
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage',Yii::t('app','Only files with these extensions are allowed: jpg, png, pdf, doc, txt.'));
					}
				}
				else // No files selected
				{
					if($old_model['file']!=NULL and $list['new_file_field']==1)
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage',Yii::t('app','No file selected!'));
					}
					
				}
			}
			else // No title entered
			{
				$flag = 0;
				Yii::app()->user->setFlash('errorMessage',Yii::t('app','Document Name cannot be empty!'));
			}
			
			
			if($flag == 1) // Valid data
			{ 
				if($model->save())
				{
					
					if($obj_img!=NULL)
					{	
						DocumentUploads::model()->insertData(3, $model->id, $file_name, 5, $old_file_name);	
					}
									
					if($_FILES['StudentDocument']['name']['file']!=NULL)
					{
						$old_destination_file = 'uploadedfiles/student_document/'.$model->student_id.'/'.$old_model['file'];	
						if(file_exists($old_destination_file))
						{
							unlink($old_destination_file);
						}
					}
					if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){
						$this->redirect(array('/students/studentDocument/create','id'=>$model->student_id));
					}
					else{
						$this->redirect(array('students/document','id'=>$model->student_id));
					}
				}
				else
				{
					
					Yii::app()->user->setFlash('errorMessage',Yii::t('app','Cannot update the document now. Try again later.'));
					$this->redirect(array('update','id'=>$model->student_id,'document_id'=>$_REQUEST['document_id']));
				}
					
			}
			else
			{
				$this->redirect(array('update','id'=>$model->student_id,'document_id'=>$_REQUEST['document_id']));
				/*$this->render('update',array(
					'model'=>$model,'student_id'=>$_REQUEST['id']
				));*/
				
			}
		}

		$this->render('update',array(
			'model'=>$model,'student_id'=>$_REQUEST['id']
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
	
	public function actionDeletes()
	{
		if(Yii::app()->request->isPostRequest){
			$model=$this->loadModel($_REQUEST['id']);
			$model_id= $model->id;
			$filename= $model->file;
			$destination_file = 'uploadedfiles/student_document/'.$model->student_id.'/'.$model->file;
			if(file_exists($destination_file))
			{
				if(unlink($destination_file))
				{
					if($model->delete())
					{					
							//delete entry from document upload - admin approve/reject
							DocumentUploads::model()->deleteDocument(3, $model_id, $filename);					
					}
					Yii::app()->user->setFlash('successMessage',Yii::t('app','Document deleted successfully!'));	
				}
			}
			if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of update from student registration form
				$this->redirect(array('/students/studentDocument/create','id'=>$_REQUEST['student_id']));
			}
			else{
				$this->redirect(array('students/document','id'=>$_REQUEST['student_id']));
			}
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('StudentDocument');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	/**
	* Download Files
	*/
	public function actionDownload()
	{
		$model=$this->loadModel($_REQUEST['id']);
		$file_path = 'uploadedfiles/student_document/'.$model->student_id.'/'.$model->file;
		$file_content = file_get_contents($file_path);
		$model->title = str_replace(' ','',$model->title);
		header("Content-Type: ".$model->file_type);
		header("Content-disposition: attachment; filename=".$model->file);
		header("Pragma: no-cache");
		echo $file_content;
		exit;
	}
	
	/**
	* Approve Document
	*/
	public function actionApprove()
	{
		$model = StudentDocument::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$model->saveAttributes(array('is_approved'=>'1'));
                
		$uploads_model= DocumentUploads::model()->findByAttributes(array('model_id'=>3,'file_id'=>$model->id,'file_name'=>$model->file));
		if($uploads_model!=NULL)
		{
			$uploads_model->status=1;
			$uploads_model->save();
		}
        if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){
			$this->redirect(array('/students/studentDocument/create','id'=>$_REQUEST['student_id']));
		}
		else{        
			$this->redirect(array('students/document','id'=>$_REQUEST['student_id']));
		}
	}
	
	/**
	* Approve Document
	*/
	public function actionDisapprove()
	{
		$model = StudentDocument::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$model->saveAttributes(array('is_approved'=>'-1'));
		
		$uploads_model= DocumentUploads::model()->findByAttributes(array('model_id'=>3,'file_id'=>$model->id,'file_name'=>$model->file));
		if($uploads_model!=NULL){
			$uploads_model->status='2';
			$uploads_model->save();
		}
		if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){
			$this->redirect(array('/students/studentDocument/create','id'=>$_REQUEST['student_id']));
		}
		else{
			$this->redirect(array('students/document','id'=>$_REQUEST['student_id']));
		}
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentDocument('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentDocument']))
			$model->attributes=$_GET['StudentDocument'];

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
		$model=StudentDocument::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-document-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	private function generateRandomString($length = 5) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	public function actionNotify()
	{
		$college=Configurations::model()->findByPk(1);
		$student = Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$notification = NotificationSettings::model()->findByAttributes(array('id'=>19));
		$guardian = Guardians::model()->findByAttributes(array('id'=>$student->parent_id,'is_delete'=>0));
		$doc_lists = StudentDocumentList::model()->findAll();
		$name = '<strong>'.$student->first_name.' '.$student->last_name.'</strong>';
		if($notification->sms_enabled=='1' and $notification->parent_1 == '1') // Checking if SMS is enabled.
		{
			if($guardian->mobile_phone){
				$to = $model->mobile_phone;	
			}
			if($to!=''){ // Send SMS if phone number is provided								
				$from = $college->config_value;
				$template=SystemTemplates::model()->findByPk(35);
				$message = $template->template;				
				SmsSettings::model()->sendSms($to,$from,$message);			
			} // End send SMS
		}
		if($notification->mail_enabled == '1' and $notification->parent_1 == '1')
		{		
			$template=EmailTemplates::model()->findByPk(26);
			$subject = $template->subject;
			$message = $template->template;				
			$subject = str_replace("{{SCHOOL NAME}}",$college->config_value,$subject);																	
			$message = str_replace("{{STUDENT NAME}}",$name,$message);
			if($doc_lists!=NULL){				
				foreach($doc_lists as $list){
					$studentdoc = StudentDocument::model()->findByAttributes(array('student_id'=>$student->id,'doc_type'=>$list->name));					
					if(count($studentdoc)==0){
						$doc = $doc.$list->name.'<br>';												
					}
				}								
			}			
			$message = str_replace("{{DOCUMENT NAME}}",$doc,$message);			
			UserModule::sendMail($guardian->email,$subject,$message);	
			Yii::app()->user->setFlash('successMessage', Yii::t('app','Notification sent successfully'));	
		}
		 $this->redirect(array('/students/students/document','id'=>$_REQUEST['id']));
	}
	
}
