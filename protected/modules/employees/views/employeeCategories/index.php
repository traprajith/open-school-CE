<?php
$this->breadcrumbs=array(
	'Employee Categories',
);

$this->menu=array(
	array('label'=>'Create EmployeeCategories', 'url'=>array('create')),
	array('label'=>'Manage EmployeeCategories', 'url'=>array('admin')),
);
?>

<h1>Employee Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
