<?php
$this->breadcrumbs=array(
	Yii::t('app','Modules')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Modules'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Modules'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Modules'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Modules'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>'Manage Modules', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Modules').' #';?><?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'control',
	),
)); ?>
