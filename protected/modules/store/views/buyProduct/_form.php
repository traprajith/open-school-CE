<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buy-product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <div class="formCon">
<div class="formConInner">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="21%"><?php echo $form->labelEx($model,Yii::t('store','student_id')); ?></td>
    <td width="7%">&nbsp;</td>
    <td width="72%">
    
      <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete',
						array(
						  'name'=>'name',
						  'id'=>'name_widget',
						  'source'=>$this->createUrl('/site/autocomplete'),
						  'htmlOptions'=>array('placeholder'=>'Student Name'),
						  'options'=>
							 array(
								   'showAnim'=>'fold',
								   'select'=>"js:function(student, ui) {
									  $('#id_widget').val(ui.item.id);
											 }"
									),
						));
		?>
        <?php echo CHtml::hiddenField('student_id','',array('id'=>'id_widget')); ?>
		<?php echo CHtml::ajaxLink('[][][]',array('/site/explorer','widget'=>'1'),array('update'=>'#explorer_handler'),array('id'=>'explorer_student_name'));?>
		
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('store','pr_name')); ?></td>
    <td>&nbsp;</td>
    <td> <?php echo $form->dropDownList($model,'pr_name',CHtml::listData(StoreProduct::model()->findAll(),'id','product_name'),array('prompt'=>'Select',
));?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('store','pr_brand')); ?></td>
    <td>&nbsp;</td>
    <td> <?php echo $form->dropDownList($model,'pr_brand',CHtml::listData(StoreProduct::model()->findAll(),'id','product_brand'),array('prompt'=>'Select',
));?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	
     <tr>
    <td><?php echo $form->labelEx($model,Yii::t('store','pr_quantity')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'pr_quantity',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pr_quantity'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	
    <tr>
    <td><?php echo $form->labelEx($model,Yii::t('store','price')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'pr_quantity',array('size'=>20,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pr_quantity'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
	</div>
</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

