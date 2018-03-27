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
              
              
<?php 
$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
foreach($roles as $role)
	if(sizeof($roles)==1 and $role->name == 'parent')
	{
		$this->renderPartial('/default/parentleft');
	}
	else if(sizeof($roles)==1 and $role->name == 'student')
	{
		$this->renderPartial('/default/studentleft');
	}
	else if(sizeof($roles)==1 and $role->name == 'teacher')
	{
		$this->renderPartial('/default/teacherleft');
	}
	else
	{
	?>




<div id="othleft-sidebar">
		<h1><?php echo Yii::t('app','General Settings');?></h1>
                    
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
					
                                                         
					array('label'=>''.Yii::t('app','General Settings').'<span>'.Yii::t('app','Manage Configurations').'</span>',  'url'=>array('/configurations/index'),'active'=> ((Yii::app()->controller->id=='configurations') && (in_array(Yii::app()->controller->action->id,array('create','index')))),'linkOptions'=>array('class'=>'gs_ico' ), 'visible'=>Yii::app()->user->checkAccess('Configurations.Index'), 'itemOptions'=>array('id'=>'menu_1'),
					       ),
						   
						   array('label'=>''.Yii::t('settings','Application Settings<span>Manage Application Settings</span>'),  'url'=>array('/settingConfiguration/create'),'active'=> ((Yii::app()->controller->id=='settingConfiguration') && (in_array(Yii::app()->controller->action->id,array('create'))? true : false)),'linkOptions'=>array('class'=>'gs_ico' ), 'visible'=>!Yii::app()->user->checkAccess('Admin'), 'itemOptions'=>array('id'=>'menu_1')),
						  
						   array('label'=>''.'<h1>'.Yii::t('app','User Settings').'</h1>'),
						 
						  array('label'=>Yii::t('app','Create New User').'<span>'.Yii::t('app','Add New User Details').'</span>', 'url'=>array('/user/admin/create'),'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id=='create') ? true : false), 'visible'=>Yii::app()->user->checkAccess('User.Admin.Create'),'linkOptions'=>array('class'=>'sl_ico' )),
						  array('label'=>Yii::t('app','Manage Users').'<span>'.Yii::t('app','Manage All Users').'</span>', 'url'=>array('/user/admin'),'active'=> ((Yii::app()->controller->id=='admin' and Yii::app()->controller->action->id!='create') ? true : false), 'visible'=>Yii::app()->user->checkAccess('User.Admin.*'),'linkOptions'=>array('class'=>'sm_ico' )),
						  
						  array('label'=>Yii::t('app','Change Password').'<span>'.Yii::t('app','Manage All Users').'</span>', 'url'=>array('/user/profile/changepassword'),'active'=>((Yii::app()->controller->id=='profile') ? true : false),'linkOptions'=>array('class'=>'setting-passwors_ico' )),
						   
					array('label'=>''.'<h1>'.Yii::t('app','Courses').' & '.Yii::t('app','Batches').'</h1>', 'visible'=>Yii::app()->user->checkAccess('Courses.Courses.Managecourse')),
					       
						array('label'=>Yii::t('app','List Courses').' & '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span>'.Yii::t('app','All Courses').' & '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','Details').'</span>', 'url'=>array('/courses/courses/managecourse'), 'visible'=>Yii::app()->user->checkAccess('Courses.Courses.Managecourse'),'linkOptions'=>array('class'=>'lbook_ico' )),
						
						array('label'=>Yii::t('app','Create Courses').'<span>'.Yii::t('app','Add New Course Details').'</span>', 'url'=>array('/courses/courses/create'),
							'active'=> ((Yii::app()->controller->id=='courses') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false), 'visible'=>Yii::app()->user->checkAccess('Courses.Courses.Managecourse'),'linkOptions'=>array('class'=>'ne_ico' )),
					
				),
			)); ?>
		<div id="subject-name-ajax-grid"></div>
        
        
       <?php
	}
	?>
        

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
    
   