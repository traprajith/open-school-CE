<?php


class AjaxController extends RController
{
	public $defaultAction = 'auto';
	
	public function filters()
	{
		if($this->module->authManager=='rights') {
			return array(
				'rights', // perform access control for CRUD operations
			);
		}
	}
	
	public function actionAuto()
	{
		if(!isset($_GET['term']))
			throw new Exception('Term required');
		
		die(Yii::app()->controller->module->autoComplete($_GET['term']));
	}
	
}