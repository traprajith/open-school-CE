<?php
$this->breadcrumbs=array(
	'Weekdays'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Weekdays', 'url'=>array('index')),
	array('label'=>'Manage Weekdays', 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/batches/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('weekdays','Create Weekdays');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    </td>
  </tr>
</table>