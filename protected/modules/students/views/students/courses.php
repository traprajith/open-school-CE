<style type="text/css">
.nothing-found{
	font-style:italic;
	text-align:center;
}
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Students')=>array('index'),
	Yii::t('app','Courses'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td width="247" valign="top"><?php $this->renderPartial('profileleft');?></td>
        <td valign="top">
        	<div class="cont_right formWrapper">
                    <h1><?php echo Yii::t('app','Student Profile');?></h1>
<?php /*?>    <?php 					
                        echo Yii::t('app','Student Profile :').' ';
                        if(FormFields::model()->isVisible("fullname", "Students", 'forStudentProfile')){
                            echo $model->studentFullName('forStudentProfile');
                        } 
    ?>					<?php */?>

                    
                <div class="clear"></div>
                <div class="emp_right_contner">
<?php
					// Display Success Flash Messages                 						
					Yii::app()->clientScript->registerScript(
					   'myHideEffect',
					   '$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
					   CClientScript::POS_READY
					);
					
					if(Yii::app()->user->hasFlash('successMessage')): 
?>					
                        <div class="flashMessage" style="background:#FFF; color:#C00; padding-left:200px; top:150px;">
                        	<?php echo Yii::app()->user->getFlash('successMessage'); ?>
                        </div>
<?php					
					endif;					
?>		<?php $semester_enabled	= Configurations::model()->isSemesterEnabled(); ?>

					<div class="emp_tabwrapper">
                    	<?php $this->renderPartial('application.modules.students.views.students.tab');?>
                        <div class="clear"></div>
                        <div class="emp_cntntbx">
                            <div class="tableinnerlist">
                            	<table width="100%" cellpadding="0" cellspacing="0">
                                	<tr>
                                        <th><?php echo Yii::t('app','Sl No');?></th>
                                        <th><?php echo Yii::t('app','Academic Year');?></th>
                                        <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){ ?>
                                        	<th> <?php echo Yii::app()->getModule("students")->labelCourseBatch();?></th>
                                        <?php } ?>
										 <?php if($semester_enabled==1){ ?>
										 	<th><?php echo Yii::t('app','Semester');?></th>
										 <?php } ?>
                                        <th><?php echo Yii::t('app','Status');?></th>
                                        <th><?php echo Yii::t('app','Action');?></th>
                                    </tr>
<?php
									$criteria 				= new CDbCriteria;
									$criteria->join 		= 'LEFT JOIN batches t1 ON t1.id = t.batch_id'; 
									$criteria->condition 	= 't.student_id=:student_id AND t1.is_active=:is_active AND t1.is_deleted=:is_deleted';
									$criteria->params		= array(':student_id'=>$model->id, ':is_active'=>1, ':is_deleted'=>0);
									$criteria->order		= 't.id DESC';
									$batches = BatchStudents::model()->findAll($criteria);
									if($batches){
										$i = 1;
										foreach($batches as $batch){
											$academic_year 	= AcademicYears::model()->findByAttributes(array('id'=>$batch->academic_yr_id));
											$batch_name 	= Batches::model()->findByAttributes(array('id'=>$batch->batch_id));
											$sem_enabled	= Configurations::model()->isSemesterEnabledForCourse($batch_name->course_id);
											
?>
											<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $academic_year->name; ?></td>
                                                <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                                                    <td><?php		                                                        
                                                        if($batch_name->name != ""){
                                                        	echo $batch_name->course123->course_name.' / '.$batch_name->name;
                                                        }
                                                        else{
                                                        	echo "-"; 
														}
?>                                                   
                                                    </td>
                                            	<?php } ?>
													<?php
													 if($semester_enabled==1){ ?>
														 <td><?php
														    if($sem_enabled==1 and $batch_name->semester_id!=NULL){
																	 $semester 	= Semester::model()->findByAttributes(array('id'=>$batch_name->semester_id));
																	   echo $semester->name;
															} 
															else{
																echo '-';
															}
															?>
															</td>
													<?php }?>
													 
                                                <td>
<?php                                            	
													if($batch_date->start_date > date("Y-m-d h:i:sa")){
														
														echo Yii::t('app','Starts on :').' <span style="color:#0000FF">'.date("d-M-Y",strtotime($batch_date->start_date));?></span><?php
													}
													else{
														$status = PromoteOptions::model()->findByAttributes(array('option_value'=>$batch->result_status));
														if($batch->result_status == 1)
															$status_print = '<span style="color:#006633">'.Yii::t('app',$status->option_name).'</span>';
														if($batch->result_status == -1)
															$status_print = '<span style="color:#FF0000">'.Yii::t('app',$status->option_name).'</span>';
														if($batch->result_status == 0)
															$status_print = '<span style="color:#006633">'.Yii::t('app',$status->option_name).'</span>';	
														if($batch->result_status == 2)
															$status_print = '<span style="color:#0000FF">'.Yii::t('app',$status->option_name).'</span>';
														if($batch->result_status == 3)
															$status_print = '<span style="color:#0000FF">'.Yii::t('app','Previous').'</span>';		
														echo $status_print;
													}
?>												
                                            	</td>
                                                <td>
<?php                                                                                            													
													echo CHtml::ajaxLink(Yii::t('app','Manage'), Yii::app()->createUrl('students/students/liststatus' ), array('type' =>'GET', 'data' =>array( 'id' => $batch->id),'dataType' => 'text',  'update' =>'#course_status'.$batch->id, 'onclick'=>'$("#course_status_dialog'.$batch->id.'").dialog("open"); return false;',),array('class'=>'course_status'))." | ";													
													echo CHtml::link(Yii::t('app',"Delete"),array('students/batchdelete','id'=>$batch->id,'sid'=>$_REQUEST['id']),array('confirm'=>Yii::t('app','Are You Sure?')));													
?>                                             
                                             	</td>
                                            </tr>
                                            <div  id="course_status<?php echo $batch->id; ?>"></div>
<?php											
											$i++;
										}										
									}
									else{
?>
										<tr>
                                        	<td colspan="6" class="nothing-found"><?php echo Yii::t('app','Nothing Found!'); ?></td>
                                        </tr>
<?php										
									}
?>                                    
                                </table>
                            </div>
                        </div>    
                    </div>			
                </div>
            </div>          
        </td>
    </tr>
</table>
<script type="text/javascript">
$(".course_status").click(function(e) {
    $('form#course_status_form').remove();
});
</script>
