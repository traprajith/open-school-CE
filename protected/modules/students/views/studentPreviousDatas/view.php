<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Previous Datases')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List StudentPreviousDatas'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create StudentPreviousDatas'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update StudentPreviousDatas'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete StudentPreviousDatas'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage StudentPreviousDatas'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View StudentPreviousDatas'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'student_id',
		'institution',
		'year',
		'course',
		'total_mark',
	),
)); ?>
