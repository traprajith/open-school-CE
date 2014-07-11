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
</style>
<div class="atnd_Con" style="padding-left:20px; padding-top:30px;">
<?php
 
  if(isset($_REQUEST['id']))
  {
	    $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		$batchname=$batch->name;
		$course=Courses::model()->findByAttributes(array('id'=>$batch->course_id));
		$name=$course->course_name; ?>
	 
	
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
<h4>Student Attendance Report</h4>
<h5>Course : <?php echo $name;?> <br/>
Batch : <?php echo $batchname;?></h5>
<table width="100%" cellspacing="0" cellpadding="0" class="attendance_table" align="center">
<tr style="background:#dfdfdf;">
    <th><?php  echo Yii::t('attendance','Name');?></th>
    <th><?php echo Yii::t('attendance','Leaves');?></th></tr>
   
    <?php
	
	$data=Students::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
   	foreach($data as $data1)
	 {
		echo '<tr>' ;
		echo '<td>'. $data1->first_name .'</td>';
	$fullday=count(StudentAttentance::model()->findAllByAttributes(array('student_id'=>$data1->id)));
	
	 echo '<td>'.$fullday.'</td>';
	 echo '</tr>';
	 }
    ?>
 
  </table>
  <?php
	 }
  ?>
</div>