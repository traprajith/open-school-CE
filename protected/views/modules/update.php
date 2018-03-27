<?php
$this->breadcrumbs=array(
	Yii::t('app','Modules')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Modules'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Modules'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View Modules'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage Modules'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update Modules');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>