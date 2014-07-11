  <div id="parent_leftSect">
       
        	<ul>
            <li>
            <?php
			if(Yii::app()->controller->action->id=='inbox' || Yii::app()->controller->action->id=='compose' || Yii::app()->controller->action->id=='sent' || Yii::app()->controller->action->id=='view')
			{
				echo CHtml::link('Messages',array('/message/inbox'),array('class'=>'mssg_active'));
			}
			else
			{
				echo CHtml::link('Messages',array('/message/inbox'),array('class'=>'mssg'));
			}
			?>
           </li>
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo CHtml::link('Profile',array('/studentportal/default/profile'),array('class'=>'profile_active'));
			}
			else
			{
				echo CHtml::link('Profile',array('/studentportal/default/profile'),array('class'=>'profile'));
			}
		   ?>
           </li>
             <li>
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo CHtml::link('Attendance',array('/studentportal/default/attendance'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link('Attendance',array('/studentportal/default/attendance'),array('class'=>'attendance'));
			}
		   ?>
           </li> 
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='timetable')
			{
				echo CHtml::link(Yii::t('studentportal','TimeTable'),array('/studentportal/default/timetable'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('studentportal','TimeTable'),array('/studentportal/default/timetable'),array('class'=>'attendance'));
			}
		   ?>
           </li>     
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='fees')
			{
				echo CHtml::link('Fees',array('/studentportal/default/fees'),array('class'=>'fees_active'));
			}
			else
			{
				echo CHtml::link('Fees',array('/studentportal/default/fees'),array('class'=>'fees'));
			}
		   ?>
           </li>   
             
                  <li>
           <?php
		   	if(Yii::app()->controller->action->id=='exams')
			{
				echo CHtml::link('Exams',array('/studentportal/default/exams'),array('class'=>'exams_active'));
			}
			else
			{
				echo CHtml::link('Exams',array('/studentportal/default/exams'),array('class'=>'exams'));
			}
		   ?>
           </li>     
              <li>
           <?php
		 
		   	if(Yii::app()->controller->action->id=='manage' || Yii::app()->controller->action->id=='booksearch' || Yii::app()->controller->action->id=='authordetails')
			{
				echo CHtml::link('Library',array('/library/book/manage'),array('class'=>'report_active'));
			}
			else
			{
				echo CHtml::link('Library',array('/library/book/manage'),array('class'=>'report'));
			}
		   ?>
           </li>        
              <li>
           <?php
		   		if(Yii::app()->controller->action->id=='index' || Yii::app()->controller->action->id=='change')
			{
				echo CHtml::link('Hostel',array('/hostel'),array('class'=>'report_active'));
			}
			else
			{
				echo CHtml::link('Hostel',array('/hostel'),array('class'=>'report'));
			}
		   ?>
           </li>         
            </ul>
      
        </div>