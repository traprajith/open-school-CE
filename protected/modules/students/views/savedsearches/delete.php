<?php
$this->breadcrumbs=array(
	'Savedsearches'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Savedsearches', 'url'=>array('index')),
	array('label'=>'Create Savedsearches', 'url'=>array('create')),
	array('label'=>'Update Savedsearches', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Savedsearches', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Savedsearches', 'url'=>array('admin')),
);
?>

<h1>View Savedsearches #<?php echo $model->id; ?></h1>

<?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'1'));
?>