<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Documents')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('app','List StudentDocument'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create StudentDocument'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update StudentDocument'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete StudentDocument'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage StudentDocument'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View StudentDocument'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_id',
		'title',
		'file',
		'file_type',
		'created_at',
	),
)); ?>
