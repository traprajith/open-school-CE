<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
<?php $this->renderPartial('//assesments/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    <div align="right" style="width:60%"><?php echo CHtml::link(Yii::t('Examgroups','New'), array('create', 'id'=>$_REQUEST['id']),array('class'=>'cbut')); ?></div>
    <br />
    <div class="tableinnerlist">
    <table width="60%" cellpadding="0" cellspacing="0" >
    <tr>
     <th><?php echo Yii::t('Examgroups','Exam Name');?></th>
     <th><?php echo Yii::t('Examgroups','Action');?></th>
    </tr> 
<?php $posts=ExamGroups::model()->findAll("batch_id=:x", array(':x'=>$_REQUEST['id']));
	  foreach($posts as $posts_1)
	  {
		  echo '<tr>';
		  echo '<td>'.$posts_1->name.'</td>';
		  echo '<td>'.CHtml::link(Yii::t('Examgroups','Delete'), array('ExamGroups/deletenew', 'id'=>$posts_1->id,'ret'=>$_REQUEST['id'])).'</td>';
		  echo '</tr>';
	  }
 ?>
 </table>
</div>

</div>
    </td>
  </tr>
</table>