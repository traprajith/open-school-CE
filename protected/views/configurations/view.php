<?php
$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Configurations', 'url'=>array('index')),
	array('label'=>'Create Configurations', 'url'=>array('create')),
	array('label'=>'Update Configurations', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Configurations', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Configurations', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>View Configurations #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'config_key',
		'config_value',
	),
)); ?>
</div>
    </td>
  </tr>
</table>