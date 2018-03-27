<div class="formCon">

<div class="formConInner">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-grades-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'name'); ?></td>
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
    <td><?php echo $form->labelEx($model,'priority'); ?></td>
    <td>&nbsp;</td>
    <td><?php //echo $form->textField($model,'priority'); 
		echo $form->dropDownList($model,'priority',array('1'=>Yii::t('app','Low'),'2'=>Yii::t('app','Medium'),'3'=>Yii::t('app','High')),array('prompt'=>Yii::t('app','Select')));
		?>
		<?php echo $form->error($model,'priority'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'status'); ?></td>
    <td>&nbsp;</td>
    <td><?php //echo $form->textField($model,'status'); 
		echo $form->dropDownList($model,'status',array('1'=>Yii::t('app','Active'),'0'=>Yii::t('app','Inactive')),array('prompt'=>Yii::t('app','Select')));
		?>
		<?php echo $form->error($model,'status'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'max_hours_day'); ?></td>
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
    <td><?php echo $form->labelEx($model,'max_hours_week'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'max_hours_week'); ?>
		<?php echo $form->error($model,'max_hours_week'); ?></td>
  </tr>

</table>

	<div style="padding:20px 0 0 0px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->