<div class="leftpanel">
	<div class="logopanel">
        <h1><span></span>
        	 <?php $logo=Logo::model()->findAll();?>
                <?php
                if($logo!=NULL)
                {
                //echo $logo[0]->photo_file_name;
                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" border="0" height="55" />';
                }
                ?>
        <span></span></h1>
    </div><!-- logopanel -->

<div class="leftpanelinner">    
         <?php 
                    $teacher=Employees::model()->findByAttributes(array('uid'=>Yii::app()->user->id));                   
                    ?>
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <?php
					 if($teacher->photo_file_name!=NULL)
					 {
						 $path = Employees::model()->getProfileImagePath($teacher->id); 
						echo '<img  src="'.$path.'" alt="'.$teacher->photo_file_name.'"  width="40" height="41" class="media-object" />';
					}
					elseif($teacher->gender=='M')
					{
						echo '<img  src="images/portal/p-small-male_img.png" alt='.Employees::model()->getTeachername($teacher->id).'  class="media-object"  />'; 
					}
					elseif($teacher->gender=='F')
					{
						echo '<img  src="images/portal/p-small-female_img.png" alt='.Employees::model()->getTeachername($teacher->id).' class="media-object"  />';
					}
					?>
                <div class="media-body">
                    <h4><?php echo Employees::model()->getTeachername($teacher->id);?></h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li>
                <?php echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-user"></i> My Profile'),array('/teachersportal/default/profile'),array('class'=>'profile')); ?>
                </li>
                <li>
                <?php echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-cog"></i> Account Settings'),array('/user/accountprofile'),array('class'=>'profile')); ?>
                </li>
                <li>
                <?php echo CHtml::link('<i class="glyphicon glyphicon-log-out"></i> Log Out', array('/user/logout'));?>
                </li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">


			 <?php 
			if(Yii::app()->controller->module->id=='teachersportal' and  Yii::app()->controller->action->id =='dashboard')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-home"></i> <span>Dashboard</span>'),array('/teachersportal/default/dashboard'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-home"></i> <span>Dashboard</span>'),array('/teachersportal/default/dashboard'));
				echo '</li>';
			}
			?>
            <?php
			if(Yii::app()->controller->module->id=='portalmailbox' and  Yii::app()->controller->id!='news')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-envelope-o"></i> <span>Messages</span>'),array('/portalmailbox'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-envelope-o"></i> <span>Messages</span>'),array('/portalmailbox'));
				echo '</li>';
			}
			?>
          
          
            <?php
			if(Yii::app()->controller->id=='news')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-book"></i> <span>News</span>'),array('/portalmailbox/news'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-book"></i> <span>News</span>'),array('/portalmailbox/news'));
				echo '</li>';
			}
			?>
         
          
           
         
            <?php
			if(Yii::app()->controller->action->id=='events')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-pencil-square-o"></i> <span>Events</span>'),array('/dashboard/default/events'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-pencil-square-o"></i> <span>Events</span>'),array('/dashboard/default/events'));
				echo '</li>';
			}
           
			?>
           
            <?php
			if(Yii::app()->controller->action->id=='eventlist')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-calendar"></i> <span>Calendar</span>'),array('/teachersportal/default/eventlist'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-calendar"></i> <span>Calendar</span>'),array('/teachersportal/default/eventlist'));
				echo '</li>';
			}
           
			?>
          
           <?php
		   	if(Yii::app()->controller->id=='teachers' and Yii::app()->controller->module->id=='portaldownloads')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-arrow-circle-o-down"></i> <span>Downloads</span>'),array('/portaldownloads/teachers'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-arrow-circle-o-down"></i> <span>Downloads</span>'),array('/portaldownloads/teachers'));
				echo '</li>';
			}
		   ?>
         
           <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-user"></i> <span>Profile</span>'),array('/teachersportal/default/profile'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-user"></i> <span>Profile</span>'),array('/teachersportal/default/profile'),array('class'=>'profile'));
				echo '</li>';
			}
		   ?>
           
           <?php
		   	if(Yii::app()->controller->action->id=='course')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-list-alt"></i> <span>My Course</span>'),array('/teachersportal/course'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-list-alt"></i> <span>My Course</span>'),array('/teachersportal/course'),array('class'=>'exams'));
				echo '</li>';
			}
		   ?>
          
           <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-file-text"></i> <span>Attendance</span>'),array('/teachersportal/default/employeeattendance'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-file-text"></i> <span>Attendance</span>'),array('/teachersportal/default/employeeattendance'));
				echo '</li>';
			}
		   ?>
         
           <?php
		   	if(Yii::app()->controller->action->id=='timetable')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-dedent"></i> <span>TimeTable</span>'),array('/teachersportal/default/employeetimetable'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-dedent"></i> <span>TimeTable</span>'),array('/teachersportal/default/employeetimetable'),array('class'=>'timetable'));
				echo '</li>';
			}
		   ?>
          
           <?php
		   	if(Yii::app()->controller->action->id=='examination' or Yii::app()->controller->action->id=='allexam' or Yii::app()->controller->action->id=='classexam')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-pencil"></i> <span>Exams</span>'),array('/teachersportal/default/examination'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-pencil"></i> <span>Exams</span>'),array('/teachersportal/default/examination'),array('class'=>'exams'));
				echo '</li>';
			}
		   ?>
           
            <?php
		   		if(Yii::app()->controller->action->id == 'sendmail')
				{
					echo '<li class="nav-parent">';
		   			echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-comment"></i> <span>Notify</span>'),array('/teachersportal/notifications/sendmail'));
					
					echo '<ul class="children" style="display:block"><li class="active">';
					
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Compose'),array('/teachersportal/notifications/sendmail'));
						
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Drafts'),array('/teachersportal/notifications/drafts'));
						
											
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Sent Mails'),array('/teachersportal/notifications/sentmail'));
						
						echo '</li>';
						
					
					echo '</ul></li>';
				}
				else if(Yii::app()->controller->action->id == 'drafts')
				{
					echo '<li class="nav-parent">';
		   			echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-comment"></i> <span>Notify</span>'),array('/teachersportal/notifications/sendmail'));
					
					echo '<ul class="children" style="display:block"><li>';
					
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Compose'),array('/teachersportal/notifications/sendmail'));
						
						echo '</li><li class="active">';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Drafts'),array('/teachersportal/notifications/drafts'));
						
											
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Sent Mails'),array('/teachersportal/notifications/sentmail'));
						
						echo '</li>';
						
					
					echo '</ul></li>';
				}
				else if(Yii::app()->controller->action->id == 'sentmail')
				{
					echo '<li class="nav-parent">';
		   			echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-comment"></i> <span>Notify</span>'),array('/teachersportal/notifications/sendmail'));
					
					echo '<ul class="children" style="display:block"><li>';
					
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Compose'),array('/teachersportal/notifications/sendmail'));
						
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Drafts'),array('/teachersportal/notifications/drafts'));
						
											
						echo '</li><li class="active" >';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Sent Mails'),array('/teachersportal/notifications/sentmail'));
						
						echo '</li>';
						
					
					echo '</ul></li>';
				}
				else if(Yii::app()->controller->action->id != 'sendmail' || Yii::app()->controller->action->id != 'drafts' || Yii::app()->controller->action->id != 'sentmail')
				{
					echo '<li class="nav-parent">';
		   			echo CHtml::link(Yii::t('teachersportal','<i class="glyphicon glyphicon-comment"></i> <span>Notify</span>'),array('/teachersportal/notifications/sendmail'));
					
					echo '<ul class="children"><li>';
					
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Compose'),array('/teachersportal/notifications/sendmail'));
						
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Drafts'),array('/teachersportal/notifications/drafts'));
						
											
						echo '</li><li>';
						echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-caret-right"></i>Sent Mails'),array('/teachersportal/notifications/sentmail'));
						
						echo '</li>';
						
					
					echo '</ul></li>';
				}
				
		   ?>
          
           <?php
		   		if(Yii::app()->controller->module->id == 'user')
				{
					echo '<li class="active">';
					echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-gear"></i> <span>Settings</span>'),array('/user/accountprofile'));
					echo '</li>';
				}
				else
				{
					echo '<li>';
		   			echo CHtml::link(Yii::t('teachersportal','<i class="fa fa-gear"></i> <span>Settings</span>'),array('/user/accountprofile'));
					echo '</li>';
				}
		   ?>
           </li>    
                       
  </ul>

	</div><!-- leftpanelinner -->
</div><!-- leftpanel -->
