<?php
$this->breadcrumbs=array(
	'Attendances'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attendances', 'url'=>array('index')),
	array('label'=>'Create Attendances', 'url'=>array('create')),
	array('label'=>'View Attendances', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Attendances', 'url'=>array('admin')),
);
?>

<h1>Update Attendances <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>