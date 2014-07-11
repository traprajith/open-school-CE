<?php
$this->breadcrumbs=array(
	'Class Timings'=>array('/courses'),
	$model->name,
);
?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog1',
                'options'=>array(
                    'title'=>Yii::t('job','Update Timings'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
					'resizable'=>false,
					
                ),
                ));
				?>
<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'batch_id'=>$batch_id)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>