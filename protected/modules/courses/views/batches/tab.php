<style>
.cbi_ibx a{
	bottom:-27px;
}
</style>
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
              
              <script language="javascript">
				function getid()
				{
				var id= document.getElementById('drop').value;
				window.location = "index.php?r=batches/manage&id="+id;
				}
				</script>
				<script>
				$(document).ready(function() {
				$(".act_but ").click(function(){	$('.act_drop').hide();	
            	if ($("#"+this.id+'x').is(':hidden')){
					
                	$("#"+this.id+'x').show();
					
				}
            	else{
                	$("#"+this.id+'x').hide();
            	}
            return false;
       			 });
				  $('#'+this.id+'x').click(function(e) {
            		e.stopPropagation();
        			});
        		
});
$(document).click(function() {
					
            		$('.act_drop').hide();
					
        			});
</script>
<script>
				$(document).ready(function() {
				$(".act_but-new").click(function(){	$('.act_drop').hide();	
            	if ($("#"+this.id+'x').is(':hidden')){
					
                	$("#"+this.id+'x').show();
					
				}
            	else{
                	$("#"+this.id+'x').hide();
            	}
            return false;
       			 });
				  $('#'+this.id+'x').click(function(e) {
            		e.stopPropagation();
        			});
        		
});
$(document).click(function() {
					
            		$('.act_drop').hide();
					
        			});
