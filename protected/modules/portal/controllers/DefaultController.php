<?php

class DefaultController extends RController
{
	public $layout='//layouts/none';
	public function actionIndex()
	{
		$this->render('index');
	}
}