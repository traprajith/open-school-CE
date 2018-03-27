<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/woco.accordion.min.js"></script>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','View'),
);
$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
$batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$_REQUEST['id'], 'batch_id'=>$model->batch_id, 'status'=>1));
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="247" valign="top"><?php $this->renderPartial('profileleft');?></td>
		<td valign="top">
        <div class="cont_right formWrapper"> 				
                <h1><?php echo Yii::t('app','STUDENT PROFILE');?></h1>           							
			<div class="emp_right_contner">
				<div class="emp_tabwrapper">
					<?php $this->renderPartial('application.modules.students.views.students.tab');?>
					<div class="clear"></div>
                    
				<div class="pdf-box">
                		<div class="box-one"></div>
                        <div class="box-two">
                             <div class="pdf-div">
                             <?php echo CHtml::link(Yii::t('app','Generate PDF'), array('Students/pdf','id'=>$_REQUEST['id']),array('target'=>'_blank','class'=>'pdf_but')); ?>
                             </div>
                        </div>
                	</div>
                    
                    
                    						
					<div class="emp_cntntbx">
						<div class="cordn-h3">
					
							<span>
                            	<h3><?php echo Yii::t('app','STUDENT DETAILS');?>
                                	<div class="box-btn">
                                		<div class="tt-wrapper-new">
										<?php									
                                            echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/students/update','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeedit'));
                                        ?>
                               			</div> 
                                        </div>
                                </h3>
                                   
                            </span>
							<div class="accordion">
								<h1><?php echo Yii::t('app','Personal details'); ?></h1>
								
								<div>
                                            <div class="tabl">
                                                <div class="fist-sections"><?php echo Yii::t('app','Roll No');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php 
                                                        if($batch_student!=NULL and $batch_student->roll_no!=0){
                                                            echo $batch_student->roll_no;
                                                        }
                                                        else{
                                                            echo '-'; 
                                                        }
                                                    ?>		
                                                </div>
                                            </div>
                                      
                                	<?php if(FormFields::model()->isVisible('admission_date','Students','forStudentProfile')){?>	 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('admission_date');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($settings!=NULL){	
														$date1=date($settings->displaydate,strtotime($model->admission_date));
														echo $date1;
                                        			}
													else{
                                                    	echo $model->admission_date; 
                                                    }
												?>		
                                            </div>
                                        </div>
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('national_student_id','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('national_student_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php
													if($model->national_student_id){
														echo $model->national_student_id;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('date_of_birth','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('date_of_birth');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
												
													if($settings!=NULL and $model->date_of_birth!=NULL and $model->date_of_birth != "0000-00-00"){	
														$date1 = date($settings->displaydate,strtotime($model->date_of_birth));
														echo $date1;										
													}else{
														echo '-';
													}
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>   
                                    <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('gender');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->gender=='M'){
														echo Yii::t('app','Male');
													}
													elseif($model->gender=='F'){
														echo Yii::t('app','Female');
													}
													else{
														echo '-';
													}
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('blood_group','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('blood_group');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->blood_group){
														echo $model->blood_group;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('birth_place','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('birth_place');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->birth_place){
														echo $model->birth_place;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('nationality_id','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('nationality_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													$natio_id=Nationality::model()->findByAttributes(array('id'=>$model->nationality_id));
													if($natio_id){
														echo $natio_id->name;
													}
													else{
														echo '-';
													}
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('language','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('language');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->language){
														echo $model->language;
													}
													else{ 
														echo '-';
													}
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('religion','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('religion');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->religion){
														echo $model->religion;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('student_category_id','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('student_category_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->student_category_id){
														$cat =StudentCategories::model()->findByAttributes(array('id'=>$model->student_category_id));
														if($cat !=NULL)
														echo $cat->name;
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
                                    	$fields= FormFields::model()->getDynamicFields(1, 1, "forStudentProfile");
										if($fields){
											foreach($fields as $key => $field){							
												if($field->form_field_type!=NULL){
													if(FormFields::model()->isVisible($field->varname,'Students','forStudentProfile')){
									?>    
														<div class="tabl">		
															<div class="fist-sections"><?php echo $model->getAttributeLabel($field->varname);?></div>                                       						<div class="midl-sections">:</div>
															<div class="last-sections">															
									<?php
																$field_name = $field->varname;
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
                                    <?php if(FormFields::model()->isVisible('address_line1','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('address_line1');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->address_line1){
														echo $model->address_line1;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('address_line2','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('address_line2');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->address_line2){
														echo $model->address_line2;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('city','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('city');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->city){
														echo $model->city;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>	
                                    <?php if(FormFields::model()->isVisible('state','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('state');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->state){
														echo $model->state;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('pin_code','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('pin_code');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->pin_code){
														echo $model->pin_code;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('country_id','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('country_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->country_id){
														$count = Countries::model()->findByAttributes(array('id'=>$model->country_id));
														if(count($count)!=0)
														echo $count->name;
													}
													else{
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('phone1','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('phone1');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->phone1){
														echo $model->phone1;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('phone2','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('phone2');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->phone2){
														echo $model->phone2;
													}
													else{ 
														echo '-';
													} 
												?>
                                            </div>
                                        </div>	
                                    <?php } ?>
                                    <?php if(FormFields::model()->isVisible('email','Students','forStudentProfile')){?>   
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('email');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->email){
														echo $model->email;
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
                                    	$fields= FormFields::model()->getDynamicFields(1, 2, "forStudentProfile");
										if($fields){
											foreach ($fields as $key => $field){							
												if($field->form_field_type!=NULL){
													if(FormFields::model()->isVisible($field->varname,'Students','forStudentProfile')){
                                     ?>    
                                                        <div class="tabl">
                                                        	<div class="fist-sections"><?php echo $model->getAttributeLabel($field->varname);?></div>                                       						<div class="midl-sections">:</div>
                                                        	<div class="last-sections">
									<?php
																$field_name = $field->varname;
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
							<div class="section_div"></div>
<?php 
	$criteria 				= new CDbCriteria;		
	$criteria->join 		= 'JOIN guardians t1 ON t.guardian_id = t1.id'; 
	$criteria->condition 	= 't.student_id=:student_id AND t1.is_delete=:is_delete';
	$criteria->params 		= array(':student_id'=>$model->id,'is_delete'=>0);
	$guardian_list_data 	= GuardianList::model()->findAll($criteria); 	
?>                            
                            <div class="box-div"> 
                                <h3><?php echo Yii::t('app','GUARDIAN DETAILS'); ?>  
                                    <div class="box-btn">
                                        <div class="tt-wrapper-new">
											<?php
												if(count($guardian_list_data) > 0){								
                                            		echo CHtml::link('<span>'.Yii::t('app','Manage Guardians').'</span>', array('/students/guardians/create','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeedit'));
												}
												else{
													echo CHtml::link('<span>'.Yii::t('app','Add Guardians').'</span>', array('/students/guardians/create','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeplus'));
												}
                                            ?>
                                        </div>
                                    </div>
                                </h3>
                            </div>
                                 
<?php
	
	if($guardian_list_data){
		$i = 1;
		foreach($guardian_list_data as $key=>$data){
        	$guardian_model= Guardians::model()->findByPk($data->guardian_id);
?>                                
								<h1><?php echo ucfirst($data->relation); ?></h1>
                                <div> 
                                	<div class="prnt-head"><h4><?php echo Yii::t('app','Personal Details'); ?></h4></div>                               							<?php if(FormFields::model()->isVisible('first_name','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('first_name');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections"><?php echo ucfirst($guardian_model->first_name); ?></div>
                                        </div> 
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('last_name','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('last_name');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections"><?php echo ucfirst($guardian_model->last_name); ?></div>
                                        </div> 
                                    <?php } ?>     
                                    <?php if(FormFields::model()->isVisible('relation','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('relation');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
												<?php
													if($guardian_model->relation){
														echo $guardian_model->relation;
													}
													else { 
														echo '-';
													}	
												?>
                                            </div>
                                        </div> 
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('dob','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('dob');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
												<?php
													if($settings!=NULL and $guardian_model->dob!=NULL and $guardian_model->dob!='0000-00-00'){	
														$date1=date($settings->displaydate,strtotime($guardian_model->dob));
														echo $date1;										
													}else{
														echo '-';
													}	
												?>
                                            </div>
                                        </div> 
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('education','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('education');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
												<?php
													if($guardian_model->education){
														echo $guardian_model->education;
													}
													else{ 
														echo '-';
													}	
												?>
                                            </div>
                                        </div> 
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('occupation','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('occupation');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
												<?php
													if($guardian_model->occupation){
														echo $guardian_model->occupation;
													}
													else{ 
														echo '-';
													}	
												?>
                                            </div>
                                        </div> 
                                    <?php } ?> 
                                    <?php if(FormFields::model()->isVisible('income','Guardians','forStudentProfile')){?>
                                        <div class="tabl parnt-bottm">                                            
                                            <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('income');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
												<?php
													if($guardian_model->income){
														echo $guardian_model->income;
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
                                    $fields= FormFields::model()->getDynamicFields(2, 1, "forStudentProfile");
                                    if($fields)
                                    {
                                        foreach ($fields as $key => $field) 
                                        {							
                                            if($field->form_field_type!=NULL)
                                            {
                                                if(FormFields::model()->isVisible($field->varname,'Guardians','forStudentProfile'))
                                                {
                                                    ?>    
                                                        <div class="tabl parnt-bottm"> 
                                                        	<div class="fist-sections"><?php echo $guardian_model->getAttributeLabel($field->varname);?></div>  
                                                            <div class="midl-sections">:</div>              
                                                        <div class="last-sections">
														<?php
														 $field_name = $field->varname;
                                                          if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                            echo FormFields::model()->getFieldValue($guardian_model->$field_name);
                                                          }
                                                          else if($field->form_field_type==6){  // date value
														  		if($settings!=NULL and $guardian_model->$field_name!=NULL and $guardian_model->$field_name!="0000-00-00"){
																	$date1  = date($settings->displaydate,strtotime($guardian_model->$field_name));
																	echo $date1;
																}
																else{
																	if($guardian_model->$field_name!=NULL and $guardian_model->$field_name!="0000-00-00"){
																		echo $guardian_model->$field_name;
																	}
																	else{
																		echo '-';
																	}
																}														  																		
                                                          }
                                                          else{
                                                            echo (isset($guardian_model->$field_name) and $guardian_model->$field_name!="")?$guardian_model->$field_name:"-";
                                                          }
                                                        ?>
														</div>
                                                    </div><?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->                    
                                    <div class="prnt-head"><h4><?php echo Yii::t('app','Contact Details'); ?></h4></div>        
                                        <?php if(FormFields::model()->isVisible('email','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('email');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->email){
                                                            echo $guardian_model->email;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?> 
                                        <?php if(FormFields::model()->isVisible('mobile_phone','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('mobile_phone');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->mobile_phone){
                                                            echo $guardian_model->mobile_phone;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?>
                                        <?php if(FormFields::model()->isVisible('office_phone1','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('office_phone1');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->office_phone1){
                                                            echo $guardian_model->office_phone1;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?> 
                                        <?php if(FormFields::model()->isVisible('office_phone2','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('office_phone2');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->office_phone2){
                                                            echo $guardian_model->office_phone2;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?>  
                                        <?php if(FormFields::model()->isVisible('office_address_line1','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('office_address_line1');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->office_address_line1){
                                                            echo $guardian_model->office_address_line1;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?>  
                                        <?php if(FormFields::model()->isVisible('office_address_line2','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('office_address_line2');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->office_address_line2){
                                                            echo $guardian_model->office_address_line2;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?> 
                                        <?php if(FormFields::model()->isVisible('city','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('city');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->city){
                                                            echo $guardian_model->city;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?> 
                                        <?php if(FormFields::model()->isVisible('state','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('state');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        if($guardian_model->state){
                                                            echo $guardian_model->state;
                                                        }
                                                        else{ 
                                                            echo '-';
                                                        }	
                                                    ?>
                                                </div>
                                            </div> 
                                        <?php } ?>
                                        <?php if(FormFields::model()->isVisible('country_id','Guardians','forStudentProfile')){?>
                                            <div class="tabl parnt-bottm">                                            
                                                <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel('country_id');?></div>
                                                <div class="midl-sections">:</div>
                                                <div class="last-sections">
                                                    <?php
                                                        $count = Countries::model()->findByAttributes(array('id'=>$guardian_model->country_id));
														if($guardian_model->country_id!=NULL){
															if(count($count)!=0){
																echo $count->name;	
															}
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
                                    $fields= FormFields::model()->getDynamicFields(2, 2, "forStudentProfile");
                                    if($fields)
                                    {
                                        foreach ($fields as $key => $field) 
                                        {							
                                            if($field->form_field_type!=NULL)
                                            {
                                                if(FormFields::model()->isVisible($field->varname,'Guardians','forStudentProfile'))
                                                {
                                                    ?>    
                                                        <div class="tabl parnt-bottm"> 
                                                        <div class="fist-sections"><?php echo $guardian_model->getAttributeLabel($field->varname);?></div>                                       
                                                        <div class="midl-sections">:</div>
                                                        <div class="last-sections">
														<?php
														 $field_name = $field->varname;
                                                          if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                            echo FormFields::model()->getFieldValue($guardian_model->$field_name);
                                                          }
                                                          else if($field->form_field_type==6){  // date value
														  		if($settings!=NULL and $guardian_model->$field_name!=NULL and $guardian_model->$field_name!="0000-00-00"){
																	$date1  = date($settings->displaydate,strtotime($guardian_model->$field_name));
																	echo $date1;
																}
																else{
																	if($guardian_model->$field_name!=NULL and $guardian_model->$field_name!="0000-00-00"){
																		echo $guardian_model->$field_name;
																	}
																	else{
																		echo '-';
																	}
																}																
                                                          }
                                                          else{
                                                            echo (isset($guardian_model->$field_name) and $guardian_model->$field_name!="")?$guardian_model->$field_name:"-";
                                                          }
                                                        ?>
														</div>
                                                    </div><?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->                            
                                </div>
								
                                
<?php
			$i++;
		}
	}
	else{
		echo '<div class="notavail" style="font-weight:bold;">'; 
		echo Yii::t('app','Guardian Details Not Found');
		echo '</div>';
	}
?>   
								<div class="section_div"></div>
								
								
                                <div class="box-div"> 
                                    <h3><?php echo Yii::t('app','PRIMARY AND EMERGENCY CONTACT DETAILS'); ?>
                                        <div class="box-btn">
                                            <div class="tt-wrapper-new">
                                                <?php
                                                    if(count($guardian_list_data) > 0){								
                                                        echo CHtml::link('<span>'.Yii::t('app','Manage Contacts').'</span>', array('/students/guardians/create','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeedit'));
                                                    }
                                                    
                                                ?>
                                            </div>
                                        </div>
                                    </h3>
                                </div>	 
                                <h1><?php echo Yii::t('app','Primary and Emergency contact'); ?></h1>                           
                                <div>
                                	<div class="tabl parnt-bottm">                                            
                                        <div class="fist-sections"><?php echo Yii::t('app','Primary Contact');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php
                                                if($model->parent_id == 0 or $model->parent_id == NULL){
													echo Yii::t('app',"Not Assigned"); 
												}
												else{
													$primary_gud	= Guardians::model()->findByAttributes(array('id'=>$model->parent_id, 'is_delete'=>0));
													if(FormFields::model()->isVisible("fullname", "Guardians", 'forStudentProfile')){
														if($primary_gud){											
															echo CHtml::link($primary_gud->ParentFullname('forStudentProfile'),array('/students/guardians/view','id'=>$primary_gud->id));
														}
														else{
															echo '-';
														}
													}
												}
                                            ?>
                                        </div>
                                    </div>
                                    <div class="tabl parnt-bottm">                                            
                                        <div class="fist-sections"><?php echo Yii::t('app','Emergency Contact');?></div>
                                        <div class="midl-sections">:</div>
                                        <div class="last-sections">
                                            <?php
                                                if($model->immediate_contact_id == 0 or $model->immediate_contact_id == NULL){
													echo Yii::t('app',"Not Assigned "); 
												}
												else{
													$emergency_gud	= Guardians::model()->findByAttributes(array('id'=>$model->immediate_contact_id,'is_delete'=>0));
													if(FormFields::model()->isVisible("fullname", "Guardians", 'forStudentProfile')){
														if($emergency_gud){											
															echo CHtml::link($emergency_gud->ParentFullname('forStudentProfile'),array('/students/guardians/view','id'=>$primary_gud->id));
														}
														else{
															echo '-';
														}
													}
												}
                                            ?>
                                        </div>
                                    </div>                                	                                     
								</div>
								<div class="section_div"></div>
<?php $previous = StudentPreviousDatas::model()->findAllByAttributes(array('student_id'=>$model->id)); ?>                                
                                <div class="box-div"> 
                                    <h3><?php echo Yii::t('app','PREVIOUS DETAILS'); ?>  
                                        <div class="box-btn">
                                            <div class="tt-wrapper-new">
                                                <?php
												if(count($previous) > 0){									
                                                	echo CHtml::link('<span>'.Yii::t('app','Manage Previous Details').'</span>', array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeedit'));
												}
												else{
													echo CHtml::link('<span>'.Yii::t('app','Add Previous Details').'</span>', array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeplus'));
												}
                                                ?>                                               
                                            </div>
                                        </div>
                                    </h3>
                                </div>
                                 
<?php
    
	if(count($previous)==0)
	{
		echo '<div class="notavail" style="font-weight:bold;">';
		echo Yii::t('app','No Previous Details Found!');
		echo '</div>';
		
	}
	else{
		$i = 1;
		foreach($previous as $prev){
			if($prev->institution!=NULL or $prev->year!=NULL or $prev->course!=NULL or $prev->total_mark!=NULL){
?>	                                
                                
								
								<h1><?php echo Yii::t('app','Previous Detail').' #'.$i; ?></h1>                           
                                <div>
                                	<?php if(FormFields::model()->isVisible('institution','StudentPreviousDatas','forStudentProfile')){?> 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $prev->getAttributeLabel('institution');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                                <?php 
                                                    if($prev->institution!=NULL){
														echo $prev->institution;
													}
													else{ 
														echo '-';
													}
                                                ?>		
                                            </div>
                                        </div>   
                                	<?php } ?> 
                                    <?php if(FormFields::model()->isVisible('year','StudentPreviousDatas','forStudentProfile')){?> 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $prev->getAttributeLabel('year');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                                <?php 
                                                    if($prev->year!=NULL){
														echo $prev->year;
													}
													else{ 
														echo '-';
													}
                                                ?>		
                                            </div>
                                        </div>   
                                	<?php } ?> 
                                    <?php if(FormFields::model()->isVisible('course','StudentPreviousDatas','forStudentProfile')){?> 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $prev->getAttributeLabel('course');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                                <?php 
                                                    if($prev->course!=NULL){
														echo $prev->course;
													}
													else{ 
														echo '-';
													}
                                                ?>		
                                            </div>
                                        </div>   
                                	<?php } ?>
                                    <?php if(FormFields::model()->isVisible('total_mark','StudentPreviousDatas','forStudentProfile')){?> 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $prev->getAttributeLabel('total_mark');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                                <?php 
                                                    if($prev->total_mark!=NULL){
														echo $prev->total_mark;
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
                                    $fields= FormFields::model()->getDynamicFields(4, 1, "forStudentProfile");
                                    if($fields)
                                    {
                                        foreach ($fields as $key => $field) 
                                        {							
                                            if($field->form_field_type!=NULL)
                                            {
                                                if(FormFields::model()->isVisible($field->varname,'StudentPreviousDatas','forStudentProfile'))
                                                {
                                                    ?>    
                                                        <div class="tabl">
                                                        <div class="fist-sections"><?php echo $prev->getAttributeLabel($field->varname);?></div>                                       					<div class="midl-sections">:</div>
                                                        <div class="last-sections">
														<?php
														 $field_name = $field->varname;
                                                          if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                            echo FormFields::model()->getFieldValue($prev->$field_name);
                                                          }
                                                          else if($field->form_field_type==6){  // date value
														  		if($settings!=NULL and $prev->$field_name!=NULL and $prev->$field_name!="0000-00-00"){
																	$date1  = date($settings->displaydate,strtotime($prev->$field_name));
																	echo $date1;
																}
																else{
																	if($prev->$field_name!=NULL and $prev->$field_name!="0000-00-00"){
																		echo $prev->$field_name;
																	}
																	else{
																		echo '-';
																	}
																}
																
                                                          }
                                                          else{
                                                            echo (isset($prev->$field_name) and $prev->$field_name!="")?$prev->$field_name:"-";
                                                          }
                                                        ?>
														</div>
                                                    </div><?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                   
                                    <!-- DYNAMIC FIELDS END -->                                   	
                                </div>
								
								
<?php
				$i++;
			}			
		}
		
	}
?>                                
							</div>						
						</div>	
						
<div class="section_div"></div>		

				</div>
			</div>
            </div>
            </div>
    	</td>
	</tr>
</table>
<script type="text/javascript">
	$(".accordion").accordion();
</script> 
