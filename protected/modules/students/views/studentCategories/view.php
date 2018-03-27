<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Categories')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('app','List StudentCategories'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Create StudentCategories'), 'url'=>array('create')),
	array('label'=>Yii::t('app','Update StudentCategories'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app','Delete StudentCategories'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('app','Are you sure you want to delete this item?'))),
	array('label'=>Yii::t('app','Manage StudentCategories'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','View StudentCategories');?></h1>

<?php /*?><?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'is_deleted',
	),
)); ?><?php */?>
<div class="tableinnerlist" style="padding-right:25px;">
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td><?php echo Yii::t('app','Name'); ?></td>
    <td><?php echo $model->name; ?></td>
  </tr>

</table>
</div>