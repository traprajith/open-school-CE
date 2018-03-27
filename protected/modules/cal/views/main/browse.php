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
$has_permission = $this->deletePermission();
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
        'buttons' => array(
			array(
                'text' => Yii::t('app', 'Delete'),
                'click' => "js:function() { if (confirm('".Yii::t('app','Are you sure you want to delete this event?')."')) {eventDialogDelete();
				 }}",				
				'id' => 'EventCal_delete',
				'style'=>($has_permission == 0)?'display: none;':''								
            ),
            array(
                'text' => Yii::t('app', 'OK'),
				'id'=>'EventCal_ok',
                'click' => "js:function() { 
						$('#EventCal_ok').attr('disabled',true);
						eventDialogOK(); 
				}",
            ),
            array(
                'text' => Yii::t('app', 'Cancel'),
                'click' => 'js:function() { $("#EventCal_desc").val(""); $("#EventCal_type").val("");
				$("#EventCal_placeholder").val(""); $("#EventCal_delete").hide(); $(this).dialog("close"); }',
            ),
    ))));
	/*echo CHtml::link('open dialog', '#', array(
   'onclick'=>'alert("ghgjh").dialog("open"); return false;',
));*/
?>

<div class="form " style="padding-left:15px;">
	<?php $model	= new Event; ?>
    <?php echo CHtml::beginForm(); ?>
    <table width="100%" border="0" cellspacing="5" cellpadding="3" style="font-size:12px;">
  <tr>
    <td><?php 
        echo CHtml::hiddenField("EventCal_id", 0);
		echo CHtml::activeLabelEx($model, 'title').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		?>
        </td>
    <td>
	<?php
    	echo CHtml::textField("EventCal_title");
	?>
    </td>
  </tr>
  <tr>
    <td> 
		
		<?php
		echo CHtml::activeLabelEx($model, 'type');
		$events_type = CHtml::listData(EventsType::model()->findAll(),'id','name');?></td>
    <td> <?php echo CHtml::dropDownList("EventCal_type", 1, $events_type,array('style'=>'width:185px;'));
		 ?></td>
  </tr>
  <tr>
    <td><?php echo CHtml::activeLabelEx($model, 'placeholder');?></td>
    <td> <?php if (Yii::app()->user->checkAccess('Admin')) 
		{
			$all_roles=new RAuthItemDataProvider('roles', array('type'=>2));
			$data = $all_roles->fetchData();
			$roles = CHtml::listData($data,'name','name'); 
			echo CHtml::dropDownList("EventCal_placeholder",'0',$roles,array('empty'=>array('0' => 'Public'),'style'=>'text-transform: capitalize;'));
        }
        ?></td>
  </tr>
  <tr>
    <td> <?php echo CHtml::activeLabelEx($model, 'desc');?></td>
    <td><?php echo CHtml::textArea('EventCal_desc','',array('rows'=>6, 'cols'=>30));?></td>
  </tr>
  <tr>
    <td><?php
		echo CHtml::activeLabelEx($model, 'start');?></td>
    <td> <?php echo CHtml::dropDownList("EventCal_start", 0, array());
        ?></td>
  </tr>
  <tr>
    <td><?php
		echo CHtml::activeLabelEx($model, 'end');?></td>
    <td><?php echo CHtml::dropDownList("EventCal_end", 1, array());
        ?></td>
  </tr>
  <tr>
    <td> <?php echo CHtml::activeLabelEx($model, 'organizer');?></td>
    <td><?php echo CHtml::textField('EventCal_organizer');
		 ?></td>
  </tr>
  <tr>
    <td> <?php
		echo CHtml::activeLabelEx($model, 'allDay');?></td>
    <td><?php echo CHtml::checkBox("EventCal_allDay", true);
        ?></td>
  </tr>
  <tr>
    <td> <?php
		echo CHtml::activeLabelEx($model, 'editable');?></td>
    <td><?php echo CHtml::checkBox("EventCal_editable", true);
        ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>



    <?php echo CHtml::endForm(); ?>
    </div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
        <!-- end Event dialog -->

        <!-- links block -->
        <div style="text-align: right">
    <?php
       /* echo '&laquo;';
        echo CHtml::link(Yii::t('CalModule.fullCal', 'Events list'), '#',
                array('onclick' => "$('#dlg_eventsHelper').dialog('open');"));
        echo '&raquo; ';
        if($calendarOptions['cronPeriod'])
        {
            echo '&laquo;';
            echo CHtml::link(Yii::t('CalModule.EventsUserPreference', 'Preference'), '#',
                    array('onclick' => "$('#dlg_Userpreference').dialog('open');"));
            echo '&raquo; ';
        }
        if ( (bool) Yii::app()->user->getState('isAdmin', false) )
        {
                echo '&laquo;';
                echo CHtml::link(Yii::t('CalModule.fullCal', 'change user'), '#',
                        array('onclick' => "$('#dlg_changeUser').dialog('open');"));
                echo '&raquo;';
        }*/
    ?>
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

    <!-- User preference dialog -->
<?php
if($calendarOptions['cronPeriod'])
{
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'dlg_Userpreference',
            'options' => array(
                'title' => Yii::t('app', 'preference'),
                //'modal' => false,
                'autoOpen' => false,
                'buttons' => array(
                    array(
                        'text' => Yii::t('app', 'OK'),
                        'click' => 'js:function() { userpreferenceOK(); }'
                    ),
                    array(
                        'text' => Yii::t('app', 'Cancel'),
                        'click' => 'js:function() { $(this).dialog("close"); }'
                    ),)
                )));
        $this->widget('UserPreference', array('userId'=>$userId));
        $this->endWidget('zii.widgets.jui.CJuiDialog');
    } ?>
        <!-- end user preference dialog -->

        <!-- Event helper dialog -->
<?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'dlg_eventsHelper',
            'options' => array(
                'title' => Yii::t('app', 'Events list'),
                'modal' => false,
                'position' => array('right', 'top'),
                'autoOpen' => false,
                'buttons' => array(
                    array(
                        'text' => Yii::t('app', 'OK'),
                        'click' => 'js:function() { $(this).dialog("close"); }'
                    ),
                    array(
                        'text' => Yii::t('app', 'add new'),
                        'click' => 'js:function() { createNewEvent(); }'
                    ),
            )))
        );
        $this->widget('EventHelper', array('userId' =>$userId, 'dialogMode'=>true));
        $this->endWidget('zii.widgets.jui.CJuiDialog');
?>
        <!-- end event helper dialog -->

        <div id='loading' style='display:none'><?php echo Yii::t('app','loading...');?></div>

        <div id="EventCal"></div>
<?php $this->widget('CalWidget'); ?>
