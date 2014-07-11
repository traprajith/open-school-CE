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
		$model=new Guardians;
        $check_flag = 0;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if($_POST['student_id'])
		{
			$guardian = Students::model()->findByAttributes(array('id'=>$_POST['student_id']));
			$gid = $guardian->parent_id;			
		}
		elseif($_POST['guardian_id'])
		{
			$gid = $_POST['guardian_id'];
		}
		elseif($_POST['guardian_mail'])
		{
			$gid = $_POST['guardian_mail'];
			
		}
		
		if($gid!=NULL and $gid!=0)
		{
			$model = Guardians::model()->findByAttributes(array('id'=>$gid));
			$this->render('create',array(
			'model'=>$model,'radio_flag'=>1,'guardian_id'=>$gid
			));	
		}
		elseif((isset($_POST['student_id']) or isset($_POST['guardian_id']) or isset($_POST['guardian_mail'])) and ($gid==NULL or $gid==0))
		{
			Yii::app()->user->setFlash('errorMessage',UserModule::t("Guardian not found..!"));
		}
		
		if(isset($_POST['Guardians']))
		{
			
			$model->attributes=$_POST['Guardians'];
			$model->validate();
			if($_POST['Guardians']['user_create']==1)
			{
				$check_flag = 1;
			}
			//print_r($_POST['Guardians']); exit;
			if($model->save())
			{
				//echo $model->ward_id; exit;
				$student = Students::model()->findByAttributes(array('id'=>$model->ward_id));
				$student->saveAttributes(array('parent_id'=>$model->id));
				
				if($_POST['Guardians']['user_create']==0)
				{
				
					//adding user for current guardian
					$user=new User;
					$profile=new Profile;
					$user->username = substr(md5(uniqid(mt_rand(), true)), 0, 10);
					$user->email = $model->email;
					$user->activkey=UserModule::encrypting(microtime().$model->first_name);
					$password = substr(md5(uniqid(mt_rand(), true)), 0, 10);
					$user->password=UserModule::encrypting($password);
					$user->superuser=0;
					$user->status=1;
					
					if($user->save())
					{
						
					//assign role
					$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
					$authorizer->authManager->assign('parent', $user->id);
					
					//profile
					$profile->firstname = $model->first_name;
					$profile->lastname = $model->last_name;
					$profile->user_id=$user->id;
					$profile->save();
					
					//saving user id to guardian table.
					$model->saveAttributes(array('uid'=>$user->id));
					//$model->uid = $user->id;
					//$model->save();
					
					// for sending sms
					$sms_settings = SmsSettings::model()->findAll();
					$to = '';
					if($sms_settings[0]->is_enabled=='1' and $sms_settings[2]->is_enabled=='1'){ // Checking if SMS is enabled.
						if($model->mobile_phone){
							$to = $model->mobile_phone;	
						}
						
						if($to!=''){ // Send SMS if phone number is provided
							$college=Configurations::model()->findByPk(1);
							$from = $college->config_value;
							$message = 'Welcome to '.$college->config_value;
							SmsSettings::model()->sendSms($to,$from,$message);
						} // End send SMS
					} // End check if SMS is enabled
					
					UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please login to your account with your email id as username and password {password}",array('{password}'=>$password)));
					}
						
				}
				$this->redirect(array('addguardian','id'=>$model->ward_id));
			}
		}

		$this->render('create',array(
			'model'=>$model,'check_flag'=>$check_flag
		));
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

		if(isset($_POST['Guardians']))
		{
			
			$model->attributes=$_POST['Guardians'];
			if($model->save())
			{
				if($_REQUEST['std']==NULL)
				{
					$student = Students::model()->findByAttributes(array('id'=>$_REQUEST['sid']));
					$student->saveAttributes(array('parent_id'=>$_REQUEST['id']));
					//echo $_REQUEST['id'].'/'.$student->first_name; exit;
					$this->redirect(array('addguardian','id'=>$_REQUEST['sid'],'gid'=>$_REQUEST['id']));
				}
				{
					$this->redirect(array('students/view','id'=>$_REQUEST['std']));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionAddguardian()
	{
		$model=new Guardians;
		  if(isset($_POST['Guardians']))
		   {
			   $list = $_POST['Guardians'];
			   $student = Students::model()->findByAttributes(array("id"=>$list['ward_id']));
			   $student->immediate_contact_id = $list['radio'];
			   $student->save();
			   $this->redirect(array('studentPreviousDatas/create','id'=>$list['ward_id']));
				//$this->redirect(array('students/view','id'=>$list['ward_id']));
			   
		   }
		$this->render('addguardian',array('model'=>$model));
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
			throw new CHttpException(404,'The requested page does not exist.');
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
}
