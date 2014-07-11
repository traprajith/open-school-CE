<?php
$this->breadcrumbs=array(
	'Exam Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ExamGroups', 'url'=>array('index')),
	array('label'=>'Create ExamGroups', 'url'=>array('create')),
	array('label'=>'Update ExamGroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ExamGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ExamGroups', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('examgroups','View ExamGroups');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'batch_id',
		'exam_type',
		'is_published',
		'result_published',
		'exam_date',
	),
)); ?>
