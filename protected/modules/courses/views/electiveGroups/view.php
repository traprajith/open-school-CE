<?php
$this->breadcrumbs=array(
	'Elective Groups'=>array('/courses'),
	$model->name,
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>View ElectiveGroups <?php echo $model->name; ?></h1>

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