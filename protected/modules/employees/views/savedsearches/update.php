<?php
$this->breadcrumbs=array(
	Yii::t('app','Savedsearches')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Savedsearches'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Savedsearches'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View Savedsearches'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage Savedsearches'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update Savedsearches'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>