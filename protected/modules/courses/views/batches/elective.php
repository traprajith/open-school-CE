<style>
.infored_bx{
	padding:5px 20px 7px 20px;
	background:#e44545;
	color:#fff;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	font-size:15px;
	font-style:italic;
	text-shadow: 1px -1px 2px #862626;
	text-align:left;
}
.infogreen_bx{
	padding:5px 20px 7px 20px;
	background:#59bd5f;
	color:#fff;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	border-radius:4px;
	font-size:15px;
	font-style:italic;
	text-shadow: 1px -1px 2px #46974b;
	text-align:left;
}
</style>
<script>
function checkVal(){
	
	var elective=$("#elective_id").val();
	var group=$("#elective_group_id").val();
	if(elective=="" || group==""){
		alert("<?php echo Yii::t('app','Please select Elective Group and Elective'); ?>");
		return false;
	}
	if(elective==0){
		alert("<?php echo Yii::t('app','Please select an Elective!'); ?>");
		return false;
	}
	
	if($('input[name="sid[]"]:checked').length==0){
		alert("<?php echo Yii::t('app','Please select atleast one student!'); ?>");
		return false;
	}
	
	if(confirm("<?php echo Yii::t('app','Are you sure you want to save this elective?'); ?>")){
		return true;
	}
	else{
		return false;
	}
	
		
}
</script>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	Yii::t('app','Electives'),
);
?>
<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
<?php
	$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
	if(Yii::app()->user->year)
	{
		$year = Yii::app()->user->year;
	}
	else
	{
		$year = $current_academic_yr->config_value;
	}
	
	$is_insert = PreviousYearSettings::model()->findByAttributes(array('id'=>2));
