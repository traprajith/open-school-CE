<?php
$this->breadcrumbs=array(
	'Timetable Entries'=>array('/courses'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TimetableEntries', 'url'=>array('index')),
	array('label'=>'Create TimetableEntries', 'url'=>array('create')),
	array('label'=>'Update TimetableEntries', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TimetableEntries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TimetableEntries', 'url'=>array('admin')),
);
?>

<h1>View TimetableEntries #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'batch_id',
		'weekday_id',
		'class_timing_id',
		'subject_id',
		'employee_id',
	),
)); ?>
