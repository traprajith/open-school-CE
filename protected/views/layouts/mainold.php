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
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/coda-slider-2.0.css" type="text/css" media="screen" />
   
     
    
   
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>
    
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/chart/highcharts.js"></script>
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>
     <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryRotate.min.js"></script> <!-- jQueryRotate plugin used for needle movement. -->
		<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jgauge-0.3.0.a3.js"></script> <!-- jGauge JavaScript. -->
    <!--<link href='http://fonts.googleapis.com/css?family=Share:400,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
	<?php /*?><?php echo CHtml::encode($this->pageTitle); ?><?php */?>
    
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>   
   
    <script>
$(document).ready(function() {
$("#lodrop").click(function(){
	
            	if ($("#account_drop").is(':hidden')){
                	$("#account_drop").show();
				}
            	else{
                	$("#account_drop").hide();
            	}
            return false;
       			 });
				  $('#account_drop').click(function(e) {
            		e.stopPropagation();
        			});
        		$(document).click(function() {
					if (!$("#account_drop").is(':hidden')){
            		$('#account_drop').hide();
					}
        			});	
                
});
</script>


<script>
$(document).ready(function() {
$("#book_drop").click(function(){
	
            	if ($("#bookmark").is(':hidden')){
                	$("#bookmark").show();
				}
            	else{
                	$("#bookmark").hide();
            	}
            return false;
       			 });
				  $('#bookmark').click(function(e) {
            		e.stopPropagation();
        			});
        		$(document).click(function() {
					if (!$("#bookmark").is(':hidden')){
            		$('#bookmark').hide();
					}
        			});	
                
});
</script>

<script>
$(document).ready(function() {
  $(".nav_drop_but").click(function() {
  $(".navigationbtm_wrapper_outer").slideToggle();
	});
});
</script>

<script>
	$(function() {
		$( "#sortable1, #sortable2" ).sortable({
			connectWith:".connectedSortable",
			placeholder: "ui-state-highlight"
		}).disableSelection();
		
	});
</script>
  
</head>
<title>:: OPEN SCHOOL ::</title>
<body>
<div class="wrapper">
<div id="explorer_handler"></div>
<!--<div class="cont_left_logo"><a href="#"><img src="images/openschool-l-logo.png" alt="" width="208" height="141" border="0" /></a></div>-->
    <div class="header">
     <?php 
		 echo CHtml::ajaxLink('OPEN APP EXPLORER',array('/site/explorer'),array('update'=>'#explorer_handler'),array('id'=>'open_apps','class'=>'explorer_but'));
		 ?>
   
     <div class="lo_drop" id="account_drop">
     <div class="lo_drop_hov"></div> 
     	<div class="lo_name">
        <img src="images/prof_img.png" width="38" height="39" />
<?php if(isset(Yii::app()->user->username))echo ucfirst(Yii::app()->user->username);//else $this->redirect(array('site/login'));?>
            <span>Administrator</span>
            <div class="clear"></div>
        </div>
    <ul>
        	<li><a href="#">My Account</a></li>
            <li><a href="#">Preference</a></li>
            <li> <?php echo CHtml::link('Logout', array('/user/logout'));?></li>
        </ul>
     </div>
     
   
	 
	  <?php $college=Configurations::model()->findByPk(1);
	  $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	  if($settings!=NULL)
	  {
		  $lan=$settings->language;
	  }
	 Yii::app()->translate->setLanguage($lan);
	  
	 ?>
        	<div class="logo"><a href="index.php"><?php echo $college->config_value ; ?></a> </div>
            <!--<div align="center">
          
     <a id="print_button" href="javascript:window.print();",'_blank'>print</a>
     </div>-->
            <div class="logo_right">
            
