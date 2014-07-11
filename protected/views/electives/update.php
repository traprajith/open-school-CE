<?php
$this->breadcrumbs=array(
	'Electives'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Electives', 'url'=>array('index')),
	array('label'=>'Create Electives', 'url'=>array('create')),
	array('label'=>'View Electives', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1>Update Electives <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>