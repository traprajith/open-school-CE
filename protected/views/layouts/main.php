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
 * @copyright Copyright &copy; 2009-2015 wiwo inc.
 * @Matthew George,@Rajith Ramachandran,@Arun Kumar,
 * @Anupama,@Laijesh V Kumar.
 * @license http://www.Open-School.org/
 */
?>
<?php $direction = Configurations::model()->direction; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"<?php if($direction == 'rtl'){ ?> dir="rtl" <?php } ?>>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="language" content="en" />
 
 <!-- CSS main application styling. -->
 
 <?php 
 //check fav icon set
  //$fav=  Favicon::model()->find();
 // echo $fav->icon;exit; 
 $favs=  Favicon::model()->findAll(array("order" => "id DESC","limit" => 1,));
 $i=0;
 
 foreach($favs as $fav)
 {
	 
	  $document_status= DocumentUploads::model()->fileStatus(8, $fav->id, $fav->icon);
	  if(isset($fav->icon) and $fav->icon!="" and $document_status==true)
	  { $i=1;	
		  ?>
		  <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_favicon/<?php echo $fav->icon; ?>"/>
	  <?php 
	  } 
 }
 if($i==0)
  {
      ?>
          <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_logo/favicon.ico"/>
          <?php
  }
 ?>
          
 

 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-icons/flaticon.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
 <!-- For rtl -->
 <?php if($direction == 'rtl'){ ?>
 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-rtl.css" />
 <?php }else{ ?>    
 	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-ltr.css" />
 <?php } ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/explorertab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formstyle.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dashboard.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formelements.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" />
 
  <?php /*?><link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/theme.css" /><?php */?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/theme.css" />
 
 <!-- JS main application jquery. -->
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
 
 <style type="text/css">
.select-style {
	width: 221px;
	height: 30px;
	padding: 5px 0 0 0;
	overflow: hidden;
	background: #272b2f url("images/icon-select.png") no-repeat 96% 50%;
}
.select-style select {
	background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
	border: medium none;
	box-shadow: none;
	color: #727272;
	font-size: 11px;
	padding: 5px 8px;
	text-transform: uppercase;
	width: 130%;
}
.select-style select:focus {
	outline: none;
}
</style>
 </head>
 <title>
 <?php $college=Configurations::model()->findByPk(1); ?>
 <?php echo $college->config_value ; ?></title>
    <?php 
    $body=""; $topbar_bg_color=""; $topbar_bg_text=""; $topbar_messagebox=""; $topbar_account="";
    $topbar_account_text=""; $search_background=""; $seach_text_color=""; $menu_background="";
    $menu_border=""; $menu_color=""; $menu_active_color=""; $breadcrumbs_color="";
    $breadcrumbs_background="";
    $themes= Themes::model()->findByAttributes(array('user_id'=>  Yii::app()->user->id));
	if($themes==NULL){
		$themes= Themes::model()->findByAttributes(array('user_id'=>1));
	}
    if($themes)
    {
        $body= $themes->body_background;
        $topbar_bg_color= $themes->topbar_background;
        $topbar_bg_text= $themes->topbar_background_text;
        $topbar_messagebox= $themes->topbar_message;
        $topbar_account= $themes->topbar_account_background;
        $topbar_account_text= $themes->topbar_account_color;
        $search_background= $themes->search_background;
        $seach_text_color= $themes->search_color;
        $menu_background=$themes->menu_background;
        $menu_border= $themes->menu_border;
        $menu_color= $themes->menu_text_color;
        $menu_active_color= $themes->menu_active_color;
        $breadcrumbs_background= $themes->breadcrumbs_background;
        $breadcrumbs_color= $themes->breadcrumbs_color;
        if($breadcrumbs_color!="")
        ?>
            <style>
                .midnav a
                {
                    color:<?php echo $breadcrumbs_color; ?>;
                }
                .midnav span
                {
                    color:<?php echo $breadcrumbs_color; ?>;
                }

            </style>
            <?php
    }
    
    ?>
 <body style="background-color:<?php echo $body; ?>">

