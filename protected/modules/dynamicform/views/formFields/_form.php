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
<div class="creat-forn-fld">
	<div class="txtfld-col">
    	<?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('maxlength'=>255)); ?>
         <?php echo $form->error($model,'title'); ?>
    </div>
    <div class="txtfld-col">
    	<?php echo $form->labelEx($model,'required'); ?>
        <?php echo $form->dropDownList($model,'required',  FormFields::itemAlias('required')); ?>
         <?php echo $form->error($model,'required'); ?>
    </div>
        <div class="txtfld-col">
    	<?php echo $form->labelEx($model,'form_field_type'); ?>
        <?php echo $form->dropDownList($model,'form_field_type',  FormFields::itemAlias('form_field_type'),array('empty'=>Yii::t('app','Select'))); ?>
         <?php echo $form->error($model,'form_field_type'); ?>
    </div>
</div>    
    
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
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
    <tr>
    	<td  headers="10px"></td>
    </tr>
</table>
<div class="creat-forn-fld">
    <div class="txtfld-col">
<?php echo $form->labelEx($model,'tab_selection'); ?>
<?php 
            if(!isset($model->tab_selection) and isset($_GET['FormFields']['tab_selection']) && $_GET['FormFields']['tab_selection']!=NULL)
            {               
                $model->tab_selection= $_GET['FormFields']['tab_selection'];
            }
            
            if(!isset($model->tab_sub_section) and isset($_GET['FormFields']['tab_sub_section']) && $_GET['FormFields']['tab_sub_section']!=NULL)
            {               
                $model->tab_sub_section= $_GET['FormFields']['tab_sub_section'];
            }
            
            $list= FormFields::itemAlias('tab_selection');
            echo $form->dropDownList($model,'tab_selection',$list,array('class'=>'form-control',
                                'prompt' => Yii::t('app','Select'),
                                'ajax' => array(
                                    'type'=>'POST', 
                                    'url'=>Yii::app()->createUrl('/dynamicform/formFields/subtab'), 
                                    'data'=>array('tab_selection'=>'js:this.value', Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
                                    'success'=> 'function(data){
                                        $("#FormFields_tab_sub_section").html(data);
                                        $("#FormFields_tab_sub_section").trigger("chosen:updated");
                                    }',
                                )
                            ));?>
    </div>
        <div class="txtfld-col">
    	<?php echo $form->labelEx($model,'tab_sub_section'); ?>
       <?php echo $form->dropDownList($model,'tab_sub_section',  FormFields::itemAlias('tab_sub_section'),array('empty'=>Yii::t('app','Select'))); ?>
         <?php echo $form->error($model,'tab_sub_section'); ?>
    </div>
</div>

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