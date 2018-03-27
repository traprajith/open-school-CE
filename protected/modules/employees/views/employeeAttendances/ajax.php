
<?php
$find = EmployeeAttendances::model()->findAll("attendance_date=:x AND employee_id=:y", array(':x'=>$year.'-'.$month.'-'.$day,':y'=>$emp_id));


$today_day = date('d');
$today_month = date('n');
$today_year = date('Y');
$cell_date = date('Y-m-d',strtotime($year.'-'.$month.'-'.$day));
$today_date = date('Y-m-d');


if($cell_date < $today_date and in_array($cell_date,$days))
{
	$span = '<span class="tick"></span>';
}
else
{
	$span = 'll';
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
	
	/*
		Column with no leave marked
	*/
	if(array_key_exists($cell_date, $holiday_arr['id']))
	{
		
		
		
		
	?>
        <span style="display:block; width:100%; height:40px; background:#D63535" class="holidays" title="<?php echo $holiday_arr['title'][$cell_date]; ?>"></span>
    <?php
	}
	else if(in_array($cell_date,$days) and !array_key_exists($cell_date, $holiday_arr['id']))
	{
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
		{
		echo CHtml::ajaxLink('<span class="tick"></span>',$this->createUrl('employeeAttendances/Addnew'),array(
			'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
			'update'=>'#jobDialog123'.$day.$emp_id,'type' =>'GET','data'=>array('day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
			),array('id'=>'showJobDialog'.$day.$emp_id,'class'=>'at_abs','title'=>Yii::t('app','Add leave')));
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
        <div style="display:block; width:100%; height:40px; background:#F2F2F2; "></div>
    <?php
	}
}
else{
	if($find[0]['half'] == 1)
	{
		$span = 'morning_halfday';
	}
	else if($find[0]['half'] == 2){
		$span = 'afternoon_halfday';
	}
	else
	{
		$span = 'abs';
	}
	
	/*
		Column with leave marked
	*/

    echo CHtml::ajaxLink('<span class="'.$span.'"></span>',$this->createUrl('employeeAttendances/EditLeave'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialogupdate'.$day.$emp_id,'type' =>'GET','data'=>array('id'=>$find[0]['id'],'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
        ),array('id'=>'showJobDialog'.$day.$emp_id,'title'=>Yii::t('app','Reason:').$find['0']['reason']));

}
?>
<script>
$('.at_abs').click(function(e) {
    $('form#employee-attendances-form').remove();
});
</script>