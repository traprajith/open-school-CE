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
				$guard=Guardians::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
				
				$student=Students::model()->findByAttributes(array('id'=>$guard->ward_id));
				
				?>
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
              <?php
						echo '<img  src="images/portal/p-small-male_img.png" alt='.$guard->first_name.' class="media-object"/>'; 
						
						?>
                
                <div class="media-body">
                    <h4><?php echo ucfirst($guard->last_name.' '.$guard->first_name);?></h4>
                    
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><?php echo CHtml::link(Yii::t('parentportal','<i class="glyphicon glyphicon-user"></i> My Profile'),array('/parentportal/default/profile'),array('class'=>'profile')); ?></li>
                <li><?php echo CHtml::link(Yii::t('parentportal','<i class="glyphicon glyphicon-cog"></i> Account Settings'),array('/user/accountprofile'),array('class'=>'profile')); ?></li>
                <li><?php echo CHtml::link('<i class="glyphicon glyphicon-log-out"></i> Log Out', array('/user/logout'));?></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        
        
         <?php 
			if(Yii::app()->controller->module->id=='parentportal' and  Yii::app()->controller->action->id =='dashboard')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-home"></i> <span>Dashboard</span>'),array('/parentportal/default/dashboard'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-home"></i> <span>Dashboard</span>'),array('/parentportal/default/dashboard'));
				echo '</li>';
			}
			?>
        <?php
			if(Yii::app()->controller->module->id=='portalmailbox' and  Yii::app()->controller->id!='news')
			{	
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-envelope-o"></i> <span>Messages</span>'),array('/portalmailbox'));
				echo '</li>';
			}
			else
			{	
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-envelope-o"></i> <span>Messages</span>'),array('/portalmailbox'));
				echo '</li>';
			}
			?>
        
       		 <?php
			if(Yii::app()->controller->id=='news')
			{	
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-book"></i> <span>News</span>'),array('/portalmailbox/news'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-book"></i> <span>News</span>'),array('/portalmailbox/news'));
				echo '</li>';
			}
			?>
       		
            <?php
			if(Yii::app()->controller->action->id=='events')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-pencil-square-o"></i> <span>Events</span>'),array('/dashboard/default/events'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-pencil-square-o"></i> <span>Events</span>'),array('/dashboard/default/events'));
				echo '</li>';
			}
           ?>
       		
             <?php
			if(Yii::app()->controller->action->id=='eventlist')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-calendar"></i> <span>Calendar</span>'),array('/parentportal/default/eventlist'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-calendar"></i> <span>Calendar</span>'),array('/parentportal/default/eventlist'));
				echo '</li>';
			}
           
			?>
        	
            <?php
		   	if(Yii::app()->controller->action->id=='profile')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-user"></i> <span>Profile</span>'),array('/parentportal/default/profile'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-user"></i> <span>Profile</span>'),array('/parentportal/default/profile'));
				echo '</li>';
			}
		   ?>
       		
            <?php
		   	if(Yii::app()->controller->action->id=='studentprofile')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-male"></i> <span>Student Profile</span>'),array('/parentportal/default/studentprofile'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-male"></i> <span>Student Profile</span>'),array('/parentportal/default/studentprofile'));
				echo '</li>';
			}
		   ?>
        	
            <?php
		   	if(Yii::app()->controller->action->id=='attendance')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-file-text"></i> <span>Attendance</span>'),array('/parentportal/default/attendance'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-file-text"></i> <span>Attendance</span>'),array('/parentportal/default/attendance'));
				echo '</li>';
			}
		   ?>
       		
            <?php
		   	if(Yii::app()->controller->action->id=='fees')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-money"></i> <span>Fees</span>'),array('/parentportal/default/fees'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-money"></i> <span>Fees</span>'),array('/parentportal/default/fees'));
				echo '</li>';
			}
		   ?>
           
           <?php
		   	if(Yii::app()->controller->action->id=='exams')
			{
				echo '<li class="active">';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-pencil"></i> <span>Exams</span>'),array('/parentportal/default/exams'));
				echo '</li>';
			}
			else
			{
				echo '<li>';
				echo CHtml::link(Yii::t('parentportal','<i class="fa fa-pencil"></i> <span>Exams</span>'),array('/parentportal/default/exams'));
				echo '</li>';
			}
		   ?>
        	
            <?php
		   		if(Yii::app()->controller->module->id == 'user')
				{
					echo '<li class="active">';
					echo CHtml::link(Yii::t('parentportal','<i class="fa fa-gear"></i> <span>Settings</span>'),array('/user/accountprofile'));
					echo '</li>';
				}
				else
				{
					echo '<li>';
		   			echo CHtml::link(Yii::t('parentportal','<i class="fa fa-gear"></i> <span>Settings</span>'),array('/user/accountprofile'));
					echo '</li>';
				}
		   ?>
       
        
      </ul>
      
    
      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  