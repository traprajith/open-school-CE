<style>
.listbxtop_hdng
{
	font-size:15px;	
	/*color:#1a7701;*/
	/*text-shadow: 0.1em 0.1em #FFFFFF;*/
	/*font-weight:bold;*/
	text-align:left;
	
}

table.table_listbx{ border-collapse:collapse}

.table_listbx tr td, tr th {
border:1px solid #C5CED9;

}
td.listbx_subhdng
{
	color:#333333;
	font-size:13px;	
	font-weight:bold;
	width:200px;
		
}

.odd
{
	background:#DCE6F2;
}
td.subhdng_nrmal
{
	color:#333333;
	font-size:14px;
	width:510px;	
}
.table_listbx
{
	margin:0px;
	padding:0px;
	/*width:1061px;*/
	
}
.table_listbx td
{
	padding:8px 0px 8px 10px;
	margin:0px;
	
	
}
.table_listbxlast td
{
	border-bottom:none;
	
}


td.subhdng_nrmal
{
	color:#333333;
	font-size:12px;	
}
.last
{
	border-bottom:1px solid #C5CED9;
}
.first
{
	border:none;
}
hr{ border-bottom:1px solid #ccc; border-top:0px solid #fff;}
</style>


<?php
 $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
 $batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$_REQUEST['id'], 'batch_id'=>$model->batch_id, 'status'=>1));
  if(isset($_REQUEST['id']))
  {
?>
	<!-- Header -->
	
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td width="100">
                           <?php $filename=  Logo::model()->getLogo();
									if($filename!=NULL)
									{
                                echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
                            		}
                            ?>
                </td>
                <td  valign="middle" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:22px; width:300px;  padding-left:10px;">
                                <?php $college=Configurations::model()->findAll(); ?>
                                <?php echo $college[0]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo $college[1]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo Yii::t('app','Phone:')." ".$college[2]->config_value; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <hr />
    <br />
    <!-- End Header -->
    
    <div align="center" style="text-align:center; font-size:18px; display:block;"><?php echo Yii::t('app','STUDENT PROFILE'); ?></div><br />
   
    <table class="table_listbx" width="100%" cellspacing="0" cellpadding="0"> 
        <tr class="listbxtop_hdng">
     	
            <td class="" width="200">
			<?php
			if(FormFields::model()->isVisible("fullname", "Students", 'forStudentProfilePdf'))
			{
				 echo Yii::t('app','Name');
			} 
			else
			{
				echo ' ';
			}
			?></td>
            <td class=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="border:none;" width="260">
					<?php
					 if(FormFields::model()->isVisible("fullname", "Students", 'forStudentProfilePdf'))
					 { 
					 echo $model->studentFullName('forStudentProfilePdf');
					 }?>
                   </td>
                    <td style="border:none;">
                    <?php 
                    if($model->photo_file_name)
                    { 
						$path = Students::model()->getProfileImagePath($model->id);
						
                    ?>
                    	

                   		<img src="<?php echo $path; ?>" alt="<?php echo $model->photo_file_name; ?>" class="imgbrder" width="150" style="border:4px #000 solid;"/>
                   <?php 
                    }
                    else
                    { 
                       if($model->gender == 'F')
                       {
                       ?>
                       <img  src="images/s_prof_fe_image.png" width="150" style="border:4px #CCCCCC solid;" alt="<?php echo $model->first_name; ?>"/> 
                       <?php 
                       } 
                       else 
                       { ?>
                       
                       <img  src="images/s_prof_m_image.png" width="150" style="border:4px #CCCCCC solid;" alt="<?php echo $model->first_name; ?>"/> 
                       
                       <?php 
                       }
                   
                    } ?>
                    </td>
                  </tr>
                </table></td>
                
        </tr>
        <tr>
        	<td colspan="2" style="background-color:#BFD0F7; color:#06C; font-size:13px;"><?php echo Yii::t('app','PERSONAL DETAILS');?></td>
        </tr>
        	 <tr>
                <td class=""><?php echo Yii::t('app','Roll No');?></td>
                <td class=""><?php if($batch_student!=NULL and $batch_student->roll_no!=0){
										echo $batch_student->roll_no;
									}
									else{
										echo '-'; 
									}
								?>		
                </td>
            </tr>
        <?php if(FormFields::model()->isVisible('admission_no','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('admission_no');?></td>
                <td class=""><?php echo $model->admission_no; ?></td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('admission_date','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('admission_date');?></td>
                <td class=""><?php if($settings!=NULL and $model->admission_date!=NULL)
                                            {	
                                                $date1=date($settings->displaydate,strtotime($model->admission_date));
                                                echo $date1;
                    
                                            }
                                            else
											{
                                            echo '-';
											}
                                            ?>
                </td>
            </tr>
         <?php } ?>
          <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfilePdf')){?>
              <tr>
                <td class=""><?php echo Yii::t('app','Course');?> </td>
                <td class=""><?php $posts=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
												if($posts!=NULL){ echo $posts->course123->course_name;}
												else{
													echo '-';
													}?> </td>
            </tr>
         <?php } ?>
         <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('batch_id');?></td>
                <td class=""><?php $posts=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
												if($posts!=NULL){
													echo $posts->name; 
												}
												else{
													echo '-';
												}?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('national_student_id','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('national_student_id');?></td>
                <td class="">
                    <?php 
                        if($model->national_student_id!=NULL)
                        {
                            echo $model->national_student_id;
                        }
                        else
                        {
                            echo '-';
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
        
       
         <?php if(FormFields::model()->isVisible('date_of_birth','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('date_of_birth');?></td>
                <td class="">
                    <?php if($model->date_of_birth!=NULL)
                            {
                                if($settings!=NULL)
                                {	
                                    $date1=date($settings->displaydate,strtotime($model->date_of_birth));
                                    echo $date1;
                
                                }
                                else
                                echo $model->date_of_birth;  
                            }
                            else
                            {
                                echo '-';	
                            }
                            ?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('gender');?></td>
                <td class="">
                    <?php if($model->gender=='M')
                            echo Yii::t('app','Male');
                        else if($model->gender=='F')
                            echo Yii::t('app','Female');
                        else
                            echo '-'; ?>
                </td>
            
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('blood_group','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('blood_group');?></td>
                <td class="">
                    <?php 
                        if($model->blood_group!=NULL)
                        {
                            echo $model->blood_group;
                        }
                        else
                        {
                            echo '-';
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('birth_place','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('birth_place');?></td>
                <td class="">
                    <?php 
                        if($model->birth_place!=NULL)
                        {
                            echo $model->birth_place;
                        }
                        else
                        {
                            echo '-';
                        }
        ?>
                </td>
            </tr>
        <?php } ?>
        
         <?php if(FormFields::model()->isVisible('nationality_id','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('nationality_id');?></td>
                <td class="">
                    <?php 
                    if($model->nationality_id!=NULL)
                    {
                        $natio_id=Nationality::model()->findByAttributes(array('id'=>$model->nationality_id));
                        echo $natio_id->name; 
                    }
                    else{
                        echo '-';
                    }?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('language','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('language');?></td>
                <td class="">
                    <?php 
                    if($model->language!=NULL)
                    {
                        echo $model->language;
                    }
                    else{
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('religion','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('religion');?></td>
                <td class="">
                    <?php 
                    if($model->religion!=NULL)
                    {
                        echo $model->religion; 
                    }
                    else
                    {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        <?php if(FormFields::model()->isVisible('student_category_id','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('student_category_id');?></td>
                <td class="">
                    <?php 
                    if($model->student_category_id!=NULL)
                    {
                        $cat =StudentCategories::model()->findByAttributes(array('id'=>$model->student_category_id));
                        if($cat!=null)
                        { 
                            echo $cat->name;  
                        }
                    }
                    else{
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
         <?php } ?>    
             <!-- DYNAMIC FIELDS START -->
                                    <?php 
                                    $fields= FormFields::model()->getDynamicFields(1, 1, "forStudentProfile");
                                    if($fields)
                                    {
                                        foreach ($fields as $key => $field) 
                                        {							
                                            if($field->form_field_type!=NULL)
                                            {
                                                if(FormFields::model()->isVisible($field->varname,'Students','forStudentProfile'))
                                                {
                                                    ?>  
                                                    <tr>  
                                                        <td class=""><?php echo $model->getAttributeLabel($field->varname);?></td>                                       
                                                        <td class="">
																	<?php
                                                                     $field_name = $field->varname;
                                                                      if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                                        echo FormFields::model()->getFieldValue($model->$field_name);
                                                                      }
                                                                      else if($field->form_field_type==6){  // date value
                                                                        if($settings!=NULL){
                                                                          $date1  = date($settings->displaydate,strtotime($model->$field_name));
                                                                          echo $date1;
                                                                        }
                                                                        else{
                                                                          echo $model->$field_name;
                                                                        }
                                                                      }
                                                                      else{
                                                                        echo (isset($model->$field_name) and $model->$field_name!="")?$model->$field_name:"-";
                                                                      }
                                                                    ?>
														                 
                                                         </td>
                                                    </tr>                        
                                                    <?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->
       
         <tr>
        	<td colspan="2" style="background-color:#BFD0F7; color:#06C; font-size:13px;"><?php echo Yii::t('app','CONTACT DETAILS');?></td>
        </tr>
        
        <?php if(FormFields::model()->isVisible('address_line1','Students','forStudentProfilePdf')){?>
            <tr>
                <td width="200"><?php echo $model->getAttributeLabel('address_line1');?></td>
                <td class=""><?php if($model->address_line1!=NULL)
									{
										echo $model->address_line1; 
									}
									else
									{
										echo '-';
									}
									?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('address_line2','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('address_line2');?></td>
                <td class=""><?php if($model->address_line2!=NULL)
									{
										echo $model->address_line2; 
									}
									else
									{
										echo '-';
									}
									?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('city','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('city');?></td>
                <td class=""><?php if($model->city!=NULL)
												{
													echo $model->city; 
												}
												else
												{
													echo '-';
												}
												?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('state','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('state');?></td>
                <td class=""><?php if($model->state!=NULL)
												{
													echo $model->state; 
												}
												else
												{
													echo '-';
												}
												?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('pin_code','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('pin_code');?></td>
                <td class=""><?php if($model->pin_code!=NULL)
													{
														echo $model->pin_code; 
													}
													else
													{
														echo '-';
													}
													?></td>
            </tr>
        <?php } ?>
        
        
        <?php if(FormFields::model()->isVisible('country_id','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('country_id');?></td>
                <td class="" >
                    <?php
                    if($model->country_id!=NULL)
                    {
                        $posts=Countries::model()->findByAttributes(array('id'=>$model->country_id));
                        echo $posts->name; 
                    }
                    else
                    {
                        echo '-';
                    }?>
                 </td>
            </tr>
        <?php } ?>
        
         <?php if(FormFields::model()->isVisible('phone1','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('phone1');?></td>
                <td class=""><?php if($model->phone1!=NULL)
													{
														echo $model->phone1; 
													}
													else
													{
														echo '-';
													}
													?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('phone2','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('phone2');?></td>
                <td class=""><?php if($model->phone2!=NULL)
													{
														echo $model->phone2; 
													}
													else
													{
														echo '-';
													}
													?></td>
            </tr>
        <?php } ?>
        
        <?php if(FormFields::model()->isVisible('email','Students','forStudentProfilePdf')){?>
            <tr>
                <td class=""><?php echo $model->getAttributeLabel('email');?></td>
                <td class=""><?php if($model->email!=NULL)
													{
														echo $model->email; 
													}
													else
													{
														echo '-';
													}
													?></td>
            </tr>
            <!-- DYNAMIC FIELDS START -->
                                    <?php 
                                    $fields= FormFields::model()->getDynamicFields(1, 2, "forStudentProfile");
                                    if($fields)
                                    {
                                        foreach ($fields as $key => $field) 
                                        {							
                                            if($field->form_field_type!=NULL)
                                            {
                                                if(FormFields::model()->isVisible($field->varname,'Students','forStudentProfile'))
                                                {
                                                    ?>  
                                                    <tr>  
                                                        <td class="last"><?php echo $model->getAttributeLabel($field->varname);?></td>
                                                        <td class="last">
														
															<?php
                                                             $field_name = $field->varname;
                                                              if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                                echo FormFields::model()->getFieldValue($model->$field_name);
                                                              }
                                                              else if($field->form_field_type==6){  // date value
                                                                if($settings!=NULL){
                                                                  $date1  = date($settings->displaydate,strtotime($model->$field_name));
                                                                  echo $date1;
                                                                }
                                                                else{
                                                                  echo $model->$field_name;
                                                                }
                                                              }
                                                              else{
                                                                echo (isset($model->$field_name) and $model->$field_name!="")?$model->$field_name:"-";
                                                              }
                                                            ?>
														</td>
                                                    </tr>                        
                                                    <?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->
        <?php } ?>
       
    </table>
    <br />
    <?php
	  $guardian_list_data= GuardianList::model()->findAllByAttributes(array('student_id'=>$model->id));
	  if($guardian_list_data)
	  {
	?>	  
        <div align="center" style="text-align:center; font-size:18px; display:block;"><?php echo Yii::t('app','GUARDIAN DETAILS'); ?></div><br />
        <?php 
 
      foreach($guardian_list_data as $key=>$data)
      {
        $guardian_model= Guardians::model()->findByPk($data->guardian_id);
        if($guardian_model)
        {      
          ?>
     
        <table class="table_listbx" width="100%" cellspacing="0" cellpadding="0">
            <tr>
            	<td colspan="2" style="background-color:#BFD0F7; color:#06C; font-size:13px;"><?php echo Yii::t('app','PERSONAL DETAILS');?></td>
            </tr>
         <?php if(FormFields::model()->isVisible('first_name','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('first_name');?></td>
                <td class=""><?php echo ucfirst($guardian_model->first_name);?></td>
             </tr>
         <?php } ?>
         <?php if(FormFields::model()->isVisible('last_name','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('last_name');?></td>
                <td class=""><?php echo ucfirst($guardian_model->last_name);?></td>
             </tr>
         <?php } ?>
         <?php if(FormFields::model()->isVisible('relation','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('relation');?></td>
                <td class=""><?php if($guardian_model->relation!=NULL)
													{
														echo $guardian_model->relation; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
          <?php if(FormFields::model()->isVisible('dob','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('dob');?></td>
                <td class=""><?php if($model->date_of_birth!=NULL)
                            {
                                if($settings!=NULL)
                                {	
                                    $date1=date($settings->displaydate,strtotime($model->date_of_birth));
                                    echo $date1;
                
                                }
                                else
                                echo $model->date_of_birth;  
                            }
                            else
                            {
                                echo '-';	
                            }
                            ?></td>
										  
             </tr>
         <?php } ?>
          <?php if(FormFields::model()->isVisible('education','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('education');?></td>
                <td class=""><?php if($guardian_model->education!=NULL)
													{
														echo $guardian_model->education; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         <?php if(FormFields::model()->isVisible('occupation','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('occupation');?></td>
                <td class=""><?php if($guardian_model->occupation!=NULL)
													{
														echo $guardian_model->occupation; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         <?php if(FormFields::model()->isVisible('income','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('income');?></td>
                <td class=""><?php if($guardian_model->income!=NULL)
													{
														echo $guardian_model->income; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
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
                                                    <tr>  
                                                        <td class="last"><?php echo $guardian_model->getAttributeLabel($field->varname);?></td>
                                                        <td class="last">
														<?php
														 $field_name = $field->varname;
														  if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
															echo FormFields::model()->getFieldValue($guardian_model->$field_name);
														  }
														  else if($field->form_field_type==6){  // date value
															if($settings!=NULL){
															  $date1  = date($settings->displaydate,strtotime($guardian_model->$field_name));
															  echo $date1;
															}
															else{
															  echo $guardian_model->$field_name;
															}
														  }
														  else{
															echo (isset($guardian_model->$field_name) and $guardian_model->$field_name!="")?$guardian_model->$field_name:"-";
														  }
														?>
														
														</td>
                                                    </tr>                        
                                                    <?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->
         <?php } ?>
         <tr>
        	<td colspan="2" style="background-color:#BFD0F7; color:#06C; font-size:13px;"><?php echo Yii::t('app','CONTACT DETAILS');?></td>
    	</tr>
         <?php if(FormFields::model()->isVisible('email','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('email');?></td>
                <td class=""><?php if($guardian_model->email!=NULL)
													{
														echo $guardian_model->email; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
         <?php if(FormFields::model()->isVisible('mobile_phone','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('mobile_phone');?></td>
                <td class=""><?php if($guardian_model->mobile_phone!=NULL)
													{
														echo $guardian_model->mobile_phone; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
          <?php if(FormFields::model()->isVisible('office_phone1','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('office_phone1');?></td>
                <td class=""><?php if($guardian_model->office_phone1!=NULL)
													{
														echo $guardian_model->office_phone1; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
         <?php if(FormFields::model()->isVisible('office_phone2','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('office_phone2');?></td>
                <td class=""><?php if($guardian_model->office_phone2!=NULL)
													{
														echo $guardian_model->office_phone2; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
          <?php if(FormFields::model()->isVisible('office_address_line1','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('office_address_line1');?></td>
                <td class=""><?php if($guardian_model->office_address_line1!=NULL)
													{
														echo $guardian_model->office_address_line1; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
         <?php if(FormFields::model()->isVisible('office_address_line2','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('office_address_line2');?></td>
                <td class=""><?php if($guardian_model->office_address_line2!=NULL)
													{
														echo $guardian_model->office_address_line2; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
          <?php if(FormFields::model()->isVisible('city','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('city');?></td>
                <td class=""><?php if($guardian_model->city!=NULL)
													{
														echo $guardian_model->city; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
         <?php if(FormFields::model()->isVisible('state','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('state');?></td>
                <td class=""><?php if($guardian_model->state!=NULL)
													{
														echo $guardian_model->state; 
													}
													else
													{
														echo '-';
													}
													?></td>
             </tr>
         <?php } ?>
         
          <?php if(FormFields::model()->isVisible('country_id','Guardians','forStudentProfilePdf')){?>   
              <tr>    
                <td class="" width="200"><?php echo $guardian_model->getAttributeLabel('country_id');?></td>
                <td class=""><?php if($guardian_model->country_id){
				$count = Countries::model()->findByAttributes(array('id'=>$guardian_model->country_id));
																if(count($count)!=0)
																echo $count->name;
				}
				else
				{
					echo '-';
				}?></td>
             </tr>
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
                                                    <tr>  
                                                        <td class=""><?php echo $guardian_model->getAttributeLabel($field->varname);?></td>
                                                        <td class="">
														<?php
														 $field_name = $field->varname;
														  if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
															echo FormFields::model()->getFieldValue($guardian_model->$field_name);
														  }
														  else if($field->form_field_type==6){  // date value
															if($settings!=NULL){
															  $date1  = date($settings->displaydate,strtotime($guardian_model->$field_name));
															  echo $date1;
															}
															else{
															  echo $guardian_model->$field_name;
															}
														  }
														  else{
															echo (isset($guardian_model->$field_name) and $guardian_model->$field_name!="")?$guardian_model->$field_name:"-";
														  }
														?>
														</td>
                                                    </tr>                        
                                                    <?php
                                                } 
                                            } 				                                            
                                        }
                                    }
                                    ?>
                                    <!-- DYNAMIC FIELDS END -->
        
         
          </table>
        <br />
              <?php

        }
       
      }
  }
 
  ?>            
    
<?php
  }
?>
