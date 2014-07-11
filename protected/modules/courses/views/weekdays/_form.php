<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'weekdays-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		
		
        
        <?php 
		

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo Yii::t('weekdays','Course');
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'Select',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Weekdays/batch'),
'update'=>'#batch_id',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo Yii::t('weekdays','Batch');

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>'Select','id'=>'batch_id')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weekday'); ?>
        
		<?php echo CHtml::checkBox('sunday','');?><?php echo Yii::t('weekdays','Sunday');?>
        <?php echo CHtml::checkBox('Monday','');?><?php echo Yii::t('weekdays','Monday');?>
        <?php echo CHtml::checkBox('Tuesday','');?><?php echo Yii::t('weekdays','Tuesday');?>
        <?php echo CHtml::checkBox('Wednesday','');?><?php echo Yii::t('weekdays','Wednesday');?>
        <?php echo CHtml::checkBox('Thursday','');?><?php echo Yii::t('weekdays','Thursday');?>
        <?php echo CHtml::checkBox('Friday','');?><?php echo Yii::t('weekdays','Friday');?>
        <?php echo CHtml::checkBox('Saturday','');?><?php echo Yii::t('weekdays','Saturday');?>
		
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->