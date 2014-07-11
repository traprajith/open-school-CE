
			<div class="panel-wrapper" id="panelwrapper">
            <?php 
			//echo Yii::app()->request->getUrl();
			$j=0;
			
			
			if(Yii::app()->controller->action->id=='explorer')
			{
				$path='/osinstall/index.php?r=site/manage';
			}
			else
			{
				$path=Yii::app()->request->getUrl();
			}?>
            
            
            
            
           
    
				 <h2 class="title">Students</h2>
                      <h2 class="caption">105 Records</h2>
                      <div class="sd_search_area">
    					<input name="" id="exptxtsrh" type="text" class="sd_search" value="Search Here" />
        				<input name="" type="button" class="sd_but" /> 
       					 <div class="clear"></div>
        			</div>
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
        						<ul class="loaddrop">
        							<li> <a href="#">Lorem ispium</a></li>
                                    <li> <a href="#">Lorem ispium</a></li>
                                    <li> <a href="#">Lorem ispium</a></li>
                                    <li> <a href="#">Lorem ispium</a></li>
        						</ul>
        				</div>
                        </div>
                        <?php $form=$this->beginWidget('CActiveForm', array(
						'id'=>'search-form',
						'action'=>'/site/manage',
                        'method'=>'GET',

								
							)); ?>
                        <input type="search" placeholder="search" name="name"  />
                        <?php  CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'send-link-'.uniqid(),));?>
						
                      <?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
					  
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'send-link-'.uniqid(),));?>
                          
<input type="search" placeholder="search" name="admissionnumber" value="<?php echo isset($_GET['admissionnumber']) ? CHtml::encode($_GET['admissionnumber']) : '' ; ?>" />
<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'send-link-'.uniqid(),));?>

<?php 

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'Select',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('students/students/batch'),
'update'=>'#batch_id',
'data'=>'js:$(this).serialize()'
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Batch';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>'Select','id'=>'batch_id')); ?>

<?php  echo CHtml::ajaxButton("Apply",CController::createUrl('/site/manage'), array(
																									'data' => 'js:$("#search-form").serialize()',
																									'update' => '#student_panel_handler',
																									'type'=>'GET',
																								     ),array('id'=>'send-link-'.uniqid(),));?>

