<?php
$this->breadcrumbs=array(
	'Employees Subjects',
);

$this->menu=array(
	array('label'=>'Create EmployeesSubjects', 'url'=>array('create')),
	array('label'=>'Manage EmployeesSubjects', 'url'=>array('admin')),
);
?>

<h1>Employees Subjects</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
