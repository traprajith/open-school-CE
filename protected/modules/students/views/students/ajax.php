<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.smallipop.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate.min.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.smallipop.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modernizr.js"></script>
<?php
$find = StudentAttentance::model()->findAll("date=:x AND student_id=:y", array(':x'=>$year.'-'.$month.'-'.$day,':y'=>$emp_id));
$today_day = date('d');
$today_month = date('n');
$today_year = date('Y');
$cell_date = date('Y-m-d',strtotime($year.'-'.$month.'-'.$day));

$today_date = date('Y-m-d');
if($cell_date <= $today_date and in_array($cell_date,$days) and !in_array($cell_date,$holiday_arr))
{
	
	$span = '<i class="fa fa-check" style="color:#090"></i>';
}
else
{
	$span = '';
}


$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
if(Yii::app()->user->year)
{
	$ac_year = Yii::app()->user->year;
}
else
{
	$ac_year = $current_academic_yr->config_value;
}
$is_insert = PreviousYearSettings::model()->findByAttributes(array('id'=>2));
$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));

if(count($find)==0)
{
	if($cell_date > $today_date and !array_key_exists($cell_date, $holiday_arr))
	{
		?>
        <span style="display:block; width:100%; height:40px; background:#F2F2F2"></span>
   		 <?php
	}
	else if(array_key_exists($cell_date, $holiday_arr))
	{
		$holiday_now = Holidays::model()->findByAttributes(array('id'=>$holiday_arr[$cell_date]));
		
	
	 ?>
			<span style="display:block; width:100%; height:40px; background:#D63535" class="holidays" title="<?php echo $holiday_now->title; ?>"></span>
		<?php

	}
	else if(in_array($cell_date,$days) and !array_key_exists($cell_date, $holiday_arr))
	{
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
		{
			echo CHtml::ajaxLink($span,$this->createUrl('StudentAttentance/addnew'),array(
				'type' =>'GET','data'=>array('day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
				'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',				
				'update'=>'#jobDialog123'.$day.$emp_id,				
				),array('id'=>'showJobDialog'.$day.'_'.$emp_id,'class'=>'at_abs'));
				//echo '<div id="jobDialog'.$day.$emp_id.'"></div>';
		}
		else
		{
		?>
		 <span onclick="alert('<?php echo Yii::t('app','Enable Insert Option in Previous Academic Year Settings!'); ?>');" style="display:block;">&nbsp;</span>
		<?php
		}
	}
	else
	{
	?>
        <span style="display:block; width:100%; height:40px; background:#F2F2F2"></span>
    <?php
	}
}
else
{
	$student_attentance=StudentAttentance::model()->findByAttributes(array('id'=>$find[0]['id']));
	$leave_types=StudentLeaveTypes::model()->findByAttributes(array('id'=>$student_attentance->leave_type_id));
	if($leave_types)
	{
	  $span = '<span class="abs1" style="color:'.$leave_types->colour_code.';text-align:center;padding-top:2px">'.$leave_types->label.'</span>';
	}
	else
	$span = '<span class="abs"></span>';
   #Column with leave marked
       echo CHtml::ajaxLink($span,$this->createUrl('StudentAttentance/EditLeave'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialogupdate'.$day.$emp_id,'type' =>'GET','data'=>array('id'=>$find[0]['id'],'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
		
        ),array('id'=>'showJobDialog'.$day.'_'.$emp_id,'title'=>Yii::t('app','Reason:').$find['0']['reason']));

}
?>
<script>
$(".at_abs").click(function(e) {
    $('form#student-attentance-form').remove();
});
</script>