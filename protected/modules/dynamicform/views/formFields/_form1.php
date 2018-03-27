<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span> <?php echo Yii::t('app','are required.') ;?></p>
<style>
    
.formCon td {
    padding: 5px;
}
    </style>
<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formfields-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php //echo $form->errorSummary($model); ?>
<table width="90%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td><?php echo $form->labelEx($model,'varname'); ?></td>
        <td><?php echo $form->textField($model,'varname',array('size'=>30,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'varname'); ?></td>
        <td><?php echo $form->labelEx($model,'form_field_type'); ?></td>
        <td><?php echo $form->dropDownList($model,'form_field_type',  FormFields::itemAlias('form_field_type'),array('empty'=>Yii::t('app','Select'))); ?>
            <?php echo $form->error($model,'form_field_type'); ?></td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model,'title'); ?></td>
        <td><?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?></td>        

        <td><?php echo $form->labelEx($model,'required'); ?></td>
        <td><?php echo $form->dropDownList($model,'required',  FormFields::itemAlias('required')); ?>
            <?php echo $form->error($model,'required'); ?></td>                    
    </tr>
        
    <tr>
        <td><?php echo $form->labelEx($model,'field_size'); ?></td>
        <td><?php echo $form->textField($model,'field_size',array('size'=>30,'maxlength'=>15)); ?>
            <?php echo $form->error($model,'field_size'); ?></td>
        <td><?php echo $form->labelEx($model,'model'); ?></td>
        <td><?php echo $form->dropDownList($model,'model',FormFields::itemAlias('model')); ?>
            <?php echo $form->error($model,'model'); ?></td>
        
        
    </tr>
    <tr>
        
            <td><?php echo $form->labelEx($model,'field_size_min'); ?></td>
        <td><?php echo $form->textField($model,'field_size_min',array('size'=>30,'maxlength'=>15)); ?>
            <?php echo $form->error($model,'field_size_min'); ?></td>
            <td><?php echo $form->labelEx($model,'field_type'); ?></td>
        <td><?php echo $form->dropDownList($model,'field_type',  FormFields::itemAlias('field_type'),array('empty'=>Yii::t('app','Select'))); ?>
            <?php echo $form->error($model,'field_type'); ?></td>
        

    </tr>
    <tr>        
        <td colspan="2"><h3><?php echo Yii::t('app','Select Visible Areas');?></h3></td>
        <td><input type="checkbox" name="select-all" id="select-all" /><?php echo Yii::t('app','Check All');?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'admin_student_reg_form',array('class'=>'select_all'));?><?php echo Yii::t('app','Admin Student Registration Form');?>           
            <?php echo $form->error($model,'admin_student_reg_form'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'online_admission_form',array('class'=>'select_all'));?><?php echo Yii::t('app','Online Admission Form');?>           
            <?php echo $form->error($model,'online_admission_form'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'parent_portal',array('class'=>'select_all'));?><?php echo Yii::t('app','Parent Portal');?>           
            <?php echo $form->error($model,'parent_portal'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'student_profile',array('class'=>'select_all'));?><?php echo Yii::t('app','Student Profile');?>           
            <?php echo $form->error($model,'student_profile'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'student_profile_pdf',array('class'=>'select_all'));?><?php echo Yii::t('app','Student Profile PDF');?>           
            <?php echo $form->error($model,'student_profile_pdf'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'student_portal',array('class'=>'select_all'));?><?php echo Yii::t('app','Student Portal');?>           
            <?php echo $form->error($model,'student_portal'); ?></td>
    </tr>
    
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'teacher_portal',array('class'=>'select_all'));?><?php echo Yii::t('app','Teacher Portal');?>           
            <?php echo $form->error($model,'teacher_portal'); ?></td>
    </tr>
    
    <tr>
        <td><?php echo $form->labelEx($model,'tab_selection'); ?></td>
        <td>
            <?php 
            $list= FormFields::itemAlias('tab_selection');
            echo $form->dropDownList($model,'tab_selection',$list,array('class'=>'form-control',
                                'prompt' => Yii::t('app','Select'),
                                'ajax' => array(
                                    'type'=>'POST', 
                                    'url'=>Yii::app()->createUrl('/dynamicform/formfields/subtab'), 
                                    'data'=>array('tab_selection'=>'js:this.value'),
                                    'success'=> 'function(data){
                                        $("#FormFields_tab_sub_section").html(data);
                                        $("#FormFields_tab_sub_section").trigger("chosen:updated");
                                    }',
                                )
                            ));?>

            <?php //echo $form->dropDownList($model,'tab_selection',  FormFields::itemAlias('tab_selection'),array('empty'=>'Select')); ?>
            <?php echo $form->error($model,'tab_selection'); ?></td>
        <td><?php echo $form->labelEx($model,'tab_sub_section'); ?></td>
        <td><?php echo $form->dropDownList($model,'tab_sub_section',  FormFields::itemAlias('tab_sub_section'),array('empty'=>Yii::t('app','Select'))); ?>
            <?php echo $form->error($model,'tab_sub_section'); ?></td>
    </tr>
    <tr>
       
        <td><?php echo $form->labelEx($model,'is_dynamic'); ?></td>
        <td><?php echo $form->dropDownlist($model,'is_dynamic',array('0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes'))); ?>
            <?php echo $form->error($model,'is_dynamic'); ?></td>
            <td><?php echo $form->labelEx($model,'is_exception'); ?></td>
        <td><?php echo $form->dropDownlist($model,'is_exception',array('0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes'))); ?>
            <?php echo $form->error($model,'is_exception'); ?></td>
    </tr>
    
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<script>
$('#select-all').click(function(event) {   
    if(this.checked) 
    {       
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
    else
    {
        $(':checkbox').each(function() {
            this.checked = false;                        
        });
    }
});
</script>