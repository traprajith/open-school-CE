<?php

class PreviousYearSettingsController extends Controller
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
			'accessControl', // perform access control for CRUD operations
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
		$model=new PreviousYearSettings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PreviousYearSettings']))
		{
			$posts = $_POST['PreviousYearSettings'];
			if($posts['setting'] == 0)
			{
				$posts['create_action'] = 0;
				$posts['insert_action'] = 0;
				$posts['edit_action'] = 2;
				$posts['delete_action'] = 0;
				$posts['approve_action'] = 2;
				$posts['disapprove_action'] = 0;
				$posts['active_action'] = 0;
				$posts['inactive_action'] = 0;
			}
			
			$posts_1 = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
			//var_dump($posts_1->attributes);exit;
			$posts_1->settings_value = $posts['create_action'];
			$posts_1->save();
			
			$posts_2 = PreviousYearSettings::model()->findByAttributes(array('id'=>2));
			$posts_2->settings_value = $posts['insert_action'];
			$posts_2->save();
			
			$posts_3 = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
			$posts_3->settings_value = $posts['edit_action'];
			$posts_3->save();
			
			$posts_4 = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
			$posts_4->settings_value = $posts['delete_action'];
			$posts_4->save();
			
			$posts_5 = PreviousYearSettings::model()->findByAttributes(array('id'=>5));
			$posts_5->settings_value = $posts['approve_action'];
			$posts_5->save();
			
			$posts_6 = PreviousYearSettings::model()->findByAttributes(array('id'=>6));
			$posts_6->settings_value = $posts['disapprove_action'];
			$posts_6->save();
			
			$posts_7 = PreviousYearSettings::model()->findByAttributes(array('id'=>7));
			$posts_7->settings_value = $posts['active_action'];
			$posts_7->save();
			
			$posts_8 = PreviousYearSettings::model()->findByAttributes(array('id'=>8));
			$posts_8->settings_value = $posts['inactive_action'];
			$posts_8->save();
			
			// Setting of successful message.
			 Yii::app()->user->setFlash('notification',Yii::t('app','Previous Year Settings Saved Successfully!'));
		}

		$this->render('create',array(
			'model'=>$model,
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

		if(isset($_POST['PreviousYearSettings']))
		{
			$model->attributes=$_POST['PreviousYearSettings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PreviousYearSettings');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PreviousYearSettings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PreviousYearSettings']))
			$model->attributes=$_GET['PreviousYearSettings'];

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
		$model=PreviousYearSettings::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='previous-year-settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
