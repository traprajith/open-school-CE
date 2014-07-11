<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionNew() //Compose Page
	{
		$this->render('compose');
	}
	
	public function actionView() //Compose Page
	{
		$this->render('view');
	}
	
	
}