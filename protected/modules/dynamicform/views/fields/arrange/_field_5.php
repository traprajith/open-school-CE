<div class="form-field txtfld-col" data-field="<?php echo $field->id;?>">
	<?php echo CHtml::activeLabelEx($model, $field->varname); ?>
	<?php echo CHtml::activeCheckBox($model, $field->varname, array('value'=>FormFields::model()->fieldValue($field->id), 'style'=>'float:left;')).' <label style="float:left" for="'.get_class($model).'_'.$field->varname.'">'.FormFields::model()->fieldLabel($field->id).'</label>';?>
	<?php echo CHtml::error($model, $field->varname); ?>
</div>