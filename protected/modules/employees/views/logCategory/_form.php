<style>
.formCon input[type="text"], input[type="password"], textArea, select {padding:6px 3px 6px 3px; width:160px !important;}
.exp_but { right:-11px; margin:0px 2px !important;}

</style>
<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	'enableAjaxValidation'=>false,
));

				
 ?>

<div class="formCon">

<div class="formConInner">


	<p class="note"><?php echo Yii::t("app",'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t("app",'are required.'); ?></p>

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
  
<table width="60%" border="0" cellspacing="0" cellpadding="0">

	 
   
  <tr>
    <td><?php echo $form->labelEx($model,name); ?></td>
    <td><?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
   <?php /*?><tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','editable')); ?></td>
    <td><?php echo $form->checkBox($model,'editable'); ?>
		<?php echo $form->error($model,'editable'); ?></td>
  </tr><?php */?>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<!--  <tr>
    <td><?php /*?><?php echo $form->labelEx($model,Yii::t('app','visible')); ?></td>
    <td><?php echo $form->checkBox($model,'visible'); ?>
		<?php echo $form->error($model,'visible'); ?><?php */?></td>
  </tr>
-->  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
   
</table>

</div>
</div>

	<div style="padding:0px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
<!-- form -->