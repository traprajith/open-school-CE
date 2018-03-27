<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Elective Subjects')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeacherElectiveSubjects'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage TeacherElectiveSubjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Create TeacherElectiveSubjects'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>