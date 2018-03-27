<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('index')),
	array('label'=>'Create'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('create')),
	array('label'=>'Update'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this Course?')),
	array('label'=>'Manage'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'course_id',
		'start_date',
		'end_date',
		'is_active',
		'is_deleted',
		'employee_id',
	),
)); ?>
