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
border:1px solid #C5CED9;
}

.table_listbx table{ border-collapse:collapse;}

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
.table_area table{ border-collapse:collapse;}

.table_area table tr td{ border:1px solid #C5CED9;
	padding:10px;}
	
.table_area table tr th{ border:1px solid #C5CED9;
	padding:15px 10px;
	background:#DCE6F1;}
hr{ border-bottom:1px solid #ccc; border-top:0px solid #fff;}
</style>


<!-- Header -->
	
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first" width="100">
                           <?php $filename=  Logo::model()->getLogo();
									if($filename!=NULL)
									{
										echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
									}
									?>
                </td>
                <td valign="middle">
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
<?php
  if(isset($_REQUEST['id']))
  {
?>

    <div align="center" style="display:block; text-align:center;"><?php echo Yii::t('app','Teacher Subject Association');?></div><br />
    <?php
	
	 $employee = Employees::model()->findByPk($_REQUEST['id']);
	  
	echo Yii::t('app','Teacher Name: ').Employees::model()->getTeachername($employee->id);
	$employee_subs = EmployeesSubjects::model()->findAllByAttributes(array('employee_id'=>$_REQUEST['id']));
	if($employee_subs!=NULL)
	{
?>   
	<br />
    <br />
	<div style="font-weight:600;font-size:15px;"><?php echo Yii::t('app','Subject');?></div>
<div class="table_area">
<table align="left" width="100%" id="table" cellspacing="0" cellpadding="0" class="timetable" >
  <tr>
    <td width="220" align="center"><?php echo Yii::t('app','Name');?></td>
    <td width="210" align="center"><?php echo Yii::t('app','Course');?></td>
    <td width="200" align="center"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></td>
  </tr>
  <?php
  		foreach($employee_subs as $employee_sub)
		{
  			$subjectname = Subjects::model()->findByPk($employee_sub->subject_id);
			$batchdetails = Batches::model()->findByPk($subjectname->batch_id);
			$coursedetails = Courses::model()->findByPk($batchdetails->course_id);
   ?>
   			<tr>
            	<td align="center"><?php echo $subjectname->name;?></td>
                <td align="center"><?php echo $coursedetails->course_name;?></td>
                <td align="center"><?php echo $batchdetails->name;?></td>
            </tr>
   <?php
		}
  ?>
</table>
</div>
  <br />
  <br />
  <?php
	}
  ?>
  <?php
	$employee_elecs = EmployeeElectiveSubjects::model()->findAllByAttributes(array('employee_id'=>$_REQUEST['id']));
	if($employee_elecs!=NULL)
	{
?>
   <br />
   <br />
	<div style="font-weight:600;font-size:15px;"><?php echo Yii::t('app','Electives');?></div>
<div class="table_area">
<table align="left" width="100%" id="table" cellspacing="0" cellpadding="0" class="timetable" >
  <tr>
    <td width="150" align="center"><?php echo Yii::t('app','Elective Name');?></td>
    <td width="150" align="center"><?php echo Yii::t('app','Elective Group');?></td>
    <td width="145" align="center"><?php echo Yii::t('app','Course');?></td>
    <td width="140" align="center"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></td>
  </tr>
  <?php
  		foreach($employee_elecs as $employee_elec)
		{
  			$electivename = Electives::model()->findByPk($employee_elec->elective_id);
			$electivegroupname = ElectiveGroups::model()->findByPk($electivename->elective_group_id);
			$batchdetails = Batches::model()->findByPk($electivegroupname->batch_id);
			$coursedetails = Courses::model()->findByPk($batchdetails->course_id);
   ?>
   			<tr>
            	<td align="center"><?php echo $electivename->name;?></td>
                <td align="center"><?php echo $electivegroupname->name;?></td>
                <td align="center"><?php echo $coursedetails->course_name;?></td>
                <td align="center"><?php echo $batchdetails->name;?></td>
            </tr>
   <?php
		}
  ?>
  </table>
  </div>
  <?php
	}
  ?>
    
<?php 
  }
?>
