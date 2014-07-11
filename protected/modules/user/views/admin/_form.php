<div class="captionWrapper">
  <ul>
    	<li><h2 class="cur">User Details</h2></li>
       <!-- <li class="last"><h2>Roles</h2></li>-->
    </ul>
</div>
<div class="formCon">
<div class="formConInner">
<div style="background:none;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('user','Username'),array('style'=>'float:left'));?><span class="required">*</span></td>
    <td><?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('user','Password'),array('style'=>'float:left')); ?><span class="required">*</span></td>
    <td><?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('user','email')); ?></td>
    <td><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('user','superuser')); ?></td>
    <td><?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('user','status')); ?></td>
    <td><?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo $form->error($model,'status'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
   <tr>
    
    <td><?php echo $form->labelEx($profile,$field->varname); ?></td>
    <td><?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>30,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
         <?php echo $form->error($profile,$field->varname); ?>
         </td>
  </tr>
	<tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
			}
		}
?>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'formbut')); ?></td>
  </tr>
  
</table>


<?php $this->endWidget(); ?>
</div>
</div>
</div><!-- form -->