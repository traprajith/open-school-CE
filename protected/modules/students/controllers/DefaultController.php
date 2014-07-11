<?php

class DefaultController extends RController
{
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
	public function actionIndex()
	{
		$this->render('index');
	}
}