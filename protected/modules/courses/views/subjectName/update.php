<?php
$this->breadcrumbs=array(
	Yii::t('app','Subject Names')=>array('/courses'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List SubjectName'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create SubjectName'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View SubjectName'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage SubjectName'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update Subject Name').$model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>