<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-additional-fields-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','name')); ?></td>
    <td><?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','status')); ?></td>
    <td><?php echo $form->radioButtonList($model,'status',array('1'=>'Active','0'=>'Inactive')); ?>
		<?php echo $form->error($model,'status'); ?></td>
  </tr>
</table>

	<div style="padding:20px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->