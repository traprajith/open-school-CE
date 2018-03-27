<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'academic-years-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span><?php echo Yii::t('app',' are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
    <br/>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li>
                <?php echo CHtml::link('<span>'.Yii::t('app','Add Academic Year').'</span>', array('create'),array('class'=>'a_tag-btn')); ?>
            </li>
            <li>
                <?php echo CHtml::link('<span>'.Yii::t('app','Manage Academic Years').'</span>', array('admin'),array('class'=>'a_tag-btn'));?>
            </li>                                    
</ul>
</div> 
</div>

    
    
    <div class="formCon">
        <div class="formConInner">
        	<h3><?php echo Yii::t('app','Update the details of this academic year'); ?></h3>
            <div class="txtfld-col-btn">
            <div class="txtfld-col">
				<?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name'); ?>
                <?php echo $form->error($model,'name'); ?>
            </div>
            <div class="txtfld-col">
				<?php echo $form->labelEx($model,'start'); ?>
                    	<?php
                    	$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
						if($settings!=NULL)
						{
							$date = $settings->dateformat;
							$model->start = date($settings->displaydate,strtotime($model->start));
							$model->end = date($settings->displaydate,strtotime($model->end));
						}
						else
						{
							$date = 'mm-dd-yy';
							
						}
                    	
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'attribute'=>'start',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date, 
								'changeMonth'=> true,
								'changeYear'=>true,
								'yearRange'=>'1980:'.(date('Y')+5),
							),
							'htmlOptions'=>array(
								'readonly'=>true
								),
							));
						?>
                    	<?php //echo $form->textField($model,'start'); ?>
						<?php echo $form->error($model,'start'); ?>
            </div>
            <div class="txtfld-col">
<?php echo $form->labelEx($model,'end'); ?>
                    	<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'attribute'=>'end',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date, 
								'changeMonth'=> true,
								'changeYear'=>true,
								'yearRange'=>'1980:'.(date('Y')+5),
							),
							'htmlOptions'=>array(
								'readonly'=>true
								),
							));
						?>
                    	<?php //echo $form->textField($model,'end'); ?>
						<?php echo $form->error($model,'end'); ?>
            </div>      
            </div>
<div class="txtfld-col-btn">
<?php echo $form->labelEx($model,'description'); ?>
                    	<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>48)); ?>
                        <?php echo $form->error($model,'description'); ?>
</div>
<div class="txtfld-col-btn">      
    <div class="txtfld-col">
 <?php echo $form->labelEx($model,'status'); ?>
                    	<?php echo $form->dropDownList($model,'status',array('1'=>Yii::t('app','Active'),'0'=>Yii::t('app','Inactive')),array('style'=>'')); ?>                
	</div>
    </div>
            
            
            
            
        </div>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut','id'=>'submitbutton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
/* 
* Import form show and hide
*/

$( "input[name=import]:radio" ).change(function() {
	if($(this).val() == 1)
	{
		$('#import_form').show("slow");
	}
	else
	{
		$('#import_form').hide("slow");
	}
});

/* 
* Import form validation
*/

$( "#submitbutton" ).click(function() {
	var radio = $('input:radio[name=import]:checked').val();
	if(radio == 1)
	{
		var previous_year = $( "#previous_year" ).val();
		if(previous_year == "")
		{
			alert("Select an academic year");
			return false;
		}
		else
		{
			if($('#previous_batch').is(':checked') || $('#previous_subject').is(':checked'))
			{
				return true;
			}
			else
			{
				alert("Select atleast one parameter to import");
				return false;
			}
		}
		
		
	}
	else
	{
		return true;
	}
});

</script>