<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Documents'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create StudentDocument'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage StudentDocument'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Student Documents') ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
