<style>
.emp_cntntbx{
	padding: 0px 0px 30px 0px;
}
.box-btn{
	float:right;
	float: right;
	margin-top: -5px;	
}
.accordion-header:hover{ background-color:#dee5ec;}
.drawer {
width: 98%;
    border-top: 1px solid #E0E0E0;
    border-radius: 3px;
    margin-bottom: 10px;
    margin-left: 8px;
}
.accordion-item {
	border-bottom: 1px solid #E0E0E0;
}
.accordion-item-active .accordion-header {
	background: #888;
	transition: .25s;
}
.accordion-item-active .accordion-header-icon {
	color: #fff;
}
.accordion-item-active .accordion-header h1 {
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 12px;
}
.accordion-header {
background: #f2f2f2;
    padding: 7px;
    cursor: pointer;
    border-right: 1px solid #E0E0E0;
    border-left: 1px solid #E0E0E0;
    min-height: 13px;
    transition: .25s;
}
.accordion-header h1 {
float: left;
    margin: 0;
    line-height: 14px;
    font-size: 12px;
    color: #1a7701;
    font-weight: 500;
    text-transform: uppercase;
}
.accordion-content {
	border-left: 1px solid #E0E0E0;
	border-right: 1px solid #E0E0E0;
	border-top: 1px solid #E0E0E0;
	display: none;
    padding: 4px 0px 6px;
	color: #212121;
	background: #FFF;
	font-size: 15px;
	line-height: 1.45em;
}
.accordion-content p {
	margin: 0;
	margin-bottom: 3px;
}
.accordion-header-icon {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	float: right;
	color: #888;
	font-size: 15px;
	vertical-align: middle;
}
.accordion-header-icon.accordion-header-icon-active {
	-webkit-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	transform: rotate(180deg);
	color: #fff;
}

.accordn-blok ul {
	margin: 0px;
	padding: 0px;
	list-style: none;
	float: left;
	width: 100%;
	height: 40px;
	border-bottom: #eaeef1 solid 1px;
}
.accordn-blok ul li {
	list-style: none;
	display: inline-block;
}
.accordn-blok ul li.l-col {
	padding: 10px;
	margin: 0px;
	float: left;
	height: 40px;
	box-sizing: border-box;
	color: #333333;
	font-size: 12px;
	font-weight: bold;
	width: 30%;
}
.accordn-blok ul li.r-col {
	padding: 10px;
	margin: 0px;
	float: left;
	height: 40px;
	box-sizing: border-box;
	color: #333333;
	font-size: 14px;
	width: 70%;
}
.main-block{ margin-bottom:10px;}
.cordn-h3 h3{
 text-transform: uppercase;
    color: #507588;
    font-size: 13px;
    margin-top: 26px;
    background-color: #fbe5ac;
    padding: 10px 9px;
	border-radius: 4px;

}
.fist-sections{
    width: 30%;
    float: left;
    margin-right:10px;
	    color: #333333;
    font-size: 12px;
    font-weight: bold;
}
.last-sections{
     width: 63%;
	 float:right;
	 color: #333333;
    font-size: 14px;
}
.midl-sections{
 width: 5%;
 float: left;
}
.tabl{
	width: 99%;
	display: inline-block;
	border-bottom: 1px solid#e4e4e4;
    padding: 7px 0px 9px 9px;
}

</style>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/woco.accordion.min.js"></script>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Guardians')=>array('admin'),
	Yii::t('app','Manage'),
);

