<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>::St Johns School::</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/formstyle.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dashboard.css" />
 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/portal/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js"></script>


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
    	<div class="logo"><img src="images/portal/logo.png" width="190" height="32" /></div>
  <div class="loginBox">
        	<ul>
            	
                <li>
                <?php 
				//$user=User::model()->findByAttributes(array('id'=>Yii::app()->user->id));
				$student=Students::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
				//$guard=Guardians::model()->findByAttributes(array('ward_id'=>$student->id));
				?>
                <strong><?php echo ucfirst($student->last_name.' '.$student->first_name);?></strong><br>
                  <a href="#">My Account</a><br><?php echo CHtml::link('Logout', array('/user/logout'));?><br>
              </li>
            	<li><img src="images/portal/p-small-img.png" width="40" height="41"></li>
                
                  
            </ul>
        </div>
    </header>
    <!--header ends here-->
    <!--navigation starts here-->
<nav>
<div style="padding:7px 0px;">
Welcome <strong><?php echo ucfirst($student->last_name.' '.$student->first_name);?></strong> in to your profile.
   </div> 	
    </nav>
	 <!--navigation ends here-->
     <!--banner starts here-->
  <?php echo $content;?>
      <!--bottomsection ends here-->
<footer>
	
      	<div class="fright">

<div class="cright">Copyright © 2012 St Johns School. Powered By <a href="http://www.evisionegypt.com" target="_self">evision</a>. </div></div>
      </footer>
</body>
</html>
