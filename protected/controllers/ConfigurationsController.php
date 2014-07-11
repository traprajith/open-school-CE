<?php

class ConfigurationsController extends RController
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
				'actions'=>array('setup','DisplaySavedImage','Remove','DisplayLogoImage'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
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
	
	public function actionSetup()
	{
		$this->layout = 'no_layout';
		$model = new User;
		if(isset($_POST['User']))
		{
			 //Generating The Salt and hasing the password
		   $salt = $model->generateSalt();
		   $_POST['User']['password'] = $model->hashPassword($_POST['User']['password'],$salt);
		   $_POST['User']['salt'] = $salt;
		   $model->attributes=$_POST['User'];
			if($model->save())
			{
				
					$model=new Configurations;
		            $logo = new Logo;
				$posts_1=Configurations::model()->findByAttributes(array('id'=>1));
			$posts_1->config_value = $_POST['collegename'];
			$posts_1->save();
			
			$posts_2=Configurations::model()->findByAttributes(array('id'=>2));
			$posts_2->config_value = $_POST['address'];
			$posts_2->save();
			
			$posts_3=Configurations::model()->findByAttributes(array('id'=>3));
			$posts_3->config_value = $_POST['phone'];
			$posts_3->save();
			
			$posts_4=Configurations::model()->findByAttributes(array('id'=>4));
			$posts_4->config_value = $_POST['attentance'];
			$posts_4->save();
			
			$posts_5=Configurations::model()->findByAttributes(array('id'=>13));
			$posts_5->config_value = $_POST['startyear'];
			$posts_5->save();
			
			$posts_6=Configurations::model()->findByAttributes(array('id'=>14));
			$posts_6->config_value = $_POST['endyear'];
			$posts_6->save();
			
			$posts_8=Configurations::model()->findByAttributes(array('id'=>5));
			$posts_8->config_value = $_POST['currency'];
			$posts_8->save();
			
			$posts_9=Configurations::model()->findByAttributes(array('id'=>6));
			$posts_9->config_value = $_POST['language'];
			$posts_9->save();
			
			/*$posts_10=Configurations::model()->findByAttributes(array('id'=>6));
			$posts_10->config_value = $_POST['logo'];
			$posts_10->save();*/
			if($file=CUploadedFile::getInstance($logo,'uploadedFile'))
       		 {
			$logo = new Logo;
            $logo->photo_file_name=$file->name;
            $logo->photo_content_type=$file->type;
            $logo->photo_file_size=$file->size;
            $logo->photo_data=file_get_contents($file->tempName);
			if(!is_dir('uploadedfiles/')){
				mkdir('uploadedfiles/');
			}
			if(!is_dir('uploadedfiles/school_logo/')){
				mkdir('uploadedfiles/school_logo/');
			}
			move_uploaded_file($file->tempName,'uploadedfiles/school_logo/'.$file->name);
      		 $logo->save();
			$posts_10=Configurations::model()->findByAttributes(array('id'=>18));
			$posts_10->config_value = Yii::app()->db->getLastInsertId();;
			$posts_10->save();
			 }
			if(isset($_POST['dateformat']) && (isset($_POST['timeformat'])) && isset($_POST['timezone'])&& isset($_POST['language']))
			 {
				 
				 $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				 $date='';
				 if(settings!=NULL)
				 {
				 $settings->user_id=Yii::app()->user->id;
				 $settings->dateformat=$_POST['dateformat'];
					
				 					if($_POST['dateformat']=='m/d/yy')
									$settings->displaydate='m/d/Y';
									else if($_POST['dateformat']=='M d.yy')
									$settings->displaydate='M d.Y';
									else if($_POST['dateformat']=='D, M d.yy')
									$settings->displaydate='D, M d.Y';
									else if($_POST['dateformat']=='d M yy')
									$settings->displaydate='d M Y';
									else if($_POST['dateformat']=='yy/m/d')
									$settings->displaydate='Y/m/d';				
				    $settings->timeformat=$_POST['timeformat'];
				    $settings->timezone=$_POST['timezone'];
				    $settings->language=$_POST['language'];
				 }
				 else
				 {
					  $settings->user_id=Yii::app()->user->id;
				 	  $settings->dateformat=$_POST['dateformat'];
					  if($_POST['dateformat']=='m/d/yy')
									$settings->displaydate='m/d/Y';
									else if($_POST['dateformat']=='M d.yy')
									$settings->displaydate='M d.Y';
									else if($_POST['dateformat']=='D, M d.yy')
									$settings->displaydate='D, M d.Y';
									else if($_POST['dateformat']=='d M yy')
									$settings->displaydate='d M Y';
									else if($_POST['dateformat']=='yy/m/d')
									$settings->displaydate='Y/m/d';
					 
				 	  $settings->timeformat=$_POST['timeformat'];
				      $settings->timezone=$_POST['timezone'];
				      $settings->language=$_POST['language'];
				 }
				 $settings->save();
			 }
			$posts_11=Configurations::model()->findByAttributes(array('id'=>12));
			$posts_11->config_value = $_POST['network'];
			$posts_11->save();
			
			$posts_12=Configurations::model()->findByAttributes(array('id'=>7));
			$posts_12->config_value = $_POST['admission_number'];
			$posts_12->save();
			
			$posts_13=Configurations::model()->findByAttributes(array('id'=>8));
			$posts_13->config_value = $_POST['employee_number'];
			$posts_13->save();
				
			
				$this->redirect(array('site/login'));
			}
		}
		
		
		$this->render('setup',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Configurations;
		 $logo = new Logo;
		$err_flag = 0;
		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
			//exit;
		if(isset($_POST['submit']))
		{
			
			$posts_1=Configurations::model()->findByAttributes(array('id'=>1));
			$posts_1->config_value = $_POST['collegename'];
			$posts_1->save();
			
			$posts_2=Configurations::model()->findByAttributes(array('id'=>2));
			$posts_2->config_value = $_POST['address'];
			$posts_2->save();
			
			$posts_3=Configurations::model()->findByAttributes(array('id'=>3));
			$posts_3->config_value = $_POST['phone'];
			$posts_3->save();
			
			$posts_4=Configurations::model()->findByAttributes(array('id'=>4));
			$posts_4->config_value = $_POST['attentance'];
			$posts_4->save();
			
			$posts_5=Configurations::model()->findByAttributes(array('id'=>13));
			$posts_5->config_value = $_POST['startyear'];
			$posts_5->save();
			
			$posts_6=Configurations::model()->findByAttributes(array('id'=>14));
			$posts_6->config_value = $_POST['endyear'];
			$posts_6->save();
			
			/*$posts_7=Configurations::model()->findByAttributes(array('id'=>14));
			$posts_7->config_value = $_POST['currency'];
			$posts_7->save();*/
			
			$posts_8=Configurations::model()->findByAttributes(array('id'=>5));
			$posts_8->config_value = $_POST['currency'];
			$posts_8->save();
			
			$posts_9=Configurations::model()->findByAttributes(array('id'=>6));
			$posts_9->config_value = $_POST['language'];
			$posts_9->save();
			
			/*$posts_10=Configurations::model()->findByAttributes(array('id'=>6));
			$posts_10->config_value = $_POST['logo'];
			$posts_10->save();*/
			if($file=CUploadedFile::getInstance($logo,'uploadedFile'))
       		 {
				$logo = new Logo;
				$logo->photo_file_name=$file->name;
				$logo->photo_content_type=$file->type;
				$logo->photo_file_size=$file->size;
				$logo->photo_data=file_get_contents($file->tempName);
				if(!is_dir('uploadedfiles/')){
					mkdir('uploadedfiles/');
				}
				if(!is_dir('uploadedfiles/school_logo/')){
					mkdir('uploadedfiles/school_logo/');
				}
				move_uploaded_file($file->tempName,'uploadedfiles/school_logo/'.$file->name);
				
				$file->saveAs($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'uploadedfiles/school_logo/'.$file->name);  // image
				
				//$logo->save();
				if($logo->save()){
				}
				else{
					$err_flag = 1;
				}
				
				$posts_10=Configurations::model()->findByAttributes(array('id'=>18));
				$posts_10->config_value = Yii::app()->db->getLastInsertId();
				$posts_10->save();
			 }
			if(isset($_POST['dateformat']) && (isset($_POST['timeformat'])) && isset($_POST['timezone'])&& isset($_POST['language']))
			 {
				 
				 $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				 $date='';
				 if($settings!=NULL)
				 {
				 $settings->user_id=Yii::app()->user->id;
				 $settings->dateformat=$_POST['dateformat'];
					
				 					if($_POST['dateformat']=='m/d/yy')
									$settings->displaydate='m/d/Y';
									else if($_POST['dateformat']=='M d.yy')
									$settings->displaydate='M d.Y';
									else if($_POST['dateformat']=='D, M d.yy')
									$settings->displaydate='D, M d.Y';
									else if($_POST['dateformat']=='d M yy')
									$settings->displaydate='d M Y';
									else if($_POST['dateformat']=='yy/m/d')
									$settings->displaydate='Y/m/d';
								
				    $settings->timeformat=$_POST['timeformat'];
				    $settings->timezone=$_POST['timezone'];
				     $settings->language=$_POST['language'];
				 }
				 else
				 {
					  $settings = new UserSettings;
					  $settings->user_id=Yii::app()->user->id;
				 	  $settings->dateformat=$_POST['dateformat'];
					  if($_POST['dateformat']=='m/d/yy')
									$settings->displaydate='m/d/Y';
									else if($_POST['dateformat']=='M d.yy')
									$settings->displaydate='M d.Y';
									else if($_POST['dateformat']=='D, M d.yy')
									$settings->displaydate='D, M d.Y';
									else if($_POST['dateformat']=='d M yy')
									$settings->displaydate='d M Y';
									else if($_POST['dateformat']=='yy/m/d')
									$settings->displaydate='Y/m/d';
					 
				 	  $settings->timeformat=$_POST['timeformat'];
				      $settings->timezone=$_POST['timezone'];
				      $settings->language=$_POST['language'];
				 }
				 $settings->save();
			 }
			$posts_11=Configurations::model()->findByAttributes(array('id'=>12));
			$posts_11->config_value = $_POST['network'];
			$posts_11->save();
			
			$posts_12=Configurations::model()->findByAttributes(array('id'=>7));
			$posts_12->config_value = $_POST['admission_number'];
			$posts_12->save();
			
			$posts_13=Configurations::model()->findByAttributes(array('id'=>8));
			$posts_13->config_value = $_POST['employee_number'];
			$posts_13->save();
			
			//$model->attributes=$_POST['Configurations'];
			//if($model->save())
			if($err_flag==0){
				Yii::app()->user->setFlash('errorMessage',UserModule::t("Configurations saved successfully!"));
				$this->redirect(array('create'));
			}
		}
		$this->render('create',array(
			'model'=>$model,'logo'=>$logo,
		));
			}
	public function actionDisplaySavedImage()
		{
			//$model=$this->loadModel($_GET['id']);
		 	$model=Logo::model()->findByPk($_GET['id']);
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Content-Transfer-Encoding: binary');
			header('Content-length: '.$model->photo_file_size);
			header('Content-Type: '.$model->photo_content_type);
			header('Content-Disposition: attachment; filename='.$model->photo_file_name);
				echo  $model->photo_data;
		}
		
		public function actionDisplayLogoImage()
		{
		 	$model=Logo::model()->findByPk($_GET['id']);
			echo '<img src="uploadedfiles/school_logo/'.$model->photo_file_name.'" alt="'.$model->photo_file_name.'" class="imgbrder" width="119" />';
		}
		
		
	public function actionRemove()
	{
		
		$posts_1=Logo::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$logo_path='uploadedfiles/school_logo/'.$posts_1->photo_file_name;
		if(file_exists($logo_path)){
			unlink($logo_path);
		}
		$posts_1->delete();
		$this->redirect(array('create'));
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

		if(isset($_POST['submit']))
		{
			
			$posts_1=Configurations::model()->findByAttributes(array('id'=>1));
			$posts_1->config_value = $_POST['collegename'];
			$posts_1->save();
			
			$posts_2=Configurations::model()->findByAttributes(array('id'=>2));
			$posts_2->config_value = $_POST['address'];
			$posts_2->save();
			
			$posts_3=Configurations::model()->findByAttributes(array('id'=>3));
			$posts_3->config_value = $_POST['phone'];
			$posts_3->save();
			
			$posts_4=Configurations::model()->findByAttributes(array('id'=>4));
			$posts_4->config_value = $_POST['attentance'];
			$posts_4->save();
			
			$posts_5=Configurations::model()->findByAttributes(array('id'=>13));
			$posts_5->config_value = $_POST['startyear'];
			$posts_5->save();
			
			$posts_6=Configurations::model()->findByAttributes(array('id'=>14));
			$posts_6->config_value = $_POST['endyear'];
			$posts_6->save();
			
			$posts_7=Configurations::model()->findByAttributes(array('id'=>14));
			$posts_7->config_value = $_POST['currency'];
			$posts_7->save();
			
			$posts_8=Configurations::model()->findByAttributes(array('id'=>5));
			$posts_8->config_value = $_POST['currency'];
			$posts_8->save();
			
			$posts_9=Configurations::model()->findByAttributes(array('id'=>6));
			$posts_9->config_value = $_POST['language'];
			$posts_9->save();
			
			if($file=CUploadedFile::getInstance($model,'logo'))
       		 {
				 
				 $logo = new Logo;
            $logo->photo_file_name=$file->name;
            $logo->photo_content_type=$file->type;
            $logo->photo_file_size=$file->size;
            $logo->photo_data=file_get_contents($file->tempName);
      		 $logo->save();
			$posts_10=Configurations::model()->findByAttributes(array('id'=>18));
			$posts_10->config_value = Yii::app()->db->getLastInsertId();;
			$posts_10->save();
			 }
			
			$posts_11=Configurations::model()->findByAttributes(array('id'=>12));
			$posts_11->config_value = $_POST['network'];
			$posts_11->save();
			
			$posts_12=Configurations::model()->findByAttributes(array('id'=>7));
			$posts_12->config_value = $_POST['admission_number'];
			$posts_12->save();
			
			$posts_13=Configurations::model()->findByAttributes(array('id'=>8));
			$posts_13->config_value = $_POST['employee_number'];
			$posts_13->save();
				$this->redirect(array('create'));
		}

		$this->render('update',array(
			'model'=>$model,
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
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Configurations');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Configurations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Configurations']))
			$model->attributes=$_GET['Configurations'];

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
		$model=Configurations::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='configurations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
