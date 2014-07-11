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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
      <?php $this->renderPartial('//courses/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>Manage Students</h1>

                                                
   
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
    <li><?php echo CHtml::ajaxLink(Yii::t('job','Save Filter'),$this->createUrl('Savedsearches/Addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog',
		'type' =>'GET','data' => array( 'val1' => Yii::app()->request->getUrl(),'type'=>'1' ),'dataType' => 'text',
        ),array('id'=>'showJobDialog','class'=>'saveic')); ?></li>
    
    
    <li><a href="#" class="load_filter" onclick="hide('load')">Load Filter</a> 
 
    
    <div id="load" style="display:none; background:#fff; left:150px; top:40px" class="drop">
    <div class="droparrow"></div>
        <ul class="loaddrop">
        <?php $data=Savedsearches::model()->findAllByAttributes(array('user_id'=>Yii::app()->User->id,'type'=>'1'));
		if($data!=NULL)
		{ 
			foreach ($data as $data1)
			{
				echo CHtml::link($data1->name, $data1->url,array('class'=>'vtip'));
			}
		}
		else
		{
			echo '<span style="color:#d30707"><i>No Saved Searches</i></span>';
		}
		?>
        </ul>
        </div></li>
    
    
      
    <li><?php echo CHtml::link('Clear All', array('manage'),array('class'=>'clear_all last')); ?></li>
    
    </ul>
    </div>
    <div class="bttns_imprtcntact">
    <ul>
    <li><a class=" import_contact last" href="">Import Contact</a></li>
    
      

    </ul>
    </div>
    
    <div class="bttns_addstudent ">
    <ul>
    <li><?php echo CHtml::link('Add Student', array('create'),array('class'=>'addbttn last')); ?></li>
    </ul>
    </div>
    </div>
  
    <div class="clear"></div>
    <div class="filtercontner">
    <div class="filterbxcntnt">
   	<div class="filterbxcntnt_inner" style="border-bottom:#ddd solid 1px;">
    <ul>
    <li style="font-size:16px">Filter Your Students:</li>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
	'method'=>'get',
	
)); ?>


<li><div onclick="hide('name')" style="cursor:pointer;">Name</div>
<div id="name" style="display:none;" class="drop" >
<div class="droparrow"></div>
<input type="search" placeholder="search" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
<input type="submit" value="Apply" />
</div>
</li>


<li><div onclick="hide('admissionnumber')" style="cursor:pointer;">Admission number</div>
<div id="admissionnumber" style="display:none;" class="drop">
<div class="droparrow"></div>
<input type="search" placeholder="search" name="admissionnumber" value="<?php echo isset($_GET['admissionnumber']) ? CHtml::encode($_GET['admissionnumber']) : '' ; ?>" />
<input type="submit" value="Apply" />
</div>
</li>

<li><div onclick="hide('batch')" style="cursor:pointer;">Batch</div>
<div id="batch" style="display:none; color:#FFF; width:330px" class="drop">
<div class="droparrow"></div>
<?php 

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('id','',$data,
array('prompt'=>'Select',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Students/batch'),
'update'=>'#batch_id',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Batch';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
echo CHtml::activeDropDownList($model,'batch_id',$data1,array('prompt'=>'Select','id'=>'batch_id')); ?>
<input type="submit" value="Apply" />
</div>
</li>

<li><div onclick="hide('gender')" style="cursor:pointer;">Gender</div>
<div id="gender" style="display:none; width:150px; min-height:30px" class="drop">
<div class="droparrow"></div>
<?php 

echo CHtml::activeDropDownList($model,'gender',array('M' => 'Male', 'F' => 'Female'),array('prompt'=>'All')); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li>

<li><div onclick="hide('bloodgroup')" style="cursor:pointer;">Blood Group</div>
<div id="bloodgroup" style="display:none;width:140px; min-height:30px" class="drop" >
<div class="droparrow"></div>
<?php echo CHtml::activeDropDownList($model,'blood_group',
		 							array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+' => 'AB+', 'AB-' => 'AB-'),
									array('prompt' => 'select')); ?>
                                    <input type="submit" value="Apply" />
</div>
</li>
                                    


<li><div onclick="hide('nationality')" style="cursor:pointer;">Country</div>
<div id="nationality" style="display:none; width:225px; left:-180px;" class="drop">
<div class="droparrow" style="left:200px;"></div>
<?php echo CHtml::activeDropDownList($model,'nationality_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array('prompt'=>'Select')); ?>
<input type="submit" value="Apply" />
</div>
</li>


<li><div onclick="hide('dob')" style="cursor:pointer;">Date Of Birth</div>
<div id="dob" style="display:none; width:280px; left:-210px;" class="drop">
<div class="droparrow" style=" left:240px"></div>
<?php echo CHtml::activeDropDownList($model,'dobrange',array('1' => 'less than', '2' => 'equal to', '3' => 'greater than'),array('prompt'=>'Option')); ?>
<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Students[date_of_birth]',
								'model'=>$model,
								'value'=>$model->date_of_birth,
								
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>'dd-mm-yy',
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));
		 ?>
         <input type="submit" value="Apply" />
</div>
</li>

<li><div onclick="hide('admission')" style="cursor:pointer;">Admission Date</div>
<div id="admission" style="display:none; width:280px; left:-190px" class="drop">
<div class="droparrow" style=" left:240px"></div>
<?php echo CHtml::activeDropDownList($model,'admissionrange',array('1' => 'less than', '2' => 'equal to', '3' => 'greater than'),array('prompt'=>'Option')); ?>
<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Students[admission_date]',
								'model'=>$model,
								'value'=>$model->admission_date,
								
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>'dd-mm-yy',
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));
		 ?>
         <input type="submit" value="Apply" />
