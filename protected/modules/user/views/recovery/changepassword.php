<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
    <title><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>
    <script type="text/javascript">

  function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';

    else if (field.value == '') field.value = field.defaultValue;
 }

</script>
<style type="text/css">
/*.required{ color:#F00}*/

.hint{ color:#C60;}
.loginboxWrapper, .lw_left{
	height:332px;
}
</style>
</head>  


<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>
<div class="loginboxWrapper">
<div class="lw_left">
	<div class="lw_logo"><a href="https://open-school.org/" target="_blank"><img src="images/login-logo.png" /></a>
    
   
    </div>
</div>
<div class="lw_right">
<h1><?php echo UserModule::t("Change Password"); ?></h1>


<div class="form">
<?php echo CHtml::beginForm(); ?>

<p ><?php echo Yii::t('User','Fields with');?><span class="required">*</span><?php echo Yii::t('User','are required.');?></p>
	
	<?php //echo CHtml::errorSummary($form); ?>
	<div class="row">
	<p><?php echo CHtml::activeLabelEx($form,Yii::t('user','password')); ?></p>
	<?php echo CHtml::activePasswordField($form,'password'); ?>
	<p class="hint">
	<?php //echo CHtml::errorSummary($form); 
			echo CHtml::error($form,'password');
	?>
	<?php //echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<p><?php echo CHtml::activeLabelEx($form,Yii::t('user','verifyPassword')); ?></p>
	<?php echo CHtml::activePasswordField($form,'verifyPassword'); ?>
	<?php echo CHtml::error($form,'verifyPassword'); ?>
	</div>
	
	
	<div class="row submit" style="margin-top:15px;">
	<?php echo CHtml::submitButton(UserModule::t("Save"),array('class'=>'loginbut')); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
</div>
<div class="clear"></div>
</div>
<div class="opnsl_powered">
<p>Powered by <a  href="http://wiwo.in/" target="_blank">WIWO</a></p>
</div>