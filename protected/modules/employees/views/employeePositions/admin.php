<?php
$this->breadcrumbs=array(
	'Employee Positions'=>array('admin'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('employee-positions-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('employees','Manage Employee Positions');?></h1>

<div class="edit_bttns" style="top:20px; right:20px;">
    <ul>
    <li><?php echo CHtml::link(Yii::t('employees','<span>Add Position</span>'), array('create'),array('class'=>'addbttn last ')); ?></li>
    </ul>
    </div>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'employee-positions-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	 'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		/*'id',*/
		'name',
		array(
		    'name'=>'employee_category_id',
			'value'=>array($model,'categoryname')
		
		),
		/*'status',*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{update}{delete}',
		),
	),
)); ?>
</div>
    </td>
  </tr>
</table>