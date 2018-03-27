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
			if(Yii::app()->controller->action->id=='events')
			{
				echo CHtml::link(Yii::t('app','Events'),array('/dashboard/default/events'),array('class'=>'events_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Events'),array('/dashboard/default/events'),array('class'=>'events'));
			}
           
			?>
            </li>
            <li>
            <?php
			if(Yii::app()->controller->action->id=='eventlist')
			{
				echo CHtml::link(Yii::t('app','Calender'),array('/studentportal/default/eventlist'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Calender'),array('/studentportal/default/eventlist'),array('class'=>'attendance'));
			}
           
			?>
            </li>
            <li>
           <?php
		   		if(Yii::app()->controller->module->id=='downloads' || Yii::app()->controller->id=='students' || Yii::app()->controller->action->id=='authordetails')
			{
				echo CHtml::link(Yii::t('app','Downloads'),array('/downloads/students'),array('class'=>'downloads_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Downloads'),array('/downloads/students'),array('class'=>'downloads'));
			}
		   ?>
           </li> 
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/studentportal/default/profile'),array('class'=>'profile_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/studentportal/default/profile'),array('class'=>'profile'));
			}
		   ?>
           </li>
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='course')
			{
				echo CHtml::link(Yii::t('app','Course'),array('/studentportal/default/course'),array('class'=>'course_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Course'),array('/studentportal/default/course'),array('class'=>'course'));
			}
		   ?>
           </li>   
             <li>
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/studentportal/default/attendance'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/studentportal/default/attendance'),array('class'=>'attendance'));
			}
		   ?>
           </li>
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='timetable')
			{
				echo CHtml::link(Yii::t('app','TimeTable'),array('/studentportal/default/timetable'),array('class'=>'timetable_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','TimeTable'),array('/studentportal/default/timetable'),array('class'=>'timetable'));
			}
		   ?>
           </li>      
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='fees')
			{
				echo CHtml::link(Yii::t('app','Fees'),array('/studentportal/default/fees'),array('class'=>'fees_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Fees'),array('/studentportal/default/fees'),array('class'=>'fees'));
			}
		   ?>
           </li>   
             
                  <li>
           <?php
		   	if(Yii::app()->controller->action->id=='exams')
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/studentportal/default/exams'),array('class'=>'exams_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/studentportal/default/exams'),array('class'=>'exams'));
			}
		   ?>
           </li>     
              <li>
           <?php
		 
		   	if(Yii::app()->controller->action->id=='manage' || Yii::app()->controller->action->id=='booksearch' || Yii::app()->controller->action->id=='authordetails')
			{
				echo CHtml::link(Yii::t('app','Library'),array('/library/book/manage'),array('class'=>'library_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Library'),array('/library/book/manage'),array('class'=>'library'));
			}
		   ?>
           </li>        
              <li>
           <?php
		   		if(Yii::app()->controller->module->id=='hostel' and (Yii::app()->controller->action->id=='index') or Yii::app()->controller->action->id=='change')
			{
				echo CHtml::link(Yii::t('app','Hostel'),array('/hostel'),array('class'=>'hostel_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Hostel'),array('/hostel'),array('class'=>'hostel'));
			}
		   ?>
           </li>
           <li>
           <?php
		   		if(Yii::app()->controller->module->id == 'user')
				{
					echo CHtml::link(Yii::t('app','Settings'),array('/user/profile'),array('class'=>'settings_active'));
				}
				else
				{
		   			echo CHtml::link(Yii::t('app','Settings'),array('/user/profile'),array('class'=>'settings'));
				}
		   ?>
           </li>            
            </ul>
      
        </div>