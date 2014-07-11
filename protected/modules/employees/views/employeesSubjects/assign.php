<?php

		$data=EmployeesSubjects::model()->findAll(array('condition'=>'subject_id=:id', 
                  'params'=>array(':id'=>(int) $subject_id)));
 
         if($data!=NULL)
		 {
		  foreach($data as $value)
		  {
			  echo Employees::model()->findByPk($value->employee_id)->first_name;
			  echo CHtml::link(Yii::t('employees','delete'),array('EmployeesSubjects/remove','subject_id'=>$subject_id,'employee_id'=>$value->employee_id));
		  
		  }
		  
		 }
		 
?>