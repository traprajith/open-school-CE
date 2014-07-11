<?php
$this->breadcrumbs=array(
	'Buy Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BuyProduct', 'url'=>array('index')),
	array('label'=>'Create BuyProduct', 'url'=>array('create')),
	array('label'=>'View BuyProduct', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BuyProduct', 'url'=>array('admin')),
);
?>

<h1>Update BuyProduct <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>