<div class="searchbx">
				 <form action="<?php echo $this->createUrl('/site/search'); ?>" name="search" method="post">
                	<ul>
                    	<li><input class="searchbar" name="char" type="text" /></li>
                        <li><!--<input src="images/search.png" name="" type="image" />-->
                        <input src="images/search.png" type="image" name="555" value="submit" />
                        </li>
                    </ul>
                  </form>  
                </div>
   
        
          <h1><?php echo Yii::t('students','Search Result');?></h1><br /><br />
          <div class="formCon" style="width:100%">
            	<div class="formConInner">
                	<h3<?php echo Yii::t('students','Studentsr');?>></h3>
                    <div class="tableinnerlist">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<th width="50%"><?php echo Yii::t('students','Name');?></th>
<th><?php echo Yii::t('students','Batch');?></th>
</tr>
<?php
if(count($list)!=0)
{
	foreach($list as $list_1)
	{ ?>
	<tr>
	<td width="50%"><?php echo CHtml::link($list_1->first_name.'  '.$list_1->middle_name.'  '.$list_1->last_name,array('view','id'=>$list_1->id)) ?></td>	
	<td><?php
	$batch=Batches::model()->findByAttributes(array('id'=>$list_1->batch_id));
	 echo $batch->name; ?></td>	
	<tr>
	<?php }
}
else
{
	echo '<tr>';
	echo '<td colspan="2">'.Yii::t('students','No Data found').'</td>';   
	echo '</tr>';
}
?>
</table>
</div>
<h3><?php echo Yii::t('students','Employees');?></h3>
<div class="tableinnerlist">
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<th width="50%"><?php echo Yii::t('students','Name');?></th>
<th><?php echo Yii::t('students','Department');?></th>
</tr>
<?php
if(count($posts)!=0)
{
	foreach($posts as $posts_1)
	{ ?>
	<tr>
	<td width="50%"><?php echo CHtml::link($posts_1->first_name.'  '.$posts_1->middle_name.'  '.$posts_1->last_name,array('employees/view','id'=>$posts_1->id)) ?></td>
    <td><?php
	$dept=EmployeeDepartments::model()->findByAttributes(array('id'=>$posts_1->employee_department_id));
	if($dept!=NULL)
	{
	 echo $dept->name;
	}
	else{ echo ' - ';}?>
     </td>		
	<tr>
	<?php }
}
else
{
	echo '<tr>';
	echo '<td colspan="2">'.Yii::t('students','No Data found').'</td>';   
	echo '</tr>';
}
?> 
</table></div></div></div>


        
      