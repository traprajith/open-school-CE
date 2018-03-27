<div class="col-sm-4">
	<?php echo CHtml::activeLabelEx($model, $field->varname,array('class'=>'control-label')); ?>
	<?php
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		if($settings!=NULL){
			$date=$settings->dateformat;
		}else{
			$date = 'dd-mm-yy';
		}
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
	                        
			'model'     => $model,
	    	'attribute' => $field->varname,
			//'name'=>'date_of_birth',
			// additional javascript options for the date picker plugin
			'options'=>array(
			'showAnim'=>'fold',
			'dateFormat'=>$date,
			'changeMonth'=> true,
			'changeYear'=>true,
			'yearRange'=>'1900:'.(date('Y')+5)
			),
			'htmlOptions'=>array(
				'class'=>'form-control',
				'placeholder'=>$model->getAttributeLabel($field->varname),
				'readonly'=>true
			),
		));
	?>	
</div>