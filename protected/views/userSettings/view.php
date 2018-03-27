<?php
$this->breadcrumbs=array(
	Yii::t("app",'User Settings')=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t("app",'List UserSettings'), 'url'=>array('index')),
	array('label'=>Yii::t("app",'Create UserSettings'), 'url'=>array('create')),
	array('label'=>Yii::t("app",'Update UserSettings'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t("app",'Delete UserSettings'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t("app",'Are you sure you want to delete this item?'))),
	array('label'=>Yii::t("app",'Manage UserSettings'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t("app",'View UserSettings').' ';?>#<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'date_format',
		'time_format',
	),
)); ?>
