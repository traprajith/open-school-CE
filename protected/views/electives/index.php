<?php
$this->breadcrumbs=array(
	'Electives',
);

$this->menu=array(
	array('label'=>'Create Electives', 'url'=>array('create')),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1>Electives</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
