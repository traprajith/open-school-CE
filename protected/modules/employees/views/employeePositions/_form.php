<p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-positions-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','name')); ?></td>
    <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','employee_category_id')); ?></td>
    <td> 
	<?php echo $form->dropDownList($model,'employee_category_id',CHtml::listData(EmployeeCategories::model()->findAll(),'id','name'),array('empty' => 'Select Category')); ?>
	
		<?php echo $form->error($model,'employee_category_id'); ?></td>
  </tr>
</table>

	<div class="row">
		<?php // echo $form->labelEx($model,'status'); ?>
		<?php echo $form->hiddenField($model,'status',array('value'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div style="padding-top:10px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>

</div><!-- form -->