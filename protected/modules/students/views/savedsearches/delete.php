<?php
$this->breadcrumbs=array(
	Yii::t('app','Savedsearches')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','List Savedsearches'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create Savedsearches'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update Savedsearches'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete Savedsearches'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage Savedsearches'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View Savedsearches'); ?> #<?php echo $model->id; ?></h1>

<?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'1'));
?>