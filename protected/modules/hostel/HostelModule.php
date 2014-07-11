<?php

class HostelModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'hostel.models.*',
			'hostel.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					
						  foreach($roles as $role)
						  {
						   
						    if(sizeof($roles)==1 and $role->name == 'student')
						   { 
		
		                    $controller->layout='studentmain';
						   }
						  }
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
