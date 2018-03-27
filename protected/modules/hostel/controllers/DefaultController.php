<?php

class DefaultController extends RController
{
	public function actionIndex()
	{
		$roles=Rights::getAssignedRoles(Yii::app()->user->Id);
		foreach($roles as $role)
		{				
			if(sizeof($roles)==1 and $role->name == 'student')//if the current role is student,it render stud_index.php page else it take index.php page
			{
				$this->render('stud_index');
			}
			else
			{
				$this->render('index');
			}
		}
	}
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}
}