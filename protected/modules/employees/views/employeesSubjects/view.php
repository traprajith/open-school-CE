<?php
$this->breadcrumbs=array(
	'Employees Subjects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EmployeesSubjects', 'url'=>array('index')),
	array('label'=>'Create EmployeesSubjects', 'url'=>array('create')),
	array('label'=>'Update EmployeesSubjects', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EmployeesSubjects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeesSubjects', 'url'=>array('admin')),
);
?>

<h1>View EmployeesSubjects #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_id',
		'subject_id',
	),
)); ?>
