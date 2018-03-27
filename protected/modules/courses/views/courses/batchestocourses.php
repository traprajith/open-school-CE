 <?php
 	$course=Courses::model()->findByAttributes(array('id'=>$val,'is_deleted'=>0));
   $batch=Batches::model()->findAll("course_id=:x AND is_deleted=:y", array(':x'=>$val,':y'=>0));
 ?>
 <div class="cbtablebx" id="dropwin">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
  <tr class="cbtablebx_topbg">
    <td><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','Name');?>
    </td>
    <td><?php echo Yii::t('app','Start Date');?></td>
    <td><?php echo Yii::t('app','End Date');?></td>
    <td style="border-right:none;">Actions</td>
  </tr>
  <tr class="even">
    <td><?php echo $course->course_name; ?> (21 Students)
    </td>
    <td>12/10/2010</td>
    <td>10/10/2010</td>
    <td style="border-right:none;"><a href="#">EDIT</a> | <a href="#">DELETE</a> | <a href="#">ADD STUDENT</a></td>
    
  </tr>
  <?php 
  $i=1;
  foreach($batch as $batch_1)
  		{
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										if($settings!=NULL)
										{	
											$date1=date($settings->displaydate,strtotime($batch_1->start_date));
											$date2=date($settings->displaydate,strtotime($batch_1->end_date));
		
										}
			if($i%2==0)
			$class = 'even';
			else
			$class = 'odd';
			$i++;
			
			echo '<tr class="'.$class.'">';
			echo '<td>'.$batch_1->name.'</td>';
			echo '<td>'.$date1.'</td>';
			echo '<td>'.$date2.'</td>';
			echo '<td style="border-right:none;">Task</td>';
			echo '</tr>';
		}
       ?>
</tbody></table>
</div>