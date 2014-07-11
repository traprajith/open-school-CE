<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<div id="othleft-sidebar">
<?php $this->renderPartial('//configurations/left_side');?>
  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper">

<h1><?php echo UserModule::t('Change password'); ?></h1>
<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo $form->errorSummary($model); ?>
    <div style="background:#FFF;">
<table class="detail-view">
	<tr>
		<th class="label"><?php echo $form->labelEx($model,Yii::t('user','oldPassword'),array('style'=>'color:#222222;')); ?></th>
	    <td><?php echo $form->passwordField($model,'oldPassword'); ?>
	<?php echo $form->error($model,'oldPassword'); ?></td>
	</tr>
	<?php 
		
			?>
	<tr>
		<th class="label"><?php echo $form->labelEx($model,Yii::t('user','password'),array('style'=>'color:#222222;')); ?></th>
    	<td><?php echo $form->passwordField($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
	<p class="hint">
	<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
	</p></td>
	</tr>
			
	<tr>
		<th class="label"><?php echo $form->labelEx($model,Yii::t('user','verifyPassword'),array('style'=>'color:#222222;')); ?></th>
    	<td><?php echo $form->passwordField($model,'verifyPassword'); ?>
	<?php echo $form->error($model,'verifyPassword'); ?></td>
	</tr>
	
</table>
<div class="row submit">

	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

</div>
 </td>
  </tr>
</table>
</div>

	
	
<?php $this->endWidget(); ?>
<!-- form -->