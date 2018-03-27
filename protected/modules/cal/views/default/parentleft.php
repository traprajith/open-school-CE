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
                  
              
            </ul>
      
        </div>