<?php
$this->breadcrumbs=array(
	'Weekdays'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Weekdays', 'url'=>array('index')),
	array('label'=>'Create Weekdays', 'url'=>array('create')),
	array('label'=>'Update Weekdays', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Weekdays', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Weekdays', 'url'=>array('admin')),
);
?>

<h1>View Weekdays #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'batch_id',
		'weekday',
	),
)); ?>
