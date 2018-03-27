<?php
class NotificationSettingsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/*function My_OB($str, $flags)
		{
			//remove UTF-8 BOM
			$str = preg_replace("/\xef\xbb\xbf/","",$str);
		 
			return $str;
		}
		
	public function init()
	{
		
		ob_start('My_OB');	
	}*/
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionHelp()
	{ 
		$model = Configurations::model()->findByAttributes(array('id'=>37)); 
		if(isset($_POST['Configurations']) and $_POST['Configurations']!=NULL) 
		{ 
			$model->config_value = 	$_POST['Configurations']['help_link'];
			if($model->save())
			{
				echo CJSON::encode(array(
						'status'=>'success',                                					
				));
				exit;
			}
		}				
        $this->renderPartial('help',array('model'=>$model),false,true);
	}
}
