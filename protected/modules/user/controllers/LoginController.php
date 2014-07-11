<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
	public $layout='//layouts/none';
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		
		
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					       foreach($roles as $role)
						   if(sizeof($roles)==1 and $role->name == 'parent')
						   {
							   $this->redirect(array('/portal'));
							   
						   }
						   if(sizeof($roles)==1 and $role->name == 'student')
						   {
							   $this->redirect(array('/portal'));
							   
						   }
						   if(sizeof($roles)==1 and $role->name == 'teacher')
						   {
							   $this->redirect(array('/portal'));
							   
						   } 
						 if(Yii::app()->user->checkAccess('admin'))
						 {
							 if (Yii::app()->user->returnUrl=='/index.php')
								$this->redirect(Yii::app()->controller->module->returnUrl);
							else
								$this->redirect(Yii::app()->user->returnUrl);
						 }
						  else
					      {
							 $this->redirect(array('/mailbox'));
						  }
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}