<?php
$this->breadcrumbs=array(
	'Exam Scores'=>array('/courses'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ExamScores', 'url'=>array('index')),
	array('label'=>'Create ExamScores', 'url'=>array('create')),
	array('label'=>'Update ExamScores', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExamScores', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamScores', 'url'=>array('admin')),
);
?>

<h1>View ExamScores #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_id',
		'exam_id',
		'marks',
		'grading_level_id',
		'remarks',
		'is_failed',
		'created_at',
		'updated_at',
	),
)); ?>
