<?php
$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>Create Book</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>