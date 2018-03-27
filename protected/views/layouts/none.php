<?php

      $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	  if(isset($settings) and $settings!=NULL)
	  {
		  $lan=$settings->language;
	  }
	  else
	  {
		  $lan='en_us';
	  }
	  
	  
	 Yii::app()->translate->setLanguage($lan);
?>
<?php echo $content; ?>
