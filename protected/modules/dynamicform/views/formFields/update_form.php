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
        <td><?php echo $form->labelEx($model,'title'); ?></td>
        <td><?php echo $form->textField($model,'title',array('size'=>30,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?></td>        

        <td><?php echo $form->labelEx($model,'required'); ?></td>
        <td><?php echo $form->dropDownList($model,'required',  FormFields::itemAlias('required')); ?>
            <?php echo $form->error($model,'required'); ?></td>                    
    </tr>
        
    
   
    <tr>        
        <td colspan="2"><h3><?php echo Yii::t('app','Select Visible Areas');?></h3></td>
       
    </tr>
    <tr>
         <td><input type="checkbox" name="select-all" id="select-all" /><?php echo Yii::t('app','Check All');?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'admin_student_reg_form',array('class'=>'select_all_master'));?><?php echo Yii::t('app','Admin Student Registration Form');?>           
            <?php echo $form->error($model,'admin_student_reg_form'); ?></td>
    </tr>
    <tr>        
        <td colspan="2"><?php echo $form->checkBox($model,'online_admission_form',array('class'=>'select_all_master'));?><?php echo Yii::t('app','Online Admission Form');?>           
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
    
    
    
    
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<script>
$( document ).ready(function() 
{
    var a= $('.select_all:checked').size();
    var b= $('.select_all_master:checked').size();
    
    var c= a+b;
   
        if(c>6)
        {
                $('#select-all').attr('checked', true);
        }
        else
        {
                $('#select-all').attr('checked', false);
        }    
        
        if(b<1)
        {
            $('#select-all').attr('checked', false);                
            $('.select_all').removeAttr("checked");
            $('.select_all').attr('disabled', 'disabled');
          //  $('#select-all').attr('disabled', 'disabled');
        }
});

$('#select-all').click(function(event) {   
    if(this.checked) 
    {     
        
        $('.select_all').removeAttr('disabled');
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
$('.select_all').change(function()
{
    var a= $('.select_all:checked').size();
    var b= $('.select_all_master:checked').size();
    var c= a+b;
    
        if(c>6)
        {
                $('#select-all').attr('checked', true);
        }
        else
        {
                $('#select-all').attr('checked', false);
        } 
});
$('.select_all_master').change(function()
{
    var a= $('.select_all:checked').size();
    var b= $('.select_all_master:checked').size();
    var c= a+b;
    
        if(c>6)
        {
                $('#select-all').attr('checked', true);
        }
        else
        {
                $('#select-all').attr('checked', false);
        } 
        
        if(b<1)
        {
            $('#select-all').attr('checked', false);                
            $('.select_all').removeAttr("checked");
            $('.select_all').attr('disabled', 'disabled');
            //$('#select-all').attr('disabled', 'disabled');
        }
        else
        {          
           $('.select_all').removeAttr('disabled');
           $('#select-all').removeAttr('disabled');
        }
});
</script>