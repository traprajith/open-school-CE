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
          

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td width="247" valign="top">
     <?php $this->renderPartial('/batches/left_side');?>
    </td>
    <td valign="top">
	<?php if($batch!=NULL)
		   {
			   ?>
    <div class="emp_right" style="padding-bottom:250px;">
    <!--<div class="searchbx_area">
    <div class="searchbx_cntnt">
    	<ul>
        <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
        <li><input class="textfieldcntnt"  name="" type="text" /></li>
        </ul>
    </div>
    
    </div>-->
    
    <h1>Student Attendances</h1>
        
    <div class="edit_bttns">
    <ul>
    <li>
    <a href="#" class=" edit last">Edit</a>    </li>
    </ul>
    </div>
    
    
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
return 'Sun';
break;
case 1: 
return 'Mon';
break;
case 2: 
return 'Tue';
break;
case 3: 
return 'Wed';
break;
case 4: 
return 'Thur';
break;
case 5: 
return 'Fri';
break;
case 6: 
return 'Sat';
break;
}
}
?>
<?php
$model = new EmployeeAttendances;
  if(isset($_REQUEST['id']))
  {

	if(!isset($_REQUEST['mon']))
	{
		$mon = date('F');
		$mon_num = date('n');
	}
	else
	{
		$mon = $model->getMonthname($_REQUEST['mon']);
		$mon_num = $_REQUEST['mon'];
	}
	$num = cal_days_in_month(CAL_GREGORIAN, $mon_num, 2012); // 31
	?>
	<div align="center" class="atnd_tnav">
	<?php 
	echo CHtml::link('<div class="atnd_arow_l"><img src="images/atnd_arrow-l.png" width="7"  height="13" /></div>', array('index', 'mon'=>date("m",strtotime("2011-".$mon_num."-01 -1 months")),'id'=>$_REQUEST['id'])); 
	 echo $mon; echo CHtml::link('<div class="atnd_arow_r"><img src="images/atnd_arrow.png" width="7"  height="13" /></div>', array('index', 'mon'=>date("m",strtotime("2011-".$mon_num."-01 +1 months")),'id'=>$_REQUEST['id']));?></div>
<br /><br />
<div class="atnd_Con">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <th>Name</th>
    <?php
    for($i=1;$i<=$num;$i++)
    {
        echo '<th>'.rtrim(getweek($i,'3','2012'),'r.n.e.t').'<span>'.$i.'</span></th>';
    }
    ?>
</tr>
<?php $posts=Students::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
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
		echo  $this->renderPartial('ajax',array('day'=>$i,'month'=>$mon_num,'year'=>'2012','emp_id'=>$posts_1->id));
		/*echo CHtml::ajaxLink(Yii::t('job','ll'),$this->createUrl('EmployeeAttendances/addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog','type' =>'GET','data'=>array('day' =>$i,'month'=>$mon_num,'year'=>'2012','emp_id'=>$posts_1->id),
        ),array('id'=>'showJobDialog'));
		echo '<div id="jobDialog"></div>';*/
		
		echo '</span><div  id="jobDialog123'.$i.$posts_1->id.'"></div></td>';
    }
    ?>
</tr>
<?php $j++; }?>
</table>
<?php } }?>
</div>
 	</div></div></div></div>
    </td>
  </tr>
</table>