<style type="text/css">
.ui-widget-content{ 
	height:300px;	
}

<?php /*?>.formCon input[type="text"], input[type="password"], textArea, select {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 100% !important;
}<?php */?>

.select-style select{ width:135% !important}

/*.formCon select{background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
  }*/
	
/*	.formCon input[type="text"] {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #C2CFD8;
    border-radius: 2px;
    box-shadow: -1px 1px 2px #D5DBE0 inset;
    padding: 6px 3px;
    width: 175px !important;
}*/
.pdtab_Con {
    margin: 0px;
    padding: 15px 0 0;
}
.formbut{
	padding: 10px 15px;
}
</style>



<?php 

if(isset($existing_guardians)){	
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'add_ex_guardians-form',
		'enableAjaxValidation'=>false,
	)); 
?>        
        <div class="pdtab_Con">
        	<h3><?php echo Yii::t('app','Existing Guardian(s)'); ?></h3>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr class="pdtab-h">
                    <td align="center" width="40"><?php echo CHtml::checkBox('all_guardians','',array('class'=>'check_all')); ?><span><?php echo Yii::t('app','All'); ?></span></td>         
                    <td align="center" width="150"><?php echo Yii::t('app','Name'); ?></td> 
                    <td align="center" width="150"><?php echo Guardians::model()->getAttributeLabel('relation'); ?></td> 
                    <td align="center" width="150"><?php echo Guardians::model()->getAttributeLabel('email'); ?></td>                               
                </tr> 
<?php		
                foreach($existing_guardians as $existing_guardian){				
?>
                    <tr>
                        <td align="center"><?php echo CHtml::checkBox('ex_guardian_id[]','',array('value'=>$existing_guardian->id, 'class'=>'guardian_checkbox')); ?></td>
                        <td align="center"><?php echo CHtml::link($existing_guardian->parentFullName("forStudentProfile"),array('/students/guardians/view','id'=>$existing_guardian->id), array('target'=>'_blank')); ?></td>
                        <td align="center"><?php echo ucfirst($existing_guardian->relation); ?></td>
                        <td align="center"><?php echo $existing_guardian->email; ?></td>
                    </tr>
<?php				
                }
?>
            </table>
            <div style="margin-top:10px;"><?php echo CHtml::submitButton(Yii::t('app','Select'),array('id'=>'ex_submit_btn', 'class'=>'formbut-n','name'=>'ex_submit_btn')); ?></div>
        </div>        
