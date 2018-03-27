<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Previous Year Settings'),
);

/*$this->menu=array(
	array('label'=>'List PreviousYearSettings', 'url'=>array('index')),
	array('label'=>'Manage PreviousYearSettings', 'url'=>array('admin')),
);*/
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    	<?php $this->renderPartial('left_side');?>
    </td>
    <td valign="top">
    	<div class="cont_right formWrapper">
			<h1><?php echo Yii::t('app','Previous Year Settings'); ?></h1>
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
    </td>
  </tr>
</table>
