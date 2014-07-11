<?php
$this->breadcrumbs=array(
	'Guardians',
);

$this->menu=array(
	array('label'=>'Create Guardians', 'url'=>array('create')),
	array('label'=>'Manage Guardians', 'url'=>array('admin')),
);
?>

<h1>Guardians</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
