<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'username'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'password'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php echo $form->hiddenField($model,'salt',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'salt'); ?>
  <tr>
    <td><?php echo $form->labelEx($model,'email'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?></td>
  </tr>
  
</table>

	<div class="row">
		<?php //echo $form->labelEx($model,'profile'); ?>
		<?php echo $form->hiddenField($model,'profile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'profile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div><!-- form -->