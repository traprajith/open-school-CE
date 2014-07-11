<?php
$this->breadcrumbs=array(
	'Student Categories',
);

$this->menu=array(
	array('label'=>'Create StudentCategories', 'url'=>array('create')),
	array('label'=>'Manage StudentCategories', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('students','Student Categories');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
