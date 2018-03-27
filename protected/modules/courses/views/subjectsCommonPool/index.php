<?php
$this->breadcrumbs=array(
	'Subjects Common Pools',
);

$this->menu=array(
	array('label'=>'Create SubjectsCommonPool', 'url'=>array('create')),
	array('label'=>'Manage SubjectsCommonPool', 'url'=>array('admin')),
);
?>

<h1>Subjects Common Pools</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
