<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>
	
	<div class="row">
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
		<?php echo $form->error($model, 'itemname'); ?>
	</div>
	
	<div style="padding-top:10px;">
		<?php echo CHtml::submitButton(Yii::t('app', 'Add'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>