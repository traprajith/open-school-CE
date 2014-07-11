<?php
$this->breadcrumbs=array(
	'User Settings',
);

$this->menu=array(
	array('label'=>'Create UserSettings', 'url'=>array('create')),
	array('label'=>'Manage UserSettings', 'url'=>array('admin')),
);
?>

<h1>User Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
