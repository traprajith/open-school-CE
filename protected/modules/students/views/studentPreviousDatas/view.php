<?php
$this->breadcrumbs=array(
	'Student Previous Datases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List StudentPreviousDatas', 'url'=>array('index')),
	array('label'=>'Create StudentPreviousDatas', 'url'=>array('create')),
	array('label'=>'Update StudentPreviousDatas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StudentPreviousDatas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentPreviousDatas', 'url'=>array('admin')),
);
?>

<h1>View StudentPreviousDatas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_id',
		'institution',
		'year',
		'course',
		'total_mark',
	),
)); ?>