</script>
<?php 
if(isset($_REQUEST['id']))
{
	
	
	$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
	if(Yii::app()->user->year)
	{
		$year = Yii::app()->user->year;
	}
	else
	{
		$year = $current_academic_yr->config_value;
	}
	$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
	$is_insert = PreviousYearSettings::model()->findByAttributes(array('id'=>2));
	$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
	$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
	$is_inactive = PreviousYearSettings::model()->findByAttributes(array('id'=>8));
	$is_active = PreviousYearSettings::model()->findByAttributes(array('id'=>7));
	?>
	
		<?php 
        if(Yii::app()->controller->action->id != 'promote' and Yii::app()->controller->action->id != 'elective')
        {
		?>
        	<h1>
        	<?php echo Yii::t('app','Manage').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?>
            </h1>
		<?php
        }
        ?>
	
	
	
	<?php    
	$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
	if($batch!=NULL)
	{
		$course=Courses::model()->findByAttributes(array('id'=>$batch->course_id));
		if($course!=NULL)
		{
			$coursename = $course->course_name; 
			$batchname = $batch->name;
		}
		else
		{
			$coursename = ''; 
			$batchname = '';
		}
	}
	?>
	
<div class="button-bg">
    <div class="top-hed-btn-left"></div>
    <div class="top-hed-btn-right">
        <ul>                                    
            <li>
                <?php if((Yii::app()->controller->id=='batches' and (Yii::app()->controller->action->id=='batchstudents' or Yii::app()->controller->action->id=='settings')) or (Yii::app()->controller->id=='subject' and Yii::app()->controller->action->id=='index')){
                ?>
                <?php
                    $rurl = explode('index.php?r=',Yii::app()->request->getUrl());
                    $rurl = explode('&id=',$rurl[1]);
                    echo CHtml::ajaxLink(Yii::t('app','Change').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('/site/explorer','widget'=>'2','rurl'=>$rurl[0]),array('update'=>'#explorer_handler'),array('id'=>'explorer_change','class'=>'a_tag-btn')); 
                ?>        
                <?php 
                } else{
                    echo CHtml::ajaxLink(Yii::t('app','Change').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('/site/explorer','widget'=>'2','rurl'=>'courses/batches/batchstudents'),array('update'=>'#explorer_handler'),array('id'=>'explorer_change','class'=>'a_tag-btn'));
                }
                ?>
            </li>
            <li><?php echo CHtml::link('<span>'.Yii::t('app','close').'</span>',array('/courses'),array('class'=>'sb_but_close-atndnce','style'=>''));?></li>
        </ul>
    </div>
</div>
        <div class="c_batch_tbar">
        <!-- Course - Batch - Class Teacher Name -->
        <div class="cb_left">
            <ul>
                <li><strong> 
				<?php
                if($batch->semester_id!=NULL){
					$semester	=	Semester::model()->findByAttributes(array('id'=>$batch->semester_id)); 
					echo  Yii::t('app','Course').' / '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' / '.Yii::t('app','Semester').' : '; ?></strong> <?php echo $coursename; ?> / <?php echo $batchname; ?> / <?php echo $semester->name;  
                }else{
					echo Yii::t('app','Course').' / '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' : '; ?></strong> <?php echo $coursename; ?> / <?php echo $batchname; 
				}
				?></li>
                <li><strong><?php echo Yii::t('app','Class Teacher : '); ?></strong> <?php $employee=Employees::model()->findByAttributes(array('id'=>$batch->employee_id));
                if($employee!=NULL)
                {
                	echo Employees::model()->getTeachername($employee->id); 
                }?>
                </li>
            </ul>
        </div> <!-- END div class="cb_left" -->
        <!-- END Course - Batch - Class Teacher Name -->
        
        <!-- Students - Subjects - Employees Numbers -->
        <div class="cb_right">
            <div class="status_bx">
            
                <ul>
					<?php $students=Yii::app()->getModule('students')->studentsOfBatch($_REQUEST['id']);?>
                   <li><span><?php echo count($students); ?></span>
                             <?php echo Yii::t('app','Students');?>
                   </li>
                   <li><span><?php echo count(Subjects::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']))); ?></span><?php echo Yii::t('app','Subjects');?></li>
                   </ul>
                <div class="clear"></div>
            </div>
        </div> <!-- END div class="cb_right" -->
        <!-- END Students - Subjects - Employees Numbers -->
        
        <!-- END Actions -->
        <?php
		if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_insert->settings_value!=0 or $is_inactive->settings_value!=0 or $is_active->settings_value!=0)))
		{
		?>
        <div>
            <div id="tabdrop" class="act_but action-posiction"><?php echo Yii::t('app','Actions'); ?></div>
            <div class="act_drop" id="tabdropx">
                <div class="but_bg_outer"></div><div class="but_bg"><!--<div id="1" class="act_but_hover">--><div class="act_but_hover">Actions</div></div>
                <ul>
                <?php
				$batch_id = $_REQUEST['id'];
				if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
				{
					if(ModuleAccess::model()->check('Students')){
				?>
					<li class="addstud"><?php echo CHtml::link(Yii::t('app','Add Student').'<span>'.Yii::t('app','for add new student').'</span>', array('/courses/batches/addStudents','id'=>$_REQUEST['id'])) ?></li><?php } ?> 

							<li class="exams"><?php echo CHtml::link(Yii::t('app','Exams').'<span>'.Yii::t('app','for add new exam').'</span>', array('/examination')) ?></li>
                     
               		 <li class="newsub"><?php echo CHtml::link(Yii::t('app','New Subject').'<span>'.Yii::t('app','for add new subject').'</span>', array('#'),array('id'=>'add_subject-name-side')) ?></li>
                
                	<li class="mark"><?php echo CHtml::link(Yii::t('app','Add Elective').'<span>'.Yii::t('app','for add new elective').'</span>', array('/courses/electives','id'=>$_REQUEST['id'])) ?></li>
                <?php
				}
				?>
                <?php
				if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
				{
				?>
                <li class="mark_att"><?php echo CHtml::link(Yii::t('app','Mark Attendance').'<span>'.Yii::t('app','for add leave').'</span>', array('/courses/studentAttentance','id'=>$_REQUEST['id'])) ?></li>
                
                <li class="assign_tea"><?php echo CHtml::link(Yii::t('app','Assign Teacher').'<span>'.Yii::t('app','assign class teacher').'</span>', array('#'),array('id'=>'assign_class_teacher')) ?></li>
                <?php
				}
				?>
                
                <?php
				if($year == $current_academic_yr->config_value)
				{
				?>
                <li class="promote"><?php echo CHtml::link(Yii::t('app','Promote').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span>'.Yii::t('app','for promote a').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>', array('/courses/batches/promote','id'=>$_REQUEST['id'])) ?></li>
                <?php
				}
				?>
               
                <?php 
				if($batch->is_active=='1' and (($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_inactive->settings_value!=0)))
                {
				?>
                <li class="deactivate"><?php echo CHtml::link(Yii::t('app','Deactivate').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), array('/courses/batches/deactivate','id'=>$_REQUEST['id']),
										array('confirm'=>Yii::t('app','Are you sure you want to deactivate this').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.'?'))?></li>
				<?php 
				}
                if($batch->is_active=='0' and (($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_active->settings_value!=0)))
                { 
				?>
                <li class="deactivate"><?php echo CHtml::link(Yii::t('app','Activate').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"), array('/courses/batches/activate','id'=>$_REQUEST['id']),
													array('confirm'=>Yii::t('app','Are You Sure, You Want to Activate This').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.'?'))?></li>
				<?php 
				}
				?>
                </ul>
            </div>
        </div>
        <?php
		}
		?>
        <!-- END Actions -->
        
        <div class="clear"></div>
	</div> <!-- END div class="c_batch_tbar" -->
    
    <!-- Alert and Notification Messages -->
	<?php
	$ttabnot='cbi_red';
	$ttablink='';
	$allgreen=1;
	
	if($week==NULL)
	{
		$weeknot='<div class="cbi_gray">'.Yii::t('app','Default Values Selected').'</div>';
		$weeklink=CHtml::link(Yii::t('app','Define Now'), array('/courses/weekdays/timetable','id'=>$_REQUEST['id']));
		$allgreen=0;
	}
	else
	{
		$weeknot='<div class="cbi_green">'.Yii::t('app','Weekdays defined').'</div>';
		$weeklink='';
	
	}
	
	
	
		$timingnot='<div class="cbi_red">'.Yii::t('app','Not applicable').'</div>';
		$ttabnot='<div class="cbi_red">'.Yii::t('app','Not applicable').'</div>';
		$ttablink='';
		$allgreen=0;
		
	
	$sub=Subjects::model()->findByAttributes(array('batch_id'=>$batch->id));
	if($sub==NULL)
	{
		$subnot='<div class="cbi_red">'.Yii::t('app','No Subjects Added').'</div>';
		$sublink = CHtml::link(Yii::t('app','Add Subjects'), array('#'),array('id'=>'add_subjects-side'));
		$allgreen=0;
	}
	else
	{
		$subnot='<div class="cbi_green">'.Yii::t('app','Subjects Added').'</div>';
		$sublink = '';
	}
	
	
	$employee=Batches::model()->findByAttributes(array('id'=>$batch->id));
	if($employee->employee_id==NULL or $employee->employee_id=='')
	{
		$empnot='<div class="cbi_red">'.Yii::t('app','No Class Teacher Assigned').'</div>';
		$emplink = CHtml::link(Yii::t('app','Assign Now'), array('#'),array('id'=>'add_subjects-side'));
		$allgreen=0;
	}
	else
	{
		$empnot='<div class="cbi_green">'.Yii::t('app','Class Teacher Assigned').'</div>';
		$emplink = '';
	}
	
	$stud=  BatchStudents::model()->findAllByAttributes(array('batch_id'=>$batch->id,'status'=>1));
	if($stud==NULL)
	{
		$studnot='<div class="cbi_red">'.Yii::t('app','No active students').'</div>';
		if(ModuleAccess::model()->check('Students'))
			{ 
				$studlink = CHtml::link(Yii::t('app','Add Student'), array('/students/students/create','bid'=>$_REQUEST['id']),array('class'=>'addstud'));
			}
		$allgreen=0;
	}
	else
	{
		$studnot='<div class="cbi_green">'.Yii::t('app','Active students').'</div>';
		$studlink = '';
	}
	
	?>
    <!-- END Alert and Notification Messages -->
    
    <!-- Alert and Notification Box -->
	<?php 
	if($allgreen==0) // Some or All details are not set
	{
            
	?>
    	<!-- BOX 1 -->
        <div class="cb_info_bx" style="padding-bottom:10px;">
        
        <div style="border-bottom: 1px solid #fff;margin-bottom: 10px;">
        <div style="border-bottom: 1px solid #EEDE9C;margin-right: 12px;padding-bottom: 40px;">
        
        <div class="cbi_ibx cbi_ico3" style="border-left:none">
        <h3><?php echo Yii::t('app','Active Students'); ?></h3>
        <?php echo $studnot; ?>
        <?php echo $studlink; ?>
        </div>
        
        <div class="cbi_ibx cbi_ico5">
        <h3><?php echo Yii::t('app','Subjects'); ?></h3>
        <?php echo $subnot; ?>
        <?php echo $sublink; ?>
        </div>
        
        <div class="cbi_ibx cbi_ico1">
        <h3><?php echo Yii::t('app','Weekdays'); ?></h3>
        <?php echo $weeknot; ?>
        <?php echo $weeklink; ?>
        
        </div>
        
        
        <div class="cbi_ibx cbi_ico2">
        <h3><?php echo Yii::t('app','Class Timings'); ?></h3>
        <?php echo $timingnot; ?>
        <?php echo $timinglink; ?>
        </div>
        
        <div class="cbi_ibx cbi_ico4" style="border-right:none">
        <h3><?php echo Yii::t('app','Timetable'); ?></h3>
        <?php echo $ttabnot; ?>
        <?php echo $ttablink; ?>
        </div>
        
        <div class="clear"></div>
        </div>
        </div>
        
        <div class="cbi_ibx cbi_ico6" >
                <h3><?php echo Yii::t('app','Class Teacher'); ?></h3>
                <?php echo $empnot; ?>
                <?php //echo $emplink; ?>
            </div>
            
            <?php
			if(($batch->academic_yr_id != $current_academic_yr->config_value) and ($year != $current_academic_yr->config_value and ($is_create->settings_value==0 or $is_insert->settings_value==0 or $is_edit->settings_value==0 or $is_delete->settings_value==0 or $is_inactive->settings_value==0 or $is_active->settings_value==0)))
			{
				if($is_create->settings_value==0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
				{ 
					$yearnot='<div class="cbi_red">'.Yii::t('app','Create option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Create'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value!=0 and $is_insert->settings_value==0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Insert option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Insert'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value==0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Edit option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Edit'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value==0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Delete option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Delete'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value==0 and $is_active->settings_value!=0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Active option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Active'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value==0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Inactive option disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Inactive'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				elseif($is_create->settings_value==0 and $is_insert->settings_value==0 and $is_edit->settings_value==0 and $is_delete->settings_value==0 and $is_inactive->settings_value==0 and $is_active->settings_value==0)
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Manage options disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Options'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				else
				{
					$yearnot='<div class="cbi_red">'.Yii::t('app','Few options disabled').'</div>';
					$yearlink = CHtml::link(Yii::t('app','Enable Options'), array('/previousYearSettings/create'),array('class'=>'addstud'));
				}
				
				
				
			?>
            
            <div class="cbi_ibx cbi_ico7" >
                <h3><?php echo Yii::t('app','Inactive Year'); ?></h3>
                <?php echo $yearnot; ?>
                <?php echo $yearlink; ?>
            </div>
            
            <?php
			}
			?>
            <div class="clear"></div>
        </div> <!-- END div class="cb_info_bx" -->
        <!--END BOX 1 -->

	<?php 
	}
	else // All Details are set
	{
					
			if($year != $current_academic_yr->config_value and ($is_create->settings_value==0 or $is_insert->settings_value==0 or $is_edit->settings_value==0 or $is_delete->settings_value==0 or $is_inactive->settings_value==0 or $is_active->settings_value==0))
			{
			?>
				<div>
					<div class="yellow_bx" style="background-image:none;width:95%;padding-bottom:45px;">
						<div class="y_bx_head" style="width:95%;">
						<?php 
							echo Yii::t('app','You are not viewing the current active year. ');
							
							if($is_create->settings_value==0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
							{ 
								echo Yii::t('app','To create details, enable Create option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value!=0 and $is_insert->settings_value==0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
							{
								echo Yii::t('app','To insert details, enable Insert option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value==0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
							{
								echo Yii::t('app','To edit details, enable Edit option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value==0 and $is_inactive->settings_value!=0 and $is_active->settings_value!=0)
							{
								echo Yii::t('app','To delete details, enable Delete option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value==0 and $is_active->settings_value!=0)
							{
								echo Yii::t('app','To inactivate details, enable Inactive option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value!=0 and $is_insert->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_inactive->settings_value!=0 and $is_active->settings_value==0)
							{
								echo Yii::t('app','To activate details, enable Active option in Previous Academic Year Settings.');
							}
							elseif($is_create->settings_value==0 and $is_insert->settings_value==0 and $is_edit->settings_value==0 and $is_delete->settings_value==0 and $is_inactive->settings_value==0 and $is_active->settings_value==0)
							{
								echo Yii::t('app','To manage details, enable required options in Previous Academic Year Settings.');
							}
							else
							{
								echo Yii::t('app','Some manage options are disabled. To manage details, enable required options in Previous Academic Year Settings.');
							}
							?>
						</div>
						<div class="y_bx_list" style="width:650px;">
							<h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
						</div>
					</div>
				</div><br />
			<?php
			}
	}
	?>
    <!-- END Alert and Notification Box -->
    
    
    <!-- TAB -->
	<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>	
	<?php 
	if($batch!=NULL)
	{
	?>
        <div class="pagetab-bg-tag-a">
            <ul>

                
                <?php     
                if(Yii::app()->controller->action->id=='batchstudents')
                {
                    echo '<li class="active">'.CHtml::link(Yii::t('app','Students'), array('/courses/batches/batchstudents','id'=>$_REQUEST['id'])).'</li>';
                }
                else
                {
                	echo '<li>'.CHtml::link(Yii::t('app','Students'), array('/courses/batches/batchstudents','id'=>$_REQUEST['id'])).'</li>';
                }
                ?>

                
                <?php     
                if(Yii::app()->controller->id=='subject' or Yii::app()->controller->id=='defaultsubjects')
                {
                	echo '<li class="active">'.CHtml::link(Yii::t('app','Subjects'), array('/courses/subject','id'=>$_REQUEST['id'])).'</li>';
                }
                else
                {
                	echo '<li>'.CHtml::link(Yii::t('app','Subjects'), array('/courses/subject','id'=>$_REQUEST['id'])).'</li>';
                }
                ?>
  
                <?php     
                if(Yii::app()->controller->id=='weekdays' or Yii::app()->controller->id=='classTiming' or Yii::app()->controller->id=='flexible')
                {
                	echo '<li class="active">'.CHtml::link(Yii::t('app','Timetable'), array('/courses/weekdays/timetable','id'=>$_REQUEST['id'])).'</li>';
                }
                else
                {
                	echo '<li>'.CHtml::link(Yii::t('app','Timetable'), array('/courses/weekdays/timetable','id'=>$_REQUEST['id'])).'</li>';
                }
                ?>
                

                
                

                <?php   
				
				
					if(Yii::app()->controller->id=='studentAttentance')
					{	
						echo '<li class="active">'.CHtml::link(Yii::t('app','Attendances'), array('/courses/studentAttentance','id'=>$_REQUEST['id'])).'</li>';
					}
					else
					{
							echo '<li>'.CHtml::link(Yii::t('app','Attendances'), array('/courses/studentAttentance','id'=>$_REQUEST['id'])).'</li>';
					}
                ?>

               
                    <?php  
                       
                    if(Yii::app()->controller->action->id=='studentelectives' or Yii::app()->controller->action->id=='elective' or Yii::app()->controller->id=='electiveGroups' or Yii::app()->controller->id=='electives')
                    {
                        echo '<li class="active">'.CHtml::link(Yii::t('app','Electives'), array('/courses/batches/studentelectives','id'=>$_REQUEST['id'])).'</li>';
                    }
                    else
                    {
                        echo '<li>'.CHtml::link(Yii::t('app','Electives'), array('/courses/batches/studentelectives','id'=>$_REQUEST['id'])).'</li>';
                    }
                    ?>

                
                <?php     
                if(Yii::app()->controller->action->id=='waitinglist')
                {
                	echo '<li class="active">'.CHtml::link(Yii::t('app','Waiting List Students'), array('/courses/batches/waitinglist','id'=>$_REQUEST['id'])).'</li>';
                }
                else
                {
                	echo '<li>'.CHtml::link(Yii::t('app','Waiting List Students'), array('/courses/batches/waitinglist','id'=>$_REQUEST['id'])).'</li>';
                }
                ?>
                

                <?php     
                if(Yii::app()->controller->action->id=='settings')
                {
                	echo '<li class="active">'.CHtml::link(Yii::t('app','Settings'), array('/courses/batches/settings','id'=>$_REQUEST['id'])).'</li>';
                }
                else
                {
                	echo '<li>'.CHtml::link(Yii::t('app','Settings'), array('/courses/batches/settings','id'=>$_REQUEST['id'])).'</li>';
                }
                ?>
           
            
            </ul>
        </div> <!-- END div class="emp_tab_nav" -->
	<?php 
	} //END $batch!=NULL
	?>
    <!-- END TAB -->
<?php
} // END if(isset($_REQUEST['id']))
?>
	<div id="subjects-grid-side"></div>
    <div id="class-timings-grid-side"></div>
    <div id="events-grid-side"></div>
    <div id="subject-name-grid-side"></div>
    <script>
	//CREATE 

	 $('#assign_class_teacher').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/batches/assignteacher",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid-side").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid-side").removeClass("ajax-sending");
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
								}  //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
	



    $('#add_subjects-side').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid-side").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid-side").removeClass("ajax-sending");
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
								}  //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
	
	//CREATE 

    $('#add_events-side').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/events/returnForm",
            data:{"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#events-grid-side").addClass("ajax-sending");
                },
                complete : function() {
                    $("#events-grid-side").removeClass("ajax-sending");
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
								} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
	
	//CREATE 

    $('#add_subject-name-side').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subject-name-grid-side").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subject-name-grid-side").removeClass("ajax-sending");
                },
            success: function(data) {
                $.fancybox(data,
                        {    "transitionIn"      : "elastic",
                            "transitionOut"   : "elastic",
                            "speedIn"                : 600,
                            "speedOut"            : 200,
                            "overlayShow"     : false,
                            "hideOnContentClick": false,
                            "afterClose":    function() {window.location.reload();} //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind
	</script>