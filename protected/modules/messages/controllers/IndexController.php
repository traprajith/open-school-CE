<?php

class IndexController extends RController {
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	public $defaultAction = 'index';

	public function actionIndex() {
		
		//to hide welcome message - Rajith
		if(isset($_POST['hide']))
		{
			//permanant hide
			if(isset($_POST['dontshow']))
		    {
				
				$config=Configurations::model()->findByAttributes(array('id'=>21));
				if($config!=NULL)
				{
				  $config->config_value = 1;
				  $config->save();
				}
			}
			$this->redirect(array('/mailbox'));
		}
		
		//check
        $config=Configurations::model()->findByAttributes(array('id'=>21));
		{
			if($config!=NULL)
			{
				if($config->config_value)
				{
					$this->redirect(array('/mailbox'));
				}
			}
		}
		$this->render(Yii::app()->getModule('message')->viewPath . '/index');
	}

}
