<?php


class NewsController extends RController
{
	public $buttons = array('admin'=>array('delete'=>'deleted'));
	
	
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
		$dataProvider = new CActiveDataProvider( News::model()->inbox($this->module->newsUserId) );
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
		
		$conv = Mailbox::conversation($id);
		
		$reply = new Message;
		$this->render('info',array('conv'=>$conv, 'reply'=>$reply));
		
	}
	
}