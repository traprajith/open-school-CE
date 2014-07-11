<?php 
/**
-------------------------
GNU GPL COPYRIGHT NOTICES
-------------------------
This file is part of Open-School.

Open-School is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Open-School is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Open-School.  If not, see <http://www.gnu.org/licenses/>.*/

/**
 * $Id$
 *
 * @author Open-School team <contact@Open-School.org>
 * @link http://www.Open-School.org/
 * @copyright Copyright &copy; 2009-2012 wiwo inc.
 * @Matthew George,@Rajith Ramachandran,@Arun Kumar,
 * @Anupama,@Laijesh V Kumar,@Tanuja.
 * @license http://www.Open-School.org/
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- CSS main application styling. -->
    <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_logo/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formstyle.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dashboard.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formelements.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/coda-slider-2.0.css" type="text/css" media="screen" />  
   
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.1.min.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/chart/highcharts.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>   
   </script>
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
<?php 
if(isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=='hostel'||Yii::app()->controller->module->id=='transport'||Yii::app()->controller->module->id=='library'||Yii::app()->controller->module->id=='downloads')){?>
$(document).ready(function() {
$(".navigationbtm_wrapper_outer").show();
});
<?php }?>
</script>

<script>
	/*$(function() {
		$( "#sortable1, #sortable2" ).sortable({
			connectWith:".connectedSortable",
			placeholder: "ui-state-highlight"
		}).disableSelection();
		
	});*/
</script> 
    
</head>
<title><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>
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
        <?php /*?><img src="images/prof_img.png" width="38" height="39" /><?php */?>
<?php if(isset(Yii::app()->user->name)){ ?> <span> <?php echo ucfirst(Yii::app()->user->name); ?> </span><?php }else $this->redirect(array('site/login'));?>
            <div class="clear"></div>
        </div>
    <ul>
        	<li><?php echo CHtml::link('My Account', array('/mailbox'));?></li>
            <li><?php echo CHtml::link('Preference', array('/configurations/create'));?></a></li>
            <li> <?php echo CHtml::link('Logout', array('/user/logout'));?></li>
        </ul>
     </div>
     
   
	 
	  <?php $college=Configurations::model()->findByPk(1);
	  $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	  if($settings!=NULL)
	  {
		  $lan=$settings->language;
	  }
	  else
	  {
		  $lan='en_us';
	  }
	 Yii::app()->translate->setLanguage($lan);
	  
	 ?>
     <?php $logo=Logo::model()->findAll();?>
        	<div class="logo">
            <!--<a href="index.php"><img src="images/logo.png" alt=""  border="0" />-->
			<?php 
			if($logo!=NULL)
			{
				echo '<img src="'.$this->createUrl('/Configurations/DisplaySavedImage&id='.$logo[0]->primaryKey).'" alt="'.$logo[0]->photo_file_name.'" border="0" height="55" />';
			}
			//echo $college->photo_file_name ; ?></a> </div>
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
							<li><a href="index.php?r=mailbox" class="mssgimg" title=" Unread Message(s)"></a></li>
						</ul>
					</div>
    			</div>
                <div class="usernamebx">
                	<ul>
                    	<li><a href="#" id="lodrop">Account</a></li>
                    </ul>
                </div>
            </div>
    
      </div>
      <div class="navigation_wrapper_outer">
      <div class="navigation_wrapper">
      	<div class="nav">
        	<ul id="sortable1" class="connectedSortable">
            	<li>
                 <?php
				 
				 if(isset(Yii::app()->controller->module->id)) {
				 if(Yii::app()->controller->module->id=='mailbox'||Yii::app()->controller->module->id=='dashboard' ||Yii::app()->controller->module->id=='cal')
				 {
				 echo CHtml::link(Yii::t('app','Home'), array('/default'),array('class'=>'ic1 active'));
				 }else{
					 echo CHtml::link(Yii::t('app','Home'), array('/default'),array('class'=>'ic1'));
				 }
				 }else if(Yii::app()->controller->id=='default')
				 {
					  echo CHtml::link(Yii::t('app','Home'), array('/default'),array('class'=>'ic1 active'));
				 }else
				 {
					 echo CHtml::link(Yii::t('app','Home'), array('/default'),array('class'=>'ic1'));
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='employees')
				{
				    echo CHtml::link(Yii::t('app','Employees'), array('/employees'),array('class'=>'ic3 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Employees'), array('/employees'),array('class'=>'ic3'));
				}
				?>
                </li>
                
				
                <li>
                 <?php 
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='courses')
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='examination')
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='attendance')
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='timetable')
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='fees')
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
			
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='report')
				{
				    echo CHtml::link(Yii::t('app','Reports'), array('/report'),array('class'=>'ic6 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Reports'), array('/report'),array('class'=>'ic6'));
				}
				?>
                </li>
                <li>
                 <?php 
				if(Yii::app()->controller->id=='configurations' or Yii::app()->controller->id=='subjects' or Yii::app()->controller->id=='subjectName' or Yii::app()->controller->id=='user' or in_array(Yii::app()->controller->id,array('admin','profile','profileField')) or Yii::app()->controller->id=='edit')
				{
				    echo CHtml::link(Yii::t('app','Settings'), array('/configurations/'),array('class'=>'ic8 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Settings'), array('/configurations/'),array('class'=>'ic8'));
				}
				?>
                 </li>
              
            </ul>
            
        </div>	
      </div>
     
     
        
         <div id="jobDialog"></div>
      <div class="nav_drop_but"></div>
     </div> 
    
     <div class="navigationbtm_wrapper_outer">
      <div class="navigation_wrapper">
      	<div class="nav">
        	<ul id="sortable2" class="connectedSortable">
            	
                <li>
                 <?php 
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='hostel')
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
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='transport')
				{
				    echo CHtml::link(Yii::t('app','Transport'), array('/transport'),array('class'=>'ic17 active'));
				}
				else
				{
					echo CHtml::link(Yii::t('app','Transport'), array('/transport'),array('class'=>'ic17'));
				}
				?>
                </li>
                <li>
				<?php 
				
					
				 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='library')
				 {
				 echo CHtml::link(Yii::t('app','Library'), array('/library'),array('class'=>'ic10 active'));
				 }else{
					 echo CHtml::link(Yii::t('app','Library'), array('/library'),array('class'=>'ic10'));
				 }
				
				?>
               </li>
               
               <li>
				<?php 
				
					
				 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='downloads')
				 {
				 echo CHtml::link(Yii::t('app','Downloads'), array('/downloads'),array('class'=>'ic18 active'));
				 }else{
					 echo CHtml::link(Yii::t('app','Downloads'), array('/downloads'),array('class'=>'ic18'));
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

     
     <div class="container">
      <?php echo $content; ?>
      
	</div>
    </div>

</body>
</html>