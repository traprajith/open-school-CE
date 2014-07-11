<style>
.success  {background-color:#fff !important ;}
</style>

<div >

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'batches-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p style="padding-left:20px;">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
    <?php $daterange=date('Y');
 		 $daterange_1=$daterange+20;
	
		  ?>
    <div style="width:90%" >
    <div style="padding-left:20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45%"><?php echo $form->labelEx($model,Yii::t('Batch','name')); ?></td>
    <td width="5%">&nbsp;</td>
    <td width="45%"><div><?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?></div></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('Batch','start_date')); ?></td>
    <td>&nbsp;</td>
    <td><div>
    <?php
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
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
							));
    ?>
		<?php echo $form->error($model,'start_date'); ?></div></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('Batch','end_date')); ?></td>
    <td>&nbsp;</td>
    <td><div>
    <?php		
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								//'name'=>'Students[admission_date]',
								'model'=>$model,
								'attribute'=>'end_date',
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>$date,
									'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1900:'.$daterange_1,
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));
   				
    ?>
		<?php echo $form->error($model,'end_date'); ?></div></td>
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
    <td><div><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll($criteria),'id','concatened'),array('empty' => 'Select Class Teacher')); ?>
		<?php echo $form->error($model,'employee_id'); ?></div></td>
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
        
        <?php	echo CHtml::ajaxSubmitButton(Yii::t('job','Save'),CHtml::normalizeUrl(array('batches/create','render'=>false)),array('success'=>'js: function(data) { $("#jobDialog").dialog("close"); window.location.reload();
                       
                    }'),array('id'=>'closeJobDialog','name'=>'Submit')); ?>
	</td>
  </tr>
</table>
</div>
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
		<?php /*?><?php echo $form->textField($model,'employee_id',array('value'=>1)); ?><?php */?>
        <?php /*?><?php echo $form->dropDownList($model,'employee_id',CHtml::listData(Employees::model()->findAll(),'id','concatened'),array('empty' => 'Assign Class Teacher')); ?>
		<?php echo $form->error($model,'employee_id'); ?><?php */?>
	</div>

	<div class="row buttons">
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->