        
		
<div class="panel-wrapper" id="pu" >
            <?php  
			
			$j=0;
			$widget='';
			if(isset($_REQUEST['widget']) and $_REQUEST['widget']!=NULL)
                          { 
						  $widget = $_REQUEST['widget'];
						  }
			
			
			if(Yii::app()->controller->action->id=='explorer')
			{
				$path='/osinstall/index.php?r=site/emanage';
			}
			else
			{
				$path=Yii::app()->request->getUrl();
			}?>
            
            
            
            
           
    
				 <h2 class="title">Users</h2>
                      <h2 class="caption"><?php echo count(Employees::model()->findAll("is_deleted 	=:x", array(':x'=>0))); ?> Records</h2>
                      <!--<div class="sd_search_area">
    					<input name="" id="exptxtsrh" type="text" class="sd_search" value="Search Here" />
        				<input name="" type="button" class="sd_but" /> 
       					 <div class="clear"></div>
        			</div>-->
                     <div class="clear"></div>
                     <div style="position:relative">
                     <div class="sd_links">
                     	<ul>
                        	 <li><a href="#" id="ud_fltr">Filter Users</a></li>
                             <li>|</li>
                        	
                            <li><a href="#" id="uloadfltr">Load Filter</a></li>
                        </ul>
                        <div class="clear"></div>
                        
                     </div>
                     
                     <div id="udd" style=" display:none; background:#fff; left:100px; top:30px" class="drop">
    						<div class="droparrow" style="left:10px;"></div>
        						<ul class="loaddrop" id="userloaddrop_link">
                                
        							<?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'2'));
									if($data!=NULL)
									{ 
										foreach ($data as $data1)
										{
											$data1->url = str_replace('employees/employees/manage&name','site/emanage&ename', $data1->url);
											$data1->url = str_replace('employees%2Femployees%2Fmanage&name','site/emanage&ename', $data1->url);
											$data1->url = str_replace('&name=','&ename=', $data1->url);
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
                        <div class="sd_filter_box" id="sd_filter_box">
                        <div class="sd_filter_box_arrow"></div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'usersearch-form',
						'action'=>'/site/emanage',
                        'method'=>'GET',

								
							)); ?>
                            <input type="hidden" name="widget" value="<?php echo isset($_GET['widget']) ? CHtml::encode($_GET['widget']) : '' ; ?>" />
                            <div class="sd_form_row" style="background:#F7F7F7;">
                            <table width="55%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="18%">
                        Name:</td><td><input type="text" placeholder="search" name="ename"  value="<?php echo isset($_GET['ename']) ? CHtml::encode($_GET['ename']) : '' ; ?>" />
                        <?php  CHtml::ajaxButton("Apply",CController::createUrl('/site/emanage'), array(
					  
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'user-name-test'));?>
						</td><td>
                      <?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/emanage'), array(
					  
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'user-name-but'));?>
 </td></tr></table></div>    
 <div class="sd_form_row" style="background:#F4F4F4;">
 <table width="68%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="34%">                  
Employee Number:</td><td><input type="text" placeholder="search" name="employeenumber" value="<?php echo isset($_GET['employeenumber']) ? CHtml::encode($_GET['employeenumber']) : '' ; ?>" /></td><td>
<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/emanage'), array(
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'user-employeenumber-but'));?>

<?php 
echo '</td></tr></table></div>';
echo '<div class="sd_form_row" style="background:#F7F7F7;">
	<table width="60%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                         
';  


echo '<td>Department:</td><td>';

$data1 = CHtml::listData(EmployeeDepartments::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_department_id',$data1,array('prompt'=>'Select','id'=>'employee_department_id')); ?>
</td><td>
<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/emanage'), array(
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'user-employee_department-but'));?>

