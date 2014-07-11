<?php
$this->breadcrumbs=array(
	'Employee Grades',
);

$this->menu=array(
	array('label'=>'Create EmployeeGrades', 'url'=>array('create')),
	array('label'=>'Manage EmployeeGrades', 'url'=>array('admin')),
);
?>

<h1>Employee Grades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
