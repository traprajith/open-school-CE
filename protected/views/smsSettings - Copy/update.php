<?php
$this->breadcrumbs=array(
	'Sms Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SmsSettings', 'url'=>array('index')),
	array('label'=>'Create SmsSettings', 'url'=>array('create')),
	array('label'=>'View SmsSettings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SmsSettings', 'url'=>array('admin')),
);
?>

<h1>Update SmsSettings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>