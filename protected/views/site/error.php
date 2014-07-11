<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style_404.css" rel="stylesheet" type="text/css" />
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
  <p>May be you should <a href="#" onClick="window.history.go(-1); return false;">go back</a>or<?php echo CHtml::link(UserModule::t("logout"),Yii::app()->getModule('user')->logoutUrl,array('style'=>"color:#f37d36;")); ?></p>
  </div>
    
</div>
</body>

