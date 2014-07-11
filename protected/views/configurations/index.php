<?php
$this->breadcrumbs=array(
	'Settings',
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
    <div class="cont_right ">
    <table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td>
      <div style="padding-top:10px;" class="emp_cntntbx">
    <div class="setbx_con">
    	<div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','General Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li><?php echo CHtml::link(Yii::t('settings','School Setup<span>School Name,Logo..</span>'), array('/configurations/create'),array('class'=>'icon19')) ?></li>
                <li><?php echo CHtml::link(Yii::t('settings','News &amp; Events<span>Create/View Events</span>'), array('/cal'),array('class'=>'icon20')) ?></li>
                 <li><?php echo CHtml::link(Yii::t('settings','Translation<span>Language Translation</span>'), array('/translate/'),array('class'=>'icon20')) ?></li>
    			<?php /*?><li><a href="#" class="icon21">Authorization Manager<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon22">Backup Manager<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon23">Modules &amp; Plugins<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon24">Languages<span>Admins &amp; Class Teachers</span></a></li>
				<li><a href="#" class="icon25">Server Info<span>Admins &amp; Class Teachers</span></a></li><?php */?>  		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    <div class="clear"></div>
    	<div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','Enrollment Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
   			<ul>
    			<?php /*?><li><a href="#enroll_process" id="enroll_p" class="icon26">Enrollment Process<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    			<?php /*?><li><a href="#" class="icon27">Additional Fields<span>Admins &amp; Class Teachers</span></a></li>
    			<li><a href="#" class="icon28">Enrollment Forms<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    			<li>
                <?php echo CHtml::link(Yii::t('settings','Manage Category<span>Admins &amp; Class Teachers</span>'), array('students/studentCategory'),array('class'=>'icon34')) ?></li>
            </ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','Course/Batch Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li><?php echo CHtml::link(Yii::t('settings','Manage Courses<span>Create,Manage &amp; Reorder</span>'), array('courses/courses/managecourse'),array('class'=>'icon30')) ?></li>
    			<?php /*?><li><a href="#" class="icon3">Promote Batches<span>Admins &amp; Class Teachers</span></a></li>
    			<li><a href="#" class="icon4">Copy Batch Settings<span>Admins &amp; Class Teachers</span></a></li><?php */?>
                <li><?php echo CHtml::link(Yii::t('settings','Manage Subjects<span>Site Wide Default Subjects</span>'), array('#'),array('id'=>'add_subjects','class'=>'icon5')) ?></li>
                <!--<a href="#" class="icon5">Default Subjects<span>Admins &amp; Class Teachers</span></a>-->
                <li><?php echo CHtml::link(Yii::t('settings','Subject-Batch Association<span>Associate Cources to Subjects</span>'), array('employees/employeesSubjects/create'),array('class'=>'icon6')) ?></li>
                <li><?php echo CHtml::link(Yii::t('settings','Default Weekdays<span>Default School Weekdays</span>'), array('courses/weekdays'),array('class'=>'icon13')) ?></li>
              
                
               <?php /*?> <li><a href="#" class="icon14">Default Class Timings<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','Employee Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
                <?php /*?><li><a href="#" class="icon26">Admission Process<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon28">Admission Forms<span>Admins &amp; Class Teachers</span></a></li><?php */?>
                <li><?php echo CHtml::link(Yii::t('settings','Subject Association<span>Associate Cources to Subjects</span>'), array('employees/employeesSubjects/create'),array('class'=>'icon32')) ?></li>
                <li><?php echo CHtml::link(Yii::t('settings','Manage Categories<span>Employee Categories</span>'), array('employees/employeeCategories/admin'),array('class'=>'icon34')) ?></li>
                <li><?php echo CHtml::link(Yii::t('settings','Manage Department<span>Employee Departments</span>'), array('employees/employeeDepartments/admin'),array('class'=>'icon33')) ?></li>
                <li><?php echo CHtml::link(Yii::t('settings','Manage Positions<span>Employee Positions</span>'), array('employees/employeePositions/admin'),array('class'=>'icon35')) ?></li>
                <?php /*?><li><a href="#" class="icon36">Manage Grades<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon27">Additional Fields<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
<div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','Financial Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
                <?php /*?><li><a href="#" class="icon37">Fees Process<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon38">Default Fee Structure<span>Admins &amp; Class Teachers</span></a></li>
                <li><a href="#" class="icon31">Automatic Transactions<span>Admins &amp; Class Teachers</span></a></li>
    			<li><a href="#" class="icon39">Payslip Settings<span>Admins &amp; Class Teachers</span></a></li><?php */?>
                <li><?php echo CHtml::link(Yii::t('settings','Manage Categories<span>Fee Categories</span>'), array('fees/financeFeeCategories'),array('class'=>'icon34')) ?></li>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
       <div class="clear"></div>
    </div>
    <div class="setbx" style="width:700px;">
    	<div class="setbx_top">
    	<h1><?php echo Yii::t('settings','SMS Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li><?php echo CHtml::link(Yii::t('settings','SMS Settings<span>Enable SMS, Send SMS notifications</span>'), array('smsSettings/'),array('class'=>'icon19')) ?></li>
			</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    <div class="clear"></div>
    </div>
      </td>
      </tr>
    </table>
    </div>
    </td>
  </tr>
</table>
<div id="enroll_process" style="display:none">
            <table style="min-height:700px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                
    <td>
    <h2 style="color: #FF8400;font-size: 15px; padding-bottom:10px;font-weight: bold;border-bottom:#B2B2B2 1px dashed;width:80%">Enrollment Process</h2>
    <input name="sd" type="radio" checked="checked" /><span  style="color: #666;font-size: 12px; padding-bottom:0px;font-weight: bold;">O-S Default </span>
    <br/><br/>
    <div class="dropp_mid">
    <div class="dropp_mid_top">
    <div class="drop_main_bx">
    
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot">
    <div class="droppbox dbactive">
    <ul>
    <li>Leads Manager</li>
    <li style="float:right"><img src="images/drop_icon_bl.png" width="14" height="15" /></li>
    </ul>
    </div>    
    </li>
    <li class="droptext">Records the Admission Form</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div> 
    
    <div class="arrow"></div>
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot">
    <div class="droppbox">
    <ul>
    <li>Admission Manager</li>
    <li style="float:right"><img src="images/drop_icon.png" width="14" height="15" /></li>
    </ul>
    </div>
    </li>
    <li class="droptext">Records the Admission Form</li>
    <li class="droptext">Approves the Admission Form</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div>
    <div class="arrow"></div>
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot">
    <div class="droppbox">
    <ul>
    <li>Mathew Graham</li>
    <li style="float:right"><img src="images/drop_icon.png" width="14" height="15" /></li>
    </ul>
    </div>
    </li>
    <li class="droptext">Records the Attendance</li>
    <li class="droptext">Approves the Attendance</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div>
    
    </div>
    
    <div class="clear"></div>
    <div class="curvebx">
    <div class="curvebxleft"></div>
    <div class="curvebxmid"></div>
    <div class="curvebxright"></div>
    
    
    </div>
    <div class="clear"></div>
    <div class="drop_main_bx">
    
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot">
    
    
    </li>
    <li class="droptext">Undefined</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div> 
    
    <div class="arrow"></div>
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot"></li>
	<li class="droptext">Undefined</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div>
    <div class="arrow"></div>
    <div class="drop_main_cntntbx">
    <div class="drop_main_cntntbxtop">
    <ul>
    <li class="dropslot"></li>
	<li class="droptext">Undefined</li>
    </ul>
    </div>
    
    <div class="drop_main_cntntbxbtm"></div>
    </div>
    
    </div>
    </div>
    <div class="dropp_mid_bot"></div>
    </div>
                
                </td>
              </tr>
            </table>
    <input name="sd" type="radio"/><span  style="color: #666;font-size: 12px; padding-bottom:0px;font-weight: bold;">Choose From a Template : <select name="temp_set"></select></span>
<br/><br/>
    <input name="sd" type="radio"/><span  style="color: #666;font-size: 12px; padding-bottom:0px;font-weight: bold;">Define Custom Process</span>
<br/><br/>
</div>
<br/><br/><br/>

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