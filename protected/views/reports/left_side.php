<div id="othleft-sidebar">
  <!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>-->        <h1>Mnage Reports</h1>          
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
					array('label'=>''.Yii::t('reports','Set grading levels').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),                               
					 array('label'=>''.'<h1>'.Yii::t('assessments','Exam Management').'</h1>'), 
					
					      
						array('label'=>Yii::t('assessments','New Exam').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('/beterm/create'),'linkOptions'=>array('class'=>'ne_ico')),
						
						array('label'=>Yii::t('assessments','Connect Exams').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('/beterm/admin'),
							'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('class'=>'messgnew_ico')                                                                                           
						      ),
				
					   
					       
					    
						array('label'=>''.Yii::t('assessments','Additional Exams').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ), 
							array('label'=>''.Yii::t('assessments','Exam Wise Report').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Subject wise Report').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Grouped exam Reports').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
						array('label'=>''.Yii::t('assessments','Archived Student Reports').'<span>'.Yii::t('assessments','Lorem ipsum dolor sit amet,').'</span>', 'url'=>array('students/manage') ,'linkOptions'=>array('class'=>'messgnew_ico'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),
					
						
					
					
				),
			)); ?>
		
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

