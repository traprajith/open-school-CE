<style>
.drop select { width:159px;}
</style>

<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);


?>
<script>
function details(id)
{
	//alert("#dropwin"+id);
	var rr= document.getElementById("dropwin"+id).style.display;
	//alert(rr);
	 if(document.getElementById("dropwin"+id).style.display=="block")
	 {
		 document.getElementById("dropwin"+id).style.display="none"; 
	 }
	 if(  document.getElementById("dropwin"+id).style.display=="none")
	 {
		 document.getElementById("dropwin"+id).style.display="block"; 
	 }
	 //return false;
	/*if ($("#dropwin"+id).is(':hidden')){
		 $("#dropwin"+id).show();
	}
	else{
		$("#dropwin"+id).hide();
	}*/

}


/*function details(id) {
	alert(123);
	var ele = document.getElementById("dropwin"+id);
	//var text = document.getElementById("displayText");
	if(ele.style.display == "block") {
		alert(1);
    		ele.style.display = "none";
		//text.innerHTML = "show";
  	}
	else {
		alert(2);
		ele.style.display = "block";
		//text.innerHTML = "hide";
	}
} */
$(document).ready(function() {
	
	
	/*function details()
	  {
		  alert(1);
		$("#batch1").click(function(){
            	if ($("#dropwin").is(':hidden')){
                	$("#dropwin").show();
				}
            	else{
                	$("#dropwin").hide();
            	}
            return false;
       			 });
				 
	  }*/
				 /*
				  $('#dropwin').click(function(e) {
            		e.stopPropagation();
					
        			});*/
        		/*$(document).click(function() {
					if (!$("#dropwin").is(':hidden')){
            		$('#dropwin').hide();
					}
        			});	*/
});	
</script>
<!--<script language="javascript">
$(document).ready(function() {
$('.cont_right').not('.drop').click(function() {
      $(".drop").hide();
});
});
</script>-->
<script language="javascript">
function hide(id)
{/*
	 $(".drop").click(function(e) {
            		e.stopPropagation();
					});
	$(document).click(function() {
					if (!$(".drop").is(':hidden')){
            		$('.drop').hide();
					}
        			});
if ($('#'+id).is(':hidden')){
                	$('#'+id).show();
				}
            	else{
                	$('#'+id).hide();
            	}*/
				 $(".drop").hide();
$('#'+id).toggle();	

}


</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
      <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('employees','Manage Employees');?></h1>

                                                
   
    <div class="search_btnbx">
    	  <!--<div class="listsearchbx">
               <ul>
                   <li><input class="listsearchbar listsearchtxt" name="" type="text" onblur="clearText(this)" onfocus="clearText(this)" value="Search for Contacts"  /></li>
                   <li><input src="images/list_searchbtn.png" name="" type="image" /></li>
               </ul>
         </div>-->
         
         
       <?php $j=0; ?>
        
        <div id="jobDialog"></div>
        
    	  <div class="contrht_bttns">
          
    <ul>
    <li><?php echo CHtml::ajaxLink('<span>'.Yii::t('employees','Save Filter').'</span>',$this->createUrl('Savedsearches/Create'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog',
		'type' =>'GET','data' => array( 'val1' => Yii::app()->request->getUrl(),'type'=>'2' ),'dataType' => 'text',
        ),array('id'=>'showJobDialog','class'=>'saveic')); ?></li>
    
    
    <li><a href="#" class="load_filter" onClick="hide('load')"><span><?php echo Yii::t('employees','Load Filter');?></span></a> 
 
    
    <div id="load" style="display:none;  overflow:scroll; height:200px; background:#fff; left:-40px; top:40px" class="drop">
    <div class="droparrow"></div>
        <ul class="loaddrop">
        	<li style="text-align:center">
        <?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'2'));
		if($data)
		{ 
			foreach ($data as $data1)
			{
				echo '<span style="width:150px; float:left; ">';echo CHtml::link($data1->name, $data1->url,array('class'=>'vtip')); echo '</span>';
				echo '<span>'; 
	echo CHtml::link('<img src="images/cross.png" border="0" />',array('/savedsearches/deleteemp','user_id'=>Yii::app()->User->id,'sid'=>$data1->id),array('confirm'=>'Are you sure you want to delete this?'));echo '</span>';
			}
		}
		else
		{
			echo '<span style="color:#d30707;"><i>'.Yii::t('students','No Saved Searches').'</i></span>';
		}
		?>
        </li>
        </ul>
        </div></li>
    
    
      
    <li><?php echo CHtml::link('<span>'.Yii::t('employees','Clear All').'</span>', array('manage')); ?></li>
    
    </ul>
    </div>
    <div class="bttns_imprtcntact">
    <ul>
    <!--<li><a class=" import_contact last" href="">Import Contact</a></li>-->
    </ul>
    </div>
    
    <div class="bttns_addstudent ">
    <ul>
    <li><?php echo CHtml::link(Yii::t('employees','Add Employee'), array('create'),array('class'=>'addbttn last')); ?></li>
    </ul>
    </div>
    </div>
  
    <div class="clear"></div>
    <div class="filtercontner">
    <div class="filterbxcntnt">
   	<div class="filterbxcntnt_inner"  style="border-bottom:#ddd solid 1px; height:60px;">
    <ul>
    <li style="font-size:12px"><?php echo Yii::t('employees','Filter Your Employees:');?></li>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'method'=>'get',
	
)); ?>


