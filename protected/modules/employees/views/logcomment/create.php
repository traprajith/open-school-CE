<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Comments')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List LogComment'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage LogComment'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create LogComment'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>