<div class="col-sm-4 colm-4min">
    <div class="form-group">
		<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
        <br />
		<?php echo CHtml::activeRadioButtonList($model, $field->varname, FormFields::model()->fieldValues($field->id),  array('separator'=>' ', 'labelOptions' => array('style' => "display: inline-block" ))); ?>
		<?php echo CHtml::error($model,$field->varname); ?>
	</div>
</div>