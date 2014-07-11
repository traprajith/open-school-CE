 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog'.$day.$emp_id,
                'options'=>array(
                    'title'=>Yii::t('job','Create Job'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
				?>
<h1>Create Attendances</h1>

<?php 
echo $period;
echo $this->renderPartial('_form', array('model'=>$model,'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id,'period'=>$period)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>