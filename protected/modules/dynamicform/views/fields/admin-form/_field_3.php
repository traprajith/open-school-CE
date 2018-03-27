<div class="txtfld-col">
	<?php echo CHtml::activeLabelEx($model, $field->varname); ?>
	<?php echo CHtml::activeDropDownList($model, $field->varname, FormFields::model()->fieldValues($field->id), array('prompt'=>Yii::t('app','Select').' '.$model->getAttributeLabel($field->varname))) ?>	
</div>