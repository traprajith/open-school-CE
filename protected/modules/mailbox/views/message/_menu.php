<style>
.mailbox-menu-newgrpmsg{
	-moz-box-shadow:inset 0px 0px 0px 0px #ffffff !important;
	-webkit-box-shadow:inset 0px 0px 0px 0px #ffffff !important ;
	box-shadow:inset 0px 0px 0px 0px #ffffff !important;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #1bb4fa), color-stop(1, #0994f0) ) !important;
	background:-moz-linear-gradient( center top, #1bb4fa 5%, #0994f0 100% ) !important;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1bb4fa', endColorstr='#0994f0') !important;
	background-color:#1bb4fa !important;
	-moz-border-radius:3px !important;
	-webkit-border-radius:3px !important;
	border-radius:3px !important;
	border:1px solid #0c93d1 !important;
	display:inline-block;
	color:#ffffff !important;
	font-family:arial;
	font-size:12px;
	font-weight:bold;
	padding:8px 14px !important;
	text-decoration:none;
	position:absolute;
	top:16px;
	right:146px;
	/*text-shadow:1px 0px 0px #0664a3;*/
}
.mailbox-menu-newgrpmsg a{color:#fff !important; text-decoration:none !important; display:block;}

</style>

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
			<a href="<?php echo $this->createUrl('message/inbox'); ?>" onclick="js:return false;">Inbox </a>
		</div>
		<?php endif;
		if($authSent) : ?>
		<div  id="mailbox-sent" class="mailbox-menu-item <?php if($action=='sent') echo 'mailbox-menu-current '; ?>">
			<a href="<?php echo $this->createUrl('message/sent'); ?>" onclick="js:return false;">Sent Mail</a>
		</div>
		<?php endif;
		if($authTrash) : ?>
		<div id="mailbox-trash" class="mailbox-menu-item <?php if($action=='trash') echo 'mailbox-menu-current '; ?>">
			<a href="<?php echo $this->createUrl('message/trash'); ?>"  onclick="js:return false;">Trash </a> 
		</div>
		<?php endif; ?>
	</div>
<?php
if($authNew) :
	?>
	<a href="<?php echo $this->createUrl('message/new'); ?>"><div class="mailbox-menu-newmsg  ui-helper-clearfix" align="center">
		<span>New Message</span>
	</div></a>
   <?php  $roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
			foreach($roles as $role)
			{
				$rolename = $role->name;
			}
		  if($rolename == 'Admin') {?>
    <a href="<?php echo $this->createUrl('message/newgroup'); ?>"><div class="mailbox-menu-newgrpmsg  ui-helper-clearfix" align="center">
		<span>Group Message</span>
	</div></a>
<?php }
endif;
    ?>

</div>