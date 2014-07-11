

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-departments-form',
	'enableAjaxValidation'=>false,
)); ?>
<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="formCon">

<div class="formConInner">
	

	<?php echo $form->errorSummary($model); ?>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','code')); ?>
		</td>
    <td><?php echo $form->textField($model,'code',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'code'); ?></td>
    <td><?php echo $form->labelEx($model,'name'); ?>
		</td>
    <td><?php echo $form->textField($model,Yii::t('employees','name'),array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
  <tr>
    <td><?php //echo $form->labelEx($model,'status'); ?>
		</td>
    <td><?php echo $form->hiddenField($model,'status',array('value'=>1)); ?>
		<?php echo $form->error($model,'status'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

</table>

	<div style="padding:0px 0 0 0px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->