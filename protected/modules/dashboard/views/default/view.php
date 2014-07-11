<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic' rel='stylesheet' type='text/css'>-->


<script>

$(document).ready(function() {
    $("#dialog").dialog();
});
 
</script>

<style>

  
.window {
  position:absolute;
  left:0;
  top:0;
  width:300px !important;
  min-height:160px !important;
  z-index:9999;
 -moz-box-shadow:0px 0px 13px 0px #828282;
  -webkit-box-shadow:0px 0px 13px 0px #828282;
  box-shadow:0px 0px 13px 0px #828282;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
}
.event_viewbx
{
	margin:0px;
	padding:0px;
	position:relative;
	/*background:#fbf6e2 url(images/grid_noise.png) repeat;*/
	background:#fff;
	 -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
}
/*.e_closebttn
{ 
    background:url(images/evnt_close.png) no-repeat;
	width:12px; height:12px;
	margin:0px;
	padding:0px;
	position:absolute;
	top:5px;
	right:5px;
	cursor:pointer;
	display:block;
}*/
.e_pop_top
{
	margin:0px;
	padding:10px 20px;
	min-height:113px;
	-webkit-border-top-left-radius: 2px;
	-webkit-border-top-right-radius: 2px;
	-moz-border-radius-topleft: 2px;
	-moz-border-radius-topright: 2px;
	border-top-left-radius: 2px;
	border-top-right-radius: 2px;
	position:relative;
}
.e_pop_top_color
{
	position:absolute;
	top:0px;
	left:0px;
}

.e_pop_bttm
{
	margin:0px;
	padding:10px;
	min-height:23px;
	background:#fdc93f;
	-webkit-border-bottom-right-radius: 2px;
	-webkit-border-bottom-left-radius: 2px;
	-moz-border-radius-bottomright: 2px;
	-moz-border-radius-bottomleft: 2px;
	border-bottom-right-radius: 2px;
	border-bottom-left-radius: 2px;
}
.e_pop_bttm_lft
{
	margin:0px;
	padding:0px;
	float:left;
}
.e_pop_bttm_rht
{
	margin:0px;
	padding:0px;
	float:right;
}
.txt_bx{ margin:0px; padding:0px;}
.txt_bx_title
{
	color:#4f5759;
	font-family: 'Open Sans', sans-serif;
    font-size: 22px;
	font-weight:600;
	margin:0px;
	padding:0px;
	
}
.txt_bx_type
{
	color:#4f5759;
	font-family: 'Open Sans', sans-serif;
    font-size: 12px;
	font-weight:500;
	margin:0px;
	padding:0px;
	line-height:19px;
	
}
.txt_bx_descr
{
	color:#4f5759;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
	font-weight:500;
	margin:0px;
	padding:20px 0px 0px 0px;
	
	
}
.txt_bx_time
{
	color:#4f5759;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
	font-weight:700;
	margin:0px;
	padding:1px 0px 1px 30px;
	background: url(images/modal_icons.png) 0px 0px no-repeat;
	
}
.txt_bx_event
{
	color:#4f5759;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
	font-weight:700;
	margin:0px;
	padding:1px 0px 1px 30px;
	background: url(images/modal_icons.png) 0px -33px no-repeat;
	
}
.txt_bx span
{
	color:#4f5759;
    font-weight:500;
    padding:0px 0px;
	font-family: 'Open Sans', sans-serif;
    font-size: 12px;
}
.ui-widget-content{ 
	-moz-box-shadow:0px 0px 13px 0px #828282;
  	-webkit-box-shadow:0px 0px 13px 0px #828282;
  box-shadow:0px 0px 13px 0px #828282;
  border:none;}
  
.ui-corner-all 
{
	position:absolute;
	top:4px;
	right:3px;
	z-index:10000;
	color:#544f39;
	font-size:12px;
	
	
}
.ui-corner-all a{text-indent:-999px !important; background:url(images/evnt_close.png) no-repeat !important;
	width:21px; height:21px;}



</style>



<div id="dialog" class="window">
<?php
	$event = Events::model()->findByAttributes(array('id'=>$event_id));
	$event_type = EventsType::model()->findByPk($event->type);
?>
	<div class="event_viewbx">
        <div class="e_closebttn"></div>
        <div class="e_pop_top">
        		
        		 <div class="e_pop_top_color">
                 	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 				width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" fill="<?php echo $event_type->colour_code;?>" d="M1,0h23C14.162,10.08,11.671,12.419,0,24V1C0,0.447,0.448,0,1,0z"
					/>
					</svg>
                 </div>
        	     <div class="txt_bx">
                 <div class="txt_bx_title"><?php echo $event->title;?></div>
                 <div class="txt_bx_type">
                 Type: <span><?php echo ucfirst($event_type->name);?></span></div>
                 <div class="txt_bx_descr"><?php echo $event->desc;?></div>
        </div>
        </div>
        <div class="e_pop_bttm">
        	<div class="e_pop_bttm_lft">
            	<div class="txt_bx_time"><?php
				$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
				if($settings!=NULL)
				{	
				     $time=Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
				     date_default_timezone_set($time->timezone);
					$event->start = date($settings->timeformat,$event->start);
					$event->end = date($settings->timeformat,$event->end);
				}
			?>
        	<span><?php echo $event->start.' - '.$event->end; ?></span></div>
            </div>
            <div class="e_pop_bttm_rht">
            	<div class="txt_bx_event"><?php
				//$user_type = AuthAssignment::model()->findByAttributes(array('userid'=>Yii::app()->user->id));
			?>
        	<span><?php if($event->placeholder == '0'){ echo 'Public'; }else{ echo ucfirst($event->placeholder);  } ?></span></div>
            </div>
            <div class="clear"></div>
        </div>
   
    </div>
</div>

<!--<div id="dialog" title="Dialog Title">I'm in a dialog
<div id="boxes">
<div class="window">
Simple Modal Window | 
<a href="#"class="close"/>Close it</a>
</div><div id="mask"></div>
</div>
</div>-->

