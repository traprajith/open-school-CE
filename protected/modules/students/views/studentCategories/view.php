<?php
$this->breadcrumbs=array(
	'Student Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List StudentCategories', 'url'=>array('index')),
	array('label'=>'Create StudentCategories', 'url'=>array('create')),
	array('label'=>'Update StudentCategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StudentCategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentCategories', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('students','View StudentCategories');?></h1>

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
    <td>Name</td>
    <td><?php echo $model->name; ?></td>
  </tr>

</table>
</div>