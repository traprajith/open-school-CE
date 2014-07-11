<style>
.listbxtop_hdng
{
	font-size:15px;	
	/*color:#1a7701;*/
	/*text-shadow: 0.1em 0.1em #FFFFFF;*/
	/*font-weight:bold;*/
	text-align:left;
	
}
.table_listbx tr td, tr th {
border-left:1px solid #ccc;
border-top:1px solid #ccc;
border-right:1px solid #ccc;

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
	background:#DFDFDF;
}
td.subhdng_nrmal
{
	color:#333333;
	font-size:14px;
	width:450px;	
}
.table_listbx
{
	margin:0px;
	padding:0px;
	/*width:1061px;*/
	
}
.table_listbx td
{
	padding:10px 0px 10px 10px;
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
	border-bottom:1px solid #ccc;
}
.first
{
	border:none;
}
</style>
<div class="atnd_Con" style="padding-left:20px; padding-top:30px;">
<!-- Header -->
	<div style="border-bottom:#666 1px; width:700px; padding-bottom:20px;">
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first">
                           <?php $logo=Logo::model()->findAll();?>
                            <?php
                            if($logo!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" width="100%" />';
                            }
                            ?>
                </td>
                <td align="center" valign="middle" class="first" style="width:300px;">
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
                                <?php echo 'Phone: '.$college[2]->config_value; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <!-- End Header -->
