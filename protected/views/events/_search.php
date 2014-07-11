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
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'end_date'); ?>
		<?php echo $form->textField($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_common'); ?>
		<?php echo $form->textField($model,'is_common'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_holiday'); ?>
		<?php echo $form->textField($model,'is_holiday'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_exam'); ?>
		<?php echo $form->textField($model,'is_exam'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_due'); ?>
		<?php echo $form->textField($model,'is_due'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin_id'); ?>
		<?php echo $form->textField($model,'origin_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'origin_type'); ?>
		<?php echo $form->textField($model,'origin_type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->