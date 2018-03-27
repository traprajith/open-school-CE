<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','Electives'),
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
<h1><?php echo Yii::t('app','Student Profile');?></h1>
    <div class="clear"></div>
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <?php $this->renderPartial('application.modules.students.views.students.tab');?>
    <div class="clear"></div>
    <div class="emp_cntntbx" >
    <?php
	$electives = StudentElectives::model()->findAll("student_id=:x", array(':x'=>$_REQUEST['id']));
	?>
    <div class="tableinnerlist">
    <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
    <th><?php echo Yii::t('app','Course');?></th>
    <th><?php echo Yii::t('app','Batch');?></th>
    <th><?php echo Yii::t('app','Subject');?></th>
    <th><?php echo Yii::t('app','Actions');?></th>
    
    </tr>

    <?php
	if($electives!=NULL){
		foreach($electives as $elective)
		{
			echo '<tr>';
				$batch	=Batches::model()->findByAttributes(array('id'=>$elective->batch_id));
				$courses	=Courses::model()->findByAttributes(array('id'=>$batch->course_id));
				echo '<td>'.$courses->course_name.'</td>';
				echo '<td>'.$batch->name.'</td>';
								$group=Electives::model()->findByAttributes(array('id'=>$elective->elective_id));
				echo '<td>'.$group->name.'</td>';
				echo '<td>'.CHtml::link(Yii::t('app','Remove'), "#", array("submit"=>array('removeelective','elective'=>$elective->id,'id'=>$_REQUEST['id']),'confirm' => Yii::t('app', 'Are you sure you want to remove elective?'), 'csrf'=>true)).'</td>';
			
			echo '</tr>';
		}
	}
	else{
		echo '<tr>';
			echo '<td colspan="4">'.Yii::t('app','No Electives assigned!').'</td>';
		echo '<tr>';
		
	}
	?>    </table>
    </div>
    </div>
    </div>
    
    </div>
    </div>
   
    </td>
  </tr>
</table>