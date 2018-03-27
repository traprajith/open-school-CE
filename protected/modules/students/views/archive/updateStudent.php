<style type="text/css">
#jobDialog{
	height:auto !important;
}
.row{
	margin-top:20px;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',
	array(
		'id'=>'jobDialog',
		'options'=>array(
			'title'=>Yii::t('app','Update').' '.Students::model()->getAttributeLabel('email').' & '.Students::model()->getAttributeLabel('phone1'),
			'autoOpen'=>true,
			'modal'=>'true',
			'width'=>'400',
			'height'=>'auto',
			'resizable'=>false,		
		),
	));

	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'student-update-form',	
	)); 		
?>
        <p class="note"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app',' are required.');?></p>
        
        <div style="width:90%">    
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                	<td width="90%"><?php echo $form->labelEx($model,'email'); ?></td>
                </tr>
                <tr>
                	<td><?php echo $form->textField($model,'email'); ?></td>
                </tr>
                <tr>	
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td width="90%"><?php echo $form->labelEx($model,'phone1'); ?></td>
                </tr>
                <tr>
                	<td><?php echo $form->textField($model,'phone1'); ?></td>
                </tr>
            </table>

            <div class="row">
<?php
				echo $form->hiddenField($model, 'id', array('value'=>$model->id));
				echo CHtml::ajaxSubmitButton(Yii::t('app','Update'),CHtml::normalizeUrl(array('/students/archive/updateStudent','render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
					if (data.status == "success"){
						$("#jobDialog").dialog("close");
						if(data.flag==1){						
							window.location.reload();
						}
					}
					else{
						$(".errorMessage").remove();
						var errors	= JSON.parse(data.errors);						
						$.each(errors, function(index, value){
							var err	= $("<div class=\"errorMessage\" />").text(value[0]);
							err.insertAfter($("#" + index));
						});
					}
                       
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit')));
?>            
            </div>
        </div>        
<?php 
	$this->endWidget();
$this->endWidget('zii.widgets.jui.CJuiDialog');?>

