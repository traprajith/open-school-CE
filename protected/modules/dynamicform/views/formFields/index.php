<?php
$this->breadcrumbs=array(
	'Form Fields',
);

$this->menu=array(
	array('label'=>Yii::t('app','Create FormFields'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage FormFields'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Form Fields');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
