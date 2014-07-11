<?php
$this->breadcrumbs=array(
	'Class Timings'=>array('/courses'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ClassTimings', 'url'=>array('index')),
	array('label'=>'Create ClassTimings', 'url'=>array('create')),
	array('label'=>'Update ClassTimings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClassTimings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassTimings', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('timing','View ClassTimings');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'batch_id',
		'name',
		'start_time',
		'end_time',
		'is_break',
	),
)); ?>
