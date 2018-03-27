<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Comments'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create LogComment'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage LogComment'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Log Comments'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
