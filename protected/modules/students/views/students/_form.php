<style>
	.formCon input[type="text"], input[type="password"], textArea, select{

	border-radius: 0px !important;
	border:1px #c2cfd8 solid;
	padding:7px 3px;
	background:#fff;
  	box-shadow:none !important;
	width:100%;
}
</style>

<?php 
	
	if(Yii::app()->controller->action->id=='create' and $model->admission_no == NULL){
		$config		= Configurations::model()->findByPk(7);
		$adm_no		= '';
		$adm_no_1 	= '';
		if($config->config_value==1){
			$adm_no = Yii::app()->db->createCommand()
					  ->select("MAX(CAST(admission_no AS UNSIGNED)) as `max_adm_no`")
					  ->from('students')				  
					  ->queryRow();				
			if($adm_no!=NULL){
				$model->admission_no	= $adm_no['max_adm_no'] + 1;
			}
			else{
				$model->admission_no	= 1;
			}
		}	 
	}
	
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'students-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 	
?>	
	<?php echo $form->errorSummary($model); ?>
    <p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span><?php echo Yii::t('app','are required.'); ?></p>
    <div class="formCon" style="background:url(images/yellow-pattern.png); width:100%; border:0px #fac94a solid; color:#000; ">
        <div class="formConInner">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td><?php echo $form->labelEx($model,'admission_no'); ?></td>
                    <td><?php echo $form->textField($model,'admission_no',array('size'=>20,'maxlength'=>255)); ?></td> 
                    <td width="50"></td>                   
                    <td><?php echo $form->labelEx($model,'admission_date'); ?></td>
                    <td>
					<?php                                                 
                        $settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                        if($settings != NULL){
                            $date	= $settings->dateformat;
                        }
                        else{
                            $date 	= 'dd-mm-yy';
						}  
					
                        //set default date
                        if(!(isset($model->admission_date))){
                            $model->admission_date= date("j M Y");
                        }                        
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(                        
							'model'=>$model,
							'attribute'=>'admission_date',
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
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="formCon">
        <div class="formConInner">            
            <h3><?php echo Yii::t('app','Personal Details'); ?> </h3> 
                       
            <?php if(FormFields::model()->isVisible('first_name','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'first_name'); ?>
                    <?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
    
            <?php if(FormFields::model()->isVisible('middle_name','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'middle_name'); ?>
                    <?php echo $form->textField($model,'middle_name',array('size'=>10,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('last_name','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'last_name'); ?>
                    <?php echo $form->textField($model,'last_name',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('national_student_id','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'national_student_id'); ?>
                    <?php echo $form->textField($model,'national_student_id',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('batch_id','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'batch_id'); ?>
                    <?php
						$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
						if(Yii::app()->user->year){
							$year = Yii::app()->user->year;
						}
						else{
							$year = $current_academic_yr->config_value;
						}
                        $models = Batches::model()->findAll("is_deleted=:x AND is_active=:y AND academic_yr_id=:z", array(':x'=>0,':y'=>1,':z'=>$year));
                        $data = array();
						foreach ($models as $model_1){							
							$data[$model_1->id] = $model_1->course123->course_name.'-'.$model_1->name;
						}
                          
                            
						if(isset($_REQUEST['bid']) and $_REQUEST['bid']!=NULL){
							echo $form->dropDownList($model,'batch_id',$data,array('encode'=>false, 'options' => array($_REQUEST['bid']=>array('selected'=>true)),'empty'=>Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"))); 
						}
						else{
							echo $form->dropDownList($model,'batch_id',$data,array('encode'=>false, 'empty'=>Yii::t('app','Select').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"))); 
						}                        
					?>
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('date_of_birth','Students','forAdminRegistration')){ ?>
            <div class="txtfld-col">
                <?php 
					echo $form->labelEx($model,'date_of_birth'); 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(                        
						'attribute'=>'date_of_birth',
						'model'=>$model,
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>$date,
							'changeMonth'=> true,
							'changeYear'=>true,
							'yearRange'=>'1900:'
						),
						'htmlOptions'=>array(							
							'readonly'=>true,
						),
					));            		
				?>
            </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('gender','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'gender'); ?>                
                    <?php echo $form->dropDownList($model,'gender',array('M' => Yii::t('app','Male'), 'F' => Yii::t('app','Female')),array('empty' => Yii::t('app','Select Gender'))); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('blood_group','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'blood_group'); ?>                
                    <?php echo $form->dropDownList($model,'blood_group',array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),array('empty' => Yii::t('app','Unknown'))); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('birth_place','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'birth_place'); ?>
                    <?php echo $form->textField($model,'birth_place',array('size'=>10,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('nationality_id','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'nationality_id'); ?>                
                    <?php echo $form->dropDownList($model,'nationality_id',CHtml::listData(Nationality::model()->findAll(),'id','name'),array('empty'=>Yii::t('app','Select Nationality'))); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('language','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'language'); ?>
                    <?php echo $form->textField($model,'language',array('size'=>15,'maxlength'=>255)); ?>                     
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('religion','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'religion'); ?>
                    <?php echo $form->textField($model,'religion',array('size'=>10,'maxlength'=>255)); ?>                     
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('student_category_id','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'student_category_id'); ?>
                    <?php echo $form->dropDownList($model,'student_category_id',CHtml::listData(StudentCategories::model()->findAll(array('order'=>'name')),'id','name'),array('options' => array('0'=>array('selected'=>true)))); ?>                    
                </div>
            <?php } ?>
    
            <!-- dynamic fields -->
            <?php
				$fields 	= FormFields::model()->getDynamicFields(1, 1, "forAdminRegistration");
				foreach ($fields as $key => $field){
					if($field->form_field_type!=NULL){
						$this->renderPartial("application.modules.dynamicform.views.fields.admin-form._field_".$field->form_field_type, array('model'=>$model, 'field'=>$field));                                                
					}                                               
				}
            ?>
            <!-- dynamic fields -->            
            <div class="clear"></div>            
        </div>
    </div>
    
    <div class="formCon" >
        <div class="formConInner">
            <h3><?php echo Yii::t('app','Contact Details'); ?></h3>

            <?php if(FormFields::model()->isVisible('address_line1','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'address_line1'); ?>
                    <?php echo $form->textField($model,'address_line1',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('address_line2','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'address_line2'); ?>
                    <?php echo $form->textField($model,'address_line2',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('city','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'city'); ?>
                    <?php echo $form->textField($model,'city',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('state','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'state'); ?>
                    <?php echo $form->textField($model,'state',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('pin_code','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'pin_code'); ?>
                    <?php echo $form->textField($model,'pin_code',array('size'=>15,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('country_id','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'country_id'); ?>				
                    <?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('empty'=>Yii::t('app','Select Country'))); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('phone1','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'phone1'); ?>
                    <?php echo $form->textField($model,'phone1',array('size'=>15,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('phone2','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'phone2'); ?>
                    <?php echo $form->textField($model,'phone2',array('size'=>15,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>
            
            <?php if(FormFields::model()->isVisible('email','Students','forAdminRegistration')){ ?>
                <div class="txtfld-col">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>255)); ?>                    
                </div>
            <?php } ?>

            <!-- dynamic fields -->
            <?php
				$fields     = FormFields::model()->getDynamicFields(1, 2, "forAdminRegistration");
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
    
    <div class="formCon" style=" background:#EDF1D1 url(images/green-bg.png); border:0px #c4da9b solid; color:#393; ">
        <div class="formConInner" style="padding:10px 10px;">            
            <table width="100%" border="0" cellspacing="0" cellpadding="0">            
                <tr>
                    <td>
<?php						 
                        if($model->photo_data==NULL){
                        	echo $form->labelEx($model,'<strong style="color:#000">'.Yii::t('app','Upload Photo').'</strong>');
						}
                        else{
                        	echo $form->labelEx($model,Yii::t('app','Photo')); 
						}
?>                        
                    </td>                                       
                    <td>
<?php                         
                        if($model->isNewRecord){
                            echo $form->fileField($model,'photo_data');                             
                        }
                        else{
                            if($model->photo_file_name==NULL){
                                echo $form->fileField($model,'photo_data');                                  
                            }
                            else{
                                if(Yii::app()->controller->action->id=='update'){
									if(isset($_REQUEST['status'])){
                                    	echo CHtml::link(Yii::t('app','Remove'), array('students/remove', 'id'=>$model->id,'status'=>$_REQUEST['status']),array('confirm'=>Yii::t('app','Are you sure?'))); 									
									}
									else{
										echo CHtml::link(Yii::t('app','Remove'), array('students/remove', 'id'=>$model->id),array('confirm'=>Yii::t('app','Are you sure?'))); 									
									}
                                    if($model->photo_file_name!=NULL){
                                        $path = Students::model()->getProfileImagePath($model->id);										
                                        echo '<img class="imgbrder"  src="'.$path.'" alt="'.$model->photo_file_name.'" width="100" height="100" />';
                                    }
                                                                       
                                }
                                else if(Yii::app()->controller->action->id=='create'){
                                    echo CHtml::hiddenField('photo_file_name',$model->photo_file_name);
                                    echo CHtml::hiddenField('photo_content_type',$model->photo_content_type);
                                    echo CHtml::hiddenField('photo_file_size',$model->photo_file_size);
                                    echo CHtml::hiddenField('photo_data',bin2hex($model->photo_data));
                                    echo '<img class="imgbrder" src="'.$this->createUrl('Students/DisplaySavedImage&id='.$model->primaryKey).'" alt="'.$model->photo_file_name.'" width="100" height="100" />';
                                }
                            }
                        }						
?>   
		                                                                                               
                    </td>                    
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>                    
                </tr>
                <tr>
                    <td>&nbsp;</td>                	
                    <td colspan="3">  
                        <div id="image_size_error" style="color:#F00;"></div>                
                     	<div style="margin-top:10px;"> <?php echo Yii::t('app','Maximum file size is 1MB. Allowed file types are png,gif,jpeg,jpg'); ?></div>                        
                    </td>
                </tr>
            </table>                        
        </div>
    </div><!-- form -->
    
    <?php 
		echo $form->hiddenField($model,'class_roll_no'); 
		echo $form->hiddenField($model,'immediate_contact_id');
		echo $form->hiddenField($model,'is_sms_enabled');
		echo $form->hiddenField($model,'status_description');
		echo $form->hiddenField($model,'is_active');
		echo $form->hiddenField($model,'is_deleted');
		if(Yii::app()->controller->action->id == 'create'){
			echo $form->hiddenField($model,'created_at',array('value'=>date('Y-m-d')));
		}
		else{
			echo $form->hiddenField($model,'created_at');
		}
		echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d')));
		echo $form->hiddenField($model,'has_paid_fees');
		echo $form->hiddenField($model,'photo_file_size');
		echo $form->hiddenField($model,'user_id',array('value'=>'1'));
	?>
      
    <div class="clear"></div>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Guardian Details') : Yii::t('app','Update'),array('id'=>'submit_button_form','class'=>'a_tag-btn')); ?></li>                                   
</ul>
</div> 

</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
$('#submit_button_form').click(function(ev) {			
	var file_size = $('#Students_photo_data')[0].files[0].size;	
	if(file_size>1048576){ //File upload size limit to 1mb			   	
		$('#image_size_error').html('<?php echo Yii::t('app','File size is greater than 1MB'); ?>');
		return false;
	}	
});
</script>