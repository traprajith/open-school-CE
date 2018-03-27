<style type="text/css">
.formCon input[type="text"], input[type="password"], textArea, select {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 100%!important;
}

.select-style select{ width:135% !important}

.formCon select{background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 93% !important;
}
	
.formCon input[type="text"] {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 175px !important;
}
.formbut{
	padding: 10px 15px;
}
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-previous-datas-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
    <p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app','are required.'); ?></p>
    <div class="formCon" >
        <div class="formConInner">
            <h3><?php echo Yii::t('app','Institution Details'); ?> </h3>
            <?php if(FormFields::model()->isVisible('institution','StudentPreviousDatas','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'institution'); ?>
                    <?php echo $form->textField($model,'institution',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('year','StudentPreviousDatas','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'year'); ?>
                    <?php echo $form->dropDownList($model,'year',$model->getYears(),array('prompt'=>Yii::t('app','Select'))); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('course','StudentPreviousDatas','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'course'); ?>
                    <?php echo $form->textField($model,'course',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('total_mark','StudentPreviousDatas','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'total_mark'); ?>
                    <?php echo $form->textField($model,'total_mark',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <!-- dynamic fields -->
            <?php
				$fields 	= FormFields::model()->getDynamicFields(4, 1, "forAdminRegistration");
				foreach ($fields as $key => $field) {
					if($field->form_field_type!=NULL){
						$this->renderPartial("application.modules.dynamicform.views.fields.admin-form._field_".$field->form_field_type, array('model'=>$model, 'field'=>$field));                                                
					}                                               
				}
            ?>
            <!-- dynamic fields -->            
        	<div class="clear"></div>
        </div>
    </div>	
    <input type="hidden" name="which_btn" id="which_btn" />			
	<?php echo $form->hiddenField($model,'student_id',array('value'=>$_REQUEST['id'])); ?>
	
	<div style="padding:0px 0 0 0px;text-align:left;">    
		<?php 
			if(Yii::app()->controller->action->id=='create' and !isset($_REQUEST['status'])){
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save and Add Another') : Yii::t('app','Save'),array('id'=>'ant_btn','class'=>''));
?>
				<div style="float:right;">
<?php				
					echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save and Continue') : Yii::t('app','Save'),array('class'=>'')).'&nbsp;';
								
					echo CHtml::link(Yii::t('app',"Next"),array('/students/studentDocument/create','id'=>$_REQUEST['id']),array('class'=>'formbut-n'));  
?>
				</div>
<?php			
			}
			else{
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'),array('class'=>''));
			}
						
		?>
	</div>	
<?php $this->endWidget(); ?>
<script type="text/javascript">
$('#which_btn').val('0');
$('#ant_btn').click(function(ev) {
	$('#which_btn').val('1');
});
</script>