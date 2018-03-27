<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers Subjects'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create TeachersSubjects'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage TeachersSubjects'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','Teachers Subjects'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