<li><div onClick="hide('name')" style="cursor:pointer;"><?php echo Yii::t('employees','Name');?></div>
<div id="name" style="display:none; width:210px; padding-top:0px; height:30px" class="drop" >
<div class="droparrow" style="left:10px;"></div>
<input type="search" placeholder="search" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
<input type="submit" value="Apply" />
</div>
</li>


<li><div onClick="hide('admissionnumber')" style="cursor:pointer;"<?php echo Yii::t('employees','Employee number');?>></div>
<div id="admissionnumber" style="display:none; width:231px; padding-top:0px; height:30px" class="drop">
<div class="droparrow" style="left:10px;"></div>
<input type="search" placeholder="search" name="employeenumber" value="<?php echo isset($_GET['employeenumber']) ? CHtml::encode($_GET['employeenumber']) : '' ; ?>" />
<input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('batch')" style="cursor:pointer;"><?php echo Yii::t('employees','Department');?></div>
<div id="batch" style="display:none; width:195px; padding-top:0px; height:30px" class="drop">
<div class="droparrow" style="left:10px;"></div>
<?php 

$data1 = CHtml::listData(EmployeeDepartments::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_department_id',$data1,array('prompt'=>'Select','id'=>'employee_department_id')); ?>
<input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('cat')" style="cursor:pointer;"><?php echo Yii::t('employees','Category');?></div>
<div id="cat" style="display:none; width:195px; padding-top:0px; height:30px" class="drop">
<div class="droparrow" style="left:10px;"></div>
<?php 

$data2 = CHtml::listData(EmployeeCategories::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_category_id',$data2,array('prompt'=>'Select','id'=>'employee_category_id')); ?>
<input type="submit" value="Apply" />
</div>
</li>


<li><div onClick="hide('pos')" style="cursor:pointer;"><?php echo Yii::t('employees','Position');?></div>
<div id="pos" style="display:none; width:195px; padding-top:0px; height:30px" class="drop">
<div class="droparrow" style="left:10px;"></div>
<?php 

$data3 = CHtml::listData(EmployeePositions::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_position_id',$data3,array('prompt'=>'Select','id'=>'employee_position_id')); ?>
<input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('grd')" style="cursor:pointer;"><?php echo Yii::t('employees','Grade');?></div>
<div id="grd" style="display:none; width:195px; padding-top:0px; height:30px; left:-140px" class="drop">
<div class="droparrow" style="left:150px;"></div>
<?php 

$data4 = CHtml::listData(EmployeeGrades::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_grade_id',$data4,array('prompt'=>'Select','id'=>'employee_grade_id')); ?>
<input type="submit" value="Apply" />
</div>
</li>


<li><div onClick="hide('gender')" style="cursor:pointer;"><?php echo Yii::t('employees','Gender');?></div>
<div id="gender" style="display:none; width:200px; padding-top:0px; height:30px; left:-140px" class="drop">
<div class="droparrow" style="left:150px;"></div>
<?php 

echo CHtml::activeDropDownList($model,'gender',array('M' => 'Male', 'F' => 'Female'),array('prompt'=>'All')); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('marital')" style="cursor:pointer;"><?php echo Yii::t('employees','Marital Status');?></div>
<div id="marital" style="display:none; width:200px; padding-top:0px; height:30px;" class="drop">
<div class="droparrow" style="left:10px;"></div>
<?php 

echo CHtml::activeDropDownList($model,'marital_status',array('Single'=>'Single','Married'=>'Married','Divorced'=>'Divorced'),array('prompt'=>'All')); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('bloodgroup')" style="cursor:pointer;"><?php echo Yii::t('employees','Blood Group');?></div>
<div id="bloodgroup" style="display:none; width:200px; padding-top:0px; height:30px;" class="drop" >
<div class="droparrow" style="left:10px;"></div>
<?php echo CHtml::activeDropDownList($model,'blood_group',
		 							array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
									array('prompt' => 'Select')); ?>
                                    <input type="submit" value="Apply" />
</div>
</li>
                                    


<li><div onClick="hide('nationality')" style="cursor:pointer;"><?php echo Yii::t('employees','Country');?></div>
<div id="nationality" style="display:none; width:195px; left:-180px; height:30px; padding-top:0px;" class="drop">
<div class="droparrow" style="left:190px;"></div>
<?php echo CHtml::activeDropDownList($model,'nationality_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('prompt'=>'Select')); ?>
<input type="submit" value="Apply" />
</div>
</li>


<li><div onClick="hide('dob')" style="cursor:pointer;"><?php echo Yii::t('employees','Date Of Birth');?></div>
<div id="dob" style="display:none; width:345px; left:-210px; height:30px; padding-top:0px;" class="drop">
<div class="droparrow" style=" left:240px"></div>
<?php echo CHtml::activeDropDownList($model,'dobrange',array('1' => 'born before', '2' => 'born in', '3' => 'born after'),array('prompt'=>'Option')); ?>
<?php
$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	if($settings!=NULL)
	{
		$date=$settings->dateformat;
		
		
	}
	else
	$date = 'dd-mm-yy';	
?>
<?php 
$daterange=date('Y');
 		 $daterange_1=$daterange+37;
		
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Employees[date_of_birth]',
								'model'=>$model,
								'value'=>$model->date_of_birth,
								
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.$daterange_1,
								),
								'htmlOptions'=>array(
									'style'=>'height:15px;',
									'id'=>'dobtxt'
								),
							));
		 ?>
         <input type="submit" value="Apply" />
</div>
</li>

<li><div onClick="hide('joining')" style="cursor:pointer;"><?php echo Yii::t('employees','Joining Date');?></div>
<div id="joining" style="display:none; width:345px; left:-190px;  height:30px; padding-top:0px;" class="drop">
<div class="droparrow" style=" left:220px"></div>
<?php echo CHtml::activeDropDownList($model,'joinrange',array('1' => 'before', '2' => 'in', '3' => 'after'),array('prompt'=>'Option')); ?>
<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Employees[joining_date]',
								'model'=>$model,
								'value'=>$model->joining_date,
								
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.$daterange_1,
								),
								'htmlOptions'=>array(
									'style'=>'height:15px;',
									'id'=>'joindatetxt'
								),
							));
		 ?>
         <input type="submit" value="Apply" />
