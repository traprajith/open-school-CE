<div class="formCon">

<div class="formConInner">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-grades-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','name')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','priority')); ?></td>
    <td>&nbsp;</td>
    <td><?php //echo $form->textField($model,'priority'); 
		echo $form->dropDownList($model,'priority',array('1'=>'Low','2'=>'Medium','3'=>'High'),array('prompt'=>'Select'));
		?>
		<?php echo $form->error($model,'priority'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','status')); ?></td>
    <td>&nbsp;</td>
    <td><?php //echo $form->textField($model,'status'); 
		echo $form->dropDownList($model,'status',array('1'=>'Active','0'=>'Inactive'),array('prompt'=>'Select'));
		?>
		<?php echo $form->error($model,'status'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','max_hours_day')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'max_hours_day'); ?>
		<?php echo $form->error($model,'max_hours_day'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','max_hours_week')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'max_hours_week'); ?>
		<?php echo $form->error($model,'max_hours_week'); ?></td>
  </tr>

</table>

	<div style="padding:20px 0 0 0px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->