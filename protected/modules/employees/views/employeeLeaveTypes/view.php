<?php
$this->breadcrumbs=array(
	'Employee Leave Types'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List EmployeeLeaveTypes', 'url'=>array('index')),
	array('label'=>'Create EmployeeLeaveTypes', 'url'=>array('create')),
	array('label'=>'Update EmployeeLeaveTypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmployeeLeaveTypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeeLeaveTypes', 'url'=>array('admin')),
);
?>

<h1>View EmployeeLeaveTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'status',
		'max_leave_count',
		'carry_forward',
	),
)); ?>