?>
<div style="background:#FFF; min-height:800px;">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td  valign="top">
					<?php 
                    if($batch!=NULL)
                    {
                    ?>
                        <div style="padding:20px;">
                        <h1><?php echo Yii::t('app','Manage').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></h1>
                            
                            <!--<div class="searchbx_area">
                            <div class="searchbx_cntnt">
                            <ul>
                            <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
                            <li><input class="textfieldcntnt"  name="" type="text" /></li>
                            </ul>
                            </div>
                            
                            </div>-->
                            
                            
                            
                            <!--<div class="edit_bttns">
                            <ul>
                            <li>
                            <a href="#" class=" edit last">Edit</a>    </li>
                            </ul>
                            </div>-->
                            
                            
                            <div class="clear"></div>
                            <div class="emp_right_contner">
                                <div class="emp_tabwrapper">
									<?php $this->renderPartial('tab');?>
                                    <h1><?php echo Yii::t('app','Elective');?></h1>
                                    <?php $this->beginWidget('CActiveForm'); ?>
                                    
                                    <div class="formCon" style="margin-bottom:10px; position:relative;margin-top:10px;">
                                        <div class="formConInner">
                                        	<?php
											if($year != $current_academic_yr->config_value and $is_insert->settings_value==0)
											{
											?>
												<span style="color:#008000; font-size:12px;left:150px;">
												<?php echo Yii::t('settings','You are not viewing the current active year. To add students, enable Insert option in Previous Academic Year Settings.'); ?>
												</span>
											<?php										
											}
											?>
                                            <table width="80%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                <td><strong><?php echo Yii::t('app','Select Group'); ?></strong></td>
                                                <td><?php 
                                                //$data1 = CHtml::listData(ElectiveGroups::model()->findAll('batch_id=:cid and is_deleted=:x',array(':cid'=>$_REQUEST['id'],':x'=>0)),'id','name');
                                                $data1 = CHtml::listData(ElectiveGroups::model()->findAll(array('order'=>'name ASC','condition'=>'batch_id=:cid and is_deleted=:x','params'=>array(':cid'=>$_REQUEST['id'],':x'=>0))),'id','name');
                                                
                                                echo CHtml::dropDownList('elective_group_id','',$data1,array('prompt'=>Yii::t('app','Select'),'id'=>'elective_group_id',
                                                'ajax' => array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('/courses/electives/electivename'),
                                                'update'=>'#elective_id',
                                                'data'=>'js:{elective_group_id:$(this).val(), "'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',),'style'=>'width:270px;'));
                                                // echo CHtml::dropDownList('elective_id','',$data1,array('prompt'=>'Select','id'=>'elective_id1')); ?>
                                                </td>
                                                <td>&nbsp;</td>
                                                
                                               
                                                <td><strong><?php echo Yii::t('app','Select Subject'); ?></strong></td>
                                                <td><?php 
                                                
                                                echo CHtml::dropDownList('elective_id','',$data,array('prompt'=>Yii::t('app','Select'),'id'=>'elective_id'));
                                                
                                                ?></td>
                                                <td>&nbsp;</td>
                                                <td>
												<?php 
												
												if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
												{
													/*	echo CHtml::submitButton(Yii::t('app','Save'),
																array('name'=>'elective','id'=>'1','class'=>'add','confirm'=>Yii::t('app','Are you sure you want to save?'),'class'=>'formbut'));*/
														echo CHtml::submitButton(Yii::t('app','Save'),
																array('name'=>'elective','id'=>'1','class'=>'add','onclick'=>'return(checkVal())','class'=>'formbut'));
												}
												?>
												
                                                </td>
                                                </tr>
                                            </table>
                                        
                                        </div> <!-- END div class="formConInner" -->
                                    </div> <!-- END div class="formCon" -->
                                                                        
                                    <?php
                                    if(Yii::app()->user->hasFlash('success'))
									{
                                    ?>
                                    	<div class="infogreen_bx" style="margin:10px 0 10px 10px; width:575px;">
											<?php echo Yii::app()->user->getFlash('success');?>
										</div>
                                         <script> $(".infogreen_bx").fadeOut(9000); </script>
                                    <?php
                                    }
                                    else if(Yii::app()->user->hasFlash('error'))
									{
                                    ?>
                                    	<div class="infored_bx" style="margin:10px 0 10px 10px; width:575px;">
											<?php echo Yii::app()->user->getFlash('error');?>
										</div>
                                        <script> $(".infored_bx").fadeOut(9000); </script>
                                    <?php
                                    }
                                    ?>
                                    <div class="table_listbx1">
                                    
                                    <?php
                                    if(isset($_REQUEST['id']))
                                    {
										
										$elec_id = array();
										$electives = StudentElectives::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['id']));
										foreach($electives as $elective){
											$elec_id[] = $elective->student_id;
										}
										$criteria = new CDbCriteria;
										$criteria->condition = 'is_deleted=:is_deleted AND is_active=:is_active';
										$criteria->params[':is_deleted'] = 0;
										$criteria->params[':is_active'] = 1;
										$batch_students = BatchStudents::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['id'],'result_status'=>0));
										if($batch_students)
										{
											$count = count($batch_students);
											$criteria->condition = $criteria->condition.' AND (';
											$i = 1;
											foreach($batch_students as $batch_student)
											{
												
												$criteria->condition = $criteria->condition.' id=:student'.$i;
												$criteria->params[':student'.$i] = $batch_student->student_id;
												if($i != $count)
												{
													$criteria->condition = $criteria->condition.' OR ';
												}
												$i++;
												
											}
											$criteria->condition = $criteria->condition.')';
										}
										else
										{
											$criteria->condition = $criteria->condition.' AND batch_id=:batch_id';
											$criteria->params[':batch_id'] = $_REQUEST['id'];
										}
										
										
										$posts=Students::model()->findAll($criteria);
										
										
										if($posts!=NULL)
										{
										?>
                                            <div class="pdtab_Con" style="padding-top:0px;">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tr class="pdtab-h">
                                                        <td >&nbsp;</td>
                                                         <?php if(Configurations::model()->rollnoSettingsMode() != 2)
															{?>
                                			 			 <td style="padding-left:20px;"><?php echo Yii::t('app','Roll No');?></td><?php } ?>
                                                        <?php if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))
                                                        { ?>
                                                        <td style="padding-left:20px;"><?php echo Yii::t('app','Student Name');?></td>
                                                        <?php } ?>
                                                        <td style="padding-left:20px;"><?php echo Yii::t('app','Admission Number');?></td>  
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="padding:8px 0 8px 20px;" >
                                                        <?php $posts1=CHtml::listData($posts, 'id', 'Fullnames');?>
                                                        <?php
                                                        echo CHtml::checkBoxList('sid','',$posts1, array('id'=>'1','template' => '{input}{label}</td></tr><tr><td width="10%" style="padding:0 0 10px 20px;" class="rbr">','checkAll' =>Yii::t('app','All')));?>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </div>
										<?php    	
										}
										else
										{
											echo '<br><div class="notifications nt_red" style="padding-top:10px"><i>'.Yii::t('app','No Active Students In This ').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");'</i></div>'; 
										
										}
                                    
                                    }
                                    ?>
                                   
                                    <?php $this->endWidget(); ?>
                                    <div id="jobDialog"></div>
                                    
                                    </div> <!-- END div class="table_listbx1" -->
                                </div> <!-- END div class="emp_tabwrapper" -->
                            </div> <!-- END div class="emp_right_contner" -->
                        </div>
                    
                    <?php    	
                    }
                    else
                    {
						echo '<div class="emp_right" style="padding-left:20px; padding-top:50px;">';
						echo '<div class="notifications nt_red">'.'<i>'.Yii::t('app','Nothing Found!!').'</i></div>'; 
						echo '</div>';
                    }
                    ?>
                </td>
            </tr>
    	</tbody>
    </table>
</div>
