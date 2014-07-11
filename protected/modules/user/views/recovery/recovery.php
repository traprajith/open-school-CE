<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
    <script type="text/javascript">

  function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';

    else if (field.value == '') field.value = field.defaultValue;
 }

</script>
</head>  
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>

<div class="loginboxWrapper">
<div class="lw_left">
	<div class="lw_logo"><img src="images/login-logo.png" width="171" height="161" />
    
   
    </div>
</div>
<div class="lw_right">
<h1><?php echo UserModule::t("Restore"); ?></h1>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
</div>
<?php else: ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>

	<?php if (CHtml::errorSummary($form))
	{
		?>
		<span class="errorSummary" style="margin-top:8px;">The username or email you entered is incorrect.</span>
	<?php } ?>
	<p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
	<div >
		<?php /*?><?php echo CHtml::activeLabel($form,Yii::t('user','login_or_email')); ?><?php */?>
		<?php echo CHtml::activeTextField($form,'login_or_email',array('onblur'=>'clearText(this)','onfocus'=>'clearText(this)','value'=>'Username or Email ')) ?>
		
	</div>
	
	<div style="padding:10px 0px 0px 0px;">
		<?php echo CHtml::submitButton(UserModule::t("Restore"),array('class'=>'loginbut')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; ?>
</div>
<div class="clear"></div>
</div>
</body>
</html>