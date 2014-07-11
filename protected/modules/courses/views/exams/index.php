<?php
$this->breadcrumbs=array(
	'Exams',
);

$this->menu=array(
	array('label'=>'Create Exams', 'url'=>array('create')),
	array('label'=>'Manage Exams', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('exams','Exams');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
