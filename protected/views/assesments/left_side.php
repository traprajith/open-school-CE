<script>
$(document).ready(function() {
	

            //Hide the second level menu
            $('#othleft-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });
</script>

<div id="othleft-sidebar">
<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>
<!--<a href="#enroll_process" id="enroll_p" class="menu_0">Set grading levels<span>Manage your Dashboard</span></a>-->
                    
                    <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.Yii::t('assessments','Set grading levels'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#enroll_process') ,'linkOptions'=>array('id'=>'enroll_p','class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.'<h1>'.Yii::t('assessments','Exam Management').'</h1>'),                                
					
					
						array('label'=>Yii::t('assessments','New Exam'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('/exam&id=3'),'linkOptions'=>array('class'=>'messgnew_ico')),
						
						array('label'=>Yii::t('assessments','Connect Exams'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('/exam&id=3'),
							'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('class'=>'messgnew_ico')),
		 
						array('label'=>''.Yii::t('assessments','Additional Exams'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ), 
							array('label'=>''.Yii::t('assessments','Exam Wise Report'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Subject wise Report'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Grouped exam Reports'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Archived Student Reports'.'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>'), 'url'=>array('#') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
					
						
					
					
				),
			)); ?>
		
		</div>
        
    
    
    
   

<!--<div id="enroll_process" style="display:none">

<script language="javascript">
function batch()
{
	var id= document.getElementById('batchdrop').value;
	window.location ='index.php?r=batches/batchstudents&id='+id;
}
</script>-->
<?php /*?><?php $data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'-Select-',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Weekdays/batch'),
'update'=>'#batchdrop',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Batch';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
 ?>
        
		<?php echo CHtml::dropDownList('batch_id','batch_id',$data1,array('empty'=>'-Select-','onchange'=>'batch()','id'=>'batchdrop')); ?><?php */?>

        <!--</div>-->
       
