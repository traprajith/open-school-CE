<?php
$this->breadcrumbs=array(
	'Employees Subjects'=>array('create'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>

<h1><?php echo Yii::t('employees','Update Employees Subjects ');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>