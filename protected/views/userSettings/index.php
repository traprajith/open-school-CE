<?php
$this->breadcrumbs=array(
	 Yii::t("app",'User Settings'),
);

$this->menu=array(
	array('label'=> Yii::t("app",'Create UserSettings'), 'url'=>array('create')),
	array('label'=> Yii::t("app",'Manage UserSettings'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t("app",'User Settings');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
