<?php
$this->breadcrumbs=array(
	Yii::t('app','Student Attentances')=>array('/courses'),
	Yii::t('app','Attendance'),
);
?>
<style>

table.attendance_table{ border-collapse:collapse;}

.attendance_table{
	margin:30px 0px;
	font-size:9px;
}
.attendance_table td{
	padding:5px 6px;
	border:1px  solid #CCC;
	
}
</style>
<div class="atnd_Con">
<?php //$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
    
<?php
function getweek($date,$month,$year)
{
$date = mktime(0, 0, 0,$month,$date,$year); 
$week = date('w', $date); 
switch($week) {
case 0: 
return 'S<br>';
break;
case 1: 
return 'M<br>';
break;
case 2: 
return 'T<br>';
break;
case 3: 
return 'W<br>';
break;
case 4: 
return 'T<br>';
break;
case 5: 
return 'F<br>';
break;
case 6: 
return 'S<br>';
break;
}
}
?>
<?php
//$subjects=Subjects::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));

//echo CHtml::dropDownList('batch_id','',CHtml::listData(Subjects::model()->findAll("batch_id=:x",array(':x'=>$_REQUEST['id'])), 'id', 'name'), array('empty'=>Yii::t('app','Select Type')));

  if(isset($_REQUEST['id']))
  {

	if(!isset($_REQUEST['mon']))
	{
		$mon = date('F');
		$mon_num = date('n');
	}
	else
	{
		$mon = EmployeeAttendances::model()->getMonthname($_REQUEST['mon']);
		$mon_num = $_REQUEST['mon'];
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, $_REQUEST['year']); // 31
	?>
    <!-- Header -->
    <div style=" width:700px; padding-bottom:20px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first" width="100">
                           <?php $logo=Logo::model()->findAll();?>
                            <?php
                            if($logo!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" height="100" />';
                            }
                            ?>
                </td>
                <td  valign="middle">
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
                                <?php echo Yii::t('app','Phone:').$college[2]->config_value; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
		 <hr />
    </div>
    <!-- End Header -->
  
    <div align="center" style="display:block; text-align:center;"><?php echo Yii::t('app','TEACHER ATTENDANCE'); ?></div><br />
    <!-- Department details -->
    <div style="border:#CCC 1px; width:700px; padding:10px 10px; background:#E1EAEF;">
        <table style="font-size:14px;" border="0" cellspacing="0" cellpadding="0">
            <?php 
				$department = EmployeeDepartments::model()->findByAttributes(array('id'=>$_REQUEST['id']));
            ?>
            <tr>
                <td style="width:100px;"><?php echo Yii::t('app','Department'); ?></td>
                <td style="width:10px;">:</td>
                <td style="width:250px;"><?php echo $department->name; ?></td>
            
                <td><?php echo Yii::t('app','Month'); ?></td>
                <td style="width:10px;">:</td>
                <td><?php echo $mon.' '.$_REQUEST['year']; ?></td>
            </tr>
            <tr>
            	<?php 
				$total_employees = Employees::model()->countByAttributes(array('employee_department_id'=>$_REQUEST['id'],'is_deleted'=>0));
				?>
                <td><?php echo Yii::t('app','Total Teachers'); ?></td>
                <td>:</td>
                <td colspan="4"><?php echo $total_employees; ?></td>
            </tr>
           
        </table>
    </div>
    <!-- END Department details -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="attendance_table">
<tr style="background:#dfdfdf;">
    <td><?php echo Yii::t('app','Name');?></td>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<td>'.getweek($i,$_REQUEST['mon'],$_REQUEST['year']).'<span>'.$i.'</span></td>';
    }
    ?>
</tr>
<?php //$posts=Students::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
	$posts=Employees::model()->findAll("employee_department_id=:x AND is_deleted=:y", array(':x'=>$_REQUEST['id'], ':y'=>0));
$j=0;

foreach($posts as $posts_1)
{
	/*************** Get Employee Start and End *****************/
	
	
	$emp_start = date('Y-m-d',strtotime($posts_1->joining_date));
	$emp_end = date('Y-m-d');
	/*echo $emp_start.'------'.$emp_end;*/
	$days = array();
	$emp_days = EmployeeAttendances::model()->createDateRangeArray($emp_start,$emp_end);
	
	$weekArray = array();
	
	$weekdays = Weekdays::model()->findAll("batch_id IS NULL AND weekday<>:y",array(':y'=>"0"));
	
	
	foreach($weekdays as $weekday)
	{
		$weekday->weekday = $weekday->weekday - 1;
		if($weekday->weekday <= 0)
		{
			$weekday->weekday = 7;
		}
		$weekArray[] = $weekday->weekday;
	}
	
	foreach($emp_days as $emp_day)
	{
		$week_number = date('N', strtotime($emp_day));
					
		//echo $day.'='.$week_number.'<br/>';
		if(in_array($week_number,$weekArray)) // If checking if it is a working day
		{
			array_push($days,$emp_day);
		}
	}
	
	/*************** END Get Employee Start and End *************/
	$holidays = Holidays::model()->findAll();
	$holiday_arr=array();
	foreach($holidays as $key=>$holiday)
	{
		if(date('Y-m-d',$holiday->start)!=date('Y-m-d',$holiday->end))
		{
			$date_range = StudentAttentance::model()->createDateRangeArray(date('Y-m-d',$holiday->start),date('Y-m-d',$holiday->end));
			foreach ($date_range as $value) {
    			$holiday_arr[$value] = $holiday->id;
			}
		}
		else
		{
			$holiday_arr[date('Y-m-d',$holiday->start)] = $holiday->id;
		}
	}
	if($j%2==0)
	$class = 'class="odd"';	
	else
	$class = 'class="even"';	
	
 ?>
<tr <?php echo $class; ?> >
    <td class="name"><?php echo Employees::model()->getTeachername($posts_1->id); ?></td>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<td>';
$find = EmployeeAttendances::model()->findAll("attendance_date=:x AND employee_id=:y", array(':x'=>$_REQUEST['year'].'-'.$mon_num.'-'.$i,':y'=>$posts_1->id));
$today_day = date('d');
$today_month = date('n');
$today_year = date('Y');
$cell_date = date('Y-m-d',strtotime($_REQUEST['year'].'-'.$mon_num.'-'.$i));
$today_date = date('Y-m-d');
if(array_key_exists($cell_date, $holiday_arr))
{
	$holiday_1++;
	$cell = "<span><img src='images/abs_holly_small.png'/></span>";
}
else if($cell_date < $today_date and in_array($cell_date,$days))
{
	$cell = "<span><img src='images/tick_new.png' width='10' height='10' /></span>";
}
else{
	$cell ="";
}
if(count($find)==0)
{
echo $cell;
}
else{
	if($find[0]['half']==1){
		echo "<span><img src='images/morning_half.png'/></span>";
	}
	else if($find[0]['half']==2){
		echo "<span><img src='images/afternoon_half.png'/></span>";
	}
	else{
		echo "<span style='color:#ce0606'><strong>X</strong></span>";
	}
}
		echo '</td>';
    }
    ?>
</tr>
<?php $j++; }?>
</table>
<?php } ?>
</div>