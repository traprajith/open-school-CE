<style>
	
#note {
	color:#900;
	/*position:absolute;
	bottom:0;
	right:20px;
	height:150px;
	width:130px;*/
}
#dlg_EventCal select {
    margin-left:0px !important;
	margin-top:5px !important;
}
.ui-button-text-only
{
    height: 37px;
}
</style>

<script>
$( document ).ready(function() {
	
});
</script>

<!-- Event dialog -->
<?php
$calendarOptions = Yii::app()->controller->module->calendarOptions;
//print_r($calendarOptions); exit;
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dlg_EventCal',
    'options' => array(
        'title' => Yii::t('app', 'Event Detail'),
        'modal' => true,
        'autoOpen' => false,
        'hide' => 'slide',
        'show' => 'slide',
		'width'=> '350px',
		'close'=>'js:function(){$(".errorMessage").remove();}',
        'buttons' => array())));
	/*echo CHtml::link('open dialog', '#', array(
   'onclick'=>'alert("ghgjh").dialog("open"); return false;',
));*/
?>

<div class="form " style="padding-left:15px;"> 
 
    dfgdfgdfgdgf



 
    </div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
        <!-- end Event dialog -->

        <!-- links block -->
        <div style="text-align: right">
   
    </div>
    <!-- end links block -->

    <!-- change user form  -->
<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'dlg_changeUser',
            'options' => array(
                'autoOpen' => false,
                )));
    $this->widget('ChangeUser', array('userId'=>$userId));
    $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
        <div id="EventCal"></div>
<?php $this->widget('CalWidget'); ?>
