<?php
$this->breadcrumbs=array(
	'Exam Groups'=>array('/courses'),
	'Manage',
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
<?php $this->renderPartial('//assesments/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">

<h1>Create ExamGroups</h1>
<script language="javascript">
function course()
{
	var id= document.getElementById('coursedrop').value;
	window.location ='index.php?r=examGroups/index&id='+id;
}
</script>
<?php

echo Yii::t('examgroups','<strong>Select Course</strong>');
if(isset($_REQUEST['id']))
{
	$sel = $_REQUEST['id'];
}
else
$sel = '';

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo CHtml::dropDownList('cid','',$data,array('onchange'=>'course()','id'=>'coursedrop','empty'=>'Select Course','options'=>array($sel=>array('selected'=>true)))); 
echo '<br>';
 
if(isset($_REQUEST['id']))
{
$posts=Batches::model()->findAll("course_id=:x", array(':x'=>$_REQUEST['id']));	
	foreach($posts as $posts_1)
	{
		echo CHtml::link($posts_1->name, array('manage', 'id'=>$posts_1->id)).'<br>'; 
		//echo $posts_1->name.'<br>';
	}
}

?>
</div>
    </td>
  </tr>
</table>