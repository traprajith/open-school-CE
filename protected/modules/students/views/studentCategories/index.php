<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Categories'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create StudentCategories'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage StudentCategories'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Student Categories');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
