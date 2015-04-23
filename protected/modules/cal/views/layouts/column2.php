<script>
	function getType()
	{
		var eventid = document.getElementById('eventid').value;
		if(eventid == '')
		{
			window.location= 'index.php?r=cal';
		}
		else
		{
			window.location= 'index.php?r=cal&type='+eventid;
		}
	}
</script>
<?php $this->beginContent('//layouts/main'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<!--upgrade_div_starts-->
            <div class="upgrade_bx">
                <div class="up_banr_imgbx"><a href="https://open-school.org/pricing" target="_blank"><img src="http://tryopenschool.com/images/promo_bnnr_innerpage.png" width="231" height="200" /></a></div>
                <div class="up_banr_firstbx">
                  <h1>You are Using Community Edition</h1>
                  <a href="https://open-school.org/pricing" target="_blank">upgrade to premium version!</a>
                </div>
                
            </div>
            <!--upgrade_div_ends-->
            <div id="othleft-sidebar">
                <!--<div class="lsearch_bar">
                <input name="" type="text" class="lsearch_bar_left" value="Search" />
                <input name="" type="button" class="sbut" />
                <div class="clear"></div>
                </div>-->
                <h1>My Account</h1>  
                <?php 
                function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
                {
                	return $message;
                }
                $this->widget('zii.widgets.CMenu',array(
                'encodeLabel'=>false,
                'activateItems'=>true,
                'activeCssClass'=>'list_active',
                'items'=>array(
					//The Welcome Link
					//array('label'=>''.t('Welcome'),  'url'=>array('/message/index') ,'linkOptions'=>array('class'=>'menu_1' ), 'itemOptions'=>array('id'=>'menu_1') 
					//),
					
					
					// The MailBox Link
					
					array('label'=>t('Mailbox<span>All Received Messages</span>'), 'url'=>array('/mailbox'),
					'active'=> ((Yii::app()->controller->module->id=='mailbox' and  Yii::app()->controller->id!='news') ? true : false),'linkOptions'=>array('class'=>'inbox_ico')),
					
					array('label'=>t('News<span>All Site News</span>'), 'url'=>array('/mailbox/news'),
					'active'=> ((Yii::app()->controller->id=='news') ? true : false),'linkOptions'=>array('class'=>'news_ico')),
					
					
					//The Events Link
					//'label'=>''.t('Events'), 'url'=>'javascript:void(0);', 'itemOptions'=>array('id'=>'menu_2'),
					array('label'=>''.t('<h1>Events</h1>'),
					'active'=> ((Yii::app()->controller->module->id=='cal') ? true : false)),
					
					array('label'=>Yii::t('dashboard','Events List<span>All Events</span>'), 'url'=>array('/dashboard/default/events'),
					'active'=> ((Yii::app()->controller->module->id=='dashboard') ? true : false),'linkOptions'=>array('class'=>'evntlist_ico')),
					
					array('label'=>Yii::t('dashboard','Calendar<span>Schedule Events</span>'), 'url'=>array('/cal'),
					'active'=> (((Yii::app()->controller->module->id=='cal') and (Yii::app()->controller->id != 'eventsType')) ? true : false),'linkOptions'=>array('class'=>'cal_ico')),
					
					array('label'=>Yii::t('dashboard','Event Types<span>Manage Event Types</span>'), 'url'=>array('/cal/eventsType'),
					'active'=> ((Yii::app()->controller->id=='eventsType') ? true : false),'linkOptions'=>array('class'=>'evnttype_ico')),
					
					),
                ));  ?>
            </div>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top" width="75%">
                        <div style="padding-left:20px; position:relative;">
                        <h1>Calendar</h1>
                        <div style="position:absolute; width:auto; z-index:10; top:105px; right:25px; font-size:14px;">
                        	<?php
								echo Yii::t('CalModule.fullCal', 'Show');
								$data = EventsType::model()->findAll();
								$events_type = CHtml::listData($data,'id','name');
								
								foreach($data as $datum)
								{
									$options["options"][$datum->id] = array("style" => "background-color:".$datum->colour_code);
									
								}
								$options["prompt"] = 'All Events';
								$options["style"] = 'margin:10px';
								$options["onchange"] = 'getType();';
								$options["id"] = 'eventid';
								echo CHtml::dropDownList("Event_type",$_REQUEST['type'], $events_type,$options);
							?>
                        </div>
                        <div id="calendar" style="width:98%; padding-top:5px"><?php  echo $content; ?></div>
                            <div style="width:99%;">
                                <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top" width="1%"><img src="images/paperbtm_left.png" width="14" height="14" /></td>
                                        <td width="98%" class="paperbtm_mid">&nbsp;</td>
                                        <td valign="top" align="right" width="1%"><img src="images/paperbtm_right.png" width="14" height="14" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script type="text/javascript">
	$(document).ready(function () {
		//Hide the second level menu
		$('#othleft-sidebar ul li ul').hide();            
		//Show the second level menu if an item inside it active
		$('li.list_active').parent("ul").show();
		
		$('#othleft-sidebar').children('ul').children('li').children('a').click(function () { 
			 if($(this).parent().children('ul').length>0){                  
				$(this).parent().children('ul').toggle();    
			 }
			 
		});
	});
</script>
<br />
<br />
<br />
<?php $this->endContent(); ?>