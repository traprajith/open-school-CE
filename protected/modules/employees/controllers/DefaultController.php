<?php

class DefaultController extends RController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}