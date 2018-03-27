<?php
class MessageController extends RController
{
	public $defaultAction = 'inbox';
	public $buttons = array( // Ex output: {count} messages have been {value}
				'default'=>array('delete'=>'deleted','read'=>'marked read','unread'=>'marked unread'),
				'trash'=>array('delete'=>'permanently deleted','restore'=>'restored')
		);
	
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
				'arclass'=>'Mailbox',
			)
		);
	}
	
	public function actionInbox($ajax=null)
	{
		$this->module->registerConfig($this->getAction()->getId());
		$cs = $this->module->getClientScript();
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/mailbox.js',CClientScript::POS_END);
		//$cs->registerScriptFile($this->module->getAssetsUrl().'/js/mailboxold.js',CClientScript::POS_END);
		//$js = '$("#mailbox-list").yiiMailboxList('.$this->module->getOptions().');console.log(1)';

		//$cs->registerScript('mailbox-js',$js,CClientScript::POS_READY);
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		if($settings!=NULL)
		  {
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
			  date_default_timezone_set($timezone->timezone);
		 }
		
		if(isset($_POST['convs']))
		{
			$this->buttonAction('inbox');
		}
		$dataProvider = new CActiveDataProvider( Mailbox::model()->inbox($this->module->getUserId()) );
		
		if(isset($ajax))
			$this->renderPartial('_mailbox',array('dataProvider'=>$dataProvider));
		else{
			if(!isset($_GET['Mailbox_sort']))
				$_GET['Mailbox_sort'] = 'modified.desc';
				
			$this->render('mailbox',array('dataProvider'=>$dataProvider));
		}
	}
	
	public function actionSent()
	{
		// auth manager
		if(!$this->module->authManager && (!$this->module->sentbox  || ($this->module->readOnly && !$this->module->isAdmin()) ) )
			$this->redirect(array('message/inbox'));
		
		$this->module->registerConfig($this->getAction()->getId());
		
		$this->module->getClientScript()->registerScriptFile($this->module->getAssetsUrl().'/js/jquery.colors.js');
		$this->module->getClientScript()->registerScriptFile($this->module->getAssetsUrl().'/js/mailbox.js',CClientScript::POS_END);
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		if($settings!=NULL)
		  {
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
			  date_default_timezone_set($timezone->timezone);
		 }
		if(isset($_POST['convs']))
		{
			$this->buttonAction('sent');
		}
		$dataProvider = new CActiveDataProvider( DashboardMessage::model()->sent($this->module->getUserId()) );
		$this->render('mailbox',array('dataProvider'=>$dataProvider));
	}
	
	
	public function actionTrash($ajax=null)
	{
		// auth manager
		if(!$this->module->authManager && (!$this->module->trashbox  || ($this->module->readOnly && !$this->module->isAdmin()) ))
			$this->redirect(array('message/inbox'));
		
		$this->module->registerConfig($this->getAction()->getId());
		
		$this->module->getClientScript()->registerScriptFile($this->module->getAssetsUrl().'/js/jquery.colors.js');
		$this->module->getClientScript()->registerScriptFile($this->module->getAssetsUrl().'/js/mailbox.js',CClientScript::POS_END);
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		if($settings!=NULL)
		  {
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
			  date_default_timezone_set($timezone->timezone);
		 }
		if(isset($_POST['convs']))
		{
			$this->buttonAction('trash','trash');
		}
		$period =& $this->module->recyclePeriod;
		Yii::app()->user->setFlash('notice', Yii::t('app',"Messages in the trash are deleted within").$period.Yii::t('app',"days."));
		$dataProvider = new CActiveDataProvider( Mailbox::model()->trash($this->module->getUserId()) );
		if(isset($ajax))
			$this->renderPartial('_mailbox',array('dataProvider'=>$dataProvider));
		else{
			$this->render('mailbox',array('dataProvider'=>$dataProvider));
		}
	}
	
	public function actionNew()
	{
		
		$this->module->registerConfig($this->getAction()->getId());
		$cs = $this->module->getClientScript();
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/compose.js');
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/jquery.combobox.contacts.js');
		$js = '$(".mailbox-compose").yiiMailboxCompose('.$this->module->getOptions().");";
		$cs->registerScript('mailbox-js',$js,CClientScript::POS_READY);
		if(!$this->module->authManager && (!$this->module->sendMsgs  || ($this->module->readOnly && !$this->module->isAdmin()) ))
		   $this->redirect(array('message/inbox'));
		
		if(isset($_POST['Mailbox']['to']))
		{
			$t = time();
			$conv = new Mailbox();
			$conv->subject = ($_POST['Mailbox']['subject'])? $_POST['Mailbox']['subject'] : $this->module->defaultSubject;
			$conv->to = $_POST['Mailbox']['to'];
			$conv->initiator_id = $this->module->getUserIdMail();

			// Check if username exist
			
			if(strlen($_POST['Mailbox']['to'])>1)
				$conv->interlocutor_id = $this->module->getUserIdMail($_POST['Mailbox']['to']);
			else
				$conv->interlocutor_id = 0;
			// ...if not check if To field is user id
			
			
			if(!$conv->interlocutor_id)
			{
				
				if($_POST['Mailbox']['to'] && ($this->module->allowLookupById || $this->module->isAdmin()))
					$username = $this->module->getUserName($_POST['Mailbox']['to']);
				if(@$username) {
					$conv->interlocutor_id = $_POST['Mailbox']['to'];
					$conv->to = $username;
				}
				else {
					// possible that javscript was off and user selected from the userSupportList drop down.
					if(isset($_POST['ajax']['to']) & $this->module->getUserIdMail($_POST['ajax']['to'])) {
						$conv->to = $_POST['ajax']['to'];
						$conv->initiator_id = $this->module->getUserIdMail($_POST['ajax']['to']);
					}
					else
						$conv->addError('to',Yii::t('app','User not found?')); 
				}
			}
			
			if($conv->interlocutor_id && $conv->initiator_id == $conv->interlocutor_id) {
				$conv->addError('to', Yii::t('app',"Can't send message to self!"));
			}
			
			if(!$this->module->isAdmin() && $conv->interlocutor_id == $this->module->newsUserId){
				$conv->addError('to', Yii::t('app',"User not found?"));
			}
			
			// check user-to-user perms
			if(!$conv->hasErrors() && !$this->module->userToUser && !$this->module->isAdmin())
			{
				if(!$this->module->isAdmin($conv->to))
					$conv->addError('to', Yii::t('app',"Invalid user!"));
			}
			
			$conv->modified = $t;
			$conv->bm_read = Mailbox::INITIATOR_FLAG;
			if($this->module->isAdmin())
				$msg = new DashboardMessage('admin');
			else
				$msg = new DashboardMessage('user');
			$msg->text = $_POST['DashboardMessage']['text'];
			$validate = $conv->validate(array('text'),false); // html purify
			$msg->created = $t;			
			$msg->sender_id = $conv->initiator_id;
			$msg->recipient_id = $conv->interlocutor_id;
			if($this->module->checksums) {
				$msg->crc64 = DashboardMessage::crc64($msg->text); // 64bit INT
			}
			else
				$msg->crc64 = 0;
			// Validate
			$validate = $conv->validate(null,false); // don't clear errors
			$validate = $msg->validate() && $validate;
			
			if($validate)
			{
				$conv->save();
				$msg->conversation_id = $conv->conversation_id;
				
				$msg->save();
				
				Yii::app()->user->setFlash('success', Yii::t('app',"Message has been sent!"));
				$this->redirect(array('message/inbox'));
			}
			else
			{
				Yii::app()->user->setFlash('error',Yii::t('app',"Error sending message!"));
			}
		}
		else{
			$conv = new Mailbox();
			if(isset($_GET['id']))
				$conv->to = $this->module->getUserName($_GET['id']);
			elseif(isset($_GET['to']))
				$conv->to = $_GET['to'];
			else
				$conv->to = '';
			$msg = new DashboardMessage();
		}
		$this->render('compose',array('conv'=>$conv,'msg'=>$msg));
	}
	
	public function actionReply()
	{
		if(!$this->module->authManager && (!$this->module->sendMsgs  || ($this->module->readOnly && !$this->module->isAdmin()) ))
			$this->redirect(array('message/inbox'));
		
		$this->module->registerConfig($this->getAction()->getId());
		
		if($this->module->isAdmin())
			$reply = new DashboardMessage('admin');
		else
			$reply = new DashboardMessage('user');
		
		$conv = Mailbox::conversation($_GET['id']);
		
		if(isset($_POST['text']))
		{
			$reply->text = $_POST['text'];
			$validate = $conv->validate(array('text'),false); // html purify
			$reply->conversation_id = $conv->conversation_id;
			if($conv->initiator_id != Yii::app()->user->id) {
				$reply->recipient_id = $conv->initiator_id;
				$conv->bm_read = $conv->bm_read & ~Mailbox::INITIATOR_FLAG;
			}
			else {
				$reply->recipient_id = $conv->interlocutor_id;
				$conv->bm_read = $conv->bm_read & ~Mailbox::INTERLOCUTOR_FLAG;
			}
			
			$reply->sender_id = $this->module->getUserId();

			$reply->created = time();
			$conv->modified = $reply->created;
			
			$reply->crc64 = DashboardMessage::crc64($reply->text);
			
			$conv->bm_deleted = 0; // restore message
			$conv->interlocutor_del = 0;
			$conv->initiator_del = 0;
			
			$validate = $reply->validate();
			$validate = $conv->validate() && $validate;
			
			if($validate)
			{
				$conv->save();
				$reply->save();
				Yii::app()->user->setFlash('success', Yii::t('app',"Message sent!"));
				$this->redirect(array('message/inbox'));
			}
			else{
				Yii::app()->user->setFlash('error', Yii::t('app',"Error sending message!"));
			
				$this->render('message',array('conv'=>$conv, 'reply'=>$reply));
			}
		}
	}
	
	public function actionView()
	{
		$this->module->registerConfig($this->getAction()->getId());
		$cs = $this->module->getClientScript();
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/message.js');
		$js = '$(".mailbox-message-list").yiiMailboxMessage('.$this->module->getOptions().");";
		$cs->registerScript('mailbox-js',$js,CClientScript::POS_READY);
		
		$conv = Mailbox::conversation($_GET['id']);
		
		$conv->markRead($this->module->getUserId());
		$reply = new DashboardMessage;
		$this->render('message',array('conv'=>$conv, 'reply'=>$reply));
		
		
	}
	public function actionNewgroup()
	{
		$this->module->registerConfig($this->getAction()->getId());
		$cs = $this->module->getClientScript();
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/compose.js');
		$cs->registerScriptFile($this->module->getAssetsUrl().'/js/jquery.combobox.contacts.js');
		$js = '$(".mailbox-compose").yiiMailboxCompose('.$this->module->getOptions().");";
		$cs->registerScript('mailbox-js',$js,CClientScript::POS_READY);
		if(!$this->module->authManager && (!$this->module->sendMsgs  || ($this->module->readOnly && !$this->module->isAdmin()) ))
		   $this->redirect(array('message/inbox'));
		
		if(isset($_POST['Mailbox']['to']) and $_POST['Mailbox']['to']!=NULL)
		{ 
	 
		   $users = AuthAssignment::model()->findAllByAttributes(array('itemname'=>$_POST['Mailbox']['to']));
			if($users!=NULL)
			{				
				foreach($users as $user)
				{
					if(!in_array($user->userid, $users_arr) and $user->userid != Yii::app()->user->Id){
						$users_arr[]	= $user->userid;								
					}
					$t = time();
					$conv = new Mailbox();
					$conv->subject = ($_POST['Mailbox']['subject'])? $_POST['Mailbox']['subject'] : $this->module->defaultSubject;
					$conv->to = $user->userid;
					$conv->initiator_id = $this->module->getUserId();
		
					
					$conv->interlocutor_id = $user->userid;
					
					
					
					if($conv->interlocutor_id && $conv->initiator_id == $conv->interlocutor_id) {
						$conv->addError('to', Yii::t('app',"Can't send message to self!"));
					}
					
					if(!$this->module->isAdmin() && $conv->interlocutor_id == $this->module->newsUserId){
						$conv->addError('to',Yii::t('app',"User not found?"));
					}
					
					// check user-to-user perms
					if(!$conv->hasErrors() && !$this->module->userToUser && !$this->module->isAdmin())
					{
						if(!$this->module->isAdmin($conv->to))
							$conv->addError('to', Yii::t('app',"Invalid user!"));
					}
					
					$conv->modified = $t;
					$conv->bm_read = Mailbox::INITIATOR_FLAG;
					if($this->module->isAdmin())
						$msg = new DashboardMessage('admin');
					else
						$msg = new DashboardMessage('user');
					$msg->text = $_POST['DashboardMessage']['text'];
					$validate = $conv->validate(array('text'),false); // html purify
					$msg->created = $t;
					$msg->sender_id = $conv->initiator_id;
					$msg->recipient_id = $conv->interlocutor_id;
					if($this->module->checksums) {
						$msg->crc64 = DashboardMessage::crc64($msg->text); // 64bit INT
					}
					else
						$msg->crc64 = 0;
					// Validate
					$validate = $conv->validate(null,false); // don't clear errors
					$validate = $msg->validate() && $validate;
					
					if($validate)
					{
						$conv->save();
						$msg->conversation_id = $conv->conversation_id;
						$msg->save();
						
						//For Android App
						$reg_arr	= array();
						if(Configurations::model()->isAndroidEnabled()){
							$user_to	= User::model()->findByAttributes(array('id'=>$conv->interlocutor_id));
							$send 		= User::model()->findByAttributes(array('id'=>$conv->initiator_id));
							$reg_ids 	= UserDevice::model()->findAllByAttributes(array('uid'=>$user_to->id));
							
							foreach($reg_ids as $reg_id){
								$reg_arr[] = $reg_id->device_id; 
							}
							$sender_name	= "";
							$profile		= Profile::model()->findByAttributes(array('user_id'=>$msg->sender_id));
							if($profile){
								$sender_name = ucfirst($profile->firstname)." ".ucfirst($profile->lastname);
							}
							
												
							$argument_arr = array('message'=>$msg->text, 'device_id'=>$reg_arr, 'sender_email'=>$send->email, 'sender_name'=>$sender_name, 'conversation_id'=>$msg->conversation_id);                
							Configurations::model()->devicenotice($argument_arr,$conv->subject,"inbox");
						}
						
					}										
					
					Yii::app()->user->setFlash('success', Yii::t('app',"Message has been sent!"));
			
			}			
			$this->redirect(array('message/inbox'));
		}
		else
			{
				Yii::app()->user->setFlash('error', Yii::t('app',"Error sending message! No users in that group!"));
				//Yii::app()->user->setFlash('success', "Check Sent Mail");
				$this->redirect(array('message/newgroup'));
			}	  
				
		}
		else{
			$conv = new Mailbox();
			if(isset($_GET['id']))
				$conv->to = $this->module->getUserName($_GET['id']);
			elseif(isset($_GET['to']))
				$conv->to = $_GET['to'];
			else
				$conv->to = '';
			$msg = new DashboardMessage();
		}
		$this->render('composetogroup',array('conv'=>$conv,'msg'=>$msg));
	}
	

}