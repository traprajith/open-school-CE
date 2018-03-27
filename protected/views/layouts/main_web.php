<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <?php
$this->renderPartial('application.views.layouts.header'); ?>
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
    
    

     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/chart/highcharts.js"></script>
     <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-form-elements.js"></script>

    <!--<link href='http://fonts.googleapis.com/css?family=Share:400,400italic,700,700italic' rel='stylesheet' type='text/css'>-->
	<title>:: OPEN SCHOOL ::</title><?php /*?><?php echo CHtml::encode($this->pageTitle); ?><?php */?>
</head>

<body>
<div class="wrapper">
<!--<div class="cont_left_logo"><a href="#"><img src="images/openschool-l-logo.png" alt="" width="208" height="141" border="0" /></a></div>-->
    <div class="header">
        	<div class="logo"><a href="#">St.Mary's H.H.S</a> </div>
      <div class="logo_right">
<div class="searchbx">
                	<ul>
                    	<li><input class="searchbar" name="" type="text" /></li>
                        <li><input src="images/search.png" name="" type="image" /></li>
                    </ul>
                </div>
                <div class="hdr_sepratr"></div>
                <div class="mssgbx">

                    <div id="status-bar">
	
		<ul id="status-infos" style="list-style:none; padding:0px;">
			
			
			<li>
				<a href="#" class="mssgimg" title="25 comments"></a>
                <div class="mssg_nmbr"></div>
				<div id="comments-list" class="result-block">
					<span class="arrow"></span>
					
					<ul class="small-files-list icon-comment" style="padding:10px;">
						<li>
							<a href="#"><strong>Jane</strong>: I don't think so<br>
							<small>On <strong>Post title</strong></small></a>
                            <br />
							<a href="#"><strong>Jane</strong>: I don't think so<br>
							<small>On <strong>Post title</strong></small></a>
                      
						</li>

					</ul>
					
					<p id="comments-info" class="result-info"><a href="#">Manage comments &raquo;</a></p>
				</div>
			</li>
			
		</ul>
		
		
	
	</div>
                    
                    
			</div>
                <div class="usernamebx">
                	<ul>
                    	<li><img src="images/user.png" width="35" height="29" /></li>
                        <li>
                        <a href="#">Matthew Corner</a>
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
				 if(Yii::app()->controller->module)
				 {
				 if(Yii::app()->controller->module->id=='dashboard')
				 {
				 echo CHtml::link('Dashboard', array('/dashboard'),array('class'=>'ic1 active'));
				 }
				 }
				 else
				 {
					 echo CHtml::link('Dashboard', array('/dashboard'),array('class'=>'ic1'));
				 }
				 
				 ?>
                 
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='students' && Yii::app()->controller->action->id !='Assesments')
				{
				    echo CHtml::link('Admissions', array('/students'),array('class'=>'ic2 active'));
				}
				else
				{
					echo CHtml::link('Admissions', array('/students'),array('class'=>'ic2'));
				}
				?>
                </li>
                <li>
                <?php 
				if(Yii::app()->controller->id=='employees')
				{
				    echo CHtml::link('Teachers', array('/employees'),array('class'=>'ic3 active'));
				}
				else
				{
					echo CHtml::link('Teachers', array('/employees'),array('class'=>'ic3'));
				}
				?>
                </li>
                <li><?php 
				if(Yii::app()->controller->id=='beobject' || Yii::app()->controller->id=='besite' || Yii::app()->controller->id=='beterm' || Yii::app()->controller->id=='betaxonomy' || Yii::app()->controller->id=='bemenu' || Yii::app()->controller->id=='becontentlist' || Yii::app()->controller->id=='beblock' || Yii::app()->controller->id=='bepage' || Yii::app()->controller->id=='beresource' || Yii::app()->controller->id=='beuser')
				{
				    echo CHtml::link('Website', array('besite/index'),array('class'=>'ic4 active'));
				}
				else
				{
					echo CHtml::link('Website', array('besite/index'),array('class'=>'ic4'));
				}
				?></li>
                <li><?php 
				if(Yii::app()->controller->id=='assesments')
				{
				    echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5 active'));
				}
				else
				{
					echo CHtml::link('Assesments', array('/assesments'),array('class'=>'ic5'));
				}
				?>
               </li>
                <li><?php 
				if(Yii::app()->controller->id=='reports')
				{
				    echo CHtml::link('Reports', array('/reports'),array('class'=>'ic6 active'));
				}
				else
				{
					echo CHtml::link('Reports', array('/reports'),array('class'=>'ic6'));
				}
				?>
               </li>
                <li><?php 
				if(Yii::app()->controller->id=='accounting')
				{
				    echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7 active'));
				}
				else
				{
					echo CHtml::link('Accounting', array('/accounting'),array('class'=>'ic7'));
				}
				?>
               </li>
				
                
                <li>
                 <?php 
				if(Yii::app()->controller->id=='leads')
				{
				    echo CHtml::link('Leads', array('/leads'),array('class'=>'ic9 active'));
				}
				else
				{
					echo CHtml::link('Leads', array('/leads'),array('class'=>'ic9'));
				}
				?>
                 </li>
                <li>
                 <?php 
				if(Yii::app()->controller->id=='configurations')
				{
				    echo CHtml::link('Settings', array('/configurations/create'),array('class'=>'ic8 active'));
				}
				else
				{
					echo CHtml::link('Settings', array('/configurations/create'),array('class'=>'ic8'));
				}
				?>
                 </li>
            </ul>
            
        </div>	
      </div>
      
     <div class="container">
      <div class="container" id="page">

	<!--<span id="menu_dashboard" class="micon"></span>-->
	
	<div id="site-content">
		<div id="left-sidebar">
                    
                    <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.t('Dashboard<span>Manage your Dashboard</span>'), 'url'=>array('/besite/index') ,'linkOptions'=>array('class'=>'menu_0'),
                                   'active'=> ((Yii::app()->controller->id=='besite') && (in_array(Yii::app()->controller->action->id,array('index')))) ? true : false
					    ),                               
					array('label'=>''.t('Content<span>Manage your Dashboard</span>'),  'url'=>'javascript:void(0);','linkOptions'=>array('class'=>'menu_1' ), 'itemOptions'=>array('id'=>'menu_1'), 
					       'items'=>array(
						array('label'=>t('Create Content'), 'url'=>array('/beobject/create')),
						array('label'=>t('Draft Content'), 'url'=>array('/beobject/draft')),
						array('label'=>t('Pending Content'), 'url'=>array('/beobject/pending')),
						array('label'=>t('Published Content'), 'url'=>array('/beobject/published')),
						array('label'=>t('Manage Content'), 'url'=>array('/beobject/admin'),
						      
						      'active'=> ((Yii::app()->controller->id=='beobject') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)
					    )),
					array('label'=>''.t('Category<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_2','class'=>'menu_2'),  'itemOptions'=>array('id'=>'menu_2'),
					       'items'=>array(
						array('label'=>t('Create Term'), 'url'=>array('/beterm/create')),
						
						array('label'=>t('Manage Terms'), 'url'=>array('/beterm/admin'),
							'active'=> ((Yii::app()->controller->id=='beterm') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)                                                                                           
						      ),
						array('label'=>t('Create Taxonomy'), 'url'=>array('/betaxonomy/create')),
						array('label'=>t('Mangage Taxonomy'), 'url'=>array('/betaxonomy/admin'),
						    'active'=> ((Yii::app()->controller->id=='betaxonomy') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)                                                                                     
					    
					    ),
					       
					    ),
					array('label'=>''.t('Pages<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_3'),
					       'items'=>array(
						array('label'=>t('Create Menu'), 'url'=>array('/bemenu/create'),),
						array('label'=>t('Manage Menus'), 'url'=>array('/bemenu/admin'),
								'active'=> ((Yii::app()->controller->id=='bemenu') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
						array('label'=>t('Create Queue'), 'url'=>array('/becontentlist/create'),),
						array('label'=>t('Manage Queues'), 'url'=>array('/becontentlist/admin'),
						    'active'=> ((Yii::app()->controller->id=='becontentlist') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
							
						array('label'=>t('Create Block'), 'url'=>array('/beblock/create'),),
						array('label'=>t('Manage Blocks'), 'url'=>array('/beblock/admin'),
						    'active'=> ((Yii::app()->controller->id=='beblock') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false)),
							
			     
				
						array('label'=>t('Create Page'), 'url'=>array('/bepage/create'),),
						array('label'=>t('Manage Pages'), 'url'=>array('/bepage/admin'),
						    'active'=> ((Yii::app()->controller->id=='bepage') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)
						)),
					array('label'=>''.t('Resource<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_4','class'=>'menu_4'), 'itemOptions'=>array('id'=>'menu_4'), 
					       'items'=>array(
						array('label'=>t('Create Resource'), 'url'=>array('/beresource/create')),
						array('label'=>t('Manage Resource'), 'url'=>array('/beresource/admin'),
						     'active'=> ((Yii::app()->controller->id=='resource') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false)
						
					    )),
						array('label'=>''.t('Manage<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_5','class'=>'menu_5'), 'itemOptions'=>array('id'=>'menu_5'), 
					       'items'=>array(
						array('label'=>t('Complaints'), 'url'=>array('/comments/admin'),'active'=>Yii::app()->controller->id=='comments' ? true : false),
						//array('label'=>'Like/Rating', 'url'=>array('/like/admin')),
						//array('label'=>'Survey', 'url'=>array('/survey/admin')),
						     
						
					    )),
					array('label'=>''.t('User<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_6','class'=>'menu_6'), 'itemOptions'=>array('id'=>'menu_6'), 
					       'items'=>array(
						array('label'=>t('Create User'), 'url'=>array('/beuser/create')),
						array('label'=>t('Manage Users'), 'url'=>array('/beuser/admin'),
						      'active'=> ((Yii::app()->controller->id=='beuser') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index')))) ? true : false
						      ),
						array('label'=>t('Permission'), 'url'=>array('/rights/assignment'),'active'=>in_array(Yii::app()->controller->id,array('assignment','authItem')) ?true:false),
					    ),
                                                   
					    ),
                        array('label'=>''.t('Settings<span>Manage your Dashboard</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_7','class'=>'menu_7'), 'itemOptions'=>array('id'=>'menu_7'), 
                                           'items'=>array(
                                               array('label'=>t('General'), 'url'=>array('/besettings/general')),
                                               array('label'=>t('System'), 'url'=>array('/besettings/system')),
                                         
                                        ),
                                               
                                        )
					
				),
			)); ?>
		
		</div>
		<div id="main-content-zone">
                        <?php if(isset($this->menu)) :?>
                        <?php if(count($this->menu) >0 ): ?>
			<div class="header-info">
				<?php
                                       
                                        function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}

			$this->widget('zii.widgets.CMenu', array(
                                                'items'=>$this->menu,
                                                'htmlOptions'=>array(),
                                        ));
                                       
                                ?>
			</div>
                        <?php endif; ?>
                        <?php endif; ?>
			<div class="page-content">                                
                                <h2><?php echo (isset($this->titleImage)&&($this->titleImage!=''))? '<img src="assets/backend/images'.$this->titleImage.'" />' : ''; ?><?php echo isset($this->pageTitle)? $this->pageTitle : '';  ?></h2>
                                <?php if (isset($this->pageHint)&&($this->pageHint!='')) : ?>
                                    <p><?php echo $this->pageHint; ?></p>
                                <?php endif; ?>
				<?php echo $content; ?>
			</div>
		</div>
		<div class="clear"></div>
	</div>

</div>
      
	</div>
    </div>
    <script type="text/javascript">

	$(document).ready(function () {
            //Hide the second level menu
            $('#left-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#left-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });
    </script>
</body>
</html>