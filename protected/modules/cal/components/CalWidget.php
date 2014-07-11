<style>
.ui-widget  {
font-family:Arial, Helvetica, sans-serif;
font-size: 1.1em;
}
.ui-state-default .ui-icon .fc-button-inner{
	background-image:url(../images/prev.png);
}
.ui-corner-all {
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
border:0px #404040 solid;
padding:0px;
margin:0px;

-webkit-box-shadow: -1px 3px 6px rgba(50, 50, 50, 0.4);
	-moz-box-shadow:    -1px 3px 6px rgba(50, 50, 50, 0.4);
	box-shadow:         -1px 3px 6px rgba(50, 50, 50, 0.4);	

}
.ui-dialog .ui-dialog-titlebar {
padding: .4em 1em;
position: relative;
border:none;
-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow: none;
	-webkit-border-top-left-radius: 5px;
-webkit-border-top-right-radius: 5px;
-moz-border-radius-topleft: 5px;
-moz-border-radius-topright: 5px;
border-top-left-radius: 5px;
border-top-right-radius: 5px;

}
.ui-dialog .ui-dialog-titlebar-close {
position: absolute;
right: .3em;
top: 50%;
width: 19px;
margin: -10px 0 0 0;
padding: 1px;
height: 18px;
border:none;
-webkit-box-shadow:none;
	-moz-box-shadow:none;
	box-shadow: none;	
}
.ui-dialog .ui-dialog-titlebar {
padding: 1em 1em;
position: relative;
border: none;
color:#FFF;
-moz-border-radius:0px;
-webkit-border-radius: 0px;
border-radius: 0px;
background: url(images/tx_bg.png) repeat scroll 0 0 transparent;	
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
	background:none;
}
.row{
	padding:10px 0px;
}
select{
	margin-left:30px;
}

</style>
<?php

class CalWidget extends CWidget
{
    public function run()
    {
        $calendarOptions = Yii::app()->controller->module->calendarOptions;

        $cs = Yii::app()->getClientScript();
        $scriptUrl = Yii::app()->request->baseUrl;
		
		$cs->registerCssFile($scriptUrl . '/js/fullcalendar/dbfullcalendar.css');
        $cs->registerCssFile($scriptUrl . '/js/fullcalendar/eventCal.css');
        $cs->registerCoreScript('jquery');
        $cs->registerScriptFile($scriptUrl .'/js/jquery-ui-1.8.17.custom.min.js');
        $cs->registerScriptFile($scriptUrl . '/js/fullcalendar/fullcalendar.js');
        $cs->registerScriptFile($scriptUrl . '/js/fullcalendar/eventCal.js');      

        $param['baseUrl']= Yii::app()->createUrl('cal/main').'/';
        $param['newEventPromt']=Yii::t('CalModule.fullCal', 'New event:');
        $param['calendar'] = $this->translateArray($calendarOptions);
        $param = CJavaScript::encode($param);
        $js = "jQuery().eventCal($param);";
        $cs->registerScript(__CLASS__ . '#EventCal', $js);
    }

    function translateArray($arr)
    {
        foreach ($arr as $key => $data)
        {
            if (is_array($data))
            {
                foreach ($data as $k => $d)
                    $data[$k] = Yii::t('CalModule.fullCal', $d);
                $arr[$key] = $data;
            }
            else
                $arr[$key] = Yii::t('CalModule.fullCal', $data);
        }
        return $arr;
    }
}

?>
