<?php
$this->breadcrumbs=array(
	'Employee Positions',
);

$this->menu=array(
	array('label'=>'Create EmployeePositions', 'url'=>array('create')),
	array('label'=>'Manage EmployeePositions', 'url'=>array('admin')),
);
?>

<h1>Employee Positions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
