<?php

class StudentPreviousDatasController extends RController
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
		$model		= new StudentPreviousDatas;
		$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));		
		if(isset($_POST['StudentPreviousDatas'])){			
			$model->attributes=$_POST['StudentPreviousDatas'];
			$fields   = FormFields::model()->getDynamicFields(4, 1, "forAdminRegistration");				
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));												
					}
				}
			}
			if($model->save()){
				if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
					$this->redirect(array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id'],'status'=>1));
				}
				else{
					if($_REQUEST['which_btn'] == 1){ //In case of Save & Add another button click
						$this->redirect(array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id']));
					}
					else{
						$this->redirect(array('/students/studentDocument/create','id'=>$_REQUEST['id']));
					}
				}
			}
		}

		$fields   = FormFields::model()->getDynamicFields(4, 1, "forAdminRegistration");
		foreach ($fields as $key => $field) {			
			if($field->form_field_type==6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
		}
		
		$this->render('create',array('model'=>$model));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{		
		$model		= $this->loadModel($_REQUEST['pid']);
		$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));		
		if(isset($_POST['StudentPreviousDatas'])){
			$model->attributes	= $_POST['StudentPreviousDatas'];
			
			$fields   = FormFields::model()->getDynamicFields(4, 1, "forAdminRegistration");				
			foreach ($fields as $key => $field) {			
				if($field->form_field_type==6){  // date value
					$field_name = $field->varname;
					if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
						$model->$field_name = date('Y-m-d',strtotime($model->$field_name));												
					}
				}
			}
						
			if($model->save()){
				if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){ //Update from student profile
					$this->redirect(array('/students/studentPreviousDatas/create','id'=>$id,'status'=>1));
				}				
				else{
					$this->redirect(array('/students/studentPreviousDatas/create','id'=>$id));
				}
			}
		}
		
		$fields   = FormFields::model()->getDynamicFields(4, 1, "forAdminRegistration");
		foreach ($fields as $key => $field) {			
			if($field->form_field_type==6){  // date value
				$field_name = $field->varname;
				if($model->$field_name!=NULL and $model->$field_name!="0000-00-00" and $settings!=NULL){
					$model->$field_name = date($settings->displaydate,strtotime($model->$field_name));
				}
				else{
					$model->$field_name=NULL;
				}
			}
		}
		
		$this->render('update',array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest){			
			$this->loadModel($id)->delete();
			if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
				$this->redirect(array('/students/studentPreviousDatas/create','id'=>$_REQUEST['sid'],'status'=>1));
			}
			else{
				$this->redirect(array('/students/studentPreviousDatas/create','id'=>$_REQUEST['sid']));
			}			
		}
		else
			throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('StudentPreviousDatas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new StudentPreviousDatas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['StudentPreviousDatas']))
			$model->attributes=$_GET['StudentPreviousDatas'];

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
		$model=StudentPreviousDatas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='student-previous-datas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