<?php $this->endWidget(); ?>

                        <div class="sd_filter_box">
                        	<div class="sd_filter_box_arrow"></div>
                        	<div class="sd_form_row" style="background:#F7F7F7;">
                            
                            	<table width="65%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="35%" style="padding-left:15px;">Student Name:</td>
                                    <td><input type="search" placeholder="search" name="name"  /></td>
                                    <td></td>
                                    

                                  </tr>
                                </table>
                            </div>
                            <div class="sd_form_row" style="background:#F4F4F4;">
                            	<table width="65%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="35%" style="padding-left:15px;">Admission Number:</td>
                                    <td><input name="" type="text" /></td>
                                    <td><input name="" src="images/sd_apply_but.png" type="image" value="Apply" /></td>
                                  </tr>
                                </table>
                            </div>
                            <div class="sd_form_row" style="background:#F7F7F7;">
                            	<table width="87%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="26%" style="padding-left:15px;">Batch:</td>
                                    <td><select name="" size="1">
                                      <option>Select Course</option>
                                    </select></td>
                                    <td><select name="" size="1">
                                      <option>Select Course</option>
                                    </select></td>
                                    <td><input name="" src="images/sd_apply_but.png" type="image" value="Apply" />
                                    </td>
                                  </tr>
                                </table>
                                

                            </div>
                        </div>
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
    <li>Name : <?php echo $_REQUEST['name']?>
	
	<?php echo CHtml::ajaxLink("", Yii::app()->createUrl('/site/manage' ), array('type' =>'GET','data' =>array( 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat),'dataType' => 'text', 'update' =>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),));
	
	 //echo CHtml::ajaxLink('All', array('/site/manage' ,  'name' => '','admissionnumber'=> $ad,'Students[batch_id]'=>$bat),array( 'dataType' => 'text','update'=>'#student_panel_handler')); 
	
	
	 ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
    { 
	    $j++; ?>
    <li>Admission number : <?php echo $_REQUEST['admissionnumber']?>
	
	<?php echo CHtml::ajaxLink("", Yii::app()->createUrl('/site/manage' ), array('type' =>'GET','data' =>array( 'name' => $name,'admissionnumber'=>'','Students[batch_id]'=>$bat ),'dataType' => 'text',  'update' =>'#student_panel_handler',array('id'=>'send-link-'.uniqid(),)));
	
	 //echo CHtml::ajaxLink('All', array('/site/manage' ,  'name' => $name,'admissionnumber'=>'','Students[batch_id]'=>$bat),array( 'dataType' => 'text','update'=>'#student_panel_handler'));  ?></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Batch : <?php echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?>
	
	<?php echo CHtml::ajaxLink("", Yii::app()->createUrl('/site/manage' ), array('type' =>'GET','data' =>array( 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>''),'dataType' => 'text',  'update' =>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); 
	
	//echo CHtml::ajaxLink('All', array('/site/manage' ,  'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>''),array( 'dataType' => 'text','update'=>'#student_panel_handler'));
	
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

<?php echo CHtml::ajaxLink('All', Yii::app()->createUrl('/site/manage' ),array('data' =>array( 'name' => $name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat,'val' => '',),'dataType' => 'text','update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php echo CHtml::ajaxLink('A', Yii::app()->createUrl('/site/manage' ),array('data' =>array('name' =>$name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat, 'val' => 'A'),'dataType' => 'text','update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); 


 

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
<?php echo CHtml::ajaxLink('B', Yii::app()->createUrl('/site/manage' ),array('data' =>array('name' =>$name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat, 'val' => 'B'),'dataType' => 'text','update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
                            
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
<?php echo CHtml::ajaxLink('C', Yii::app()->createUrl('/site/manage' ),array('data' =>array('name' =>$name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat, 'val' => 'C'),'dataType' => 'text','update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php echo CHtml::ajaxLink('D', Yii::app()->createUrl('/site/manage' ),array('data' =>array('name' =>$name,'admissionnumber'=>$ad,'Students[batch_id]'=>$bat, 'val' => 'D'),'dataType' => 'text','update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('E', $path.'&val=E',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('F', $path.'&val=F',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('G', $path.'&val=G',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('H', $path.'&val=H',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('I', $path.'&val=I',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('J', $path.'&val=J',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('K', $path.'&val=K',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('L', $path.'&val=L',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('M', $path.'&val=M',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('N', $path.'&val=N',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('O', $path.'&val=O',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('P', $path.'&val=P',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('Q', $path.'&val=Q',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('R', $path.'&val=R',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('S', $path.'&val=S',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('T', $path.'&val=T',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('U', $path.'&val=U',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('V', $path.'&val=V',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('W', $path.'&val=W',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('X', $path.'&val=X',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('Y', $path.'&val=Y',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
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
<?php  echo CHtml::ajaxLink('Z', $path.'&val=Z',array('update'=>'#student_panel_handler'),array('id'=>'send-link-'.uniqid(),)); ?>                            
</li>

</ul>
                        <div class="clear"></div>
                    </div>
				<div class="sd_tablelist">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <th>Name</th>
                            <th>Admission No:</th>
                            <th>Course/Batch</th>
                            <th>Action</th>
                          </tr>
                          <?php foreach($list as $list_1)
	                      { ?>
                          <tr>
                            <td><?php echo CHtml::link(ucfirst($list_1->first_name).'  '.ucfirst($list_1->middle_name).'  '.ucfirst($list_1->last_name),array('students/students/view','id'=>$list_1->id)) ?></td>
                            <td><?php echo $list_1->admission_no ?></td>
                            <?php $batc = Batches::model()->findByAttributes(array('id'=>$list_1->batch_id)); 
							  if($batc!=NULL)
							  {
								  $cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); ?>
								  <td><?php echo $cours->course_name.' / '.$batc->name; ?></td> 
							  <?php }
							  else{?> <td>-</td> <?php }?>
                            <td align="center"><a href="#" class="sd_action_but"></a>
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
                            </td>
                          </tr>
                          <?php } ?>
                          
                        </table>
                        

                </div>
                
			</div>
		