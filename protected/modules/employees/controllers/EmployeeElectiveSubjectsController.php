<?php

class EmployeeElectiveSubjectsController extends RController
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
				'actions'=>array('index','view','Assign','Deleterow'),
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
		$model=new EmployeeElectiveSubjects;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['EmployeeElectiveSubjects']))
		{
			$model->attributes=$_POST['EmployeeElectiveSubjects'];
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

		if(isset($_POST['EmployeeElectiveSubjects']))
		{
			$model->attributes=$_POST['EmployeeElectiveSubjects'];
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

	public function actionAssign()
	{
		if(Yii::app()->request->isPostRequest){
			$model = new EmployeeElectiveSubjects;
		
			$elective = Electives::model()->findByAttributes(array('id'=>$_REQUEST['elect']));
			$subject = Subjects::model()->findByAttributes(array('elective_group_id'=>$elective->elective_group_id));
			$model->employee_id = $_REQUEST['emp_id'];
			$model->elective_id = $_REQUEST['elect'];
			$model->subject_id = $subject->id;
			$model->save();
			$this->redirect(array('employeesSubjects/create','bid'=>$_REQUEST['bid'],'elect'=>$_REQUEST['elect'],'dep'=>$_REQUEST['dep']));
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
		
	}
	public function actionDeleterow()
	{ 
		if(Yii::app()->request->isPostRequest){

			$postRecord = EmployeeElectiveSubjects::model()->findByPk($_GET['id']);
			
					
					if($postRecord)
					{
						//for delete time table entries in of employee
						$subject_id= $postRecord->elective_id;
						$employee_id= $postRecord->employee_id;
						$sub_model= Electives::model()->findByPk($subject_id);
						$batch_id= $sub_model->batch_id;
					  
						
						$timetable_entries_model= TimetableEntries::model()->findAllByAttributes(array('employee_id'=>$employee_id, 'batch_id'=>$batch_id,'subject_id'=>$subject_id, 'is_elective'=>2));
						foreach ($timetable_entries_model as $data)
						{
							$data->delete();
						}
						$postRecord->delete();
					}
					
			
			 Yii::app()->user->setFlash('notification',Yii::t('app','Data Saved Successfully'));
			$this->redirect(array('employeesSubjects/create','bid'=>$_REQUEST['bid'],'elect'=>$_REQUEST['elect'],'dep'=>$_REQUEST['dep']));
		}
		else
		{
			throw new CHttpException(404,Yii::t('app','Invalid Request.'));
		}
		
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EmployeeElectiveSubjects');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EmployeeElectiveSubjects('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmployeeElectiveSubjects']))
			$model->attributes=$_GET['EmployeeElectiveSubjects'];

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
		$model=EmployeeElectiveSubjects::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-elective-subjects-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
