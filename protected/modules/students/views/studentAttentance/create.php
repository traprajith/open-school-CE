<?php
$this->breadcrumbs=array(
	'Student Attentances'=>array('/courses'),
	'Create',
);
?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog'.$day.$emp_id,
                'options'=>array(
                    'title'=>Yii::t('students','Mark Attendance'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
				?>
<div style="padding:10px 20px 10px 20px;">
<?php echo $this->renderPartial('_form', array('model'=>$model,'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id)); ?>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
