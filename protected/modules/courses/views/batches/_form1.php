<style>
    .ui-widget label{
        font-size: 14px !important;
    }
	.timetable_formats label{
		font-weight:300 !important;
		display:inline;
		font-size:12px !important;
	}
	.popup-input input[type="text"], textArea, select {
    width: 100% !important;
    box-sizing: border-box;
}
.poup-checkbox input[type="text"]{
	width:auto !important;
	 display:inline-block !important;	
}
.popup-box {
    background-color: #EAF5FD;
    border: 1px solid #a3c5e0;
    margin-top: 10px;
    padding: 9px;
	margin-bottom:10px;
}
.popup-input table td {
    width: 100%;
    font-size: 12px;
}

.timetable_formats label{
	display:inline;
}
</style>
<div class="popup-input">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batches-form',
	)); ?>

	<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".success_msg").animate({opacity: 1.0}, 4000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>

	<span id="success_msg" class="success_msg" style="font-size:14px; color:#C00; font-weight:bold; padding-left:20px; padding-top:5px;"></span>
	<p style="padding-left:20px;"><?php echo Yii::t('app','Fields with');?><span class="required"> * </span><?php echo Yii::t('app','are required');?></p>
<div class="fancy_box_form1">
	<?php echo $form->errorSummary($model); ?>

 
 
 
 

  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'name'); ?></td>
</tr>
<tr>
    <td><div><?php echo $form->textField($model,'name',array('encode'=>false,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></div></td>
  </tr>

  <tr>
    <td><?php echo $form->labelEx($model,'start_date'); ?></td>
    </tr>
<tr>

    <td><div><?php $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
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
									'yearRange'=>'1900:'
								),
								'htmlOptions'=>array(
									
									'readonly'=>'readonly'									
								),
							));?>
		<?php echo $form->error($model,'start_date'); ?></div></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'end_date'); ?></td>
    </tr>
    <tr>

    <td><div><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
									
									'readonly'=>'readonly'
								),
							)); ?>
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
    <td><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll($criteria),'id','concatened'),array('empty' => Yii::t('app','Select Class Teacher'))); ?>
		<?php echo $form->error($model,'employee_id'); ?></td>
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
    	<tbody>
<tr>
    <td><?php echo $form->labelEx($model,'timetable_format'); ?></td>
    </tr>
    <tr>
    <td class="timetable_formats fancy-box-block-checkd">
    <?php echo $form->radioButton($model,'timetable_format', array('value'=>1, 'id'=>'timetable_format_1'))." ".CHtml::label(Yii::t('app', 'Fixed Class Timings'), 'timetable_format_1'); ?>
    <br/>
    <?php echo $form->radioButton($model,'timetable_format', array('value'=>2, 'uncheckValue'=>1, 'id'=>'timetable_format_2'))." ".CHtml::label(Yii::t('app', 'Flexible Class Timings'), 'timetable_format_2'); ?>
    </td>
    </tr>
        </tbody>
    </table>
</td>
</tr>
    
    
    
      	<?php }?>
  
   <?php $level = Configurations::model()->findByPk(41);
	 if($level->config_value == -2)
	 { ?> 
<tr>
<td>
	<table class="popup-box poup-checkbox" width="100%">
    	<tbody>
  <tr>
    <td ><?php echo $form->labelEx($model,'exam_format'); ?></td>
</tr>
<tr>

    <td><div><?php echo $form->radioButton($model, 'exam_format', array('value'=>'1','uncheckValue'=>null))."Default ";
 			  echo $form->radioButton($model, 'exam_format', array('value'=>'2','uncheckValue'=>null))." CBSE"; ?>
		<?php echo $form->error($model,'exam_format'); ?></div></td>
  </tr>
        </tbody>
        </table>
        </td>
        </tr>
        


   <?php } ?>

  <tr>
  	
    <td class="popup_btn"><?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php	
		
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'),CHtml::normalizeUrl(array('batches/Addupdate&val1='.$batch_id,'render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success")
					{
					 $("#success_msg").html("'.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','updated successfully!').'");	
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
                       
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit')));
		?></td>
    <td>&nbsp;</td>

  </tr>
</table>
</div>

	
		<?php //echo $form->labelEx($model,'course_id'); 
		?>
		<?php echo $form->hiddenField($model,'course_id',array('value'=>$val1)); ?>
		<?php echo $form->error($model,'course_id'); ?>
	
		<?php //echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->hiddenField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	
		<?php //echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->hiddenField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
	
		<?php //echo $form->labelEx($model,'employee_id'); ?>
		<?php /*?><?php echo $form->textField($model,'employee_id',array('value'=>1)); ?>
		<?php echo $form->error($model,'employee_id'); ?><?php */?>
	

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->