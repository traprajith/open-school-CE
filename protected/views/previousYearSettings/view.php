<?php
$this->breadcrumbs=array(
	'Previous Year Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PreviousYearSettings', 'url'=>array('index')),
	array('label'=>'Create PreviousYearSettings', 'url'=>array('create')),
	array('label'=>'Update PreviousYearSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PreviousYearSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PreviousYearSettings', 'url'=>array('admin')),
);
?>

<h1>View PreviousYearSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'settings_key',
		'settings_value',
	),
)); ?>
