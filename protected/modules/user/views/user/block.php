<?php
	$lan	= 'en_us';
	if(isset($_SESSION['user-lan'])){
		$lan	= $_SESSION['user-lan'];
	}
	else{
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		if(isset($settings) and $settings!=NULL)
		{
			$lan	= $settings->language;
		}
	}
	
	Yii::app()->translate->setLanguage($lan);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
<link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_logo/favicon.ico"/>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery-1.7.1.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/capslock.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js_plugins/showpassword/jquery.showPassword.js"></script>

<style>
.show-password-link {
	display: block;
	position: absolute;
	z-index: 11;
	background: url(images/psswrd_shwhide_icon.png) no-repeat;
	width: 18px;
	height: 12px;
	left: 212px !important;
}
.password-showing {
	position: absolute;
	z-index: 10;
}
	/*.loginboxWrapper{ height:400px;width: 838px;}
	.lw_right{    width: 377px;}
	.lw_left {width: 419px;}
	.lw_logo {top: 95px;left: 104px;}
	
*/
.lw_right{ float:right; height:100%;}
.lw_left { float:left; height:100%;}
.loginboxWrapper{  display:flex; height:100%;}
.ip-blocked{
padding: 113px 0px;
    width: 100%;
    text-align:center;
    font-size: 20px;
    color: red;
    font-weight: 600;
}

</style>
<title>
<?php $college=Configurations::model()->findByPk(1); ?>
<?php echo $college->config_value ; ?></title>
</head>
<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t("app", "Login");
$flag	=	1;


?>

<div class="loginboxWrapper">

	<div class="ip-blocked"><?php echo Yii::t('app','Too many incorrect entries, Your IP is blocked for 5.00 Hours!!');; ?></div>

</div>

</body></html>
