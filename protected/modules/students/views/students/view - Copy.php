<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <div class="emp_cont_left">
    <div class="empleftbx">
    <div class="empimgbx" style="height:120px;">
    <ul>
    <li>
     <?php
	 if($model->photo_file_name){ 
    echo '<img class="imgbrder" src="'.$this->createUrl('DisplaySavedImage&id='.$model->primaryKey).'" alt="'.$model->photo_file_name.'" width="101" height="107" />';
	 }else{
		echo '<img class="imgbrder" src="images/super_avatar.png" alt='.$model->first_name.' width="101" height="107" />'; 
	 }
	 ?>
   </li>
    <li class="img_text">
    	<div style="line-height:9px;"><?php echo ucfirst($model->first_name).'<span style="width:5px;"></span>'.ucfirst($model->last_name); ?></div>
        <span><strong>Course:</strong>
        <?php
		$posts=Batches::model()->findByPk($model->batch_id);
		echo $posts->course123->course_name
		 ?>
         </span>
        <span><strong>Batch:</strong><?php
		$batch=Batches::model()->findByAttributes(array('id'=>$model->batch_id));
		 echo $batch->name; ?></span>
        <span><strong>Adm no.:</strong><?php echo $model->admission_no; ?></span>
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
    </td>
    <td valign="top">
    <div class="emp_right">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    <h1 style="margin-top:.67em;">Student Profile : <?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
        
    <div class="edit_bttns last">
    <ul>
    <li>
    <?php echo CHtml::link('Edit', array('update', 'id'=>$model->id),array('class'=>' edit ')); ?>
    </li>
     <li>
    <?php echo CHtml::link('Students', array('/students/manage'),array('class'=>'edit last'));?>
    </li>
    </ul>
    </div>
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <div class="emp_tab_nav">
    <ul style="width:730px;">
    <li><a class="active" href="#">Profile</a></li>
    <li><a href="#">Assessments</a></li>
    <li><a href="#">Attendance</a></li>
    <li>
    <?php echo CHtml::link('Fees', array('fees', 'id'=>$model->id)); ?>
    <!--<a href="#">Fees</a>--></li>
    <li><a href="#">Additional Notes</a></li>
    </ul>
    </div>
    <div class="clear"></div>
    <div class="emp_cntntbx" >
    
    <div class="table_listbx">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td>General</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng">Admission Date</td>
    <td class="subhdng_nrmal"><?php echo $model->admission_date; ?></td>
    <td class="listbx_subhdng">City</td>
    <td class="subhdng_nrmal"><?php echo $model->city; ?></td>
  </tr>

  <tr>
    <td class="listbx_subhdng">Class Roll No</td>
    <td class="subhdng_nrmal"><?php echo $model->class_roll_no; ?></td>
    <td class="listbx_subhdng">Date of Birth</td>
    <td class="subhdng_nrmal"><?php echo $model->date_of_birth; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"> Birth Place </td>
    <td class="subhdng_nrmal"><?php echo $model->birth_place; ?></td>
    <td class="listbx_subhdng">Blood Group</td>
    <td class="subhdng_nrmal"><?php echo $model->blood_group; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng">State</td>
    <td class="subhdng_nrmal"><?php echo $model->state; ?></td>
    <td class="listbx_subhdng">Country</td>
    <td class="subhdng_nrmal"><?php 
	$count = Countries::model()->findByAttributes(array('id'=>$model->country_id));
	if(count($count)!=0)
	echo $count->name; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng">Nationality</td>
    <td class="subhdng_nrmal"><?php
	$natio_id=Countries::model()->findByAttributes(array('id'=>$model->nationality_id));
	echo $natio_id->name;?></td>
    <td class="listbx_subhdng">Gender</td>
    <td class="subhdng_nrmal">
	<?php if($model->gender=='M')
			echo 'Male';
		else 
			echo 'Female';	 ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"> Pin Code </td>
    <td class="subhdng_nrmal"><?php echo $model->pin_code; ?></td>
    <td class="listbx_subhdng">&nbsp;</td>
    <td class="subhdng_nrmal">&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"> Address Line1 </td>
    <td class="subhdng_nrmal"><?php echo $model->address_line1; ?></td>
    <td class="listbx_subhdng"> Address Line 2 </td>
    <td class="subhdng_nrmal"><?php echo $model->address_line2; ?></td>
  </tr>
 <tr>
    <td class="listbx_subhdng">Phone 1</td>
    <td class="subhdng_nrmal"><?php echo $model->phone1; ?></td>
    <td class="listbx_subhdng">Phone 2</td>
    <td class="subhdng_nrmal"><?php echo $model->phone2; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng">Language</td>
    <td class="subhdng_nrmal"><?php echo $model->language; ?></td>
    <td class="listbx_subhdng">Email</td>
    <td class="subhdng_nrmal"><?php echo $model->email; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng">Category</td>
    <td class="subhdng_nrmal"><?php 
	$cat =StudentCategories::model()->findByAttributes(array('id'=>$model->student_category_id));
	 echo $cat->name; ?></td>
    <td class="listbx_subhdng">Religion</td>
    <td class="subhdng_nrmal"><?php echo $model->religion; ?></td>
  </tr>
  <tr class="listbxtop_hdng">
    <td>Emergeny Contact</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr >
    <td colspan="4" class="listbx_subhdng">In case of emergencies,<br />
      contact : <?php
	  $posts=Guardians::model()->findByAttributes(array('ward_id'=>$model->id));
	  if(count($posts)==0)
	  {
		  echo "No Guardians are added".'&nbsp;&nbsp;'.CHtml::link('Add new', array('guardians/create&id='.$model->id)); 
	  }
	  else
	  {
		  echo $posts->first_name.'&nbsp;&nbsp;'/*.CHtml::link('Add new', array('guardians/create&id='.$model->id))*/;
	  }
	   ?></td>
  </tr>
  <tr class="listbxtop_hdng">
    <td>Student Previous Datas</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="table_listbxlast">
    <td colspan="4" class="listbx_subhdng"><span class="subhdng_nrmal">
    <?php
    $prev=StudentPreviousDatas::model()->findAllByAttributes(array('student_id'=>$model->id));
	if(count($prev)==0)
	{
	echo "No Previous Datas";	
	}
	else {
	?>
    (<?php echo CHtml::link('Add another Previous Data', array('studentPreviousDatas/create&id='.$model->id)); ?>)</span>
    <?php } ?>
    </td>
  </tr>
  </table>
 <div class="ea_pdf" style="top:4px; right:6px;">
 <?php echo CHtml::link('<img src="images/pdf-but.png">', array('Students/pdf','id'=>$_REQUEST['id']),array('target'=>'_blank')); ?>
	</div>
 
    </div>
    </div>
    </div>
    
    </div>
    </div>
   
    </td>
  </tr>
</table>