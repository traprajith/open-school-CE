<div class="col-sm-4 colm-4min">
    <div class="form-group">
		<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
		<?php echo CHtml::activeTextField($model, $field->varname,array('placeholder'=>$model->getAttributeLabel($field->varname),'class'=>'form-control')); ?>
		<?php echo CHtml::error($model, $field->varname); ?>
	</div>
</div>