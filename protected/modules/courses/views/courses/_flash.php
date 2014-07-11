
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="flash-success" style="color:#F00">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php
  
  Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY);
?>

