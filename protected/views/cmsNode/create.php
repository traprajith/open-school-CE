<?php
$this->breadcrumbs=array(
	'Cms Nodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CmsNode', 'url'=>array('index')),
	array('label'=>'Manage CmsNode', 'url'=>array('admin')),
);
?>

<h1>Create CmsNode</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>