<?php
$this->breadcrumbs=array(
	'Cms Nodes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CmsNode', 'url'=>array('index')),
	array('label'=>'Create CmsNode', 'url'=>array('create')),
	array('label'=>'View CmsNode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CmsNode', 'url'=>array('admin')),
);
?>

<h1>Update CmsNode <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>