<?php
$this->breadcrumbs=array(
	'Product Searches'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductSearch', 'url'=>array('index')),
	array('label'=>'Create ProductSearch', 'url'=>array('create')),
	array('label'=>'Update ProductSearch', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ProductSearch', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductSearch', 'url'=>array('admin')),
);
?>

<h1>View ProductSearch #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_name',
		'product_brand',
		'product_quantity',
		'c_id',
		'price',
		'status',
	),
)); ?>
