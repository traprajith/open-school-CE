<?php

//CVarDumper::dump($data); return;

$userid =$this->module->getUserId();


$viewLink = $this->createUrl('news/info',array('id'=>$data->conversation_id));
//$deleteLink = $this->createUrl('message/delete',array('id'=>$data->conversation_id));


$received = $this->module->getDate($data->modified);
$itemCssClass = $data->isNew($userid)? 'msg-new' : 'msg-read';

$status = "View this news update";
?>
<tr class="mailbox-item <?php echo $itemCssClass; ?> <?php if($this->getAction()->getId()!='sent') echo 'mailbox-draggable-row'; ?>">
	<?php if($this->getAction()->getId()!='sent'): // add dragdrop handle ?>
    <td style="width:15px;"><div class="mailbox-item-wrapper mailbox-drag">&nbsp;</div></td>
    <?php else: ?>
    <td style="width:25px;"><div class="mailbox-item-wrapper">&nbsp;</div></td>
	<?php endif; ?>
    
	<?php if( $this->module->isAdmin() ) : ?>
    <td align="left" style="width:40px;">
		<label class="ui-helper-reset" for="conv_<?php echo $data->conversation_id; ?>">
		<div class="mailbox-item-wrapper mailbox-check">
			<input class="mailbox-check " id="conv_<?php echo $data->conversation_id; ?>" type="checkbox" name="convs[]" value="<?php echo $data->conversation_id; ?>" />
		</div>
		</label>
    </td>
	<?php endif; ?>
    <td class="mailbox-subject-brief" align="center" style="width:450px;">
		<div class="mailbox-item-wrapper mailbox-subject mailbox-ellipsis">
        	<a class="mailbox-link" title="<?php echo $status; ?>" href="<?php echo $viewLink; ?>">
            <span style="width:55%; display:inline-block; float:left;">&nbsp;</span>
			<span class="mailbox-subject-text" style="width:auto; min-width:15%; display:inline-block; float:left;"><?php echo preg_replace('/[\s]+/','&nbsp;',(($data->subject)? $data->subject : $this->module->defaultSubject)); ?></span>
            <span class="mailbox-msg-brief" style="width:15%; display:inline-block; float:left;">&nbsp;-&nbsp;<?php echo preg_replace('/[\s]+/','&nbsp;',substr($data->text,0,50)); ?></span>
            <span style="width:15%; display:inline-block; float:left; max-width: 15%;">&nbsp;</span>
            </a>
		</div>
    </td>
    <td style="width:50px;"  align="right" >
		<div class="mailbox-item-wrapper mailbox-ellipsis">
			<?php if($data->is_replied) : ?>
			<div class="mailbox-replied" title="this message has been replied to"></div>
			<?php endif; ?>
            <a class="mailbox-link" title="<?php echo $status; ?>" href="<?php echo $viewLink; ?>">
			<?php echo $received; ?>
            </a>
		</div>

    </td>
    <td style="width:15px;"  align="right" >
     </td>
</tr>





