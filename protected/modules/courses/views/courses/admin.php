<?php
$this->breadcrumbs=array(
	'Courses'=>array('/courses'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('courses-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>




<?php /*?><?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?><?php */?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
   
    <div class="formCon" style="width:100%">

<div class="formConInner" style="padding-top:10px; font-size:14px; font-weight:bold;"> 
<h1><?php echo Yii::t('batch','Manage Courses');?></h1>
<?php



//$posts_1 = Subjects::model()->findByPK(52);
//$posts=Batches::model()->findByPk($posts_1->batch123->id);
//echo $posts->course123->course_name.'<br>';

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'courses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		/*'id',*/

	
		'course_name',
		/*'code',
		array('name'=>'course_name',
				'type'=>'raw',
				'value'=>'CHtml::link(CHtml::encode($data->course_name), Yii::app()->createUrl("batches/create",array("id"=>$data->id)))'),
		'section_name',
		'is_deleted',
		'created_at',*/
		/*
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{delete}'
		),
	),
)); ?>
	</div></div>
    </td>
  </tr>
</table>
