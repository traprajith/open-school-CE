<?php
$this->breadcrumbs=array(
	'Cms Nodes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List CmsNode', 'url'=>array('index')),
	array('label'=>'Create CmsNode', 'url'=>array('create')),
	array('label'=>'Update CmsNode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CmsNode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CmsNode', 'url'=>array('admin')),
);
?>

<h1>View CmsNode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'updated',
		'parentId',
		'name',
		'deleted',
	),
)); ?>
