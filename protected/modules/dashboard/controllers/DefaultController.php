<?php

class DefaultController extends RController
{
	public function filters()
	{
		return array(
			'rights'
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionCalendar()
	{
		$this->render('calendar');
	}
	public function actionEvent()
	{
		$this->render('event');
	}
	public function actionEvents()
	{
		$this->render('events');
	}
	public function actionView()
	{
		$this->renderPartial('view',array('event_id'=>$_REQUEST['event_id']),false,true);
	}
	

}