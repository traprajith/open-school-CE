<?php
$this->breadcrumbs=array(
	Yii::t('app','Subject Names')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','List SubjectName'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create SubjectName'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update SubjectName'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete SubjectName'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage SubjectName'), 'url'=>array('admin')),
);
?>

<h1>View SubjectName #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
	),
)); ?>
