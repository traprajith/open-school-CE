<?php

class PreferencesController extends RController
{
	public $layout='//layouts/column2';
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	
	public function actionEdit(){
		$model	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));		
		if($model==NULL){
			$model	= new UserSettings;
		}
		
		if(isset($_POST['UserSettings'])){
			$model->attributes	= $_POST['UserSettings'];
			$model->user_id		= Yii::app()->user->id;
			if($model->save()){
				$this->redirect(array('edit'));
			}
		}
		
		$this->render('edit', array('model'=>$model));
	}
}