<div class="action_bar" style="background-color: <?php echo $topbar_bg_color; ?>">
   <div class="action_bar_wrap">
    <?php 
		 echo CHtml::ajaxLink('<span class="flaticon-expand41"></span>'.Yii::t('app', 'OPEN APP EXPLORER'),array('/site/explorer'),array('update'=>'#explorer_handler'),array('id'=>'open_apps','class'=>'explorer_but','style'=>"color: $topbar_bg_text"));
		 ?>
    <a href="index.php?r=mailbox" class="mssgimg flaticon-email103" style="color: <?php echo $topbar_messagebox; ?>" title="<?php echo Yii::t("app", "Unread Message(s)");?>"><span><?php echo Mailbox::model()->newMsgs(Yii::app()->user->id); ?></span></a> 
	
	<a href="#" class="usernamebx" style="background-color: <?php echo $topbar_account ?>; color: <?php echo $topbar_account_text; ?>" id="lodrop"><?php echo Yii::t("app", "Account");?><span class="flaticon-arrow486"></span></a>  
	</div>
 </div>
<div class="wrapper">
   <div id="explorer_handler"></div>
   <!--<div class="cont_left_logo"><a href="#"><img src="images/openschool-l-logo.png" alt="" width="208" height="141" border="0" /></a></div>-->
   <div class="header">
    <div class="lo_drop" style="background-color:<?php echo $topbar_account; ?>" id="account_drop">
       <div class="lo_name">
        <?php /*?><img src="images/prof_img.png" width="38" height="39" /><?php */?>
        <?php if(isset(Yii::app()->user->name)){ ?>
        <span style="color: <?php echo $topbar_account_text; ?>"> <?php echo ucfirst(Yii::app()->user->name); ?> </span>
        <?php }else $this->redirect(array('site/login'));?>
        <div class="clear"></div>
      </div>
      
       <ul>
        <li>
			<?php
				if(ModuleAccess::model()->check('My Account'))
					echo CHtml::link(Yii::t('app', 'My Account'), array('/activityFeed'),array('style'=>"color:$topbar_account_text"));
				else
            		echo CHtml::link(Yii::t('app', 'My Account'), array('/mailbox'),array('style'=>"color:$topbar_account_text"));
			?>
      	</li>
         
               
     <?php 
	 $roles=Rights::getAssignedRoles(Yii::app()->user->Id);
	 	 
	 if(isset($roles) and $roles!=NULL and key($roles) == 'Admin') { ?> 
        <li><?php echo CHtml::link(Yii::t('app', 'Preference'), array('/configurations/create'),array('style'=>"color:$topbar_account_text"));?></a></li>
        
         <li>
     <?php }else { ?> 
     	<li><?php echo CHtml::link(Yii::t('app', 'Settings'), array('/settingConfiguration/create'),array('style'=>"color:$topbar_account_text"));?></a></li>
     <?php } ?> 
     	
        <?php $link=Configurations::model()->findByPk(37);
			  if($link and $link!=NULL and $link->config_value!=NULL)
			  {
		 ?>
                <li><a style="color: <?php echo $topbar_account_text; ?>" href="<?php echo $link->config_value;?>" target="_blank"><?php echo Yii::t('app','Help');?></a></li>	
         <?php } ?>
                
                 
        <li> <?php echo CHtml::link(Yii::t('app', 'Logout'), array('/user/logout'),array('style'=>"color:$topbar_account_text"));?></li>
        
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
   
    <div class="logo"> 
       <a href="<?php echo Yii::app()->request->baseUrl; ?>">
        <?php 
            $filename=  Logo::model()->getLogo();
            if($filename!=NULL)
            {                  
                echo '<img src="'.Yii::app()->request->baseUrl.'/uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" border="0" height="55" />';                  
            }   
        ?>
       </a>
       
   
        </div>
    <!--<div align="center">
          
     <a id="print_button" href="javascript:window.print();",'_blank'>print</a>
     </div>-->
    <div class="logo_right">
       <ul>
        <li> 
           
           <!-- Academic Year Dropdown -->
           
           <?php
		$academic_yrs = AcademicYears::model()->findAll("is_deleted =:x", array(':x'=>0));
		$academic_yr_options = CHtml::listData($academic_yrs,'id','name');
		if(Yii::app()->user->year)
		{
			$year = Yii::app()->user->year;
			//echo Yii::app()->user->year;
		}
		else
		{
			$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
			$year = $current_academic_yr->config_value;
		}
		if($year)
		{  
		?>
           <div class="select-style" style="background-color:<?php echo $search_background; ?>">
           
              
            <?php
			
			 echo CHtml::dropDownList('system_yid','',$academic_yr_options,array('prompt'=>Yii::t('app','Select Year'),'style'=>'width:242px !important;',"style"=>"color:$seach_text_color",
					'ajax' => array(
					'type'=>'POST',
					'url'=>CController::createUrl('/configurations/viewyear'),
					'success'=>'js:function(){location.reload()}',
					//'update'=>'#batch',
					'data'=>'js:{system_yid:$(this).val(), "'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
					),'options'=>array($year=>array('selected'=>true))));
			?>
          </div>
           <?php
			$active_academic_year = AcademicYears::model()->findByAttributes(array('status'=>1));
			if($active_academic_year->id!=$year)
			{
			?>
           <span class="error_dot orange_dot"> <?php echo Yii::t('app','You are not viewing the current active year'); ?> </span>
           <?php                
			}
			?>
           <?php
		}
		
		?>
           
           <!-- END Academic Year Dropdown --></li>
        <li>
           <div class="searchbx" >
   <?php $form=$this->beginWidget('CActiveForm', array(
			'action'=>$this->createUrl('/site/search'),
		)); 
		$search_val = '';
		if(isset($_REQUEST['char']) and $_REQUEST['char'] != NULL){
			$search_val = $_REQUEST['char'];
		}

