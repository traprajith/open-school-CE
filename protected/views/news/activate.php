<?php
$this->breadcrumbs=array(
	Yii::t('app','SMS Gateways') =>array('admin'),
	Yii::t('app','Activate'),
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Activate Gateway');?></h1>

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
    <td><?php echo $form->labelEx($model,Yii::t('app','Select Gateway *')); //translate required..?></td>
    <td><?php echo $form->dropDownList($model,'config_value',array(0=>Yii::t('app','Select Gateway'))+CHtml::listData(ConfigSms::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'config_value'); ?></td></tr>
  
</table>


	

	<div style="padding-top:20px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->
</div>
    </td>
  </tr>
</table>