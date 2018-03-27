<style type="text/css">
.timetable{
	 border-collapse:collapse;	
}
.timetable td{
	padding:10px;
	border:1px solid #C5CED9 ;
	width:auto;
	font-size:10px;
	text-align:center;
}
hr{ 
	border-bottom:1px solid #C5CED9; 
	border-top:0px solid #fff;
}
.attnd-holiday{
	color: #8be14f;
	font-size: 13px;
	font-weight: 600;
	padding-top:7px;	
}
</style>
<?php
$settings     		= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
$date				= (isset($_REQUEST['date']) and $_REQUEST['date'] != NULL)?$_REQUEST['date']:date("Y-m-d");
$day 				= date('w', strtotime($date));
$week_start			= date('Y-m-d', strtotime('-'.$day.' days', strtotime($date)));
$week_end 			= date('Y-m-d', strtotime('+'.(6-$day).' days', strtotime($date)));
$prev_week_start	= date('Y-m-d', strtotime('-7 days', strtotime($week_start)));
$next_week_start	= date('Y-m-d', strtotime('+1 days', strtotime($week_end)));
$this_date			= $week_start;

$emp				= (isset($_REQUEST['emp']))?$_REQUEST['emp']:'';

$daterange = new DatePeriod(new DateTime($week_start), new DateInterval('P1D'), new DateTime($week_end));

foreach($daterange as $value){
    $date_arr[]	= $value->format("Y-m-d");
}
$date_arr[]	= $week_end;
$employee = Employees::model()->findByAttributes(array('id'=>$emp));
?>

<table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="first" width="100">
		   <?php 
           $filename	= Logo::model()->getLogo();
            if($filename!=NULL){                             
                echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
            }
            ?>
        </td>
        <td valign="middle" >
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="listbxtop_hdng first" style="text-align:left; font-size:22px; padding-left:10px;">
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
                        <?php echo Yii::t('app','Phone').': '.$college[2]->config_value; ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr />
<div align="center" style="display:block; text-align:center;"><h3><?php echo Yii::t('app','Subject Wise Attendance');?> - <?php echo ucfirst($employee->first_name).' '.ucfirst($employee->middle_name).' '.ucfirst($employee->last_name); ?></h3></div>
<?php
	$month1	=	date("M", strtotime($week_start));
	$month2	=	date("M", strtotime($week_end));
	$day1	=	date("d", strtotime($week_start));	
	$day2	=	date("d", strtotime($week_end));								
	
