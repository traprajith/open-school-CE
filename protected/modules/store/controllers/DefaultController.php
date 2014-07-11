<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	/*<!--public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}-->*/
}