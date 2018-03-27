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
				echo CHtml::link(Yii::t('app','Calender'),array('/parentportal/default/eventlist'),array('class'=>'cal_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Calender'),array('/parentportal/default/eventlist'),array('class'=>'cal'));
			}
           
			?>
            </li>
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/parentportal/default/profile'),array('class'=>'profile_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Profile'),array('/parentportal/default/profile'),array('class'=>'profile'));
			}
		   ?>
           </li>
            <li>
           <?php
		   	if(Yii::app()->controller->action->id=='studentprofile')
			{
				echo CHtml::link(Yii::t('app','Student Profile'),array('/parentportal/default/studentprofile'),array('class'=>'s_profile_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Student Profile'),array('/parentportal/default/studentprofile'),array('class'=>'s_profile'));
			}
		   ?>
           </li>
       <!-- Add New Student Start -->
      		<li>
           <?php
		   $id = Yii::app()->user->Id;
		   	if(Yii::app()->controller->action->id=='new')
			{
				echo CHtml::link(Yii::t('app','Add Student'),array('/onlineadmission/registration/step1'),array('class'=>'add_stu_active',"target"=>"_blank"));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Add Student'),array('/onlineadmission/registration/step1'),array('class'=>'add_stu',"target"=>"_blank"));
			}
		   ?>
           </li>     
      <!-- Add New Student End -->    
      <!-- Check Status of new Student Start -->
      		<li>
           <?php
		   $id = Yii::app()->user->Id;
		   	if(Yii::app()->controller->action->id=='checkStatus')
			{
				echo CHtml::link(Yii::t('app','Check Status'),array('/parentportal/default/checkStatus'),array('class'=>'online_sta_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Check Status'),array('/parentportal/default/checkStatus'),array('class'=>'online_sta'));
			}
		   ?>
           </li>     
      <!-- Check Status of new Student End -->   
           
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/parentportal/default/attendance'),array('class'=>'attendance_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Attendance'),array('/parentportal/default/attendance'),array('class'=>'attendance'));
			}
		   ?>
           </li>   
           <li>
           <?php
		   	if(Yii::app()->controller->action->id=='fees')
			{
				echo CHtml::link(Yii::t('app','Fees'),array('/parentportal/default/fees'),array('class'=>'fees_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Fees'),array('/parentportal/default/fees'),array('class'=>'fees'));
			}
		   ?>
           </li>   
             
                  <li>
           <?php
		   	if(Yii::app()->controller->action->id=='exams')
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/parentportal/default/exams'),array('class'=>'exams_active'));
			}
			else
			{
				echo CHtml::link(Yii::t('app','Exams'),array('/parentportal/default/exams'),array('class'=>'exams'));
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