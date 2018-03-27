

<div class="form" style="padding-left:20px; height:auto; min-height:350px;">

<br />
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-attendances-form',
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>

	<?php /*?><?php echo $form->errorSummary($model); ?><?php */?>

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
        
		<?php echo $form->labelEx($model,'employee_leave_type_id'); ?>
        <?php echo $form->dropDownList($model,'employee_leave_type_id',CHtml::listData($leave_types, 'id', 'type'),array('empty'=>Yii::t('app','Select Type'),'ajax' => array(
													'type'=>'POST',
													'url'=>CController::createUrl('/employees/employeeAttendances/leaveCheck'),
													'update'=>'#leave_id',
													//'data'=>'js:$(this).serialize()'
													'data'=>array('leave_type'=>'js:this.value', 'employee_id'=>$emp_id),
													),
													
													'options'=>array($_REQUEST['employee_leave_type_id']=>array('selected'=>true)))); ?>
                                                   
		<?php echo $form->error($model,'employee_leave_type_id'); ?>
	</div>
    <div class="del_msg" id="leave_id" style="color:#F00">
    <?php
	
	?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>30,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'reason'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_half_day'); ?>
		<?php echo $form->checkBox($model,'is_half_day',array( 'onChange' => 'javascript:showradio()', 'id'=>'is_half_day')); ?>
		<?php echo $form->error($model,'is_half_day'); ?>
	</div><br />
	
	<div class="row" id="halfday" style="display:none">
		<?php 	echo CHtml::radioButtonList('half_session','1',array('1'=>Yii::t('app','Morning Half'),'2'=>Yii::t('app','Afternoon Half')),array(
					'labelOptions'=>array('style'=>'display:inline'), // add this code
					'separator'=>'',
				)); 
		?>
	</div><br/>
	
	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php 
		
		echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('EmployeeAttendances/Addnew','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
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
		
		?>
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