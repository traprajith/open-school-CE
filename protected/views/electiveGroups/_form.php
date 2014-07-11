<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elective-groups-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'name'); ?></td>
    <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
    <td><?php echo $form->labelEx($model,'batch_id'); ?></td>
    <td><?php echo $form->textField($model,'batch_id'); ?>
		<?php echo $form->error($model,'batch_id'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'is_deleted'); ?></td>
    <td><?php echo $form->textField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?></td>
    <td><?php echo $form->labelEx($model,'created_at'); ?></td>
    <td><?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'updated_at'); ?></td>
    <td><?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
</table>

	<div style="padding:20px 0 0 0px; text-align:center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->