<div class="form" style="padding-left:20px; height:auto; min-height:350px;">
<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-attendances-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>
       <?php echo  CHtml::hiddenField('id',$_REQUEST['id']);?>
	     
	<div class="row">
		<?php //echo $form->labelEx($model,'attendance_date'); ?>
		<?php echo $form->hiddenField($model,'attendance_date',array('value'=>$year.'-'.$month.'-'.$day));?>
		<?php echo $form->error($model,'attendance_date'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'employee_id'); ?>
		<?php echo $form->hiddenField($model,'employee_id',array('value'=>$emp_id)); ?>
		<?php echo $form->error($model,'employee_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('employees','employee_leave_type_id')); ?>
		<?php //echo $form->textField($model,'employee_leave_type_id'); ?>
        <?php echo $form->dropDownList($model,'employee_leave_type_id',CHtml::listData(EmployeeLeaveTypes::model()->findAll(), 'id', 'name'),array('empty'=>'Select Type')); ?>
		<?php echo $form->error($model,'employee_leave_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('employees','reason')); ?>
		<?php echo $form->textField($model,'reason',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('employees','is_half_day')); ?>
		<?php echo $form->checkBox($model,'is_half_day'); ?>
		<?php echo $form->error($model,'is_half_day'); ?>
	</div><br />

	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php 
		echo CHtml::ajaxSubmitButton(Yii::t('job','Save'),CHtml::normalizeUrl(array('EmployeeAttendances/EditLeave','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success")
                	{
						$("#td'.$day.$emp_id.'").text("");
						$("#jobDialog123'.$day.$emp_id.'").html("<span class=\"abs\"></span>","");
						$("#jobDialog'.$day.$emp_id.'").dialog("close");
						 window.location.reload();
					}
                    }'),array('id'=>'closeJobDialog'.$day.$emp_id,'name'=>'save'));?>
        <?php echo CHtml::ajaxSubmitButton(Yii::t('job','Delete'),CHtml::normalizeUrl(array('EmployeeAttendances/DeleteLeave','render'=>false)),array('success'=>'js: function(data) 														
					{
		                $("#td'.$day.$emp_id.'").text(" ");
		                $("#jobDialog'.$day.$emp_id.'").dialog("close"); window.location.reload();
                    }'),array('onClick'=>'return confirm("Are you sure?");','id'=>'closeJobDialog1'.$day.$emp_id,'name'=>'delete')); ?>
	</div><br />

<?php $this->endWidget(); ?>

</div><!-- form -->