<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
);

/**$this->menu=array(
	array('label'=>'List ', 'url'=>array('index')),
	array('label'=>'Create ', 'url'=>array('create')),
	array('label'=>'Update ', 'url'=>array('update', 'id'=>$model->)),
	array('label'=>'Delete ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ', 'url'=>array('admin')),
);*/
?>

<h1>View Events #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'start_date',
		'end_date',
		'is_common',
		'is_holiday',
		'is_exam',
		'is_due',
		'created_at',
		'updated_at',
		'origin_id',
		'origin_type',
	),
)); ?>
