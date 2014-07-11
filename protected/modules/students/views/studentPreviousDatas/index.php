<?php
$this->breadcrumbs=array(
	'Student Previous Datases',
);

$this->menu=array(
	array('label'=>'Create StudentPreviousDatas', 'url'=>array('create')),
	array('label'=>'Manage StudentPreviousDatas', 'url'=>array('admin')),
);
?>

<h1>Student Previous Datases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
