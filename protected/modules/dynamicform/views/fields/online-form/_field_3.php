<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
	<?php echo CHtml::activeDropDownList($model, $field->varname, FormFields::model()->fieldValues($field->id), array('prompt'=>Yii::t('app','Select').' '.$model->getAttributeLabel($field->varname),'class'=>'form-control')) ?>	
</div>