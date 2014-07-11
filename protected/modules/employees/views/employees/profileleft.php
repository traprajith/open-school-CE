 <div class="emp_cont_left">
    <div class="empleftbx">
<div class="empimgbx" style="height:128px;">
    <ul>
    <li>
   <?php
   $employee=Employees::model()->findByAttributes(array('id'=>$_REQUEST['id']));
	 if($employee->photo_file_name){ 
	 echo '<img  src="'.$this->createUrl('DisplaySavedImage&id='.$employee->primaryKey).'" alt="'.$employee->photo_file_name.'" width="170" height="140" />';
   // echo '<img class="imgbrder" src="'.$this->createUrl('DisplaySavedImage&id='.$employee->primaryKey).'" alt="'.$employee->photo_file_name.'" width="170" height="140" />';
	 }else{
		echo '<img class="imgbrder" src="images/super_avatar.png" alt='.$employee->first_name.' width="170" height="140" />'; 
	 }
	 ?>
     </li>
    <li class="img_text">
    	<div style="line-height:9px; margin:20px 0px 5px 0px; font-size:14px"><?php echo ucfirst($employee->first_name).'&nbsp;'.ucfirst($employee->last_name); ?></div>
        <a style="font-size:12px; color:#C30; padding-top:6px; display:block" href="#"><?php echo $employee->email; ?></a>
    </li>
    </ul>
    </div>
    <div class="clear"></div>
    
    
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