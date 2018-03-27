<?php
$this->breadcrumbs=array(
	'Settings'=>array('/configurations'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PreviousYearSettings', 'url'=>array('index')),
	array('label'=>'Create PreviousYearSettings', 'url'=>array('create')),
	array('label'=>'View PreviousYearSettings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PreviousYearSettings', 'url'=>array('admin')),
);
?>

<h1>Update PreviousYearSettings <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>