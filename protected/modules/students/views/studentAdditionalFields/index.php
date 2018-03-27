<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Additional Fields'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create StudentAdditionalFields'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage StudentAdditionalFields'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Student Additional Fields'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