</div>
</li>

<li><div onclick="hide('status')" style="cursor:pointer;">Status</div>
<div id="status" style="display:none; width:150px; min-height:30px; left:-120px" class="drop">
<div class="droparrow"  style="left:140px"></div>

<?php 
echo CHtml::activeDropDownList($model,'status',array('1' => 'Present', '0' => 'Former'),array('selected'=>'selected','prompt'=>'All')); 
 ?>
 <input type="submit" value="Apply" />
</div>
</li>






<?php $this->endWidget(); ?>
    
    </ul>
    </div>
    <div class="clear"></div>
    <div class="filterbxcntnt_inner_bot" >
    <div class="filterbxcntnt_left"><strong>Active Filters:</strong></div>
    <div class="clear"></div>
    <div class="filterbxcntnt_right">
    <ul>
    
    
    <?php if(isset($_REQUEST['name']) and $_REQUEST['name']!=NULL)
	{
		$j++; ?>
    <li>Name : <?php echo $_REQUEST['name']?><a href="<?php echo Yii::app()->request->getUrl().'&name='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['admissionnumber']) and $_REQUEST['admissionnumber']!=NULL)
    { 
	    $j++; ?>
    <li>Admission number : <?php echo $_REQUEST['admissionnumber']?><a href="<?php echo Yii::app()->request->getUrl().'&admissionnumber='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Students']['batch_id']) and $_REQUEST['Students']['batch_id']!=NULL)
    { 
	   $j++;
	?>
    <li>Batch : <?php echo Batches::model()->findByAttributes(array('id'=>$_REQUEST['Students']['batch_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Students[batch_id]='?>"></a></li>
    <?php } ?>
    
    <?php if(isset($_REQUEST['Students']['gender']) and $_REQUEST['Students']['gender']!=NULL)
	{ $j++;
	if($_REQUEST['Students']['gender']=='M')
	$gen='Male';
	else
	$gen='Female';
	?>
    <li>Gender : <?php echo $gen?><a href="<?php echo Yii::app()->request->getUrl().'&Students[gender]='?>"></a></li>
    <?php } ?>
    
    
    <?php if(isset($_REQUEST['Students']['blood_group']) and $_REQUEST['Students']['blood_group']!=NULL)
	{ 
	   $j++; ?>
    <li>Blood Group : <?php echo $_REQUEST['Students']['blood_group']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[blood_group]='?>"></a></li>
    <?php } ?>
    
    
    <?php  if(isset($_REQUEST['Students']['nationality_id']) and $_REQUEST['Students']['nationality_id']!=NULL)
	{
	    $j++; ?>
    <li>Country : <?php echo Countries::model()->findByAttributes(array('id'=>$_REQUEST['Students']['nationality_id']))->name?><a href="<?php echo Yii::app()->request->getUrl().'&Students[nationality_id]='?>"></a></li>
    <?php } ?>
    
    
    <?php  
	
	if(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']!=NULL)
	{
		if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
	    { $j++;
			      if($_REQUEST['Students']['dobrange']=='1')
				  {
					  $range = 'less than';
				  }
				  if($_REQUEST['Students']['dobrange']=='2')
				  {
					  $range = 'equal to';
				  }
				  if($_REQUEST['Students']['dobrange']=='3')
				  {
					  $range = 'greater than';
				  }?>
    <li>Date Of Birth : <?php echo $range.' : '.$_REQUEST['Students']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[date_of_birth]='?>"></a></li>
    <?php }} 
	
	elseif(isset($_REQUEST['Students']['dobrange']) and $_REQUEST['Students']['dobrange']==NULL)
	{ 
	  if(isset($_REQUEST['Students']['date_of_birth']) and $_REQUEST['Students']['date_of_birth']!=NULL)
	  { $j++;
		        $range = 'equal to';  
				  ?>
    <li>Date Of Birth : <?php echo $range.' : '.$_REQUEST['Students']['date_of_birth']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[date_of_birth]='?>"></a></li>
    <?php }} ?>
    
    
    
    
    <?php 
	if(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']!=NULL)
    {
		if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  { $j++;
				  if($_REQUEST['Students']['admissionrange']=='1')
				  {
					  $admissionrange = 'less than';
				  }
				  if($_REQUEST['Students']['admissionrange']=='2')
				  {
					  $admissionrange = 'equal to';
				  }
				  if($_REQUEST['Students']['admissionrange']=='3')
				  {
					  $admissionrange = 'greater than';
				  }
				  
				  ?>
     <li>Admission Date : <?php echo $admissionrange.' : '.$_REQUEST['Students']['admission_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[admission_date]='?>"></a></li>
    <?php }} 
	elseif(isset($_REQUEST['Students']['admissionrange']) and $_REQUEST['Students']['admissionrange']==NULL)
		{
			  if(isset($_REQUEST['Students']['admission_date']) and $_REQUEST['Students']['admission_date']!=NULL)
			  { $j++;
			  
				   $admissionrange = 'equal to'; ?>
     <li>Admission Date : <?php echo $admissionrange.' : '.$_REQUEST['Students']['admission_date']?><a href="<?php echo Yii::app()->request->getUrl().'&Students[admission_date]='?>"></a></li>
    <?php }}?> 
    
    
    <?php  if(isset($_REQUEST['Students']['status']) and $_REQUEST['Students']['status']!=NULL)
	{ $j++;
		  if($_REQUEST['Students']['status']=='1')
		  {
			  $status='Present';
		  }
		  else
		  {
		      $status='Former';
		  }
		  ?>
		  <li>Status : <?php echo $status?><a href="<?php echo Yii::app()->request->getUrl().'&Students[status]='?>"></a></li>
    <?php } ?> 
    <?php if($j==0)
	{
		echo '<div style="padding-top:5px;"><i>No Active Filters</i></div>';
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

<?php echo CHtml::link('All', Yii::app()->request->getUrl().'&val=',array('class'=>'vtip')); ?>                            
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
<?php echo CHtml::link('A', Yii::app()->request->getUrl().'&val=A',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('B', Yii::app()->request->getUrl().'&val=B',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('C', Yii::app()->request->getUrl().'&val=C',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('D', Yii::app()->request->getUrl().'&val=D',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('E', Yii::app()->request->getUrl().'&val=E',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('F', Yii::app()->request->getUrl().'&val=F',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('G', Yii::app()->request->getUrl().'&val=G',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('H', Yii::app()->request->getUrl().'&val=H',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('I', Yii::app()->request->getUrl().'&val=I',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('J', Yii::app()->request->getUrl().'&val=J',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('K', Yii::app()->request->getUrl().'&val=K',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('L', Yii::app()->request->getUrl().'&val=L',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('M', Yii::app()->request->getUrl().'&val=M',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('N', Yii::app()->request->getUrl().'&val=N',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('O', Yii::app()->request->getUrl().'&val=O',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('P', Yii::app()->request->getUrl().'&val=P',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('Q', Yii::app()->request->getUrl().'&val=Q',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('R', Yii::app()->request->getUrl().'&val=R',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('S', Yii::app()->request->getUrl().'&val=S',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('T', Yii::app()->request->getUrl().'&val=T',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('U', Yii::app()->request->getUrl().'&val=U',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('V', Yii::app()->request->getUrl().'&val=V',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('W', Yii::app()->request->getUrl().'&val=W',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('X', Yii::app()->request->getUrl().'&val=X',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('Y', Yii::app()->request->getUrl().'&val=Y',array('class'=>'vtip')); ?>                            
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
<?php  echo CHtml::link('Z', Yii::app()->request->getUrl().'&val=Z',array('class'=>'vtip')); ?>                            
</li>

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
    <td>Sl. No.</td>	
    <td>Student Name</td>
    <td>Admission No.</td>
    <td>Course/Batch</td>
    <td>Gender</td>
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
 <tr class=<?php echo $cls;?>>
    <td><?php echo $i; ?></td>
    <td><?php echo CHtml::link($list_1->first_name,array('view','id'=>$list_1->id)) ?></td>
    <td><?php echo $list_1->admission_no ?></td>
	<?php $batc = Batches::model()->findByAttributes(array('id'=>$list_1->batch_id)); 
	if($batc!=NULL)
	{
		$cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); ?>
		<td><?php echo $cours->course_name.' / '.$batc->name; ?></td> 
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
	echo '<div class="listhdg" align="center">Nothing Found!!</div>';	
	}?>
    
    
    </div>
    
    

<br />

  </div>
  </div> 

</div>
    </td>
  </tr>
</table>
