<?php
$this->breadcrumbs=array(
	Yii::t('app','Guardians'),
);

$this->menu=array(
	array('label'=>Yii::t('app','Create Guardians'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Manage Guardians'), 'url'=>array('admin')),
);
?>

<h1>Guardians</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
