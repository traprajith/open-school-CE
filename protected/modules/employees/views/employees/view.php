<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/woco.accordion.min.js"></script>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers')=>array('index'),
	Yii::t('app','View'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top"><?php $this->renderPartial('profileleft');?></td>
        <td valign="top">
        	<div class="cont_right formWrapper">
            		  <h1><?php echo Yii::t('app','Teacher Profile');?></h1> 


<div class="button-bg">
<div class="top-hed-btn-left"></div>
                            <div class="top-hed-btn-right">
                                    <ul>                                    
 <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$_REQUEST['id']),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
<li><?php echo CHtml::link('<span>'.Yii::t('app','Teachers').'</span>', array('employees/manage'),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>                                  
                                    </ul>
                                </div> 
                                
                                
                            </div>
                <?php
					$settings = UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				?>
                <div class="emp_right_contner">
    				<div class="emp_tabwrapper">
                      <?php $this->renderPartial('tab');?>
                        <div class="clear"></div>
                                        
                               <div class="pdf-box">
                                    <div class="box-one"></div>
                                        <div class="box-two">
                                                <div class="pdf-div"><?php echo CHtml::link(Yii::t('app','Generate PDF'), array('Employees/pdf','id'=>$_REQUEST['id']),array('target'=>'_blank','class'=>'pdf_but')); ?></div>
                                        </div>
                                </div>
                	
                        <div class="emp_cntntbx">
                        	<div class="cordn-h3">
                            	<span>
                                    <h3><?php echo Yii::t('app','TEACHER DETAILS');?></h3>                                       
                                </span>
                                <div class="accordion">
                                	<h1><?php echo Yii::t('app','General Details'); ?></h1>
                                    <div>
                                    	<div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('employee_number');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->employee_number){
														echo $model->employee_number;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('joining_date');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->joining_date != NULL and $model->joining_date != '0000-00-00'){
														if($settings){
															echo date($settings->displaydate, strtotime($model->joining_date));
														}
														else{
															echo $model->joining_date;
														}
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('gender');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->gender == 'M'){
														echo Yii::t('app','Male');
													}
													elseif($model->gender == 'F') {
														echo Yii::t('app','Female');
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('date_of_birth');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->date_of_birth != NULL and $model->date_of_birth != '0000-00-00'){
														if($settings){
															echo date($settings->displaydate, strtotime($model->date_of_birth));
														}
														else{
															echo $model->date_of_birth;
														}
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('employee_department_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->employee_department_id){
														$department = EmployeeDepartments::model()->findByAttributes(array('id'=>$model->employee_department_id));
														if($department){
															echo ucfirst($department->name);
														}
														else{
															echo '-';
														}
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('employee_position_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->employee_position_id){
														$position = EmployeePositions::model()->findByAttributes(array('id'=>$model->employee_position_id));
														if($position){
															echo ucfirst($position->name);
														}
														else{
															echo '-';
														}
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('employee_category_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->employee_category_id){
														$category = EmployeeCategories::model()->findByAttributes(array('id'=>$model->employee_category_id));
														if($category){
															echo ucfirst($category->name);
														}
														else{
															echo '-';
														}
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('employee_grade_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->employee_grade_id){
														$grade = EmployeeGrades::model()->findByAttributes(array('id'=>$model->employee_grade_id));
														if($grade){
															echo ucfirst($grade->name);
														}
														else{
															echo '-';
														}
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('job_title');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->job_title){
														echo ucfirst($model->job_title);
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('qualification');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->qualification){
														echo ucfirst($model->qualification);
													}													
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo Yii::t('app','Total Experience');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->experience_year and !$model->experience_month)
														echo $model->experience_year." ".Yii::t('app','year(s)');
													elseif(!$model->experience_year and $model->experience_month)
														echo ' '.$model->experience_month." ".Yii::t('app','month(s)');
													elseif($model->experience_year and $model->experience_month)
														echo $model->experience_year." ".Yii::t('app','year(s)')." ".Yii::t('app','and')." ".$model->experience_month." ".Yii::t('app','month(s)');
													else
														echo '-';
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('experience_detail');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->experience_detail){
														echo ucfirst($model->experience_detail);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                    </div>
                                    <h1><?php echo Yii::t('app','Personal Details'); ?></h1>
                                    <div>
                                    	<div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('marital_status');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->marital_status){
														echo ucfirst($model->marital_status);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('children_count');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->children_count){
														echo $model->children_count;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('father_name');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->father_name){
														echo ucfirst($model->father_name);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('mother_name');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->mother_name){
														echo ucfirst($model->mother_name);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('husband_name');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->husband_name){
														echo ucfirst($model->husband_name);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
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
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('nationality_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->nationality_id){
														$nationality = Nationality::model()->findByPk($model->nationality_id);
														if($nationality){
															echo ucfirst($nationality->name);
														}
														else{
															echo '-';
														}
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>                                        
                                    </div>
                                    <h1><?php echo Yii::t('app','Home Address'); ?></h1>
                                    <div>
                                    	<div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_address_line1');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_address_line1){
														echo ucfirst($model->home_address_line1);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_address_line2');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_address_line2){
														echo ucfirst($model->home_address_line2);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_city');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_city){
														echo ucfirst($model->home_city);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_state');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_state){
														echo ucfirst($model->home_state);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_country_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_country_id){
														$home_country = Countries::model()->findByPk($model->home_country_id);
														if($home_country){
															echo ucfirst($home_country->name);
														}
														else{
															echo '-';
														}														
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_pin_code');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_pin_code){
														echo $model->home_pin_code;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>                                                                                
                                    </div>
                                    <h1><?php echo Yii::t('app','Office Address'); ?></h1>
                                    <div>
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
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_city');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_city){
														echo ucfirst($model->office_city);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div> 
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_state');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_state){
														echo ucfirst($model->office_state);
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_country_id');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_country_id){
														$office_country = Countries::model()->findByPk($model->office_country_id);
														if($office_country){
															echo ucfirst($office_country->name);
														}
														else{
															echo '-';
														}														
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_pin_code');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_pin_code){
														echo $model->office_pin_code;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>                                        
                                    </div>
                                    <h1><?php echo Yii::t('app','Contact Details'); ?></h1>
                                    <div>
                                    	<div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_phone1');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_phone1){
														echo $model->office_phone1;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('office_phone2');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->office_phone2){
														echo $model->office_phone2;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('mobile_phone');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->mobile_phone){
														echo $model->mobile_phone;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('home_phone');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->home_phone){
														echo $model->home_phone;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
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
                                        <div class="tabl">
                                            <div class="fist-sections"><?php echo $model->getAttributeLabel('fax');?></div>
                                            <div class="midl-sections">:</div>
                                            <div class="last-sections">
                                            	<?php 
													if($model->fax){
														echo $model->fax;
													}
													else{
														echo '-';
													}
												?>		
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
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