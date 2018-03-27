<div class="" id="" >
<?php  

	$j=0;
	$widget='';
	if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL)
	{ 
		$widget = $_REQUEST['widget'];
	}
	
	
	if(Yii::app()->controller->action->id=='explorer')
	{
		$path='/osinstall/index.php?r=site/manage';
	}
	else
	{
		$path=Yii::app()->request->getUrl();
	}
	
	
?>
            
    
                     <div class="clear"></div>
                     <div style="position:relative">
                     <div class="sd_links">
                     	<ul>
                        	 <li><a href="#" id="sd_fltr"><?php echo Yii::t('app','Filter Students')?></a></li>
                             <li>|</li>
                        	
                            <li><a href="#" id="loadfltr"><?php echo Yii::t('app','Load Filter') ?></a></li>
                        </ul>
                        <div class="clear"></div>
                        
                     </div>
                     
                     <div id="dd" style=" display:none; background:#fff; left:100px; top:30px" class="drop">
    						<div class="droparrow" style="left:10px;"></div>
        						<ul class="loaddrop" id="loaddrop_link">
                                
        							<?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'1'));
									if($data!=NULL)
									{ 
										foreach ($data as $data1)
										{
											$data1->url = str_replace('students/students/manage','site/manage', $data1->url);
											$data1->url = str_replace('students%2Fstudents%2Fmanage','site/manage', $data1->url);
											echo '<li>'.CHtml::link($data1->name, CHtml::decode($data1->url).'&widget='.$widget,array('id'=>$data1->id)).'</li>';
										}
									}
									else
									{
										echo '<span style="color:#d30707"><i>'.Yii::t('app','No Saved Searches').'</i></span>';
									}
									?>
                                    
        						</ul>
        				</div>
                        
                        </div>
                        <div class="sd_filter_box" id="sd_filter_box_student">
                        <div class="sd_filter_box_arrow"></div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'search-form',
						'action'=>'/site/manage',
                        'method'=>'GET',

								
							)); ?>
                            <input type="hidden" name="widget" value="<?php echo isset($_GET['widget']) ? CHtml::encode($_GET['widget']) : '' ; ?>" />
                            <div class="sd_form_row" >
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="20%">
                        <?php echo Yii::t('app','Name')?>&nbsp;</td><td width="40%"><input type="text" placeholder="search" name="name"  value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
                        <?php  CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'student-name-test'));?>
						</td><td width="40%">
                      <?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'student-name-but'));?>
 </td></tr></table></div>    
 <div class="sd_form_row">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="20%">                  
<?php echo Yii::t('app','Admission No')?>&nbsp;</td><td width="40%"><input type="text" placeholder="search" name="admissionnumber" value="<?php echo isset($_GET['admissionnumber']) ? CHtml::encode($_GET['admissionnumber']) : '' ; ?>" /></td><td width="40%">
<?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/manage'), array(
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'student-admissionnumber-but'));?>
            <?php 
			if(isset($_REQUEST['yid']) and $_REQUEST['yid']!='')
								{
									$year = $_REQUEST['yid'];
								}
								else if(Yii::app()->user->year)
								{
									$year = Yii::app()->user->year;
								}
								elseif($current_academic_yr->config_value)
								{
									$year = $current_academic_yr->config_value;
								}
$criteria = new CDbCriteria();
$criteria->condition = "is_deleted=:x and academic_yr_id=:y";
$criteria->params = array(':x'=>0,':y'=>$year);								
$data = CHtml::listData(Courses::model()->findAll($criteria),'id','course_name');
echo '</td></tr></table></div>';
echo '<div class="sd_form_row">
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="10%">        
';  
echo Yii::t('app','Course').'</td><td>';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>Yii::t('app','Select'),'style'=>'width:190px;',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('students/students/batch'),
'update'=>'#batch_id',
'data'=>'js:$(this).serialize()',

))); 
echo '</td>';
echo '<td>'.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")
.'</td><td>';

$criteria = new CDbCriteria();
$criteria->condition = "is_deleted=:x and academic_yr_id=:y and is_active=:z";
$criteria->params = array(':x'=>0,':y'=>$year,':z'=>1);								
$data1 = CHtml::listData(Batches::model()->findAll($criteria),'id','name');
echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>Yii::t('app','Select'),'style'=>'width:120px !important;','id'=>'batch_id')); ?></td>
          <td ><?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/manage'), array(
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'student-batch-but'));?>

