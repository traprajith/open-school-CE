<?php
$this->breadcrumbs=array(
	'Subjects Common Pools'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SubjectsCommonPool', 'url'=>array('index')),
	array('label'=>'Create Subjects CommonPool', 'url'=>array('create')),
	array('label'=>'Update Subjects CommonPool', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SubjectsCommonPool', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SubjectsCommonPool', 'url'=>array('admin')),
);
?>

<h1>View SubjectsCommonPool #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'course_id',
		'subject_name',
		'subject_code',
		'max_weekly_classes',
	),
)); ?>
