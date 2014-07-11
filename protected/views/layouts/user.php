<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formstyle.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dashboard.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formelements.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jgauge.css" type="text/css" /> <!-- CSS for jGauge styling. -->
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/chart/highcharts.js"></script>
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
     <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryRotate.min.js"></script> <!-- jQueryRotate plugin used for needle movement. -->
		<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jgauge-0.3.0.a3.js"></script> <!-- jGauge JavaScript. -->
    <!--<link href='http://fonts.googleapis.com/css?family=Share:400,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
	<title>:: OPEN SCHOOL ::</title><?php /*?><?php echo CHtml::encode($this->pageTitle); ?><?php */?>
    <script>
$(document).ready(function() {
$("#lodrop").click(function(){
	
            	if ($(".lo_drop").is(':hidden')){
                	$(".lo_drop").show();
				}
            	else{
                	$(".lo_drop").hide();
            	}
            return false;
       			 });
				  $('.lo_drop').click(function(e) {
            		e.stopPropagation();
        			});
        		$(document).click(function() {
					if (!$(".lo_drop").is(':hidden')){
            		$('.lo_drop').hide();
					}
        			});	
                
});
</script>
</head>

<body>


<div class="wrapper">
<!--<div class="cont_left_logo"><a href="#"><img src="images/openschool-l-logo.png" alt="" width="208" height="141" border="0" /></a></div>-->
    <div class="header">
     <div class="lo_drop">
     	<div class="lo_name">
        	<?php if(isset(Yii::app()->user->username))echo ucfirst(Yii::app()->user->username);//else $this->redirect(array('site/login'));?>
            <span>Administrator</span>
        </div>
    <ul>
        	<li><a href="#">My Account</a></li>
            <li><a href="#">Preference</a></li>
            <li> <?php echo CHtml::link('Logout', array('/site/logout'));?></li>
        </ul>
     </div><?php $college=Configurations::model()->findByPk(1); ?>
        	<div class="logo"><a href="index.php"><?php echo $college->config_value ; ?></a> </div>
      <div class="logo_right">
<div class="searchbx">
				 <form action="<?php echo $this->createUrl('/site/search'); ?>" name="search" method="post">
                	<ul>
                    	<li><input class="searchbar" name="char" type="text" /></li>
                        <li><!--<input src="images/search.png" name="" type="image" />-->
                        <input src="images/search.png" type="image" name="555" value="submit" />
                        </li>
                    </ul>
                  </form>  
                </div>
                <div class="hdr_sepratr"></div>
                <div class="mssgbx">

                    <div id="status-bar">
	
		<ul id="status-infos" style="list-style:none; padding:0px;">
			
			
			<li>
				<a href="index.php?r=message" class="mssgimg" title="<?php //echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?> Unread Message(s)"></a>
                <?php //if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())){ ?>
               <!--<div class="mssg_nmbr"><span>--><?php //echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?><!--</span></div>-->
				<?php //} ?>
			</li>
			
		</ul>
		
		
	
	</div>
                    
                    
			</div>
                <div class="usernamebx">
                	<ul>
                    	<li><img src="images/user.png" width="35" height="29" /></li>
                        <li>
                        <a href="#" id="lodrop"><?php if(isset(Yii::app()->user->username))echo ucfirst(Yii::app()->user->username) ;?></a>
                        </li>
                    </ul>
                </div>
               
            </div>
      </div>
      <div class="navigation_wrapper">
      	<div class="nav">
        	<ul>
            	<li>
                 <?php
				 if(isset(Yii::app()->controller->module->id)) {
				 if(Yii::app()->controller->module->id=='message'||Yii::app()->controller->module->id=='dashboard' ||Yii::app()->controller->module->id=='cal')
				 {
				 echo CHtml::link('Home', array('/message'),array('class'=>'ic1 active'));
				 }else{
					 echo CHtml::link('Home', array('/message'),array('class'=>'ic1'));
				 }
				 }else{
					 echo CHtml::link('Home', array('/message'),array('class'=>'ic1'));
				 }
				 ?>
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='students' || Yii::app()->controller->id =='guardians'|| Yii::app()->controller->id =='studentCategories' || Yii::app()->controller->id =='studentCategory')
				{
				    echo CHtml::link('Students', array('/students'),array('class'=>'ic2 active'));
				}
				else
				{
					echo CHtml::link('Students', array('/students'),array('class'=>'ic2'));
				}
				?>
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='employees' || Yii::app()->controller->id =='employeeAttendances' || Yii::app()->controller->id =='employeeLeaveTypes' || Yii::app()->controller->id =='employeesSubjects'|| Yii::app()->controller->id =='employeeCategories'|| Yii::app()->controller->id =='employeeDepartments'|| Yii::app()->controller->id =='employeePositions')
				{
				    echo CHtml::link('Employees', array('/employees'),array('class'=>'ic3 active'));
				}
				else
				{
					echo CHtml::link('Employees', array('/employees'),array('class'=>'ic3'));
				}
				?>
                </li>
