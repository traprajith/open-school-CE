<style>
.dd{
	color:#0F0;
}
table.list{
	border-right:1px #CCC solid;
	border-top:1px #CCC solid;
	font-size:12px;
}
tr.odd{
	background:#dfdfdf;
}
table.list td{
	padding:15px 10px;
	border-left:1px #CCC solid;
	border-bottom:1px #CCC solid;
}
</style>
<div style="margin:50px 50px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="280"><?php $logo=Logo::model()->findAll();?>
                <?php
                if($logo!=NULL)
				{
					Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
				}
                ?></td>
    <td valign="middle" align="right" ><span style="color:#1a7701; font-weight:bold; font-size:18px; text-align:center;"><?php $college=Configurations::model()->findByPk(1); ?><?php echo $college->config_value ; ?></span></td>
  </tr>
</table>
<hr style="border:1px #666 solid;" />
<table width="800" cellpadding="0" cellspacing="0" class="list">
	
	 <tr class="odd">
        <td width="300"><?php echo Yii::t('employees','<strong>Employee Name</strong>');?></td>
        
        <td width="270"><?php echo $model->first_name; ?></td>
    </tr>
    <tr>
        <td><?php echo Yii::t('employees','<strong>Joining Date</strong>');?></td>
       
        <td><?php 
						$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										if($settings!=NULL)
										{	
											$date1=date($settings->displaydate,strtotime($model->joining_date));
											echo $date1;
		
										}
										else
										echo $model->joining_date; 
										?></td>
    </tr>
        <tr class="odd">
        <td ><?php echo Yii::t('employees','<strong>Category</strong>');?></td>
       
        <td><?php
		$posts=EmployeeCategories::model()->findByAttributes(array('id'=>$model->employee_category_id));
		 if($posts!=null)
		 { echo $posts->name ; } ?></td>
    </tr>
        <tr>
        <td><?php echo Yii::t('employees','<strong>Grade</strong>');?></td>
       
        <td><?php	
        $posts=EmployeeGrades::model()->findByAttributes(array('id'=>$model->employee_grade_id));
		 if($posts!=null)
		 { echo $posts->name; } ?></td>
    </tr>
        <tr class="odd">
        <td><?php echo Yii::t('employees','<strong>Manager</strong>');?></td>
       
        <td><?php
		//$ee = EmployeeGrades::model()->findByAttributes(array('id'=>$model->reporting_manager_id));
		 //echo $ee->name; ?></td>
    </tr>
        <tr >
        <td ><?php echo Yii::t('employees','<strong>Status</strong>');?></td>
       
        <td><?php echo $model->status; ?></td>
    </tr>
        <tr class="odd">
        <td><?php echo Yii::t('employees','<strong>Total Experiance</strong>');?></td>
       
        <td><?php echo $model->experience_year; ?></td>
    </tr>
    <tr>
        <td><?php echo Yii::t('employees','<strong>Department</strong>');?></td>
      
        <td><?php
		$dep  = EmployeeDepartments::model()->findByAttributes(array('id'=>$model->employee_department_id));
		 if($dep!=null)
		 { echo $dep->name; } ?></td>
    </tr>
    <tr class="odd">
        <td><?php echo Yii::t('employees','<strong>Position</strong>');?></td>
        
        <td><?php 
		$pos  = EmployeePositions::model()->findByAttributes(array('id'=>$model->employee_position_id));
		if($pos!=null)
		{ echo $pos->name ; } ?></td>
    </tr>
    <tr>
        <td><?php echo Yii::t('employees','<strong>Job Title</strong>');?></td>
      
        <td><?php echo $model->job_title; ?></td>
    </tr>
    <tr class="odd">
        <td><?php echo Yii::t('employees','<strong>Gender</strong>');?></td>
       
        <td><?php if($model->gender=='M')
					echo 'Male';
				else 
					echo 'Female';	 ?>
        </td>
    </tr>
    <tr>
        <td><?php echo Yii::t('employees','<strong>Qualification</strong>');?></td>
      
        <td><?php echo $model->qualification; ?></td>
    </tr>
     <tr class="odd">
        <td><?php echo Yii::t('employees','<strong>Experiance Info</strong>');?></td>
       
        <td><?php echo $model->experience_detail; ?></td>
    </tr>
    <tr>
        <td><?php echo Yii::t('employees','<strong>Address</strong>');?></td>
      
        <td><?php if($model->home_address_line1!=NULL){echo $model->home_address_line1."<br />";} ?>
        	<?php if($model->home_address_line2!=NULL){echo $model->home_address_line2."<br />";} ?>
            <?php if($model->home_city!=NULL){echo $model->home_city."<br />";} ?>
            <?php if($model->home_country_id!=NULL){$count = Countries::model()->findByAttributes(array('id'=>$model->home_country_id));
				if(count($count)!=0)
				echo $count->name."<br>"; }?>
            <?php if($model->home_pin_code!=NULL){echo $model->home_pin_code."<br />";} ?>
        </td>
    </tr>
</table>
</div>