?>
<div align="center" style="display:block; text-align:center;"><h5><?php echo Yii::t("app",$month1).' '.$day1." - ".Yii::t("app",$month2).' '.$day2;;?></h5></div>
<?php
if(isset($_REQUEST['emp']) and $_REQUEST['emp'] != NULL){
	$criteria 				= new CDbCriteria;
	$criteria->condition 	= 'employee_id=:employee_id';
	$criteria->params		= array(':employee_id'=>$emp);
	$criteria->group		= 'weekday_id';	
	$criteria->order		= 'weekday_id ASC';
	$timetables				= TimetableEntries::model()->findAll($criteria);
	if($timetables){							
		$criteria 				= new CDbCriteria;		
		$criteria->join 		= 'LEFT JOIN timetable_entries t1 ON t1.class_timing_id = t.id';
		$criteria->group		= 't1.class_timing_id';
		$criteria->condition 	= 't1.employee_id=:employee_id';
		$criteria->params 		= array(':employee_id'=>$emp);
		$criteria->order  		= "STR_TO_DATE(t.start_time, '%h:%i %p')";
		$timings				= ClassTimings::model()->findAll($criteria);
		if($timings){
			$weekday_arr			= array();
			foreach($timetables as $timetable){
				if(!in_array($timetable->weekday_id, $weekday_arr)){
					$weekday_arr[]	= $timetable->weekday_id;
				}
			}	
			$weekday_text = array(1=>'SUN', 2=>'MON', 3=>'TUE', 4=>'WED', 5=>'THU', 6=>'FRI', 7=>'SAT');
?>
			<table  align="left" width="100%" id="table" cellspacing="0" cellpadding="0" class="timetable" >
                <tr style="background:#DCE6F1">
                    <td  style="background:#DCE6F1;">&nbsp;</td>
<?php   
						foreach($timings as $timing){                                                    
							if($settings != NULL){	
								//traslate AM and PM 	
								$t1 = date('h:i', strtotime($timing->start_time));	
								$t2 = date('A', strtotime($timing->start_time));
								
								$t3	= date('h:i', strtotime($timing->end_time));	
								$t4	= date('A', strtotime($timing->end_time));	
								//end 
								
								$time1	= date($settings->timeformat,strtotime($timing->start_time));
								$time2	= date($settings->timeformat,strtotime($timing->end_time));
							}
							echo '<td style="font-size:11px;background:#E1EAEF;word-break:break-all;">'.$t1.' '.Yii::t("app",$t2).' -<br> '.$t3.' '.Yii::t("app",$t4).'</td>';	                                                    
						}                                      
?>                    
                </tr>
<?php
				 foreach($weekday_arr as $weekday){	
				 	$week_date	= $date_arr[$weekday - 1];	
?>	
					<tr>
                        <td>
                            <h3><?php echo Yii::t('app',$weekday_text[$weekday]);?></h3>
                            <p><?php echo date($settings->displaydate, strtotime($week_date)) ?></p>
                        </td>
<?php
						for($i=0; $i < count($timings); $i++){ 
							$set =  TimetableEntries::model()->findByAttributes(array('employee_id'=>$emp,'weekday_id'=>$weekday,'class_timing_id'=>$timings[$i]['id']));
?>
							<td class="td"> 
<?php
								if($set != NULL){
									$subjectwise 	=  TeacherSubjectwiseAttentance::model()->findByAttributes(array('employee_id'=>$emp, 'timetable_id'=>$set->id, 'weekday_id'=>$set->weekday_id, 'date'=>$week_date));
									$batch			= Batches::model()->findByPk($set->batch_id);
									$is_holiday		= StudentAttentance::model()->isHoliday($week_date);
									if($is_holiday == NULL){
										if($subjectwise == NULL){																	
											if($employee->joining_date <= $week_date and $week_date <= date("Y-m-d")){
												echo '<span style="color:#070;">'.Yii::t('app','Present').'</span>';
												echo '<br>';
											}																	
										}
										else{
											$leave   = LeaveTypes::model()->findByAttributes(array('id'=>$subjectwise->leavetype_id));
											echo '<span style="color:#F00;">'.Yii::t('app','Absent').' ('.$leave->type.')</span>';
											echo '<br>';
										}
									}
									else{
											echo '<span  class="attnd-holiday">'.Yii::t('app','Holiday').'</span>';
									}
	?>
									<div  onclick="" style="position: relative; ">
                                        <div class="timtable-subjct-blk">
                                            <div class="subject">	
<?php                                                                            
                                                if($set->is_elective == 0){
                                                    $time_sub 	= Subjects::model()->findByAttributes(array('id'=>$set->subject_id));
                                                    if($time_sub!=NULL){
                                                        echo ucfirst($time_sub->name);
                                                    }
                                                }
                                                else{
                                                    $elec_sub 	= Electives::model()->findByAttributes(array('id'=>$set->subject_id));
                                                    $electname 	= ElectiveGroups::model()->findByAttributes(array('id'=>$elec_sub->elective_group_id,'batch_id'=>$elec_sub->batch_id));	
                                                    if($electname!=NULL){
                                                        echo ucfirst($electname->name);
                                                    }
                                                }	
?>                                                                                																																					                                                           	
                                            </div>
                                            <div class="batch_name"><?php echo ucfirst($batch->name); ?></div>                                                                        
                                        </div>
                                    </div>
<?php									 
									 
								}
?>                            	
                            </td>
<?php							
						}
?>                        
                    </tr>				
<?php					 
				 }
?>                
            </table>
<?php			
		}
		else{
			echo '<div class="not-foundarea">';
			echo Yii::t('app', 'No Class Timings');
			echo '</div>';
		}							
	}
	else{
		echo '<div class="not-foundarea">';
		echo Yii::t('app', 'Timetable Not Assigned');
		echo '</div>';
	}	
}
?>