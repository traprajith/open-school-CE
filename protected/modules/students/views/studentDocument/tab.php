<style>
.emp_tab_nav li a{
	padding: 8px 8px 0px 8px;
}
</style>


<div class="emp_tab_nav">
    <ul style="width:730px;">
          <li> 
		
        <?php     
	          if(Yii::app()->controller->action->id=='view')
	          {
		      echo CHtml::link(Yii::t('app','Profile'), array('students/view', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Profile'), array('students/view', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        
        <li> 
		
        <?php     
	          if(Yii::app()->controller->action->id=='courses')
	          {
		      echo CHtml::link(Yii::t('app','Courses'), array('/students/students/courses', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Courses'), array('/students/students/courses', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        
        
        
        <li> 
		
        <?php     
	          if(Yii::app()->controller->action->id=='assesments')
	          {
		      echo CHtml::link(Yii::t('app','Assessments'), array('students/assesments', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Assessments'), array('students/assesments', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        
        <li> 
		
        <?php
		$model = AttendanceSettings::model()->findByAttributes(array('config_key'=>'type'));
		if($model->config_value == 1){     
	          if(Yii::app()->controller->action->id=='attentance')
	          {
		      echo CHtml::link(Yii::t('app','Attendance'), array('/students/students/attentance', 'id'=>$_REQUEST['student_id']),array('class'=>'active'));
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Attendance'), array('/students/students/attentance', 'id'=>$_REQUEST['student_id']));
			  }
		}else{
			  if(Yii::app()->controller->id=='subjectAttendance')
			  {
			  echo CHtml::link(Yii::t('app','Attendance'), array('/attendance/subjectAttendance/individual', 'id'=>$_REQUEST['student_id']),array('class'=>'active'));
			  }
			  else
			  {
			  echo CHtml::link(Yii::t('app','Attendance'), array('/attendance/subjectAttendance/individual', 'id'=>$_REQUEST['student_id']));
			  }
		}
	    ?>
		</li>
        
        
         <li> 
		
        <?php     
	          if(Yii::app()->controller->action->id=='document' or Yii::app()->controller->id=='studentDocument')
	          {
				  
				 echo CHtml::link(Yii::t('app','Documents'), array('students/document', 'id'=>$_REQUEST['id']),array('class'=>'active'));
				  
		      
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Documents'), array('students/document', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        
        <li> 
		
        <?php     
	          if(Yii::app()->controller->action->id=='electives')
	          {
		      echo CHtml::link(Yii::t('app','Electives'), array('/students/students/electives', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          echo CHtml::link(Yii::t('app','Electives'), array('/students/students/electives', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        
        <?php $model = Configurations::model()->findByAttributes(array('id'=>38));
		if($model->config_value == 1)
		{ ?>
        <li> 
        <?php    
	          if(Yii::app()->controller->action->id=='achievements' or (Yii::app()->controller->id=='achievements' and Yii::app()->controller->action->id=='update'))
	          {
		      	echo CHtml::link(Yii::t('app','Achievements'), array('/students/students/achievements', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          	echo CHtml::link(Yii::t('app','Achievements'), array('/students/students/achievements', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
        <?php } ?>
         <li> 
        <?php    
	          if(Yii::app()->controller->action->id=='log')
	          {
		      	echo CHtml::link(Yii::t('app','Log'), array('/students/students/log', 'id'=>$_REQUEST['id']),array('class'=>'active'));
			  }
			  else
			  {
	          	echo CHtml::link(Yii::t('app','Log'), array('/students/students/log', 'id'=>$_REQUEST['id']));
			  }
	    ?>
		</li>
      
    
    </ul>
    </div>