<?php /*?>                <li><?php 
				if(Yii::app()->controller->id=='assesments')
				{
				    echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5 active'));
				}
				else
				{
					echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5'));
				}
				?>
               </li><?php */?>
<?php /*?>                <li><?php 
				if(Yii::app()->controller->id=='reports')
				{
				    echo CHtml::link('Reports', array('/reports'),array('class'=>'ic6 active'));
				}
				else
				{
					echo CHtml::link('Reports', array('/reports'),array('class'=>'ic6'));
				}
				?>
               </li><?php */?>
<?php /*?>                <li><?php 
				if(Yii::app()->controller->id=='accounting')
				{
				    echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7 active'));
				}
				else
				{
					echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7'));
				}
				?>
               </li><?php */?>
				
                <li>
                 <?php 
				if(Yii::app()->controller->id=='courses' || Yii::app()->controller->id=='batches' || Yii::app()->controller->id=='classTiming' || Yii::app()->controller->id=='weekdays' || Yii::app()->controller->id=='subject' || Yii::app()->controller->id=='exams' || Yii::app()->controller->id=='exam' || Yii::app()->controller->id=='gradingLevels' || Yii::app()->controller->id=='defaultsubjects' || Yii::app()->controller->id=='examScores' || Yii::app()->controller->id=='studentAttentance')
				{
				    echo CHtml::link('Courses', array('/courses'),array('class'=>'ic9 active'));
				}
				else
				{
					echo CHtml::link('Courses', array('/courses'),array('class'=>'ic9'));
				}
				?>
                 </li>
                <li>
                 <?php 
				if(Yii::app()->controller->id=='configurations' or Yii::app()->controller->id=='subjects' or Yii::app()->controller->id=='subjectName' or Yii::app()->controller->id=='user')
				{
				    echo CHtml::link('Settings', array('/configurations/'),array('class'=>'ic8 active'));
				}
				else
				{
					echo CHtml::link('Settings', array('/configurations/'),array('class'=>'ic8'));
				}
				?>
                 </li>
<?php /*?>                <li><?php 
				if(Yii::app()->controller->id=='beobject' || Yii::app()->controller->id=='besite' || Yii::app()->controller->id=='beterm' || Yii::app()->controller->id=='betaxonomy' || Yii::app()->controller->id=='bemenu' || Yii::app()->controller->id=='becontentlist' || Yii::app()->controller->id=='beblock' || Yii::app()->controller->id=='bepage' || Yii::app()->controller->id=='beresource' || Yii::app()->controller->id=='beuser')
				{
				    echo CHtml::link('Website', array('#'),array('class'=>'ic4 active'));
				}
				else
				{
					echo CHtml::link('Website', array('#'),array('class'=>'ic4'));
				}
				?>
                </li><?php */?>
            </ul>
            
        </div>	
      </div>
      
     <div class="container">
      <?php echo $content; ?>
      
	</div>
    </div>


</body>

</html>