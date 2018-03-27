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
<title><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>
</head>    
<?php
$this->pageTitle=Yii::app()->name . ' - '.Yii::t("app", "OTP");
$this->breadcrumbs=array(
	Yii::t("app", "OTP"),
);
?>

<?php
$minutes= 300;
$time_model= UserOtpDetails::model()->findByAttributes(array('key'=>$_REQUEST['key']));
if($time_model)
{
    
    $otp_log_time = strtotime($time_model->created_at);
    $futureDate = $otp_log_time+(60*5);
    $current_time = strtotime(date("Y-m-d H:i:s"));    
    $minutes= $futureDate- $current_time;
    
    
}

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'otp-form',
	'enableAjaxValidation'=>false,
       // 'action'=>  Yii::app()->createUrl("/user/login/test"),
)); ?>
 <input type="hidden" name="uniqid" value="<?php echo uniqid();?>" />
<div class="loginboxWrapper">

<div class="lw_left">
	<div class="lw_logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/login-logo.png" height="161" /></div>
</div>
<div class="lw_right">
<h1><?php echo Yii::t("app", "Enter the OTP"); ?></h1>

<p><?php 
$message="Please enter the OTP within";
$otp_message= "OTP successfully send";
$notification = NotificationSettings::model()->findByAttributes(array('id'=>20));
if($notification->sms_enabled=='1')
{
    $message= "Please enter the OTP that has been send to your mobile number within ";
    $otp_message= "OTP successfully send to your mobile number";
}
if($notification->mail_enabled == '1')
{
    $message= "Please enter the OTP that has been send to your email address within ";
    $otp_message= "OTP successfully send to your email";
}
if($notification->mail_enabled == '1' && $notification->sms_enabled=='1')
{
    $message= "Please enter the OTP that has been send to your mobile number and email within ";
    $otp_message= "OTP successfully send to your mobile number and email";
}
echo Yii::t("app", $message); ?><span id="count"><?php echo $minutes; ?></span> <?php echo Yii::t("app", "seconds"); ?>...</p>

<div class="form">
    <table>
    <tr>
        <td>
            <?php echo CHtml::beginForm(); ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                      <?php echo CHtml::activeTextField($model,'otp', array('onblur'=>'clearText(this)','onfocus'=>'clearText(this)')) ?>
                      <span style="color: #f00; font-size: 11px;"><?php echo CHtml::error($model, 'otp'); ?></span>
                  </td>
                </tr>   
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="70%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><?php echo CHtml::submitButton(Yii::t("app", "Submit"),array('class'=>'loginbut')); ?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td><?php echo CHtml::Button(Yii::t("app", "Resend OTP"),array('id'=>'otp_resend','class'=>'loginbut')); ?></td>
                </tr>
            </table>
	</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
  </tr>
</table>


<?php echo CHtml::endForm(); ?>
</div>
</div>
<div class="clear"></div>

</div><?php $this->endWidget(); ?>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){
        $("#otp_resend").click(function(){

            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=user/login/resendotp",
                data:{"key":"<?php echo $_REQUEST['key']; ?>","YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                dataType:'JSON',
                success: function(response) {
                    if(response.status=="success")
                    {
                        alert("<?php echo Yii::t("app", $otp_message); ?>");
                        window.location.href= response.url;
                    }
                    else
                    {
                        alert("<?php echo Yii::t("app", "Cannot send new OTP"); ?>")
                    }

                }
            });
            return false;
   });
});
</script>

<script type="text/javascript">

window.onload = function(){

(function(){
  var counter = "<?php echo $minutes; ?>";

  setInterval(function() {
    counter--;
    if (counter >= 0) {
      span = document.getElementById("count");
      span.innerHTML = counter;
    }
    // Display 'counter' wherever you want to display it.
    if (counter === 0) {        
        clearInterval(counter);
        window.location.href= "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=user/login";
    }

  }, 1000);

})();

}

</script>