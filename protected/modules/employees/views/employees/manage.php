<style>
.drop select { width:159px;}
.bttns_addstudent li a.addbttn{
	padding:12px 15px 11px 12px;
	font-size:12px;
	background-color:#09F;
	font-weight:bold;
}
.bttns_addstudent{
	top:0px;
	left:98px;
}
</style>

<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher')=>array('index'),
	Yii::t('app','Manage'),
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
				 $(".drop_search").hide();
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
<h1><?php echo Yii::t('app','Manage Teachers');?></h1>

                                                
   
    <div class="search_btnbx">
    	  <!--<div class="listsearchbx">
               <ul>
                   <li><input class="listsearchbar listsearchtxt" name="" type="text" onblur="clearText(this)" onfocus="clearText(this)" value="Search for Contacts"  /></li>
                   <li><input src="images/list_searchbtn.png" name="" type="image" /></li>
               </ul>
         </div>-->
         
         
       <?php $j=0; ?>
        
        <div id="jobDialog"></div>
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo CHtml::ajaxLink('<span>'.Yii::t('app','Save Filter').'</span>',$this->createUrl('Savedsearches/Create'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog',
		'type' =>'GET','data' => array( 'val1' => Yii::app()->request->getUrl(),'type'=>'2' ),'dataType' => 'text',
        ),array('id'=>'showJobDialog','class'=>'a_tag-btn')); ?></li>

<li style=" position:relative;"><a href="javascript:void(0)" class="load_filter a_tag-btn" onClick="hide('load')"><span><?php echo Yii::t('app','Load Filter');?></span></a> 
 
    
    <div id="load" style="display:none; left: -141px;" class="drop">
    <div class="droparrow"></div>
        <ul class="loaddrop">
        	<li style="text-align:center">
        <?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'2'));
		if($data)
		{ 
			foreach ($data as $data1)
			{
				echo '<span style="width:150px; float:left; ">';echo CHtml::link($data1->name, CHtml::decode($data1->url),array('class'=>'vtip')); echo '</span>';
				echo '<span>'; 
	echo CHtml::link('<img src="images/cross.png" border="0" />',array('/savedsearches/deleteemp','user_id'=>Yii::app()->User->id,'sid'=>$data1->id),array('confirm'=>Yii::t('app','Are you sure ? You want to delete this?')));echo '</span>';
			}
		}
		else
		{
			echo '<span style="color:#d30707;"><i>'.Yii::t('app','No Saved Searches').'</i></span>';
		}
		?>
        </li>
        </ul>
        </div></li> 
    <li><?php echo CHtml::link('<span>'.Yii::t('app','Clear All').'</span>', array('manage'),array('class'=>'a_tag-btn')); ?></li>                               
</ul>
</div> 

</div>
        
    	  <div class="contrht_bttns">
          
    <ul>
    <li></li>
    
    
    <li>
    
    

    
    </ul>
    </div>

    
    </div>
  
    <div class="clear"></div>
    <div class="filtercontner">
    <div class="filterbxcntnt">
   	<div class="filterbxcntnt_inner"  style="border-bottom:#ddd solid 1px; height:60px;">
    <ul>
    <li style="font-size:12px"><?php echo Yii::t('app','Filter Your Teacher:');?></li>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'method'=>'get',
	
)); ?>


<li><div onClick="hide('name')" style="cursor:pointer;"><?php echo Yii::t('app','Name');?></div>
<div id="name" style="display:none; width:230px;" class="drop_search" >
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
    <li class="Text_area_Box">
     <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
    </li>
    <li class="Btn_area_Box">
    <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
    </li>
</ul>
</div>
</div>
</li>

<li><div onClick="hide('admissionnumber')" style="cursor:pointer;"><?php echo Yii::t('app','Teacher Number');?></div>
<div id="admissionnumber" style="display:none; width:230px;" class="drop_search" >
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
    <li class="Text_area_Box">
     <input type="search" placeholder="<?php echo Yii::t('app','search'); ?>" name="employeenumber" value="<?php echo isset($_GET['employeenumber']) ? CHtml::encode($_GET['employeenumber']) : '' ; ?>" />
    </li>
    <li class="Btn_area_Box">
    <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
    </li>
