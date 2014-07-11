
<?php
$find = EmployeeAttendances::model()->findAll("attendance_date=:x AND employee_id=:y", array(':x'=>$year.'-'.$month.'-'.$day,':y'=>$emp_id));
if(count($find)==0)
{
	
	/*
		Column with no leave marked
	*/
echo CHtml::ajaxLink(Yii::t('job','ll'),$this->createUrl('employeeAttendances/Addnew'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialog123'.$day.$emp_id,'type' =>'GET','data'=>array('day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
        ),array('id'=>'showJobDialog'.$day.$emp_id,'class'=>'at_abs','title'=>'Add leave'));
		//echo '<div id="jobDialog'.$day.$emp_id.'"></div>';
}
else{
	/*
		Column with leave marked
	*/

    echo CHtml::ajaxLink(Yii::t('job','<span class="abs"></span>'),$this->createUrl('employeeAttendances/EditLeave'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialogupdate'.$day.$emp_id,'type' =>'GET','data'=>array('id'=>$find[0]['id'],'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id),
        ),array('id'=>'showJobDialog'.$day.$emp_id,'title'=>'Reason: '.$find['0']['reason']));

}
?>
