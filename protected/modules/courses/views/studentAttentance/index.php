
<script language="javascript">
function course()
{
var id = document.getElementById('bat').value;
window.location= 'index.php?r=studentAttentance/index&id='+id;	
}
</script>
<?php
$this->breadcrumbs=array(
	'Attendances',
);

/*$this->menu=array(
	array('label'=>'Create Attendances', 'url'=>array('create')),
	array('label'=>'Manage Attendances', 'url'=>array('admin')),
);*/
?>
<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
  <div style="background:#fff; min-height:800px;">        

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    
    <td valign="top">
	<?php if($batch!=NULL)
		   {
			   ?>
    <div style="padding:20px;">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    
        
    <!--<div class="edit_bttns">
    <ul>
    <li>
    <a href="#" class=" edit last">Edit</a>    </li>
    </ul>
    </div>-->
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('/batches/tab');?>
    
    <div class="clear"></div>
    
    

<div class="formConInner">
    


    
    <?php

function getweek($date,$month,$year)
{
$date = mktime(0, 0, 0,$month,$date,$year); 
$week = date('w', $date); 
switch($week) {
case 0: 
return 'Su';
break;
case 1: 
return 'Mo';
break;
case 2: 
return 'Tu';
break;
case 3: 
return 'We';
break;
case 4: 
return 'Th';
break;
case 5: 
return 'Fr';
break;
case 6: 
return 'Sa';
break;
}
}
?>
<div class="ea_droplist" style="top:30px">
<?php
$subjects=Subjects::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));

//echo CHtml::dropDownList('batch_id','',CHtml::listData(Subjects::model()->findAll("batch_id=:x",array(':x'=>$_REQUEST['id'])), 'id', 'name'), array('empty'=>'Select Type'));

$model = new EmployeeAttendances;
  if(isset($_REQUEST['id']))
  {

	if(!isset($_REQUEST['mon']))
	{
		$mon = date('F');
		$mon_num = date('n');
		$curr_year = date('Y');
	}
	else
	{
		$mon = $model->getMonthname($_REQUEST['mon']);
		//$mon = EmployeeAttendances::model()->getMonthname($_REQUEST['mon']);
		$mon_num = $_REQUEST['mon'];
		$curr_year = $_REQUEST['year'];
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, $curr_year); // 31
	?>
    
    <?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>

<?php if(Yii::app()->user->hasFlash('notification')):?>
    <span class="flash-success" style="color:#F00; padding-left:15px; font-size:12px">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </span>
<?php endif; ?>
    
    
 </div>
 <?php
 /*if($mon_num=='1')
 {
 	$mon_num=2;
 }
if($mon_num=='12')
{
	$mon_num=11;
}*/
 ?>
 
 
 
 
 
 
	<div align="center" class="atnd_tnav" style="top:30px">
	<?php 
	echo CHtml::link('<div class="atnd_arow_l"><img src="images/atnd_arrow-l.png" width="7" border="0"  height="13" /></div>', array('index', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 -1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 -1 months")),'id'=>$_REQUEST['id'])); 
	 echo $mon.'&nbsp;&nbsp;&nbsp; '.$curr_year; 
	 
	 echo CHtml::link('<div class="atnd_arow_r"><img src="images/atnd_arrow.png" width="7" border="0"  height="13" /></div>', array('index', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 +1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 +1 months")),'id'=>$_REQUEST['id']));?></div>
<br /><br />
<div class="atnd_Con" style="margin:25px 0px 0px -16px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <th><?php echo Yii::t('attendance','Name');?></th>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<th>'.getweek($i,$mon_num,$curr_year).'<span>'.$i.'</span></th>';
    }
    ?>
</tr>
<?php $posts=Students::model()->findAll("batch_id=:x AND is_deleted=:y", array(':x'=>$_REQUEST['id'],':y'=>0));
$j=0;
foreach($posts as $posts_1)
{
	if($j%2==0)
	$class = 'class="odd"';	
	else
	$class = 'class="even"';	
	
 ?>
<tr <?php echo $class; ?> >
    <td class="name"><?php echo $posts_1->first_name; ?></td>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<td><span  id="td'.$i.$posts_1->id.'">';
		echo  $this->renderPartial('ajax',array('day'=>$i,'month'=>$mon_num,'year'=>$curr_year,'emp_id'=>$posts_1->id));
		/*echo CHtml::ajaxLink(Yii::t('job','ll'),$this->createUrl('EmployeeAttendances/addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog','type' =>'GET','data'=>array('day' =>$i,'month'=>$mon_num,'year'=>'2012','emp_id'=>$posts_1->id),
        ),array('id'=>'showJobDialog'));
		echo '<div id="jobDialog"></div>';*/
		
		echo '</span><div  id="jobDialog123'.$i.$posts_1->id.'"></div></td>';
		echo '</span><div  id="jobDialogupdate'.$i.$posts_1->id.'"></div></td>';
    }
    ?>
</tr>
<?php $j++; }?>
</table>
<?php } }?>
</div>
<div class="ea_pdf" style="top:22px;">

<?php // Button to send SMS 
	$sms_settings=SmsSettings::model()->findAll();
	if($sms_settings[0]->is_enabled=='1' and $sms_settings[3]->is_enabled=='1'){ // Checking if SMS is enabled
	
		if($posts!=NULL){ // Check if students is present in the batch. Show SMS button only if there are students in the batch. 
?>
            <div class="edit_bttns" style="top:0px; right:180px; width:100px;" class="formbut"> 
                    <?php  echo CHtml::button('Send SMS', array('submit' => array('/attendance','batch_id'=>$_REQUEST['id'],'flag'=>'1'),'class'=>'formbut')); 
                 
				   /*echo CHtml::link('Send SMS', array('/attendance/studentAttentance/sendSms','batch_id'=>$_REQUEST['id'],'flag'=>'1'),array('class'=>'formlink'));*/
				   
				   ?>
            </div>
<?php
		}
	}
?>


<?php

	if($_REQUEST['mon']&&$_REQUEST['year']){
  echo CHtml::link('<img src="images/pdf-but.png" border="0">', array('/attendance','mon'=>$_REQUEST['mon'],'year'=>$_REQUEST['year'],'id'=>$_REQUEST['id'])); 
	}
	else{
		 echo CHtml::link('<img src="images/pdf-but.png" border="0">', array('/attendance','mon'=>date("m"),'year'=>date("Y"),'id'=>$_REQUEST['id'])); 
		
	}
?>
  
</div>
 
 	</div></div></div></div>
    </td>
  </tr>
</table>
</div>