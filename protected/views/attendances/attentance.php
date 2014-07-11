<script language="javascript">
function course()
{
var id = document.getElementById('bat').value;
window.location= 'index.php?r=attendances/attentance&bat='+id;	
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1>Attendances</h1>

<?php /*?><?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?><?php */?>
<?php
$data = CHtml::listData(Batches::model()->findAll("is_deleted=:x", array(':x'=>0)),'id','name');
	if(isset($_REQUEST['bat']))
	{
		$sel= $_REQUEST['bat'];
	}
	else
	{
		$sel='';
	}
echo CHtml::dropDownList('id','',$data,array('prompt'=>'Select','onchange'=>'course()','id'=>'bat','options'=>array($sel=>array('selected'=>true)))); 
 echo '<br>';
 if(isset($_REQUEST['bat']))
 {
	// $results=PeriodEntries::model()->findAllBySql('SELECT month_date WHERE batch_id='.$_REQUEST['bat']);
	 $dates = PeriodEntries::model()->findAll("MONTH(month_date)=:x AND batch_id=:y", array(':x'=>4,':y'=>$_REQUEST['bat']));

	   $num = count($dates); // 31

	   ?>
	   <div class="atnd_Con">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <th>Name</th>
    <?php
    foreach($dates as $dates_1)
    {
        echo '<th>'.date('D',strtotime($dates_1->month_date)).'<span>'.date('d',strtotime($dates_1->month_date)).'</span></th>';
		$i = date('d',strtotime($dates_1->month_date));
    }
    ?>
</tr>
<?php
 $student=Students::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['bat']));
$j=0;
foreach($student as $students)
{
	if($j%2==0)
	$class = 'class="odd"';	
	else
	$class = 'class="even"';	
	
 ?>
<tr <?php echo $class; ?> >
    <td class="name"><?php echo $students->first_name; ?></td>
    <?php
   foreach($dates as $dates_2)
    { 
        echo '<td><span  id="td'.$i.$students->id.'">';
		echo  $this->renderPartial('ajax',array('day'=>date('d',strtotime($dates_1->month_date)),'month'=>date('n',strtotime($dates_1->month_date)),'year'=>date('Y',strtotime($dates_1->month_date)),'emp_id'=>$students->id,'period'=>$dates_2->id));
		echo '</span><div  id="jobDialog123'.$i.$students->id.'"></div></td>';
    }
    ?>
</tr>
<?php $j++; }?>
</table>
<?php }?>
</div>
	   

 	</div>
    </td>
  </tr>
</table>