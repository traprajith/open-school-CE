<?php
$this->breadcrumbs=array(
	'Electives'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Electives', 'url'=>array('index')),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1>Create Electives</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
