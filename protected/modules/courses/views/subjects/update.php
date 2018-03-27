 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php
$this->breadcrumbs=array(
	Yii::t('app','Subjects')=>array('/courses'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app','Update'),
);
?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog',
                'options'=>array(
                    'title'=>'<h2>'.Yii::t('job','Create Subjects').'</h2>',
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
