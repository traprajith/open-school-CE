<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'student_id'); ?>
		<?php echo $form->textField($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'period_table_entry_id'); ?>
		<?php echo $form->textField($model,'period_table_entry_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forenoon'); ?>
		<?php echo $form->textField($model,'forenoon'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'afternoon'); ?>
		<?php echo $form->textField($model,'afternoon'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->