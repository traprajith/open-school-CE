<script>
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

function rowdelete(id)
{
	 $("#batchrow"+id).fadeOut("slow");
}

</script>

<!--<script type="text/javascript">
	$(document).ready(function() {
		$('#search_fld').focus(function(){
			$(this).val('');
		});
	});
</script>-->

<?php 
$academic_yrs = AcademicYears::model()->findAll();
$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
if(Yii::app()->user->year)
{
	$year = Yii::app()->user->year;
}
else
{
	$year = $current_academic_yr->config_value;
}
$posts=Courses::model()->findAll("is_deleted =:x AND academic_yr_id =:y", array(':x'=>0,':y'=>$year));
?>
<div class="">
    
    
    
    <?php 
	if($posts!=NULL)
    {
	?>
        <div >
            <div class="clear"></div>
            <br />
            <?php 
            //$posts=Courses::model()->findAll("is_deleted =:x", array(':x'=>0));            
            ?>
            <div class="mcb_Con" style="width:510px;">            
            <?php 
			foreach($posts as $posts_1)
            {
				$semester_enabled	= Configurations::model()->isSemesterEnabledForCourse($posts_1->id);
				if($semester_enabled){	//enabled
					$semester_ids	= array();
					
					$criteria	= new CDbCriteria;
					$criteria->join			= 'JOIN `semester_courses` `sc` ON `t`.`id`=`sc`.`semester_id`';
					$criteria->condition	= '`sc`.`course_id`=:course_id';
					$criteria->params		= array(':course_id'=>$posts_1->id);
					$semesters 		= Semester::model()->findAll($criteria);
				?>
                	<div class="mcbrow" id="jobDialog1" style="width:510px;">
                        <ul  class="posctn-ul2">
                            <li class="gtcol2" onclick="details('<?php echo $posts_1->id;?>');" style="cursor:pointer;">
                                <p><?php echo $posts_1->course_name; ?></p>
                                <span><?php echo count($semesters).' - '.Yii::t('app', 'Semester(s)'); ?></span>
                            </li>
                            </ul>
                            <ul class="posctn-ul1">
                            <li class="popup-right-arow">
                                <a href="#" id="openbutton<?php echo $posts_1->id;?>" onclick="details('<?php echo $posts_1->id;?>');" class="open"></a>
                            </li>
                            </ul>
                        <div class="clear"></div>
                    </div>
                    <!-- semesters and batches-->
                    
                    <div id="dropwin<?php echo $posts_1->id;?>" style="display:none; padding:10px; border:1px solid #DDD; margin-bottom:10px;">
                      
                        <?php
                        if(count($semesters)==0){
                        echo '<div class="semester-block"><p class="no-semester">'.Yii::t('app', 'No semester found'). '</p></div>';
                        $batch = Batches::model()->findAll("course_id=:x AND is_deleted=:y AND is_active =:z", array(':x'=>$posts_1->id,':y'=>0,':z'=>1));
                        ?>
                      	
                      <div class="semester-block">
                        <h4><?php echo Yii::t('app', 'Batches');?></h4>
                        <div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="padding:0px 0px 10px 0px; ">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                 <tr class="pdtab-h">
                                    <td align="center"><?php echo Students::model()->getAttributeLabel('batch_id').' '.Yii::t('app','Name'); ?></td>
                                    <td align="center"><?php echo Yii::t('app','No.of Students'); ?></td>
                                    <td align="center"><?php echo Yii::t('app','Start Date'); ?></td>
                                    <td align="center"><?php echo Yii::t('app','End Date'); ?></td>                            
                                 </tr>
                                <?php
                                if(count($batch)>0){
                                foreach($batch as $batch_1)
                                {
                                echo '<tr id="batchrow'.$batch_1->id.'">';
                                if((isset($_REQUEST['widget']) and $_REQUEST['widget']!='sub_att') and isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)
                                {
                                echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array($_REQUEST['rurl'],'id'=>$batch_1->id)).'</td>';
                                
                                }else if((isset($_REQUEST['widget']) and $_REQUEST['widget']=='sub_att') and (isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)){ 
                                echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('/attendance/subjectAttendance/batchwise','id'=>$batch_1->id)).'</td>';
                                
                                }else{
                                
                                echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('courses/batches/batchstudents','id'=>$batch_1->id)).'</td>';									
                                }
                                //no of students
                                $posts=Yii::app()->getModule('students')->studentsOfBatch($batch_1->id);
                                echo '<td align="center">'.count($posts).'</td>';
                                echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->start_date)).'</td>';
                                echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->end_date)).'</td>';
                                echo '</tr>';
                                
                                }
                                
                                }
                                else{
                                ?>
                               	 <tr><td colspan="5"><center><?php echo Yii::t('app','No Results');?></center></td></tr>
                                <?php
                                }
                                ?>
                                </tbody>	
                            </table>
                        </div>
                     </div>
                 
                            <?php
						}
						else{
							foreach($semesters as $semester){
								$semester_ids[]	= $semester->id;
							?>
								<div class="semester-block">
									<h4><?php echo $semester->name;?></h4>                                
									<div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="padding:0px 0px 10px 0px; ">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tbody>
												<tr class="pdtab-h">
													<td align="center"><?php echo Students::model()->getAttributeLabel('batch_id').' '.Yii::t('app','Name'); ?></td>
													<td align="center"><?php echo Yii::t('app','No.of Students'); ?></td>
													<td align="center"><?php echo Yii::t('app','Start Date'); ?></td>
													<td align="center"><?php echo Yii::t('app','End Date'); ?></td>                            
												</tr>
												<?php
												$criteria	= new CDbCriteria;
												$criteria->condition	= 'course_id=:x AND semester_id=:semester AND is_deleted=:y AND is_active =:z';
												$criteria->params		= array(':x'=>$posts_1->id, ':semester'=>$semester->id, ':y'=>0, ':z'=>1);
												$batches 				= Batches::model()->findAll($criteria);
												
												if(count($batches)==0){
													echo '<tr><td colspan="4" align="center">'.Yii::t('app', 'No batch found').'</td></tr>';
												}
												else{
													foreach($batches as $batch_1){
														echo '<tr id="batchrow'.$batch_1->id.'">';
														if((isset($_REQUEST['widget']) and $_REQUEST['widget']!='sub_att') and isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)
														{
															echo '<td style="padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array($_REQUEST['rurl'],'id'=>$batch_1->id)).'</td>';
														
														 }else if((isset($_REQUEST['widget']) and $_REQUEST['widget']=='sub_att') and (isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)){ 
															echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('/attendance/subjectAttendance/batchwise','id'=>$batch_1->id)).'</td>';
											   
														}else{
													  
															echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('courses/batches/batchstudents','id'=>$batch_1->id)).'</td>';									
														}
														//no of students
														$posts=Yii::app()->getModule('students')->studentsOfBatch($batch_1->id);
														echo '<td align="center">'.count($posts).'</td>';
														echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->start_date)).'</td>';
														echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->end_date)).'</td>';
														echo '</tr>';
													
													}
												}
												?>
											</tbody>
										</table>
									</div>
								</div>             
							<?php
							}
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
								<h4><?php echo Yii::t('app', 'Batches without semester');?></h4>                                
								<div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="padding:0px 0px 10px 0px; ">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr class="pdtab-h">
												<td align="center"><?php echo Students::model()->getAttributeLabel('batch_id').' '.Yii::t('app','Name'); ?></td>
												<td align="center"><?php echo Yii::t('app','No.of Students'); ?></td>
												<td align="center"><?php echo Yii::t('app','Start Date'); ?></td>
												<td align="center"><?php echo Yii::t('app','End Date'); ?></td>                            
											</tr>
											<?php
												foreach($batches as $batch_1){
													echo '<tr id="batchrow'.$batch_1->id.'">';
													if((isset($_REQUEST['widget']) and $_REQUEST['widget']!='sub_att') and isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)
													{
														echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array($_REQUEST['rurl'],'id'=>$batch_1->id)).'</td>';
													
													}else if((isset($_REQUEST['widget']) and $_REQUEST['widget']=='sub_att') and (isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)){ 
														echo '<td style="padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('/attendance/subjectAttendance/batchwise','id'=>$batch_1->id)).'</td>';
										   
													}else{
												  
														echo '<td style="padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('courses/batches/batchstudents','id'=>$batch_1->id)).'</td>';									
													}
													//no of students
													$posts=Yii::app()->getModule('students')->studentsOfBatch($batch_1->id);
													echo '<td align="center">'.count($posts).'</td>';
													echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->start_date)).'</td>';
													echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->end_date)).'</td>';
													echo '</tr>';                                            
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<!--Remaining batches-->
							<?php
							}
						}
						?>
                    </div>
                <?php
				}
				else{	// disabled
			?> 
				<?php
                //$course = Courses::model()->findByAttributes(array('id'=>$posts_1->id,'is_deleted'=>0));
                $batch = Batches::model()->findAll("course_id=:x AND is_deleted=:y AND is_active =:z", array(':x'=>$posts_1->id,':y'=>0,':z'=>1));
                ?>
                <div class="mcbrow" id="jobDialog1" style="width:510px;">
                    <ul class="posctn-ul2">
                        <li class="gtcol2" onclick="details('<?php echo $posts_1->id;?>');" style="cursor:pointer;">
							<p><?php echo $posts_1->course_name; ?></p>
                            <span><?php echo count($batch).' - '.Students::model()->getAttributeLabel('batch_id'); ?></span>
                        </li>
                            </ul>
                            <ul class="posctn-ul1">
                        <li class="popup-right-arow">
                        	<a href="#" id="openbutton<?php echo $posts_1->id;?>" onclick="details('<?php echo $posts_1->id;?>');" class="open"></a>
                        </li>
                        </ul>
                    <div class="clear"></div>
                </div> <!-- END div class="mcbrow" id="jobDialog1" -->
                <!-- Batch Details -->  
                
                
                <!--class="cbtablebx"-->
                <div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="display: none; padding:0px 0px 10px 0px; ">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr class="pdtab-h">
                                <td align="center"><?php echo Students::model()->getAttributeLabel('batch_id').' '.Yii::t('app','Name'); ?></td>
                                <td align="center"><?php echo Yii::t('app','No.of Students'); ?></td>
                                <td align="center"><?php echo Yii::t('app','Start Date'); ?></td>
                                <td align="center"><?php echo Yii::t('app','End Date'); ?></td>                            
                            </tr>
                            <?php
                            if(count($batch)>0){
								foreach($batch as $batch_1)
								{
									echo '<tr id="batchrow'.$batch_1->id.'">';
										if((isset($_REQUEST['widget']) and $_REQUEST['widget']!='sub_att') and isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)
										{
											echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array($_REQUEST['rurl'],'id'=>$batch_1->id)).'</td>';
										
										 }else if((isset($_REQUEST['widget']) and $_REQUEST['widget']=='sub_att') and (isset($_REQUEST['rurl']) and $_REQUEST['rurl']!=NULL)){ 
							   echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('/attendance/subjectAttendance/batchwise','id'=>$batch_1->id)).'</td>';
							   
								  }else{
									  
											echo '<td style=" padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('courses/batches/batchstudents','id'=>$batch_1->id)).'</td>';									
										}
										//no of students
										$posts=Yii::app()->getModule('students')->studentsOfBatch($batch_1->id);
										echo '<td align="center">'.count($posts).'</td>';
										echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->start_date)).'</td>';
										echo '<td align="center">'.date('d-M-Y',strtotime($batch_1->end_date)).'</td>';
									echo '</tr>';
								
								}
							}
							else{
							?>
                            	<tr><td colspan="5"><center><?php echo Yii::t('app','No Results');?></center></td></tr>
                            <?php
							}
                            ?>
                        </tbody>
                    </table>
                </div> <!-- END div class="pdtab_Con" -->
            <?php 
				}
			}
			?>        
            
            </div>
        </div>
    <?php 
	} // END if $posts!=NULL
    else
    { 
	?>
        <!--<link rel="stylesheet" type="text/css" href="/openschool/css/style.css" />-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="247" valign="top">
                	<?php //$this->renderPartial('left_side');?>            
                </td>
                <td valign="top">
                    <div style="padding:20px 20px">
                        <div class="yellow_bx" style="background-image:none;width:450px;padding-bottom:45px;">
                        	<div class="y_bx_head" style="width:450px;">
							<?php 
                            if(!$current_academic_yr->config_value or !$academic_yrs)
                            {
                           
                                echo Yii::t('app','It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:');
                           
                            }
                            else
                            {
								echo Yii::t('app','It appears that no courses or batches are created for current academic year.');
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
                                <h1><?php echo CHtml::link(Yii::t('app','Add New Course').' &amp; '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('courses/courses/create')); ?></h1>
                            </div>
                       
                        </div>
                    </div>        
                </td>
            </tr>
        </table>
    
    <?php 
	}
	?>

</div> <!-- END div class="panel-wrapper" -->