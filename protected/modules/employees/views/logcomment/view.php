<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Comments')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List LogComment'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create LogComment'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update LogComment'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete LogComment'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage LogComment'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Log Comment'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_by',
		'student_id',
		'comment',
		'date',
	),
)); ?>
