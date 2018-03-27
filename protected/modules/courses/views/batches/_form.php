<style>
.success  {background-color:#fff !important ;}
.timetable_formats label{
	display:inline;
}
.popup-input input[type="text"], textArea, select{
	 width:100% !important;
	 box-sizing:border-box;

}

.popup-input input[type="submit"], button{
	 width:100% !important;	
}
.popup-input table td{ width:100%; font-size: 12px;
}
.popup-box{
    background-color: #EAF5FD;
    border: 1px solid #a3c5e0;
    margin-top: 10px;
    padding: 9px;
	margin-bottom:10px;	
}
.popup-box td label{
		 color:#3E719B;
}
</style>

<div class="popup-input">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batches-form',
	//'enableAjaxValidation'=>true,
)); ?>

	<p><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app','are required.');?></p>
	<?php echo $form->errorSummary($model); ?>
    <?php $daterange=date('Y');
 		 $daterange_1=$daterange+20;?>
    <div style="width:100%" >
    <div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'name'); ?></td>
</tr>
<tr>
    <td ><div><?php echo $form->textField($model,'name',array('maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></div></td>
  </tr>

  <tr>
    <td><?php echo $form->labelEx($model,'start_date'); ?></td>
    </tr>
    <tr>

    <td><div>
    <?php
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{
				$date=$settings->dateformat;
		
		
			}
			else
			$date = 'dd-mm-yy';	
   				
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								//'name'=>'Students[admission_date]',
								'model'=>$model,
								'attribute'=>'start_date',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.(date('Y')+30),
								),
								'htmlOptions'=>array(
									'readonly'=>'readonly',
								),
							));
    ?>
		<?php echo $form->error($model,'start_date'); ?></div></td>
  </tr>

  <tr>
    <td><?php echo $form->labelEx($model,'end_date'); ?></td>
    </tr>
    <tr>
    <td><div>
    <?php		
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								//'name'=>'Students[admission_date]',
								'model'=>$model,
								'attribute'=>'end_date',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.(date('Y')+30),
								),
								'htmlOptions'=>array(
									'readonly'=>'readonly',
								),
							));
   				
    ?>
    <?php echo $form->error($model,'end_date'); ?></div></td>
  </tr>

  <tr>
    <td><?php echo $form->labelEx($model,'employee_id'); ?></td>
   </tr>
     <?php
        $criteria=new CDbCriteria;
        $criteria->condition='is_deleted=:is_del';
        $criteria->params=array(':is_del'=>0);
    ?>
    <tr>
    <td><div><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll($criteria),'id','concatened'),array('empty' => Yii::t('app','Select Class Teacher'))); ?>
    <?php echo $form->error($model,'employee_id'); ?></div></td>
  </tr>
  <?php 
  $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($val1);
  if($sem_enabled==1){
  ?>  

  <tr>
    <td><?php echo $form->labelEx($model,'semester_id'); ?></td>
  </tr>
     <?php
        $criteria=new CDbCriteria;
        $criteria->join= 'JOIN semester_courses `sc` ON t.id = `sc`.semester_id';
        $criteria->condition='`sc`.course_id =:course_id';
        $criteria->params=array(':course_id'=>$val1);
        
    ?>
    <tr>
    <td><div><?php echo $form->dropDownList($model,'semester_id',CHtml::listData(Semester::model()->findAll($criteria),'id','name'),array('empty' => Yii::t('app','Select Semester'))); ?>
    <?php echo $form->error($model,'semester_id'); ?></div></td>
  </tr>
  <?php } ?>

  
  		<?php if(Configurations::model()->timetableConfig()==-2){ // timetable format is selected as course level ?>

<tr>
	<td>
<table class="popup-box" width="100%">
<tr>
    
        <td ><?php echo $form->labelEx($model,'timetable_format'); ?></td>
        </tr>
<tr>
        <td class="timetable_formats">
            <?php echo $form->radioButton($model,'timetable_format', array('value'=>1, 'id'=>'timetable_format_1'))." ".CHtml::label(Yii::t('app', 'Fixed Class Timings'), 'timetable_format_1'); ?>
            <br/>
            <?php echo $form->radioButton($model,'timetable_format', array('value'=>2, 'uncheckValue'=>1, 'id'=>'timetable_format_2'))." ".CHtml::label(Yii::t('app', 'Flexible Class Timings'), 'timetable_format_2'); ?>
        </td>
          <tr>
</table>
    </td>
</tr>

      	<?php }?>
  
  <?php $level = Configurations::model()->findByPk(41);
	 if($level->config_value == -2)
	 { ?> 
  

<tr>
	<td>
    <table class="popup-box" width="100%">
 <tr>       
    <td><?php echo $form->labelEx($model,'exam_format'); ?></td>
    </tr>
    <tr>
    <td width="45%" class="timetable_formats"><div><?php echo $form->radioButton($model, 'exam_format', array('value'=>'1','uncheckValue'=>null))." ".CHtml::label(Yii::t('app',"Default"));?>
    <br />
	<?php 
 			  echo $form->radioButton($model, 'exam_format', array('value'=>'2','uncheckValue'=>1))." ".CHtml::label(Yii::t('app',"CBSE")); ?>
		<?php echo $form->error($model,'exam_format'); ?></div></td>
  </tr>
    </table>
    </td>
    </tr>
    
  <?php }
 ?>
  

 <?php
	$criteria1 = new CDbCriteria;
	$criteria1->condition = 'course_id=:course_id and is_active=:is_active and is_deleted=:is_deleted';
	$criteria1->params = array(':course_id'=>$val1,':is_active'=>1,':is_deleted'=>0);
	$all_batches = Batches::model()->findAll($criteria1);
	if($model->isNewRecord and $all_batches!=NULL){ ?> 
  <tr>        
      <td colspan="4">
	    <table class="popup-box" width="100%">
 			<tr>
           	 <td>
					<?php echo $form->checkBox($model,'duplicate'); ?><?php echo Yii::t('app','Duplicate Subjects or/and Electives From Another').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?>
                    
                    <span id="click_div" style=" color:#0099FF; cursor:pointer" class="fa fa-exclamation-circle"></span>
                    <p id="open_div" style="display: none; padding:9px; line-height:20px;" class="yb_import">
                    <?php echo Yii::t('app','Select the checkbox to add the subjects, electives and their association with teachers from a different').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','to the new').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<br>'.Yii::t('app','If unchecked, the system will pick the common subjects created for this particular course.');?>
                    </p>
             </td>
            </tr>
            <tr class="batch_list_block">
                <td>
                <table width="100%">
                <tr>
                <td><?php echo $form->labelEx($model,Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'<span style="color:#F00">*</span>'); ?>				</td>
            </tr>
            <tr>
                <td>
					<?php   echo $form->dropDownList($model,'batch_list',CHtml::listData($all_batches,'id','name'),array('encode'=>false));  ?>
                    <?php echo $form->error($model,'batch_list'); ?>
                </td>
            </tr>
            </table>
            </td>
            </tr>
            <tr class="batch_list_block">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr class="batch_list_block">
                <td colspan="4">
                <?php echo $form->checkBox($model,'all'); ?>
                <?php echo Yii::t('app','All'); ?>
				<?php echo $form->checkBox($model,'subject',array('class'=>'duplicatecheck')); ?>
                <?php echo Yii::t('app','Subject'); ?>
                <?php echo $form->checkBox($model,'electives',array('class'=>'duplicatecheck')); ?>
                <?php echo Yii::t('app','Electives'); ?>
                <?php echo $form->checkBox($model,'subject_ass',array('class'=>'duplicatecheck')); ?>
                <?php echo Yii::t('app','Subject Association'); ?>
                <?php echo $form->checkBox($model,'classtimimg',array('class'=>'duplicatecheck')); ?>
                <?php echo Yii::t('app','Class Timings'); ?>
                <?php echo $form->checkBox($model,'timetable',array('class'=>'duplicatecheck')); ?>
                <?php echo Yii::t('app','Timetable'); ?>   
                <?php
               /* $model->duplicate_options = 1;
				
                echo $form->radioButtonList($model,'duplicate_options',array('1'=>Yii::t('app','All'), '2'=>Yii::t('app','Subjects'), '3'=>Yii::t('app','Electives')),array('separator'=>'','labelOptions'=>array('style'=>'display:inline'))); 
                echo $form->error($model,'duplicate_options');*/
                ?>
                </td>
            </tr>
            <?php } ?>  
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
        </table> 
	  </td>  
  </tr> 
  <tr>
    <td><?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        
        <?php	echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('batches/create','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success")
					{
					 $("#jobDialog").dialog("close");
					 
						 window.location.reload();	 
					 
					}
					else{
						$(".errorMessage").remove();
						var errors	= JSON.parse(data.errors);						
						$.each(errors, function(index, value){
							var err	= $("<div class=\"errorMessage\" />").text(value[0]);
							err.insertAfter($("#" + index));
						});
					}
                       
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit'))); ?></td>
    <td>&nbsp;</td>
    
    <td>
	</td>
  </tr>
</table>
</div>
</div>
	
		<?php //echo $form->labelEx($model,'course_id'); 
		?>
		<?php echo $form->hiddenField($model,'course_id',array('value'=>$val1)); ?>
		<?php echo $form->error($model,'course_id'); ?>
	
		<?php //echo $form->labelEx($model,'course_id'); 
		?>
		<?php echo $form->hiddenField($model,'academic_yr_id',array('value'=>$academic_yr_id)); ?>
		<?php echo $form->error($model,'academic_yr_id'); ?>
	
		<?php //echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->hiddenField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	
		<?php //echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->hiddenField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
	

	
		<?php //echo $form->labelEx($model,'employee_id'); ?>
		<?php /*?><?php echo $form->textField($model,'employee_id',array('value'=>1)); ?><?php */?>
        <?php /*?><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll(),'id','concatened'),array('empty' => 'Assign Class Teacher')); ?>
		<?php echo $form->error($model,'employee_id'); ?><?php */?>
	

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$('.batch_list_block').hide();
$('#Batches_duplicate').change(function(ev){
	if(this.checked == true){
		$('.batch_list_block').show();
	}else{
		$('.batch_list_block').hide();
	}
});


$( "#click_div" ).click(function() {
  $( "#open_div" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});
	
$("#Batches_subject_ass").attr("disabled", true);
$("#Batches_timetable").attr("disabled", true);

//all
$('#Batches_all').change(function(ev){
	if(this.checked == true){
		$("#Batches_subject_ass").attr("disabled", false);
		$("#Batches_timetable").attr("disabled", false);
	}else{
		$("#Batches_subject_ass").attr("disabled", true);
		$("#Batches_timetable").attr("disabled", true);		
	}
	if(this.checked == true){
		$('#Batches_subject').prop('checked', true);
		$('#Batches_electives').prop('checked', true);
		$('#Batches_subject_ass').prop('checked', true);
		$('#Batches_classtimimg').prop('checked', true);
		$('#Batches_timetable').prop('checked', true);
	}else{
		$('#Batches_subject').prop('checked', false);
		$('#Batches_electives').prop('checked', false);
		$('#Batches_subject_ass').prop('checked', false);
		$('#Batches_classtimimg').prop('checked', false);
		$('#Batches_timetable').prop('checked', false);
	}
});
//subject
$('#Batches_subject').change(function(ev){
	if(this.checked == true){
		$("#Batches_subject_ass").attr("disabled", false);
	}else if($('#Batches_electives').prop('checked') == true){
		$("#Batches_subject_ass").attr("disabled", false);
	}else{
		$('#Batches_subject_ass').prop('checked', false);
		$("#Batches_subject_ass").attr("disabled", true);
		$('#Batches_timetable').prop('checked', false);
		$("#Batches_timetable").attr("disabled", true);
	} 	
	if($('.duplicatecheck:checked').size() > 4){
		$('#Batches_all').prop('checked', true);
	}
	else{ 
		$('#Batches_all').prop('checked', false);
	}
});
//elective
$('#Batches_electives').change(function(ev){
	if(this.checked == true){
		$("#Batches_subject_ass").attr("disabled", false);
	}else if($('#Batches_subject').prop('checked') == true){
		$("#Batches_subject_ass").attr("disabled", false);
	}else{
		$('#Batches_subject_ass').prop('checked', false);
		$("#Batches_subject_ass").attr("disabled", true);
		$('#Batches_timetable').prop('checked', false);
		$("#Batches_timetable").attr("disabled", true);
	}
	if($('.duplicatecheck:checked').size() > 4){
		$('#Batches_all').prop('checked', true);
	}
	else{ 
		$('#Batches_all').prop('checked', false);
	}
});
//subject association
$('#Batches_subject_ass').change(function(ev){
	
	if(this.checked == true && $('#Batches_classtimimg').prop('checked') == true){
		$("#Batches_timetable").attr("disabled", false);
	}else{
		$('#Batches_timetable').prop('checked', false);
		$("#Batches_timetable").attr("disabled", true);
	} 
	
	if($('.duplicatecheck:checked').size() > 4){
		$('#Batches_all').prop('checked', true);
	}
	else{ 
		$('#Batches_all').prop('checked', false);
	}
});
//classtiming
$('#Batches_classtimimg').change(function(ev){
	if(this.checked == true  && $('#Batches_subject_ass').prop('checked') == true){
		$("#Batches_timetable").attr("disabled", false);
	}else{
		$('#Batches_timetable').prop('checked', false);
		$("#Batches_timetable").attr("disabled", true);
	} 
	
	if($('.duplicatecheck:checked').size() > 4){
		$('#Batches_all').prop('checked', true);
	}
	else{ 
		$('#Batches_all').prop('checked', false);
	}
});
//timetable
$('#Batches_timetable').change(function(ev){
	if($('.duplicatecheck:checked').size() > 4){
		$('#Batches_all').prop('checked', true);
	}
	else{ 
		$('#Batches_all').prop('checked', false);
	}
});
</script>