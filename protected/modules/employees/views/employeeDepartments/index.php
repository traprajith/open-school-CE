<?php
$this->breadcrumbs=array(
	'Employee Departments',
);

$this->menu=array(
	array('label'=>'Create EmployeeDepartments', 'url'=>array('create')),
	array('label'=>'Manage EmployeeDepartments', 'url'=>array('admin')),
);
?>

<h1>Employee Departments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
