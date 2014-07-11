<div class="wz-navWrapper">
	<ul>
    	<li class="fstep-Current">1</li>
        <li class="sstep">2</li>
        <li class="tstep">3</li>
        <li class="fostep">4</li>
        <li class="fistep">5</li>
    </ul>
<div class="clear"></div>
</div>
<div class="captionWrapper">
	<ul>
    	<li><h2  class="cur">1.Employee Admission</h2><span>General Details</span></li>
        <li><h2>2.Employee Admission</h2><span>General Details</span></li>
        <li><h2>3.Employee Admission</h2><span>General Details</span></li>
        <li><h2>4.Employee Admission</h2><span>General Details</span></li>
        <li class="last"><h2>5.Employee Admission</h2><span>General Details</span></li>
    </ul>
</div>
<div class="formCon">
<h2><span>Step 1.</span> Employee Admission</h2>
<div class="formConInner">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<h3>General Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'employee_number'); ?></td>
    <td><?php echo $form->textField($model,'employee_number',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'employee_number'); ?></td>
    
    <td><?php echo $form->labelEx($model,'joining_date'); ?></td>
    <td><?php echo $form->textField($model,'joining_date',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'joining_date'); ?></td>
   
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'first_name'); ?></td>
    <td><?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?></td>
   
    <td><?php echo $form->labelEx($model,'middle_name'); ?></td>
    <td><?php echo $form->textField($model,'middle_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'middle_name'); ?></td>
    
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'last_name'); ?></td>
    <td><?php echo $form->textField($model,'last_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?></td>
    
  	<td><?php echo $form->labelEx($model,'gender'); ?></td>
    <td><?php echo $form->textField($model,'gender',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'gender'); ?></td>
     
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'date_of_birth'); ?></td>
    <td><?php echo $form->textField($model,'date_of_birth',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'date_of_birth'); ?></td>
   
    <td><?php echo $form->labelEx($model,'employee_department_id'); ?></td>
    <td><?php echo $form->textField($model,'employee_department_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'employee_department_id'); ?></td>
   
  </tr>
  <tr>
  	<td><?php echo $form->labelEx($model,'employee_position_id'); ?></td>
    <td><?php echo $form->textField($model,'employee_position_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'employee_position_id'); ?></td>
    
  	<td><?php echo $form->labelEx($model,'employee_category_id'); ?></td>
    <td><?php echo $form->textField($model,'employee_category_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'employee_category_id'); ?></td>
    
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'employee_grade_id'); ?></td>
    <td><?php echo $form->textField($model,'employee_grade_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'employee_grade_id'); ?></td>
    
    <td><?php echo $form->labelEx($model,'job_title'); ?></td>
    <td><?php echo $form->textField($model,'job_title',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_title'); ?></td>
  
  </tr>
    
  <tr>
  	<td><?php echo $form->labelEx($model,'qualification'); ?></td>
    <td><?php echo $form->textField($model,'qualification',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'qualification'); ?></td>
    <td><?php echo $form->labelEx($model,'status'); ?></td>
    <td><?php echo $form->textField($model,'status',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'status'); ?></td>
  </tr>
    <tr>
    <td><?php echo $form->labelEx($model,'total_experience'); ?></td>
    <td>
    <table width="80%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php echo $form->textField($model,'experience_year',array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'experience_year'); ?></td>
            <td><?php echo $form->textField($model,'experience_month',array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'experience_month'); ?></td>
          </tr>
        </table>

	</td>
    
    <td><?php echo $form->labelEx($model,'experience_detail'); ?></td>
    <td><?php echo $form->textArea($model,'experience_detail',array('rows'=>6, 'cols'=>30)); ?>
		<?php echo $form->error($model,'experience_detail'); ?></td>
    
  </tr>
  
   
</table>
<h3>Personal Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    <td><?php echo $form->labelEx($model,'marital_status'); ?></td>
    <td><?php echo $form->textField($model,'marital_status',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'marital_status'); ?></td>
    <td><?php echo $form->labelEx($model,'children_count'); ?></td>
    <td><?php echo $form->textField($model,'children_count'); ?>
		<?php echo $form->error($model,'children_count'); ?></td>
  </tr>
  
  <tr>
    <td><?php echo $form->labelEx($model,'father_name'); ?></td>
    <td><?php echo $form->textField($model,'father_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'father_name'); ?></td>
    <td><?php echo $form->labelEx($model,'mother_name'); ?></td>
    <td><?php echo $form->textField($model,'mother_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mother_name'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'husband_name'); ?></td>
    <td><?php echo $form->textField($model,'husband_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'husband_name'); ?></td>
    <td><?php echo $form->labelEx($model,'blood_group'); ?></td>
    <td><?php echo $form->textField($model,'blood_group',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'blood_group'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'nationality_id'); ?></td>
    <td><?php echo $form->textField($model,'nationality_id',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nationality_id'); ?></td>
    <td><?php echo $form->labelEx($model,'upload_photo'); ?>
		</td>
    <td><?php echo $form->textField($model,'photo_file_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_file_name'); ?></td>
  </tr>

</table>


<div class="row">
		<?php echo $form->labelEx($model,'status_description'); ?>
		<?php echo $form->textField($model,'status_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'status_description'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'reporting_manager_id'); ?>
        <?php echo $form->textField($model,'reporting_manager_id'); ?>
		<?php echo $form->error($model,'reporting_manager_id'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_address_line1'); ?>
		<?php echo $form->textField($model,'home_address_line1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address_line1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_address_line2'); ?>
		<?php echo $form->textField($model,'home_address_line2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_address_line2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_city'); ?>
		<?php echo $form->textField($model,'home_city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_state'); ?>
		<?php echo $form->textField($model,'home_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_country_id'); ?>
		<?php echo $form->textField($model,'home_country_id'); ?>
		<?php echo $form->error($model,'home_country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_pin_code'); ?>
		<?php echo $form->textField($model,'home_pin_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_pin_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_address_line1'); ?>
		<?php echo $form->textField($model,'office_address_line1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_address_line2'); ?>
		<?php echo $form->textField($model,'office_address_line2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_address_line2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_city'); ?>
		<?php echo $form->textField($model,'office_city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_state'); ?>
		<?php echo $form->textField($model,'office_state',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_country_id'); ?>
		<?php echo $form->textField($model,'office_country_id'); ?>
		<?php echo $form->error($model,'office_country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_pin_code'); ?>
		<?php echo $form->textField($model,'office_pin_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_pin_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_phone1'); ?>
		<?php echo $form->textField($model,'office_phone1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office_phone2'); ?>
		<?php echo $form->textField($model,'office_phone2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'office_phone2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile_phone'); ?>
		<?php echo $form->textField($model,'mobile_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home_phone'); ?>
		<?php echo $form->textField($model,'home_phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'home_phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_content_type'); ?>
		<?php echo $form->textField($model,'photo_content_type',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_content_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_data'); ?>
		<?php echo $form->textField($model,'photo_data'); ?>
		<?php echo $form->error($model,'photo_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo_file_size'); ?>
		<?php echo $form->textField($model,'photo_file_size'); ?>
		<?php echo $form->error($model,'photo_file_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->