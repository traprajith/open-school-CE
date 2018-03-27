<?php
$this->breadcrumbs=array(
	Yii::t('app',ucfirst($this->module->id))=>array('message/inbox'),
	Yii::t('app','Message'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top" id="port-left">
    
     <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        <div class="cont_right formWrapper" style="padding:0px; width:753px;">
      <div id="parent_rightSect">
      <div class="parentright_innercon">
      <div class="mail_head"><?php echo Yii::t('app','Mailbox');?><span><?php echo Yii::t('app','Check your mails here.');?></span></div>
<?php

$this->renderPartial('_menu'); 

$subject = ($conv->subject)? $conv->subject : $this->module->defaultSubject;

if(strlen($subject) > 100)
{
	$subject = substr($subject,0,100);
}

?>
<div >	

		<div style="padding:10px;">
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="mailbox-message-subject  mailbox-ellipsis"><?php echo $subject; ?></div>

<br />
<?php
$first_message=1;
foreach($conv->messages as $msg): 
	$sender = $this->module->getUserName($msg->sender_id);
	if(!$sender)
		$sender = $this->module->deletedUser;
	?>
	<div class="msgfeed">
	<div class="mailbox-message-header">
		<div class="message-sender">
<?php	echo ($msg->sender_id == Yii::app()->user->id)? Yii::t('app','You') : ucfirst($sender);
	echo ($first_message)? ' '.Yii::t('app','said') : ' '.Yii::t('app','replied'); ?></div>
<?php 
	$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	$timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));		
	date_default_timezone_set($timezone->timezone);
	$date = date($settings->displaydate,$msg->created);	
	$time = date($settings->timeformat,$msg->created); 
	   
?>    
		<div class="message-date">
			<?php 
				echo $date.' '.$time;
				
				//echo date("Y-m-d H:i a",$msg->created); 
			?>
        </div>
		<br />
	</div>
	<div class="mailbox-message-text"><?php echo $msg->text; ?></div>
    </div>
	<br />
<?php $first_message=0;
endforeach; 

if($this->module->authManager)
	$authReply = Yii::app()->user->checkAccess("Mailbox.Message.Reply");
else
	$authReply = $this->module->sendMsgs;

if($authReply)
{
	echo Yii::t('app',$this->getAction()->getId());
	
	if($this->getAction()->getId()!='trash'){	
$form=$this->beginWidget('CActiveForm', array(
    'action'=>$this->createUrl('message/reply',array('id'=>$_GET['id'])),
    'id'=>'message-reply-form',
    'enableAjaxValidation'=>false,
)); ?>
	<div class="mailbox-message-reply ui-helper-clearfix">
	<?php /* echo $form->errorSummary(array($reply,$conv));*/ ?>
	<?php echo $form->error($reply,'text'); ?>
		<div class="mailbox-textarea-wrap ui-helper-clearfix">
			<textarea name="text" cols="50" rows="7" placeholder="<?php echo Yii::t('app','Reply here...'); ?>"></textarea>
		</div>
        <div class="clear"></div>
	<div id="mform" ><input type="submit" value="<?php echo Yii::t('app','Send Reply');?>" /></div>
	</div>



<?php $this->endWidget(); }
}
?>
</div>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
</td>
        
      </tr>
    </table>
    </td>
  </tr>
</table>

