<?php
$this->breadcrumbs=array(
	'Electives'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Electives', 'url'=>array('index')),
	array('label'=>'Create Electives', 'url'=>array('create')),
	array('label'=>'Update Electives', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Electives', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1>View Electives #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'elective_group_id',
		'created_at',
		'updated_at',
	),
)); ?>
