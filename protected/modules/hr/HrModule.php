<?php

class HrModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'hr.models.*',
			'hr.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!ModuleAccess::model()->isEnabled('HR')){	// checking whether HR module is enabled
				throw new CHttpException(404, Yii::t('app', 'You are not authorized to perform this action'));
			}
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
