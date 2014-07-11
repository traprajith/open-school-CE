<?php
$this->breadcrumbs=array(
	'Student Additional Fields',
);

$this->menu=array(
	array('label'=>'Create StudentAdditionalFields', 'url'=>array('create')),
	array('label'=>'Manage StudentAdditionalFields', 'url'=>array('admin')),
);
?>

<h1>Student Additional Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
