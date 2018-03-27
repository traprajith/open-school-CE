<?php
$this->breadcrumbs=array(
	Yii::t('app','Academic Years'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create AcademicYears'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage AcademicYears'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Academic Years');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
