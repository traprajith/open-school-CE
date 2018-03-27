  <div id="parent_leftSect">
       
        	<ul>
            <li>
            <?php
			if(Yii::app()->controller->module->id=='mailbox' and  Yii::app()->controller->id!='news')
			{
				echo CHtml::link(Yii::t('app','Messages'),array('/mailbox'),array('class'=>'mssg_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Messages'),array('/mailbox'),array('class'=>'mssg'));
			}
			?>
           </li>
            <li>
            <?php
			if(Yii::app()->controller->id=='news')
			{
				echo CHtml::link(Yii::t('app','News'),array('/mailbox/news'),array('class'=>'news_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','News'),array('/mailbox/news'),array('class'=>'news'));
			}
			?>
           </li>
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/teachersportal/default/profile'),array('class'=>'profile_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/teachersportal/default/profile'),array('class'=>'profile'));
			}
		   ?>
           </li>
             <li>
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/teachersportal/default/attendance'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/teachersportal/default/attendance'),array('class'=>'attendance'));
			}
		   ?>
           </li>  
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='timetable')
			{
				echo CHtml::link(Yii::t('app','TimeTable'),array('/teachersportal/default/timetable'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','TimeTable'),array('/teachersportal/default/timetable'),array('class'=>'attendance'));
			}
		   ?>
           </li> 
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='examination' or Yii::app()->controller->action->id=='allexam' or Yii::app()->controller->action->id=='classexam')
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/teachersportal/default/examination'),array('class'=>'exams_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/teachersportal/default/examination'),array('class'=>'exams'));
			}
		   ?>
           </li> 
           </ul>
      
        </div>