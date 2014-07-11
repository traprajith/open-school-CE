<div class="formCon">

<div class="formConInner" >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'exam-scores-form',
	'enableAjaxValidation'=>false,
)); ?>

	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	 <td width="14%">
		<?php echo $form->labelEx($model,Yii::t('examscore','marks')); ?></td>
		<td width="86%"><?php echo $form->textField($model,'marks',array('size'=>3,'maxlength'=>7)); ?></td>
		<?php echo $form->error($model,'marks'); ?>
        </tr>
	
		<?php echo $form->hiddenField($model,Yii::t('examscore','grading_level_id')); ?>
		<?php echo $form->error($model,'grading_level_id'); ?>
	
<tr>
<tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
	 <td>
		<?php echo $form->labelEx($model,Yii::t('examscore','remarks')); ?></td>
		<td><?php echo $form->textField($model,'remarks',array('size'=>30,'maxlength'=>255)); ?></td>
		<?php echo $form->error($model,'remarks'); ?>
	</tr>
    <tr>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

    </table>

	<?php echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d'))); ?>
		

	<div class="left">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div></div><!-- form -->