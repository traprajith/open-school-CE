

<?php
$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Attendance',
);


?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <div class="emp_cont_left">
   <?php $this->renderPartial('profileleft');?>
    
    </div>
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    <h1 style="margin-top:.67em;"><?php echo Yii::t('students','Student Profile : ');?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
        
    <div class="edit_bttns last">
    <ul>
    <li>
    <?php echo CHtml::link(Yii::t('students','<span>Edit</span>'), array('update', 'id'=>$model->id),array('class'=>' edit ')); ?>
    </li>
     <li>
    <?php echo CHtml::link(Yii::t('students','<span>Students</span>'), array('students/manage'),array('class'=>'edit last'));?>
    </li>
    </ul>
    </div>
    
    
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
     <?php $this->renderPartial('tab');?>
    <div class="clear"></div>
    <div class="emp_cntntbx" >
    
    
        <?php

function getweek($date,$month,$year)
{
$date = mktime(0, 0, 0,$month,$date,$year); 
$week = date('w', $date); 
switch($week) {
case 0: 
return 'S';
break;
case 1: 
return 'M';
break;
case 2: 
return 'Tu';
break;
case 3: 
return 'W';
break;
case 4: 
return 'Th';
break;
case 5: 
return 'F';
break;
case 6: 
return 'S';
break;
}
}
?>
<div style="position:relative">

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
		$mon_num = $_REQUEST['mon'];
		$curr_year = $_REQUEST['year'];
		
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, $curr_year); // 31
	?>

	<div align="center" class="atnd_tnav" style="top:30px;">
	<?php 
	echo CHtml::link('<div class="atnd_arow_l"><img src="images/atnd_arrow-l.png" width="7" border="0"  height="13" /></div>', array('attentance', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 -1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 -1 months")),'id'=>$_REQUEST['id'])); 
	 echo $mon.'&nbsp;&nbsp;&nbsp; '.$curr_year; echo CHtml::link('<div class="atnd_arow_r"><img src="images/atnd_arrow.png" width="7" border="0"  height="13" /></div>', array('attentance', 'mon'=>date("m",strtotime($curr_year."-".$mon_num."-01 +1 months")),'year'=>date("Y",strtotime($curr_year."-".$mon_num."-01 +1 months")),'id'=>$_REQUEST['id']));?></div>
<br /><br /><br />
<div class="atnd_Con"  style="overflow-x:scroll;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<th>'.getweek($i,$mon_num,$curr_year).'<span>'.$i.'</span></th>';
    }
    ?>
</tr>
<?php $posts=Students::model()->findAll("id=:x", array(':x'=>$_REQUEST['id']));
$j=0;
foreach($posts as $posts_1)
{
	if($j%2==0)
	$class = 'class="odd"';	
	else
	$class = 'class="even"';	
	
 ?>
<tr <?php echo $class; ?> >
    
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
<?php } ?>
</div>
<div class="ea_pdf" style="top:2px; ">
<?php /*?> <?php echo CHtml::link('<img src="images/pdf-but.png" border="0">', array('/courses/StudentAttentance/pdf1','id'=>$_REQUEST['id']),array('target'=>'_blank')); ?><?php */?>
 
 <?php
 
 if($_REQUEST['mon']&&$_REQUEST['year']){
  echo CHtml::link('<img src="images/pdf-but.png" border="0">', array('/students/StudentAttentance/pdf1','mon'=>$_REQUEST['mon'],'year'=>$_REQUEST['year'],'id'=>$_REQUEST['id']),array('target'=>'_blank')); 
	}
	else{
		 echo CHtml::link('<img src="images/pdf-but.png" border="0">', array('/students/StudentAttentance/pdf1','mon'=>date("m"),'year'=>date("Y"),'id'=>$_REQUEST['id']),array('target'=>'_blank')); 
		
	}
 
 ?>
 
 
 </div>
 
</div>
    </div>
    </div>
    
    </div>
    </div>
   
    </td>
  </tr>
</table>