<?php $this->endWidget(); ?>
</td>
</tr>
</table>
</div>
</div>
                        
                       <div id="filter_action">
                     <div class="filter_con">
                     <div class="filterbxcntnt_inner_bot" >
    <div class="filterbxcntnt_left" style="left:0px;"><strong><?php echo Yii::t('app','Active Filters:')?></strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul id="filter">
        
        
        <!--<li id="expli" style="display:none;">Admission number : <span id="espname"></span><a href="#"></a></li>-->
         <?php if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
	{
		$j++; ?>
    <li><?php echo Yii::t('app','Name :'); echo $_REQUEST['name'];
	 ?>
   
	<?php 
echo CHtml::link("", array('/site/manage', 'name' => '','admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));

?>

</li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
    { 
	    $j++; ?>
    <li><?php echo Yii::t('app','Admission No :'); echo $_REQUEST['admissionnumber'];echo $name ; echo $bat;?>
	
	<?php 
	 echo CHtml::link("", array('/site/manage',  'name' => $name,'admissionnumber'=>'','Students[batch_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));
	   ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.':'; echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?>
	
	<?php 
	echo CHtml::link("", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>'','widget' => $widget, 'val' => $_REQUEST['val']));
	
	?></li>
    <?php } ?>
    <?php if($j==0)
	{
		echo '<div style="padding-top:4px; font-size:11px;"><i>'.Yii::t('app','No Active Filters').'</i></div>';
	}?>
    <div class="clear"></div>
    </ul>
    </div>
    <div class="clear"></div>
    </div>	
                    <div class="clear"></div>
                    </div>
                    	<!-- Alphabetic Sort -->
						<?php $this->widget('application.extensions.letterFilter.LetterFilter', array(
                            //parameters                                                
                            'innerWrapperClass'=>'sd_letternav',
                            'containerId'=>'letter',                        
                            'url'=>Yii::app()->createUrl('/site/manage',array('name'=>$_REQUEST['name'], 'admissionnumber'=>$_REQUEST['admissionnumber'], 'Students[batch_id]'=>$_REQUEST['Students']['batch_id'], 'widget'=>$_REQUEST['widget'])),
                                                                
                        )); ?>
                        <!-- END Alphabetic Sort -->
                    </div>
				<div class="sd_tablelist">
                <div class="tablebx">  
                        
                       
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" id="example">
						 
                          <tr>
                           <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                            	<th><?php echo Yii::t('app','Roll No');?></th>
                            <?php } ?>
                            
                            <?php if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))
                                { ?>
                              <th><?php echo Yii::t('app','Name');?></th>
                                <?php } ?>
                              <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>
                              <th><?php echo Yii::t('app','Admission No'); ?></th>
                              <?php } ?>
                              <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile'))
                                { ?>
                                <th><?php echo Yii::app()->getModule("students")->labelCourseBatch(); ?></th><?php } ?>
                            <!--<th>Action</th>-->
                          </tr>
                          <?php foreach($list as $list_1)
	                      {
							  $batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$list_1->id, 'batch_id'=>$list_1->batch_id, 'status'=>1));
                              $name='';
                              $name=  $list_1->studentFullName('forStudentProfile');
                              ?>
                               
                          <tr>
                          <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                           	<td><?php if($batch_student!=NULL and $batch_student->roll_no!=0){
								  				echo $batch_student->roll_no;
								  			}
											else{
												echo '-';
											}?></td>
                               <?php } ?>
                               
                              <?php if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))
                                { ?>
                          <?php 
						  if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='sem_ex')
						  {
							  ?>
                              <td id="semstudent_div"><?php 
                                      echo CHtml::link($name,array('/site/semstudent','id'=>$list_1->id)) ?></td>
                              
                              <?php
						  }
						 else if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='1')
                          { 
						  ?>
							  <td id="student_div"><?php 
                                      echo CHtml::link($name,array('/site/student','id'=>$list_1->id)) ?></td>
                           
						   <?php }else if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='s_a'){ ?>
                             	<td><?php 
								if(Configurations::model()->studentAttendanceMode() == 2){
									echo CHtml::link($name,array('students/studentAttentance/subwiseattentance','id'=>$list_1->id));
								}
								else{
									echo CHtml::link($name,array('students/students/attentance','id'=>$list_1->id));
								}?></td>
                          
                           <?php }else if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='sub_att'){ ?>
                           
                           <td><?php echo CHtml::link($name,array('attendance/subjectAttendance/individual','id'=>$list_1->id)) ?></td>
                           
                              <?php }else{ ?>
                              
                            <td><?php echo CHtml::link($name,array('students/students/view','id'=>$list_1->id)) ?></td>
							
							<?php } ?>
                                <?php } ?>
                             <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>
                            <td><?php echo $list_1->admission_no ?></td>
                                <?php } ?>
                            <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile'))
                                { ?>
                                    <?php 
                                    $batchstudents    = 	BatchStudents::model()->studentBatch($list_1->id); 
									
                                    if(count($batchstudents)>1){
                                        echo "<td>".CHtml::link('View Course Details', array('/students/students/courses', 'id'=>$list_1->id), array('target'=>'_blank'))."</td>";
                                    }elseif(count($batchstudents)==1){
                                    $batch_student = BatchStudents::model()->findByAttributes(array('student_id'=>$list_1->id, 'result_status'=>0)); 
									$batc = Batches::model()->findByAttributes(array('id'=>$batch_student->batch_id));
                                    if($batc!=NULL)
                                    {
                                    $cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); ?>
                                    <td><?php  echo $cours->course_name.' / '.$batc->name; ?></td> 
                                    <?php }
                                else{?> <td>-</td> <?php }?> <?php                                 
                                    }
                                } ?>                            
                          </tr>
                          <?php } ?>
                          
                        </table>
                       
                        <div class="clear"></div>
                    </div> <!-- END div class="tablebx" -->
                        

                </div>
               
  </div>              
			
       
            <script>

$("#loadfltr").click(function(){
	
            	if ($("#dd").is(':hidden')){
                	$("#dd").show();
				}
            	else{
                	$("#dd").hide();
            	}
            return false;
       			 });
				 
        		$(document).click(function() {
					if (!$("#dd").is(':hidden')){
            		$('#dd').hide();
					}
        			});	
                

</script>
            
<script>

$("#sd_fltr").click(function(){
	
	
	
            	if ($("#sd_filter_box_student").is(':hidden')){
                	$("#sd_filter_box_student").show();
					

				}
            	else{
                	$("#sd_filter_box_student").hide();
					
            	}
            return false;
       			 });

</script>         
 