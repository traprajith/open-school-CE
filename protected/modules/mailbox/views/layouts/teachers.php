<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> <?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal/style.css" />
        <link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/uploadedfiles/school_logo/favicon.ico"/>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formstyle.css" />-->
        <!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/portal/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>-->
        <script>
        $(document).ready(function(){
			$(".plusbut").click(function(){
				if ($(".addmenu").is(':hidden')){
					$(".addmenu").show();
				}
				else{
					$(".addmenu").hide();
				}
				return false;
			});
			
			$('.addmenu').click(function(e) {
				e.stopPropagation();
			});
			$(document).click(function() {
				$('.addmenu').hide();
			});
        });
        </script>
    </head>
    <body>
        <!--header starts here-->
        <header>
            <div class="logo" style="margin-bottom:20px;">
				<?php $logo=Logo::model()->findAll();?>
                <?php
                if($logo!=NULL)
                {
                //echo $logo[0]->photo_file_name;
                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" border="0" height="55" />';
                }
                ?>
                <!--<img src="images/portal/logo.png" width="190" height="32" />-->
            </div>
            <div class="loginBox">
                <ul>
                <li>
					<?php 
                    $teacher=Employees::model()->findByAttributes(array('uid'=>Yii::app()->user->id));                   
                    ?>
                    <strong><?php echo Employees::model()->getTeachername($teacher->id);?></strong><br>
                    <?php echo CHtml::link(Yii::t('app','My Account'),array('/teachersportal/default/profile'),array('class'=>'profile')); ?> <br/>
					<?php echo CHtml::link(Yii::t('app','Settings'),array('/user/profile'),array('class'=>'profile')); ?>
                    <br><?php echo CHtml::link(Yii::t('app','Logout'), array('/user/logout'));?><br>
                </li>
                <li>
					<?php
					 if($teacher->photo_file_name!=NULL)
					 { 
					 	$path = Employees::model()->getProfileImagePath($teacher->id);  
						echo '<img  src="'.$path.'" alt="'.$teacher->photo_file_name.'"  width="40" height="41" />';
					}
					elseif($teacher->gender=='M')
					{
						echo '<img  src="images/portal/p-small-male_img.png" alt='.Employees::model()->getTeachername($teacher->id).'  width="40" height="41" />'; 
					}
					elseif($teacher->gender=='F')
					{
						echo '<img  src="images/portal/p-small-female_img.png" alt='.Employees::model()->getTeachername($teacher->id).'  width="40" height="41" />';
					}
					?>
                </li>
                </ul>
            </div>
        </header>
        <!--header ends here-->
        <!--navigation starts here-->
        <nav>
            <div style="padding:7px 0px;">
            	<?php echo Yii::t('app','Welcome'); ?> <strong><?php echo ucfirst($teacher->last_name.' '.$teacher->first_name);?></strong> <?php echo Yii::t('app','in to your profile.'); ?>
            </div> 	
        </nav>
        <!--navigation ends here-->
        <!--banner starts here-->
        <div id="parent_Sect">
            <div class="mbox-portal-con">
            	<?php echo $content;?>
            </div>
            <div class="clear"></div>
        </div>
        <!--bottomsection ends here-->
        <footer>
            <div class="fright">
                <div class="cright">Copyright © 2013 <?php echo $college->config_value ; ?>. Powered By <a href="http://www.wiwoinc.com" target="_self">WIWO Inc</a>. </div>
            </div>
        </footer>
    </body>
</html>