?>
            <?php /*?><form  action="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/search" name="search" method="post"><?php */?>
               <ul>
                <li>
                   <input style="background-color: <?php echo $search_background; ?>; color:<?php echo $seach_text_color; ?>;" class="searchbar search-icon" name="char" type="text" value="<?php echo $search_val; ?>">
                 </li>
                <li>
                   <input style="background-color: <?php echo $search_background; ?>" class="search_area search-icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/search.png" type="image" name="555" value="<?php echo Yii::t('app','submit');?>">
                 </li>
              </ul>
            <!-- </form>-->
            <?php $this->endWidget(); ?>  
          </div>
         </li>
      </ul>
     </div>
  </div>
  
  
  <?php
  	  if(ModuleAccess::model()->modulecount()>=21)
	  {		 
		  $height = 243;
		  $div_class = 'nav-secn-border';
	  } 
	  elseif(ModuleAccess::model()->modulecount()>=10)
	  {
		  $height = 161;
		  $div_class = 'nav-secn-border';
	  }
	  else
	  {
		  $height = 81;
		  $$div_class = '';
	  }
	  
	 ?>
   <div class="navigation_wrapper_outer"  style="height:<?php echo $height ; ?>px; background-color: <?php echo $menu_background; ?>; border-color: <?php echo $menu_border; ?>">
    <div class="navigation_wrapper">
    <div class="<?php echo $div_class; ?>" style="border-color: <?php echo $menu_border; ?>" >
       <div class="nav" style="border-color: <?php echo $menu_border; ?>" >
        <ul id="sortable1" class="connectedSortable">
		
			
		   <li>           
            <?php 			
			
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='dashboard' and (Yii::app()->controller->action->id!='events' and Yii::app()->controller->id!='settings'))
				{
				    echo CHtml::link('<i class="fa fa-tachometer"></i></br>'.Yii::t('app','Dashboard'), array('/dashboard'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-tachometer"></i></br>'.Yii::t('app','Dashboard'), array('/dashboard'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			
				?>
          </li>
		  
           <li>
            <?php
				if(ModuleAccess::model()->check('My Account'))
				{ 
				
				 if((isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=='mailbox' || (Yii::app()->controller->module->id=='dashboard' and Yii::app()->controller->action->id=='events') || Yii::app()->controller->module->id=='cal')) || Yii::app()->controller->id=='activityFeed'|| Yii::app()->controller->id=='complaints' || Yii::app()->controller->id=='news' )
				 {
				 echo CHtml::link('<i class="fa fa-home"></i></br>'.Yii::t('app','My Account'), array('/activityFeed'),array('class'=>'active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				 }else{
					 echo CHtml::link('<i class="fa fa-home"></i></br>'.Yii::t('app','My Account'), array('/activityFeed'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				 }
				 
				}
				 ?>
          </li>
           <li>
            <?php
			
			if(ModuleAccess::model()->check('Students'))
			{ 
				if(Yii::app()->controller->id=='students' || Yii::app()->controller->id =='guardians'|| Yii::app()->controller->id =='studentCategories' || Yii::app()->controller->id =='studentCategory' || (Yii::app()->controller->id =='logCategory' and Yii::app()->controller->module->id=='students') ||  Yii::app()->controller->id=='waitinglistStudents' ||  Yii::app()->controller->id=='studentLeaveTypes'|| Yii::app()->controller->action->id=='approval' || Yii::app()->controller->action->id=='onlineapplicants' || Yii::app()->controller->action->id=='profileedit' || Yii::app()->controller->id=='archive' || Yii::app()->controller->id=='studentPreviousDatas' || Yii::app()->controller->id=='studentDocument' || ( Yii::app()->controller->module->id=='students' and Yii::app()->controller->id == 'studentAttentance'))
				{
				    echo CHtml::link('<i class="fa fa-graduation-cap"></i></br>'.Yii::t('app','Students'), array('/students'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-graduation-cap"></i></br>'.Yii::t('app','Students'), array('/students'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Teachers'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='employees')
				{
				    echo CHtml::link('<i class="fa fa-users"></i></br>'.Yii::t('app','Teachers'), array('/employees'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-users"></i></br>'.Yii::t('app','Teachers'), array('/employees'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Courses'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='courses')
				{
				    echo CHtml::link('<i class="fa fa-folder-open"></i></br>'.Yii::t('app','Courses'), array('/courses'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-folder-open"></i></br>'.Yii::t('app','Courses'), array('/courses'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Examination'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='examination' or isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=='CBSCExam' or Yii::app()->controller->module->id=='onlineexam'))
				{
				    echo CHtml::link('<i class="fa fa-edit"></i></br>'.Yii::t('app','Examination'), array('/examination'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-edit"></i></br>'.Yii::t('app','Examination'), array('/examination'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Attendance'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='attendance')
				{
				    echo CHtml::link('<i class="fa fa-calendar"></i></br>'.Yii::t('app','Attendance'), array('/attendance'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-calendar"></i></br>'.Yii::t('app','Attendance'), array('/attendance'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Timetable'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='timetable')
				{
				    echo CHtml::link('<i class="fa fa-calendar-o"></i></br>'.Yii::t('app','Timetable'), array('/timetable'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-calendar-o"></i></br>'.Yii::t('app','Timetable'), array('/timetable'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(ModuleAccess::model()->check('Fees'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='fees')
				{
				    echo CHtml::link('<i class="fa fa-credit-card"></i></br>'.Yii::t('app','Fees'), array('/fees'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-credit-card"></i></br>'.Yii::t('app','Fees'), array('/fees'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
          
           <li>
            <?php 
			if(ModuleAccess::model()->check('Settings'))
			{
				if((isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='backup') or Yii::app()->controller->id=='configurations' or Yii::app()->controller->id=='subjects' or Yii::app()->controller->id=='subjectName' or Yii::app()->controller->id=='user' 
					or in_array(Yii::app()->controller->id,array('profile','profileField')) or Yii::app()->controller->id=='edit' or Yii::app()->controller->id=='academicYears'  
					or Yii::app()->controller->id=='previousYearSettings' or Yii::app()->controller->id=='commonClassTimings' or Yii::app()->controller->id=='studentDocumentList' or Yii::app()->controller->id=='smsSettings'
					or Yii::app()->controller->id=='smsCount' or Yii::app()->controller->id=='notificationSettings'
					or Yii::app()->controller->id=='assignment' or Yii::app()->controller->id=='authItem' 
                                        or Yii::app()->controller->id=='modules' or Yii::app()->controller->id=='onlineRegisterSettings' 
                                        or (Yii::app()->controller->id=='admin' and in_array(Yii::app()->controller->action->id,array('admin','create','update','view')))
                                        or Yii::app()->controller->module->id=='translate' or Yii::app()->controller->module->id=='holidays'
                                        or (Yii::app()->controller->module->id=='dashboard' and Yii::app()->controller->id=='settings')
                                        or Yii::app()->controller->id=='themes' or Yii::app()->controller->id=='portalThemes' or Yii::app()->controller->id=='offlineSettings' or Yii::app()->controller->id=='formFields' or Yii::app()->controller->id=='terms'
                                        
                                        )
				{
				    echo CHtml::link('<i class="fa fa-gear"></i></br>'.Yii::t('app','Settings'), array('/configurations/'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-gear"></i></br>'.Yii::t('app','Settings'), array('/configurations/'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
         
        
           <li>
            <?php 
			if(ModuleAccess::model()->check('Hostel'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='hostel')
				{
				    echo CHtml::link('<i class="fa fa-building"></i></br>'.Yii::t('app','Hostel'), array('/hostel'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-building"></i></br>'.Yii::t('app','Hostel'), array('/hostel'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
			if(key($roles) == 'BusSupervisor' or ModuleAccess::model()->check('Transport'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='transport')
				{
				    echo CHtml::link('<i class="fa fa-bus"></i></br>'.Yii::t('app','Transport'), array('/transport'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-bus"></i></br>'.Yii::t('app','Transport'), array('/transport'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
           <li>
            <?php 
				
				if(ModuleAccess::model()->check('Library'))
				{ 	
					 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='library')
					 {
					 echo CHtml::link('<i class="fa fa-bank"></i></br>'.Yii::t('app','Library'), array('/library'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
					 }else{
						 echo CHtml::link('<i class="fa fa-bank"></i></br>'.Yii::t('app','Library'), array('/library'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
					 }
				}
				?>
          </li>
           <li>
            <?php 
				
				if(ModuleAccess::model()->check('Downloads'))
				{	
				 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='downloads')
				 {
					
					 echo CHtml::link('<i class="fa fa-download"></i></br>'.Yii::t('app','Downloads'), array('/downloads'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
					 
				 }else{
					
					 echo CHtml::link('<i class="fa fa-download"></i></br>'.Yii::t('app','Downloads'), array('/downloads'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
					 
				 }
				}
				
				?>
          </li>
           <li>
            <?php 
				
				if(ModuleAccess::model()->check('Import'))
				{	
				 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='importcsv')
				 {
					
				 	echo CHtml::link('<i class="fa fa-sign-in"></i><br>'.Yii::t('app','Import'), array('/importcsv'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
					
				 }else{
					
					 echo CHtml::link('<i class="fa fa-sign-in"></i><br>'.Yii::t('app','Import'), array('/importcsv'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
					 
				 }
				}
				
				?>
          </li>
           <li>
            <?php 
				
				if(ModuleAccess::model()->check('Export'))
				{	
				 if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='export')
				 {
					
				 	echo CHtml::link('<i class="fa fa-sign-out"></i><br>'.Yii::t('app','Export'), array('/export'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
					
				 }else{
					
					 echo CHtml::link('<i class="fa fa-sign-out"></i><br>'.Yii::t('app','Export'), array('/export'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
					
				 }
				}
				?>
          </li>
          <li>
            <?php 
				
				if(ModuleAccess::model()->check('Notify'))
				{ 	
				 if((isset(Yii::app()->controller->module->id) and in_array(Yii::app()->controller->module->id,array('notifications'))) or (in_array(Yii::app()->controller->id,array('emailtemplates'))))
				 {
					 
				 	echo CHtml::link('<i class="fa fa-comments"></i><br>'.Yii::t('app','Notify'), array('/notifications'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
					
				 }else{
					 
					 echo CHtml::link('<i class="fa fa-comments"></i><br>'.Yii::t('app','Notify'), array('/notifications'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
					
				 }
				}
				?>
          </li>
		  
		   <li>
            <?php 
			 if(ModuleAccess::model()->check('Reports'))
			{
				if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='report')
				{
				    echo CHtml::link('<i class="fa fa-newspaper-o"></i></br>'.Yii::t('app','Reports'), array('/report'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
				}
				else
				{
					echo CHtml::link('<i class="fa fa-newspaper-o"></i></br>'.Yii::t('app','Reports'), array('/report'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
				}
			}
				?>
          </li>
          
 <?php $roles = Rights::getAssignedRoles(Yii::app()->user->Id);?>       
          <li>
			 <?php 
			  	if(ModuleAccess::model()->check('Purchase')){
                    if(key($roles) == 'Admin' or key($roles) == 'pm'){
						if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='purchase')
						{
							echo CHtml::link('<i class="fa fa-shopping-cart"></i></br>'.Yii::t('app','Purchase'), array('/purchase'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
						}
						else
						{
						  echo CHtml::link('<i class="fa fa-shopping-cart"></i></br>'.Yii::t('app','Purchase'), array('/purchase'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
						}
					}
				
					else{						
						if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='purchase')
						{
						  echo CHtml::link('<i class="fa fa-shopping-cart"></i></br>'.Yii::t('app','Purchase'), array('/purchase/materialRequistion'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
						}
						else
						{
						  echo CHtml::link('<i class="fa fa-shopping-cart"></i></br>'.Yii::t('app','Purchase'), array('/purchase/materialRequistion'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
						}
					}
				}
             ?>
          </li>
          
          <li>
			<?php				
                if(ModuleAccess::model()->isEnabled('HR')){ // checking whether HR module is enabled or not
					if(ModuleAccess::model()->check('HR')){	// checking whether the user has access to HR module
						if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='hr'){ 
							echo CHtml::link('<i class="fa fa-user"></i></br>'.Yii::t('app','HR'), array('/hr/staff/index'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
						}
						else{
							echo CHtml::link('<i class="fa fa-user"></i></br>'.Yii::t('app','HR'), array('/hr/staff/index'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
						}
					}
					else{ // user with basic features of HR module
						if(isset(Yii::app()->controller->module->id) and Yii::app()->controller->module->id=='hr'){ 
							echo CHtml::link('<i class="fa fa-user"></i></br>'.Yii::t('app','HR'), array('/hr/leaves/index'),array('class'=>' active','style'=>"border-color:$menu_border; color:$menu_active_color"));
						}
						else{
							echo CHtml::link('<i class="fa fa-user"></i></br>'.Yii::t('app','HR'), array('/hr/leaves/index'),array('class'=>'','style'=>"border-color:$menu_border; color:$menu_color"));
						}
                	}
                }
			?>
          </li>
       
         
         </ul>
      </div>
      </div>
     </div>
  </div>
   
   
   <div class="midnav" style="background-color: <?php echo $breadcrumbs_background; ?>; color: <?php echo $breadcrumbs_color; ?>">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'homeLink' => CHtml::link(Yii::t('app', 'Home'),array('/dashboard')),
		'links'=>$this->breadcrumbs,
		'separator'=>'',
               
	)); ?>
  </div>
   <div class="container"> <?php echo $content; ?>
    <div class="clear"></div>
  </div>
 </div>
</body>

</html>

