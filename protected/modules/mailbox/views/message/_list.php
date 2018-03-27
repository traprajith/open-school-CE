<?php

$userid =$this->module->getUserId();

if($this->getAction()->getId()=='sent') {
	$counterUserId = $data->recipient_id;
}
else {
	if($this->module->getUserId() == $data->initiator_id)
		$counterUserId = $data->interlocutor_id;
	else
		$counterUserId = $data->initiator_id;
}
$username = $this->module->getFromLabel($counterUserId);

if($username && ($this->module->isAdmin() || $this->module->linkUser)) {
	//$url = $this->module->getUrl($counterUserId);
	$url = $this->createUrl('message/view',array('id'=>$data->conversation_id));
	
	if($this->getAction()->getId()!='trash'){
		
		if($url)
			$username = '<a href="'.$url.'">'.$username.'</a>';
	}
	
}
elseif(!$username)
	$username = '<span class="mailbox-deleted-user">'.$this->module->deletedUser.'</span>';

$viewLink = $this->createUrl('message/view',array('id'=>$data->conversation_id));
//if($this->getAction()->getId()=='trash')
//{
//	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
// 'id'=>'mydialog',
// //additional javascript options for the dialog plugin
//   'options'=>array(
//      'title'=>'Restore',
//       'autoOpen'=>false,  ),));
//
//  echo 'You want to restore this mail?';
//$this->endWidget('zii.widgets.jui.CJuiDialog');
//
//// the link that may open the dialog
////echo CHtml::link('open dialog', '#', array(
////   'onclick'=>'$("#mydialog").dialog("open"); return false;',
////));
//}

if($this->getAction()->getId()=='sent') {
	$received = $this->module->getDate($data->created);
	if($this->module->recipientRead)
		$itemCssClass = ($data->isRead($userid))? 'msg-read' : 'msg-deliver';
	else
		$itemCssClass = 'msg-sent';
}
else{ 
	$received = $this->module->getDate($data->modified);
	$itemCssClass = $data->isNew($userid)? 'msg-new' : 'msg-read';
}
switch($itemCssClass)
{
	case 'msg-read': $status = ($this->getAction()->getId()=='sent')? Yii::t('app','Recipient has read your message') : Yii::t('app','Message has been read') ; break;
	case 'msg-deliver':  $status = Yii::t('app','Recipient has not read your message yet');
	case 'msg-new': $status =  ($this->getAction()->getId()=='sent')? Yii::t('app','Recipient has not read your message yet') : Yii::t('app','You received a new message'); break;
	case 'msg-sent': $status = Yii::t('app',"You sent message").$username.Yii::t('app',"a message");
}

/*
*  Subject and description for trash
 and Inbox and Sent */


	$subject  = '<span class="mailbox-subject-text">';
	$subject .= '<a class="mailbox-link" title="'.$status.'" href="'.$viewLink.'">';
	$subjectSeperator = ' - ';
	if(strlen($data->subject) > $this->module->subjectMaxCharsDisplay)
	{
		$subject .= substr($data->subject,0,$this->module->subjectMaxCharsDisplay - strlen($this->module->ellipsis) ). $this->module->ellipsis . '</a></span>';
	}
	else
	{
		$subject .= $data->subject .'</a></span><span class="mailbox-msg-brief">'.$subjectSeperator
			 .substr(strip_tags($data->text),0,$this->module->subjectMaxCharsDisplay - strlen($data->subject) - strlen($subjectSeperator) - strlen($this->module->ellipsis) );
		if(strlen($data->subject) + strlen($data->text) + strlen($subjectSeperator) > $this->module->subjectMaxCharsDisplay)
			$subject .= $this->module->ellipsis;
	}
	$subject = preg_replace('/[\n\r]+/','',$subject);
	$subject.= '</span>';


?>

<tr class="mailbox-item <?php echo $itemCssClass; ?> <?php if($this->getAction()->getId()!='sent') echo 'mailbox-draggable-row'; ?>">
	<?php if($this->getAction()->getId()!='sent'): // add dragdrop handle ?>
		<td width="25" style="width:50px;"><div class="mailbox-item-wrapper mailbox-drag">&nbsp;</div></td>
	<?php else: ?>
    	<td width="25" style="width:50px;"><div class="mailbox-item-wrapper">&nbsp;&nbsp;</div></td>
	<?php endif; ?>
    
    <td width="25" style="width:50px;">
	<?php // if($this->getAction()->getId()=='sent') : ?>
		<?php //<div class="mailbox-item-wrapper">&nbsp;</div> ?>
	<?php //else: ?>
		<div class="mailbox-item-wrapper">
		<label class="ui-helper-reset" for="conv_<?php echo $data->conversation_id; ?>">
		<div class="mailbox-check mailbox-ellipsis">
			<input class="mailbox-check " id="conv_<?php echo $data->conversation_id; ?>" type="checkbox" name="convs[]" value="<?php echo $data->conversation_id; ?>" />
		</div>
		</div>
		</label>
	<?php //endif; ?>
    </td>
    <td width="100" style="width:200px;">
		<div  class="mailbox-item-wrapper mailbox-from mailbox-ellipsis"><?php echo $username; ?></div>
    </td>
    <td width="100%" class="mailbox-subject-brief">
	    <div class="mailbox-item-wrapper mailbox-item-outer mailbox-subject"><div class="mailbox-item-inner mailbox-ellipsis ui-helper-clearfix">
			<?php echo $subject;
			 ?>
		</div></div>
    </td>
    <td width="150" class="mailbox-received">
		<div align="right" class="mailbox-item-wrapper" style="width:80px">
			<?php if($data->is_replied) : ?>
			<div class="mailbox-replied" title="this message has been replied to">&nbsp;&nbsp;</div>
			<?php endif; ?>
			<?php echo $received; ?>
		</div>

    </td>
</tr>




