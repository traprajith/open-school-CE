<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-departments-form',
	'enableAjaxValidation'=>false,
)); ?>
 <div class="clear"></div>
<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>

<div class="formCon">


<div class="formConInner">
	

	
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'code'); ?>
		</td>
    <td><?php echo $form->textField($model,'code',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'code'); ?></td>
    <td><?php echo $form->labelEx($model,'name'); ?>
		</td>
    <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->