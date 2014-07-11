<div class="formCon" style="width:40%">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exam-groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'batch_id'); ?>
		<?php echo $form->hiddenField($model,'batch_id',array('value'=>$_REQUEST['id'])); ?>
		<?php echo $form->error($model,'batch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exam_type'); ?>
		<?php echo $form->dropDownList($model,'exam_type',array('Marks'=>'Marks','Grades'=>'Grades','MarksAndGrades'=>'MarksAndGrades')); ?>
		<?php echo $form->error($model,'exam_type'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'is_published'); ?>
		<?php echo $form->hiddenField($model,'is_published'); ?>
		<?php echo $form->error($model,'is_published'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'result_published'); ?>
		<?php echo $form->hiddenField($model,'result_published'); ?>
		<?php echo $form->error($model,'result_published'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'exam_date'); ?>
		<?php echo $form->hiddenField($model,'exam_date'); ?>
		<?php echo $form->error($model,'exam_date'); ?>
	</div>

	<div style="margin-top:10px; margin-left:3px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>