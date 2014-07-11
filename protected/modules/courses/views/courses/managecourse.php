<style>
#jobDialog123
{
	height:auto;
}
</style>

<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<?php 
  $posts=Courses::model()->findAll("is_deleted 	=:x", array(':x'=>0));
 ?>
 
<?php if($posts!=NULL)
{?>
<script>
function details(id)
{
	
	var rr= document.getElementById("dropwin"+id).style.display;
	
	 if(document.getElementById("dropwin"+id).style.display=="block")
	 {
		 document.getElementById("dropwin"+id).style.display="none"; 
		 $("#openbutton"+id).removeClass('open');
		  $("#openbutton"+id).addClass('view');
	 }
	 else if(  document.getElementById("dropwin"+id).style.display=="none")
	 {
		 document.getElementById("dropwin"+id).style.display="block"; 
		   $("#openbutton"+id).removeClass('view');
		  $("#openbutton"+id).addClass('open');
	 }
}
function rowdelete(id)
{
	 $("#batchrow"+id).fadeOut("slow");
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
     <?php $this->renderPartial('left_side');?>
     
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo Yii::t('Courses','Manage Courses & Batches');?></h1>
 <div id="jobDialog">
 <div id="jobDialog1">
 <?php 
  $posts=Courses::model()->findAll("is_deleted 	=:x", array(':x'=>0));
   ?>
 <?php $this->renderPartial('_flash');?>

 </div>
  </div>
    <div class="mcb_Con">
<!--<div class="mcbrow hd_bg">
	<ul>
    	<li class="col1">Course Name</li>
        <li class="col2">Edit</li>
        <li class="col3">Delete</li>
        <li class="col4">Add Batch</li>
        <li class="col5">View Batch</li>
    </ul>
 <div class="clear"></div>
</div>-->


<?php foreach($posts as $posts_1)
{ ?>
<div class="mcbrow" id="jobDialog1">
	<ul>
    	<li class="gtcol1" onclick="details('<?php echo $posts_1->id;?>');" style="cursor:pointer;">
       
		<?php echo $posts_1->course_name; ?>
		<?php
			$course=Courses::model()->findByAttributes(array('id'=>$posts_1->id,'is_deleted'=>0));
		   $batch=Batches::model()->findAll("course_id=:x AND is_deleted=:y AND is_active=:z", array(':x'=>$posts_1->id,':y'=>0,':z'=>1));
		 ?>
        <span><?php echo count($batch); ?> - Batch(es)</span>
        </li>
        <li class="col2">
        <?php echo CHtml::ajaxLink(Yii::t('Courses','Edit'),$this->createUrl('courses/Edit'),array(
        'onclick'=>'$("#jobDialog11").dialog("open"); return false;',
        'update'=>'#jobDialog1','type' =>'GET','data' => array( 'val1' =>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialog123'.$posts_1->id, 'class'=>'edit')); ?>
        </li>
        <li class="col3"><?php echo CHtml::link(Yii::t('Courses','Delete'),array('deactivate','id'=>$posts_1->id),array('confirm'=>"Are you sure?\n\n Note: All details (batches, students, timetable, fees, exam) related to this course will be deleted.",'class'=>'delete'));?></li>
        <li class="col4">
         <?php echo CHtml::ajaxLink(Yii::t('Courses','Add Batch'),$this->createUrl('batches/Addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog','type' =>'GET','data' => array( 'val1' =>$posts_1->id ),'dataType' => 'text',),array('id'=>'showJobDialog1'.$posts_1->id,'class'=>'add')); ?>
        </li>
        <a href="#" id="openbutton<?php echo $posts_1->id;?>" onclick="details('<?php echo $posts_1->id;?>');" class="view"><li class="col5"><span class="dwnbg">&nbsp;</span></li></a>
    </ul>
    
 <div class="clear"></div>
</div>
<!-- Batch Details -->
  
         <!--class="cbtablebx"-->
         
<div class="pdtab_Con" id="dropwin<?php echo $posts_1->id; ?>" style="display: none; padding:0px 0px 10px 0px; ">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tbody>
          <!--class="cbtablebx_topbg"  class="sub_act"-->
		  <tr class="pdtab-h">
			<td align="center"><?php echo Yii::t('Courses','Batch Name');?></td>
            <td align="center"><?php echo Yii::t('Courses','Class Teacher');?></td>
			<td align="center"><?php echo Yii::t('Courses','Start Date');?></td>
			<td align="center"><?php echo Yii::t('Courses','End Date');?></td>
			<td align="center"><?php echo Yii::t('Courses','Actions');?></td>
		  </tr>
          <?php 
		  foreach($batch as $batch_1)
				{
					echo '<tr id="batchrow'.$batch_1->id.'">';
					echo '<td style="text-align:left; padding-left:10px; font-weight:bold;">'.CHtml::link($batch_1->name, array('batches/batchstudents','id'=>$batch_1->id)).'</td>';
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings!=NULL)
					{	
						$date1=date($settings->displaydate,strtotime($batch_1->start_date));
						$date2=date($settings->displaydate,strtotime($batch_1->end_date));

					}
					$teacher = Employees::model()->findByAttributes(array('id'=>$batch_1->employee_id));					
					echo '<td align="center">';
					if($teacher){
						echo $teacher->first_name.' '.$teacher->last_name;
					}
					else
					{
						echo '-';
					}
					echo '</td>';					
					echo '<td align="center">'.$date1.'</td>';
					echo '<td align="center">'.$date2.'</td>';
					echo '<td align="center"  class="sub_act">'; ?> 
					<?php echo CHtml::ajaxLink(Yii::t('Courses','Edit'),$this->createUrl('batches/addupdate'),array(
        'onclick'=>'$("#jobDialog123").dialog("open"); return false;',
        'update'=>'#jobDialog123','type' =>'GET','data' => array( 'val1' =>$batch_1->id,'course_id'=>$posts_1->id ),'dataType' => 'text'),array('id'=>'showJobDialog12'.$batch_1->id,'class'=>'add')); 
		 echo ''.CHtml::ajaxLink(
  "Delete", $this->createUrl('batches/remove'), array('success'=>'rowdelete('.$batch_1->id.')','type' =>'GET','data' => array( 'val1' =>$batch_1->id ),'dataType' => 'text'),array('confirm'=>"Are you sure?\n\n Note: All details (students, timetable, fees, exam) related to this batch will be deleted."));
 ?> <?php echo '  '.CHtml::link(Yii::t('Courses','Add Student'), array('/students/students/create','bid'=>$batch_1->id)).'</td>';
					echo '</tr>';
					echo '<div id="jobDialog123"></div>';
				}
			   ?>
         </tbody>
        </table>
		</div>
        <div id='check'></div>
<?php } ?>        

</div>

</div>
    </td>
  </tr>
</table>

<?php }
else
{ ?>
<link rel="stylesheet" type="text/css" href="/openschool/css/style.css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <div style="padding:20px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    	It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    	<h1><?php echo CHtml::link(Yii::t('Courses','Add New Course &amp; Batch'),array('courses/create')) ?></h1>
                    </div>
                    
                </div>

                </div>
    
    
    </td>
  </tr>
</table>

<?php } ?>
