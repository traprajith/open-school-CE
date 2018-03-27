<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Grades'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create TeacherGrades'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage TeacherGrades'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Teacher Grades'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
