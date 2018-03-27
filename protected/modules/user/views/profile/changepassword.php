<?php 
$users = array("admin","student","parent","teacher");
$subdomain = explode('.com' , $_SERVER['SERVER_NAME']);
if(in_array(Yii::app()->user->name,$users) && $subdomain[0]=='tryopenschool'){
	throw new CHttpException(404,'You are not authorized to view this page.');
}
else{
	$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
	$this->breadcrumbs=array(
		Yii::t('app',"Profile") => array('/user/profile'),
		Yii::t('app',"Change Password"),
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
		<td width="80" valign="top">
	<div id="othleft-sidebar">
	<?php $this->renderPartial('/default/left_side');?>
	  </div>
	 </td>
	 <td valign="top">


	 
	<div class="cont_right formWrapper usertable">
    	<h1><?php echo Yii::t('app','Change password'); ?></h1>	 


<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo CHtml::link('<span>'.Yii::t('app','View Profile').'</span>',array('/user/profile'),array('class'=>'a_tag-btn'));?></li>
				<li><?php echo CHtml::link('<span>'.Yii::t('app','Edit Profile').'</span>',array('/user/profile/edit'),array('class'=>'a_tag-btn'));?></li>                             
</ul>
</div> 

</div>

	<p style="padding-left:20px;"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app','are required.');?></p>
		<?php echo $form->errorSummary($model); ?>
		<div style="background:#FFF;">
	<table class="detail-view">
		<tr>
			<th class="label"><?php echo $form->labelEx($model,Yii::t('app','oldPassword'),array('style'=>'color:#222222;')); ?></th>
			<td><?php echo $form->passwordField($model,'oldPassword'); ?>
		<?php echo $form->error($model,'oldPassword'); ?></td>
		</tr>
		<?php 
			
				?>
		<tr>
			<th class="label"><?php echo $form->labelEx($model,Yii::t('app','password'),array('style'=>'color:#222222;')); ?></th>
			<td><?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
		<?php echo Yii::t('app',"Minimal password length 4 symbols."); ?>
		</p></td>
		</tr>
				
		<tr>
			<th class="label"><?php echo $form->labelEx($model,Yii::t('app','verifyPassword'),array('style'=>'color:#222222;')); ?></th>
			<td><?php echo $form->passwordField($model,'verifyPassword'); ?>
		<?php echo $form->error($model,'verifyPassword'); ?></td>
		</tr>
		
	</table>
	<br/>
	<div class="row submit">

		<?php echo CHtml::submitButton(Yii::t('app',"Save"),array('class'=>'formbut')); ?>
		</div>

	</div>
    </div>
	 </td>
	  </tr>
	</table>
	</div>

		
		
	<?php $this->endWidget(); ?>
	<!-- form -->
<?php } ?>	