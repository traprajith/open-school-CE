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
  </div>--><h1>SMS Settings</h1>
                    
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
					
                                                         
					array('label'=>''.Yii::t('settings','General Settings<span>Manage Configurations</span>'),  'url'=>array('/configurations/index'),'linkOptions'=>array('class'=>'gs_ico' ), 'itemOptions'=>array('id'=>'menu_1') 
					       ),
						   array('label'=>''.Yii::t('settings','<h1>User Settings</h1>')),
						 
						  array('label'=>Yii::t('settings','Create New User<span>Add New User Details</span>'), 'url'=>array('/user/admin/create'),'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id=='create') ? true : false),'linkOptions'=>array('class'=>'sl_ico' )),
						  array('label'=>Yii::t('settings','Manage Users<span>Manage All Users</span>'), 'url'=>array('/user/admin'),'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id!='create') ? true : false),'linkOptions'=>array('class'=>'sm_ico' )),
						  array('label'=>Yii::t('settings','Change Password<span>Manage All Users</span>'), 'url'=>array('/user/profile/changepassword'),'linkOptions'=>array('class'=>'sm_ico' )),
						   /*array('label'=>Yii::t('settings','Create Profile Field<span>Add New Profile</span>'), 'url'=>array('/user/profileField/create'),'linkOptions'=>array('class'=>'sl_ico' )),
						  array('label'=>Yii::t('settings','Manage Profile Field<span>Manage Profiles</span>'), 'url'=>array('/user/profileField/admin'),'linkOptions'=>array('class'=>'sm_ico' )),*/
						  
						  // array('label'=>''.t('Create New User<span>New User</span>'),  'url'=>array('/user/create') ,'linkOptions'=>array('class'=>'menu_1' ), 'itemOptions'=>array('id'=>'menu_1') 
					      // ),
					array('label'=>''.Yii::t('settings','<h1>Courses & Batches</h1>')),
					       
						array('label'=>Yii::t('settings','List Courses & Batches<span>All Courses & Batches Details</span>'), 'url'=>array('/courses/courses/managecourse'),'linkOptions'=>array('class'=>'lbook_ico' )),
						
						array('label'=>Yii::t('settings','Create Courses<span>Add New Course Details</span>'), 'url'=>array('/courses/courses/create'),
							'active'=> ((Yii::app()->controller->id=='courses') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('class'=>'sm_ico' )),
							  //array('label'=>t('Create Batches'), 'url'=>'#',
							//'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
						    //  ),
						                                                                                    
					    
					   
					       
					   
					//array('label'=>''.t('Manage Subjects<span>Manage subjects</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
//					       'items'=>array(
//						
//						array('label'=>t('Add New Subject'), 'url'=>array('#'),'linkOptions'=>array('id'=>'add_subject-name-ajax'),
//								'active'=> ((Yii::app()->controller->id=='subjectName') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
//						array('label'=>t('View Subjects'), 'url'=>array('/courses/subjectName/admin'),),
//						
//					    array('label'=>t('Subject-Batch Association'), 'url'=>array('/courses/subjects/index'),
//								'active'=> ((Yii::app()->controller->id=='subjects') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
//						array('label'=>t('View Subject-Batch Association'), 'url'=>array('/courses/subjects/admin'),),
//						
//						
//					    
//						
//						
//					    )),
						
						/*array('label'=>''.t('Batch-Settings<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
					       'items'=>array(
						
						array('label'=>t('Set Week days'), 'url'=>array('/courses/weekdays&id='),
								'active'=> ((Yii::app()->controller->id=='weekdays') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						array('label'=>t('Set Class Timings'), 'url'=>array('/courses/classTimings'),
								'active'=> ((Yii::app()->controller->id=='classTimings') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						array('label'=>t('Create/View Time Table'), 'url'=>array('#'),),
						
					  
					    )),*/
						
						//array('label'=>''.t('Employee Settings<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_5','class'=>'menu_5'), 'itemOptions'=>array('id'=>'menu_5'), 
					     //  'items'=>array(
						//array('label'=>t('Subject Association'), 'url'=>array('/employees/employeesSubjects/create'),'active'=>Yii::app()->controller->id=='employeesSubjects' ? true : false),
						//array('label'=>t('Manage Category'), 'url'=>array('/employees/employeeCategories/admin'),'active'=>Yii::app()->controller->id=='employeeCategories' ? true : false),
						//array('label'=>t('Manage Department'), 'url'=>array('/employees/employeeDepartments/admin'),'active'=>Yii::app()->controller->id=='employeeDepartments' ? true : false),
						//array('label'=>t('Employee Aditional Details'), 'url'=>'#','active'=>Yii::app()->controller->id=='comments' ? true : false),
						//array('label'=>t('Manage Positions'), 'url'=>array('/employees/employeePositions/admin'),'active'=>Yii::app()->controller->id=='employeePositions' ? true : false),
						//array('label'=>t('Employee Grades'), 'url'=>array('/employees/employeeGrades/admin'),'active'=>Yii::app()->controller->id=='studentCategories' ? true : false),
						
						//array('label'=>'Like/Rating', 'url'=>array('/like/admin')),
						//array('label'=>'Survey', 'url'=>array('/survey/admin')),
						     
						
					  //  )),
					
					
				),
			)); ?>
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
    
   