<style type="text/css">
.pagecon{ float:right}
</style>


 <?php $this->renderPartial('left_side');?>
 <div class="pageheader">
      <h2><i class="fa fa-pencil-square-o"></i><?php echo ' '.Yii::t('app','Events list'); ?> <span><?php echo Yii::t('app','Latest events listed here'); ?></span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label"><?php echo Yii::t('app','You are here:'); ?></span>
        <ol class="breadcrumb">
          <!--<li><a href="index.html">Home</a></li>-->
          <li class="active"><?php echo Yii::t('app','Events'); ?></li>
        </ol>
      </div>
    </div>
   
                        	
    <div class="contentpanel">
    	<!--<div class="col-sm-9 col-lg-12">-->
        <div>
                <div class="panel panel-default panel-alt widget-messaging">
          <div class="panel-heading">
          <div class="panel-btns">
          </div>
          <h4 class="panel-title"><?php echo Yii::t('app','Latest Events'); ?></h4>
        </div>
     
              <div class="panel-body">
              
              <div class="col-sm-9 col-lg-12">
                <div class="col-sm-9 col-lg-4 col-4-reqst">
                <div class="form-group" >
                
                <div class="form-group" style="margin-top:10px;">
                  <label class="col-sm-2 control-label"><?php
								echo Yii::t('app', 'Show');
								?></label>
                  <div class="col-sm-9">
                     <?php
								$data = EventsType::model()->findAll();
								$events_type = CHtml::listData($data,'id','name');
								
								foreach($data as $datum)
								{
									$options["options"][$datum->id] = array("style" => "background-color:".$datum->colour_code);
									
								}
								$options["prompt"] = Yii::t('app','All Events');
								$options["class"] = 'form-control';
								$options["onchange"] = 'getType();';
								$options["id"] = 'eventid';
								echo CHtml::dropDownList("Event_type",$_REQUEST['type'], $events_type,$options);
								
							?>
                            
                  </div>
                </div>
                
                        	
                </div></div>
              </div>
              
              
              
                
            
              </div><!-- panel-btns -->
             
            
            <div class="panel-body">
            
            
              <ul>
                
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
                                                    	<?php echo Yii::t('app','No Upcoming Events');?>
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
                  <li>
                  <small class="pull-right"><span  class="date">
				  	<?php  
						$date_time		=	Configurations::model()->convertDateTime($msg->created);
						echo $date_time;
					?>
                    </span></small>
					
                    <div class="events_hed">
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
                                                    	echo '<div class="stripbx" style="position:relative;"><div class="strip-bg" style=" background-color:'.$event_type->colour_code.';"></div>'.date("d", $event->start).'<span>'.Yii::t("app",date("M", $event->start)).'</span></div>';
													?>
                   
                        </div>
                    
                    <div class="news_sub"><span><?php echo substr($event->title,0,25); ?></span><br>
                    <small class="text-muted"><span class="more"><?php echo $event->desc; ?></span></small><br />
                    <small class="text-muted"><span class="more"><?php echo Yii::t('app','Type');?> : <?php echo $event_type->name; ?></span></small><br />
                    <?php
						$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
						if($settings!=NULL)
						{	
							 $time=Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
							 date_default_timezone_set($time->timezone);
							$event->start = date($settings->timeformat,$event->start);
							$event->end = date($settings->timeformat,$event->end);
							$start		=	Configurations::model()->convertTime($event->start);
							$end		=	Configurations::model()->convertTime($event->end);
							
						} 
					?>	 
                    <small class="text-muted"><span class="more"><?php echo Yii::t('app','Time');?> : <?php echo $start.' - '.$end; ?></span></small>                                  
                    </div> <div id="jobDialog"></div>
                    <div class="clearfix"></div>
              
                </li>
               <?php
					} 
				?>
                
                
              </ul>
            </div><!-- panel-body -->
          </div>
                <!-- panel -->
                  <div class="pagecon">
	<?php 
    $this->widget('CLinkPager', array(
    'currentPage'=>$pages->getCurrentPage(),
    'itemCount'=>$total,
    'pageSize'=>$page_size,
    'maxButtonCount'=>5,
    //'nextPageLabel'=>'My text >',
    'header'=>'',
    'htmlOptions'=>array('class'=>'pagination'),
    ));?>
</div>
                
            </div>
    
      
      
      
      
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
	
	
	function showmore() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "< Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
	
	$(".morelink").unbind('click'); 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
}
showmore();
</script>
<script>
	function getType()
	{
		var eventid = document.getElementById('eventid').value;
		if(eventid == '')
		{
			window.location= 'index.php?r=dashboard/default/event';
		}
		else
		{
			window.location= 'index.php?r=dashboard/default/event&type='+eventid;
		}
	}
</script>


