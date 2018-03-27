<div class="txtfld-col txt-fld-bgg">
	<p><?php echo CHtml::activeLabelEx($model, $field->varname); ?></p>
	<?php echo CHtml::activeRadioButtonList($model, $field->varname, FormFields::model()->fieldValues($field->id), array('separator'=>' ', 'labelOptions' => array('style' => "display: inline-block" ))); ?>	
</div>