</div>
</li>

<?php /*?><li><div onclick="hide('status')" style="cursor:pointer;"><?php echo Yii::t('employees','Status');?></div>
<div id="status" style="display:none; width:160px; min-height:20px; padding-top:0px; left:-120px" class="drop">
<div class="droparrow"  style="left:135px"></div>

<?php 
echo CHtml::activeDropDownList($model,'status',array('1' => 'Present', '0' => 'Former'),array('selected'=>'selected','prompt'=>'All')); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li><?php */?>






<?php $this->endWidget(); ?>
    
    </ul>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="filterbxcntnt_inner_bot" >
    <div class="filterbxcntnt_left"><?php echo Yii::t('employees','<strong>Active Filters:</strong>');?></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul>
    
    
    <?php if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
	{
		$j++; ?>
    <li>Name : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['employeenumber']) and $_REQUEST['employeenumber']!=NULL)
    { 
	    $j++; ?>
    <li>Admission number : <?php echo $_REQUEST['employeenumber']?><a href="<?php echo Yii::app()->request->getUrl().'&employeenumber='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_department_id']) and $_REQUEST['Employees']['employee_department_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Department : <?php echo EmployeeDepartments::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_department_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_department_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_category_id']) and $_REQUEST['Employees']['employee_category_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Category : <?php echo EmployeeCategories::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_category_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_category_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_position_id']) and $_REQUEST['Employees']['employee_position_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Position : <?php echo EmployeePositions::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_position_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_position_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_grade_id']) and $_REQUEST['Employees']['employee_grade_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Grade : <?php echo EmployeeGrades::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_grade_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_grade_id]='?>"></a></li>
    <?php } ?>
    
    
    
    <?php if(isset($_REQUEST['Employees']['gender']) and $_REQUEST['Employees']['gender']!=NULL)
	{ $j++;
	if($_REQUEST['Employees']['gender']=='M')
	$gen='Male';
	else
	$gen='Female';
	?>
    <li>Gender : <?php echo $gen?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[gender]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['marital_status']) and $_REQUEST['Employees']['marital_status']!=NULL)
	{
		$j++; ?>
    <li>Marital Status : <?php echo $_REQUEST['Employees']['marital_status']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[marital_status]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['blood_group']) and $_REQUEST['Employees']['blood_group']!=NULL)
	{ 
	   $j++; ?>
    <li>Blood Group : <?php echo $_REQUEST['Employees']['blood_group']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[blood_group]='?>"></a></li>
    <?php } ?>
    
    
    <?php  if(isset($_REQUEST['Employees']['nationality_id']) and $_REQUEST['Employees']['nationality_id']!=NULL)
	{
	    $j++; ?>
    <li>Country : <?php echo Countries::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['nationality_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[nationality_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php  
	
	if(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']!=NULL)
	{
		if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
	    { $j++;
			      if($_REQUEST['Employees']['dobrange']=='1')
				  {
					  $range = 'born before';
				  }
				  if($_REQUEST['Employees']['dobrange']=='2')
				  {
					  $range = 'born in';
				  }
				  if($_REQUEST['Employees']['dobrange']=='3')
				  {
					  $range = 'born after';
				  }?>
    <li>Date Of Birth : <?php echo $range.' : '.$_REQUEST['Employees']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[date_of_birth]='?>"></a></li>
    <?php }} 
	
	elseif(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']==NULL)
	{ 
	  if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
	  { $j++;
		        $range = 'born in';  
				  ?>
    <li>Date Of Birth : <?php echo $range.' : '.$_REQUEST['Employees']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[date_of_birth]='?>"></a></li>
    <?php }} ?>
    
    
    
    
    <?php 
	if(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']!=NULL)
    {
		if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  { $j++;
				  if($_REQUEST['Employees']['joinrange']=='1')
				  {
					  $joinrange = 'before';
				  }
				  if($_REQUEST['Employees']['joinrange']=='2')
				  {
					  $joinrange = 'in';
				  }
				  if($_REQUEST['Employees']['joinrange']=='3')
				  {
					  $joinrange = 'after';
				  }
				  
				  ?>
     <li>Joining Date : <?php echo $joinrange.' : '.$_REQUEST['Employees']['joining_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[joining_date]='?>"></a></li>
    <?php }} 
	elseif(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']==NULL)
		{
			  if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  { $j++;
			  
				   $joinrange = 'in'; ?>
     <li>Joining Date : <?php echo $joinrange.' : '.$_REQUEST['Employees']['joining_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[joining_date]='?>"></a></li>
    <?php }}?> 
    
    
    <?php  if(isset($_REQUEST['Employees']['status']) and $_REQUEST['Employees']['status']!=NULL)
	{ $j++;
		  if($_REQUEST['Employees']['status']=='1')
		  {
			  $status='Present';
		  }
		  else
		  {
		      $status='Former';
		  }
		  ?>
		  <li>Status : <?php echo $status?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[status]='?>"></a></li>
    <?php } ?> 
    <?php if($j==0)
	{
		echo '<div style="padding-top:3px; font-size:11px;"><i>No Active Filters</i></div>';
	}?> 
   
    <div class="clear"></div>
    </ul>
    </div>
    <div class="clear"></div>
    </div>
    </div>
    </div>
    <div class="clear"></div>
    
      <div class="list_contner_hdng">
    <div class="letterNavCon" id="letterNavCon">
    
    
  
                    
<ul>
<?php if((isset($_REQUEST['val']) and $_REQUEST['val']==NULL) or (!isset($_REQUEST['val'])))
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>

<?php echo CHtml::link(Yii::t('employees','All'), Yii::app()->request->getUrl().'&val=',array('class'=>'vtip')); ?>                            
</li>


<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='A')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php echo CHtml::link(Yii::t('employees','A'), Yii::app()->request->getUrl().'&val=A',array('class'=>'vtip')); ?>                            
</li>


<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='B')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','B'), Yii::app()->request->getUrl().'&val=B',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='C')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','C'), Yii::app()->request->getUrl().'&val=C',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='D')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','D'), Yii::app()->request->getUrl().'&val=D',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='E')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','E'), Yii::app()->request->getUrl().'&val=E',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='F')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','F'), Yii::app()->request->getUrl().'&val=F',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='G')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','G'), Yii::app()->request->getUrl().'&val=G',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='H')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','H'), Yii::app()->request->getUrl().'&val=H',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='I')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','I'), Yii::app()->request->getUrl().'&val=I',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='J')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','J'), Yii::app()->request->getUrl().'&val=J',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='K')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','K'), Yii::app()->request->getUrl().'&val=K',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='L')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','L'), Yii::app()->request->getUrl().'&val=L',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='M')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','M'), Yii::app()->request->getUrl().'&val=M',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='N')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','N'), Yii::app()->request->getUrl().'&val=N',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='O')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','O'), Yii::app()->request->getUrl().'&val=O',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='P')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','P'), Yii::app()->request->getUrl().'&val=P',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Q')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','Q'), Yii::app()->request->getUrl().'&val=Q',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='R')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','R'), Yii::app()->request->getUrl().'&val=R',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='S')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','S'), Yii::app()->request->getUrl().'&val=S',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='T')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','T'), Yii::app()->request->getUrl().'&val=T',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='U')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','U'), Yii::app()->request->getUrl().'&val=U',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='V')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','V'), Yii::app()->request->getUrl().'&val=V',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='W')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','W'), Yii::app()->request->getUrl().'&val=W',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='X')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','X'), Yii::app()->request->getUrl().'&val=X',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Y')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','Y'), Yii::app()->request->getUrl().'&val=Y',array('class'=>'vtip')); ?>                            
</li>
<?php if(isset($_REQUEST['val']) and $_REQUEST['val']=='Z')
{
	echo '<li class="ln_active">';
}
else
{
	echo '<li>';
}
?>
<?php  echo CHtml::link(Yii::t('employees','Z'), Yii::app()->request->getUrl().'&val=Z',array('class'=>'vtip')); ?>                            
</li>
<div class="clear"></div>
</ul>
                    	<div class="clear"></div>
                    </div>
    
    </div>                                          
    <div class="list_contner">
    
    <div class="clear"></div>
                                                
    <?php if($list)
	{?>
        <div class="tablebx">  
         <div class="pagecon">
                                                 <?php 
	                                                  $this->widget('CLinkPager', array(
													  'currentPage'=>$pages->getCurrentPage(),
													  'itemCount'=>$item_count,
													  'pageSize'=>$page_size,
													  'maxButtonCount'=>5,
													  //'nextPageLabel'=>'My text >',
													  'header'=>'',
												  'htmlOptions'=>array('class'=>'pages'),
												  ));?>
                                                  </div>                                         
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
  <tr class="tablebx_topbg">
    <td><?php echo Yii::t('employees','Sl. No.');?></td>	
    <td><?php echo Yii::t('employees','Employee Name');?></td>
    <td><?php echo Yii::t('employees','Employee No.');?></td>
    <td><?php echo Yii::t('employees','Department');?></td>
    <td><?php echo Yii::t('employees','Gender');?></td>
    <td><?php echo Yii::t('employees','Actions');?></td>
    <!--<td style="border-right:none;">Task</td>-->
  </tr>
  <?php 
  if(isset($_REQUEST['page']))
  {
      $i=($pages->pageSize*$_REQUEST['page'])-9;
  }
  else
  {
	  $i=1;
  }
  
  $cls="even";
  ?>
  
  <?php foreach($list as $list_1)
	{ ?>
 <tr class=<?php echo $cls;?> id=<?php echo $i;?>>
    <td><?php echo $i; ?></td>
    <td><?php echo CHtml::link($list_1->first_name.'  '.$list_1->middle_name.'  '.$list_1->last_name,array('view','id'=>$list_1->id)) ?></td>
    <td><?php echo $list_1->employee_number ?></td>
	<?php $batc = EmployeeDepartments::model()->findByAttributes(array('id'=>$list_1->employee_department_id)); 
	if($batc!=NULL)
	{
		 ?>
		<td><?php echo $batc->name; ?></td> 
	<?php }
	else{?> <td>-</td> <?php }?>
    
    <td><?php if($list_1->gender=='M')
	{
		echo 'Male';
	}
	elseif($list_1->gender=='F')
	{
		echo 'Female';
	}?></td>
    <td><?php //echo CHtml::ajaxlink('Delete',array('employees/manage','id'=>$list_1->id),array('confirm'=>'Do you want to delete Employee ?')) 
		//echo CHtml::ajaxLink('Delete', array('deletes','id'=>$list_1->id), array('update'=>'#'.$i),array('confirm'=>'Do you want to delete this employee ?'));
		echo CHtml::ajaxLink('Delete', array('deletes','id'=>$list_1->id), array('success'=>'rowdelete('.$i.')'),array('confirm'=>'Do you want to delete this employee ?'));
		//echo CHtml::ajaxLink('Delete', array('deletes'), array('update'=>'#forAjaxRefresh'),array('onclick'=>'js: alert(Do you want to delete Employee ?);'));
	?></td>
    <!--<td style="border-right:none;">Task</td>-->
  </tr><?php
  if($cls=="even")
  {
	 $cls="odd" ;
  }
  else
  {
	  $cls="even"; 
  }
	$i++;} ?>
</table>
<div class="pagecon">
    <?php                                          
	                                                  $this->widget('CLinkPager', array(
													  'currentPage'=>$pages->getCurrentPage(),
													  'itemCount'=>$item_count,
													  'pageSize'=>$page_size,
													  'maxButtonCount'=>5,
													  //'nextPageLabel'=>'My text >',
													  'header'=>'',
												  'htmlOptions'=>array('class'=>'pages'),
												  ));?>
                                                  </div>
<div class="clear"></div>
    </div>
    <?php }
	else
	{
	echo '<div class="listhdg" align="center">'.Yii::t('employees','Nothing Found!!').'</div>';	
	}?>
    
    
    </div>
    
    

<br />

  </div>
  </div> 

</div>
    </td>
  </tr>
</table>
</body>
<script>
$('body').click(function() {
	$('#load').hide();
   $('#name').hide();
   $('#admissionnumber').hide();
   $('#batch').hide();
   $('#cat').hide();
   $('#pos').hide();
   $('#grd').hide();
   $('#gender').hide();
   $('#marital').hide();
    $('#bloodgroup').hide();
	$('#nationality').hide();
	if($("#dobtxt").val().length <=0)
	{
		$('#dob').hide();
	}
	if($("#joindatetxt").val().length <=0)
	{
		$('#joining').hide();
	}
});

$('.filterbxcntnt_inner').click(function(event){
   event.stopPropagation();
});

$('.load_filter').click(function(event){
   event.stopPropagation();
});

function rowdelete(id)
{
	 $("#"+id).fadeOut("slow");
}
</script>