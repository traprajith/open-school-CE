<?php
$this->breadcrumbs=array(
	'Cms Nodes',
);

$this->menu=array(
	array('label'=>'Create CmsNode', 'url'=>array('create')),
	array('label'=>'Manage CmsNode', 'url'=>array('admin')),
);
?>

<h1>Cms Nodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
