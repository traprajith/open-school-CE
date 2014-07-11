<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Countries', 'url'=>array('index')),
	array('label'=>'Manage Countries', 'url'=>array('admin')),
);
?>

<h1>Create Countries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>