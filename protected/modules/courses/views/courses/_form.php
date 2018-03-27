

<div class="formCon">

<div class="formConInner">

<div>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required.');?></p>	    
    <table width="80%" border="0" cellspacing="0" cellpadding="0">    
        <tr>
            <td width="200"><?php echo $form->labelEx($model,'course_name'); ?></td>
            <td><?php echo $form->textField($model,'course_name',array('encode'=>false,'size'=>40,'maxlength'=>100)); ?>
            <?php echo $form->error($model,'course_name'); ?></td>
        </tr>
        
        <?php
		   $sem_enabled	=	Configurations::model()->isSemesterEnabled();
		   if($sem_enabled==1)
		   {
		 ?>
         <tr><td colspan="2">&nbsp;</td></tr>
        <tr>
        	<td width="200"><?php echo $form->labelEx($model,'semester_enabled'); ?></td>
            <td><?php echo $form->checkBox($model,'semester_enabled'); ?>
            <?php echo $form->error($model,'semester_enabled'); ?></td>
        </tr>
        
        <?php
		   }
		 ?>
         
         
         <?php if(Configurations::model()->timetableConfig()==-1){ // timetable format is selected as course level ?>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td width="200"><?php echo $form->labelEx($model,'timetable_format'); ?></td>
                <td>
					<?php echo $form->radioButton($model,'timetable_format', array('value'=>1, 'id'=>'timetable_format_1'))." ".CHtml::label(Yii::t('app', 'Fixed Class Timings'), 'timetable_format_1'); ?>
                    <?php echo $form->radioButton($model,'timetable_format', array('value'=>2, 'uncheckValue'=>1, 'id'=>'timetable_format_2'))." ".CHtml::label(Yii::t('app', 'Flexible Class Timings'), 'timetable_format_2'); ?>
              	</td>
            </tr>
      	<?php }?>
         
        
<?php        
		$level = Configurations::model()->findByPk(41);
        if($level->config_value == -1){ 
?>		    <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td><?php echo $form->labelEx($model,'exam_format'); ?></td>
                <td><?php echo $form->radioButton($model, 'exam_format', array('value'=>'1','uncheckValue'=>1)).Yii::t("app", "Default");
                echo $form->radioButton($model, 'exam_format', array('value'=>'2','uncheckValue'=>1))." ".Yii::t("app", "CBSE"); ?>
                <?php echo $form->error($model,'exam_format'); ?></td>
            </tr>
            
<?php         
		}
?>         <tr><td colspan="2">&nbsp;</td></tr>
        
    </table>
<?php 
	$daterange=date('Y')+20;
 	$daterange_1=date('Y')-30;
	
	echo $form->hiddenField($model,'is_deleted');
	if(Yii::app()->controller->action->id == 'create'){
		 echo $form->hiddenField($model,'created_at',array('value'=>date('Y-m-d'))); 
	}
	else{
		 echo $form->hiddenField($model,'created_at'); 
	}
	
	echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d'))); 
?>
	
    <!-- Batch Form Ends -->
	<div style="padding:0px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
	</div>
</div><!-- form -->