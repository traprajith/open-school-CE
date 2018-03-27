<style>
#jobDialog123
{
		height:auto;
}	
.mcbrow li.gtcol1{
	    width: 387px !important;
}
.del_err{ text-align:center; color:#F60;}	
.del_sub_err{ text-align:center; color:#F60  !important;}	
</style>

<?php
$this->breadcrumbs=array(
Yii::t('app','Courses')
);
?>
<?php 
$posts = Courses::model()->findAll("is_deleted =:x", array(':x'=>0));
$current_academic_yr = Configurations::model()->findByPk(35);
$academic_yrs = AcademicYears::model()->findAll();
if($posts!=NULL)
{
?>
<script>

	function detail_manage(id)
	{
	
		var rr= document.getElementById("dropwindemo"+id).style.display;
		if(document.getElementById("dropwindemo"+id).style.display=="block")
		{
			document.getElementById("dropwindemo"+id).style.display="none"; 
			$("#openbutton"+id).removeClass('open');
			$("#openbutton"+id).addClass('view');
		}
		else if(  document.getElementById("dropwindemo"+id).style.display=="none")
		{
			document.getElementById("dropwindemo"+id).style.display="block"; 
			$("#openbutton"+id).removeClass('view');
			$("#openbutton"+id).addClass('open');
		}
	}
	
	function details(id)
	{
		var rr= document.getElementById("dropwin"+id).style.display;
		if(document.getElementById("dropwin"+id).style.display=="block")
		{
			document.getElementById("dropwin"+id).style.display="none"; 
			$("#openbutton"+id).removeClass('open');
			$("#openbutton"+id).addClass('view');
		}
		else if(  document.getElementById("dropwin"+id).style.display=="none")
		{
			document.getElementById("dropwin"+id).style.display="block"; 
			$("#openbutton"+id).removeClass('view');
			$("#openbutton"+id).addClass('open');
		}
	}
	function rowdeletesub(id,cid){
		$(".del_sub_err").html("<?php echo Yii::t('app','Subject Successfully Deleted!'); ?>");		
		$("#subrow"+id).fadeOut("slow");
		$(".del_sub_err").fadeOut(9000);
		var subcount = $("#subcount"+cid).html();
		$("#subcount"+cid).html(subcount-1);
	}
	function rowdelete(id,cid)
	{
		$(".del_err").html("<?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','Successfully Deleted!'); ?>");		
		$("#batchrow"+id).fadeOut("slow");
		$(".del_err").fadeOut(9000);
		
		var count = $("#batchcount"+cid).html();
		$("#batchcount"+cid).html(count-1);
	}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <div  class="page-header"><h1><?php echo Yii::t('app','Manage Courses and').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></h1></div>
                
              	 <!-- Flash Message -->
				<?php
                Yii::app()->clientScript->registerScript(
                    'myHideEffect',
                    '$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
                    CClientScript::POS_READY
                );
                ?>
                <?php
                /* Success Message */
                if(Yii::app()->user->hasFlash('successMessage')): 
                ?>
                    <div class="flashMessage" style="background:#FFF; color:#C00; padding-left:220px; font-size:13px">
                    <?php echo Yii::app()->user->getFlash('successMessage'); ?>
                    </div>
                <?php endif; ?>
                
                
                <div class="del_sub_err"></div>
                 <div class="del_err"> </div>
                <?php 
						
				if(Yii::app()->user->year)
				{
					$year = Yii::app()->user->year;
				}
				else
				{
					$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
					$year = $current_academic_yr->config_value;
				}
				
				$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
				$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
				$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
				
				$posts=Courses::model()->findAll("is_deleted =:x and academic_yr_id =:y", array(':x'=>0,':y'=>$year));
                ?>
                <div id="jobDialog">
                    <div id="jobDialog1">                    	               
                    </div>
                </div>
                <div id="jobDialogs">
                    <div id="jobDialog1s">                    	               
                    </div>
                </div>
                
                
				
                
                <div class="pdf-box">
                	<div class="box-one"></div>
                        <div class="box-two">
                            <div class="add-new-cours">
                            	<?php echo CHtml::link('<span>'.Yii::t('app','Add Course').'</span>', array('/courses/courses/create'),array('class'=>' formbut-n')); ?>
                            </div>
                        </div>
                </div>
                
                <div class="clearfix"></div>
                <div class="mcb_Con">
                    <!--<div class="mcbrow hd_bg">
                    <ul>
                    <li class="col1">Course Name</li>
                    <li class="col2">Edit</li>
                    <li class="col3">Delete</li>
                    <li class="col4">Add Batch</li>
                    <li class="col5">View Batch</li>
                    </ul>
                    <div class="clear"></div>
                    </div>-->
                    
                    
                    <?php
					if($posts)
					{ 
					?>
                    
                    	 <?php 				
						if($year != $current_academic_yr->config_value and ($is_create->settings_value==0 or $is_edit->settings_value==0 or $is_delete->settings_value==0))
						{
						?>
							<div>
								<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
									<div class="y_bx_head" style="width:650px;">
									<?php 
										echo Yii::t('app','You are not viewing the current active year. ');
										if($is_create->settings_value==0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0)
										{ 
											echo Yii::t('app','To add a new').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','enable Create option in Previous Academic Year Settings.');
										}
										elseif($is_create->settings_value!=0 and $is_edit->settings_value==0 and $is_delete->settings_value!=0)
										{
											echo Yii::t('app','To edit a course or').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','enable Edit option in Previous Academic Year Settings.');
										}
										elseif($is_create->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value==0)
										{
											echo Yii::t('app','To delete a course or').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','enable Delete option in Previous Academic Year Settings.');
										}
										else
										{
											echo Yii::t('app','To manage courses and').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','enable the required options in Previous Academic Year Settings.');	
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
                 	
						foreach($posts as $posts_1)
						{
							//echo $posts_1->id;exit;
							$semester_enabled	= Configurations::model()->isSemesterEnabledForCourse($posts_1->id);
							if($semester_enabled){	// enabled
								$criteria	= new CDbCriteria;
								$criteria->join			= 'JOIN `semester_courses` `sc` ON `t`.`id`=`sc`.`semester_id`';
								$criteria->condition	= '`sc`.`course_id`=:course_id';
								$criteria->params		= array(':course_id'=>$posts_1->id);
								$semesters 		= Semester::model()->findAll($criteria);
								//var_dump($semesters);exit;
							}
						?>
                        <div class="according-bg">
						<div class="mcb-strip-bg" id="jobDialog1">
							<ul class="posctn-ul2">
								<li class="gtcol1" onclick="details('<?php echo $posts_1->id;?>');" style="cursor:pointer;">
									<?php echo ucfirst($posts_1->course_name); ?>
									<?php
									$course=Courses::model()->findByAttributes(array('id'=>$posts_1->id,'is_deleted'=>0));
									$batch=Batches::model()->findAll("course_id=:x AND is_deleted=:y AND is_active=:z AND academic_yr_id=:a", array(':x'=>$posts_1->id,':y'=>0,':z'=>1,':a'=>$course->academic_yr_id));
									$subjects = SubjectsCommonPool::model()->findAll("course_id =:x", array(':x'=>$posts_1->id));
									?>
									<span>
                                    <?php
                                    if($semester_enabled){
									?>
                                        <div  style="float:left" id="batchcount<?php echo $posts_1->id;?>"><?php echo count($semesters);?></div>
                                        <div style="float:left"><?php echo ' - '.Yii::t('app', 'Semester(s)');?>, </div>
                                    <?php
									}
									else{
									?>
                                        <div  style="float:left" id="batchcount<?php echo $posts_1->id;?>"><?php echo count($batch);?></div>
                                        <div style="float:left"><?php echo ' - '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?>, </div>
                                    <?php
									}
									?>
                                    <div  style="float:left" id="subcount<?php echo $posts_1->id;?>"> <?php echo count($subjects);?></div> <div style="float:left"> <?php echo ' - '.Yii::t('app','Subject(s)');?></div></span>
								</li>
                                </ul>
                                
                                <ul class="posctn-ul1">
                                
                                <?php
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
								{									
								?>
								<li class="e-gtcol1">
									<?php echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('courses/Edit'),array(
									'onclick'=>'$("#jobDialog11").dialog("open"); return false;',
									'update'=>'#jobDialog1','type' =>'GET','data' => array( 'val1' =>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialogcourseedit'.$posts_1->id, 'class'=>'edit')); ?>
								</li>
                                <?php
								}else{
								?>
								<li class="e-gtcol1">									
								</li>								
                                <?php
								}
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
								{
								?>
								<li class="e-gtcol1">
									<?php echo CHtml::link(Yii::t('app','Delete'), "#", array("submit"=>array('deactivate','id'=>$posts_1->id),'confirm' => Yii::t('app','Are you sure you want to delete this course ?').
																Yii::t('app','Note: All details (batches, timetable, exam) related to this course').' '.Yii::t('app','will be deleted.'), 'csrf'=>true));?>
								</li>
                                <?php
								}else{
								?>
                                    <li class="e-gtcol1">									
                                    </li>
                                <?php
								}
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
								{
								?>
								<li class="e-gtcol1">
									<?php echo CHtml::ajaxLink(Yii::t('app','Add Subject'),$this->createUrl('subjectsCommonPool/Addnew'),
														array('onclick'=>'$("#jobDialogs").dialog("open"); return false;','update'=>'#jobDialogs','type' =>'GET',
														'data' => array( 'val1' =>$posts_1->id),'dataType' => 'text',),
														array('id'=>'showJobDialog2'.$posts_1->id,'class'=>'add edit-subject')); ?>
								</li>
                                <li class="e-gtcol1">
									<?php echo CHtml::ajaxLink(Yii::t('app','Add').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),$this->createUrl('batches/Addnew'),
														array('onclick'=>'$("#jobDialog").dialog("open"); return false;','update'=>'#jobDialog','type' =>'GET',
														'data' => array( 'val1' =>$posts_1->id, 'academic_yr_id' => $posts_1->academic_yr_id ),'dataType' => 'text',),
														array('id'=>'showJobDialog1'.$posts_1->id,'class'=>'add')); ?>
								</li>
                                <?php
								}else{
								?>
                                	 <li class="e-gtcol1">									
                                    </li>
                                <?php
								}
								?>
                            
                                <?php /*?><li class="col5">
                                    <a href="javascript:void(0);" id="openbutton<?php echo $posts_1->id;?>" onclick="details('<?php echo $posts_1->id;?>');" class="view">
                                    <span class="dwnbg"></span>
                                    </a>
                                </li><?php */?>
							</ul>
							
							<div class="clear"></div>
						</div> <!-- END div class="mcbrow" id="jobDialog1" -->
                       </div> 
						
                        <?php                        	
							if($semester_enabled){	//enabled
								
								?>
                                <div class="cours-strip" id="dropwin<?php echo $posts_1->id; ?>" style="display: none;">
									<?php
										if(count($semesters)==0){
											?>
                                            <div class="semester-block">
                                            <?php echo Yii::t('app', 'No semester found');?>
                                            </div>
                                            <?php
										}
										else{
										$semester_ids	= array();
                                    	foreach($semesters as $semester){
											$colspan		= 4;
											$semester_ids[]	= $semester->id;
										?>
                                        <div class="semester-block">
                                            <div class="cours-table-hed">
                                            
                                            <h3><?php echo $semester->name;?></h3></div>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                                <thead>
                                                    <tr>
                                                        <th  width="15%"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '. Yii::t('app','Name');?></th>
                                                        <th width="25%"><?php echo Yii::t('app','Class Teacher');?></th>
                                                        <th width="15%"><?php echo Yii::t('app','Start Date');?></th>
                                                        <th width="15%"><?php echo Yii::t('app','End Date');?></th>
                                                        <?php
                                                        if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                        {
                                                            $colspan++;
                                                        ?>
                                                        <th width="30%"><?php echo Yii::t('app','Actions');?></th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $criteria	= new CDbCriteria;
                                                    $criteria->condition	= 'course_id=:x AND semester_id=:semester AND is_deleted=:y AND is_active =:z';
                                                    $criteria->params		= array(':x'=>$posts_1->id, ':semester'=>$semester->id, ':y'=>0, ':z'=>1);
                                                    $batches 				= Batches::model()->findAll($criteria);
                                                    
                                                    if(count($batches)==0){
                                                        echo '<tr><td colspan="'.$colspan.'" align="center">'.Yii::t('app', 'No batch found').'</td></tr>';
                                                    }
                                                    else{
                                                        foreach($batches as $batch_1){
                                                            echo '<tr id="batchrow'.$batch_1->id.'">';
                                                            echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link(ucfirst($batch_1->name), 
                                                                                            array('batches/batchstudents','id'=>$batch_1->id,)).'</td>';
                                                            $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                                            if($settings!=NULL)
                                                            {	
                                                                $date1=date($settings->displaydate,strtotime($batch_1->start_date));
                                                                $date2=date($settings->displaydate,strtotime($batch_1->end_date));									
                                                            }
                                                            $teacher = Employees::model()->findByAttributes(array('id'=>$batch_1->employee_id));
                                                            echo '<td align="center">';
                                                                if(!empty($teacher))
                                                                {
                                                                echo $teacher->first_name.' '.$teacher->last_name;
                                                                }
                                                                else
                                                                {
                                                                echo '-';
                                                                }
                                                            echo '</td>';					
                                                            echo '<td align="center">'.$date1.'</td>';
                                                            echo '<td align="center">'.$date2.'</td>';
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                            {
                                                            
                                                            echo '<td align="center"  class="sub_act">'; ?> 
                                                            <?php 
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                            {
                                                            
                                                            echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('batches/addupdate'),array(
                                                            'onclick'=>'$("#jobDialogbatches").dialog("open"); return false;',
                                                            'update'=>'#jobDialogbatches','type' =>'GET','data' => array( 'val1' =>$batch_1->id,'course_id'=>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialog1batchesedit'.$batch_1->id,'class'=>'add')); 
                                                            }
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                            {
                                                            $cid	=	$batch_1->course_id;	
                                                            echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('batches/remove'), array('success'=>'rowdelete('.$batch_1->id.','.$batch_1->course_id.')','type' =>'POST',
                                                            'data' => array( 'val1' =>$batch_1->id, Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),array('confirm'=>Yii::t('app','Are you sure you want to delete this'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")).' '.'?'.Yii::t('app','Note: All details (timetable, exam) related to this').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','will be deleted.')));
                                                            }
                                                            ?> 
                                                            <?php 
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
                                                            {
                                                                if(ModuleAccess::model()->check('Students')){
                                                                    echo '  '.CHtml::link(Yii::t('app','Add Student'), array('/students/students/create','bid'=>$batch_1->id)).'</td>';
                                                                }	
                                                            }
                                                            }
                                                            echo '</tr>';
                                                            echo '<div id="jobDialogbatches"></div>';
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>                                                     
                                        </div>
                                    <?php }
										}
									?>
                                    
                                    <?php
									if(count($semester_ids)>0){
                                    	$criteria	= new CDbCriteria;
										$criteria->condition	= 'course_id=:x AND is_deleted=:y AND is_active =:z AND ( semester_id IS NULL OR semester_id NOT IN ('.implode(',', $semester_ids).'))';
										$criteria->params		= array(':x'=>$posts_1->id, ':y'=>0, ':z'=>1);										
										$batches 				= Batches::model()->findAll($criteria);										
										if(count($batches)>0){
									?>
                                        <!--Remaining batches-->                                    
                                        <div class="semester-block">
                                            <div class="cours-table-hed"><h3><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app', 'without semester');?></h3></div>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                                <thead>
                                                    <tr>
                                                        <th  width="15%"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '. Yii::t('app','Name');?></th>
                                                        <th width="25%"><?php echo Yii::t('app','Class Teacher');?></th>
                                                        <th width="15%"><?php echo Yii::t('app','Start Date');?></th>
                                                        <th width="15%"><?php echo Yii::t('app','End Date');?></th>
                                                        <?php
                                                        if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                        {
                                                            $colspan++;
                                                        ?>
                                                        <th width="30%"><?php echo Yii::t('app','Actions');?></th>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                    <?php                                                
                                                        foreach($batches as $batch_1){
                                                            echo '<tr id="batchrow'.$batch_1->id.'">';
                                                            echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link(ucfirst($batch_1->name), 
                                                                                            array('batches/batchstudents','id'=>$batch_1->id,)).'</td>';
                                                            $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                                            if($settings!=NULL)
                                                            {	
                                                                $date1=date($settings->displaydate,strtotime($batch_1->start_date));
                                                                $date2=date($settings->displaydate,strtotime($batch_1->end_date));									
                                                            }
                                                            $teacher = Employees::model()->findByAttributes(array('id'=>$batch_1->employee_id));
                                                            echo '<td align="center">';
                                                                if(!empty($teacher))
                                                                {
                                                                echo $teacher->first_name.' '.$teacher->last_name;
                                                                }
                                                                else
                                                                {
                                                                echo '-';
                                                                }
                                                            echo '</td>';					
                                                            echo '<td align="center">'.$date1.'</td>';
                                                            echo '<td align="center">'.$date2.'</td>';
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                            {
                                                            
                                                            echo '<td align="center"  class="sub_act">'; ?> 
                                                            <?php 
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                            {
                                                            
                                                            echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('batches/addupdate'),array(
                                                            'onclick'=>'$("#jobDialogbatches").dialog("open"); return false;',
                                                            'update'=>'#jobDialogbatches','type' =>'GET','data' => array( 'val1' =>$batch_1->id,'course_id'=>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialog1batchesedit'.$batch_1->id,'class'=>'add')); 
                                                            }
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                            {
                                                            $cid	=	$batch_1->course_id;	
                                                            echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('batches/remove'), array('success'=>'rowdelete('.$batch_1->id.','.$batch_1->course_id.')','type' =>'POST',
                                                            'data' => array( 'val1' =>$batch_1->id, Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),array('confirm'=>Yii::t('app','Are you sure you want to delete this'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")).' '.'?'.Yii::t('app','Note: All details (timetable, exam) related to this').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','will be deleted.')));
                                                            }
                                                            ?> 
                                                            <?php 
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
                                                            {
                                                                if(ModuleAccess::model()->check('Students')){
                                                                    echo '  '.CHtml::link(Yii::t('app','Add Student'), array('/students/students/create','bid'=>$batch_1->id)).'</td>';
                                                                }	
                                                            }
                                                            }
                                                            echo '</tr>';
                                                            echo '<div id="jobDialogbatches"></div>';
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>                                                     
                                        </div>
                                        <!--Remaining batches--> 
                                  	<?php }
									}
									?>                 
                                	
									<?php if(count($subjects) !=0){?>
                                        <div class="semester-block">
                                            <div class="cours-table-hed"><h3><?php echo Yii::t('app','Subjects');?></h3></div>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                                <tbody>
                                                    <!--class="cbtablebx_topbg"  class="sub_act"-->
                                                    <tr>
                                                        <th width="8%"><?php echo Yii::t('app','#');?></th>
                                                        <th width="30%"><?php echo Yii::t('app','Subject Name');?></th>
                                                        <?php /*?><td align="center" width="22%"><?php echo Yii::t('app','Subject Code');?></td><?php */?>
                                                        <th width="25%"><?php echo Yii::t('app','Maximum Weekly Classes');?></th>
                                                        <th width="15%"><?php echo Yii::t('app','Action');?></th>
                                                    </tr>
                                                    <tbody>
                                                    <?php
                                                    
                                                    $i=1;
                                                    
                                                    foreach($subjects as $subject){
                                                        
                                                    
                                                   echo '<tr id="subrow'.$subject->id.'">';
                                                ?>
                                                        <td align="center"><?php echo $i++?></td>
                                                        <td align="center"><?php echo $subject->subject_name;?></td>
                                                       <?php /*?> <td align="center"><?php echo $subject->subject_code;?></td><?php */?>
                                                        <td align="center"><?php echo $subject->max_weekly_classes;?></td>
                                                        <td align="center"  class="sub_act"><?php 
                                                        if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                        {
                                                        
                                                        echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('subjectsCommonPool/addupdate'),array(
                                                        'onclick'=>'$("#jobDialogsub").dialog("open"); return false;',
                                                        'update'=>'#jobDialogsub','type' =>'POST','data' => array( 'sub_id' =>$subject->id,'course_id'=>$subject->course_id, Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken ),'dataType' => 'text'),array('id'=>'showJobDialogsub'.$subject->id, 'class'=>'add edit-subject')); 
                                                        }
                                                        if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                        {
                                                        echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('subjectsCommonPool/remove'), array('success'=>'rowdeletesub('.$subject->id.','.$posts_1->id.')','type' =>'POST',
                                                                                'data' => array('sub_id' =>$subject->id, Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),
                                                                                array('id'=>'showJobDialogdelete'.$subject->id,'confirm'=>Yii::t('app','Are you sure you want to delete this subject( Also delete this subject related exam Scheduled and Exam marks )?')));
                                                        }
                                                        ?> </td>
                                                    </tr>
                                                    <div id="jobDialogsub"></div>
                                                    <?php
                                                    }
                                                    ?>
                                           		</tbody>   
                                           </table>                                          
                                       </div>
                              		<?php }?>
                                </div>
                                <?php
							}
							else{	//disabled
						?>
                        	<div class="cours-strip" id="dropwin<?php echo $posts_1->id; ?>" style="display: none;">
                                <div class="semester-block">
                                    <div class="cours-table-hed"><h3><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></h3></div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                        <thead>
                                            <!--class="cbtablebx_topbg"  class="sub_act"-->
                                            <tr>
                                                <th  width="15%"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '. Yii::t('app','Name');?></th>
                                                <th width="25%"><?php echo Yii::t('app','Class Teacher');?></th>
                                                <th width="15%"><?php echo Yii::t('app','Start Date');?></th>
                                                <th width="15%"><?php echo Yii::t('app','End Date');?></th>
                                                <?php
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                {
                                                ?>
                                                <th width="30%"><?php echo Yii::t('app','Actions');?></th>
                                                <?php
                                                }
                                                ?>
                                            </tr> 
                                            </thead>
                                            <tbody>
                                            <?php 
                                            if(count($batch) !=0){
                                            foreach($batch as $batch_1)
                                            {
                                                echo '<tr id="batchrow'.$batch_1->id.'">';
                                                echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link(ucfirst($batch_1->name), 
                                                                                array('batches/batchstudents','id'=>$batch_1->id,)).'</td>';
                                                $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                                                if($settings!=NULL)
                                                {	
                                                    $date1=date($settings->displaydate,strtotime($batch_1->start_date));
                                                    $date2=date($settings->displaydate,strtotime($batch_1->end_date));									
                                                }
                                                $teacher = Employees::model()->findByAttributes(array('id'=>$batch_1->employee_id));
                                                echo '<td align="center">';
                                                    if(!empty($teacher))
                                                    {
                                                    echo $teacher->first_name.' '.$teacher->last_name;
                                                    }
                                                    else
                                                    {
                                                    echo '-';
                                                    }
                                                echo '</td>';					
                                                echo '<td align="center">'.$date1.'</td>';
                                                echo '<td align="center">'.$date2.'</td>';
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and ($is_create->settings_value!=0 or $is_edit->settings_value!=0 or $is_delete->settings_value!=0)))
                                                {
                                                
                                                echo '<td align="center"  class="sub_act">'; ?> 
                                                <?php 
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                {
                                                
                                                echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('batches/addupdate'),array(
                                                'onclick'=>'$("#jobDialogbatches").dialog("open"); return false;',
                                                'update'=>'#jobDialogbatches','type' =>'GET','data' => array( 'val1' =>$batch_1->id,'course_id'=>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialog1batchesedit'.$batch_1->id,'class'=>'add')); 
                                                }
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                {
                                                $cid	=	$batch_1->course_id;	
                                                echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('batches/remove'), array('success'=>'rowdelete('.$batch_1->id.','.$batch_1->course_id.')','type' =>'POST',
                                                'data' => array( 'val1' =>$batch_1->id, Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),array('confirm'=>Yii::t('app','Are you sure you want to delete this'.' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")).' '.'?'.Yii::t('app','Note: All details (timetable, exam) related to this').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','will be deleted.')));
                                                }
                                                ?> 
                                                <?php 
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
                                                {
                                                    if(ModuleAccess::model()->check('Students')){
                                                        echo '  '.CHtml::link(Yii::t('app','Add Student'), array('/students/students/create','bid'=>$batch_1->id)).'</td>';
                                                    }	
                                                }
                                                }
                                                echo '</tr>';
                                                echo '<div id="jobDialogbatches"></div>';
                                            }
											}
											else{
												?><tr><td colspan="5"><center><?php echo Yii::t('app','No Results');?></center></td></tr><?php
											}
                                            ?>
                                        </tbody>
                                    </table>
                                <?php if(count($subjects) !=0){?>
                                <div class="cours-subject-tbl cours-strip">
                                    <div class="cours-table-hed"><h3><?php echo Yii::t('app','Subjects');?></h3></div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                        <tbody>
                                            <!--class="cbtablebx_topbg"  class="sub_act"-->
                                            <tr>
                                                <th width="8%"><?php echo Yii::t('app','#');?></th>
                                                <th width="30%"><?php echo Yii::t('app','Subject Name');?></th>
                                                <?php /*?><td align="center" width="22%"><?php echo Yii::t('app','Subject Code');?></td><?php */?>
                                                <th width="25%"><?php echo Yii::t('app','Maximum Weekly Classes');?></th>
                                                <th width="15%"><?php echo Yii::t('app','Action');?></th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            
                                            $i=1;
                                            
                                            foreach($subjects as $subject){
                                                
                                            
                                           echo '<tr id="subrow'.$subject->id.'">';
                                        ?>
                                                <td align="center"><?php echo $i++?></td>
                                                <td align="center"><?php echo $subject->subject_name;?></td>
                                               <?php /*?> <td align="center"><?php echo $subject->subject_code;?></td><?php */?>
                                                <td align="center"><?php echo $subject->max_weekly_classes;?></td>
                                                <td align="center"  class="sub_act"><?php 
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                {
                                                
                                                echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('subjectsCommonPool/addupdate'),array(
                                                'onclick'=>'$("#jobDialogsub").dialog("open"); return false;',
                                                'update'=>'#jobDialogsub','type' =>'POST','data' => array( 'sub_id' =>$subject->id,'course_id'=>$subject->course_id, Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken ),'dataType' => 'text'),array('id'=>'showJobDialogsub'.$subject->id, 'class'=>'add edit-subject')); 
                                                }
                                                if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                {
                                                echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('subjectsCommonPool/remove'), array('success'=>'rowdeletesub('.$subject->id.','.$posts_1->id.')','type' =>'POST',
                                                                        'data' => array('sub_id' =>$subject->id, Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),
                                                                        array('id'=>'showJobDialogdelete'.$subject->id,'confirm'=>Yii::t('app','Are you sure you want to delete this subject( Also delete this subject related exam Scheduled and Exam marks )?')));
                                                }
                                                ?> </td>
                                            </tr>
                                            <div id="jobDialogsub"></div>
                                            <?php
                                            }
                                            ?>
                                   </tbody>   
                                   </table> 
                                  
                               </div>      <?php }?>                
                            </div>
                            </div>
                        <?php
							}
						?>
                        
						<!-- Batch Details -->
						
						<!--class="cbtablebx"-->
						

						
						<!-- END Batch details div class="pdtab_Con" -->
						<div id='check'></div>
						<?php 
						} // END $posts as $posts_1
						?>
                         
                        <?php
					} // END if $posts
					else
					{
					?>
                    <div>
                        <div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                        <div class="y_bx_head" style="width:650px;">
                        	<?php
							if(!$current_academic_yr->config_value)
							{
								echo Yii::t('app','It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:');
							}
							else
							{
								echo Yii::t('app','It appears that no courses or').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','are created for current academic year.');
							}
							?>
                        </div>
                        <?php
                        if(!$current_academic_yr->config_value)
                        {
                        ?>
                            <div class="y_bx_list" style="width:650px;">
                            <h1><?php echo CHtml::link(Yii::t('app','Setup Academic Year'),array('/academicYears/create')) ?></h1>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="y_bx_list" style="width:650px;">
                        	<h1><?php echo CHtml::link(Yii::t('app','Add New Course').' &amp; '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('courses/create')) ?></h1>
						</div>
                        </div>
                    </div>
                    
					<?php	
					}
                   	?>
                
                </div> <!-- END div class="mcb_Con" -->
            </div> <!-- END div class="cont_right formWrapper" -->
        </td>
    </tr>
</table>
<?php 
    } ////
    
    else
    { ?>
   <?php /*?> <link rel="stylesheet" type="text/css" href="/openschool/css/style.css" /><?php */?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <div style="padding:20px 20px">
    <div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
    	
            <div class="y_bx_head" style="width:650px;">
                <?php
				if(!$current_academic_yr->config_value or !$academic_yrs)
				{
					echo Yii::t('app','It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:');
				}
				else
				{
					echo Yii::t('app','It appears that no courses or').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','are created for current academic year.');
				}
				?>
            </div>
            <?php
            if(!$academic_yrs)
            {
            ?>
            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link(Yii::t('app','Setup Academic Year'),array('/academicYears/create')) ?></h1>
            </div>
            <?php
            }
			elseif(!$current_academic_yr->config_value)
			{
            ?>
            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link(Yii::t('app','Setup Academic Year'),array('/configurations/create')) ?></h1>
            </div>
            <?php
			}
			?>

            <div class="y_bx_list" style="width:650px;">
                <h1><?php echo CHtml::link(Yii::t('app','Add New Course').' &amp; '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('courses/create')) ?></h1>
			</div>
            
       
    </div>
    
    </div>
    
    
    </td>
    </tr>
</table>

<?php } ?>
<script>
$(".add").click(function(e) {
    $('form#batches-form').remove();
});
</script>
<script>
$(".edit").click(function(e) {
    $('form#courses-form').remove();
});

$(".edit-subject").click(function(e) {
    $("form#subjects-common-pool-form").remove();
});
</script>