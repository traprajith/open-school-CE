<style type="text/css">
.formCon input[type="text"], input[type="password"], textArea, select {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 250px !important;
}


	
	.formCon input[type="text"] {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 250px !important;
}

</style>

<div class="captionWrapper">
  <ul>
    	<li><h2 class="cur"><?php echo Yii::t('app','User Details'); ?></h2></li>
       <!-- <li class="last"><h2>Roles</h2></li>-->
    </ul>
</div>

<?php $roles = Rights::getAssignedRoles($_REQUEST['id']); 
		if($roles == NULL)
		{?>
			 <div class="edit_bttns" style="top:15px; right:20px">
							<ul>
							<li><?php echo '<span>'.CHtml::link('<span>'.Yii::t('user','Add Role').'</span>',array('/rights/authItem/assignrole', 'id'=>$_REQUEST['id']),array('class'=>'addbttn last')).'</span>';?></li>
							</ul>
						<div class="clear"></div>
					</div>
<?php	}
		foreach($roles as $role)
		{
		  if($role->name=='parent' or $role->name=='student' or $role->name=='teacher')
		  {
			 
		  }
		 
		 else
		  {?>
          		 <div class="edit_bttns" style="top:15px; right:20px">
                        <ul>
                        <li><?php //echo '<span>'.CHtml::link('<span>'.Yii::t('user','Change Role').'</span>',array('/rights/assignment/user', 'id'=>$_REQUEST['id']),array('class'=>'addbttn last')).'</span>';?></li>
                        </ul>
                    <div class="clear"></div>
                </div>
	<?php }
	
		}?>
    
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<?php echo $form->errorSummary(array($model,$profile)); ?>
    <br />

<div class="formCon">
<div class="formConInner">
<div style="background:none;">

<p style="padding-left:20px;"><?php echo Yii::t('User','Fields with');?><span class="required">*</span><?php echo Yii::t('User','are required.');?></p>



	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','Username'),array('style'=>''));?><span class="required">*</span></td>  
    <td><?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','Password'),array('style'=>'')); ?><span class="required">*</span></td> 
    <td><?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'password'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'email'); ?></td>
    <td><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'mobile_number'); ?></td>
    <td><?php echo $form->textField($model,'mobile_number',array('size'=>30,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'mobile_number'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'superuser'); ?></td>
    <td><?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?></td>
	<td><span style= "color:red"><?php echo Yii::t('app','Select "Yes" only for Administrator Level users');?></span></td>	
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'status'); ?></td>
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
    <td><?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?></td>
  </tr>
  
</table>



</div>
</div>
</div>
<?php $this->endWidget(); ?>
<!-- form -->