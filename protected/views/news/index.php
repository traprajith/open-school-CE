<?php
$this->breadcrumbs=array(
	'Teacher Categories',
);

$this->menu=array(
	array('label'=>Yii::t('employees','Create TeacherCategories'), 'url'=>array('create')),
	array('label'=>Yii::t('employees','Manage TeacherCategories'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('employees','Teacher Categories'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
