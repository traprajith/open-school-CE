<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	'Settings',
);
?>
<div style="background:#FFF;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
   
    <td valign="top">
<div style="padding:20px;">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    
        
    <!--<div class="edit_bttns">
    <ul>
    <li>
    <a href="#" class=" edit last">Edit</a>    </li>
    </ul>
    </div>-->
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <?php $this->renderPartial('/batches/tab');?>
    
    <div class="clear"></div>
    <div class="emp_cntntbx" style="padding-top:10px;">
    
    <div class="setbx_con">
    	<div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('Batch','General Settings');?></h1>
    	</div>
    	<div class="setbx_bot" >
    		<ul>
    			<?php /*?><li><a class="icon1" href="#">Add Batch Admins<span>Admins &amp; Class Teachers</span></a></li>
    			<li><a class="icon2" href="#">Add New Event<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    			<li>
                <?php echo CHtml::link(Yii::t('Batch','Promote Batch'.'<span>'.'Admins &amp; Class Teachers'.'</span>'), array('batches/promote','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'icon3')) ?></li>
                <?php /*?><li><a class="icon4" href="#">Copy Batch Settings<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    <div class="clear"></div>
    	<div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('Batch','Subject Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
   			<ul>
    			<?php /*?><li><?php echo CHtml::link(Yii::t('Batch','Add a Default Subject').'<span>'.Yii::t('Batch','Admins &amp; Class Teachers').'</span>', array('/courses/defaultsubjects','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'icon5')) ?></li><?php */?>
    			<li><?php echo CHtml::link(Yii::t('Batch','Add Subject to Batch').'<span>'.Yii::t('Batch','Admins &amp; Class Teachers').'</span>', array('/courses/subject','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'icon6')) ?></li>
    			<?php /*?><li><a class="icon7" href="#">Associate Subject to Employee<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('Batch','Assessments Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li>
                <?php echo CHtml::link(Yii::t('Batch','New Examination').'<span>'.Yii::t('Batch','Admins &amp; Class Teachers').'</span>', array('/courses/exam','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'icon40')) ?>
                
                </li>
    			<li><?php echo CHtml::link(Yii::t('Batch','New Grading Level'.'<span>').Yii::t('Batch','Timetable &amp; Attendance').'</span>', array('/courses/gradingLevels','id'=>$_REQUEST['id']),array('class'=>'icon9'));?></li>
    			<li><?php echo CHtml::link(Yii::t('Batch','Set Default Grading Levels').'<span>'.Yii::t('Batch','Admins &amp; Class Teachers').'</span>', array('/courses/gradingLevels/default','id'=>$_REQUEST['id']),array('class'=>'icon10','confirm'=>'Are You Sure? All custom settings will be deleted.'));?></li>
                <li><?php echo CHtml::link(Yii::t('Batch','Manage Exam Score').'<span>'.Yii::t('Batch','Admins &amp; Class Teachers').'</span>', array('/courses/exam','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'icon11')) ?></li>
               <?php /*?> <li><a class="icon12" href="#">Generate Report Cards<span>Admins &amp; Class Teachers</span></a></li><?php */?>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('Batch','Time Table or Attendance Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li>
                <?php echo CHtml::link(Yii::t('Batch','Set Week Days').'<span>'.Yii::t('Batch','Timetable &amp; Attendance').'</span>', array('/courses/weekdays','id'=>$_REQUEST['id']),array('class'=>'icon13'));?>
                </li>
    			<li>
                <?php echo CHtml::link(Yii::t('Batch','Set Class Timings').'<span>'.Yii::t('Batch','ClassTimings &amp; TimeTable').'</span>', array('/courses/classTiming','id'=>$_REQUEST['id']),array('class'=>'icon14'));?>
    			<li>
                <?php echo CHtml::link(Yii::t('Batch','View Timetable').'<span>'.Yii::t('Batch','View/Publish Timetable').'</span>', array('/courses/weekdays/timetable','id'=>$_REQUEST['id']),array('class'=>'icon15'));?>
                </li>
                <li>
				<?php echo CHtml::link(Yii::t('Batch','Attendance Register').'<span>'.Yii::t('Batch','Mark Attendance').'</span>', array('/courses/studentAttentance','id'=>$_REQUEST['id']),array('class'=>'icon16'));?>
                </li>
                <li>
                <?php echo CHtml::link(Yii::t('Batch','Attendance Report').'<span>'.Yii::t('Batch','Mark Attendance').'</span>', array('/courses/studentAttentance','id'=>$_REQUEST['id']),array('class'=>'icon17'));?>
                </li>
                <li>
                <?php echo CHtml::link(Yii::t('Batch','Mark Attendance').'<span>'.Yii::t('Batch','Mark Attendance').'</span>', array('/courses/studentAttentance','id'=>$_REQUEST['id']),array('class'=>'icon18'));?>
                </li>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    <div class="clear"></div>
    </div>
    </div>
    </div>
    
    </div>
    </div>
</td>
</tr>
</tbody
></table>
</div>
<script>
//CREATE EXAM

    $('#add_exam-groups').bind('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php?r=courses/exam/returnForm",
            data:{"batch_id":<?php echo $_GET['id'];?>,"YII_CSRF_TOKEN":"<?php echo Yii::app()->request->csrfToken;?>"},
                beforeSend : function() {
                    $("#exam-groups-grid").addClass("ajax-sending");
                },
                complete : function() {
                    $("#exam-groups-grid").removeClass("ajax-sending");
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
                                   var page=$("li.selected  > a").text();
                                $.fn.yiiGridView.update('exam-groups-grid', {url:'<?php echo Yii::app()->request->getUrl()?>',data:{"ExamGroups_page":page}});
                            } //onclosed function
                        });//fancybox
            } //success
        });//ajax
        return false;
    });//bind


})//document ready
    
</script>

