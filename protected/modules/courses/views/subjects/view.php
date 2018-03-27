<?php
$this->breadcrumbs=array(
	Yii::t('app','Subjects')=>array('/courses'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Subjects'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Subjects'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Subjects'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Subjects'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage Subjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Subjects'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'batch_id',
		'no_exams',
		'max_weekly_classes',
		'elective_group_id',
		'is_deleted',
		'created_at',
		'updated_at',
	),
)); ?>
