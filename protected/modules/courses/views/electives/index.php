<?php
$this->breadcrumbs=array(
	'Electives',
);

$this->menu=array(
	array('label'=>'Create Electives', 'url'=>array('create')),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('Elective','Electives');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
