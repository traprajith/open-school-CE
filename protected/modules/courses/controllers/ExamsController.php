<?php

class ExamsController extends RController
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
				'actions'=>array('index','view','convertTime'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','manage'),
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
		$model=new Exams;
		$model_1=new ExamGroups;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exams']))
		{
			
			//$model->attributes=$_POST['Exams'];
			if(isset($_REQUEST['exam_group_id']))
			{
				$insert_id=$_REQUEST['exam_group_id'];
			}
			else
			{
			$model_1->attributes=$_POST['ExamGroups'];
			$model_1->batch_id = $_REQUEST['id']; 
			$model_1->save();
			$insert_id = Yii::app()->db->getLastInsertID();
			}
			$posts=Subjects::model()->findAll("batch_id=:x AND no_exams=:y", array(':x'=>$_REQUEST['id'],':y'=>0));
			$list = $_POST['Exams'];
			$count = count($list['subject_id']);
			
			
			$j=0;
			for($i=0;$i<$count;$i++)
			{
			
			if($list['maximum_marks'][$i]!=NULL and $list['minimum_marks'][$i]!=NULL and $list['start_time'][$i]!=NULL and $list['end_time'][$i]!=NULL)
			{	
			$model=new Exams;
			$model->exam_group_id = $insert_id; 
			$model->subject_id = $list['subject_id'][$i];
			$model->maximum_marks = $list['maximum_marks'][$i];
			$model->minimum_marks = $list['minimum_marks'][$i];
			$model->start_time = $list['start_time'][$i];
			$model->end_time = $list['end_time'][$i];
			if($model->start_time)
			{
				$date1=date('Y-m-d H:i',strtotime($model->start_time));
				$model->start_time=$date1;
			}
			
			if($model->end_time)
			{
				$date2=date('Y-m-d H:i',strtotime($model->end_time));
				$model->end_time=$date2;
			}
			$model->grading_level_id = $list['grading_level_id'];
			$model->weightage = $list['weightage'];
			$model->event_id = $list['event_id'];
			$model->created_at = $list['created_at'];
			$model->updated_at = $list['updated_at'];
			$model->save();
			}
			}
				$this->redirect(array('exams/create','id'=>$_REQUEST['id'],'exam_group_id'=>$_REQUEST['exam_group_id']));
		}

		$this->render('create',array(
			'model'=>$model,'model_1'=>$model_1
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($sid)
	{
		$model=$this->loadModel($sid);
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($settings!=NULL)
			{	
				$model->start_time=date($settings->displaydate.$settings->timeformat,strtotime($model->start_time));
				$model->end_time=date($settings->displaydate.$settings->timeformat,strtotime($model->end_time));
			}
			
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Exams']))
		{
			$model->attributes=$_POST['Exams'];
			if($model->save())
				$this->redirect(array('exams/create','id'=>$_REQUEST['id'],'exam_group_id'=>$_REQUEST['exam_group_id']));
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
		$dataProvider=new CActiveDataProvider('Exams');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Exams('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Exams']))
			$model->attributes=$_GET['Exams'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionManage()
	{
		
		$model=new Exams('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['exam_group_id']))
			$model->exam_group_id=$_GET['exam_group_id'];

		$this->render('manage',array(
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
		$model=Exams::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	 public function convertTime($date)

 	{
	 			
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($settings!=NULL)
			{	
				$date1=date($settings->displaydate,strtotime($date));
				echo $date1.'<br>'.date($settings->timeformat,strtotime($date));
		
			}
							
			
	 
	 }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='exams-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
