<?php 
$users = array("admin","student","parent","teacher");
$subdomain = explode('.com' , $_SERVER['SERVER_NAME']);
if(in_array(Yii::app()->user->name,$users) && $subdomain[0]=='tryopenschool'){
	throw new CHttpException(404,'You are not authorized to view this page.');
}
else{
	$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
	$this->breadcrumbs=array(
		UserModule::t("Profile")=>array('profile'),
		UserModule::t("Edit"),
	);

	?>

	 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal/formstyle.css" />
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="80" valign="top">
	<div id="othleft-sidebar">
	<?php $this->renderPartial('/default/left_side');?>
	  </div>
	 </td>
	 <td valign="top">
	<div class="cont_right formWrapper usertable">

	<h1><?php echo UserModule::t('Edit profile'); ?></h1>

	<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
	</div>
	<?php endif; ?>

	
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
			<li><?php echo CHtml::link('<span>'.Yii::t('user','View Profile').'</span>',array('/user/profile'),array('class'=>'a_tag-btn'));?></li>
			 <li><?php echo CHtml::link('<span>'.Yii::t('user','Change Password').'</span>',array('/user/profile/changepassword'),array('class'=>'a_tag-btn'));?></li>                                    
</ul>
</div> 

</div>
	<div class="formCon">
	<div class="formConInner">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'profile-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>

	<p style="padding-left:20px;"><?php echo Yii::t('User','Fields with');?><span class="required">*</span><?php echo Yii::t('User','are required.');?></p>

		<?php echo $form->errorSummary(array($model,$profile)); ?>

	<?php 
			$profileFields=$profile->getFields();
			if ($profileFields) {
				foreach($profileFields as $field) {
				?>
		<div class="row">
			<?php echo $form->labelEx($profile,$field->varname);
			
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
			} elseif ($field->range) {
				echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
			} elseif ($field->field_type=="TEXT") {
				echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
			} else {
				echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'disabled'=>true));
			}
			echo $form->error($profile,$field->varname); ?>
		</div>	
				<?php
				}
			}
	?>
		<div class="row">
			<?php echo $form->labelEx($model,Yii::t('user','username')); ?>
			<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,Yii::t('user','email')); ?>
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'disabled'=>true)); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'formbut')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
	</div>
    </div>
	 </td>
	  </tr>
	</table>
<?php } ?>	
