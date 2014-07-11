<?php
$this->breadcrumbs=array(
	'Product Searches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductSearch', 'url'=>array('index')),
	array('label'=>'Manage ProductSearch', 'url'=>array('admin')),
);
?>

<h1>Create ProductSearch</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>