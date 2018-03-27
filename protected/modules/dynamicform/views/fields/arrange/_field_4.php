<div class="form-field txtfld-col" data-field="<?php echo $field->id;?>">
	<?php echo CHtml::activeLabelEx($model, $field->varname); ?>
	<?php echo CHtml::activeRadioButtonList($model, $field->varname, FormFields::model()->fieldValues($field->id)); ?>
	<?php echo CHtml::error($model,$field->varname); ?>
</div>