<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'class-timings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);?>

	<div class="row">
		<?php //echo $form->labelEx($model,'batch_id'); 
		echo $id;?>
		<?php echo $form->hiddenField($model,'batch_id',array('value'=>$batch_id)); ?>
		<?php echo $form->error($model,'batch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('Timing','name')); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('Timing','start_time')); ?>
		
        
        <?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'start_time',
     'name'=>'ClassTimings[start_time]',
	 'options'=>array(
         'showPeriod'=>true,
		 'showPeriodLabels'=> true,
		 'showCloseButton'=> true,       
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
    'nowButtonText'=> 'Now',        
    'showDeselectButton'=> true,   
    'deselectButtonText'=> 'Deselect' 
         ),
	 
     
   )); ?> 
        
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('Timing','end_time')); ?>
		<?php $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'end_time',
     'name'=>'ClassTimings[end_time]',
	 'options'=>array(
         'showPeriod'=>true,
		 'showPeriodLabels'=> true,
		 'showCloseButton'=> true,       
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
    'nowButtonText'=> 'Now',        
    'showDeselectButton'=> true,   
    'deselectButtonText'=> 'Deselect' 
         ),
	 
     
   )); ?> 
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('Timing','is_break')); ?>
		<?php echo $form->checkBox($model,'is_break'); ?>
		<?php echo $form->error($model,'is_break'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
         <?php if(Yii::app()->controller->action->id=='addnew')
		 {echo CHtml::ajaxSubmitButton(Yii::t('job','Create Job'),CHtml::normalizeUrl(array('classtimings/addnew','render'=>false)),array('success'=>'js: function(data) {
                        $("#jobDialog").dialog("close");
                    }'),array('id'=>'closeJobDialog'/*,'name'=>'Submit'*/));}else{echo CHtml::ajaxSubmitButton(Yii::t('job','Create Job'),CHtml::normalizeUrl(array('classtimings/edit','render'=>false)),array('success'=>'js: function(data) {
                        $("#jobDialog1").dialog("close");
                    }'),array('id'=>'closeJobDialog'/*,'name'=>'Submit'*/));} ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->