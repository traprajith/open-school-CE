<?php

class TimetableEntriesController extends RController
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
				'actions'=>array('index','view','Settime','Dynamiccities'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','remove'),
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
		$model=new TimetableEntries;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['TimetableEntries']))
		{
			$model->attributes=$_POST['TimetableEntries'];
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

		if(isset($_POST['TimetableEntries']))
		{
			$model->attributes=$_POST['TimetableEntries'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionSettime()
	{
	
		$model=new TimetableEntries;
		$this->performAjaxValidation($model);
		$flag=true;
		if(isset($_POST['TimetableEntries']))
        { 
		   $model->attributes=$_POST['TimetableEntries'];
		   
			$flag=false;
			
			
			if($model->save()) {
              // $this->renderPartial('teaching',array('vsearch' =>'111'), false, true);
			//	$this->RenderPartial ('new', array ('vsearch' =>'122'), false, true);
			//	Yii :: app()->end();
				echo CJSON::encode(array(
                        'status'=>'success',
                        ));
                 exit;    
            }
			else
			{
				echo CJSON::encode(array(
                        'status'=>'error',
                        ));
                 exit;    
			}
         }
	
		  if($flag)
		   {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;
                $this->renderPartial('create',array('model'=>$model,'batch_id'=>$_GET['batch_id'],'weekday_id'=>$_GET['weekday_id'],'class_timing_id'=>$_GET['class_timing_id']),false,true);
           }
			
	}
	public function actionDynamiccities()
		{
		//please enter current controller name because yii send multi dim array 
			$data=EmployeesSubjects::model()->findAll('subject_id=:sub_id',array(':sub_id'=>(int) $_POST['TimetableEntries']['subject_id']));
			
		 	echo CHtml::tag('option', array('value' => ''), CHtml::encode('Select Employee'), true);
			
			$data=CHtml::listData($data,'id','employee_id');
			foreach($data as $value=>$name)
			{
				$emp_name = Employees::model()->findByAttributes(array('id'=>$name));
				echo CHtml::tag('option',array('value'=>$emp_name->id),$emp_name->first_name.' '.$emp_name->last_name,true);
			}
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
	
	public function actionRemove($id)
	{
		
			$this->loadModel($id)->delete();
			$this->redirect(array('weekdays/timetable','id'=>$_REQUEST['batch_id']));

			
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TimetableEntries');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TimetableEntries('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TimetableEntries']))
			$model->attributes=$_GET['TimetableEntries'];

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
		$model=TimetableEntries::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='timetable-entries-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
