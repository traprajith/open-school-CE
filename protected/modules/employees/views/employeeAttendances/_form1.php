<?php
$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
if(Yii::app()->user->year)
{
	$ac_year = Yii::app()->user->year;
}
else
{
	$ac_year = $current_academic_yr->config_value;
}
$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));


?>


<div class="form" style="padding-left:20px; height:auto; min-height:350px;">
<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-attendances-form',
	//'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>

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
     <?php   $employee = Employees::model()->findByAttributes(array('id'=>$emp_id));	
			if($employee->gender == 'M'){
				$gender=1;
			}
			if($employee->gender == 'F'){
				$gender=2;
			}
		
			$criteria=new CDbCriteria;
			$criteria->condition='(gender=:gender OR gender=0) AND is_deleted=:is_deleted';
			$criteria->params=array(':gender'=>$gender, ':is_deleted'=>0);
			$leave_types = LeaveTypes::model()->findAll($criteria);  ?>

	<div class="row">
		<?php echo $form->labelEx($model,'employee_leave_type_id'); ?>
		<?php //echo $form->textField($model,'employee_leave_type_id'); ?>
        <?php 
			if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
			{ 
			echo $form->dropDownList($model,'employee_leave_type_id',CHtml::listData($leave_types, 'id', 'type'),array('empty'=>Yii::t('app','Select Type'))); 
			}
			else
			{
				$leave_type = LeaveTypes::model()->findByAttributes(array('id'=>$model->employee_leave_type_id));
				echo $form->textField($model,'employee_leave_type_id',array('value'=>$leave_type->type,'disabled'=>true));
			}
		?>
		<?php echo $form->error($model,'employee_leave_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
        <?php 
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
		{
			echo $form->textField($model,'reason',array('size'=>30,'maxlength'=>45));
		}
		elseif($year != $current_academic_yr->config_value and $is_edit->settings_value==0)
		{
			echo $form->textField($model,'reason',array('size'=>30,'maxlength'=>45,'disabled'=>true)); 
		}
		?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php 
			if($model->is_half_day ==1)
			{
				$radio_display = 'block';
			}
			else{
				$radio_display = 'none';
			}
		?>
		<?php echo $form->labelEx($model,'is_half_day'); ?>
		<?php 
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
		{
			echo $form->checkBox($model,'is_half_day',array('onChange' => 'javascript:showradio()', 'id'=>'is_half_day')); 
		}
		else
		{
			if($model->is_half_day ==1)
			{
				$value = 'Yes';
			}
			else
			{
				$value = 'No';
			}
			echo $form->textField($model,'employee_leave_type_id',array('value'=>$value,'disabled'=>true));	
		}
		?>
		<?php echo $form->error($model,'is_half_day'); ?>
	</div><br />
	
	<div class="row" id="halfday" style="display:<?php echo $radio_display; ?>">
		<?php 	echo CHtml::radioButtonList('half_session',$model->half,array('1'=>Yii::t('app','Morning Half'),'2'=>Yii::t('app','Afternoon Half')),array(
					'labelOptions'=>array('style'=>'display:inline'), // add this code
					'separator'=>'',
				)); 
		?>
	</div><br/>
	
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php 
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
		{
		echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('EmployeeAttendances/EditLeave','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success")
					{
						$("#td'.$day.$emp_id.'").text("");
						$("#jobDialog123'.$day.$emp_id.'").html("<span class=\"abs\"></span>","");
						$("#jobDialog'.$day.$emp_id.'").dialog("close");
						window.location.reload();
					}else{
						$(".errorMessage").remove();
						var errors	= JSON.parse(data.errors);
						$.each(errors, function(index, value){
							var err	= $("<div class=\"errorMessage\" />").text(value[0]);
							err.insertAfter($("#" + index));
						});
					}
                    }'),array('id'=>'closeJobDialog'.$day.$emp_id,'name'=>'save'));
		}?>
        <?php 
		if(($ac_year == $current_academic_yr->config_value) or ($ac_year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
		{
		
		echo CHtml::ajaxSubmitButton(Yii::t('app','Delete'),CHtml::normalizeUrl(array('EmployeeAttendances/DeleteLeave','render'=>false)),array('success'=>'js: function(data) 														
					{
		                $("#td'.$day.$emp_id.'").text(" ");
		                $("#jobDialog'.$day.$emp_id.'").dialog("close"); window.location.reload();
                    }'),array('confirm'=>Yii::t('app','Are you sure you want to delete this leave ?'),'id'=>'closeJobDialog1'.$day.$emp_id,'name'=>'delete')); 
		}?>
	</div><br />

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	function showradio(){
		if(is_half_day.checked==1){
			$('#halfday').show();
		}
		else {
			$('#halfday').hide();
		}
	}
</script>