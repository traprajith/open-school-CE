<?php
//$find = PeriodEntries::model()->findAll("date=:x AND student_id=:y", array(':x'=>'2012-'.$month.'-'.$day,':y'=>$emp_id));
//if(count($find)==0)
{
	echo $period;
echo CHtml::ajaxLink(Yii::t('job','ll'),$this->createUrl('Attendances/addnew'),array(
        'onclick'=>'$("#jobDialog'.$day.$emp_id.'").dialog("open"); return false;',
        'update'=>'#jobDialog123'.$day.$emp_id,'type' =>'GET','data'=>array('day'=>$day,'month'=>$month,'year'=>'2012','emp_id'=>$emp_id,'period'=>$period),
        ),array('id'=>'showJobDialog'.$day.$emp_id,'class'=>'at_abs'));
		//echo '<div id="jobDialog'.$day.$emp_id.'"></div>';
}
//else
//echo "<span class='abs'></span>";
		

?>