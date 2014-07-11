<?php

class MessageModule extends CWebModule
{
	
	public $defaultController = 'inbox';

	public $userModel = 'User';
	public $userModelRelation = null;
	public $getNameMethod;
	public $getSuggestMethod;

	public $senderRelation;
	public $receiverRelation;

	public $dateFormat = 'Y-m-d H:i:s';

	public $inboxUrl = array("/message/inbox");

	public $viewPath = '/message/default';

	public function init()
	{
		if (!class_exists($this->userModel)) {
		    throw new Exception(MessageModule::t("Class {userModel} not defined", array('{userModel}' => $this->userModel)));
		}

		foreach (array('getNameMethod', 'getSuggestMethod') as $methodName) {
			if (!$this->$methodName) {
				throw new Exception(MessageModule::t("Property MessageModule::{methodName} not defined", array('{methodName}' => $methodName)));
			}

			if (!method_exists($this->userModel, $this->$methodName)) {
				throw new Exception(MessageModule::t("Method {userModel}::{methodName} not defined", array('{userModel}' => $this->userModel, '{methodName}' => $this->$methodName)));
			}
		}

		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'message.models.*',
			'message.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		            $roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					
						  foreach($roles as $role)
						  {
						   if(sizeof($roles)==1 and $role->name == 'parent')
						   { 
		
		                    $controller->layout='none';
						   }
						    if(sizeof($roles)==1 and $role->name == 'student')
						   { 
		
		                    $controller->layout='studentmain';
						   }
						  }
					
		
		if (Yii::app()->user->isGuest) {
			if (Yii::app()->user->loginUrl) {
				$controller->redirect($controller->createUrl(reset(Yii::app()->user->loginUrl)));
			} else {
				$controller->redirect($controller->createUrl('/'));
			}
		} else if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else {
			return false;
		}
	}

	public static function t($str='',$params=array(),$dic='message') {
		return Yii::t("MessageModule.".$dic, $str, $params);
	}

	public function getCountUnreadedMessages($userId) {
		return Message::model()->getCountUnreaded($userId);
	}

}
