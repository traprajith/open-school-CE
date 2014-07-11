<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Batches', 'url'=>array('index')),
	array('label'=>'Create Batches', 'url'=>array('create')),
	array('label'=>'Update Batches', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Batches', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Batches', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('Batch','View Batches');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'course_id',
		'start_date',
		'end_date',
		'is_active',
		'is_deleted',
		'employee_id',
	),
)); ?>
