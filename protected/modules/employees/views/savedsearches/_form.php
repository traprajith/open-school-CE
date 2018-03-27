
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'savedsearches-form',
	'enableAjaxValidation'=>true,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	
		<?php echo $form->hiddenField($model,'user_id',array('value'=>Yii::app()->User->id)); ?>
		
		<?php echo $form->hiddenField($model,'url',array('value'=>$url)); ?>
		
        <?php echo $form->hiddenField($model,'type',array('value'=>$type)); ?>
		

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('maxlength'=>120)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
    <br />


	<div class="row buttons">
		<?php echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('Savedsearches/create','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
						if (data.status == "success")
                		{
							$("#jobDialog").dialog("close");
							window.location.reload();
						}
						
					  
                    }',),array('id'=>'closeJobDialog','name'=>'Submit')); ?> 
	</div>

<?php $this->endWidget(); ?>
