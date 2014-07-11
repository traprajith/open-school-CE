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
				echo CHtml::link('Profile',array('/parentportal/default/profile'),array('class'=>'profile_active'));
			}
			else
			{
				echo CHtml::link('Profile',array('/parentportal/default/profile'),array('class'=>'profile'));
			}
		   ?>
           </li>
            <li>
           <?php
		   	if(Yii::app()->controller->action->id=='studentprofile')
			{
				echo CHtml::link(Yii::t('parentportal','Student Profile'),array('/parentportal/default/studentprofile'),array('class'=>'s_profile_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('parentportal','Student Profile'),array('/parentportal/default/studentprofile'),array('class'=>'s_profile'));
			}
		   ?>
           </li>
             <li>
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo CHtml::link('Attendance',array('/parentportal/default/attendance'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link('Attendance',array('/parentportal/default/attendance'),array('class'=>'attendance'));
			}
		   ?>
           </li> 
           
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='fees')
			{
				echo CHtml::link('Fees',array('/parentportal/default/fees'),array('class'=>'fees_active'));
			}
			else
			{
				echo CHtml::link('Fees',array('/parentportal/default/fees'),array('class'=>'fees'));
			}
		   ?>
           </li>   
             
                  <li>
           <?php
		   	if(Yii::app()->controller->action->id=='exams')
			{
				echo CHtml::link('Exams',array('/parentportal/default/exams'),array('class'=>'exams_active'));
			}
			else
			{
				echo CHtml::link('Exams',array('/parentportal/default/exams'),array('class'=>'exams'));
			}
		   ?>
           </li>     
                  
              
            </ul>
      
        </div>