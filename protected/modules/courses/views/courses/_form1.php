


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p style="padding-left:20px;">Fields with <span class="required">*</span> are required.</p>

	<?php 

	echo $form->errorSummary($model); ?>
    
    <h3 style="padding-left:20px;">Course</h3>
    <div style="padding:0 0 0 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('courses','course_name')); ?></td>
    <td width="3%">&nbsp;</td>
    <td ><?php echo $form->textField($model,'course_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'course_name'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('courses','code')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'code',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'code'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('courses','section_name')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'section_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'section_name'); ?></td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php //echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'formbut')); ?>
         <?php	echo CHtml::ajaxSubmitButton(Yii::t('job','Save'),CHtml::normalizeUrl(array('courses/Edit&val1='.$val1,'render'=>false)),array('success'=>'js: function(data) {
                       $("#jobDialog11").dialog("close");  window.location.reload();
					   alert(\'Course Updated Successfully\');
                    }'),array('id'=>'closeJobDialog12','name'=>'Submit')); ?></td>
  </tr>
 <?php $this->renderPartial('_flash',array('model'=>$model,'id'=>jobDialog)); ?>
</table>
</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->hiddenField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
	</div>

	<div class="row">
   
		<?php //echo $form->labelEx($model,'created_at')
  
		 echo $form->hiddenField($model,'created_at'); ?>

		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->hiddenField($model,'updated_at',array('value'=>date('d-m-Y'))); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

  
    
    <!-- Batch Form Ends -->
	<div style="padding:0px 0 0 0px; text-align:left">
		
	</div>

<?php $this->endWidget(); ?>
