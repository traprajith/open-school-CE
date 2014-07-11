
 <?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

 <div >

	<?php if( Yii::app()->user->hasFlash('RightsSuccess')===true ):?>

	    <div class="info">

	        <?php echo Yii::app()->user->getFlash('RightsSuccess'); ?>

	    </div>

	<?php endif; ?>

	<?php if( Yii::app()->user->hasFlash('RightsError')===true ):?>

	    <div class="error">

	        <?php echo Yii::app()->user->getFlash('RightsError'); ?>

	    </div>

	<?php endif; ?>

 </div>