<?php
$this->breadcrumbs=array(
	'Weekdays'=>array('index'),
	'Manage',
);
?>
<style>
#table{
	border-top:1px #CCC solid;
	/*margin:30px 30px;*/
	border-right:1px #CCC solid;
}
.timetable td{
	border-left:1px #CCC solid;
	padding:10px 10px 10px 10px;
	border-bottom:1px #CCC solid;
	width:auto;
	min-width:30px;
	font-size:11px;
	text-align:center;
}

</style>
<div class="atnd_Con" style="padding-left:20px; padding-top:30px;">
	<?php
	if(isset($_REQUEST['id']) and $_REQUEST['id']!=NULL)
	{
	?> 
        <!-- Header -->
        <div style="border-bottom:#666 1px; width:700px; padding-bottom:20px;">
            <table width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="first">
                               <?php $logo=Logo::model()->findAll();?>
                                <?php
                                if($logo!=NULL)
                                {
                                    //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                    echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" width="100%" />';
                                }
                                ?>
                    </td>
                    <td align="center" valign="middle" class="first" style="width:300px;">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="listbxtop_hdng first" style="text-align:left; font-size:22px; width:300px;  padding-left:10px;">
                                    <?php $college=Configurations::model()->findAll(); ?>
                                    <?php echo $college[0]->config_value; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                    <?php echo $college[1]->config_value; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                    <?php echo 'Phone: '.$college[2]->config_value; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- End Header --> 
        <br /><br />
    <span align="center"><h4>CLASS TIME TABLE</h4></span>
    <!-- Course details -->
    <div style="border:#CCC 1px; width:700px; padding:10px 10px; background:#E1EAEF;">
        <table style="font-size:14px;">
            <?php $batch = Batches::model()->findByAttributes(array('id'=>$_REQUEST['id']));
                  $course_name = Courses::model()->findByAttributes(array('id'=>$batch->course_id));
				  $class_teacher = Employees::model()->findByAttributes(array('id'=>$batch->employee_id));
            ?>
            <tr>
                <td style="width:100px;"><b>Course</b></td>
                <td style="width:10px;">:</td>
                <td style="width:250px;"><?php echo $course_name->course_name; ?></td>
            
                <td><b>Batch</b></td>
                <td style="width:10px;">:</td>
                <td><?php echo $batch->name; ?></td>
            </tr>
            <tr>
                <td><b>Class Teacher</b></td>
                <td>:</td>
                <td>
					<?php 
					if($class_teacher!=NULL)
					{
						echo $class_teacher->first_name.' '.$class_teacher->last_name;
					}
					else
					{
						echo '-';
					}
					?>
				</td>
   				<?php
				$total_students = Students::model()->countByAttributes(array('batch_id'=>$_REQUEST['id'],'is_active'=>1,'is_deleted'=>0));
				?>
                <td><b>Total students</b></td>
                <td>:</td>
                <td><?php echo $total_students; ?></td>
            </tr>
           
        </table>
    </div>
    <!-- END Course details -->
     <?php    
	$times=Batches::model()->findAll("id=:x", array(':x'=>$_REQUEST['id']));
	$weekdays=Weekdays::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
	if(count($weekdays)==0)
		$weekdays=Weekdays::model()->findAll("batch_id IS NULL");
	?>
    <br /><br />
    <?php   
		$timing = ClassTimings::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
		$count_timing = count($timing);
		if($timing!=NULL)
		{
	?>

		<div style="font-size:11px;">
		<table  align="left" width="100%" id="table" cellspacing="0" cellpadding="0" class="timetable" >
			<tr>
			  <td width="10px" style="background:#E1EAEF;">&nbsp;</td>
			  <?php 
					foreach($timing as $timing_1)
					{
						//echo $timing_1->start_time.'<br>';  ?>
					<?php echo '<td style="font-size:11px;background:#E1EAEF;">'.$timing_1->start_time .' - '.$timing_1->end_time.'</td>';?>
				<?php 	}
			   ?>
			</tr> <!-- timetable_tr -->
			
			<?php if($weekdays[0]['weekday']!=0)
			{ ?>
			<tr>
				<td><?php echo 	Yii::t('timetable','SUN') ;?></td>
		 
				 <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						  ?>
						<td class="td">
							<?php
		$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[0]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{		
							$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
							if($is_break!=NULL)
							{	
								echo Yii::t('timetable','Break');	
							}	
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
				 ?>
							
						  </td>
					<?php  }
					  ?>
				 </tr>
			  <?php }  ?>
			  <?php   if($weekdays[1]['weekday']!=0)
			  { ?>
			  <tr>
				<td><?php echo 	Yii::t('timetable','MON') ;?></td>
			  
					 <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?> <td>
					   <?php 
								
				$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[1]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
								$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
								if($is_break!=NULL)
								{	
									echo Yii::t('timetable','Break');	
								}	
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
						?> </td>
						<?php  
					 }
					?>
				  <!--timetable_td -->
				
			  </tr><!--timetable_tr -->
			  <?php } ?>
			 <?php  if($weekdays[2]['weekday']!=0)
			  {
			  ?>
				  <tr>
				<td ><?php echo 	Yii::t('timetable','TUE') ;?></td>
			  
				 <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?> <td>
					<?php		
						$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[2]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
							$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
							if($is_break!=NULL)
							{	
								echo Yii::t('timetable','Break');	
							}	
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
							?>
							  </td> 
					<?php  }
					?><!--timetable_td -->
				
			  </tr><!--timetable_tr -->
			  <?php } ?>
			  <?php
			  if($weekdays[3]['weekday']!=0)
			  { ?>
				  <tr>
				<td><?php echo 	Yii::t('timetable','WED') ;?></td>
			 
				 <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?> <td >
								<?php 
									$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[3]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
								$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
								if($is_break!=NULL)
								{	
									echo Yii::t('timetable','Break');	
								}							
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
								?>
							  </td>
					 <?php           
					 }
					?><!--timetable_td -->
				
			  </tr><!--timetable_tr -->
			  <?php }
			  ?>
			  <?php
			  if($weekdays[4]['weekday']!=0)
			  {  ?>
				  <tr>
				<td><?php echo 	Yii::t('timetable','THU') ;?></td>
			 
				  <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?><td>
					   <?php  
						$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[4]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
								$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
								if($is_break!=NULL)
								{	
									echo Yii::t('timetable','Break');	
								}	
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
						?>
							  </td>  
					 <?php
					 }
					?><!--timetable_td -->
				
			  </tr><!--timetable_tr -->
			  <?php } ?>
			  <?php
			  if($weekdays[5]['weekday']!=0)
			  { ?>
			  
				  <tr>
				<td><?php echo 	Yii::t('timetable','FRI') ;?></td>
			   
				 <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?><td>
						<?php		
						$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[5]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
							$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
							if($is_break!=NULL)
							{	
								echo Yii::t('timetable','Break');	
							}	
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
						 ?>
							  </td>
					  <?php        
					 }
					?><!--timetable_td -->
				
			  </tr><!--timetable_tr -->
			  <?php }  ?>
			  <?php
			  if($weekdays[6]['weekday']!=0)
			  { ?>
			  <tr>
				<td><?php echo 	Yii::t('timetable','SAT') ;?></td>
				
				  <?php
					  for($i=0;$i<$count_timing;$i++)
					  {
						?><td class="td">
						<?php	
									$set =  TimetableEntries::model()->findByAttributes(array('batch_id'=>$_REQUEST['id'],'weekday_id'=>$weekdays[6]['weekday'],'class_timing_id'=>$timing[$i]['id'])); 			
						if(count($set)==0)
						{	
							$is_break = ClassTimings::model()->findByAttributes(array('id'=>$timing[$i]['id'],'is_break'=>1));
							if($is_break!=NULL)
							{	
								echo Yii::t('timetable','Break');	
							}
						}
						else
						{
							$time_sub = Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
							if($time_sub!=NULL){echo $time_sub->name.'<br>';
								$time_emp = Employees::model()->findByAttributes(array('id'=>$set->employee_id));
								if($time_emp!=NULL){echo '(' .$time_emp->first_name.' '.$time_emp->last_name.')';}
							}
						}
						 ?>
							  </td>
				   <?php            
					 }
					?><!--timetable_td -->
				
			  </tr>
			<?php } ?>
		  </table>
		</div>
	<?php
	 }
     else
	 {
	?>
		
   <div style="border:#CCC 1px; width:700px; padding:10px 10px; background:#E1EAEF;">
        <?php echo Yii::t('timetable','<i>No Class Timings is set for this batch</i>'); ?>
   </div>      
    	
	<?php
	 }
	 ?>
     
       <?php /*?><?php
		$batch = Weekdays::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
		if(count($batch)==0)
		$batch = Weekdays::model()->findAll("batch_id IS NULL");
		?><?php */?>
        
        <?php
		
	}
	?>
 
	</div>