 <div class="emp_cont_left">
<div class="empleftbx-profile">
    <div class="empimgbx-profile">

   <?php
   $employee=Employees::model()->findByAttributes(array('id'=>$_REQUEST['id']));
	 if($employee->photo_file_name){
		 $path = Employees::model()->getProfileImagePath($employee->id);		 
	 	echo '<img  src="'.$path.'" alt="'.$employee->photo_file_name.' />';
   
	 }
	 elseif($employee->gender == 'M')
	 {
		echo '<img  src="images/s_prof_m_image.png" alt='.Employees::model()->getTeachername($employee->id).' />'; 
	 }
	 elseif($employee->gender == 'F')
	 {
		echo '<img  src="images/s_prof_fe_image.png" alt='.Employees::model()->getTeachername($employee->id).' />';  
	 }
	 
	 
	 ?>
</div>
	<div class="left-profile-name-sctn">
    	<div class="left-profile-blk"><p><?php echo Employees::model()->getTeachername($employee->id); ?></p>
        <a  href="#"><?php echo $employee->email; ?></a>
   	 	</div>
        </div>
    <div class="clear"></div>

    <!--<div class="left_emp_navbx">
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
    </div>