<script>
	function getType()
	{
		var eventid = document.getElementById('eventid').value;
		if(eventid == '')
		{
			window.location= 'index.php?r=dashboard/default/events';
		}
		else
		{
			window.location= 'index.php?r=dashboard/default/events&type='+eventid;
		}
	}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="80" valign="top" id="port-left">
       		 <?php $this->renderPartial('left_side');?>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                	<td valign="top" width="75%">
                        <div style="padding-left:20px; position:relative; padding-top:10px;">
                            <h1><?php echo Yii::t('dashboard','Events list');?></h1>
                            <div style="position:absolute; width:auto; z-index:10; top:0px; right:25px; font-size:14px;">
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
                            <div class="events_con" style="width:97%; padding-top:10px">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
										<?php 
										
										$roles = Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
										foreach($roles as $role)
										{
											$rolename = $role->name;
										}
										
                                        $criteria = new CDbCriteria;
										
                                        $criteria->order = 'start DESC';
										if($_REQUEST['type'])
										{
											$criteria->condition = 'type=:type';
											$criteria->params[':type'] = $_REQUEST['type'];
											if($rolename!= 'Admin')
										    {
											
											$criteria->condition = $criteria->condition.' AND (placeholder= :default or placeholder=:placeholder)';
											$criteria->params[':placeholder'] = $rolename;
											$criteria->params[':default'] = '0';
										    }
										}
										else
										{
											if($rolename!= 'Admin')
										    {
											
											$criteria->condition = 'placeholder = :default or placeholder=:placeholder';
											$criteria->params[':placeholder'] = $rolename;
											$criteria->params[':default'] = '0';
										    }
										}
										
										
                                        $total = Events::model()->count($criteria);
                                        $pages = new CPagination($total);
                                        $pages->setPageSize(Yii::app()->params['listPerPage']);
                                        $pages->applyLimit($criteria);  // the trick is here!
                                        $events = Events::model()->findAll($criteria);
                                        $page_size=Yii::app()->params['listPerPage'];
                                        
                                        /**
                                        * If no events 
                                        */
                                        if(!$events)
										{
										?>
                                            <div style="padding:10px 0px 30px 20px">
                                                <div class="yellow_bx" style="background-image:none;width:90%;padding-bottom:45px;">
                                                    <div class="y_bx_head" style="width:95%;">
                                                    	<?php echo Yii::t('dashboard','No Upcoming Events');?>
                                                    </div>                    
                                                </div>
                                            </div>
                                        <?php 
										}
										?>
                                        <?php 
                                        /**
                                        * For each event
                                        */		
                                        foreach($events as $event)
                                        {
                                ?>	
                                            <tr class="read">
                                                <td width="5%" valign="top">
													<?php /*?><?php
                                                    if($event->type == 1)
                                                    	echo '<div class="stripbx yellowstrip">'.date("d", $event->start).'<span>'.date("M", $event->start).'</span></div>';
                                                    if($event->type == 2)
                                                    	echo '<div class="stripbx redstrip">'.date("d", $event->start).'<span>'.date("M", $event->start).'</span></div>';
                                                    if($event->type == 3)
                                                    	echo '<div class="stripbx bluestrip">'.date("d", $event->start).'<span>'.date("M", $event->start).'</span></div>';
                                                    if($event->type == 4)
                                                    	echo '<div class="stripbx greenstrip">'.date("d", $event->start).'<span>'.date("M", $event->start).'</span></div>';
                                                    ?><?php */?>
                                                    <!--<div class="stripbx yellowstrip">28<span>sep</span></div>
                                                    <div class="stripbx redstrip">28<span>sep</span></div>
                                                    <div class="stripbx bluestrip">28<span>sep</span></div>
                                                    <div class="stripbx greenstrip">28<span>sep</span></div>  -->
                                                    <?php
														$event_type = EventsType::model()->findByPk($event->type);
                                                    	echo '<div class="stripbx" style="position:relative;"><div style="position:absolute; background-color:'.$event_type->colour_code.';top:0px;left:0px; width:3px; height:47px;"></div>'.date("d", $event->start).'<span>'.date("M", $event->start).'</span></div>';
													?>
                                                </td>
                                                <td align="left">
                                                    <div class="hdng_events"><?php echo substr($event->title,0,25); ?></div>
                                                    <div style="width:580px;">
                                                    	
                                                        <?php 
														echo CHtml::ajaxLink(substr($event->desc,0,50),$this->createUrl('default/view',array('event_id'=>$event->id)),array('update'=>'#jobDialog'),array('id'=>'showJobDialog1'.$event->id,'class'=>'add')); 
														?>
                                                    </div>
                                                    <div id="jobDialog"></div>
                                                </td>
                                                <td align="left" class="date" style="width:60px;">
                                                    <span  class="date"><?php 
														$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
														if($settings!=NULL)
														{	
														    $time=Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
				                                            date_default_timezone_set($time->timezone);
															$time=date($settings->displaydate.' '.$settings->timeformat,$event->start);
															
														}
														
														//$time1=date($settings->timeformat,strtotime($time));
														//echo date('H:i:s');
														echo $time;
														
														
														//echo '<br>'.date("Y-M-d H:i:s", $event->start);?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php
										} 
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="pagecon">
	<?php 
    $this->widget('CLinkPager', array(
    'currentPage'=>$pages->getCurrentPage(),
    'itemCount'=>$total,
    'pageSize'=>$page_size,
    'maxButtonCount'=>5,
    //'nextPageLabel'=>'My text >',
    'header'=>'',
    'htmlOptions'=>array('class'=>'pages'),
    ));?>
</div>


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

