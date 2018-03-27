<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Leave Types')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeacherLeaveTypes'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage ETeacherLeaveTypes'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create TeacherLeaveTypes');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>