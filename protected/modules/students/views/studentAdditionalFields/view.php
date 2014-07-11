<?php
$this->breadcrumbs=array(
	'Student Additional Fields'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List StudentAdditionalFields', 'url'=>array('index')),
	array('label'=>'Create StudentAdditionalFields', 'url'=>array('create')),
	array('label'=>'Update StudentAdditionalFields', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete StudentAdditionalFields', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentAdditionalFields', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>View StudentAdditionalFields #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'status',
	),
)); ?>
</div>
    </td>
  </tr>
</table>