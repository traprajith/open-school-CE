<style type="text/css">
.table_listbx td{
	border-right: 1px solid #eaeef1 !important;	
}
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers')=>array('index'),
	Yii::t('app','Subject Association'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top"><?php $this->renderPartial('profileleft');?></td>
        <td valign="top">
        	<div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Teacher Profile');?></h1> 
                <div class="button-bg">
                <div class="top-hed-btn-left"></div>
                <div class="top-hed-btn-right">
                <ul>                                    
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$_REQUEST['id']),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Teachers').'</span>', array('employees/manage'),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>                                  
                </ul>
                </div>
                </div>

                
                <div class="emp_right_contner">
                    <div class="emp_tabwrapper">
                    		<?php $this->renderPartial('tab');?>
                       
                        <div class="clear"></div>
<?php
						$employee_subs 	= EmployeesSubjects::model()->findAllByAttributes(array('employee_id'=>$_REQUEST['id']));
						$employee_elecs = EmployeeElectiveSubjects::model()->findAllByAttributes(array('employee_id'=>$_REQUEST['id']));
?>                        
                        
                <div class="button-bg">
                <div class="top-hed-btn-left">
                <div class="sub-header">
                                    <h3><?php echo Yii::t('app','Subject Association');?></h3>
                                </div>
                </div>
                <div class="top-hed-btn-right">
                <ul>                                    
                <li><?php 
										if($employee_subs != NULL or $employee_elecs != NULL){
											echo CHtml::link(Yii::t('app','Generate PDF'), array('Employees/subjectassopdf','id'=>$_REQUEST['id']),array('target'=>'_blank','class'=>'pdf_but')); 
										}
									?></li>                                  
                </ul>
                </div>
                </div>
                        <div class="emp_cntntbx">
							<div class="table-block">    
        						<div class="cours-table-hed"><h3><?php echo Yii::t('app','Subject'); ?></h3></div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                    <thead>
                                        <tr>
                                            <th width="25%"><?php echo Yii::t('app','Name');?></th>
                                            <th width="25%"><?php echo Yii::t('app','Course');?></th>
                                            <th width="25%"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></th>
                                        </tr> 
<?php
										if($employee_subs){
											foreach($employee_subs as $employee_sub){
												$subjectname 	= Subjects::model()->findByPk($employee_sub->subject_id);
												$batchdetails 	= Batches::model()->findByPk($subjectname->batch_id);
												$coursedetails 	= Courses::model()->findByPk($batchdetails->course_id);
?>
												<tr>
                                                    <td><?php echo ucfirst($subjectname->name);?></td>
                                                    <td><?php echo ucfirst($coursedetails->course_name);?></td>
                                                    <td><?php echo ucfirst($batchdetails->name);?></td>
                                                </tr>												
<?php												
											}
										}
										else{
?>
											<tr>
                                            	<td colspan="3" class="nothing-found"><?php echo Yii::t('app','Subject(s) Not Assigned'); ?></td>
                                            </tr>
<?php											
										}
?>                                        
                                    </thead>
                                </table>    
                            </div> 
                            
                            <div class="table-block">    
        						<div class="cours-table-hed"><h3><?php echo Yii::t('app','Electives'); ?></h3></div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="cours-inner-table">
                                    <thead>
                                        <tr>
                                            <th width="25%"><?php echo Yii::t('app','Elective Name');?></th>
                                            <th width="25%"><?php echo Yii::t('app','Elective Group');?></th>
                                            <th width="25%"><?php echo Yii::t('app','Course');?></th>
                                            <th width="25%"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></th>
                                        </tr> 
<?php
										if($employee_elecs){
											foreach($employee_elecs as $employee_elec){
												$electivename 		= Electives::model()->findByPk($employee_elec->elective_id);
												$electivegroupname 	= ElectiveGroups::model()->findByPk($electivename->elective_group_id);
												$batchdetails 		= Batches::model()->findByPk($electivegroupname->batch_id);
												$coursedetails 		= Courses::model()->findByPk($batchdetails->course_id);
?>
												<tr>
                                                    <td><?php echo ucfirst($electivename->name);?></td>
                                                    <td><?php echo ucfirst($electivegroupname->name);?></td>
                                                    <td><?php echo ucfirst($coursedetails->course_name);?></td>
                                                    <td><?php echo ucfirst($batchdetails->name);?></td>
                                                </tr>
<?php												
											}											
										}
										else{
?>
											<tr>
                                            	<td colspan="4" class="nothing-found"><?php echo Yii::t('app','Elective(s) Not Assigned'); ?></td>
                                            </tr>
<?php											
										}
?>                                                                  
                                    </thead>
                                </table>        
                            </div>       
                       	
                        </div>
                    </div>
                </div>        
            </div>
		</td>
	</tr>
</table>                        