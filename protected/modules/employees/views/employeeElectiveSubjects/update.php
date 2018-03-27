<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher Elective Subjects')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List TeacherElectiveSubjects'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create TeacherElectiveSubjects'), 'url'=>array('create')),
	array('label'=>Yii::t('app','View TeacherElectiveSubjects'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Manage TeacherElectiveSubjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Update TeacherElectiveSubjects'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>