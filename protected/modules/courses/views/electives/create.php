<?php
$this->breadcrumbs=array(
	Yii::t('Electives','Electives')=>array('index'),
	Yii::t('Electives','Create'),
);

$this->menu=array(
	array('label'=>'List Electives', 'url'=>array('index')),
	array('label'=>'Manage Electives', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('Electives','Create Electives'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
