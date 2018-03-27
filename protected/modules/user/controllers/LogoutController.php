<?php

class LogoutController extends Controller
{
	public $defaultAction = 'logout';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionLogout()
	{
		$lan	= Yii::app()->translate->getLanguage();
		//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
		ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'2',NULL,NULL,NULL,NULL,NULL); 
		Yii::app()->user->logout();		
		session_start();
		$_SESSION['user-lan']	= $lan;
		
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}

}