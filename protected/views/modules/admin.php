<?php
$this->breadcrumbs=array(
	Yii::t('app','Modules')=>array('index'),
	Yii::t('app','Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('modules-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<div id="othleft-sidebar">
<?php $this->renderPartial('//configurations/left_side');?>
  </div>
 </td>
 <td valign="top">
<div class="cont_right formWrapper">

<h1><?php echo Yii::t('app','Manage Modules');?></h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'modules-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		//'id',
		'name',
		'control',
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
</div>
 </td>
  </tr>
</table>