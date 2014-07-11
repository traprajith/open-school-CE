<?php
$this->breadcrumbs=array(
	'Subjects'=>array('/courses'),
	'Manage',
);?>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subjects-grid', {
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
<div class="form" id="jobDialogForm">
<h1><?php echo Yii::t('subjects','Manage Subjects');?></h1>



<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subjects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		
		'name',
		'code',
		'batch_id',
		
		/*
		'elective_group_id',
		'is_deleted',
		'created_at',
		'updated_at',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array
    (
        'update' => array
        (
           
            
            'url'=>'Yii::app()->createUrl("subjects/update", array("val1" => $data->batch_id,"id"=>$data->id))',
			'options'=>array(  
            'ajax'=>array(
                     'url'=>"js:$(this).attr('href')", 
                     'update'=>'#jobDialog', //display a response 
           ),
     ),

        ),
        
        ),
		),
	),
)); ?>
</div>
 	</div>
    <div id="jobDialog"></div>
    </td>
  </tr>
</table>