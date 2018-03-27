<?php
$this->breadcrumbs=array(
	'Previous Year Settings',
);

$this->menu=array(
	array('label'=>'Create PreviousYearSettings', 'url'=>array('create')),
	array('label'=>'Manage PreviousYearSettings', 'url'=>array('admin')),
);
?>

<h1>Previous Year Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
