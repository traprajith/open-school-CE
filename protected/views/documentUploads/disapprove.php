<style>
#jobDialog_comment{
	height:auto !important;
}

.ui-dialog .ui-dialog-title {
    float: left;
    color: #585858;
	font-weight: 300;
   
	    padding: 3px 7px;
}
.ui-dialog-titlebar {
    background: #c0def3!important;
    color: #000 !important;
}
.ui-dialog .ui-dialog-titlebar {
    padding: 2px 0px 2px 10px !important;
}
.textarea_reason{ width:100%;}
.ui-dialog .ui-dialog-content {
    padding: 5px 30px 14px 15px !important;
}

</style>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id'=>'jobDialog_comment',
	'options'=>array(
		'title'=>Yii::t('app','Add Reason'),
		'autoOpen'=>true,
		'modal'=>'true',
		'width'=>'323',
		'height'=>'auto',
		'resizable'=>false,
				
   ),
));

?>
<div class="form">
<?php	
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'reason-form',		
	)); 
?>
		<div style="width:100%" >
			<div>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                        <td width="90%"><?php echo $form->labelEx($model,'reason'); ?></td>
                    </tr>
                    <tr>           
                        <td>						                     
                            <?php echo $form->textArea($model,'reason',array('rows'=>5, 'class'=>'textarea_reason'));		
                            echo $form->error($model,'reason'); ?>                      
                        </td>                 
                	</tr>
                </table>                
            </div>            
        </div>  
        <br /> 
        <div class="row buttons">        
<?php
			echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('/documentUploads/disapprove','id'=>$model->id, 'render'=>false)),array('dataType'=>'json','success'=>'js: function(data) {
				if (data.status == "success")
				{
				 $("#jobDialog_comment").dialog("close");
				 if(data.flag==1)
				 {						 
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
<?php $this->endWidget(); ?>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>