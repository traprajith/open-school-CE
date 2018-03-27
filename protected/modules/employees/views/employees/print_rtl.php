<style>
table.table_listbx{
	  border-collapse:collapse;	
}
.table_listbx tr td, tr th {
border-left:1px solid #C5CED9;
border-top:1px solid #C5CED9;
border-right:1px solid #C5CED9;
border-bottom:1px solid #C5CED9;
padding:10px 10px;

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
	border-bottom:1px solid #C5CED9;
}
.first
{
	border:none;
}
hr{ border-bottom:1px solid #ccc; border-top:0px solid #fff;}
	.listbxtop_hdng firs{
	text-align:right; 
	font-size:22px; 
	width:300px;  
	padding-left:10px;	
}
</style>


<!-- Header -->
	
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first" width="100">
                      <?php $filename=  Logo::model()->getLogo();
							if($filename!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
                            }
                            ?>
                </td>
                <td valign="middle" >
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="listbxtop_hdng first">
                                <?php $college=Configurations::model()->findAll(); ?>
                                <?php echo $college[0]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first">
                                <?php echo $college[1]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first">
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
<?php
  if(isset($_REQUEST['id']))
  {
?>

    <div align="center" style="display:block; text-align:center;"><?php echo Yii::t('app','TEACHER PROFILE');?></div><br />
    <table class="table_listbx" width="100%" cellspacing="0" cellpadding="0">
      
         <tr>
            <td width="200"><?php echo Yii::t('app','Teacher Name');?></td>
           <td class="subhdng_nrmal odd"><?php echo Employees::model()->getTeachername($model->id); ?></td>    
        </tr>
        
		<tr>
            <td><?php echo Yii::t('app','Joining Date');?></td>
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
            <td><?php echo Yii::t('app','Date of Birth');?></td>
           
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
            <td><?php echo Yii::t('app','Gender');?></td>
           
            <td class="subhdng_nrmal">
				<?php 
				if($model->gender=='M')
					echo Yii::t('app','Male');
				elseif($model->gender=='F') 
					echo Yii::t('app','Female');	
				else
					echo '-';
				?>
            </td>
        </tr>
        
        <tr>
           <td><?php echo Yii::t('app','Department');?></td>
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
           <td><?php echo Yii::t('app','Position');?></td>
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
           <td><?php echo Yii::t('app','Category');?></td>
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
           <td><?php echo Yii::t('app','Grade');?></td>
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
           <td><?php echo Yii::t('app','Job Title');?></td>
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
            <td><?php echo Yii::t('app','Qualification');?></td>
          
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
            <td><?php echo Yii::t('app','Total Experience');?></td>
           
            <td class="subhdng_nrmal odd">
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
            </td>
        </tr>
        
        <tr>
            <td><?php echo Yii::t('app','Experience Info');?></td>
           
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
            <td><?php echo Yii::t('app','Nationality');?></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->nationality_id!=NULL)
			{
				$nationality=Nationality::model()->findByAttributes(array('id'=>$model->nationality_id));
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
            <td><?php echo Yii::t('app','Address');?></td>
          
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
           <td><?php echo Yii::t('app','Email');?></td>
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
            <td><?php echo Yii::t('app','Mobile No.');?></td>
           
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
            <td><?php echo Yii::t('app','Home Phone No.');?></td>
           
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
            <td><?php echo Yii::t('app','Office Phone 1');?></td>
           
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
            <td><?php echo Yii::t('app','Office Phone 2');?></td>
           
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
            <td><?php echo Yii::t('app','Fax');?></td>
           
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
            <td><?php echo Yii::t('app','Marital Status');?></td>
           
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
            <td><?php echo Yii::t('app','Children Count');?></td>
           
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
            <td style="border-bottom:1px solid #C5CED9;"><?php echo Yii::t('app','Blood Group');?></td>
           
            <td class="subhdng_nrmal odd" style="border-bottom:1px solid #C5CED9;">
			<?php 
			if($model->blood_group!=NULL)
				echo $model->blood_group;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        
              
         <?php /*?><tr>
            <td class="listbx_subhdng last"><strong><?php echo Yii::t('employees','Date of Join');?></strong></td>
           
            <td class="subhdng_nrmal last">
			<?php 
			if($model->date_join!=NULL)
				echo $model->date_join;
			else
				echo '-';
			?>
            </td>
        </tr><?php */?>
        
        
         <?php /*?><tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','Salary Date');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->salary_date!=NULL)
				echo $model->salary_date;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        
         <tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','Bank Name');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->bank_name!=NULL)
				echo $model->bank_name;
			else
				echo '-';
			?>
            </td>
        </tr>
        
         <tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','Bank Account No');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->bank_acc_no!=NULL)
				echo $model->bank_acc_no;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        
         <tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','Basic Pay');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->basic_pay!=NULL)
				echo $model->basic_pay;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        
         <tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','PF');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->PF!=NULL)
				echo $model->PF;
			else
				echo '-';
			?>
            </td>
        </tr>
        
        
         <tr>
            <td class="listbx_subhdng odd"><strong><?php echo Yii::t('employees','TDS');?></strong></td>
           
            <td class="subhdng_nrmal odd">
			<?php 
			if($model->TDS!=NULL)
				echo $model->TDS;
			else
				echo '-';
			?>
            </td>
        </tr>
        <?php */?>
        
   
        
    
    </table>
    
<?php 
  }
?>
