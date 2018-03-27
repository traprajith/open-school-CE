<div class="form-field txtfld-col" data-field="<?php echo $field->id;?>">
	<?php echo CHtml::activeLabelEx($model, $field->varname); ?>
	<?php echo CHtml::activeDropDownList($model, $field->varname, FormFields::model()->fieldValues($field->id), array('prompt'=>Yii::t('app','Select').' '.$model->getAttributeLabel($field->varname))) ?>
	<?php echo CHtml::error($model, $field->varname); ?>
</div>