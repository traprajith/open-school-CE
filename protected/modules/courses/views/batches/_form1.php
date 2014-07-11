<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batches-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".success_msg").animate({opacity: 1.0}, 4000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>

	<span id="success_msg" class="success_msg" style="font-size:14px; color:#C00; font-weight:bold; padding-left:20px; padding-top:5px;"></span>
	<p style="padding-left:20px;">Fields with <span class="required">*</span> are required.</p>
<div style="padding:0 0 0 20px;">
	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('batch','name')); ?></td>
    <td width="5%">&nbsp;</td>
    <td><?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('batch','start_date')); ?></td>
    <td>&nbsp;</td>
    <td><?php $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{
				$date=$settings->dateformat;
		
		
			}
			else
				$date = 'dd-mm-yy';	
   				
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								//'name'=>'Students[admission_date]',
								'model'=>$model,
								'attribute'=>'start_date',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));?>
		<?php echo $form->error($model,'start_date'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('batch','end_date')); ?></td>
    <td>&nbsp;</td>
    <td><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
								//'name'=>'Students[admission_date]',
								'model'=>$model,
								'attribute'=>'end_date',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.(date('Y')+30),
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							)); ?>
		<?php echo $form->error($model,'end_date'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <td><?php echo $form->labelEx($model,Yii::t('Batch','Teacher')); ?></td>
    <td>&nbsp;</td>
    <?php
		$criteria=new CDbCriteria;
		$criteria->condition='is_deleted=:is_del';
		$criteria->params=array(':is_del'=>0);
	?>
    <td><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll($criteria),'id','concatened'),array('empty' => 'Select Class Teacher')); ?>
		<?php echo $form->error($model,'employee_id'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php	
		echo CHtml::ajaxSubmitButton(Yii::t('job','Save'),CHtml::normalizeUrl(array('Batches/Addupdate&val1='.$batch_id,'render'=>false)),
		array('success'=>'js: function(data) {
									 $("#success_msg").html("Batch updated successfully!");
									 setTimeout(function() {
											$("#jobDialog123").dialog("close"); 
									 		window.location.reload();
									 }, 1000);
									 
									 }',),
		array('id'=>'closeJobDialog','name'=>'Submit')); ?></td>
  </tr>
</table>
</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'course_id'); 
		?>
		<?php echo $form->hiddenField($model,'course_id',array('value'=>$val1)); ?>
		<?php echo $form->error($model,'course_id'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->hiddenField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->hiddenField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'employee_id'); ?>
		<?php /*?><?php echo $form->textField($model,'employee_id',array('value'=>1)); ?>
		<?php echo $form->error($model,'employee_id'); ?><?php */?>
	</div>

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->