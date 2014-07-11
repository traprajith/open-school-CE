<div class="captionWrapper">
	<ul>
    	<li><h2>Employee Details</h2></li>
        <li><h2 class="cur">Employee Contact Details</h2></li>
    </ul>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	'enableAjaxValidation'=>true,	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="formCon">

<div class="formConInner">


<?php /*?>	<?php if($form->errorSummary($model)){; ?>
    
    <div class="errorSummary">Input Error<br />
    <span>Please fix the following error(s).</span>
    <?php echo $form->errorSummary($model);?>
    </div>
    <?php } ?><?php */?>
<h3>Home Address</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_address_line1')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_address_line1',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address_line1'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_address_line2')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_address_line2',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address_line2'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_city')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_city',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_city'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_state')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_state',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_state'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_country_id')); ?>
		</td>
    <td><?php echo $form->dropDownList($model,'home_country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('empty'=>'Select Country')); ?>
		<?php echo $form->error($model,'home_country_id'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_pin_code')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_pin_code',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_pin_code'); ?></td>
  </tr>
 <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</div>
<div class="formCon">

<div class="formConInner">

<h3>Office Address</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_address_line1')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_address_line1',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line1'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_address_line2')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_address_line2',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line2'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_city')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_city',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_city'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_state')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_state',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_state'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_country_id')); ?>
		</td>
    <td><?php echo $form->dropDownList($model,'office_country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('empty'=>'Select Country')); ?>
		<?php echo $form->error($model,'office_country_id'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_pin_code')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_pin_code',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_pin_code'); ?></td>
  </tr>

</table>
</div>
</div>
<div class="formCon">

<div class="formConInner">

    <h3>Contact Details</h3>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_phone1')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_phone1',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone1'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','office_phone2')); ?>
		</td>
    <td><?php echo $form->textField($model,'office_phone2',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone2'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','mobile_phone')); ?>
		</td>
    <td><?php echo $form->textField($model,'mobile_phone',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile_phone'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','home_phone')); ?>
		</td>
    <td><?php echo $form->textField($model,'home_phone',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_phone'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('employees','email')); ?>
		</td>
    <td><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','fax')); ?>
		</td>
    <td><?php echo $form->textField($model,'fax',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fax'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

	<div class="row">
		
	</div>
    
    <!-- Hidden Values -->
		<div class="row">
		<?php //echo $form->labelEx($model,'photo_content_type'); ?>
		<?php echo $form->hiddenField($model,'photo_content_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_content_type'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'photo_data'); ?>
		<?php echo $form->hiddenField($model,'photo_data'); ?>
		<?php echo $form->error($model,'photo_data'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->hiddenField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->hiddenField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'photo_file_size'); ?>
		<?php echo $form->hiddenField($model,'photo_file_size'); ?>
		<?php echo $form->error($model,'photo_file_size'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->hiddenField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>
</div>
</div><!-- form -->
	<!-- Hidden Values Ends -->
	<div style="padding:0px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Next Step »' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
