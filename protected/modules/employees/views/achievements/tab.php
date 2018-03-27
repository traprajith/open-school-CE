<style>
.emp_tab_nav li a{
	padding: 8px 12px 0px 12px;
}
</style>
<ul style="width:698px;">
    <li>
		<?php 
		if(Yii::app()->controller->action->id=='view')
			echo CHtml::link(Yii::t('app','Profile'), array('/employees/employees/view', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
		else
			echo CHtml::link(Yii::t('app','Profile'), array('/employees/employees/view', 'id'=>$_REQUEST['employee_id']),array('class'=>''));
		?>
    </li>            
     <li> 
        <?php    
	          if(Yii::app()->controller->action->id=='achievements' or (Yii::app()->controller->id=='achievements' and Yii::app()->controller->action->id=='update'))
	          {
		      	echo CHtml::link(Yii::t('app','Achievements'), array('/employees/employees/achievements', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
			  }
			  else
			  {
	          	echo CHtml::link(Yii::t('app','Achievements'), array('/employees/employees/achievements', 'id'=>$_REQUEST['employee_id']));
			  }
	    ?>
		</li>
     <li>
     <li>
		<?php 
		if(Yii::app()->controller->action->id=='log')
			echo CHtml::link(Yii::t('app','Log'), array('/employees/employees/log', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
		else
			echo CHtml::link(Yii::t('app','Log'), array('/employees/employees/log', 'id'=>$_REQUEST['employee_id']),array('class'=>''));
		?>
    </li>
     <li>
		<?php 
		if(Yii::app()->controller->id=='employeeDocument' or Yii::app()->controller->action->id == 'document')
			echo CHtml::link(Yii::t('app','Documents'), array('/employees/employees/document', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
		else
			echo CHtml::link(Yii::t('app','Documents'), array('/employees/employees/document', 'id'=>$_REQUEST['employee_id']),array('class'=>''));
		?>
    </li>
    <li>
		<?php 
		if(Yii::app()->controller->id=='employees' && Yii::app()->controller->action->id == 'attendance')
			echo CHtml::link(Yii::t('app','Attendance'), array('/employees/employees/attendance', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
		else
			echo CHtml::link(Yii::t('app','Attendance'), array('/employees/employees/attendance', 'id'=>$_REQUEST['employee_id']),array('class'=>''));
		?>
    </li>
    <li>
		<?php 
		if(Yii::app()->controller->id=='employees' && Yii::app()->controller->action->id=='subjectasso')
			echo CHtml::link(Yii::t('app','Subject Association'), array('/employees/employees/subjectasso', 'id'=>$_REQUEST['employee_id']),array('class'=>'active'));
		else
			echo CHtml::link(Yii::t('app','Subject Association'), array('/employees/employees/subjectasso', 'id'=>$_REQUEST['employee_id']),array('class'=>''));
		?>
    </li>
</ul>