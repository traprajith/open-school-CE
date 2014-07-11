<?php
$this->breadcrumbs=array(
	'Batches'=>array('/courses'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog123',
                'options'=>array(
                    'title'=>Yii::t('job','Update'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'400',
                    'height'=>'auto',
					'resizable'=>false,
					
                ),
                ));
				?>
                

<?php 
echo $this->renderPartial('_form1', array('model'=>$model,'val1'=>$course_id,'batch_id'=>$val1)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>