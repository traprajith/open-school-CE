<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo Yii::app()->params['app_name'].' '.Yii::app()->params['version']; ?> Setup</title>
<link rel="icon" type="image/ico" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/Installer/images/os_fav.ico ?>"/>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/reset.css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/general.css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/form.css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/styles/table.css" media="screen" />
<!--[if IE 6]>
<script src="scripts/DD_belatedPNG.js" type="text/javascript"></script>
<![endif]-->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/scripts/extra.js" type="text/javascript"></script>
</head>

<body>
<div id="container">
    <!-- header -->
    <div id="header">
        <h1><a href="<?php echo Yii::app()->getBaseUrl(true);?>">Welcome to <?php echo Yii::app()->params['app_name']; ?></a></h1>
        <div class="user">Build : <?php echo Yii::app()->params['version']; ?></div>
        
    </div>
    <!-- header.end -->
    
    <!-- main -->
    <div id="main">
        <div class="main-wrapper clearfix">
            <!-- main content -->
            <div class="main-content">
                <?php echo $content;?>
            </div>
            <!-- main content.end -->
            
            <!-- aside -->
            <div class="aside">
           
        <ul id="menu">
        <?php $i=0;?>
        <?php if(Yii::app()->controller->action->id=='step1')
		{?>
        <li class="current"><a href="install.php?r=Install/default/check">System Checks<span>1</span></a></li>
		<?php 
		}
		else
        { ?>
        <li class="firstfinish"><a href="install.php?r=Install/default/check">System Checks<span>1</span></a></li>
        <?php	
        }
        ?>
        
        
        
        <?php if(Yii::app()->controller->action->id=='step2')
		{?>
        <li class="current"><a href="install.php?r=Install/default/environment">Environment Settings<span>2</span></a></li>
        <?php 
		}
		else if(Yii::app()->controller->action->id=='step1')
        { ?>
        <li class=""><a href="install.php?r=Install/default/environment">Environment Settings<span>2</span></a></li>
        <?php	
        }
		else
        { ?>
        <li class="finish"><a href="install.php?r=Install/default/environment">Environment Settings<span>2</span></a></li>
        <?php	
        }
        ?>
        
        <?php if(Yii::app()->controller->action->id=='step3')
		{?>
        <li class="current"><a href="install.php?r=Install/default/build">Database Setup<span>3</span></a></li>
        <?php 
		}
		else if(Yii::app()->controller->action->id=='step1' or Yii::app()->controller->action->id=='step2')
        { ?>
        <li class=""><a href="install.php?r=Install/default/build">Database Setup<span>3</span></a></li>
        <?php	
        }
		else
        { ?>
        <li class="finish"><a href="install.php?r=Install/default/build">Database Setup<span>3</span></a></li>
        <?php	
        }
        ?>
        
        <?php if(Yii::app()->controller->action->id=='step4')
		{?>
        <li class="current"><a href="install.php?r=Install/default/finish">Register<span>4</span></a></li>
        <?php 
		}
		else if(Yii::app()->controller->action->id=='step1' or Yii::app()->controller->action->id=='step2' or Yii::app()->controller->action->id=='step3')
        { ?>
        <li class=""><a href="install.php?r=Install/default/finish">Register<span>4</span></a></li>
        <?php	
        }
		else
        { ?>
        <li class="finish"><a href="install.php?r=Install/default/finish">Register<span>4</span></a></li>
        <?php	
        }
        ?>
        
        
        <?php if(Yii::app()->controller->action->id=='step5')
		{?>
        <li class="current"><a href="install.php?r=Install/default/finish">Final Step<span>5</span></a></li>
        <?php 
		}
		else if(Yii::app()->controller->action->id=='step1' or Yii::app()->controller->action->id=='step2' or Yii::app()->controller->action->id=='step3'  or Yii::app()->controller->action->id=='step4')
        { ?>
        <li class=""><a href="install.php?r=Install/default/finish">Final Step<span>5</span></a></li>
        <?php	
        }
		else
        { ?>
        <li class="finish"><a href="install.php?r=Install/default/finish">Final Step<span>5</span></a></li>
        <?php	
        }
        ?>
        

>
</ul>
        <script type="text/javascript">
        $(function(){
           //disable click on menu
            $('#menu a').click(function(){
                return false;
            });
        });
        </script>
                
            </div>
            <!-- aside -->
        </div>
        
    </div>
    <!-- main.end -->
    
    <!-- footer -->
    <div id="footer">
        <div class="copy">&copy; Copyright 2011 - <?php echo date('Y');?> Wiwo Enterprises Pvt Ltd.<br/>All Rights Reserved.</div>
    </div>
    <!-- footer.end -->
    
</div>

</body>
</html>