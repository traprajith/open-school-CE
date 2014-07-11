<?php
$this->breadcrumbs=array(
	'Subject Names'=>array('/courses'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SubjectName', 'url'=>array('index')),
	array('label'=>'Create SubjectName', 'url'=>array('create')),
	array('label'=>'View SubjectName', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SubjectName', 'url'=>array('admin')),
);
?>

<h1>Update SubjectName <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>