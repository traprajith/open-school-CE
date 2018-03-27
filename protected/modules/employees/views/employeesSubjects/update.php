<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers Subjects')=>array('create'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);


?>

<h1><?php echo Yii::t('app','Update Teachers Subjects ');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>