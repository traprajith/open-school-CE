<style>
a.add{
    display: block;
    margin: 10px 0 0;
    padding: 2px 5px;
    width: 60px;
	height:30px;
	background-color:#379bc9;
	border-radius:3px;
	color:#fff;
	
	}
a.add:hover{
	background-color:#318db7;
}
.add img{ color: #98adb5;
    display: inline;
    font-size: 14px;
    margin-right: 5px;
	width:19px;
	height:20px;
	float:left;
	margin-left:0px;
	background:none;
	}
.add span.fcount{
	display:inline-block;
	padding-top:8px;
	padding-left:4px;
	color:#FFF;
	font-weight:bold;
	font-size:16px;
}
	
</style>

<div class="empleftbx-profile">
    <div class="empimgbx-profile">
 
     <?php
	 $student=Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
	 $batchstudents=BatchStudents::model()->findAllByAttributes(array('student_id'=>$student->id,'status'=>1, 'result_status'=>0));
	 if($student->photo_file_name){ 
	 	$path = Students::model()->getProfileImagePath($student->id);	
    	echo '<img  src="'.$path.'" alt="'.$student->photo_file_name.'"  />';
	 }
	 elseif($student->gender == 'M')
	 {
		echo '<img  src="images/s_prof_m_image.png" alt='.$student->first_name.' />'; 
	 }
	 elseif($student->gender == 'F')
	 {
		echo '<img  src="images/s_prof_fe_image.png" alt='.$student->first_name.' />';  
	 }
	 ?>
    </div>

    	<div class="left-profile-name-sctn">
    	<div class="left-profile-blk">
        <p>
		<?php if(FormFields::model()->isVisible("fullname", "Students", 'forStudentProfile')){
			echo $student->studentFullName('forStudentProfile');
		}?></p>
       	<?php if(FormFields::model()->isVisible('email','Students','forStudentProfile')){?>
        	<a href="#" ><?php echo $student->email; ?></a>
		<?php } ?>
        </div>
        
<div id="jobDialog"></div>
    <div class="clear"></div>
    <div class="prof_detail-blk">
        <ul>
        	<?php
			if($student->batch_id == 0)
			{?>
            	<li style="font-size:14px;">
					<span><strong><?php echo '-'; ?></strong></span>
                </li>
			<?php
			}
			?>
	<?php if(count($batchstudents)>1){
			echo CHtml::link('View Course Details', array('/students/students/courses', 'id'=>$student->id));
		  } 
		  if(count($batchstudents) == 1){
			  $batchstudent		=	BatchStudents::model()->findByAttributes(array('student_id'=>$student->id, 'result_status'=>0));
			  $posts 			= 	Batches::model()->findByPk($batchstudent->batch_id);
        	 if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                <li>
                    <span><strong><?php echo Yii::t('app','Course').'&nbsp;:';?></strong>&nbsp;
                    <?php
                    if($posts!=NULL)
                    {
                        echo $posts->course123->course_name;
                    }
                    else
                    {
                        echo '-';
                    }
                    ?>
                    </span>
                </li>
            <?php } ?>
            <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                <li>
                <span><?php echo '<strong>'.$student->getAttributeLabel('batch_id').'&nbsp;:'.'</strong>';?>&nbsp;
                    <?php
                        if($posts!=NULL)
                        {
                            echo $posts->name;
                        }
                        else
                        {
                            echo '-';
                        }
                    ?>
                </span>
                </li>
            <?php } ?>
		<?php } ?>
            <?php if(FormFields::model()->isVisible('admission_no','Students','forStudentProfile')){?>
                <li>
                    <span><?php echo '<strong>'.$student->getAttributeLabel('admission_no').'&nbsp;:'.'</strong>';?>&nbsp;<?php echo $student->admission_no; ?></span>
                </li>
            <?php } ?>
        </ul>
    </div> <!-- END div class="prof_detail" -->
</div>
   <!-- <div class="left_emp_navbx">
    <div class="left_emp_nav">
    <h2>Your Search</h2>
    <ul>
    <li><a class="icon_emp" href="#">Profile</a></li>
    <li><a href="#">Delete</a></li>
    <li><span class="activearrow"></span><a class="active" href="#">Leaves <span class="active"></span></a></li>
    <li><a class="last" href="#">More</a></li>
    </ul>
    </div>
    <div class="clear"></div>
    <div class="left_emp_btn"><a class="arrowsml" href="#">Saved Searches</a></div>
    </div>-->
    </div>