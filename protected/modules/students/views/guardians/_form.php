<?php if(!Yii::app()->controller->action->id=='update') { ?>


<?php } ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guardians-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php if($form->errorSummary($model)){; ?>
    
    <div class="errorSummary">Input Error<br />
    <span>Please fix the following error(s).</span>
    </div>
    <?php } ?>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".flash").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
<p class="note">Fields with <span class="required">*</span> are required.
<?php
if(Yii::app()->user->hasFlash('errorMessage')): ?>
<span class="flash" style="background:#FFF; padding-left:100px; color:#C00;font-size:14px">
	<?php echo Yii::app()->user->getFlash('errorMessage'); ?>
</span>
<?php endif;
?>	
</p>

<div class="formCon">

<div class="formConInner">



	
<h3><?php echo Yii::t('students','Parent - Personal Details');?></h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','first_name')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','last_name')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','relation')); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'first_name',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'last_name',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'relation',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'relation'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','Date of Birth')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','education')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','occupation')); ?></td>
  </tr>
  <tr>
    <td><?php //echo $form->textField($model,'dob');
	$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	if($settings!=NULL)
	{
		$date=$settings->dateformat;
		
		
	}
	else
	$date = 'dd-mm-yy';	
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'dob',
								'model'=>$model,
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'
								),
								'htmlOptions'=>array(
									'style'=>'width:130px;'
								),
							));
		 ?>
		<?php echo $form->error($model,'dob'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'education',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'education'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'occupation',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'occupation'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','income')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'income',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'income'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
</div>
<div class="formCon" >

<div class="formConInner">
<h3>Parent - Contact Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','email')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','office_phone1')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','office_phone2')); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'email',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'office_phone1',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone1'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'office_phone2',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone2'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','mobile_phone')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','office_address_line1')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','office_address_line2')); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'mobile_phone',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile_phone'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'office_address_line1',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line1'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'office_address_line2',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line2'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','city')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','state')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','country_id')); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'city',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'state',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'state'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array(
									'style'=>'width:130px;','empty'=>'Select Country'
								)); ?>
		<?php echo $form->error($model,'country_id'); ?></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
  	<td colspan="5">
    
    	<?php 
		if($model->isNewRecord){
			if($check_flag == 1){
		?>
				<span style="float:left;"><?php echo $form->checkBox($model,'user_create',array('id'=>'user_create','checked'=>'true')); ?></span>
		<?php
			}
			else{
		?>
				<span style="float:left;"><?php echo $form->checkBox($model,'user_create',array('id'=>'user_create')); ?></span>
		<?php
			}
		?>
		<?php echo $form->labelEx($model,Yii::t('students','<h3>Don\'t create parent user</h3>')); ?>
        <?php echo $form->error($model,'user_create'); 
		}?>
    </td>
  </tr>
 
</table>

	<div class="row">
		<?php //echo $form->labelEx($model,'ward_id'); ?>
        <?php 
		if(Yii::app()->controller->action->id == 'create')
		{
		?>
			<?php echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['id'])); ?>
		<?php 
		}
		else
		{
			echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['std']));
		}
		 ?>
		<?php echo $form->error($model,'ward_id'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'created_at'); ?>
         <?php  if(Yii::app()->controller->action->id == 'create')
		{
		 echo $form->hiddenField($model,'created_at',array('value'=>date('d-m-Y')));
		}
		else
		{
		  echo $form->hiddenField($model,'created_at');
		}
		?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->hiddenField($model,'updated_at',array('value'=>date('d-m-Y'))); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	
</div>
</div><!-- form -->
<div class="clear"></div>
<?php
if($guardian_id)
{
	$display_existing = 'display:block;';
	$display_new = 'display:none;';
}
else
{
	$display_existing = 'display:none;';
	$display_new = 'display:block;';
}
?>

<div id="new_guardian" style="padding:0px 0 0 0px; text-align:left; <?php echo $display_new; ?>">
		<?php 
		
			//echo 'hi';
			echo CHtml::submitButton($model->isNewRecord ? 'Emergency Contact »' : 'Save',array('class'=>'formbut')); 
		
		?>
</div>
<div id="existing_guardian" style="padding:0px 0 0 0px; text-align:left; <?php echo $display_existing; ?>">
		<?php 
		
			//echo $guardian_id;
			echo CHtml::submitButton('Emergency Contact »',array('submit' =>CController::createUrl('/students/guardians/update',array('id'=>$guardian_id,'sid'=>$_REQUEST['id'])),'class'=>'formbut')); 
		?>
</div>

<?php $this->endWidget(); ?>