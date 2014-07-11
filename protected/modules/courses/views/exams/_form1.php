<div class="formCon" style="width:60%">

<div class="formConInner" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exams-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('exams','start_time')); ?></td>
    <td><?php echo $form->textField($model,'start_time'); ?>
		<?php echo $form->error($model,'start_time'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('exams','end_time')); ?></td>
    <td><?php echo $form->textField($model,'end_time'); ?>
		<?php echo $form->error($model,'end_time'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('exams','maximum_marks')); ?></td>
    <td><?php echo $form->textField($model,'maximum_marks',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'maximum_marks'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('exams','minimum_marks')); ?></td>
    <td><?php echo $form->textField($model,'minimum_marks',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'minimum_marks'); ?></td>
  </tr>
  
</table>


	<div class="row">
		<?php //echo $form->labelEx($model,'grading_level_id'); ?>
		<?php echo $form->hiddenField($model,'grading_level_id'); ?>
		<?php echo $form->error($model,'grading_level_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'weightage'); ?>
		<?php echo $form->hiddenField($model,'weightage'); ?>
		<?php echo $form->error($model,'weightage'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'event_id'); ?>
		<?php echo $form->hiddenField($model,'event_id'); ?>
		<?php echo $form->error($model,'event_id'); ?>
	</div>

	
	<div class="row">
		<?php //echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d'))); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div><!-- form -->