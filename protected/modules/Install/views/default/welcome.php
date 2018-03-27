<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Yii::app()->params['app_name'].' '.Yii::app()->params['version'];?></title>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/reset.css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/welcome.css" media="screen" />
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>
<!--[if IE 6]>
<script src="scripts/DD_belatedPNG.js" type="text/javascript"></script>
<![endif]-->

</head>
<body>
<div id="welcome">
    <?php 
        if(isset($_POST['email'])){
            $this->renderPartial('key2');
        }else{
            $this->renderPartial('key');
        }
    ?>
</div>

</body>
</html>