<?php $this->endWidget(); ?>
</td>
</tr>
</table>
</div>
</div>
                        
                       <div id="userfilter_action"> 
                     <div class="filter_con">
                     <div class="filterbxcntnt_inner_bot" >
    <div class="filterbxcntnt_left" style="left:0px;"><strong>Active Filters:</strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul id="filter">
        
        
        <!--<li id="expli" style="display:none;">Admission number : <span id="espname"></span><a href="#"></a></li>-->
         <?php if(isset($_REQUEST['ename']) and $_REQUEST['ename']!=NULL)
	{
		$j++; ?>
    <li>Name : <?php echo $_REQUEST['ename'];
	 ?>
   
	<?php 
echo CHtml::link("", array('/site/emanage', 'ename' => '','employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));

?>

</li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['employeenumber']) and $_REQUEST['employeenumber']!=NULL)
    { 
	    $j++; ?>
    <li>Employee number : <?php echo $_REQUEST['employeenumber'];echo $name ; echo $bat;?>
	
	<?php 
	 echo CHtml::link("", array('/site/emanage',  'ename' => $name,'employeenumber'=>'','Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));
	   ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_department_id']) and $_REQUEST['Employees']['employee_department_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Department : <?php echo EmployeeDepartments::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_department_id']))->name?>
	
	<?php 
	echo CHtml::link("", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>'','widget' => $widget, 'val' => $_REQUEST['val']));
	
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

echo CHtml::link("All", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => ''));
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

echo CHtml::link("A", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'A'));

 

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
<?php echo CHtml::link("B", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'B')); ?>                            
                            
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
<?php echo CHtml::link("C", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'C'));  ?>                            
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
<?php echo CHtml::link("D", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'D')); ?>                            
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
<?php  echo CHtml::link("E", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'E'));  ?>                            
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
<?php echo CHtml::link("F", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'F'));  ?>                            
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
<?php  echo CHtml::link("G", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'G')); ?>                            
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
<?php  echo CHtml::link("H", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'H')); ?>  
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
<?php  echo CHtml::link("I", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'I')); ?>  
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
<?php  echo CHtml::link("J", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'J')); ?>  
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
<?php  echo CHtml::link("K", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'K')); ?>  
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
<?php  echo CHtml::link("L", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'L')); ?>  
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
<?php  echo CHtml::link("M", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'M')); ?>  
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
<?php  echo CHtml::link("N", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'N')); ?>  
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
<?php  echo CHtml::link("O", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'O')); ?>  
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
<?php  echo CHtml::link("P", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'P')); ?>  
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
<?php  echo CHtml::link("Q", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'Q')); ?>  
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
<?php  echo CHtml::link("R", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'R')); ?>  
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
<?php  echo CHtml::link("S", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'S')); ?>  
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
<?php  echo CHtml::link("T", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'T')); ?>  
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
<?php  echo CHtml::link("U", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'U')); ?>  
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
<?php  echo CHtml::link("V", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'V')); ?>  
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
<?php  echo CHtml::link("W", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'W')); ?>  
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
<?php  echo CHtml::link("X", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'X')); ?>  
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
<?php  echo CHtml::link("Y", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'Y')); ?>  
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
<?php  echo CHtml::link("Z", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => 'Z')); ?>  
</li>

</ul>


                        <div class="clear"></div>
                    </div></div>
				<div class="sd_tablelist">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <th>Name</th>
                            <th>Employee No:</th>
                            <th>Department</th>
                            <!--<th>Action</th>-->
                          </tr>
                          <?php foreach($list as $list_1)
	                      { ?>
                          <tr>
                          <?php if(isset($_REQUEST['widget']) and $_REQUEST['widget']=='1')
                          { ?>
							  <td id="user_div"><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('/site/student','id'=>$list_1->id)) ?></td>
                              <?php }else{ ?>
                            <td><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('employees/employees/view','id'=>$list_1->id)) ?></td><?php } ?>
                            <td><?php echo $list_1->employee_number ?></td>
                            <?php $batc = $batc = EmployeeDepartments::model()->findByAttributes(array('id'=>$list_1->employee_department_id)); 
							  if($batc!=NULL)
							  {
								  ?>
								  <td><?php echo $batc->name; ?></td> 
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

$("#uloadfltr").click(function(){
	
            	if ($("#udd").is(':hidden')){
                	$("#udd").show();
				}
            	else{
                	$("#udd").hide();
            	}
            return false;
       			 });
				 
        		$(document).click(function() {
					if (!$("#udd").is(':hidden')){
            		$('#udd').hide();
					}
        			});	
                

</script>
            
<script>

$("#ud_fltr").click(function(){
	
            	if ($("#sd_filter_box").is(':hidden')){
                	$("#sd_filter_box").show();
					

				}
            	else{
                	$("#sd_filter_box").hide();
					
            	}
            return false;
       			 });

</script>         
 