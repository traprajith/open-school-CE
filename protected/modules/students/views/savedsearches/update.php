<?php
$this->breadcrumbs=array(
	'Savedsearches'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Savedsearches', 'url'=>array('index')),
	array('label'=>'Create Savedsearches', 'url'=>array('create')),
	array('label'=>'View Savedsearches', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Savedsearches', 'url'=>array('admin')),
	
);
?>

<h1>Update Savedsearches <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>