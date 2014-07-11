<?php
$this->breadcrumbs=array(
	'Employee Leave Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmployeeLeaveTypes', 'url'=>array('index')),
	array('label'=>'Manage EmployeeLeaveTypes', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('employees','Create EmployeeLeaveTypes');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>