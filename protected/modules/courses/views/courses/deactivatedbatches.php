<style type="text/css">
.pdtab_Con {    
    padding: 10px 0px 0px 0px;
}
.nothing-found{
	font-style:italic;
	text-align:center;
}
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	Yii::t('app','Deactivated').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top"><?php $this->renderPartial('left_side');?></td>
        <td valign="top">
        	<div class="cont_right formWrapper">
            	<div  class="page-header">
                    <h1><?php echo Yii::t('app','Deactivated').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></h1>
                </div>
                <!-- Flash Message -->
				<?php
                Yii::app()->clientScript->registerScript(
                    'myHideEffect',
                    '$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
                    CClientScript::POS_READY
                );
                ?>
                <?php
                /* Success Message */
                if(Yii::app()->user->hasFlash('successMessage')): 
                ?>
                    <div class="flashMessage" style="background:#FFF; color:#C00; padding-left:220px; font-size:13px">
                    <?php echo Yii::app()->user->getFlash('successMessage'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="pdtab_Con"> 
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr class="pdtab-h">
                        	<td align="center" width="30"><?php echo '#';?></td>
                            <td align="center" width="175"><?php echo Yii::t('app','Course Name');?></td>
                            <td align="center" width="175"><?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','Name');?></td>
                            <td align="center" width="125"><?php echo Yii::t('app','Start Date');?></td>
                            <td align="center" width="125"><?php echo Yii::t('app','End Date');?></td>                                    
                            <td align="center" width="125"><?php echo Yii::t('app','Actions');?></td>                                                         
                        </tr>
<?php
						if(Yii::app()->user->year){
							$year = Yii::app()->user->year;
						}
						else{
							$current_academic_yr 	= Configurations::model()->findByAttributes(array('id'=>35));
							$year 					= $current_academic_yr->config_value;
						}
						
						$criteria 				= new CDbCriteria;
						$criteria->condition 	= 'academic_yr_id =:academic_yr_id AND is_active =:is_active AND is_deleted =:is_deleted';
						$criteria->params		= array(':academic_yr_id'=>$year, ':is_active'=>0, ':is_deleted'=>0);
						$criteria->order		= 'name ASC';
						$batches				= Batches::model()->findAll($criteria);
						if($batches){
							$i = 1;
							foreach($batches as $batch){
								$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								$course	 	= Courses::model()->findByPk($batch->course_id);
?>
								<tr>
                                	<td align="center"><?php echo $i; ?></td>
                                    <td align="center">
										<?php
											if($course){
												echo ucfirst($course->course_name);
											}
											else{
												echo '-';
											}
										?>
                                    </td>
                                    <td align="center"><?php echo ucfirst($batch->name); ?></td>
                                    <td align="center"><?php echo date($settings->displaydate, strtotime($batch->start_date)); ?></td>
                                    <td align="center"><?php echo date($settings->displaydate, strtotime($batch->end_date)); ?></td>
                                    <td align="center" class="sub_act">                                    	
										<?php
											echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/courses/batches/remove','id'=>$batch->id, 'flag'=>1), 'confirm'=>Yii::t('app','Are you sure you want to delete this').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.'?'.''.
																	 Yii::t('app','Note: All details (timetable, exam) related to this').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','will be deleted.'), 'csrf'=>true));
											echo CHtml::link(Yii::t('app','Activate'), array('batches/activate','id'=>$batch->id),array('confirm'=>Yii::t('app','Are you sure you want to activate this').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.'?')).'</td>';
										?>                                    	
                                    </td>
                                </tr>
<?php
								$i++;
																
							}
						}
						else{
?>
							<tr>
                            	<td class="nothing-found" colspan="6"><?php echo Yii::t('app','No Deactivated Batch Found!'); ?></td>
                            </tr>
<?php							
						}
						
?>                        
                    </table>
				</div>                    
            </div>
        </td>
	</tr>
</table>                