<?php
  if(isset($_REQUEST['id']))
  {
?>
	<br /><br />
    <span align="center"><h4>EMPLOYEE PROFILE</h4></span>
    <table class="table_listbx" width="100%" cellspacing="0" cellpadding="0">
      
         <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Employee Name</strong>');?></td>
           <td class="subhdng_nrmal odd"><?php echo ucfirst($model->first_name).' '.ucfirst($model->last_name); ?></td>    
        </tr>
        
		<tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Joining Date</strong>');?></td>
             <td class="subhdng_nrmal">
			 <?php 
			 	if($model->joining_date!=NULL)
				{
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings!=NULL)
					{	
						$date1=date($settings->displaydate,strtotime($model->joining_date));
						echo $date1;
	
					}
					else
					echo $model->joining_date; 
				}
				else
				{
					echo '-';
				}
			?>
			</td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Date of Birth</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
				<?php 
				if($model->date_of_birth!=NULL)
				{
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings!=NULL)
					{	
						$model->date_of_birth=date($settings->displaydate,strtotime($model->date_of_birth));
						echo $model->date_of_birth;
	
					}
					else
					{
					echo $model->date_of_birth; 
					}
				}
				else
				{
					echo '-';
				}
				?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Gender</strong>');?></td>
           
            <td class="subhdng_nrmal">
				<?php 
				if($model->gender=='M')
					echo 'Male';
				elseif($model->gender=='F') 
					echo 'Female';	
				else
					echo '-';
				?>
            </td>
        </tr>
        
        <tr>
           <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Department</strong>');?></td>
           <td class="subhdng_nrmal odd">
		   <?php
			$dep  = EmployeeDepartments::model()->findByAttributes(array('id'=>$model->employee_department_id));
			if($dep!=null)
			{ 
				echo ucfirst($dep->name); 
			} 
			?>
            </td>
		</tr>
        
        
        <tr>
           <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Position</strong>');?></td>
           <td class="subhdng_nrmal">
		   <?php 
            $pos  = EmployeePositions::model()->findByAttributes(array('id'=>$model->employee_position_id));
            if($pos!=null)
            { 
				echo $pos->name ; 
			} 
			else
			{
				echo '-';
			}?>
             </td>
		</tr>
        
        <tr>
           <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Category</strong>');?></td>
           <td class="subhdng_nrmal odd">
		   		<?php
				$posts=EmployeeCategories::model()->findByAttributes(array('id'=>$model->employee_category_id));
				 if($posts!=null)
				 { 
				 	echo ucfirst($posts->name) ; 
				 }
				 else
				 {
					 echo '-';
				 }
			 ?>
             </td>
		</tr>
        
        <tr>
           <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Grade</strong>');?></td>
           <td class="subhdng_nrmal">
		   		<?php
				$posts=EmployeeGrades::model()->findByAttributes(array('id'=>$model->employee_grade_id));
				 if($posts!=null)
				 { 
				 	echo ucfirst($posts->name) ; 
				 }
				 else
				 {
					 echo '-';
				 }
			 ?>
             </td>
		</tr>
        
         
        
        <tr>
           <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Job Title</strong>');?></td>
           <td class="subhdng_nrmal odd">
		   		<?php
				
				 if($model->job_title!=NULL)
				 { 
				 	echo ucfirst($model->job_title) ; 
				 }
				 else
				 {
					 echo '-';
				 }
			 ?>
             </td>
		</tr>
        
        
        
         <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Qualification</strong>');?></td>
          
            <td class="subhdng_nrmal">
			<?php 
			if($model->qualification!=NULL)
				echo $model->qualification;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Total Experiance</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->experience_year)
				echo $model->experience_year.' year(s)';
			elseif($model->experience_month)
				echo ' '.$model->experience_month.' month(s)';
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Experiance Info</strong>');?></td>
           
            <td class="subhdng_nrmal">
			<?php 
			if($model->experience_detail!=NULL)
				echo $model->experience_detail;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Nationality</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->nationality_id!=NULL)
			{
				$nationality=Countries::model()->findByAttributes(array('id'=>$model->nationality_id));
				if($nationality!=NULL)
				{
					echo $nationality->name;
				}
				else
				{
					echo '-';
				}
			}
			else
			{
				echo '-';
			}
			?>
            </td>
        </tr>
        
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Address</strong>');?></td>
          
            <td class="subhdng_nrmal" style="line-height:20px;">
				<?php if($model->home_address_line1!=NULL){echo $model->home_address_line1."<br />";} ?>
                <?php if($model->home_address_line2!=NULL){echo $model->home_address_line2."<br />";} ?>
                <?php if($model->home_city!=NULL){echo $model->home_city."<br />";} ?>
                <?php if($model->home_country_id!=NULL){$count = Countries::model()->findByAttributes(array('id'=>$model->home_country_id));
                    if(count($count)!=0)
                    echo $count->name."<br>"; }?>
                <?php if($model->home_pin_code!=NULL){echo $model->home_pin_code."<br />";} ?>
            </td>
        </tr>
        
        <tr>
           <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Email</strong>');?></td>
           <td class="subhdng_nrmal odd">
		   		<?php
				
				 if($model->email!=NULL)
				 { 
				 	echo $model->email ; 
				 }
				 else
				 {
					 echo '-';
				 }
			 ?>
             </td>
		</tr>
        
         <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Mobile No.</strong>');?></td>
           
            <td class="subhdng_nrmal">
			<?php 
			if($model->mobile_phone!=NULL)
				echo $model->mobile_phone;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Home Phone No.</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->home_phone!=NULL)
				echo $model->home_phone;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Office Phone 1</strong>');?></td>
           
            <td class="subhdng_nrmal">
			<?php 
			if($model->office_phone1!=NULL)
				echo $model->office_phone1;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Office Phone 2</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->office_phone2!=NULL)
				echo $model->office_phone2;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Fax</strong>');?></td>
           
            <td class="subhdng_nrmal">
			<?php 
			if($model->fax!=NULL)
				echo $model->fax;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Marital Status</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->marital_status!=NULL)
				echo $model->marital_status;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng"><?php echo Yii::t('employees','<strong>Children Count</strong>');?></td>
           
            <td class="subhdng_nrmal">
			<?php 
			if($model->children_count!=NULL)
				echo $model->children_count;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        <tr>
            <td class="listbx_subhdng odd"><?php echo Yii::t('employees','<strong>Blood Group</strong>');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->blood_group!=NULL)
				echo $model->blood_group;
			else
				echo '-';
			?>
            </td>
        </tr>
        
    
    </table>
    
<?php 
  }
?>
</div>