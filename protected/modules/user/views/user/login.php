<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/capslock.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js_plugins/showpassword/jquery.showPassword.js"></script>
<script type="text/javascript">

  function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';

    else if (field.value == '') field.value = field.defaultValue;
 }

</script> 
<script>
$(document).ready(function() {
  $(':password').showPassword({
    linkRightOffset: 5,
    linkTopOffset: 8,
	linkText: '',
    showPasswordLinkText: '',

  });
});
</script>

<style>

.show-password-link {
  display: block;
  position: absolute;
  z-index: 11;
  background:url(images/psswrd_shwhide_icon.png) no-repeat;
  width:18px;
  height:12px;
  left: 212px !important;
 
 
  
 
 
}
.password-showing {
  position: absolute;
  z-index: 10;
}
</style> 
<title>:: OPEN SCHOOL ::</title>
</head>    
<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>
<!--<div class="loginimg"></div>-->
<div class="loginboxWrapper">
<div class="lw_left">
	<div class="lw_logo"><img src="images/login-logo.png" width="171" height="161" /></div>
</div>
<div class="lw_right">
<h1><?php echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form">

<?php echo CHtml::beginForm(); ?>

	<?php /*?><p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p><?php */?>
	
	<?php if (CHtml::errorSummary($model))
	{
		?>
		<span class="errorSummary">The username or password you entered is incorrect.</span>
	<?php } ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<?php echo CHtml::activeTextField($model,'username', array('onblur'=>'clearText(this)','onfocus'=>'clearText(this)','value'=>'Username or Email ')) ?></td>
  </tr>
  <tr>
    <td><?php echo CHtml::activePasswordField($model,'password', array('onblur'=>'clearText(this)','onfocus'=>'clearText(this)','value'=>'Password')) ?></td>
  </tr>
 <tr><td id="pid" style="color:#C60;background:url(<?php  echo Yii::app()->request->baseUrl; ?>/images/warning.png) no-repeat;display:none;padding-left:25px;"></td></tr>
  <tr>
    <td style="padding:0px;">
    <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:0px;"><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?></td>
    <td align="left" style="padding:0px;"><?php echo CHtml::activeLabelEx($model,Yii::t('user','rememberMe')); ?></td>
  </tr>
</table>

	
		</td>
  </tr>
  <tr>
    <td>
    <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo CHtml::submitButton(UserModule::t("Login"),array('class'=>'loginbut')); ?></td>
    <td><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?></td>
  </tr>
</table>

	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<?php /*?><?php echo CHtml::activeLabelEx($model,Yii::t('user','username')); ?><?php */?>
<?php /*?><?php echo CHtml::activeLabelEx($model,Yii::t('user','password')); ?><?php */?>

<?php echo CHtml::endForm(); ?>
</div>
</div>
<div class="clear"></div>
</div>
</body>
</html>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>
<script type="text/javascript">
$(document).ready(function() {

	var options = {
		caps_lock_on: function() {
			$('#pid').css({"display": "block"});
			$('#pid').html("Caps lock is on");
		},
		caps_lock_off: function() {
			$('#pid').css({"display": "none"});
		},
		
	};

	$("input[type='password']").capslock(options);

});
</script>