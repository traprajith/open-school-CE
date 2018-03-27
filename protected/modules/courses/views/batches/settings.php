<?php
$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	$batch->name=>array('/courses/batches/batchstudents','id'=>$_REQUEST['id']),
	Yii::t('app','Settings'),
);
?>
<div style="background:#FFF;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tbody><tr>
   
    <td valign="top">
<div style="padding:20px;">
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <?php $this->renderPartial('/batches/tab');?>
    
    <div class="clear"></div>
    <div class="emp_cntntbx" style="padding-top:10px;">
    
    <div class="setbx_con">
    	<div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('app','General Settings');?></h1>
    	</div>
    	<div class="setbx_bot" >
    		<ul>
    			<li>
                <div class="set_icon"><i class="fa fa-external-link"></i></div>
                <?php echo CHtml::link(Yii::t('app','Promote').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span>'.Yii::t('app','Promoting').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>', array('batches/promote','id'=>$_REQUEST['id']),
												array('id'=>'add_exam-groups','class'=>'')) ?></li>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
    <div class="clear"></div>
    	<div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('app','Subject Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
   			<ul>
    			<li>
				<div class="set_icon"><i class="fa fa-book"></i></div>
				<?php echo CHtml::link(Yii::t('app','Add Subject to').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span>'.Yii::t('app','Add Subjects to').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>', array('/courses/subject','id'=>$_REQUEST['id']),array('id'=>'add_exam-groups','class'=>'')) ?></li>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('app','Assessments Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-edit"></i></div>
                <?php echo CHtml::link(Yii::t('app','New Examination').'<span>'.Yii::t('app','New Examination').'</span>', array('','id'=>$_REQUEST['id']),
									array('id'=>'add_exam-groups','class'=>'')) ?>                
                </li>
               
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
				<div class="set_icon"><i class="fa fa-line-chart"></i></div>
				<?php echo CHtml::link(Yii::t('app','New Grading Level').'<span>'.Yii::t('app','New Grading Levels').'</span>', 
											array('','id'=>$_REQUEST['id']),array('class'=>''));?></li>
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
				<div class="set_icon"><i class="fa fa-bar-chart-o"></i></div>
				<?php echo CHtml::link(Yii::t('app','Set Default Grading Levels').'<span>'.Yii::t('app','Set Default Grading Levels').'</span>',
				 							array('','id'=>$_REQUEST['id']),array('class'=>''));?></li>
    		</ul>
    	</div>
    	<div class="clear"></div>
    	</div>
        <div class="clear"></div>
        <div class="setbx" style="width:100%">
    	<div class="setbx_top" style="width:100%">
    	<h1><?php echo Yii::t('app','Time Table and Attendance Settings');?></h1>
    	</div>
    	<div class="setbx_bot">
    		<ul>
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-gears"></i></div>
                <?php echo CHtml::link(Yii::t('app','Set Week Days').'<span>'.Yii::t('app','Set Week Days').'</span>', 
									array('','id'=>$_REQUEST['id']),array('class'=>''));?>
                </li>
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-clock-o"></i></div>
                <?php echo CHtml::link(Yii::t('app','Set Class Timings').'<span>'.Yii::t('app','ClassTimings and TimeTable').'</span>', 
									array('','id'=>$_REQUEST['id']),array('class'=>''));?>
    			<li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-calendar"></i></div>
                <?php echo CHtml::link(Yii::t('app','View Timetable').'<span>'.Yii::t('app','View/Publish Timetable').'</span>', array('','id'=>$_REQUEST['id']),array('class'=>''));?>
                </li>
                <li class="menu_box"><span class="fp-premium badge" data-text="Paid"></span>
                <div class="set_icon"><i class="fa fa-bars"></i></div>
				<?php echo CHtml::link(Yii::t('app','Attendance Register').'<span>'.Yii::t('app','Mark Attendance').'</span>', array('','id'=>$_REQUEST['id']),array('class'=>''));?>
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
