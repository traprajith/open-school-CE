<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/dbfullcalendar1.css' />
<link rel='stylesheet' type='text/css' href='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar/fullcalendar.js'></script>
<script type='text/javascript' src='js/fullcalendar/jquery-ui-1.8.17.custom.min.js'></script>
	<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: [
				{
					title: '<div class="evntbx"><div class="evntbx_top"><div class="eventscap greencap"></div><ul><li>Independence Day</li></ul></div><div class="evntbx_bot"><ul><li>This is the name of this event that as a lot of text.......</li></ul></div></div>',
					start: new Date('2012', '4', '10')
				},
				{

					title: '<div class="evntbx"><div class="evntbx_top"><div class="eventscap redcap"></div><ul><li>Independence Day</li></ul></div><div class="evntbx_bot"><ul><li>This is the name of this event that as a lot of text.......</li></ul></div></div>',
					start: new Date('2012', '4', '04')
				},
				
{
					title: '<div class="evntbx"><div class="evntbx_top"><div class="eventscap yellowcap"></div><ul><li>Independence Day</li></ul></div><div class="evntbx_bot"><ul><li>This is the name of this event that as a lot of text.......</li></ul></div></div>',
					start: new Date('2011', '4', '09')
				},
				
				{
					title: '<div class="evntbx"><div class="evntbx_top"><div class="eventscap bluecap"></div><ul><li>Independence Day</li></ul></div><div class="evntbx_bot"><ul><li>This is the name of this event that as a lot of text.......</li></ul></div></div>',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d)
				}
			]
		});
		
	});

</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
  <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        
        <div style="padding-left:20px;">
<h1><?php echo Yii::t('dashboard','Events');?></h1>

<div id="calendar" style="width:98%; padding-top:5px"></div>
<div style="width:99%;"><table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="1%"><img src="images/paperbtm_left.png" width="14" height="14" /></td>
    <td width="97%" class="paperbtm_mid">&nbsp;</td>
    <td valign="top" align="right" width="1%"><img src="images/paperbtm_right.png" width="14" height="14" /></td>
  </tr>
</table>
</div>


 	</div></td>
            <td valign="top" width="25%"><div class="dashSide">
        	<ul>
            	<li><?php echo CHtml::link(Yii::t('dashboard','New Employee'),array('create'),array('class'=>'ico1')) ?></li>
                <li class="sptr"><img src="images/line_side.png" width="1" height="130" /></li>
                <li><?php echo CHtml::link(Yii::t('dashboard','List Employees'),array('manage'),array('class'=>'ico4')) ?></li>
                <li class="sptr"><img src="images/line_side.png" width="1" height="130" /></li>
                <li><a href="#" class="ico8">Leave</a></li>
                <li><a href="#" class="ico3">Attendance</a></li>
                <li class="sptr"><img src="images/line_side.png" width="1" height="130" /></li>
                <li><a href="#" class="ico6">Categories</a></li>
                 <li class="sptr"><img src="images/line_side.png" width="1" height="130" /></li>
                <li><a href="#" class="ico9">Positions</a></li>
                 <li class="sptr"><img src="images/line_side.png" width="1" height="130" /></li>
                <li><a href="#" class="ico10">Subjects</a></li>
                 
                 <li><a href="#" class="ico7">Settings</a></li>
            </ul>
         <div class="clear"></div>
        </div></td>
        
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
