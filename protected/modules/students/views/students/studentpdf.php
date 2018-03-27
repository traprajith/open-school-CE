<style>
table.studenace_table{
	border-top:1px #CCC solid;
	margin:30px 0px;
	font-size:12px;
	border-right:1px #CCC solid;
	
}
.studenace_table td{
	border:1px #CCC solid;
	padding:5px 6px;
	border-bottom:1px #CCC solid;
	
}
table{ border-collapse:collapse;}

hr{ border-bottom:1px solid #ccc;
	border-top:0px solid #000}
	
h5{ margin:0px;
	font-size:14px;
	padding:0px;}


</style>


<!-- Header -->
	<?php $semester_enabled    = Configurations::model()->isSemesterEnabled(); ?>
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first">
                           <?php
						    $filename=  Logo::model()->getLogo();
							if($filename!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
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
                            if($students)
                            {
                            ?>
       <h5 align="center"><?php echo Yii::t('app','STUDENTS LIST');?></h5>
      
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="studenace_table" >
                            <tr style="background:#dfdfdf;">
                            <td align="center" style=" width:10%; " ><?php echo '#';?></td>
                            <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>  
                              <td align="center"  style=" width:30%; " ><?php echo Yii::t('app','Roll No');?></td>
                              <?php } ?>      
                            <?php
								if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
						  ?>	
                          		<td align="center"  style=" width:30%; " ><?php echo Yii::t('app','Student Name');?></td>
                            <?php } ?>  
                               <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>        
                            <td  align="center"  style=" width:20%; "><?php echo Yii::t('app','Admission No');?></td>
                            <?php } ?>
                            <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                            	<td  align="center"  style=" width:30%; "><?php echo Yii::app()->getModule("students")->labelCourseBatch();?></td>
                            <?php } ?>
                            <?php if($semester_enabled == 1){ ?> 
                                   <td><?php echo Yii::t('app','Semester');?></td> 
                            <?php } ?> 
                            <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?>     
                             	<td align="center"  style=" width:10%; "><?php echo Yii::t('app','Gender');?></td>
                            <?php } ?>    
                            </tr>
                           
							
                            <?php
								$i=1;
								foreach($students as $studitem)
								{
									$batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$studitem->id, 'batch_id'=>$studitem->batch_id, 'status'=>1));
									?>
                                    <tr>
                                    <td align="center" style=" width:10%; " ><?php echo $i;?></td>
                                     <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>  
                                     <td align="center" style=" width:20%; "><?php if($batch_student!=NULL and $batch_student->roll_no!=0){
								  				echo $batch_student->roll_no;
								  			}
											else{
												echo '-';
											}?>
                                            </td>
                                     <?php } ?>
                                    <?php
										if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
									?>
                                    	<td align="center" style=" width:30%; "><?php echo $studitem->studentFullName('forStudentProfile');?></td>
                                    <?php } ?>    
                                      <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>        
                                    <td align="center" style=" width:20%; "><?php echo $studitem->admission_no;?></td>
                                    <?php } ?>
                                    <?php
									if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){
										$batchstudents=BatchStudents::model()->findAllByAttributes(array('student_id'=>$studitem->id, 'result_status'=>0)); 
										if(count($batchstudents)>1){ 
											if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL){
												$bid	=	$_REQUEST['Students']['batch_id'];
												$batch = Batches::model()->findByPk($bid);
												$semester	= Semester::model()->findByAttributes(array('id'=>$batch->semester_id));
												echo "<td>".$batch->course123->course_name."/".$batch->name."</td>"; 
											}else{
												$bid	=	$batchstudents[0]['batch_id'];
												$batch = Batches::model()->findByPk($bid);
												$semester	= Semester::model()->findByAttributes(array('id'=>$batch->semester_id));
												echo "<td>".$batch->course123->course_name." / ".$batch->name."</td>"; 
											} 
										}else if(count($batchstudents) == 0){
											echo "<td>-</td>";
										}
										else{  
												$batch 			= 	Batches::model()->findByPk($batchstudents[0]['batch_id']);
												$course 		= 	Courses::model()->findByAttributes(array('id'=>$batch->course_id)); 
												$sem_enabled	= 	Configurations::model()->isSemesterEnabledForCourse($course->id);
												$semester	= Semester::model()->findByAttributes(array('id'=>$batch->semester_id)); 
												$batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$studitem->id, 'batch_id'=>$list_1->batch_id, 'status'=>1));
												   echo "<td>".$batch->course123->course_name." / ".$batch->name."</td>";
												
											
										} 
										if($semester_enabled == 1 and $sem_enabled == 1 and $batch->semester_id != NULL and count($batchstudents) != 0){ 
												echo "<td>".$semester->name."</td>";
										}else{
											echo "<td>-</td>";
										}
									}
										?> 
                                <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?> 
                                     <td align="center" style=" width:10%; ">
                                        <?php 
                                        if($studitem->gender=='M')
                                        {
                                            echo Yii::t('app','Male');
                                        }
                                        elseif($studitem->gender=='F')
                                        {
                                            echo Yii::t('app','Female');
                                        }
                                        ?>
                                    </td>
                               <?php } ?>
                               </tr>
                                    <?php
									$i++;
									
							}?>
							
						 </table>
                            
                            
  <?php
	}
	else
	{?>
	    <h5 align="center"><?php echo Yii::t('app','Nothing Found!!!');?></h5>
	<?php
	}
	?>
	
