
<div style="clear:both"></div>
<div class="col-sm-12 colm-4min">
	<div class="clear"></div>
	<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
	<?php echo CHtml::activeTextArea($model, $field->varname,array('placeholder'=>$model->getAttributeLabel($field->varname),'class'=>'form-control')); ?>
	<?php echo CHtml::error($model, $field->varname); ?>
</div>