<?php	
	$this->endWidget();
}else{

	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'guardians-form',
		'enableAjaxValidation'=>false,
	));  						
	?>
    	<?php echo $form->errorSummary($model); ?>
		<p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app','are required.'); ?></p>		
		<div class="formCon">
			<div class="formConInner">
				<h3><?php echo Yii::t('app','Personal Details');?></h3>
		
				<?php if(FormFields::model()->isVisible('first_name','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'first_name'); ?>
						<?php echo $form->textField($model,'first_name',array('size'=>25,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('last_name','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'last_name'); ?>
						<?php echo $form->textField($model,'last_name',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('relation','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php 
						//for hide relation field - guardian list edit                     
						if(isset($_REQUEST['sid']) or Yii::app()->controller->action->id=='create')
						{  
							echo $form->labelEx($model,'relation');  
							if(Yii::app()->controller->action->id == 'update'){
								$list= $model->Guard_relations(); 
								$glist 				= GuardianList::model()->findByAttributes(array('guardian_id'=>$model->id, 'student_id'=>$_REQUEST['sid']));								
								if($glist != NULL and $glist->relation!= "Father" and $glist->relation!='Mother' and !isset($_REQUEST['Guardians']['relation'])){
									$model->relation	= "Others";																		
									if($glist){
										$model->relation_other= $glist->relation;
									}
								}
								else{
									if($model->relation != NULL and $model->relation != 'Father' and $model->relation != 'Mother'){
										if($model->relation != 'Others'){
											$model->relation_other	= $model->relation;
										}
										$model->relation = 'Others';
									}
								}
							
							}else {
								$list= $model->Guardian_relations(); 
								if($model->relation != NULL and $model->relation != 'Father' and $model->relation != 'Mother'){
									if($model->relation != 'Others'){
										$model->relation_other	= $model->relation;
									}
									$model->relation = 'Others';
								}
							}
					
							echo $form->dropDownList($model,'relation',$list,array('id'=>'relation_dropdown','empty'=>Yii::t('app','Select'))); ?>
							
							<div id="relation_other" style="display: none; margin-top:10px;">
								<?php echo $form->labelEx($model,'relation_other', array('class'=>'relation-star')); ?><span class="required"> *</span>
								<?php echo $form->textField($model,'relation_other',array('size'=>15,'maxlength'=>255)); ?>								
							</div>
	<?php
						}
	?>                      
					</div>
	<?php
				}
	?>                
				<?php if(FormFields::model()->isVisible('dob','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model, 'dob'); ?>
						<?php 
							$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
							if($settings!=NULL){
								$date	= $settings->dateformat;               
								if($model->dob!=NULL){							   
									$model->dob= date($settings->displaydate,  strtotime($model->dob));
								}
							}else{
								$date = 'dd-mm-yy';	
							}
								
							$this->widget('zii.widgets.jui.CJuiDatePicker', array(                        
								'model'=>$model,
								'attribute'=>'dob',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.(date('Y')+5)
								),
								'htmlOptions'=>array(
									'readonly'=>true
								),
							));
						?>
						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('education','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'education'); ?>
						<?php echo $form->textField($model,'education',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('occupation','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'occupation'); ?>
						<?php echo $form->textField($model,'occupation',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('income','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'income'); ?>
						<?php echo $form->textField($model,'income',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<!-- dynamic fields -->
				<?php
					$fields     = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
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
		
		<div class="formCon">
			<div class="formConInner">
				<h3><?php echo Yii::t('app','Contact Details'); ?></h3>
				<?php if(FormFields::model()->isVisible('email','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'email'); ?>
						<?php echo $form->textField($model,'email',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('mobile_phone','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<?php echo $form->labelEx($model,'mobile_phone'); ?>
						<?php echo $form->textField($model,'mobile_phone',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('office_phone1','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<div class="hide">
							<?php echo $form->labelEx($model,'office_phone1'); ?>
							<?php echo $form->textField($model,'office_phone1',array('size'=>15,'maxlength'=>255)); ?>							
						</div>
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('office_phone2','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col">
						<div class="hide">
							<?php echo $form->labelEx($model,'office_phone2'); ?>
							<?php echo $form->textField($model,'office_phone2',array('size'=>15,'maxlength'=>255)); ?>							
						</div>
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('office_address_line1','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col hide">
						<?php echo $form->labelEx($model,'office_address_line1'); ?>
						<?php echo $form->textField($model,'office_address_line1',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('office_address_line2','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col hide">
						<?php echo $form->labelEx($model,'office_address_line2'); ?>
						<?php echo $form->textField($model,'office_address_line2',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('city','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col hide">
						<?php echo $form->labelEx($model,'city'); ?>
						<?php echo $form->textField($model,'city',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('state','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col hide">
						<?php echo $form->labelEx($model,'state'); ?>
						<?php echo $form->textField($model,'state',array('size'=>15,'maxlength'=>255)); ?>						
					</div>
				<?php } ?>
	
				<?php if(FormFields::model()->isVisible('country_id','Guardians','forAdminRegistration')){ ?>
					<div class="txtfld-col hide">
						<?php echo $form->labelEx($model,'country_id'); ?>
						<?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('style'=>'','empty'=>Yii::t('app','Select Country'))); ?>						
					</div>
				<?php } ?>
	
				<!-- dynamic fields -->
				<?php
					$fields     = FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
					foreach ($fields as $key => $field) {
						if($field->form_field_type!=NULL){
							$this->renderPartial("application.modules.dynamicform.views.fields.admin-form._field_".$field->form_field_type, array('model'=>$model, 'field'=>$field));                                                
						}                                               
					}
				?>
				<!-- dynamic fields --> 
				<div class="clear"></div>
	
	
						 
	<?php             
				if(Yii::app()->controller->action->id == 'create'){
					 echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['id'])); 
				}
				else if(Yii::app()->controller->action->id == 'update'){
					echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['sid'])); 
				}
				else{
					echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['std']));
				}            
				
				if(Yii::app()->controller->action->id == 'create'){
					echo $form->hiddenField($model,'created_at',array('value'=>date('d-m-Y')));
				}
				else{
					echo $form->hiddenField($model,'created_at');
				}
				echo $form->hiddenField($model,'updated_at',array('value'=>date('d-m-Y')));
	?>			
				<input type="hidden" name="which_btn" id="which_btn" />	
			</div>
		</div>
		<div class="clear"></div>
		
        <div>
<?php        	
			if(Yii::app()->controller->action->id != 'update' and !isset($_REQUEST['status'])){
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save and Add Another') : Yii::t('app','Save'),array('class'=>'')).'&nbsp;'; 
?>
				<div style="float:right;">
<?php				
					echo CHtml::submitButton(Yii::t('app','Save and Continue'),array('id'=>'cnt_btn','class'=>'')).'&nbsp;';
					
					echo CHtml::link(Yii::t('app',"Next"),array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id']),array('class'=>'formbut-n'));
?>
				</div>
<?php				 
			}
			else{
				echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Update'),array('class'=>''));
			}
?>			
        </div>
		
		
		
	<?php $this->endWidget(); 
}
?>
<script type="text/javascript">
$('#which_btn').val('0');
$('#cnt_btn').click(function(ev) {
	$('#which_btn').val('1');
});


$(".check_all").change(function(){
	if(this.checked) {
		$('.guardian_checkbox').attr('checked', true);
	}
	else{
		$('.guardian_checkbox').attr('checked', false);
	}
});

$(".guardian_checkbox").change(function(){ 
	if($('.guardian_checkbox:checked').length == $('.guardian_checkbox').length){
		$('.check_all').attr('checked', true);
	}
	else{
		$('.check_all').attr('checked', false);
	}
});

$('#ex_submit_btn').click(function(ev){
	var chks	=	$("[type='checkbox'][name='ex_guardian_id[]']:checked");
	if(chks.length==0){
		alert('Select any Guardian');
		return false;
	}
});	

$(document).ready(function(){
	if($('#relation_dropdown').val()=="Others"){
		$( "#relation_other" ).show();
	}        
	$('#relation_dropdown').change(function(){
		if(this.value=="Others"){           
			$( "#relation_other" ).show("slow");            
		}
		else{
			$('#Guardians_relation_other').val('');
			$( "#relation_other" ).hide("slow");  
		}
	})
});

</script>

