<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="alert-message success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
