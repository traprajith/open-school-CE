<div class="panel-wrapper" id="pw" >
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
			}?>
            
            
            
            
           
    
				 <h2 class="title">Students</h2>
                      <h2 class="caption"><?php echo count(Students::model()->findAll("is_deleted 	=:x", array(':x'=>0)));?> Records</h2>
                      <!--<div class="sd_search_area">
    					<input name="" id="exptxtsrh" type="text" class="sd_search" value="Search Here" />
        				<input name="" type="button" class="sd_but" /> 
       					 <div class="clear"></div>
        			</div>-->
                     <div class="clear"></div>
                     <div style="position:relative">
                     <div class="sd_links">
                     	<ul>
                        	 <li><a href="#" id="sd_fltr">Filter Students</a></li>
                             <li>|</li>
                        	
                            <li><a href="#" id="loadfltr">Load Filter</a></li>
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
											echo '<li>'.CHtml::link($data1->name, $data1->url.'&widget='.$widget,array('id'=>$data1->id)).'</li>';
										}
									}
									else
									{
										echo '<span style="color:#d30707"><i>No Saved Searches</i></span>';
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
                            <div class="sd_form_row" style="background:#F7F7F7;">
                            <table width="55%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="18%">
                        Name:</td><td><input type="text" placeholder="search" name="name"  value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
                        <?php  CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'student-name-test'));?>
						</td><td>
                      <?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'student-name-but'));?>
 </td></tr></table></div>    
 <div class="sd_form_row" style="background:#F4F4F4;">
 <table width="68%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="34%">                  
Admission Number:</td><td><input type="text" placeholder="search" name="admissionnumber" value="<?php echo isset($_GET['admissionnumber']) ? CHtml::encode($_GET['admissionnumber']) : '' ; ?>" /></td><td>
<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'student-admissionnumber-but'));?>

<?php 

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');
echo '</td></tr></table></div>';
echo '<div class="sd_form_row" style="background:#F7F7F7;">
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="10%">        
';  
echo 'Course:</td><td>';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'Select','style'=>'width:190px;',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('students/students/batch'),
'update'=>'#batch_id',
'data'=>'js:$(this).serialize()',

))); 
echo '</td>';
echo '<td>Batch:</td><td>';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>'Select','id'=>'batch_id')); ?>
</td><td>
<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
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
    <div class="filterbxcntnt_left" style="left:0px;"><strong>Active Filters:</strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul id="filter">
        
        
        <!--<li id="expli" style="display:none;">Admission number : <span id="espname"></span><a href="#"></a></li>-->
         <?php if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
	{
		$j++; ?>
    <li>Name : <?php echo $_REQUEST['name'];
	 ?>
   
	<?php 
echo CHtml::link("", array('/site/manage', 'name' => '','admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));

?>

</li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
    { 
	    $j++; ?>
    <li>Admission number : <?php echo $_REQUEST['admissionnumber'];echo $name ; echo $bat;?>
	
	<?php 
	 echo CHtml::link("", array('/site/manage',  'name' => $name,'admissionnumber'=>'','Students[batch_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));
	   ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Batch : <?php echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?>
	
	<?php 
	echo CHtml::link("", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>'','widget' => $widget, 'val' => $_REQUEST['val']));
	
	?></li>
    <?php } ?>
    <?php if($j==0)
	{
		echo '<div style="padding-top:4px; font-size:11px;"><i>No Active Filters</i></div>';
	}?>
    <div class="clear"></div>
    </ul>
    </div>
    <div class="clear"></div>
    </div>	
                    <div class="clear"></div>
                    </div>
                    <div class="sd_letternav">
                    
                    	<ul id="letter">
                        
<?php if((isset($_REQUEST['val']) and $_REQUEST['val']==NULL) or (!isset($_REQUEST['val'])))
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>

<?php 

echo CHtml::link("All", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => ''));
 ?>                            
</li>


<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='A')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php 

echo CHtml::link("A", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'A'));

 

?>                            
</li>


<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='B')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php echo CHtml::link("B", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'B')); ?>                            
                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='C')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php echo CHtml::link("C", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'C'));  ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='D')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php echo CHtml::link("D", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'D')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='E')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("E", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'E'));  ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='F')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php echo CHtml::link("F", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'F'));  ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='G')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("G", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'G')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='H')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("H", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'H')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='I')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("I", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'I')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='J')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("J", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'J')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='K')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("K", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'K')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='L')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("L", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'L')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='M')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("M", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'M')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='N')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("N", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'N')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='O')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("O", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'O')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='P')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("P", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'P')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Q')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("Q", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'Q')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='R')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("R", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'R')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='S')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("S", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'S')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='T')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("T", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'T')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='U')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("U", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'U')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='V')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("V", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'V')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='W')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("W", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'W')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='X')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("X", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'X')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Y')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("Y", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'Y')); ?>  
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Z')
{
	echo '<li class="active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link("Z", array('/site/manage', 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'widget' => $widget, 'val' => 'Z')); ?>  
</li>

</ul>


                        <div class="clear"></div>
                    </div></div>
				<div class="sd_tablelist">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <th>Name</th>
                            <th>Admission No:</th>
                            <th>Course/Batch</th>
                            <!--<th>Action</th>-->
                          </tr>
                          <?php foreach($list as $list_1)
	                      { ?>
                          <tr>
                          <?php if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='1')
                          { ?>
							  <td id="student_div"><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('/site/student','id'=>$list_1->id)) ?></td>
                           
						   <?php }else if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='s_a'){ ?>
                             	<td><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('students/students/attentance','id'=>$list_1->id)) ?></td>
                              
                              <?php }else{ ?>
                              
                            <td><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('students/students/view','id'=>$list_1->id)) ?></td>
							
							<?php } ?>
                            
                            
                            <td><?php echo $list_1->admission_no ?></td>
                            <?php $batc = Batches::model()->findByAttributes(array('id'=>$list_1->batch_id)); 
							  if($batc!=NULL)
							  {
								  $cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); ?>
								  <td><?php echo $cours->course_name.' / '.$batc->name; ?></td> 
							  <?php }
							  else{?> <td>-</td> <?php }?>
                            <!--<td align="center"><a href="#" class="sd_action_but"></a>
                            	<div class="sd_action_con">
                                	<div class="sd_actions">
                                    <div class="sd_act_arrow"></div>
                                    	<div class="sd_actions_inner">
                                        	<ul>
                                            	<li><a href="#" >Actions</a></li>
                                                <li><a href="#" class="active">Actions</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>-->
                          </tr>
                          <?php } ?>
                          
                        </table>
                        

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
 