<?php
$this->breadcrumbs=array(
	'Elective Groups'=>array('/courses'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ElectiveGroups', 'url'=>array('index')),
	array('label'=>'Create ElectiveGroups', 'url'=>array('create')),
	array('label'=>'View ElectiveGroups', 'url'=>array('view', 'id'=>$model->id)),
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
<h1>Update ElectiveGroups <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>