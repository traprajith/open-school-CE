<style type="text/css">
	.errorSummary{ width:100% !important}
	
	label{ color:#333 !important}
</style>

<?php

$users = array("admin","student","parent","teacher");
$subdomain = explode('.com' , $_SERVER['SERVER_NAME']);
if(in_array(Yii::app()->user->name,$users) && $subdomain[0]=='tryopenschool'){
	throw new CHttpException(404,Yii::t('app','You are not authorized to view this page.'));
}
else{
	$this->pageTitle=Yii::app()->name . ' - '.Yii::t('app',"Profile");
	$this->breadcrumbs=array(
		Yii::t('app',"Profile")=>array('profile'),
		Yii::t('app',"Edit"),
	);

	?>


	<?php 
	   
		$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role					
		foreach($roles as $role)
		{
		   if(sizeof($roles)==1 and $role->name == 'parent')
		   {
			 echo $this->renderPartial('application.modules.parentportal.views.default.leftside');
		   }
		   if(sizeof($roles)==1 and $role->name == 'student')
		   { 
			 echo $this->renderPartial('application.modules.studentportal.views.default.leftside');
		   }
		   if(sizeof($roles)==1 and $role->name == 'teacher')
		   { 
			 echo $this->renderPartial('application.modules.teachersportal.views.default.leftside');
		   }
		}

	 ?>
	 <div class="pageheader">
		  <h2><i class="fa fa-gear"></i><?php echo Yii::t('app','Settings'); ?> <span><?php echo Yii::t('app','Your settings here'); ?></span></h2>
		  <div class="breadcrumb-wrapper">
			<span class="label"><?php echo Yii::t('app','You are here:'); ?></span>
			<ol class="breadcrumb">
			  <!--<li><a href="index.html">Home</a></li>-->
			  <li class="active"><?php echo Yii::t('app','Settings'); ?></li>
			</ol>
		  </div>
		</div>
		
		

	<?php ?> <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal/formstyle.css" /><?php ?>
	 
	 
	 <div class="contentpanel">
		<div class="panel-heading">
        			
	<h3 class="panel-title"><?php echo Yii::t('app','Edit profile'); ?></h3>
<div class="button-bg button-bg-none">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>
						
			   			<li><?php echo CHtml::link('<span>'.Yii::t('app','View').'</span>',array('/user/accountProfile'),array('class'=>'btn btn-primary'));?></li>
						<li><?php echo CHtml::link('<span>'.Yii::t('app','Change Password').'</span>',array('/user/accountProfile/changepassword'),array('class'=>'btn btn-primary'));?></li>
               			<li><?php echo CHtml::link('<span>'.Yii::t('app','Change Preferences').'</span>',array('/user/preferences/edit'),array('class'=>'btn btn-primary'));?></li>

					</ul>
			</div>
		</div>
		

	</div>

	<div class="people-item">
			
	<div class="table-responsive">
		
		
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>

	 <td valign="top">


	<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
	</div>
	<?php endif; ?>



	<div class="form-group">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'profile-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>

	<p style="padding-left:20px;"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app','are required.');?></p>

		<?php echo $form->errorSummary(array($model,$profile)); ?>

	<?php $employee=Employees::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
			$profileFields=$profile->getFields();
			if ($profileFields) {
				foreach($profileFields as $field) {
				?>
				
				
		<div class="form-group">
		
		
		
			<?php echo $form->labelEx($profile,$field->varname,array('class'=>'col-sm-2 control-label'));?>
			<div class="col-sm-6 col-4-reqst">
			<?php
			if ($widgetEdit = $field->widgetEdit($profile)) {
				echo $widgetEdit;
			} elseif ($field->range) {
				echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
			} elseif ($field->field_type=="TEXT") {
				echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
			} else {
				echo $form->textField($profile,$field->varname,array('size'=>60,'class'=>'form-control','maxlength'=>(($field->field_size)?$field->field_size:255),'disabled'=>true));
			}
			echo $form->error($profile,$field->varname); ?>
			</div>
		</div>	
				<?php
				}
			}
	?>
		<div class="form-group">
			<label class="col-sm-2 col-4-reqst control-label">
			<?php echo $form->labelEx($model,'username'); ?>
			</label>
			<div class="col-sm-6 col-4-reqst">
			<?php echo $form->textField($model,'username',array('size'=>20,'class'=>'form-control','maxlength'=>20)); ?>
			<?php echo $form->error($model,'username'); ?>
			 </div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 col-4-reqst control-label">
			<?php echo $form->labelEx($model,'email'); ?>
			</label>
			
			 <div class="col-sm-6 col-4-reqst">
			<?php echo $form->textField($model,'email',array('size'=>60,'class'=>'form-control','maxlength'=>128,)); ?>
			<?php echo $form->error($model,'email'); ?>
			</div>
		</div>
	   

		<div class="form-group">
		
		<label class="col-sm-2 col-4-reqst control-label">
			
			</label>
			
			<div class="col-sm-6 col-4-reqst">
			
			<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'btn btn-danger')); ?>
		</div></div>

	<?php $this->endWidget(); ?>

	</div>
	 </td>
	  </tr>
	</table>
	</div>
	</div>
	</div>
<?php } ?>	
        
      