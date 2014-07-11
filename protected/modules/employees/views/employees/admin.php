<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Employees', 'url'=>array('index')),
	array('label'=>'Create Employees', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employees-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Employees</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employees-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'employee_category_id',
		'employee_number',
		'joining_date',
		'first_name',
		'middle_name',
		/*
		'last_name',
		'gender',
		'job_title',
		'employee_position_id',
		'employee_department_id',
		'reporting_manager_id',
		'employee_grade_id',
		'qualification',
		'experience_detail',
		'experience_year',
		'experience_month',
		'status',
		'status_description',
		'date_of_birth',
		'marital_status',
		'children_count',
		'father_name',
		'mother_name',
		'husband_name',
		'blood_group',
		'nationality_id',
		'home_address_line1',
		'home_address_line2',
		'home_city',
		'home_state',
		'home_country_id',
		'home_pin_code',
		'office_address_line1',
		'office_address_line2',
		'office_city',
		'office_state',
		'office_country_id',
		'office_pin_code',
		'office_phone1',
		'office_phone2',
		'mobile_phone',
		'home_phone',
		'email',
		'fax',
		'photo_file_name',
		'photo_content_type',
		'photo_data',
		'created_at',
		'updated_at',
		'photo_file_size',
		'user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
