<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-search-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_brand'); ?>
		<?php echo $form->textField($model,'product_brand',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'product_brand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_quantity'); ?>
		<?php echo $form->textField($model,'product_quantity'); ?>
		<?php echo $form->error($model,'product_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_id'); ?>
		<?php echo $form->textField($model,'c_id'); ?>
		<?php echo $form->error($model,'c_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->