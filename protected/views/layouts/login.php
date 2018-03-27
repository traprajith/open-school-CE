<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
 //check fav icon set
  $fav=  Favicon::model()->find();
  if(isset($fav->icon) and $fav->icon!="")
  { 
      ?>
      <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_favicon/<?php echo $fav->icon; ?>"/>
  <?php 
  }
  else
  {
      ?>
          <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_logo/favicon.ico"/>
          <?php
  }
 ?>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>
