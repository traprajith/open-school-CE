<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Complaints')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List LogComplaint'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage LogComplaint'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create LogComplaint'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>