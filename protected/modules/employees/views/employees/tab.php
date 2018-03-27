
<div class="pagetab-bg-tag-a">
<ul>

		<?php 
		if(Yii::app()->controller->action->id=='view')
			echo '<li class="active">'.CHtml::link(Yii::t('app','Profile'), array('/employees/employees/view', 'id'=>$_REQUEST['id'])).'</li>';
		else
			echo '<li>'.CHtml::link(Yii::t('app','Profile'), array('/employees/employees/view', 'id'=>$_REQUEST['id']),array('class'=>'')).'</li>';
		?>
       
    <?php $model = Configurations::model()->findByAttributes(array('id'=>38));
		if($model->config_value == 1)
		{ ?>

        <?php    
	          if(Yii::app()->controller->action->id=='achievements' or (Yii::app()->controller->id=='achievements' and Yii::app()->controller->action->id=='update'))
	          {
		      	echo '<li class="active">'.CHtml::link(Yii::t('app','Achievements'), array('/employees/employees/achievements', 'id'=>$_REQUEST['id'])).'</li>';
			  }
			  else
			  {
	          	echo '<li>'.CHtml::link(Yii::t('app','Achievements'), array('/employees/employees/achievements', 'id'=>$_REQUEST['id'])).'</li>';
			  }
	    ?>
   <?php } ?>



		<?php 
		if(Yii::app()->controller->action->id=='log')
			echo '<li class="active">'.CHtml::link(Yii::t('app','Log'), array('/employees/employees/log', 'id'=>$_REQUEST['id'])).'</li>';
		else
			echo '<li>'.CHtml::link(Yii::t('app','Log'), array('/employees/employees/log', 'id'=>$_REQUEST['id']),array('class'=>'')).'</li>';
		?>

		<?php 
		if(Yii::app()->controller->id=='employeeDocument' or Yii::app()->controller->action->id == 'document')
			echo '<li class="active">'.CHtml::link(Yii::t('app','Documents'), array('/employees/employees/document', 'id'=>$_REQUEST['id'])).'</li>';
		else
			echo '<li>'.CHtml::link(Yii::t('app','Documents'), array('/employees/employees/document', 'id'=>$_REQUEST['id']),array('class'=>'')).'</li>';
		?>

		<?php 
		if((Yii::app()->controller->id=='employees' && Yii::app()->controller->action->id == 'attendance') or (Yii::app()->controller->id=='teacherSubjectAttendance' && Yii::app()->controller->action->id == 'index'))
			echo '<li class="active">'.CHtml::link(Yii::t('app','Attendance'), array('/employees/employees/attendance', 'id'=>$_REQUEST['id'])).'</li>';
		else
			echo '<li>'.CHtml::link(Yii::t('app','Attendance'), array('/employees/employees/attendance', 'id'=>$_REQUEST['id']),array('class'=>'')).'</li>';
		?>

		<?php 
		if(Yii::app()->controller->id=='employees' && Yii::app()->controller->action->id=='subjectasso')
			echo '<li class="active">'.CHtml::link(Yii::t('app','Subject Association'), array('/employees/employees/subjectasso', 'id'=>$_REQUEST['id'])).'</li>';
		else
			echo '<li>'.CHtml::link(Yii::t('app','Subject Association'), array('/employees/employees/subjectasso', 'id'=>$_REQUEST['id']),array('class'=>'')).'</li>';
		?>

</ul>
</div>