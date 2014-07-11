<?php
$this->breadcrumbs=array(
	'Exams'=>array('/courses'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Exams', 'url'=>array('index')),
	array('label'=>'Create Exams', 'url'=>array('create')),
	array('label'=>'Update Exams', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Exams', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Exams', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('Exams','View Exams');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'exam_group_id',
		'subject_id',
		'start_time',
		'end_time',
		'maximum_marks',
		'minimum_marks',
		'grading_level_id',
		'weightage',
		'event_id',
		'created_at',
		'updated_at',
	),
)); ?>
