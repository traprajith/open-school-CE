<?php
$this->breadcrumbs=array(
	'Product Searches'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductSearch', 'url'=>array('index')),
	array('label'=>'Create ProductSearch', 'url'=>array('create')),
	array('label'=>'View ProductSearch', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ProductSearch', 'url'=>array('admin')),
);
?>

<h1>Update ProductSearch <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>