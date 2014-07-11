<?php
$this->breadcrumbs=array(
	'Elective Groups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ElectiveGroups', 'url'=>array('index')),
	array('label'=>'Create ElectiveGroups', 'url'=>array('create')),
	array('label'=>'Update ElectiveGroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ElectiveGroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ElectiveGroups', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>View ElectiveGroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'batch_id',
		'is_deleted',
		'created_at',
		'updated_at',
	),
)); ?>
</div>
    </td>
  </tr>
</table>