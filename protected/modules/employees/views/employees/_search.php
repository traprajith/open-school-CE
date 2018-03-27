<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_category_id'); ?>
		<?php echo $form->textField($model,'employee_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_number'); ?>
		<?php echo $form->textField($model,'employee_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joining_date'); ?>
		<?php echo $form->textField($model,'joining_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'middle_name'); ?>
		<?php echo $form->textField($model,'middle_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_position_id'); ?>
		<?php echo $form->textField($model,'employee_position_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_department_id'); ?>
		<?php echo $form->textField($model,'employee_department_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reporting_manager_id'); ?>
		<?php echo $form->textField($model,'reporting_manager_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_grade_id'); ?>
		<?php echo $form->textField($model,'employee_grade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'qualification'); ?>
		<?php echo $form->textField($model,'qualification',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'experience_detail'); ?>
		<?php echo $form->textArea($model,'experience_detail',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'experience_year'); ?>
		<?php echo $form->textField($model,'experience_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'experience_month'); ?>
		<?php echo $form->textField($model,'experience_month'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_description'); ?>
		<?php echo $form->textField($model,'status_description',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_of_birth'); ?>
		<?php echo $form->textField($model,'date_of_birth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'marital_status'); ?>
		<?php echo $form->textField($model,'marital_status',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'children_count'); ?>
		<?php echo $form->textField($model,'children_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'father_name'); ?>
		<?php echo $form->textField($model,'father_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mother_name'); ?>
		<?php echo $form->textField($model,'mother_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'husband_name'); ?>
		<?php echo $form->textField($model,'husband_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'blood_group'); ?>
		<?php echo $form->textField($model,'blood_group',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nationality_id'); ?>
		<?php echo $form->textField($model,'nationality_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_address_line1'); ?>
		<?php echo $form->textField($model,'home_address_line1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_address_line2'); ?>
		<?php echo $form->textField($model,'home_address_line2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_city'); ?>
		<?php echo $form->textField($model,'home_city',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_state'); ?>
		<?php echo $form->textField($model,'home_state',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_country_id'); ?>
		<?php echo $form->textField($model,'home_country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_pin_code'); ?>
		<?php echo $form->textField($model,'home_pin_code',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_address_line1'); ?>
		<?php echo $form->textField($model,'office_address_line1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_address_line2'); ?>
		<?php echo $form->textField($model,'office_address_line2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_city'); ?>
		<?php echo $form->textField($model,'office_city',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_state'); ?>
		<?php echo $form->textField($model,'office_state',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_country_id'); ?>
		<?php echo $form->textField($model,'office_country_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_pin_code'); ?>
		<?php echo $form->textField($model,'office_pin_code',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_phone1'); ?>
		<?php echo $form->textField($model,'office_phone1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_phone2'); ?>
		<?php echo $form->textField($model,'office_phone2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mobile_phone'); ?>
		<?php echo $form->textField($model,'mobile_phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'home_phone'); ?>
		<?php echo $form->textField($model,'home_phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_file_name'); ?>
		<?php echo $form->textField($model,'photo_file_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_content_type'); ?>
		<?php echo $form->textField($model,'photo_content_type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_data'); ?>
		<?php echo $form->textField($model,'photo_data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'photo_file_size'); ?>
		<?php echo $form->textField($model,'photo_file_size'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->