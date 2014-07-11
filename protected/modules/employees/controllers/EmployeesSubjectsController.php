<?php

class EmployeesSubjectsController extends RController
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
				'actions'=>array('index','view','Assign','Deleterow'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','subject','current','remove','employee'),
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
		$model=new EmployeesSubjects;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmployeesSubjects']))
		{
			$model->attributes=$_POST['EmployeesSubjects'];
			if($model->save())
			$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['EmployeesSubjects']))
		{
			$model->attributes=$_POST['EmployeesSubjects'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionDeleterow()
	{

		$postRecord = EmployeesSubjects::model()->findByPk($_REQUEST['id']);
		$postRecord->delete();
		 Yii::app()->user->setFlash('notification','Data Saved Successfully');
		$this->redirect(array('create','cou'=>$_REQUEST['cou'],'sub'=>$_REQUEST['sub'],'dept'=>$_REQUEST['dept']));
		
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
		$dataProvider=new CActiveDataProvider('EmployeesSubjects');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionAssign()
	{
	$model = new EmployeesSubjects;

	$model->employee_id = $_REQUEST['emp_id'];
	$model->subject_id = $_REQUEST['sub'];
	$model->save();
	$this->redirect(array('create','cou'=>$_REQUEST['cou'],'sub'=>$_REQUEST['sub'],'dept'=>$_REQUEST['dept']));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmployeesSubjects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeesSubjects']))
			$model->attributes=$_GET['EmployeesSubjects'];

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
		$model=EmployeesSubjects::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='employees-subjects-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSubject()
	{
		$data=Subjects::model()->findAll(array('join' => 'JOIN batches ON batch_id = batches.id','condition'=>'batches.course_id=:id', 
                  'params'=>array(':id'=>(int) $_POST['id'])));
 
         $data=CHtml::listData($data,'id','name');
		  foreach($data as $value=>$name)
		  {
			  echo CHtml::tag('option',
						 array('value'=>$value),CHtml::encode($name),true);
		  }
	}
	
	public function actionEmployee()
	{
		$data=Employees::model()->findAll(array('order'=>'first_name DESC','condition'=>'employee_department_id=:id', 
                  'params'=>array(':id'=>(int) $_POST['did'])));
 
         $data=CHtml::listData($data,'id','first_name');
		  foreach($data as $value=>$name)
		  {
			  echo CHtml::tag('option',
						 array('value'=>$value),CHtml::encode($name),true);
		  }
	}
	
	public function actionCurrent()
	{
		if(isset($_POST['EmployeesSubjects']['subject_id']))
		{
		$this->renderPartial('assign',array('subject_id' =>$_POST['EmployeesSubjects']['subject_id']));	
		}
		 else
		 {
			 echo 'remove';
		 }
		 
	}
	
	public function actionRemove()
	{
		EmployeesSubjects::model()->findByAttributes(array('subject_id'=>$_REQUEST['subject_id'],'employee_id'=>$_REQUEST['employee_id']))->delete();
		$this->redirect(Yii::app()->createUrl('EmployeesSubjects/create'));
		 
	}
}
