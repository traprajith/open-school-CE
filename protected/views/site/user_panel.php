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
				$path='/osinstall/index.php?r=site/emanage';
			}
			else
			{
				$path=Yii::app()->request->getUrl();
			}?>
            
              <div class="clear"></div>
                     <div style="position:relative">
                     <div class="sd_links">
                     	<ul>
                        	 <li><a href="#" id="ud_fltr"><?php echo Yii::t('app','Filter Teachers'); ?></a></li>
                             <li>|</li>
                        	
                            <li><a href="#" id="uloadfltr"><?php echo Yii::t('app','Load Filter') ?></a></li>
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
											$savedurl = CHtml::decode($data1->url);
											$savedurl = str_replace('employees/employees/manage&name','site/emanage&ename', $savedurl);
											$savedurl = str_replace('employees%2Femployees%2Fmanage&name','site/emanage&ename', $savedurl);
											$savedurl = str_replace('&name=','&ename=', $savedurl);
											echo '<li>'.CHtml::link($data1->name, $savedurl.'&widget='.$widget,array('id'=>$data1->id)).'</li>';
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
                        <?php echo Yii::t('app','Name')?>&nbsp;</td><td><input type="text" placeholder="search" name="ename"  value="<?php echo isset($_GET['ename']) ? CHtml::encode($_GET['ename']) : '' ; ?>" />
                        <?php  CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/emanage'), array(
					  
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'user-name-test'));?>
						</td><td>
                      <?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/emanage'), array(
					  
																									'data' => 'js:$("#usersearch-form").serialize()',
																									'update' => '#user_panel_handler',
																									'type'=>'GET',
																									
																								     ),array('id'=>'user-name-but'));?>
 </td></tr></table></div>    
 <div class="sd_form_row" style="background:#F4F4F4;">
 <table width="68%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                                    <td width="34%">                  
<?php echo Yii::t('app','Teacher No'); ?>&nbsp;</td><td><input type="text" placeholder="search" name="employeenumber" value="<?php echo isset($_GET['employeenumber']) ? CHtml::encode($_GET['employeenumber']) : '' ; ?>" /></td><td>
<?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/emanage'), array(
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


echo '<td>'.Yii::t('app','Department').'&nbsp;</td><td>';

$data1 = CHtml::listData(EmployeeDepartments::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_department_id',$data1,array('prompt'=>'Select','id'=>'employee_department_id')); ?>
</td><td>
<?php  echo CHtml::ajaxButton(Yii::t('app',"Apply"),CController::createUrl('/site/emanage'), array(
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
    <div class="filterbxcntnt_left" style="left:0px;"><strong><?php echo Yii::t('app','Active Filters:')?></strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul id="filter">
        
        
        <!--<li id="expli" style="display:none;">Admission number : <span id="espname"></span><a href="#"></a></li>-->
         <?php if(isset($_REQUEST['ename']) and $_REQUEST['ename']!=NULL)
	{
		$j++; ?>
    <li><?php echo Yii::t('app','Name :'); echo $_REQUEST['ename'];
	 ?>
   
	<?php 
echo CHtml::link("", array('/site/emanage', 'ename' => '','employeenumber'=>$ad,'Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));

?>

</li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['employeenumber']) and $_REQUEST['employeenumber']!=NULL)
    { 
	    $j++; ?>
    <li><?php echo Yii::t('app','Teacher No').' :'; echo $_REQUEST['employeenumber'];echo $name ; echo $bat;?>
	
	<?php 
	 echo CHtml::link("", array('/site/emanage',  'ename' => $name,'employeenumber'=>'','Employees[employee_department_id]'=>$bat,'widget' => $widget, 'val' => $_REQUEST['val']));
	   ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_department_id']) and $_REQUEST['Employees']['employee_department_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::t('app','Department').' :'; echo EmployeeDepartments::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_department_id']))->name?>
	
	<?php 
	echo CHtml::link("", array('/site/emanage', 'ename' => $name,'employeenumber'=>$ad,'Employees[employee_department_id]'=>'','widget' => $widget, 'val' => $_REQUEST['val']));
	
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
                        'url'=>Yii::app()->createUrl('/site/emanage',array('ename'=>$_REQUEST['name'], 'employeenumber'=>$_REQUEST['employeenumber'], 'Employees[employee_department_id]'=>$_REQUEST['Employees']['employee_department_id'], 'widget'=>$_REQUEST['widget'])),
                                                            
                    )); ?>
                    <!-- END Alphabetic Sort -->
                    </div>
				<div class="sd_tablelist">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <th><?php echo Yii::t('app','Name');?></th>
                            <th><?php echo Yii::t('app','Teacher No');?></th>
                            <th><?php echo Yii::t('app','Department');?></th>
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
 