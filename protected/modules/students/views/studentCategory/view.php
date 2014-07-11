<?php
$this->breadcrumbs=array(
	'Student Categories'=>array('index'),
	$model->name,
);
?>
<div style="overflow:hidden;">
<h1>Students In <?php echo $model->name; ?></h1>
<?php $students = Students::model()->findAll("student_category_id=:x AND is_active=:y AND is_deleted=:z", array(':x'=>$model->id,':y'=>1,':z'=>0)); ?>
<div class="tableinnerlist" style="width:350px; padding-right:10px;">
<?php if($students!=NULL)
{
	?>

<table width="90%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td><?php echo Yii::t('students','Name');?></td>
    </tr>
    <?php foreach($students as $students1)
	{
		?>
   <tr>
    <td><?php echo CHtml::link($students1->first_name.'  '.$students1->middle_name.'  '.$students1->last_name,array('students/view','id'=>$students1->id)) ?></td>
  </tr>
  <?php 
}

	?>

</table>

<?php 
}
else
{
	echo '<div class="notifications nt_red">'.Yii::t('students','<i>No Students In This Category</i>').'</div>'; 
	
}
	?></div>
    </div>