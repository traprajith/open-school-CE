<!--upgrade_div_starts-->
<div class="upgrade_bx">
	<div class="up_banr_imgbx"><a href="https://open-school.org/pricing" target="_blank"><img src="http://tryopenschool.com/images/promo_bnnr_innerpage.png" width="231" height="200" /></a></div>
	<div class="up_banr_firstbx">
   	  <h1>You are Using Community Edition</h1>
	  <a href="https://open-school.org/pricing" target="_blank">upgrade to premium version!</a>
    </div>
	
</div>
<!--upgrade_div_ends-->
<div id="othleft-sidebar">
<!--<div class="lsearch_bar">
             	<input type="text" name="" class="lsearch_bar_left" value="Search">
                <input type="button" name="" class="sbut">
                <div class="clear"></div>
  </div>-->
          <h1><?php echo Yii::t('students','Manage Students');?></h1>          
                    <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return $message;
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.Yii::t('students','Students List').'<span>'.Yii::t('students','All Students Details').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'lbook_ico'),
                                   'active'=> ((Yii::app()->controller->id=='students') && (in_array(Yii::app()->controller->action->id,array('manage')))) ? true : false
					    ),                               
					array('label'=>''.Yii::t('students','Create New Student').'<span>'.Yii::t('students','New Admission').'</span>',  'url'=>array('students/create') ,'linkOptions'=>array('class'=>'sl_ico' ),'active'=> (Yii::app()->controller->action->id=='create'  or Yii::app()->controller->id=='studentPreviousDatas' or Yii::app()->controller->id=='studentAdditionalFields'), 'itemOptions'=>array('id'=>'menu_1') 
					       ),
						   	array('label'=>Yii::t('students','Manage Student Category').'<span>'.Yii::t('students','Manage Students Category'.'</span>'), 'url'=>array('/students/studentCategory'),'linkOptions'=>array('class'=>'sm_ico' ),'active'=> (Yii::app()->controller->id=='studentCategory'),),
						   array('label'=>''.t('<h1>Manage Guardians</h1>')),
			
						array('label'=>''.Yii::t('students','List Guardians').'<span>'.Yii::t('students','All Guardians Details').'</span>', 'url'=>array('guardians/admin'),'active'=> ((Yii::app()->controller->id=='guardians') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('id'=>'menu_2','class'=>'lbook_ico')),
						
						/*array('label'=>t('Create New Guardian'), 'url'=>'#',
							'active'=> ((Yii::app()->controller->id=='guardians') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
						      ),
							  array('label'=>t('Associate Guardian'), 'url'=>'#',
							'active'=> ((Yii::app()->controller->id=='guardians') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
						      ),*/
						                                                                                    
					    
					    
					       
					    
					/*array('label'=>''.t('Attendance Management<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
					       'items'=>array(
						array('label'=>t('Attendance Register'), 'url'=>'#'),
						array('label'=>t('Attendance Report'), 'url'=>'#',
								'active'=> ((Yii::app()->controller->id=='bemenu') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						
						
					    )),*/
						 
					
					
						//array('label'=>t('Manage Additional Fields'), 'url'=>'#','active'=>Yii::app()->controller->id=='studentCategories' ? true : false),
						
						
						//array('label'=>'Like/Rating', 'url'=>array('/like/admin')),
						//array('label'=>'Survey', 'url'=>array('/survey/admin')),
						     
						
					  
					
					
				),
			)); 
			
			/*echo CHtml::ajaxLink(
	'Students',          // the link body (it will NOT be HTML-encoded.)
	array('/site/explorer'), // the URL for the AJAX request. If empty, it is assumed to be the current URL.
	array(
		'update'=>'#explorer_handler'
	)
);?>

        <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete',
						array(
						  'name'=>'name',
						  'id'=>'name_widget',
						  'source'=>$this->createUrl('/site/autocomplete'),
						  'htmlOptions'=>array('placeholder'=>'Student Name'),
						  'options'=>
							 array(
								   'showAnim'=>'fold',
								   'select'=>"js:function(student, ui) {
									  $('#id_widget').val(ui.item.id);
									 
											 }"
									),
					
						));
						 ?>
        <?php echo CHtml::hiddenField('student_id','',array('id'=>'id_widget')); ?>
		<?php echo CHtml::ajaxLink('[][][]',array('/site/explorer','widget'=>'1'),array('update'=>'#explorer_handler'),array('id'=>'explorer_student_name'));?>
		
		</div>
		
        <script type="text/javascript">

	$(document).ready(function () {
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
*/
