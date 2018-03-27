<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Comments')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List LogComment'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create LogComment'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View LogComment'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage LogComment'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update Log Comment'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>