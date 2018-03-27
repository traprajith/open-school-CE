<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'semester-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="formCon">
<div class="formConInner">
<div style="background:none;">
<p style="padding-left:20px;"><?php echo Yii::t('User','Fields with');?><span class="required">*</span><?php echo Yii::t('User','are required.');?></p>



    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><?php echo $form->labelEx($model,'name'); ?></td>
            <td><?php echo $form->textField($model,'name');?>
            <?php echo $form->error($model,'name'); ?></td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td><?php echo $form->labelEx($model,'description'); ?></td>
            <td><?php echo $form->textArea($model,'description');?><br />
            <?php echo $form->error($model,'description'); ?></td>
        </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
         <tr>
         	<td><?php echo $form->labelEx($model,'start_date'); ?></td>
            <td><?php
					$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings != NULL){
						$date	= $settings->dateformat;
					}
					else{
						$date 	= 'dd-mm-yy';
					}            
					//set default date  
					 if((isset($model->start_date)) and $model->start_date!=NULL){
                            $model->start_date	= date("j M Y",strtotime($model->start_date));
                        }                     
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(                        
						'model'=>$model,
						'attribute'=>'start_date',
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>$date,
							'changeMonth'=> true,
							'changeYear'=>true,
							'yearRange'=>(date('Y')-15).':'.(date('Y')+15)
						),
						'htmlOptions'=>array(								
							'readonly'=>true
						),
					));
									
					 ?>
					<?php echo $form->error($model,'start_date'); ?></td>
         </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
          <tr>
         	<td><?php echo $form->labelEx($model,'end_date'); ?></td>
            <td><?php
					$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
					if($settings != NULL){
						$date	= $settings->dateformat;
					}
					else{
						$date 	= 'dd-mm-yy';
					}            
					//set default date
					 if((isset($model->end_date)  and $model->end_date!=NULL)){
                            $model->end_date	= date("j M Y",strtotime($model->end_date));
                        }                           
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(                        
						'model'=>$model,
						'attribute'=>'end_date',
						// additional javascript options for the date picker plugin
						'options'=>array(
							'showAnim'=>'fold',
							'dateFormat'=>$date,
							'changeMonth'=> true,
							'changeYear'=>true,
							'yearRange'=>(date('Y')-15).':'.(date('Y')+15)
						),
						'htmlOptions'=>array(								
							'readonly'=>true
						),
					));
									
					 ?>
					<?php echo $form->error($model,'end_date'); ?></td>
         </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         </tr>
     
        <?php if(Configurations::model()->isSemesterEnabled() == 1){
			if(Yii::app()->user->year){
				$year 					= Yii::app()->user->year;
			}
			else{
				$current_academic_yr 	= Configurations::model()->findByAttributes(array('id'=>35));
				$year 					= $current_academic_yr->config_value;
			}
				
			$criteria	= new CDbCriteria;
			$criteria->condition	= '`t`.`is_deleted`=:is_deleted AND `t`.`academic_yr_id`=:year';
			$criteria->params		= array(':is_deleted'=>0,':year'=>$year);
			
			//semester enabled courses
			$criteria->condition					.= ' AND `t`.`semester_enabled`=:semester_enabled';
			$criteria->params[':semester_enabled']	= 1;
			$courses				= Courses::model()->findAll($criteria);
			
			if(count($courses)>0){
			?>
            <tr>
           	 <td colspan="2"><h3><?php echo Yii::t('app','Select Courses'); ?></h3></td>
			</tr>
            <?php
				echo CHtml::hiddenField('academic_yr', $year);
				$items_per_row	= 3;
			?>
				<tr>
					<td colspan="<?php echo $items_per_row;?>">
						<?php echo CHtml::checkBox('check_all_course', (count($courses)==count($semester_enabled_courses))?true:false);?>
						<?php echo CHtml::label(Yii::t('app', 'All Courses'), 'check_all_course');?>
					</td>
				</tr>
                <?php foreach($courses as $key=>$course){?>
                	<?php if($key==0 or $key%$items_per_row==0){?>
                    	<tr><td colspan="<?php echo $items_per_row;?>">&nbsp;</td></tr>
                        <tr>
                            <?php }?>
                                <td width="<?php echo floor(100/$items_per_row).'%';?>">
                                    <?php echo CHtml::checkBox('courses['.$key.']',SemesterCourses::model()->isSemesterForCourse($course->id,$model->id), array('value'=>$course->id, 'class'=>'check_course'));?>
                                    <?php echo CHtml::label($course->course_name, 'courses_'.$key);?>
                                </td>
                            <?php if(($key+1)==count($courses) or $key%$items_per_row==($items_per_row-1)){?>
                        </tr>
                    <?php }?>
                <?php }?>

		<?php }else{
			echo Yii::t('app', 'No course found');
		}
		}?>

       <tr>    
            <td height="10px">&nbsp;</td>
           
        </tr>        
       <tr>    
            <td height="">&nbsp;</td>
            <td><?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?></td>
        </tr>
    </table>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
</div>
</div>
<script>
$(':checkbox#check_all_course').change(function(e) {
    if($(this).is(':checked')){
		$(':checkbox.check_course').attr('checked', true);
	}
	else{
		$(':checkbox.check_course').attr('checked', false);
	}
});

$(':checkbox.check_course').change(function(e) {
    if($(':checkbox.check_course:checked').length==$(':checkbox.check_course').length){
		$(':checkbox#check_all_course').attr('checked', true);
	}
	else{
		$(':checkbox#check_all_course').attr('checked', false);
	}
});
</script>