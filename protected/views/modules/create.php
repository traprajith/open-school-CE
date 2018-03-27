<?php
$this->breadcrumbs=array(
	Yii::t('app','Modules')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List Modules'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage Modules'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create Modules');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>