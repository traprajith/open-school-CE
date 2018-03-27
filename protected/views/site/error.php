<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style_404.css" rel="stylesheet" type="text/css" />
<title><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>

</head>
<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<body>
<div class="f_wrapper">
	
  <div class="f_image"></div>
  <div class="f_txt">
  <h1><?php echo CHtml::encode($message); ?>...</h1>
  <p><?php echo Yii::t('app', 'May be you should'); ?> <a href="#" onClick="window.history.go(-1); return false;"><?php echo Yii::t('app', 'go back'); ?></a><?php echo Yii::t('app', 'or'); ?><?php echo CHtml::link(Yii::t('app','logout'),Yii::app()->getModule('user')->logoutUrl,array('style'=>"color:#f37d36;")); ?></p>
  </div>
    
</div>
</body>
</html>