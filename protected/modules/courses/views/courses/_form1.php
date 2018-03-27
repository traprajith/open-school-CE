<style>
.ui-widget{
	width: 531px !important; 
}

.timetable_formats label{
	display:inline;
}
</style>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p><?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required.');?></p>

	<?php echo $form->errorSummary($model); ?>
        
    
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="200"><?php echo $form->labelEx($model,'course_name'); ?></td>                
                <td ><?php echo $form->textField($model,'course_name',array('encode'=>false,'size'=>30,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'course_name'); ?></td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr> 
            <?php
			   $sem_enabled		=	Configurations::model()->isSemesterEnabled();
			   if($sem_enabled==1)
			   { 
			      $course_val	=	Courses::model()->findByPk($val1);
			      $course_id	=	$course_val->id;
			      $cou_enabled  =	Configurations::model()->isSemesterEnabledForCourse($course_id);
				  if($cou_enabled==1)
				   {
			 ?>
                <tr>
                    <td width="200"><?php echo $form->labelEx($model,'semester_enabled'); ?></td>
                    <td><?php echo $form->checkBox($model,'semester_enabled'); ?>
                    <?php echo $form->error($model,'semester_enabled'); ?></td>
                </tr>
                <?php
				   }
				   else
				   {
				 ?>
                     <tr>
                        <td width="200"><?php echo $form->labelEx($model,'semester_enabled'); ?></td>
                        <td><?php echo $form->checkBox($model,'semester_enabled'); ?>
                        <?php echo $form->error($model,'semester_enabled'); ?></td>
                    </tr>
			<?php
				   }
               }
             ?>
             
			<?php if(Configurations::model()->timetableConfig()==-1){  // timetable format is selected as course level ?>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td width="200"><?php echo $form->labelEx($model,'timetable_format'); ?></td>
                    <td class="timetable_formats">
                        <?php echo $form->radioButton($model,'timetable_format', array('value'=>1, 'id'=>'timetable_format_1'))." ".CHtml::label(Yii::t('app', 'Fixed Class Timings'), 'timetable_format_1'); ?>
                        <br/>
                        <?php echo $form->radioButton($model,'timetable_format', array('value'=>2, 'uncheckValue'=>1, 'id'=>'timetable_format_2'))." ".CHtml::label(Yii::t('app', 'Flexible Class Timings'), 'timetable_format_2'); ?>
                    </td>
                </tr>
            <?php }?>
             
        <tr><td colspan="2">&nbsp;</td></tr>                       
            <?php $level = Configurations::model()->findByPk(41);
            if($level->config_value == -1)
            { ?> 
            
                <tr>
                    <td><?php echo $form->labelEx($model,'exam_format'); ?></td>
                    <td><?php echo $form->radioButton($model, 'exam_format', array('value'=>'1','uncheckValue'=>null))."Default ";
                    echo $form->radioButton($model, 'exam_format', array('value'=>'2','uncheckValue'=>null))." CBSE"; ?>
                    <?php echo $form->error($model,'exam_format'); ?></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr> 
            <?php } ?>
                          
            <tr>            
                <td>
					<?php	echo CHtml::ajaxSubmitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'),CHtml::normalizeUrl(array('courses/Edit&val1='.$val1,'render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
                    if(data.status=="success"){
                    $("#jobDialog11").dialog("close");  window.location.reload();
                    alert("'.Yii::t('courses','Course Updated Successfully.').'");
                    }
                    
                    }'),array('id'=>'closeJobDialog12','name'=>'Submit')); ?>
                </td>
            </tr>
            <?php $this->renderPartial('_flash',array('model'=>$model,'id'=>'jobDialog')); ?>
        </table>
	
    
    <?php 
		echo $form->hiddenField($model,'is_deleted'); 
		echo $form->hiddenField($model,'created_at');
		echo $form->hiddenField($model,'updated_at',array('value'=>date('d-m-Y')));
	?>	
<?php $this->endWidget(); ?>

