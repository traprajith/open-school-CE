<style>
.attendance_table{
	border-top:1px #CCC solid;
	margin:30px 0px;
	font-size:9px;
	border-right:1px #CCC solid;
	text-align:center;
	/*height:50px;*/
	width:500px;
}
.attendance_table td{
	border-left:1px #CCC solid;
	padding:5px 6px;
	border-bottom:1px #CCC solid;
	width:auto;
	font-size:15px;
	
}

.attendance_table th{
	font-size:15px;
	padding:10px;
	
}

.date_table{
	border:none;
}
</style>
<div class="atnd_Con" style="padding-left:20px; padding-top:30px;">
<?php
 
  if(isset($_REQUEST['id']))
  { ?>
	 
	
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr> 
            <td class="first">
                       <?php $logo=Logo::model()->findAll();?>
                        <?php
                        if($logo!=NULL)
                        { 
							//echo $logo[0]->photo_file_name;
                            //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
							echo '<img src="uploadedfiles/school_logo/'.$logo[0]->photo_file_name.'" alt="'.$logo[0]->photo_file_name.'" class="imgbrder" width="100%" />';
                        }
                        ?>
            </td>
            <td align="center" valign="middle" class="first">
            
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    	<td class="listbxtop_hdng first" style="text-align:center;"></td>
                    </tr>
                    <tr>
                        <td class="listbxtop_hdng first" style="text-align:center; font-size:20px; ">
                        <?php $college=Configurations::model()->findByPk(1); ?>
                        <?php echo $college->config_value ; ?></td>
                    </tr>
                </table>
          
            </td>
      </tr>
</table>
<h4>Employee Attendance Report</h4>
<table width="100%" cellspacing="0" cellpadding="0" class="attendance_table" align="center">
<tr style="background:#dfdfdf;">
    <th><?php  echo Yii::t('attendance','Name');?></th>
    <th><?php echo Yii::t('attendance','Date');?></th>
      <th><?php echo Yii::t('attendance','Halfday');?></th>
        <th><?php echo Yii::t('attendance','Fullday');?></th>
    </tr>
   
    <?php
	
	$data=Employees::model()->findAll("employee_department_id=:x", array(':x'=>$_REQUEST['id']));
	if($data)
	{
   	foreach($data as $data1)
	 {
		echo '<tr>' ;
		echo '<td>'. $data1->first_name .'</td>';
		echo '<td>';
		 $date=EmployeeAttendances::model()->findAllByAttributes(array('employee_id'=>$data1->id));
		 $fullday = 0;
		 $halfday= 0 ;?>

		<?php foreach($date as $date1)
         {
        
        $attd_month=date('m',strtotime($date1->attendance_date ));
        $attd_year=date('y',strtotime($date1->attendance_date ));
        $crrnt_month=date('m');
        $crrnt_year=date('y');
            if($attd_year == $crrnt_year)
            {
          echo $date1->attendance_date .'<br/><br/>';
          $fullday=$fullday+count(EmployeeAttendances::model()->findAllByAttributes(array('employee_id'=>$data1->id,'is_half_day'=>'0','attendance_date'=>$date1->attendance_date)));
	 $halfday=$halfday+count(EmployeeAttendances::model()->findAllByAttributes(array('employee_id'=>$data1->id,'is_half_day'=>'1','attendance_date'=>$date1->attendance_date)));
             }
         }
	 echo '</td>';
	 echo '<td>'.$halfday. '</td>';
	 echo '<td>'.$fullday. '</td>';
	 echo '</tr>';
	 }
	 
    ?>
 
  </table>
  <?php
	 }
  }else
		{
			echo '<td align="center" colspan="5"><strong>'.'No Data Available!'.'</td>';
		}
  ?>
</div>