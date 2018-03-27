<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Categories'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create TeacherCategories'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage TeacherCategories'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Teacher Categories'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
