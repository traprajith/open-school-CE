<?php
$this->breadcrumbs=array(
	'Student Additional Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentAdditionalFields', 'url'=>array('index')),
	array('label'=>'Create StudentAdditionalFields', 'url'=>array('create')),
	array('label'=>'View StudentAdditionalFields', 'url'=>array('view', 'id'=>$model->id)),
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
<h1>Update StudentAdditionalFields <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>