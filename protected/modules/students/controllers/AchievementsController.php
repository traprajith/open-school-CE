<?php

class AchievementsController extends RController
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
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
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCreate()
	{
		$model=new Achievements;
		$flag = 1;
		
		$obj_img			=	 CUploadedFile::getInstance($model,'file');
		if($obj_img!=NULL){
			$file_name = DocumentUploads::model()->getFileName($obj_img);		
		}
				
		$valid_file_types = array('image/jpeg','image/png','application/pdf','application/msword','text/plain','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.wordprocessingml.document'); // Creating the array of valid file types
		$files_not_saved = '';
		if(isset($_POST['Achievements']))
		{ 
			$list                       =  $_POST['Achievements'];
			$model->created_by          =  Yii::app()->user->Id;
			$model->user_id             =  $list['user_id'];
			$model->user_type           =  "1";
			$model->achievement_title   =  $list['achievement_title'];
			$model->description         =  $list['description'];
			$model->created_at          =  date('Y-m-d');
			$model->is_deleted          =  "0";
			$model->doc_title           =  $list['doc_title'];
			$extension                  = end(explode('.',$_FILES['Achievements']['name']['file'])); // Get extension of the file
		    $model->file				= $file_name;
			$model->file_type           = $_FILES['Achievements']['type']['file'];
			$file_size                  = $_FILES['Achievements']['size']['file'];
			if($model->user_id!='' and $model->doc_title!='' and $model->file!='' and $model->file_type!='') // Checking if Document name and file is uploaded
				{ 
				
				  if(in_array($model->file_type,$valid_file_types)) // Checking file type
					{
					if($file_size <= 5242880) // Checking file size
					{
						if(!is_dir('uploadedfiles/')) // Creating uploaded file directory
						{
							mkdir('uploadedfiles/');
						}
						if(!is_dir('uploadedfiles/achievement_document/')) // Creating student_document directory
						{
							mkdir('uploadedfiles/achievement_document/');
						}
						if(!is_dir('uploadedfiles/achievement_document/'.$model->user_id)) // Creating student directory for saving the files
						{
							mkdir('uploadedfiles/achievement_document/'.$model->user_id);
						}
						
						$temp_file_loc = $_FILES['Achievements']['tmp_name']['file'];
						$destination_file = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$file_name;
						if(move_uploaded_file($temp_file_loc,$destination_file)) // Saving the files to the folder
						{
							if($model->validate())
							{
							if($model->save()) // Saving the model to database
							{
								if($obj_img!=NULL){	
									DocumentUploads::model()->insertData(6, $model->id, $file_name, 1);	
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
								$files_not_saved = $files_not_saved.', '.$model->file;
								Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File(s) ").$files_not_saved.Yii::t('app'," was not saved to the database. Please try again."));
								continue;
							}
							}
						}
						else // If file not saved to the directory
						{
							$flag = 0;
							$files_not_saved = $files_not_saved.', '.$model->file;
							Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File(s) ").$files_not_saved.Yii::t('app'," was not saved. Please try again."));
							continue;
						}
					}
					else // If file size is too large. Greater than 5 MB
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File size must not exceed 5MB!"));
					}
				  }
				  else
				  {
					  Yii::app()->user->setFlash('errorMessage', Yii::t('app',"Invalid file Type!"));
			      }
			 		
			}
			elseif($model->doc_title=='' and $model->file_type!='') // If document name is empty
			 {
					
					Yii::app()->user->setFlash('errorMessage', Yii::t('app',"Document Name cannot be empty!"));
					//$this->redirect(array('create','model'=>$model,'id'=>$_REQUEST['id']));
			 }
			elseif($model->doc_title!='' and $model->file_type=='') // If file is not selected
			{  
				$flag = 0;
				Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File is not selected!"));
				
				
			}
			elseif($model->user_id=='' and $model->doc_title=='' and $model->file=='' and $model->file_type=='')
			{
				$flag=1;
			}
			
			if($flag == 1) // If no errors, go to next step of the student registration
			{
				//$this->redirect(array('view','id'=>$model->id));
				
					$this->redirect(array('students/achievements','id'=>$_POST['Achievements']['sid']));
				
			}
			else // If errors are present, redirect to the same page
			{
				
					$this->redirect(array('students/achievements','id'=>$_POST['Achievements']['sid']));
				
			}
		}
		
	 $this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionDeletes()
	{
		if(Yii::app()->request->isPostRequest){
			$model=$this->loadModel($_REQUEST['id']);
			$model_id= $model->id;
			$filename= $model->file;
			$model=Achievements::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
			$destination_file = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$model->file;
			
			if(file_exists($destination_file))
			{ 
				if(unlink($destination_file))
				{
					if($model->delete())
					{
						//delete entry from document upload - admin approve/reject
						DocumentUploads::model()->deleteDocument(6, $model_id, $filename);
					}
					Yii::app()->user->setFlash('successMessage', Yii::t('app',"Document deleted successfully!"));	
				}
			}
			$this->redirect(array('students/achievements','id'=>$_REQUEST['student_id']));
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request'));
	}
	public function actionDownload()
	{
		$model=Achievements::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$file_path = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$model->file;
		$file_content = file_get_contents($file_path);
		$model->doc_title = str_replace(' ','',$model->doc_title);
		header("Content-Type: ".$model->file_type);
		header("Content-disposition: attachment; filename=".$model->file);
		header("Pragma: no-cache");
		echo $file_content;
		exit;
	}
	public function loadModel($id)
	{
		$model=Achievements::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('app','The requested page does not exist.'));
		return $model;
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
	public function actionUpdate()
	{
	  
		$model=Achievements::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		
		$old_model = $model->attributes;
		$old_file_name = $model->file;
		
		$flag = 1;
		$valid_file_types = array('image/jpeg','image/png','application/pdf','application/msword','text/plain','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.wordprocessingml.document'); // Creating the array of valid file types
		$files_not_saved = '';
		if(isset($_POST['Achievements']))
		{ 						
		    $model=Achievements::model()->findByAttributes(array('id'=>$_POST['Achievements']['did']));
			$obj_img			=	 CUploadedFile::getInstance($model,'file');
			if($obj_img!=NULL){
				$file_name = DocumentUploads::model()->getFileName($obj_img);
			}
		    $list                       =  $_POST['Achievements'];
			$model->user_id             =  $list['user_id'];
			$model->achievement_title   =  $list['achievement_title'];
			$model->description         =  $list['description'];
			$model->created_at          =  date('Y-m-d');
			$model->doc_title           =  $list['doc_title'];
			
			if($model->user_id!='' and $model->doc_title!='') // Checking if Document name and file is uploaded
				{
					
				if($_FILES['Achievements']['name']['file']!=NULL)
				{
					$extension                  = end(explode('.',$_FILES['Achievements']['name']['file'])); // Get extension of the file
					$model->file                = $file_name;
					$model->file_type           = $_FILES['Achievements']['type']['file'];
					$file_size                  = $_FILES['Achievements']['size']['file'];
				  if(in_array($model->file_type,$valid_file_types)) // Checking file type
					{
					if($file_size <= 5242880) // Checking file size
					{
						if(!is_dir('uploadedfiles/')) // Creating uploaded file directory
						{
							mkdir('uploadedfiles/');
						}
						if(!is_dir('uploadedfiles/achievement_document/')) // Creating student_document directory
						{
							mkdir('uploadedfiles/achievement_document/');
						}
						if(!is_dir('uploadedfiles/achievement_document/'.$model->user_id)) // Creating student directory for saving the files
						{
							mkdir('uploadedfiles/achievement_document/'.$model->user_id);
						}
						
						$temp_file_loc = $_FILES['Achievements']['tmp_name']['file'];
						$destination_file = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$file_name;
						if(move_uploaded_file($temp_file_loc,$destination_file)) // Saving the files to the folder
						{
						
						    $flag = 1;
						}
						else // If file not saved to the directory
						{
							$flag = 0;								
						    Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File ").$file_name.Yii::t('app'," was not saved. Please try again."));
						}
					}
					else // If file size is too large. Greater than 5 MB
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage', Yii::t('app',"File size must not exceed 5MB!"));
					}
				  }
				 else // If file type is not valid
					{
						$flag = 0;
						 Yii::app()->user->setFlash('errorMessage', Yii::t('app',"Invalid file Type!"));
					}
					
			  }
			  else // No files selected
				{
					if($old_model['file']!=NULL and $list['new_file_field']==1)
					{
						$flag = 0;
						Yii::app()->user->setFlash('errorMessage', Yii::t('app',"No file selected!"));
					}
					
				}
			}
			else // No title entered
			{
				$flag = 0;
				Yii::app()->user->setFlash('errorMessage', Yii::t('app',"Document Name cannot be empty!"));
			}
						
			if($flag == 1) // If no errors, go to next step of the student registration
			{ 
				
				if($model->save())
				{
					if($obj_img!=NULL)
					{	
						DocumentUploads::model()->insertData(6, $model->id, $file_name, 1, $old_file_name);	
					}
					if($_FILES['Achievements']['name']['file']!=NULL)
					{
						$old_destination_file = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$old_file_name;	
						if(file_exists($old_destination_file))
						{
							unlink($old_destination_file);
						}
					}
					$this->redirect(array('students/achievements','id'=>$_POST['Achievements']['eid']));
				}
				else
				{
					
					Yii::app()->user->setFlash('errorMessage', Yii::t('app',"Cannot update the document now. Try again later."));
					$this->redirect(array('update','id'=>$model->id,'student_id'=>$_POST['Achievements']['eid']));
				}

				
			}
			else // If errors are present, redirect to the same page
			{
				$this->redirect(array('update','id'=>$model->id,'student_id'=>$_POST['Achievements']['eid']));
			}
		}
		
		$this->render('update',array(
			'model'=>$model,'student_id'=>$_REQUEST['student_id']
		));
	
	
	}

	
}