<div class="searchbx">
  
				 <form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/search" name="search" method="post">
                	<ul>
                    	<li><input class="searchbar" name="char" type="text"></li>
                        <li>
                        <input src="images/search.png" type="image" name="555" value="submit">
                        </li>
                    </ul>
                  </form>  
                </div>
               
                
                <div class="mssgbx">

                    <div id="status-bar">
	
		<ul id="status-infos" style="list-style:none; padding:0px;">
			
			
			<li>
				<a href="index.php?r=message" class="mssgimg" title=" Unread Message(s)"></a>
                             
							</li>
			
		</ul>
		
		
	
	</div>
                    
                    
			</div>
                <div class="usernamebx">
                	<ul>
                    	
                        <li>
                        <a href="#" id="lodrop">Account</a>
                        </li>
                        
                    </ul>
                </div>
               
            </div>
     <?php /*?> <div class="logo_right">
<div class="searchbx">
				 <form action="<?php echo $this->createUrl('Students/search'); ?>" name="search" method="post">
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
                    	<li><img src="images/user.png" width="27" height="22" /></li>
                        <li>
                        <a href="#" id="lodrop"><?php if(isset(Yii::app()->user->username))echo ucfirst(Yii::app()->user->username) ;?></a>
                        </li>
                    </ul>
                </div>
               
            </div><?php */?>
      </div>
      <div class="navigation_wrapper_outer">
      <div class="navigation_wrapper">
      	<div class="nav">
        	<ul id="sortable1" class="connectedSortable">
            	<li>
                 <?php
				 
				 if(isset(Yii::app()->controller->module->id)) {
				 if(Yii::app()->controller->module->id=='message'||Yii::app()->controller->module->id=='dashboard' ||Yii::app()->controller->module->id=='cal')
				 {
				 echo CHtml::link(Yii::t('app','Home'), array('/message'),array('class'=>'ic1 active'));
				 }else{
					 echo CHtml::link(Yii::t('app','Home'), array('/message'),array('class'=>'ic1'));
				 }
				 }else{
					 echo CHtml::link(Yii::t('app','Home'), array('/message'),array('class'=>'ic1'));
				 }
				 ?>
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='students' || Yii::app()->controller->id =='guardians'|| Yii::app()->controller->id =='studentCategories' || Yii::app()->controller->id =='studentCategory')
				{
				    echo CHtml::link(Yii::t('app','Students'), array('/students'),array('class'=>'ic2 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Students'), array('/students'),array('class'=>'ic2'));
				}
				?>
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='employees' || Yii::app()->controller->id =='employeeAttendances' || Yii::app()->controller->id =='employeeLeaveTypes' || Yii::app()->controller->id =='employeesSubjects'|| Yii::app()->controller->id =='employeeCategories'|| Yii::app()->controller->id =='employeeDepartments'|| Yii::app()->controller->id =='employeePositions'|| Yii::app()->controller->id =='employeeGrades')
				{
				    echo CHtml::link(Yii::t('app','Employees'), array('/employees'),array('class'=>'ic3 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Employees'), array('/employees'),array('class'=>'ic3'));
				}
				?>
                </li>
                <li><?php 
				/*if(Yii::app()->controller->id=='assesments')
				{
				    echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5 active'));
				}
				else
				{
					echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5'));
				}*/
				?>
               </li>
               
                <li><?php 
				/*if(Yii::app()->controller->id=='accounting')
				{
				    echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7 active'));
				}
				else
				{
					echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7'));
				}*/
				?>
               </li>
				
                <li>
                 <?php 
				if(Yii::app()->controller->module->id=='courses')
				{
				    echo CHtml::link(Yii::t('app','Courses'), array('/courses'),array('class'=>'ic9 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Courses'), array('/courses'),array('class'=>'ic9'));
				}
				?>
                 </li>
                  <li>
                 <?php 
				if(Yii::app()->controller->module->id=='examination')
				{
				    echo CHtml::link(Yii::t('app','Examination'), array('/examination'),array('class'=>'ic12 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Examination'), array('/examination'),array('class'=>'ic12'));
				}
				?>
                </li>
                   <li>
                 <?php 
				if(Yii::app()->controller->module->id=='attendance')
				{
				    echo CHtml::link(Yii::t('app','Attendance'), array('/attendance'),array('class'=>'ic11 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Attendance'), array('/attendance'),array('class'=>'ic11'));
				}
				?>
                </li>
                  <li>
                 <?php 
				if(Yii::app()->controller->module->id=='timetable')
				{
				    echo CHtml::link(Yii::t('app','Timetable'), array('/timetable'),array('class'=>'ic14 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Timetable'), array('/timetable'),array('class'=>'ic14'));
				}
				?>
                </li>
               
                <li>
                 <?php 
				if(Yii::app()->controller->module->id=='fees')
				{
				    echo CHtml::link(Yii::t('app','Fees'), array('/fees'),array('class'=>'ic13 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Fees'), array('/fees'),array('class'=>'ic13'));
				}
				?>
                </li>
               
                <li><?php 
				
					
				 if(Yii::app()->controller->module->id=='library')
				 {
				 echo CHtml::link(Yii::t('app','Library'), array('/library'),array('class'=>'ic10 active'));
				 }else{
					 echo CHtml::link(Yii::t('app','Library'), array('/library'),array('class'=>'ic10'));
				 }
				
				?>
                </li>
                <li>
                 <?php 
				if(Yii::app()->controller->id=='configurations' or Yii::app()->controller->id=='subjects' or Yii::app()->controller->id=='subjectName' or Yii::app()->controller->id=='user')
				{
				    echo CHtml::link(Yii::t('app','Settings'), array('/configurations/'),array('class'=>'ic8 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Settings'), array('/configurations/'),array('class'=>'ic8'));
				}
				?>
                 </li>
               <?php /*?> <li><?php 
				if(Yii::app()->controller->id=='beobject' || Yii::app()->controller->id=='besite' || Yii::app()->controller->id=='beterm' || Yii::app()->controller->id=='betaxonomy' || Yii::app()->controller->id=='bemenu' || Yii::app()->controller->id=='becontentlist' || Yii::app()->controller->id=='beblock' || Yii::app()->controller->id=='bepage' || Yii::app()->controller->id=='beresource' || Yii::app()->controller->id=='beuser')
				{
				    echo CHtml::link(Yii::t('app','Website'), array('#'),array('class'=>'ic4 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Website'), array('#'),array('class'=>'ic4 '));
				}
				?>
                </li><?php */?>
            </ul>
            
        </div>	
      </div>
     
     <?php echo CHtml::ajaxLink('<span>'.Yii::t('app','Bookmark').'</span>',$this->createUrl('/Savedsearches/Addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog',
		'type' =>'GET','data' => array( 'val1' => Yii::app()->request->getUrl(),'type'=>'3' ),'dataType' => 'text',
        ),array('id'=>'showJobDialog','class'=>'saveic')); ?>
        
         <div id="jobDialog"></div>
     
      
     
     
     
     
      <div class="nav_drop_but"></div>
     </div> 
    
     <div class="navigationbtm_wrapper_outer">
      <div class="navigation_wrapper">
      	<div class="nav">
        	<ul id="sortable2" class="connectedSortable">
            	
                <li>
                 <?php 
				if(Yii::app()->controller->module->id=='hostel')
				{
				    echo CHtml::link(Yii::t('app','Hostel'), array('/hostel'),array('class'=>'ic15 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Hostel'), array('/hostel'),array('class'=>'ic15'));
				}
				?>
                </li>
                  <li>
                 <?php 
				if(Yii::app()->controller->module->id=='transport')
				{
				    echo CHtml::link(Yii::t('app','Transport'), array('/transport'),array('class'=>'ic17 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Transport'), array('/transport'),array('class'=>'ic17'));
				}
				?>
                </li>
                <li><?php 
				if(Yii::app()->controller->id=='reports')
				{
				    echo CHtml::link(Yii::t('app','Reports'), array('/reports'),array('class'=>'ic6 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Reports'), array('/reports'),array('class'=>'ic6'));
				}
				?>
               </li>
                
                
              
                
              
                 <?php /*?><li>
                 <?php 
				if(Yii::app()->controller->module->id=='translate')
				{
				    echo CHtml::link(Yii::t('app','Translate'), array('/translate/edit/missing'),array('class'=>'ic14 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Translate'), array('/translate/edit/missing'),array('class'=>'ic14'));
				}
				?>
                </li><?php */?>
               <?php /*?> <li>
                 <?php 
				if(Yii::app()->controller->module->id=='user')
				{
				    echo CHtml::link(Yii::t('app','User'), array('/user/admin'),array('class'=>'ic14 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','User'), array('/user/admin'),array('class'=>'ic14'));
				}
				?>
                </li><?php */?>
                <?php /*?><li>
                 <?php 
				if(Yii::app()->controller->module->id=='rights')
				{
				    echo CHtml::link(Yii::t('app','Rights'), array('/rights'),array('class'=>'ic14 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Rights'), array('/rights'),array('class'=>'ic14'));
				}
				?>
                </li><?php */?>
                
                
                
           <?php /*?><li><a href="/osinstall/index.php?r=reports" class="ic16 ">LMS</a></li><?php */?>
                
            </ul>
            
        </div>	
      </div>
      
     </div>
      <!--<div class="midnav">
      <ul>
      <li>
    <?php /*?> <?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><?php */?></li>
     <li class="sptr"></li>
    </ul>
    </div>-->
    <div class="midnav">
    
    
        	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
		'separator'=>'',
	)); ?>
     </div>
     
     
	<!--<div class="midnav">
    
        	<ul>
            	<li><a href="#">Home</a></li>
                <li class="sptr"></li>
                <li><a href="#">Students</a></li>
                <li class="sptr"></li>
                <li><a href="#" class="curpage">New Admission</a></li>
            </ul>
     </div>-->
     
     
    
     
     <div class="container">
      <?php echo $content; ?>
      
	</div>
    </div>
<script type="text/javascript">
  var uvOptions = {};
  (function() {
    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/sHk4ZIFxIn025XbXs4hA.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
  })();
</script>




</body>



 

</html>