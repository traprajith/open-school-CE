<?php
$this->breadcrumbs=array(
	'Employee Categories'=>array('admin'),
	$model->name,
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('employees','View EmployeeCategories');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'prefix',
		'status',
	),
)); ?>
</div>
    </td>
  </tr>
</table>