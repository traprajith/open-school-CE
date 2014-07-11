<?php
$this->breadcrumbs=array(
	'Student Attentances'=>array('/courses'),
	'Attendance',
);
?>
<style>
.attendance_table{
	border-top:1px #CCC solid;
	margin:30px 0px;
	font-size:9px;
	border-right:1px #CCC solid;
}
.attendance_table td{
	border-left:1px #CCC solid;
	padding:5px 6px;
	border-bottom:1px #CCC solid;
	
}
</style>
<div class="atnd_Con"  style="padding-left:20px; padding-top:30px;">
<?php 
      $student=Students::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
      $batch=Batches::model()->findByAttributes(array('id'=>$student->batch_id)); 
      $course_id=$batch->course_id;
      $course=Courses::model()->findByAttributes(array('id'=>$course_id));?>
    
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
$subjects=Subjects::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));

//echo CHtml::dropDownList('batch_id','',CHtml::listData(Subjects::model()->findAll("batch_id=:x",array(':x'=>$_REQUEST['id'])), 'id', 'name'), array('empty'=>'Select Type'));

$model = new EmployeeAttendances;
  if(isset($_REQUEST['id']))
  {

	if(!isset($_REQUEST['mon']))
	{
		$mon = date('F');
		$mon_num = date('n');
		$curr_year = date('Y');
	}
	else
	{
		$mon = $model->getMonthname($_REQUEST['mon']);
		$mon_num = $_REQUEST['mon'];
		$curr_year = date('Y');
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, $curr_year); // 31
	?>
  
    <?php $logo=Logo::model()->findAll();?>
                <?php
                if($logo!=NULL)
				{
					//Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
					echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" width="100%" />';
				}
                ?>
  
 <?php $college=Configurations::model()->findByPk(1); ?>
 <span style="font-size:20px;">
 <?php echo $college->config_value ; ?>
 </span>
 <br/>
 <br/>
 <?php echo 'Batch : '. $name = $batch->name;?><br/>
 <?php echo 'Course : '. $coursename = $course->course_name ;?>
 <table width="100%" cellspacing="0" cellpadding="0" class="attendance_table">
<tr style="background:#dfdfdf;">
    <td><?php echo Yii::t('attendance','Name');?></td>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<td>'.getweek($i,$mon_num,$curr_year).'<span>'.$i.'</span></td>';
    }
    ?>
</tr>
<?php $posts=Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));

	$class = 'class="even"';	
	
 ?>
<tr <?php echo $class; ?> >
    <td class="name"><?php echo $posts->first_name; ?></td>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<td>';
/*$find = StudentAttentance::model()->findAll("date=:x AND student_id=:y", array(':x'=>$curr_year.$mon_num.'-'.$i,':y'=>$posts->id));*/
$find = StudentAttentance::model()->findAll("date=:x AND student_id=:y", array(':x'=>$_REQUEST['year'].'-'.$mon_num.'-'.$i,':y'=>$posts->id));

if(count($find)==0)
{
echo '';
}
else
echo "<span style='color:#ce0606'><strong>X</strong></span>";
		
		echo '</td>';
    }
    ?>
</tr>
</table>
<?php } ?>
</div>