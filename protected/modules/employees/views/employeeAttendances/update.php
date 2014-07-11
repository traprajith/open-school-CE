<?php
$this->breadcrumbs=array(
	'Employee Attendances'=>array('index'),
	'Create',
);
?>
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'jobDialog'.$day.$emp_id,
                'options'=>array(
                    'title'=>Yii::t('job','Edit Leave'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'400px',
                    'height'=>'auto',
                ),
                ));
				?>

<?php /*?><h1><?php echo Yii::t('employees','Create EmployeeAttendances');?></h1><?php */?>

<?php 
echo $this->renderPartial('_form1', array('model'=>$model,'day' =>$day,'month'=>$month,'year'=>$year,'emp_id'=>$emp_id)); ?>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>