 <?php


class NewsController extends RController
{
	public $buttons;
	
	
	public function filters()
	{
		if($this->module->authManager=='rights') {
			return array(
				'rights', // perform access control for CRUD operations
			);
		}
		else return array();
	}
	
	public function behaviors()
	{
		$this->buttons = array('admin'=>array('delete'=>Yii::t('app','deleted')));
		
		return array(
			'ButtonAction'=>array(
				'class'=>'mailbox.behaviors.ButtonActionBehavior',
				'controller'=>$this,
				'module'=>$this->module,
				'buttons'=>$this->buttons,
				'arclass'=>'News',
			)
		);
	}
	
	public function actionIndex($ajax=null)
	{
		if($this->module->isAdmin() && isset($_POST['convs']))
		{
			$this->buttonAction('index','admin');
		}
		$this->module->registerConfig($this->getAction()->getId());
		$cs = $this->module->getClientScript();
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/mailbox.js',CClientScript::POS_END);
		$dataProvider = new CActiveDataProvider( Mailbox::model()->inbox($this->module->newsUserId));
		$data = $dataProvider->getData();
		
		if(isset($ajax))
			$this->renderPartial('news',array('dataProvider'=>$dataProvider));
		else{
			if(!isset($_GET['Mailbox_sort']))
				$_GET['Mailbox_sort'] = 'modified.desc';
			
			$this->render('news',array('dataProvider'=>$dataProvider));
		}
	}
	
	
	
	public function actionInfo($id)
	{
//		$cs =$this->module->getClientScript();
//		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/message.js');
//		$js = '$(".mailbox-message-list").yiiMailboxMessage('.$this->module->getOptions().");";
//		$cs->registerScript('mailbox-js',$js,CClientScript::POS_READY);
		//disable jquery autoload
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
							if($settings!=NULL)
							{	
								$timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
								date_default_timezone_set($timezone->timezone);
							}

		Yii::app()->clientScript->scriptMap=array(
			'jquery.js'=>false,
		);
		$conv = Mailbox::conversation($id);
		$conv->markRead($this->module->getUserId());
		$reply = new Message;
		$this->render('info',array('conv'=>$conv, 'reply'=>$reply));
		
	}
	
}