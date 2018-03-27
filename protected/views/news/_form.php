<style type="text/css">
	td.rah textarea{ width:218px !important;}
</style>

<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>
<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-sms-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td><?php echo $form->labelEx($model,'title'); ?></td>
    <td><?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
  <tr>
    <td><?php echo $form->labelEx($model,'content'); ?></td>
    <td class="rah"><?php echo $form->textArea($model,'content',array('rows'=>5)); ?>
		<?php echo $form->error($model,'content'); ?></td></tr>
   
    
</table>


	

	<div style="padding-top:20px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->