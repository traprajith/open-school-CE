<?php Yii::app()->clientScript->registerCoreScript('jquery');

         //IMPORTANT about Fancybox.You can use the newest 2.0 version or the old one
        //If you use the new one,as below,you can use it for free only for your personal non-commercial site.For more info see
		//If you decide to switch back to fancybox 1 you must do a search and replace in index view file for "beforeClose" and replace with 
		//"onClosed"
        // http://fancyapps.com/fancybox/#license
          // FancyBox2
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css', 'screen');
         // FancyBox
         //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.js', CClientScript::POS_HEAD);
         // Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.css','screen');
        //JQueryUI (for delete confirmation  dialog)
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/js/jquery-ui-1.8.12.custom.min.js', CClientScript::POS_HEAD);
         Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css','screen');
          ///JSON2JS
         Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/json2/json2.js');
       

           //jqueryform js
               Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/form_ajax_binding.js', CClientScript::POS_HEAD);
              Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/client_val_form.css','screen');  ?>
              
              




<div id="othleft-sidebar">
<!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div> --> <h1><?php echo Yii::t('app','Manage').' '.Yii::app()->getModule("students")->labelCourseBatch();?></h1>
                    
                    <?php
			

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(																   
					array('label'=>Yii::t('app','List').' '.Yii::app()->getModule("students")->labelCourseBatch().'<span>'.Yii::t('app','Current Courses and').' '.$batch_label.' '.Yii::t('app','Details').'</span>', 'url'=>array('courses/managecourse'), 
						   'active'=> ((Yii::app()->controller->id=='courses') and (in_array(Yii::app()->controller->action->id,array('managecourse'))) ? true : false),'linkOptions'=>array('class'=>'list-cours_ico' )),
						
					array('label'=>Yii::t('app','Create Courses').'<span>'.Yii::t('app','Add New Course Details').'</span>', 'url'=>array('courses/create'),
						  'active'=> ((Yii::app()->controller->id=='courses') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index','create'))) ? true : false),
						  'linkOptions'=>array('class'=>'create-courses_ico' )                                                                                           
						  ),
						  
				    array('label'=>Yii::t('app','Previous Year Courses').'<span>'.Yii::t('app','All Courses and').' '.$batch_label.' '.Yii::t('app','Details').'</span>', 'url'=>array('courses/allcourses'),
							'active'=> ((Yii::app()->controller->id=='courses') && (in_array(Yii::app()->controller->action->id,array('allcourses'))) ? true : false),'linkOptions'=>array('class'=>'previous-courses_ico' )                          ),
					
					array('label'=>Yii::t('app','Deactivated').' '.$batch_label.'<span>'.Yii::t('app','Deactivated').' '.$batch_label.' '.Yii::t('app','Details').'</span>', 'url'=>array('courses/deactivatedbatches'), 
						   'active'=> ((Yii::app()->controller->id=='courses') and (in_array(Yii::app()->controller->action->id,array('deactivatedbatches'))) ? true : false),
						   'linkOptions'=>array('class'=>'deactive-course_ico' )),
					array('label'=>Yii::t('app','Subjects Common Pool').'<span>'.Yii::t('app','Common Subject Details').'</span>', 'url'=>array('courses/commonsubjects'), 
						   'active'=> ((Yii::app()->controller->id=='courses') and (in_array(Yii::app()->controller->action->id,array('commonsubjects'))) ? true : false),
						   'linkOptions'=>array('class'=>'common-pool-course_ico' )),
					array('label'=>''.Yii::t('app','General Settings').'<span>'.Yii::t('app','Manage Configurations').'</span>',  'url'=>array('/configurations/index'), 
							'linkOptions'=>array('class'=>'genaral-setting_ico' ), 'itemOptions'=>array('id'=>'menu_1') 
					       ),	   
			),
							 // array('label'=>t('Create Batches'), 'url'=>'#',
							//'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
						     // ),
						                                                                                     
		
					   
					
						
						/*array('label'=>''.t('Batch-Settings<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
					       'items'=>array(
						
						array('label'=>t('Set Week days'), 'url'=>array('/courses/weekdays&id='),
								'active'=> ((Yii::app()->controller->id=='weekdays') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						array('label'=>t('Set Class Timings'), 'url'=>array('/courses/classTimings'),
								'active'=> ((Yii::app()->controller->id=='classTimings') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						array('label'=>t('Create/View Time Table'), 'url'=>array('#'),),
						
					  
					    )),*/
						
						
					
					
				
				
			)); 
			$visible	=	Configurations::model()->isSemesterEnabled();
			?>
            
             <ul>
                <?php if($visible	==	1){ ?>
                
                <li class="<?php if(Yii::app()->controller->id=='semester') { echo "list_active"; } ?>">
                    <?php echo CHtml::link(Yii::t('app','Manage Semesters').'<span>'.Yii::t('app','Semesters for the Courses ').'</span>',array('/courses/semester'),array('class'=>'gradebook_ico','active'=>(Yii::app()->controller->id=='semester'))); ?>
                </li> 
                <?php } ?>
            </ul>
		<div id="subject-name-ajax-grid"></div>
        
        
       
        

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
		
		
		//CREATE 
    
    $('#add_subject-name-ajax').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=subjectNameAjax/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subject-name-ajax-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-ajax-grid").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
							"afterClose":    function() {
								window.location.reload();
								} 
							
							
							
                             //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
	
    </script>
    
   