</ul>
</div>
</div>
</li>



<li><div onClick="hide('batch')" style="cursor:pointer;"><?php echo Yii::t('app','Department');?></div>
<div id="batch" style="display:none; width:230px;" class="drop_search">
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
    <li class="Text_area_Box">
     <?php 
$data1 = CHtml::listData(EmployeeDepartments::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_department_id',$data1,array('prompt'=>Yii::t('app','Select'),'id'=>'employee_department_id')); ?>
    </li>
    <li class="Btn_area_Box">
   <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
    </li>
</ul>
</div>
</div>
</li>

<li><div onClick="hide('cat')" style="cursor:pointer;"><?php echo Yii::t('app','Category');?></div>
<div id="cat" style="display:none; width:230px;" class="drop_search">
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php 
$data2 = CHtml::listData(EmployeeCategories::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_category_id',$data2,array('prompt'=>Yii::t('app','Select'),'id'=>'employee_category_id')); ?>
</li>
<li class="Btn_area_Box">
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div>
</div>
</li>


<li><div onClick="hide('pos')" style="cursor:pointer;"><?php echo Yii::t('app','Position');?></div>
<div id="pos" style="display:none; width:230px;" class="drop_search">
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php 
$data3 = CHtml::listData(EmployeePositions::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'employee_position_id',$data3,array('prompt'=>Yii::t('app','Select'),'id'=>'employee_position_id')); ?>
</li>
<li class="Btn_area_Box">
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div>
</div>
</li>

<li><div onClick="hide('grd')" style="cursor:pointer;"><?php echo Yii::t('app','Grade');?></div>
<div id="grd" style="display:none; width:230px;left:-140px" class="drop_search">
<div class="droparrow" style="left:150px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php 
$data4 = CHtml::listData(EmployeeGrades::model()->findAll(array('order'=>'name DESC','condition'=>'status=:x','params'=>array(':x'=>1))),'id','name');
echo CHtml::activeDropDownList($model,'employee_grade_id',$data4,array('prompt'=>Yii::t('app','Select'),'id'=>'employee_grade_id')); ?>
</li>
<li class="Btn_area_Box">
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div>
</div>
</li>


<li><div onClick="hide('gender')" style="cursor:pointer;"><?php echo Yii::t('app','Gender');?></div>
<div id="gender" style="display:none; width:242px; left:-140px" class="drop_search">
<div class="droparrow" style="left:150px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php 
echo CHtml::activeDropDownList($model,'gender',array('M' => Yii::t('app','Male'), 'F' => Yii::t('app','Female')),array('prompt'=>Yii::t('app','All'))); 
 ?>
</li> 
 <li class="Btn_area_Box">
 <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div> 
</div>
</li>

<li><div onClick="hide('marital')" style="cursor:pointer;"><?php echo Yii::t('app','Marital Status');?></div>
<div id="marital" style="display:none; width:230px; left:-140px" class="drop_search">
<div class="droparrow" style="left:173px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php 
echo CHtml::activeDropDownList($model,'marital_status',array('Single'=>Yii::t('app','Single'),'Married'=>Yii::t('app','Married'),'Divorced'=>Yii::t('app','Divorced')),array('prompt'=>Yii::t('app','All'))); 
 ?>
 </li> 
 <li class="Btn_area_Box">
 <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div> 
</div>
</li>

<li><div onClick="hide('bloodgroup')" style="cursor:pointer;"><?php echo Yii::t('app','Blood Group');?></div>
<div id="bloodgroup" style="display:none; width:230px;" class="drop_search" >
<div class="droparrow" style="left:10px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php echo CHtml::activeDropDownList($model,'blood_group',
array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
array('prompt' => Yii::t('app','Select'))); ?>
</li> 
<li class="Btn_area_Box">                                    
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div>                                 
</div>
</li>

<li><div onClick="hide('nationality')" style="cursor:pointer;"><?php echo Yii::t('app','Country');?></div>
<div id="nationality" style="display:none; width:230px; left:-180px;" class="drop_search">
<div class="droparrow" style="left:200px;"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box">
<?php echo CHtml::activeDropDownList($model,'home_country_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('prompt'=>Yii::t('app','Select'))); ?>
</li> 
<li class="Btn_area_Box">      
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>
</ul>
</div>

</div>
</li>


<li><div onClick="hide('dob')" style="cursor:pointer;"><?php echo Yii::t('app','Date Of Birth');?></div>
<div id="dob" style="display:none; width:420px; left:-210px; " class="drop_search">
<div class="droparrow" style=" left:240px"></div>

         
<div class="filter_ul">
<ul>

<li class="Text_area_Box-two">
<?php echo CHtml::activeDropDownList($model,'dobrange',array('1' => Yii::t('app','born before'), '2' => Yii::t('app','born in'), '3' => Yii::t('app','born after')),array('prompt'=>Yii::t('app','Option'))); ?>
</li>
<li class="Text_area_Box-two">
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
									'style'=>'',
									'id'=>'dobtxt'
								),
							));
		 ?>
