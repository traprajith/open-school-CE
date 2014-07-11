<style>
	.check{
		width:10px;
	}
	#spec{
		display: none;
	}
</style>
<?php // Display Successfull message. 
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success" style="color:#F00; padding-left:150px; font-size:12px; font-weight:bold;">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sms-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
	
	<?php echo $form->errorSummary($model); ?>
    <div>
   
    <table width="200px">
    	<tr>
        	<td class="check">
              <?php $posts=SmsSettings::model()->findAll(); 
			  		if($posts[0]->is_enabled=='1'){ // Enable SMS for the application
						echo $form->checkBox($model,'enable_app',array('id'=>'enable_app','checked'=>'true'));
					}
					else{
			  			echo $form->checkBox($model,'enable_app',array('id'=>'enable_app')); 
					}?>
                <?php echo $form->error($model,'enable_app'); ?>
            </td>
            <td>Enable SMS</td>
        </tr>
    </table>
	</div><br />
    <div id="spec">
    <table width="200px">
    	<?php /*?><tr>
        	<td class="check">
				<?php if($posts[1]->is_enabled=='1'){ // Enable New SMS
						echo $form->checkBox($model,'enable_news',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_news',array('class'=>'case'));
					}?>
                <?php echo $form->error($model,'enable_news'); ?>
            </td>
            <td>News</td>
        </tr><?php */?>
    	<tr>
        	<td class="check">
				<?php if($posts[2]->is_enabled=='1'){ // Enable Student Admission SMS
						echo $form->checkBox($model,'enable_std_ad',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_std_ad',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_std_ad'); ?>
            </td>
            <td>Student Admission</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[3]->is_enabled=='1'){ // Enable Student Attendance SMS
						echo $form->checkBox($model,'enable_std_atn',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_std_atn',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_std_atn'); ?>
            </td>
            <td>Student Attendance</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[4]->is_enabled=='1'){ // Enable Employee Appoinment SMS
						echo $form->checkBox($model,'enable_emp_apmt',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_emp_apmt',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_emp_apmt'); ?>
            </td>
            <td>Employee Appointment</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[5]->is_enabled=='1'){ // Enable Exam Schedule SMS
						echo $form->checkBox($model,'enable_exm_schedule',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_exm_schedule',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_exm_schedule'); ?>
            </td>
            <td>Exam Schedule</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[6]->is_enabled=='1'){ // Enable Exam Result SMS
						echo $form->checkBox($model,'enable_exm_result',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_exm_result',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_exm_result'); ?>
            </td>
            <td>Exam Result</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[7]->is_enabled=='1'){ // Enable Fees SMS
						echo $form->checkBox($model,'enable_fees',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_fees',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_fees'); ?>
            </td>
            <td>Fees</td>
        </tr>
        <tr>
        	<td class="check">
				<?php if($posts[8]->is_enabled=='1'){ // Enable Library SMS
						echo $form->checkBox($model,'enable_library',array('checked'=>'true'));
					}
					else{
						echo $form->checkBox($model,'enable_library',array('class'=>'case')); 
					}?>
                <?php echo $form->error($model,'enable_library'); ?>
            </td>
            <td>Library</td>
        </tr>
    </table>
    </div>
	<?php /*?><div class="row">
		<?php echo $form->labelEx($model,'settings_key'); ?>
		<?php echo $form->textField($model,'settings_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'settings_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_enabled'); ?>
		<?php echo $form->textField($model,'is_enabled'); ?>
		<?php echo $form->error($model,'is_enabled'); ?>
	</div><?php */?>
	<br />
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save Settings' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript"> /* Checking and unchecking the SMS checkboxes. */
	$(document).ready(function(){
	if ($('#enable_app').attr('checked')) { /* Display the list of checkboxes on page load, if SMS is enabled. */
           $("#spec").css("display","block");
     }
	 else{
		 $("#spec").css("display","none");
	 }
	 
	 $("#enable_app").change(function(){ /* Display/Hide the list of checkboxed on enabling/disabling of SMS */
		  if (this.checked) {
			$("#spec").css("display","block");
			$('.case').attr('checked', true);
		  }
		  else{
			$("#spec").css("display","none");
			$('.case').attr('checked', false);
		  }
	  });
	}); 
</script>