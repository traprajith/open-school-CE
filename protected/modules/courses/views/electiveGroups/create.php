<?php
$this->breadcrumbs=array(
	Yii::t('app','Elective Groups')=>array('index'),
	Yii::t('app','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('app','List ElectiveGroups'), 'url'=>array('index')),
	array('label'=>Yii::t('app','Manage ElectiveGroups'), 'url'=>array('admin')),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('app','Create Elective Groups'); ?></h1><br />

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
    
    </td>
  </tr>
</table>