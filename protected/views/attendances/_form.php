<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attendances-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->hiddenField($model,'student_id',array('value'=>$emp_id)); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'period_table_entry_id'); ?>
		<?php echo $form->textField($model,'period_table_entry_id',array('value'=>$period)); ?>
		<?php echo $form->error($model,'period_table_entry_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forenoon'); ?>
		<?php echo $form->checkBox($model,'forenoon'); ?>
		<?php echo $form->error($model,'forenoon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'afternoon'); ?>
		<?php echo $form->checkBox($model,'afternoon'); ?>
		<?php echo $form->error($model,'afternoon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		  <?php echo CHtml::ajaxSubmitButton(Yii::t('job','Save'),CHtml::normalizeUrl(array('Attendances/Addnew','render'=>false)),array('success'=>'js: function(data) {
						$("#td'.$day.$emp_id.'").text("");
						$("#jobDialog123'.$day.$emp_id.'").html("<span class=\"abs\"></span>","");
						$("#jobDialog'.$day.$emp_id.'").dialog("close");
                    }'),array('id'=>'closeJobDialog'.$day.$emp_id,'name'=>'save')); ?>
		
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->