$settings = UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top"><?php $this->renderPartial('/default/left_side');?></td>
        <td valign="top">
        <div class="cont_right">
                <h1><?php echo Yii::t('app','Guardian Profile');?></h1>
                <p class="add-name"><?php echo Yii::t('') .$model->parentFullName("forStudentProfile");?></p>
                <div class="button-bg">
                <div class="top-hed-btn-left"> </div>
                <div class="top-hed-btn-right">
                                    <ul>
                                        <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/guardians/update', 'id'=>$_REQUEST['id']),array('class'=>'a_tag-btn')); ?> </li>                            
                                        <li><?php echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/guardians/delete','id'=>$_REQUEST['id']), 'confirm'=>Yii::t('app','Are you sure you want to delete the guardian?'), 'csrf'=>true, 'class'=>'a_tag-btn')); ?></li>
                                    </ul>
                                </div>
                                </div>                	                    
                <div class="emp_cntntbx">                    
                    <div class="cordn-h3">
                        <span><h3><?php echo Yii::t('app','GUARDIAN DETAILS');?></h3></span>
                        <div class="accordion">
                            <h1><?php echo Yii::t('app','Personal details'); ?></h1>
                            <div>
                                <?php if(FormFields::model()->isVisible('first_name','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('first_name');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php echo ucfirst($model->first_name); ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('last_name','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('last_name');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php echo ucfirst($model->last_name); ?>	
                                        </div>
                                    </div>
                                <?php } ?> 
                                <?php if(FormFields::model()->isVisible('dob','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('dob');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->dob == "0000-00-00"){
                                                    echo '-';
                                                }
                                                else{													
                                                    if($settings!=NULL){	
                                                        $date1 = date($settings->displaydate,strtotime($model->dob));
                                                        echo $date1;														
                                                    }
                                                    else{
                                                        echo $model->dob;
                                                    }
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?> 
                                <?php if(FormFields::model()->isVisible('education','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('education');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->education){
                                                    echo ucfirst($model->education); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('occupation','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('occupation');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->occupation){
                                                    echo ucfirst($model->occupation); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?> 
                                <?php if(FormFields::model()->isVisible('income','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('income');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->income){
                                                    echo ucfirst($model->income); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?> 
                                <!-- DYNAMIC FIELDS START -->
<?php                                     
                                $fields = FormFields::model()->getDynamicFields(2, 1, "forAdminRegistration");
                                if($fields){
                                    foreach ($fields as $key => $field){							
                                        if($field->form_field_type!=NULL){
                                            if(FormFields::model()->isVisible($field->varname,'Guardians','forAdminRegistration')){
?>                                                        
                                                <div class="tabl">
                                                    <div class="fist-sections"><?php echo $model->getAttributeLabel($field->varname);?></div> 
                                                    <div class="midl-sections">:</div>                                      
                                                    <div class="last-sections">
<?php 
                                                        $field_name = $field->varname;
                                                        if($model->$field_name){
                                                            if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                                echo FormFields::model()->getFieldValue($model->$field_name);
                                                            }
                                                            else if($field->form_field_type==6){  // date value
                                                                if($settings!=NULL and $model->$field_name!=NULL and $model->$field_name!="0000-00-00"){
                                                                    $date1  = date($settings->displaydate,strtotime($model->$field_name));
                                                                    echo $date1;
                                                                }
                                                                else{
                                                                    if($model->$field_name!=NULL and $model->$field_name!="0000-00-00"){
                                                                        echo $model->$field_name;
                                                                    }
                                                                    else{
                                                                        echo '-';
                                                                    }
                                                                }																
                                                            }
                                                            else{
                                                                echo (isset($model->$field_name) and $model->$field_name!="")?$model->$field_name:"-";
                                                            }
                                                        }
                                                        else{
                                                            echo '-';
                                                        }
?>
                                                    </div>
                                                </div>
<?php													
                                            }
                                        }
                                    }
                                }
?>                                    
                                <!-- DYNAMIC FIELDS END -->  
                            </div>
                            
                            <h1><?php echo Yii::t('app','Contact details'); ?></h1>
                            <div>
                                <?php if(FormFields::model()->isVisible('email','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('email');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->email){
                                                    echo ucfirst($model->email); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?> 
                                <?php if(FormFields::model()->isVisible('mobile_phone','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('mobile_phone');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->mobile_phone){
                                                    echo ucfirst($model->mobile_phone); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('office_phone1','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('office_phone1');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->office_phone1){
                                                    echo ucfirst($model->office_phone1); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('office_phone2','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('office_phone2');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->office_phone2){
                                                    echo ucfirst($model->office_phone2); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('office_address_line1','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('office_address_line1');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->office_address_line1){
                                                    echo ucfirst($model->office_address_line1); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('office_address_line2','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('office_address_line2');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->office_address_line2){
                                                    echo ucfirst($model->office_address_line2); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('city','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('city');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->city){
                                                    echo ucfirst($model->city); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('state','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('state');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->state){
                                                    echo ucfirst($model->state); 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if(FormFields::model()->isVisible('country_id','Guardians','forAdminRegistration')){?>
                                    <div class="tabl">
                                        <div class="fist-sections"><?php echo $model->getAttributeLabel('country_id');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php 
                                                if($model->country_id!=NULL){
                                                    $posts	= Countries::model()->findByAttributes(array('id'=>$model->country_id));
                                                    echo $posts->name; 
                                                }
                                                else{
                                                    echo '-';
                                                }
                                            ?>	
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- DYNAMIC FIELDS START -->
<?php                                     
                                $contact_fields	= FormFields::model()->getDynamicFields(2, 2, "forAdminRegistration");
                                if($contact_fields){
                                    foreach ($contact_fields as $ckey => $cfield){							
                                        if($cfield->form_field_type!=NULL){
                                            if(FormFields::model()->isVisible($cfield->varname,'Guardians','forAdminRegistration')){
?>              
                                                <div class="tabl">
                                                    <div class="fist-sections"><?php echo $model->getAttributeLabel($cfield->varname);?></div> 
                                                    <div class="midl-sections">:</div>                                      
                                                    <div class="last-sections">
<?php														 
                                                        $field_name = $cfield->varname;
                                                        if($model->$field_name){
                                                            if(in_array($cfield->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                                echo FormFields::model()->getFieldValue($model->$field_name);
                                                            }
                                                            else if($cfield->form_field_type==6){  // date value
                                                                if($settings!=NULL and $model->$field_name!=NULL and $model->$field_name!="0000-00-00"){
                                                                    $date1  = date($settings->displaydate,strtotime($model->$field_name));
                                                                    echo $date1;
                                                                }
                                                                else{
                                                                    if($model->$field_name!=NULL and $model->$field_name!="0000-00-00"){
                                                                        echo $model->$field_name;
                                                                    }
                                                                    else{
                                                                        echo '-';
                                                                    }
                                                                }																
                                                            }
                                                            else{
                                                                echo (isset($model->$field_name) and $model->$field_name!="")?$model->$field_name:"-";
                                                            }
                                                        }
                                                        else{
                                                            echo '-';
                                                        }
?>                                                            
                                                    </div>
                                                </div>
<?php													
                                            }
                                        }
                                    }
                                }
?>                                    
                                <!-- DYNAMIC FIELDS END -->
                            </div>                                
                        </div>
                    </div>
               
                    <div class="pdtab_Con" style="position:relative;">
                        <h1><?php echo Yii::t('app','Students Details');?></h1>                                                
<?php                       
                        $criteria 				= new CDbCriteria;		
                        $criteria->join 		= 'LEFT JOIN guardian_list t1 ON t.id = t1.student_id'; 
                        $criteria->condition 	= 't1.guardian_id=:guardian_id and t.is_active=:is_active and is_deleted=:is_deleted';
                        $criteria->params 		= array(':guardian_id'=>$model->id,':is_active'=>1,'is_deleted'=>0);
                        $active_students 		= Students::model()->findAll($criteria);					
?>                                                
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" >
                            <tr class="pdtab-h" >
                                <td align="center"><?php echo Yii::t('app','Sl No.');?></td>
                                <td align="center"><?php echo Yii::t('app','Student Name');?></td>
                                <?php if(FormFields::model()->isVisible('relation','Guardians','forAdminRegistration')){?>
                                	<td align="center"><?php echo Yii::t('app','Relation');?></td>
                                <?php } ?>                            
                            </tr>
<?php                            
                            if($active_students){
								$i = 1;
								foreach($active_students as $active_student){
									$relation = GuardianList::model()->findByAttributes(array('student_id'=>$active_student->id,'guardian_id'=>$_REQUEST['id']));
?>									
									<tr>
                                        <td align="center"><?php echo $i; ?></td>
                                        <td align="center">
<?php										 
											$name= "";
											if(FormFields::model()->isVisible('first_name','Students','forAdminRegistration')){
												$name.= ucfirst($active_student->first_name);
											}
											if(FormFields::model()->isVisible('middle_name','Students','forAdminRegistration')){
												$name.= " ".ucfirst($active_student->middle_name);
											}
											if(FormFields::model()->isVisible('last_name','Students','forAdminRegistration')){
												$name.= " ".ucfirst($active_student->last_name);
											}
											echo CHtml::link($name,array('/students/students/view','id'=>$active_student->id));                                         
?>                                        
                                        </td>
                                        <?php if(FormFields::model()->isVisible('relation','Guardians','forAdminRegistration')){?>
                                        	<td align="center"><?php echo ucfirst($relation->relation); ?></td>
										<?php } ?>
									</tr>
<?php										
									$i++;						
								}
                            }
							else{
?>                            
                            	<tr><td colspan="3" align="center"><?php echo Yii::t('app','Students Not Found'); ?></td></tr>
<?php                            						
                            }
?>                                               
                        </table>                        
                    </div>
            	</div>
        </div> 
             
    	</td>
	</tr>
</table>
<script>
	$(".accordion").accordion();
</script> 