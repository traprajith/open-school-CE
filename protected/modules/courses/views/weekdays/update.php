<?php
$this->breadcrumbs=array(
	'Weekdays'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Weekdays', 'url'=>array('index')),
	array('label'=>'Create Weekdays', 'url'=>array('create')),
	array('label'=>'View Weekdays', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Weekdays', 'url'=>array('admin')),
);
?>

<h1>Update Weekdays <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>