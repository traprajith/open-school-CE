<?php

class DefaultController extends RController
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCalendar()
	{
		$this->render('calendar');
	}
	public function actionEvents()
	{
		$this->render('events');
	}
	public function actionView()
	{
		
		$this->renderPartial('view',array('event_id'=>$_REQUEST['event_id']),false,true);
		//$model = new Events;
		/*$flag = true;
		if($flag) {
			Yii::app()->clientScript->scriptMap['jquery.js'] = false;
			$this->renderPartial('view',array('event_id'=>$event_id),false,true);
		}*/
	}
	/*public function actionSample()
	{
		$this->render('sample');
	}*/
}