<?php
$this->breadcrumbs=array(
	Yii::t('app','Settings'),
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js_plugins/fancybox2/jquery.fancybox.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js_plugins/fancybox2/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js_plugins/fancybox2/jquery.easing-1.3.pack.js"></script>
<script>
$(document).ready(function() {
	$("#enroll_p").fancybox({
		'transitionIn'	:	'none',
		'transitionOut'	:	'none',
		'speedIn'		:	100, 
		'speedOut'		:	100, 
		'overlayShow'	:	false
	});
	
});
</script>
<script>
	$(function() {
		$(".droppbox").draggable(
		{
			 cursor: 'move',
			 revert: true,
			 start: function(e, ui){
 					$(ui.helper).addClass("dbactive");
 					}
		}
		);
		 // Create the card slots
		$('.dropslot').droppable( {
		  accept: '.droppbox',
		  hoverClass: 'dbhover',
      });
	});
	
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td>
      <div class="emp_cntntbx">
	  
	  <div>
		  <h1><?php echo Yii::t('app','Settings'); ?></h1>
		  
		  <div class="clear"></div>
	  </div>
<div class="button-bg yellow-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><div class="settings_search">
			<span class="fa fa-search"></span> &nbsp;<input type="text" id="search_id" placeholder="<?php echo Yii::t('app','Search'); ?>"/>
		  </div></li>
                                  
</ul>
</div> 
</div>

    	<div class="setbx_con">
   			<div class="block_box">
                <div class="setbx">
                <div class="setbx_top">
                <h1><?php  echo Yii::t('app','General Settings'); ?></h1>
                </div>

                <div class="setbx_bot">
                    <ul>
                    	<?php 
						                      
                        if(Yii::app()->user->checkAccess('Admin'))
                        {
                        ?>
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-gears"></i></div>
                        <?php echo CHtml::link(Yii::t('app','School Setup').'<span>'.Yii::t('app','School Name,Logo..').'</span>', array('/configurations/create'),array('class'=>'name-txt')) ?></li>
                       
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-cloud-download"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Backup / Restore').'<span>'.Yii::t('app','Complete Database Backup').'</span>', array('#'),array('class'=>'name-txt')) ?>
                        
                        </li>
                        <?php 
						}
						if(ModuleAccess::model()->check('Settings'))
						{
						?>
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-globe"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Translation').'<span>'.Yii::t('app','Language Translation').'</span>', array('#'),array('class'=>'name-txt')) ?>
                        </li>
                        
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-calendar-o"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Academic Year').'<span>'.Yii::t('app','Set up,Manage previous years...').'</span>', array('/academicYears/admin'),array('class'=>'name-txt')) ?></li>
                        <?php 
						}
                        if(Yii::app()->user->checkAccess('Admin'))
                        {
                        ?>
                       <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-database"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Modules').'<span>'.Yii::t('app','Manage Modules').'</span>', array('/modules/index'),array('class'=>'name-txt')) ?></li>
                       
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-key"></i></div>
                        <?php echo CHtml::link(Yii::t('app','User Roles').'<span>'.Yii::t('app','Manage / Create User Roles').'</span>', array('/rights/authItem/manageroles'),array('class'=>'name-txt')) ?></li>
                        <?php 
						}
						if(ModuleAccess::model()->check('Settings'))
						{
						?>
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>   
                        <div class="set_icon"><i class="fa fa-bell"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Annual Holidays').'<span>'.Yii::t('app','Manage Annual Holidays').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        
                        <?php 
						}
                        if(Yii::app()->user->checkAccess('Admin'))
                        {
                        ?>
                        
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-tint"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Admin Themes').'<span>'.Yii::t('app','Manage Admin Themes').'</span>', array('/themes'),array('class'=>'name-txt')) ?></li>
                       
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-tint"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Portal Themes').'<span>'.Yii::t('app','Manage Portal Themes').'</span>', array('#'),array('class'=>'name-txt')) ?>
                        </li>
                        
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-laptop"></i></div>
                        <?php echo CHtml::link(Yii::t('app','System Upgrade').'<span>'.Yii::t('app','Manage System Offline Schedule').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        
                        <?php
                        }
						if(ModuleAccess::model()->check('My Account'))
						{
                        ?>
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-calendar"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Event Types').'<span>'.Yii::t('app','Manage Event Types').'</span>', array('/cal/eventsType'),array('class'=>'name-txt')) ?></li>
                        <?php 
						}
						?>
                        
                        <?php
						if(ModuleAccess::model()->check('Settings'))
						{
                        ?>
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-tasks"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Features').'<span>'.Yii::t('app','Manage Features').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        <?php 
						}
                                                
                        if(ModuleAccess::model()->check('Settings'))
						{
                        ?>
                        <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-key"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Authentication').'<span>'.Yii::t('app','Manage Authentication').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        <?php 
						}
						?>
                        
                         <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-exchange" aria-hidden="true"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Terms').'<span>'.Yii::t('app','Create and Manage Terms').'</span>', array('#',),array('id'=>'set_grade_level','class'=>'name-txt')) ?></li>
                         
                         <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-tachometer" aria-hidden="true"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Dashboard').'<span>'.Yii::t('app','Manage Dashboard Blocks').'</span>', array('dashboard/settings',),array('id'=>'set_grade_level','class'=>'name-txt')) ?></li>
                </div>
                
              
                <div class="clear"></div>
                
    		</div><!-- block box end -->      
    <div class="clear"></div>
    <?php 
	if(ModuleAccess::model()->check('Students') or ModuleAccess::model()->check('Settings'))
	{
	?>
    <div class="block_box"> 
    	<div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1 class="headings"><?php echo Yii::t('app','Enrollment Settings');  ?></h1>
    	</div>
    	<div class="setbx_bot">
   			<ul>
    			<?php /*?><li><a href="#enroll_process" id="enroll_p" class="icon26">Enrollment Process<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    			<?php /*?><li><a href="#" class="icon27">Additional Fields<span>Admins &amp; Class Teachers</span></a></li>
    			<li><a href="#" class="icon28">Enrollment Forms<span>Admins &amp; Class Teachers</span></a></li><?php */
				if(ModuleAccess::model()->check('Students'))
				{
				?>
    			<li  class="menu_box">
                <div class="set_icon"><i class="fa fa-bars"></i></i></div>
                <?php echo CHtml::link(Yii::t('app','Manage Category').'<span>'.Yii::t('app','Manage Student Category').'</span>', array('students/studentCategory'),array('class'=>'name-txt')) ?>
                </li>
                <?php
				}
				if(ModuleAccess::model()->check('Settings'))
				{
				?>
                 <li class="menu_box">
                <span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-keyboard-o"></i></div>
                	<?php echo CHtml::link(Yii::t('app','Online Registration Settings').'<span>'.Yii::t('app','Online Registration Settings').'</span>', array('#'),array('class'=>'name-txt')) ?>
                </li>
                <li class="menu_box">
				<div class="set_icon"><i class="fa fa-book"></i></div>
				<?php echo CHtml::link(Yii::t('app','Manage Student Document').'<span>'.Yii::t('app','Manage Student Document Types').'</span>', array('/studentDocumentList/index'),array('id'=>'','class'=>'name-txt')) ?>
                <!--<a href="#" class="icon5">Default Subjects<span>Admins &amp; Class Teachers</span></a>-->
                </li> 
                <?php 
				}
				?>
                <li class="menu_box">
				<div class="set_icon"><i class="fa fa-list-ol"></i></div>
				<?php
					echo CHtml::ajaxLink(
						Yii::t('app', 'Roll Number Settings').'<span>'.Yii::t('app','Roll No and Admission No Settings').'</span>',
						Yii::app()->createUrl('configurations/rollnoSettings' ),
						array(
							'type' => 'GET',
							'dataType' => 'text',
							'update' => '#help_link',
							'onclick' => '$("#help_link_dialog").dialog("open"); return false;'
						),
						array(
							'class' => 'help_class name-txt'
						)
					);
							?>
                </li>  
            </ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    </div>  
    <?php
	}
	?>  


    <div class="block_box"> 
        <div class="setbx" style="width:700px;">
        <div class="setbx_top">
        <h1 class="headings"><?php echo Yii::t('app','Field Settings');  ?></h1>
        </div>
        <div class="setbx_bot">
            <ul>
                
                <li  class="menu_box">
                <div class="set_icon"><i class="fa fa-plus"></i></i></div>
                <?php echo CHtml::link(Yii::t('app','Student Field Settings').'<span>'.Yii::t('app','Add additional fields').'</span>', array('dynamicform/formFields/list'),array('class'=>'name-txt')) ?>
                </li>
                
            </ul>
        </div>
        <div class="clear"></div>
        </div>
    </div>


        <div class="clear"></div>
         <?php 
			if(ModuleAccess::model()->check('Courses') or ModuleAccess::model()->check('Settings') or ModuleAccess::model()->check('Employees'))
			{
		?>
        <div class="block_box">
            <div class="setbx" style="width:700px;">
            <div class="setbx_top">
            <h1 class="headings"><?php echo Yii::app()->getModule("students")->labelCourseBatch().' '.Yii::t('app','Settings');?></h1>
            </div>
            <div class="setbx_bot">
                <ul>
					<?php
					if(ModuleAccess::model()->check('Courses'))
					{
					?>
                        <li class="menu_box">
                            <div class="set_icon"><i class="fa fa-table"></i></div>
                            <?php echo CHtml::link(Yii::t('app','Semester Settings').'<span>'.Yii::t('app', 'Enable / Disable Semester System').'</span>', array('/configurations/semesterSettings'),array('class'=>'name-txt')) ?>
                        </li>
                    <?php 
					}
					?>
                    
                	<?php
					if(ModuleAccess::model()->check('Courses'))
					{
					?>
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-file"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Courses').'<span>'.Yii::t('app','Create &amp; Manage Courses').'</span>', array('courses/courses/managecourse'),array('class'=>'name-txt')) ?></li>
                    <?php 
					}
					?>
                    
                    <?php
					if(ModuleAccess::model()->check('Settings'))
					{
					?>
                   <li class="menu_box">
                    <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-clock-o"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Common Class Timings').'<span>'.Yii::t('app','Create').' & '.Yii::t('app','Manage Institution Class Timings').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    <?php
					}
					if(ModuleAccess::model()->check('Courses'))
					{
					?>
                     <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-sitemap"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Subjects Common Pool').'<span>'.Yii::t('app','Manage Subjects Common Pool').'</span>', array('/courses/courses/commonsubjects'),array('class'=>'name-txt')) ?></li>
                    <?php 
					}
					if(ModuleAccess::model()->check('Employees'))
					{
					?>
                    
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-users"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Subject-').' '.Yii::app()->getModule("students")->labelCourseBatch().' '.Yii::t('app','Association').'<span>'.Yii::t('app','Teacher Association For Subjects').'</span>', array('employees/employeesSubjects/create'),array('class'=>'name-txt')) ?></li>
                    <?php
					}
					if(ModuleAccess::model()->check('Courses'))
					{
					?>
                    <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-calendar"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Default Weekdays').'<span>'.Yii::t('app','Default School Weekdays').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    <?php
					}
					if(ModuleAccess::model()->check('Settings'))
					{
					?>
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-folder-open"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Add Subjects To').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span>'.Yii::t('app','Add Subjects To').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>', array('#'),array('id'=>'add_subjects','class'=>'name-txt')) ?></li>
                    <?php
					}
					if(ModuleAccess::model()->check('Examination') or ModuleAccess::model()->check('Courses'))
					{
					?>
                    <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-line-chart"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Set Default Grading Levels').'<span>'.Yii::t('app','Setting the Default Grading Levels').'</span>', array('#','key'=>'NULL'),array('id'=>'set_grade_level','class'=>'name-txt')) ?></li>
                    <?php
					}
					?>
                    <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-mortar-board"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Exam Format').'<span>'.Yii::t('app','Choose Exam Format').'</span>', array('#',),array('id'=>'set_grade_level','class'=>'name-txt')) ?></li>
                    
                    <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-tasks"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Timetable Format').'<span>'.Yii::t('app','Choose Timetable Format').'</span>', array('#',),array('class'=>'name-txt')) ?></li>
                   
                   <?php /*?> <li><a href="#" class="icon14">Default Class Timings<span>Admins &amp; Class Teachers</span></a></li><?php */?>
                </ul>
            </div>
            <div class="clear"></div>
            </div>
        </div>
        <?php
			}
		?>    
        <div class="clear"></div>
        
        <div class="block_box"> 
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                    <h1 class="headings"><?php echo Yii::t('app','Attendance Settings');  ?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>            
                        <li  class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        	<div class="set_icon"><i class="fa fa-file-text-o"></i></i></div>
                        	<?php
                                echo CHtml::link(Yii::t('app','Attendance Settings').'<span>'.Yii::t('app','Manage Attendance Type').'</span>', array('#',),array('class'=>'name-txt'));
							?>
                        </li>            
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="clear"></div>
        
        <?php 
			if(ModuleAccess::model()->check('Students') or ModuleAccess::model()->check('Employees'))
			{
		?>
        <div class="block_box">  
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                <h1 class="headings"><?php echo Yii::t('app','Log Settings');?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>  
                    	<?php
						if(ModuleAccess::model()->check('Students'))
						{
						?>                      
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-exchange"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Student Log Category').'<span>'.Yii::t('app','Manage Student Log Category').'</span>', array('students/logCategory'),array('class'=>'name-txt')) ?></li>
                        <?php
						}
						if(ModuleAccess::model()->check('Teachers'))
						{
						?>
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-random"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Teacher Log Category').'<span>'.Yii::t('app','Manage Teacher Log Category').'</span>', array('employees/logCategory'),array('class'=>'name-txt')) ?></li>
                        <?php
						}
						?>
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
           </div>  
           <?php
			}
		   ?>   
       <div class="clear"></div>
        <?php
		if(ModuleAccess::model()->check('Teachers'))
		{
		?>
        <div class="block_box">
            <div class="setbx" style="width:700px;">
            <div class="setbx_top">
            <h1 class="headings"><?php echo Yii::t('app','Teacher Settings'); ?></h1>
            </div>
            <div class="setbx_bot">
                <ul>                    
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-bars"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Categories').'<span>'.Yii::t('app','Teacher Categories').'</span>', array('employees/employeeCategories/admin'),array('class'=>'name-txt')) ?></li>
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-graduation-cap"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Department').'<span>'.Yii::t('app','Teacher Departments').'</span>', array('employees/employeeDepartments/admin'),array('class'=>'name-txt')) ?></li>
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-signal"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Positions').'<span>'.Yii::t('app','Teacher Positions').'</span>', array('employees/employeePositions/admin'),array('class'=>'name-txt')) ?></li>
                    
                    <li class="menu_box">
                    <div class="set_icon"><i class="fa fa-level-up"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Manage Grades').'<span>'.Yii::t('app','Teacher Grades').'</span>', array('employees/employeeGrades/admin'),array('class'=>'name-txt')) ?></li>
                    
                     <li class="menu_box">
                        <span class="fp-premium badge" data-text="Paid"></span>
                    <div class="set_icon"><i class="fa fa-edit"></i></div>
                    <?php echo CHtml::link(Yii::t('app','Leave Types').'<span>'.Yii::t('app','Teacher Leave Types').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    
                </ul>
            </div>
            <div class="clear"></div>
            </div>
        </div>  
        <?php
		}
		if(ModuleAccess::model()->check('Fees'))
		{
		?>
        <div class="block_box">  
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                <h1 class="headings"><?php echo Yii::t('app','Financial Settings');?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>                       
                        <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-money"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Manage Fees').'<span>'.Yii::t('app','Create Fees').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
           </div> 
       <?php
		}
	   ?>     
       <div class="clear"></div>
    </div>              
     <?php
	 if(ModuleAccess::model()->check('Downloads'))
	 {
	 ?>
    <div class="block_box">  
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                <h1 class="headings"><?php echo Yii::t('app','Downloads Settings');?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>                       
                        <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-align-left"></i></div>
                        <?php echo CHtml::link(Yii::t('app','File Category').'<span>'.Yii::t('app','Create File Categories').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        
                        <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-upload"></i></div>
                        <?php echo CHtml::link(Yii::t('app','All File Uploads').'<span>'.Yii::t('app','View All File Uploads').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
           </div> 
     <?php
	 }
	 ?>
       <div class="clear"></div>
       <?php
	   if(ModuleAccess::model()->check('Settings'))
	   {
	   ?>
    	<div class="block_box">
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                <h1 class="headings"><?php echo Yii::t('app','SMS Settings');?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>
                        <?php /*?><li>
                        <div class="set_icon"><i class="fa fa-gear"></i></div>
                        <?php echo CHtml::link(Yii::t('settings','SMS Settings<span>Enable SMS, Send SMS notifications</span>'), array('smsSettings/create'),array('class'=>'')) ?></li><?php */?>
                        <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-comments-o"></i></div>
                        <?php echo CHtml::link(Yii::t('app','SMS Counter').'<span>'.Yii::t('app','Track SMS Count').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
           </div>
    <?php
	   }
	   if(ModuleAccess::model()->check('Notify'))
	   {
	?>     
           <div class="clear"></div>
           <div class="block_box">
                <div class="setbx" style="width:700px;">
                    <div class="setbx_top">
                    <h1 class="headings"><?php echo Yii::t('app','Templates');  ?></h1>
                    </div>
                    <div class="setbx_bot">
                        <ul>
                            <li class="menu_box">
                                <span class="fp-premium badge" data-text="Paid"></span>
                            <div class="set_icon"><i class="fa fa-th-list"></i></div>
                            <?php echo CHtml::link(Yii::t('app','SMS Templates').'<span>'.Yii::t('app','Edit SMS Templates').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                            <li class="menu_box">
                                <span class="fp-premium badge" data-text="Paid"></span>
                            <div class="set_icon"><i class="fa fa-envelope"></i></div>
                            <?php echo CHtml::link(Yii::t('app','Email Templates').'<span>'.Yii::t('app','Edit Email Templates').'</span>', array('#'),array('class'=>'name-txt')) ?></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    </div>
           </div>   
      <?php
	   }
	  ?>        
    <div class="clear"></div>
    </div>
    <?php
	   if(ModuleAccess::model()->check('Settings'))
	   {
	?>
    <div class="block_box">
            <div class="setbx" style="width:700px;">
                <div class="setbx_top">
                <h1 class="headings"><?php echo Yii::t('app','Notification Settings');?></h1>
                </div>
                <div class="setbx_bot">
                    <ul>
                        <li class="menu_box">
                            <span class="fp-premium badge" data-text="Paid"></span>
                        <div class="set_icon"><i class="fa fa-gear"></i></div>
                        <?php echo CHtml::link(Yii::t('app','Notification Settings').'<span>'.Yii::t('app','Enable SMS, MAIL notifications').'</span>', array('#'),array('class'=>'name-txt')) ?></li>				
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
       </div> 
              
           <div class="clear"></div>
    
            <div class="block_box">
                   <div class="setbx" style="width:700px;">
                   <div class="setbx_top">
                        <h1 class="headings"><?php echo Yii::t('app','Help URL');?></h1>
                    </div>
                   <div class="setbx_bot">
                    <ul>
                        <li class="menu_box">
                        <div class="set_icon"><i class="fa fa-headphones"></i></div>
                        <?php
                            echo CHtml::ajaxLink(Yii::t('app','Help').'<span>'.Yii::t('app','Help Line').'</span>', Yii::app()->createUrl('notificationSettings/help' ), array('type' =>'GET','dataType' => 'text',  'update' =>'#help_link', 'onclick'=>'$("#help_link_dialog").dialog("open"); return false;',),array('class'=>'help_class name-txt'));?></li>	
                                        
                    </ul>
                </div>
                <div class="clear"></div>
                </div>
            </div>    
        <div  id="help_link"></div>
    	
    	
           <div class="clear"></div>
      <?php
	   }
	   ?>
   </div>
    </td>
  </tr>
    </table>
   </div>
    </td>
  </tr>
</table>


<br/><br/><br/>
<script>
$("#search_id").keyup(function(){
		
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;		
 
        // Loop through the comment list
        $(".menu_box").each(function(){ 
            // If the list item does not contain the text phrase fade it out
            if ($(this).find('.name-txt').text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
				if($(this).closest(".block_box").find('li.menu_box:visible').length == 0){
					$(this).closest(".block_box").hide();
				}
            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).show();
                count++;
				if(!$(this).closest(".block_box").is(":visible")){
					$(this).closest(".block_box").show();
				}
            }
        });
    });
</script>

<script>
$(".help_class").click(function(e) {
    $('form#course_status_form').remove();
});
</script>
<script>

//CREATE 

    $('#add_subjects ').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/subject/returnForm",
            data:{"batch_id":0,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#subjects-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#subjects-grid").removeClass("ajax-sending");
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

</script>