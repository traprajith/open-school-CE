<div class="txtfld-col">
	<p><?php echo CHtml::activeLabelEx($model, $field->varname); ?></p>
	<?php echo CHtml::activeCheckBox($model, $field->varname, array('value'=>FormFields::model()->fieldValue($field->id))).' <label  for="'.get_class($model).'_'.$field->varname.'">'.FormFields::model()->fieldLabel($field->id).'</label>';?>
	<div class="clear"></div>	
</div>