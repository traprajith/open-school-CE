<?php
$this->breadcrumbs=array(
	'Elective Groups',
);

$this->menu=array(
	array('label'=>'Create ElectiveGroups', 'url'=>array('create')),
	array('label'=>'Manage ElectiveGroups', 'url'=>array('admin')),
);
?>

<h1>Elective Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
