

<?php

$newMsgs = $this->module->getNewMsgs();
$action = $this->getAction()->getId();

if($this->module->authManager)
{
	$authNew = Yii::app()->user->checkAccess("Mailbox.Message.New");
	$authInbox = Yii::app()->user->checkAccess("Mailbox.Message.Inbox");
	$authSent = Yii::app()->user->checkAccess("Mailbox.Message.Sent");
	$authTrash = Yii::app()->user->checkAccess("Mailbox.Message.Trash");
}
else
{
	$authNew = $this->module->sendMsgs && (!$this->module->readOnly || $this->module->isAdmin());
	$authInbox = ( !$this->module->readOnly || $this->module->isAdmin() );
	$authTrash = $this->module->trashbox && (!$this->module->readOnly || $this->module->isAdmin());
	$authSent = $this->module->sentbox && (!$this->module->readOnly || $this->module->isAdmin());
}
?>
<div class="mailbox-menu  ui-helper-clearfix">
	<div class="mailbox-menu-folders ui-helper-clearfix">
		<?php
		if($authInbox):?>
		<div id="mailbox-inbox" class="mailbox-menu-item <?php echo ($action=='inbox')? 'mailbox-menu-current' : '' ; ?>">
			<a href="<?php echo $this->createUrl('message/inbox'); ?>" onclick="js:return false;"><?php echo Yii::t('app','Inbox'); ?> </a>
		</div>
		<?php endif;
		if($authSent) : ?>
		<div  id="mailbox-sent" class="mailbox-menu-item <?php if($action=='sent') echo 'mailbox-menu-current '; ?>">
			<a href="<?php echo $this->createUrl('message/sent'); ?>" onclick="js:return false;"><?php echo Yii::t('app','Sent Mail'); ?></a>
		</div>
		<?php endif;
		if($authTrash) : ?>
		<div id="mailbox-trash" class="mailbox-menu-item <?php if($action=='trash') echo 'mailbox-menu-current '; ?>">
			<a href="<?php echo $this->createUrl('message/trash'); ?>"  onclick="js:return false;"><?php echo Yii::t('app','Trash'); ?> </a> 
		</div>
		<?php endif; ?>
        <?php
			if($authNew) :
		?>
            <div class="mailbox-group-mdg icon-group"><a href="<?php echo $this->createUrl('message/newgroup'); ?>"><?php echo Yii::t('app','Group Message'); ?></a></div>   
            <?php  $roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			foreach($roles as $role)
			{
				$rolename = $role->name;
			}
		  if($rolename == 'Admin' or ModuleAccess::model()->check('My Account')) {?>  
            <div class="mailbox-group-mdg icon-new-msg"> <a href="<?php echo $this->createUrl('message/new'); ?>"><?php echo Yii::t('app','New Message'); ?></a></div> 
        <?php }
		endif;
			?>
	</div>
<?php /*?><?php
if($authNew) :
	?>
	<a href="<?php echo $this->createUrl('message/new'); ?>"><div class="mailbox-menu-newmsg  ui-helper-clearfix" align="center">
		<?php echo Yii::t('app','New Message'); ?>
	</div></a>
   <?php  $roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			foreach($roles as $role)
			{
				$rolename = $role->name;
			}
		  if($rolename == 'Admin' or ModuleAccess::model()->check('Home')) {?>
    <a href="<?php echo $this->createUrl('message/newgroup'); ?>"><div class="mailbox-menu-newgrpmsg  ui-helper-clearfix" align="center">
		<span><?php echo Yii::t('app','Group Message'); ?></span>
	</div></a>
<?php }
endif;
    ?><?php */?>

</div>