</li>
<li class="Btn_area_Box">
<input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
</li>

</ul>
</div>   
         
         
</div>
</li>

<li><div onClick="hide('joining')" style="cursor:pointer;"><?php echo Yii::t('app','Joining Date');?></div>
<div id="joining" style="display:none; width:420px; left:-190px; " class="drop_search">
<div class="droparrow" style=" left:220px"></div>
<div class="filter_ul">
<ul>
<li class="Text_area_Box-two">
<?php echo CHtml::activeDropDownList($model,'joinrange',array('1' => Yii::t('app','before'), '2' => Yii::t('app','on'), '3' => Yii::t('app','after')),array('prompt'=>Yii::t('app','Option'))); ?>
</li>
<li class="Text_area_Box-two">
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
									'style'=>'',
									'id'=>'joindatetxt'
								),
							));
		 ?>
         </li>
<li class="Btn_area_Box">   
         <input type="submit" value="<?php echo Yii::t('app','Apply'); ?>" />
         </li>
         </ul>
         </div>
         
</div>
</li>

<?php /*?><li><div onclick="hide('status')" style="cursor:pointer;"><?php echo Yii::t('app','Status');?></div>
<div id="status" style="display:none; width:160px; min-height:20px; padding-top:0px; left:-120px" class="drop">
<div class="droparrow"  style="left:135px"></div>

<?php 
echo CHtml::activeDropDownList($model,'status',array('1' => 'Present', '0' => 'Former'),array('selected'=>'selected','prompt'=>Yii::t('app','All'))); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li><?php */?>





    
    </ul>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="filterbxcntnt_inner_bot" >
    <div class="filterbxcntnt_left"><strong><?php echo Yii::t('app','Active Filters:');?></strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul>
    
    
    <?php if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
	{
		$j++; ?>
    <li><?php echo Yii::t('app','Name');?> : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['employeenumber']) and $_REQUEST['employeenumber']!=NULL)
    { 
	    $j++; ?>
    <li><?php echo Yii::t('app','Teacher Number');?> : <?php echo $_REQUEST['employeenumber']?><a href="<?php echo Yii::app()->request->getUrl().'&employeenumber='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_department_id']) and $_REQUEST['Employees']['employee_department_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::t('app','Department');?> : <?php echo EmployeeDepartments::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_department_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_department_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_category_id']) and $_REQUEST['Employees']['employee_category_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::t('app','Category');?> : <?php echo EmployeeCategories::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_category_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_category_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_position_id']) and $_REQUEST['Employees']['employee_position_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::t('app','Position');?> : <?php echo EmployeePositions::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_position_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_position_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['employee_grade_id']) and $_REQUEST['Employees']['employee_grade_id']!=NULL)
    { 
	   $j++;
	?>
    <li><?php echo Yii::t('app','Grade');?> : <?php echo EmployeeGrades::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['employee_grade_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[employee_grade_id]='?>"></a></li>
    <?php } ?>
    
    
    
    <?php if(isset($_REQUEST['Employees']['gender']) and $_REQUEST['Employees']['gender']!=NULL)
	{ $j++;
	if($_REQUEST['Employees']['gender']=='M')
	$gen=Yii::t('app','Male');
	else
	$gen=Yii::t('app','Female');
	?>
    <li><?php echo Yii::t('app','Gender');?> : <?php echo $gen?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[gender]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['marital_status']) and $_REQUEST['Employees']['marital_status']!=NULL)
	{
		$j++; ?>
    <li><?php echo Yii::t('app','Marital Status');?> : <?php echo $_REQUEST['Employees']['marital_status']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[marital_status]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Employees']['blood_group']) and $_REQUEST['Employees']['blood_group']!=NULL)
	{ 
	   $j++; ?>
    <li><?php echo Yii::t('app','Blood Group');?> : <?php echo $_REQUEST['Employees']['blood_group']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[blood_group]='?>"></a></li>
    <?php } ?>
    
    
    <?php  if(isset($_REQUEST['Employees']['home_country_id']) and $_REQUEST['Employees']['home_country_id']!=NULL)
	{
	    $j++; ?>
    <li><?php echo Yii::t('app','Country');?> : <?php echo Countries::model()->findByAttributes(array('id'=>$_REQUEST['Employees']['home_country_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[home_country_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php  
	
	if(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']!=NULL)
	{
		if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
	    { $j++;
			      if($_REQUEST['Employees']['dobrange']=='1')
				  {
					  $range = Yii::t('app','born before');
				  }
				  if($_REQUEST['Employees']['dobrange']=='2')
				  {
					  $range = Yii::t('app','born in');
				  }
				  if($_REQUEST['Employees']['dobrange']=='3')
				  {
					  $range = Yii::t('app','born after');
				  }?>
    <li><?php echo Yii::t('app','Date Of Birth');?> : <?php echo $range.' : '.$_REQUEST['Employees']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[date_of_birth]='?>"></a></li>
    <?php }} 
	
	elseif(isset($_REQUEST['Employees']['dobrange']) and $_REQUEST['Employees']['dobrange']==NULL)
	{ 
	  if(isset($_REQUEST['Employees']['date_of_birth']) and $_REQUEST['Employees']['date_of_birth']!=NULL)
	  { $j++;
		        $range = Yii::t('app','born in');  
				  ?>
    <li><?php echo Yii::t('app','Date Of Birth :'); ?> <?php echo $range.' : '.$_REQUEST['Employees']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[date_of_birth]='?>"></a></li>
    <?php }} ?>
    
    
    
    
    <?php 
	if(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']!=NULL)
    {
		if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  { $j++;
				  if($_REQUEST['Employees']['joinrange']=='1')
				  {
					  $joinrange = Yii::t('app','before');
				  }
				  if($_REQUEST['Employees']['joinrange']=='2')
				  {
					  $joinrange = Yii::t('app','on');
				  }
				  if($_REQUEST['Employees']['joinrange']=='3')
				  {
					  $joinrange = Yii::t('app','after');
				  }
				  
				  ?>
     <li><?php echo Yii::t('app','Joining Date');?> : <?php echo $joinrange.' : '.$_REQUEST['Employees']['joining_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[joining_date]='?>"></a></li>
    <?php }} 
	elseif(isset($_REQUEST['Employees']['joinrange']) and $_REQUEST['Employees']['joinrange']==NULL)
		{
			  if(isset($_REQUEST['Employees']['joining_date']) and $_REQUEST['Employees']['joining_date']!=NULL)
			  { $j++;
			  
				   $joinrange = Yii::t('app','on'); ?>
     <li><?php echo Yii::t('app','Joining Date');?> : <?php echo $joinrange.' : '.$_REQUEST['Employees']['joining_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[joining_date]='?>"></a></li>
    <?php }}?> 
    
    
    <?php  if(isset($_REQUEST['Employees']['status']) and $_REQUEST['Employees']['status']!=NULL)
	{ $j++;
		  if($_REQUEST['Employees']['status']=='1')
		  {
			  $status=Yii::t('app','Present');
		  }
		  else
		  {
		      $status=Yii::t('app','Former');
		  }
		  ?>
		  <li><?php echo Yii::t('app','Status :'); ?> <?php echo $status?><a href="<?php echo Yii::app()->request->getUrl().'&Employees[status]='?>"></a></li>
    <?php } ?> 
    <?php if($j==0)
	{
        ?>
		<div style="padding-top:3px; font-size:11px;"><i>
                        <?php echo Yii::t('app','No Active Filters'); ?>
                    </i></div>
                  <?php
	}?> 
   
    <div class="clear"></div>
    </ul>
    </div>
    <div class="clear"></div>
    </div>
    </div>
    </div>
    <div class="clear"></div>
    
    <!-- Alphabetic Sort -->
    <?php $this->widget('application.extensions.letterFilter.LetterFilter', array(
        //parameters
        'outerWrapperClass'=>'list_contner_hdng',
        'innerWrapperId'=>'letterNavCon',
        'innerWrapperClass'=>'letterNavCon',
        'activeClass'=>'ln_active',
    )); ?>
    <!-- END Alphabetic Sort -->    
    
    <?php
	$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
	if(Yii::app()->user->year)
	{
		$year = Yii::app()->user->year;
	}
	else
	{
		$year = $current_academic_yr->config_value;
	}
	$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
	if(($year != $current_academic_yr->config_value and $is_delete->settings_value==0) and $list!=NULL)
	{
		
	?><?php /*?>
	
		<div>
			<div class="yellow_bx" style="background-image:none;width:670px;padding-bottom:45px;">
				<div class="y_bx_head" style="width:650px;">
				<?php 
					echo Yii::t('app','You are not viewing the current active year. ');
					
				?>
				</div>
				<div class="y_bx_list" style="width:650px;">
					<h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
				</div>
			</div>
		</div>
		<?php */?>
	<?php	
		
	}
	
	
	?>
    
                                             
    <div  style="margin-top:43px;">
    
    <div class="clear"></div>
    
    <div class="pdf-box">
    <div class="box-one">
    	<div class="bttns_addstudent-n">
    <ul>
    	<li>
			<?php echo CHtml::link(Yii::t('app','Add Teacher'), array('create'),array('class'=>'formbut-n')); ?>
         </li>
         <?php if(count($list) > 0){ ?>
             <li>
                    <?php echo CHtml::Button( Yii::t('app','Delete All'),array('name'=>'submit','class'=>' formbut-n-input','id'=>'delete','onclick'=>'return delete_all()',));?>   
             </li>
        <?php } ?>
    </ul>
</div>
    </div>
    <div class="box-two">
         <div class="pdf-div">
         	<?php if(count($list) > 0){ ?>
                <button type="submit" class="pdf_but-input"  name= "print" formtarget="_blank">
                	<?php echo Yii::t('app','Generate PDF')?>
                </button>
			<?php } ?>    
         </div>
    </div>
</div>
    
<?php $this->endWidget(); ?>    
                                                
    <?php if($list)
	{
	
	?>
    
    
    
        <div class="tablebx" style="position:relative">  

        
     
    
   <div class="clear"></div>   


                       
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tablebx_topbg">
    <td style="text-align:center"><div class="btn-group mailbox-checkall-buttons">
    <input type="checkbox" id="ch"  name="ch1" class="chkbox checkall" onClick="checkall()"/> </div></td>
    <td><?php echo Yii::t('app','Sl. No.');?></td>	
    <td><?php echo Yii::t('app','Teacher Name');?></td>
    <td><?php echo Yii::t('app','Teacher No');?></td>
    <td><?php echo Yii::t('app','Department');?></td>
    <td><?php echo Yii::t('app','Gender');?></td>
    <?php
	if((($year == $current_academic_yr->config_value)) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
	{
	?>
    <td><?php echo Yii::t('app','Actions');?></td>
    <?php
	}
	?>
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
 <tr class="<?php echo $cls;?>" id="<?php echo $i;?>">
    <td style="text-align:center">
        <div class="mailbox-item-wrapper">
        <label class="checkbox1" for="conv_<?php echo $list_1->id; ?>">
        <div class="mailbox-check mailbox-ellipsis">
        <input class="checkbox1 " id="conv_<?php echo $list_1->id; ?>" type="checkbox" name="convs" value="<?php echo $list_1->id; ?>" onClick="selectcheck()" />
        </div>
        </div>
    </td>
    <td><?php echo $i; ?></td>
    <td><?php echo CHtml::link(Employees::model()->getTeachername($list_1->id),array('view','id'=>$list_1->id)) ?></td>
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
		echo Yii::t('app','Male');
	}
	elseif($list_1->gender=='F')
	{
		echo Yii::t('app','Female');
	}?></td>
    <td><?php //echo CHtml::ajaxlink('Delete',array('employees/manage','id'=>$list_1->id),array('confirm'=>'Do you want to delete Teacher ?')) 
		//echo CHtml::ajaxLink('Delete', array('deletes','id'=>$list_1->id), array('update'=>'#'.$i),array('confirm'=>'Do you want to delete this employee ?'));
	
	if((($year == $current_academic_yr->config_value)) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
	{
	
		echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('deletes','id'=>$list_1->id,), 'confirm'=>Yii::t('app','Are you sure you want to delete the teacher?'), 'csrf'=>true)); 
	}
		//echo CHtml::ajaxLink('Delete', array('deletes'), array('update'=>'#forAjaxRefresh'),array('onclick'=>'js: alert(Do you want to delete Teacher ?);'));
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
	echo '<div class="listhdg" align="center">'.Yii::t('app','Nothing Found!!').'</div>';	
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
	 location.reload();
}
function checkall()
{
	if(ch.checked)
	{ 
		$('.checkbox1').prop('checked', true);
	}
	else
	{
		$('.checkbox1').each(function() { //loop through each checkbox
		   this.checked = false; //deselect all checkboxes with class "checkbox1"                       
		});         
	}
}
function selectcheck()
{
	var numberOfChecked = $('.checkbox1:checked').length; //count of all checked checkboxes with class "checkbox1"
	var totalCheckboxes = $('.checkbox1:checkbox').length; //count of all textboxes with class "checkbox1"
	if(numberOfChecked == totalCheckboxes)
		ch.checked=true;
	else
		ch.checked=false;	
}

function delete_all()
{  
	var numberOfChecked = $('.checkbox1:checked').length; //count of all checked checkboxes with class "checkbox1"
	var totalCheckboxes = $('.checkbox1:checkbox').length; //count of all textboxes with class "checkbox1"
	var notChecked 		= $('.checkbox1:not(":checked")').length; //totalCheckboxes - numberOfChecked;
	
	if(numberOfChecked > 0){		
		var favorite = [];
		$.each($("input[name='convs']:checked"), function(){            
			favorite.push($(this).val());
		});
		var r	= confirm("<?php echo Yii::t('app','Are you sure ? Do you want to delete this?');?>");
		
		if(r==true){
			$.ajax({
				url:"<?php echo Yii::app()->createUrl('/employees/employees/delete_all');?>",
				type:'POST',
				data:{id:favorite, "<?php echo Yii::app()->request->csrfTokenName;?>":"<?php echo Yii::app()->request->csrfToken;?>"},
				dataType:"json",
				success:function(response){
					if(response.status=="success"){
						window.location.reload();
					}
					else{
						alert("<?php echo Yii::t("app", "Error");?>");
					}
				}
			});
		}
		else{		
			return false;
		}
	}else{
		alert("<?php echo Yii::t('app','Please select atleast one Teacher');?>");
		return false;
	}
}
</script>