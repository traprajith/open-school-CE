<?php
$this->breadcrumbs=array(
	Yii::t('app','Log Complaints')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List LogComplaint'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create LogComplaint'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View LogComplaint'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage LogComplaint'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update LogComplaint');?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>