<!doctype html>
<html>
    
<head>
        <title><?php echo Yii::app()->name.' - '.Yii::t('app','Offline'); ?></title>


<link href='https://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<style>
body{
	background-color:#fb4e2c;
	color:#FFF;
	font-family: 'Roboto', sans-serif;
}
.center-div
{
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 500px;
  height: 500px;

}
h1{
	font-size:26px;
	color:#FFF;
	text-align:center;
	font-weight:400;
}
h2{
	font-size:16px;
	color:#FFF;
	text-align:center;
	font-weight:400;
}
.offline-img{
	padding:0px ;
	margin:50px auto 0px auto;
	width:300px;
	height:190px;
	background: url(<?php echo Yii::app()->request->baseUrl; ?>/images/offline.png) no-repeat center center;
}
.back_but{
	-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
background-color:#FFF;
color:#fb4e2c;
font-size:16px;
text-align:center;
padding:10px 20px;
text-decoration:none;
font-weight:500;
}
.back_but:hover{
	background-color:#f3f1f1;
}
</style>
    </head>
<body>
<div class="center-div">
	<div class="offline-img"></div>
	<h1><?php echo Yii::t('app','We will be back shortly'); ?></h1>
	<h2><?php echo Yii::app()->user->getState('offline_message'); ?> </h2>
        <center><?php echo "<br>".CHtml::link(Yii::t('app',"Back to Login"),array('user/login'),array('class'=>'back_but')); ?></center>
</div>
</body>
</html>