<?php
$this->breadcrumbs=array(
	Yii::t('app','Savedsearches'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create Savedsearches'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage Savedsearches'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Savedsearches'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
