<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Elective Subjects')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeacherElectiveSubjects'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create TeacherElectiveSubjects'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update TeacherElectiveSubjects'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete TeacherElectiveSubjects'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage TeacherElectiveSubjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View TeacherElectiveSubjects'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_id',
		'elective_id',
		'subject_id',
	),
)); ?>
