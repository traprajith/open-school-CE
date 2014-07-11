<?php
$this->breadcrumbs=array(
	'Sms Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SmsSettings', 'url'=>array('index')),
	array('label'=>'Create SmsSettings', 'url'=>array('create')),
	array('label'=>'Update SmsSettings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SmsSettings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SmsSettings', 'url'=>array('admin')),
);
?>

<h1>View SmsSettings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'settings_key',
		'is_enabled',
	),
)); ?>
