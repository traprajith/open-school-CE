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
</head>  
<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Restore"),
);
?>
    <?php 
$menu_color="#ffbb00";
$themes= Themes::model()->findByAttributes(array('user_id'=>1));
if($themes)
{
    $menu_color= $themes->menu_background;
}

?>
<style>
.loginboxWrapper{
	
	border-left:15px <?php echo $menu_color; ?> solid;
}
</style>

<div class="loginboxWrapper">
<div class="lw_left">
	<div class="lw_logo"><a href="https://open-school.org/" target="_blank"><img src="images/login-logo.png" /></a>
    
   
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
		<span class="errorSummary" style="margin-top:8px;"><?php echo Yii::t('app','The username or email you entered is incorrect.');?></span>
	<?php } ?>
	<p class="hint"><?php echo Yii::t('app',"Please enter your login or email addres."); ?></p>
	<div >
		<?php /*?><?php echo CHtml::activeLabel($form,Yii::t('user','login_or_email')); ?><?php */?>
		<?php echo CHtml::activeTextField($form,'login_or_email',array('onblur'=>'clearText(this)','onfocus'=>'clearText(this)','value'=>Yii::t('app','Username or Email'))) ?>
		
	</div>
	
	<div style="padding:10px 0px 0px 0px;">
		<?php echo CHtml::submitButton(Yii::t('app',"Restore"),array('class'=>'loginbut')); ?>
        <span><?php echo CHtml::link(Yii::t('app','Back To Login'), array('/user/login')); ?></span>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<?php endif; ?>
</div>
<div class="clear"></div>
</div>
<div class="opnsl_powered">
<p>Powered by <a  href="#">WIWO</a></p>
</div>
</body>
</html>