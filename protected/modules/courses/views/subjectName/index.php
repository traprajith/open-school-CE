<?php
$this->breadcrumbs=array(
	Yii::t('app','Subject Names'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create SubjectName'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage SubjectName'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Subject Names'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
