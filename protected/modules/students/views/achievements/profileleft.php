<div class="empleftbx">
    <div class="empimgbx" style="height:128px; padding:14px 0 20px 10px;">
    <ul>
    <li>
     <?php
	 $student=Students::model()->findByAttributes(array('id'=>$_REQUEST['student_id']));
	
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
   </li>
   
    <li class="img_text">
    <!--.'<span style="width:5px;"></span>'-->
    	<div style="line-height:15px; margin:20px 0px 5px 0px; font-size:14px"><?php echo ucfirst($student->first_name).'&nbsp;'.ucfirst($student->middle_name).' '.ucfirst($student->last_name); ?></div>
       
        <a href="#" style="font-size:12px; color:#C30; padding-top:6px; display:block"><?php echo $student->email; ?></a>
        
    </li>
    </ul>
    </div>
    <div class="clear"></div>

    <div class="prof_detail">
        <ul>
        	<?php
			if($student->batch_id == 0)
			{
				$last_batch = BatchStudents::model()->findByAttributes(array('student_id'=>$student->id,'result_status'=>2));
				$batch_id = $last_batch->batch_id;
			?>
            	<li style="font-size:14px;">
					<span><strong><?php echo Yii::t('app','Alumni'); ?></strong></span>
                </li>
			<?php
			}
			else
			{
				$batch_id = $student->batch_id;
			}
			?>
        	
            <li>
                <span><strong><?php echo Yii::t('app','Course').'&nbsp;:';?></strong>&nbsp;
                <?php
                $posts=Batches::model()->findByPk($batch_id);
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
            <li>
            <span><?php echo '<strong>'.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','&nbsp;:').'</strong>';?>&nbsp;
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
            <li>
            	<span><?php echo '<strong>'.Yii::t('app','Adm No&nbsp;:').'</strong>';?>&nbsp;<?php echo $student->admission_no; ?></span>
            </li>
        </ul>
    </div> <!-- END div class="prof_detail" -->
    <div class="clear"></div>
    
    
    <div class="clear"></div>
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