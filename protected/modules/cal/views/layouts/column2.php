<style type="text/css">

.searchbar {
    background: none repeat scroll 0 0 #272b2f;
    border: 0 solid #282828;
    color: #ccc;
    height: 35px !important;
    margin: -20px 0 0 !important;
    outline: medium none;
    padding: 8px 40px 6px 5px;
    width: 189px;
}


.search_area {
    position: absolute;
    right: 6px;
    top: -12px !important; 
}

.ui-state-highlight{
	border-radius:0px !important;
	color:#FFF !important;
}
td.fc-today:hover{
	background:#DD544F !important;
}
.fc-today .fc-day-number{
	color:#FFF !important;
}

</style>

<?php
$this->breadcrumbs=array(	
	Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Calendar'),
);
?>
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
            <?php 
                $leftside = 'mailbox.views.default.left_side'; 
                $this->renderPartial($leftside);
            ?>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top" width="75%">
                        <div class="cont_right formWrapper" style="padding-left:20px; position:relative;">
                        <strong><?php echo Yii::t('app','Calendar');?></strong>
                        <div style="position:absolute; width:auto; z-index:10; top:101px; right:22px; font-size:14px;">
                        	<?php
								echo Yii::t('app', 'Show');
								$data = EventsType::model()->findAll();
								$events_type = CHtml::listData($data,'id','name');
								
								foreach($data as $datum)
								{
									$options["options"][$datum->id] = array("style" => "background-color:".$datum->colour_code);
									
								}
								$options["prompt"] = Yii::t('app','All Events');
								$options["style"] = 'margin:10px';
								$options["onchange"] = 'getType();';
								$options["id"] = 'eventid';
								
								echo CHtml::dropDownList("Event_type",$_REQUEST['type'], $events_type,$options);
							?>
                        </div>
                        <div id="calendar" style="width:100%; padding-top:5px"><?php  echo $content; ?></div>
                            <!--<div style="width:100%;">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top" width="1%"><img src="images/paperbtm_left.png" width="14" height="14" /></td>
                                        <td width="100%" class="paperbtm_mid">&nbsp;</td>
                                        <td valign="top" align="right" width="1%"><img src="images/paperbtm_right.png" width="14" height="14" /></td>
                                    </tr>
                                </table>
                            </div>-->
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