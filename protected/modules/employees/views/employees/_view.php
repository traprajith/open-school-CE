<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_number')); ?>:</b>
	<?php echo CHtml::encode($data->employee_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('joining_date')); ?>:</b>
	<?php echo CHtml::encode($data->joining_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middle_name')); ?>:</b>
	<?php echo CHtml::encode($data->middle_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job_title')); ?>:</b>
	<?php echo CHtml::encode($data->job_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_position_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_position_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_department_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reporting_manager_id')); ?>:</b>
	<?php echo CHtml::encode($data->reporting_manager_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_grade_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_grade_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qualification')); ?>:</b>
	<?php echo CHtml::encode($data->qualification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_detail')); ?>:</b>
	<?php echo CHtml::encode($data->experience_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_year')); ?>:</b>
	<?php echo CHtml::encode($data->experience_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experience_month')); ?>:</b>
	<?php echo CHtml::encode($data->experience_month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_description')); ?>:</b>
	<?php echo CHtml::encode($data->status_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_of_birth')); ?>:</b>
	<?php echo CHtml::encode($data->date_of_birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marital_status')); ?>:</b>
	<?php echo CHtml::encode($data->marital_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('children_count')); ?>:</b>
	<?php echo CHtml::encode($data->children_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('father_name')); ?>:</b>
	<?php echo CHtml::encode($data->father_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mother_name')); ?>:</b>
	<?php echo CHtml::encode($data->mother_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('husband_name')); ?>:</b>
	<?php echo CHtml::encode($data->husband_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blood_group')); ?>:</b>
	<?php echo CHtml::encode($data->blood_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nationality_id')); ?>:</b>
	<?php echo CHtml::encode($data->nationality_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_address_line1')); ?>:</b>
	<?php echo CHtml::encode($data->home_address_line1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_address_line2')); ?>:</b>
	<?php echo CHtml::encode($data->home_address_line2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_city')); ?>:</b>
	<?php echo CHtml::encode($data->home_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_state')); ?>:</b>
	<?php echo CHtml::encode($data->home_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_country_id')); ?>:</b>
	<?php echo CHtml::encode($data->home_country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_pin_code')); ?>:</b>
	<?php echo CHtml::encode($data->home_pin_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_address_line1')); ?>:</b>
	<?php echo CHtml::encode($data->office_address_line1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_address_line2')); ?>:</b>
	<?php echo CHtml::encode($data->office_address_line2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_city')); ?>:</b>
	<?php echo CHtml::encode($data->office_city); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_state')); ?>:</b>
	<?php echo CHtml::encode($data->office_state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_country_id')); ?>:</b>
	<?php echo CHtml::encode($data->office_country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_pin_code')); ?>:</b>
	<?php echo CHtml::encode($data->office_pin_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_phone1')); ?>:</b>
	<?php echo CHtml::encode($data->office_phone1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_phone2')); ?>:</b>
	<?php echo CHtml::encode($data->office_phone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobile_phone')); ?>:</b>
	<?php echo CHtml::encode($data->mobile_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('home_phone')); ?>:</b>
	<?php echo CHtml::encode($data->home_phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_file_name')); ?>:</b>
	<?php echo CHtml::encode($data->photo_file_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_content_type')); ?>:</b>
	<?php echo CHtml::encode($data->photo_content_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_data')); ?>:</b>
	<?php echo CHtml::encode($data->photo_data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo_file_size')); ?>:</b>
	<?php echo CHtml::encode($data->photo_file_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	*/ ?>

</div>