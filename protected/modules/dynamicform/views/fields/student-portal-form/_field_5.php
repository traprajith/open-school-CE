<div class="col-sm-4 colm-4min">
    <div class="form-group">
		<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
        <br />
		<?php echo CHtml::activeCheckBox($model, $field->varname, array('value'=>FormFields::model()->fieldValue($field->id), 'style'=>'float:left;')).'&nbsp; <label style="float:left; margin-left:5px;" for="'.get_class($model).'_'.$field->varname.'">'.FormFields::model()->fieldLabel($field->id).'</label>';?>
		<div class="clear"></div>
		<?php echo CHtml::error($model, $field->varname); ?>
	</div>
</div>