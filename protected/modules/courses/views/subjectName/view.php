<?php
$this->breadcrumbs=array(
	'Subject Names'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List SubjectName', 'url'=>array('index')),
	array('label'=>'Create SubjectName', 'url'=>array('create')),
	array('label'=>'Update SubjectName', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SubjectName', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SubjectName', 'url'=>array('admin')),
);
?>

<h1>View SubjectName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
	),
)); ?>
