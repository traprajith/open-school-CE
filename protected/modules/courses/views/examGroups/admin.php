<?php
$this->breadcrumbs=array(
	'Exam Groups'=>array('/courses'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('exam-groups-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>Manage Exam Groups</h1>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'exam-groups-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 		 'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		'id',
		'name',
		'batch_id',
		'exam_type',
		'is_published',
		'result_published',
		/*
		'exam_date',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
    </td>
  </tr>
</table>
</div>