<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Attendances')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeacherAttendances'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create TeacherAttendances'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update TeacherAttendances'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete TeacherAttendances'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage TeacherAttendances'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View TeacherAttendances'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'attendance_date',
		'employee_id',
		'employee_leave_type_id',
		'reason',
		'is_half_day',
	),
)); ?>
