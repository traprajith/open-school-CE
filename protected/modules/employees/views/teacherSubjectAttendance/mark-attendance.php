<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<div style="padding:0px 10px 0px 10px;">
	<?php 
    if(isset($_REQUEST['id']) and $_REQUEST['id']){ 
        $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'jobDialog2',
            'options'=>array(
                'title'=>Yii::t('job','Update Subject Wise Attendance'),
                'autoOpen'=>true,
                'modal'=>'true',
                'width'=>'auto',
                'height'=>'450',
                'open'=> 'js:function(event, ui){$(".ui-dialog-titlebar-close").click(function(){$("#timetable-entries-form").remove();});}',                
            ),
        ));
    } else{
        $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'jobDialog1',
            'options'=>array(
                'title'=>Yii::t('job','Mark Subject Wise Attendance'),
                'autoOpen'=>true,
                'modal'=>'true',
                'width'=>'auto',
                'height'=>'450',
                'open'=> 'js:function(event, ui){$(".ui-dialog-titlebar-close").click(function(){$("#timetable-entries-form").remove();});}',                
            ),
        ));
    }
    ?>				
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>