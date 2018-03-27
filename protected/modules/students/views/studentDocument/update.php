<?php
$this->breadcrumbs=array(
	Yii::t('app','Student')=>array('/students'),
	Yii::t('app','Documents'),
	Yii::t('app','Update'),
);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php 
				if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of update from student registration form
					$this->renderPartial('application.modules.students.views.default.left_side'); 
				}
				else{
					$this->renderPartial('/students/profileleft');
				}
			?>
        </td>
        <td valign="top">
        	<div class="cont_right formWrapper">
            	<?php
					 $student = Students::model()->findByAttributes(array('id'=>$student_id));
                        if(!isset($_REQUEST['flag'])){ //In case of update from student registration form	
				?>
                            <div  class="page-header">
                                <h1>
                                <?php   
                                	echo Yii::t('app','Student Profile :');?> <?php echo ucfirst($student->first_name).' '.ucfirst($student->middle_name).' '.ucfirst($student->last_name); 
                                ?>   
                                </h1>
                            </div>
                <?php
						}
                ?>
            	
				<div class="clear"></div>
                <div class="emp_right_contner">
					<div class="emp_tabwrapper">
						<?php
							if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of update from student registration form	
								$this->renderPartial('application.modules.students.views.students.reg_tab'); 
							}else{
								$this->renderPartial('application.modules.students.views.students.tab');
							}
						?>
                        <div class="clear"></div>
                        
                        <div class="emp_cntntbx">
                        	<div class="edit_bttns last">
                                <ul>
                                    <li>
                                        <?php 
											if(isset($_REQUEST['flag']) and $_REQUEST['flag'] == 1){ //In case of update from student registration form
												echo CHtml::link('<span>'.Yii::t('app','Create Document').'</span>', array('/students/studentDocument/create', 'id'=>$student_id),array('class'=>'formbut-n')); 
											}
											else{
												echo CHtml::link('<span>'.Yii::t('app','Document List').'</span>', array('students/document', 'id'=>$student_id),array('class'=>' edit ')); 
											}
										?>
                                    </li>
                                </ul>
                        	</div> <!-- END div class="edit_bttns last" -->
                            <br />
                        	<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>
                        </div> <!-- END div class="emp_cntntbx" -->
					</div> <!-- END div class="emp_tabwrapper" -->			
                </div> <!-- END div class="emp_right_contner" -->
            </div> <!-- END div class="cont_right formWrapper" -->
        </td>
	</tr>
</table>



