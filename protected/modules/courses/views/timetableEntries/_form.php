

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'timetable-entries-form',
	'enableAjaxValidation'=>true,
	//'clientOptions'=>array('validateOnSubmit'=>TRUE),

)); ?>


<p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="errorSummary" id="error_employee" style="display:none; width:360px; height:20px; padding-top:10px;">
	Please fill all the fields!
</div> <br />
   
<div class="formCon" style="width:430px; height:auto;">

<div class="formConInner" style="width:400px;">
<div  style="background:none">

    <?php //echo $form->labelEx($model,'batch_id'); ?>
    <?php echo $form->hiddenField($model,'batch_id',array('value'=>$batch_id)); ?>
		<?php //echo $form->error($model,'batch_id'); ?>
  <?php //echo $form->labelEx($model,'weekday_id'); ?>
    <?php echo $form->hiddenField($model,'weekday_id',array('value'=>$weekday_id)); ?>
		<?php //echo $form->error($model,'weekday_id'); ?>

    <?php //echo $form->labelEx($model,'class_timing_id'); ?>
   <?php echo $form->hiddenField($model,'class_timing_id',array('value'=>$class_timing_id)); ?>
		<?php //echo $form->error($model,'class_timing_id'); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">  
<tr>
  	<td><?php echo $form->labelEx($model,Yii::t('timetable','subject_id'));  ?></td>
    <td><?php echo $form->dropDownList($model,'subject_id',CHtml::listData(Subjects::model()->findAll('batch_id=:x',array(':x'=>$batch_id)),'id', 'name'),
	array('prompt'=>'Select Subject','style'=>'width:200px;','ajax' => array('type'=>'POST','url'=>CController::createUrl('TimetableEntries/dynamiccities'),'update'=>'#TimetableEntries_employee_id'))); ?>
		</td>
  </tr>
  <tr>
  	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <td><?php echo $form->labelEx($model,Yii::t('timetable','employee_id')); ?></td>
  <td><?php echo $form->dropDownList($model,'employee_id', array(),array('prompt'=>'Select Employee','style'=>'width:200px;')); ?>
        
		</td>
  </tr>      
  
</table>


	<div style="padding:20px 0 0 0px; text-align:left">
		

	<?php echo CHtml::ajaxSubmitButton(Yii::t('timetable','Save'),CHtml::normalizeUrl(array('TimetableEntries/settime','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
						if (data.status == "success")
						{
							$("#jobDialog'.$class_timing_id.$weekday_id.'").dialog("close");
							window.location.reload();
						}
						else
						{
							$("#error_employee").show();
							
						}
                    }',
),array('id'=>'closeJobDialog')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div>
</div><!-- form -->