<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configurations-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span><?php echo Yii::t('app','are required.'); ?></p>

<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','Enable / Disable Semester System'); ?></h3>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
                <td> 
					<?php
						$is_enabled	= $model->isSemesterEnabled();
						echo CHtml::radioButtonList('semester', $is_enabled, array(1=>Yii::t('app', 'Enable'), 0=>Yii::t('app', 'Disable')), array('separator'=>' '));
                    ?>
				</td>
            </tr>
        </table>
    </div>
</div>

<div class="formCon" <?php if(!$is_enabled){?> style="display:none;" <?php }?> id="courses-list">
    <div class="formConInner">
    	<h3><?php echo Yii::t('app','Select Courses under the Semester System'); ?></h3>
        <?php
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
        	$courses				= Courses::model()->findAll($criteria);
			
			//semester enabled courses
			$criteria->condition					.= ' AND `t`.`semester_enabled`=:semester_enabled';
			$criteria->params[':semester_enabled']	= 1;
			$semester_enabled_courses				= Courses::model()->findAll($criteria);
			
			if(count($courses)>0){
				echo CHtml::hiddenField('academic_yr', $year);
				$items_per_row	= 3;
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                                    <?php echo CHtml::checkBox('courses['.$key.']', $course->semester_enabled, array('value'=>$course->id, 'class'=>'check_course'));?>
                                    <?php echo CHtml::label($course->course_name, 'courses_'.$key);?>
                                </td>
                            <?php if(($key+1)==count($courses) or $key%$items_per_row==($items_per_row-1)){?>
                        </tr>
                    <?php }?>
                <?php }?>
			</table>
		<?php }else{
			echo Yii::t('app', 'No course found');
		}?>
	</div>
</div>
            
<div>
	<?php echo CHtml::submitButton(Yii::t('app','Apply'),array('id'=>'submit_button_form','class'=>'formbut','name'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>

<script>
$(':radio[name="semester"]').change(function(e) {
    if($(':radio[name="semester"]:checked').val()==1){
		$('#courses-list').show();
	}
	else{
		$('#courses-list').hide();
	}
});

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