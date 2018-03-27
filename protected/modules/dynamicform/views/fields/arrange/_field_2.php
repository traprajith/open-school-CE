<div class="form-field txtarea-col" data-field="<?php echo $field->id;?>">
	<div class="clear"></div>
	<?php echo CHtml::activeLabelEx($model, $field->varname); ?>
	<?php echo CHtml::activeTextArea($model, $field->varname,array('placeholder'=>$model->getAttributeLabel($field->varname))); ?>
	<?php echo CHtml::error($model, $field->varname); ?>
</div>