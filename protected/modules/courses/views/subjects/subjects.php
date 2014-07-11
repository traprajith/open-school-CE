<?php
$this->breadcrumbs=array(
	'Subjects'=>array('/courses'),
	'Manage',
);


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
    
    <?php $this->renderPartial('/batches/left_side');?>
    
    </td>
    <td valign="top">
    
<div class="emp_right">


   <!-- <div class="edit_bttns">
    <ul>
    <li>
    <a class=" edit last" href="#">Edit</a>    </li>
    </ul>
    </div>-->
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('/batches/tab');?>
        
    <div class="clear"></div>
    <div class="emp_cntntbx">




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subjects-grid',
	'dataProvider'=>$model->search(),
	'pager'=>array('cssFile'=>Yii::app()->baseUrl.'/css/formstyle.css'),
 	'cssFile' => Yii::app()->baseUrl . '/css/formstyle.css',
	'columns'=>array(
		'name',
		'code',
		
		
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
           
            
            'url'=>'Yii::app()->createUrl("subjects/update", array("val1" => $_REQUEST["id"],"id"=>$data->id))',
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
<div id="jobDialog"></div>
</div>
</div>
</div>

 	
    </div>
    </td>
  </tr>
</table>