<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Leave Types')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','ListTeacherLeaveTypes'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create TeacherLeaveTypes'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update TeacherLeaveTypes'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete TeacherLeaveTypes'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage TeacherLeaveTypes'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View TeacherLeaveTypes'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'status',
		'max_leave_count',
		'carry_forward',
	),
)); ?>
