<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Positions'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create TeacherPositions'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage TeacherPositions'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Teacher Positions'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
