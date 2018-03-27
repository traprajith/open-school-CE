<?php

class SemesterController extends RController
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
		if(Configurations::model()->isSemesterEnabled()){
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
		}
		else{
			$this->redirect(array('//courses'));
		}
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Configurations::model()->isSemesterEnabled()){
			$model=new Semester;
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
	
			if(isset($_POST['Semester'])){
				
				$model->attributes	=	$_POST['Semester'];
				if($_POST['Semester']['start_date'] !=NULL){
					$sdate				=	$_POST['Semester']['start_date'];
					$model->start_date	=	date('Y-m-d',strtotime($sdate));
				}
				if($_POST['Semester']['end_date'] !=NULL){
					$edate				=	$_POST['Semester']['end_date'];
					$model->end_date	=	date('Y-m-d',strtotime($edate));
				}
				$model->created_date=	date('Y-m-d H:i:s');
				
				if($model->save()){
					//all semester for selected courses
						foreach($_POST['courses'] as $course_id){
							$semesterCourses		= new SemesterCourses();
							if($course_id!=NULL){
							
								$semesterCourses->semester_id	=	$model->id;
								$semesterCourses->course_id		=	$course_id;
								$semesterCourses->created_date=	date('Y-m-d H:i:s');
								$semesterCourses->save();
							}
						}
					$this->redirect(array('index','id'=>$model->id));
				}
			}
	
			$this->render('create',array(
				'model'=>$model,
			));
		}
		else{
			$this->redirect(array('//courses'));
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(Configurations::model()->isSemesterEnabled()){
			$model=$this->loadModel($id);
	
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);	
			if(isset($_POST['Semester'])){ 
				$model->attributes=$_POST['Semester'];
				$sdate				=	$_POST['Semester']['start_date'];
				$model->start_date	=	date('Y-m-d',strtotime($sdate));
				$edate				=	$_POST['Semester']['end_date'];
				$model->end_date	=	date('Y-m-d',strtotime($edate));
				$model->created_date=	date('Y-m-d H:i:s');
				if($model->save()){
					
					
					$criteria1	= new CDbCriteria;
					$criteria1->addNotInCondition('id',$_POST['courses']); 
					$old_courses				= Courses::model()->findAll($criteria1);
					foreach($old_courses as $old_course){
						
						//for delete course from semester course table							
						$s_courses 	= SemesterCourses::model()->findAllByAttributes(array('semester_id'=>$model->id,'course_id'=>$old_course->id));
						foreach($s_courses as $s_course){ 
							$semester_co 	= SemesterCourses::model()->findByPk($s_course->id);
							$semester_co->delete();
						} 
						$batches 	= Batches::model()->findAllByAttributes(array('semester_id'=>$model->id,'course_id'=>$old_course->id));
						foreach($batches as $batch){
							$batch->semester_id = NULL;
							$batch->save();
						}
					}
					 
	
						//all semester for selected courses
						foreach($_POST['courses'] as $course_id){
							$scourse	=	SemesterCourses::model()->findByAttributes(array('semester_id'=>$model->id,'course_id'=>$course_id));
							if($scourse == NULL){ 
								$semesterCourses		= new SemesterCourses();
								if($course_id!=NULL){								
									$semesterCourses->semester_id	=	$model->id;
									$semesterCourses->course_id		=	$course_id;
									$semesterCourses->created_date=	date('Y-m-d H:i:s');
									$semesterCourses->save();
								}
							}
						}
	
					$this->redirect(array('index','id'=>$model->id));
				}
			}
	
			$this->render('update',array(
				'model'=>$model,
			));
		}
		else{
			$this->redirect(array('//courses'));
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			$s_courses 	= SemesterCourses::model()->findAllByAttributes(array('semester_id'=>$id));
			$batches 	= Batches::model()->findAllByAttributes(array('semester_id'=>$id));
			foreach($batches as $batche){
				$batche->semester_id = NULL;
				$batche->save();
			}
			foreach($s_courses as $s_course){
				$semester_co 	= SemesterCourses::model()->findByPk($s_course->id);
				$semester_co->delete();
			}

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
	/*	*
	 * Manages all models.
	 */
	public function actionIndex()
	{
		if(Configurations::model()->isSemesterEnabled()){
			$model=new Semester('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Semester']))
				$model->attributes=$_GET['Semester'];
	
			$this->render('index',array(
				'model'=>$model,
			));
		}else{
			$this->redirect(array('//courses'));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Semester::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='semester-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
