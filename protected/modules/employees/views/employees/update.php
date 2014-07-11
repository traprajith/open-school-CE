<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
      <?php $this->renderPartial('/employees/profileleft');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('employees','Update Employee ');?><?php echo $model->first_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>