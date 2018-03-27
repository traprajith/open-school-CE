<?php

class SettingConfigurationController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCreate()
	{
		if(isset(Yii::app()->user->id))
		{		
			if(isset($_POST['dateformat']) && (isset($_POST['timeformat'])) && isset($_POST['timezone']))
			{			
				$settings = UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				$admin_setup = UserSettings::model()->findByAttributes(array('user_id'=>1));
				$date='';
				if($settings!=NULL)
				{
					$settings->user_id=Yii::app()->user->id;
					$settings->dateformat=$_POST['dateformat'];
					
					if($_POST['dateformat']=='m/d/yy')
						$settings->displaydate='m/d/Y';
					else if($_POST['dateformat']=='M d.yy')
					$settings->displaydate='M d.Y';
						else if($_POST['dateformat']=='D, M d.yy')
					$settings->displaydate='D, M d.Y';
						else if($_POST['dateformat']=='d M yy')
					$settings->displaydate='d M Y';
						else if($_POST['dateformat']=='yy/m/d')
					$settings->displaydate='Y/m/d';
									
					$settings->timeformat=$_POST['timeformat'];
					$settings->timezone=$_POST['timezone'];
					$settings->language = $admin_setup->language;
					$settings->name_format = $admin_setup->name_format;				
				}
				else
				{
					$settings = new UserSettings;
					$settings->user_id=Yii::app()->user->id;
					$settings->dateformat=$_POST['dateformat'];
					if($_POST['dateformat']=='m/d/yy')
						$settings->displaydate='m/d/Y';
					else if($_POST['dateformat']=='M d.yy')
						$settings->displaydate='M d.Y';
					else if($_POST['dateformat']=='D, M d.yy')
						$settings->displaydate='D, M d.Y';
					else if($_POST['dateformat']=='d M yy')
						$settings->displaydate='d M Y';
					else if($_POST['dateformat']=='yy/m/d')
						$settings->displaydate='Y/m/d';
					
					$settings->timeformat=$_POST['timeformat'];
					$settings->timezone=$_POST['timezone'];
					$settings->language = $admin_setup->language;
					$settings->name_format = $admin_setup->name_format;
				}
				$settings->save();
				Yii::app()->user->setFlash('successMessage',Yii::t("app","Configurations saved successfully!"));
			}
			$this->render('create');
		}
		else
		{
			throw new CHttpException(404,Yii::t("app",'The requested page does not exist.'));
		}
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}