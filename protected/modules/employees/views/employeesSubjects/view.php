<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers Subjects')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeachersSubjects'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create TeachersSubjects'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update TeachersSubjects'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete TeachersSubjects'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage TeachersSubjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View TeachersSubjects'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'employee_id',
		'subject_id',
	),
)); ?>
