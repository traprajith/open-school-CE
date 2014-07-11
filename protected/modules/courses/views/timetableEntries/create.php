 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php
$this->breadcrumbs=array(
	'Timetable Entries'=>array('/courses'),
	'Create',
);


?>
<div style="padding:0px 10px 0px 10px;">
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog'.$class_timing_id.$weekday_id,
                'options'=>array(
                    'title'=>Yii::t('job','Time Table Entries'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'330',
                ),
                ));
				?>


<?php echo $this->renderPartial('_form', array('model'=>$model,'batch_id'=>$batch_id,'weekday_id'=>$weekday_id,'class_timing_id'=>$class_timing_id)); ?>


<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>