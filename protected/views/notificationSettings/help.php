<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
<style>
.partial_fee_heading
{
	font-size:12px;
	font-weight:bold;
}
.formConInner table
{
	color:#666666;	
}
</style>

<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'partial',
                'options'=>array(
                    'title'=>Yii::t('app','Help URL'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
				
?>
<div class="formCon">
    
    <div class="formConInner" style="width:50%; height:auto;">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'course_status_form',
            'enableAjaxValidation'=>false,
        )); ?>
        
        <div class="row">
        	<label for="" class="required"><?php echo Yii::t('app','Help URL');?> <span class="required">*</span></label>
        	<?php
				echo $form->textField($model,'help_link',array('size'=>20,'value'=>$model->config_value,)); 
			?>
            <div id="help_error" style="color:#F00"></div>
        </div>
        
        <div class="row">
            <?php
            echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('notificationSettings/help')),array('dataType'=>'json','success'=>'js: 				
                function(data) { 
                        $(".errorMessage").remove();									
                        if(data.status == "success")
                        {
                                //$("#course_status'.$model->id.'").dialog("close");
                                window.location.reload();

                        }
                        else if(data.status=="error")
                        {
                                var errors	= JSON.parse(data.errors);

                                 $.each(errors, function(index, value){
                                        var err	= $("<div class=\"errorMessage\" />").text(value[0]);
                                        err.insertAfter($("#" + index));
                                });										


                        }
                          //window.location.reload();
                }'),array('id'=>'closeDialog','name'=>'save')); 
            ?>
        </div>
         <?php $this->endWidget(); ?>
    </div>
</div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>

<script type="text/javascript">
$('#closeDialog').click(function(ev) {
	var help_link = $('#Configurations_help_link').val(); 	
	if(help_link == '')
	{		   
		$('#help_error').html('<?php echo Yii::t('app','Enter Help URL'); ?>');
		return false;
	}else{ 
		var pattern = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;

		
	  	if(!pattern.test(help_link)){
			$('#help_error').html('<?php echo Yii::t('app','Enter a valid URL'); ?>');
			return false;
		}
	}
			
	});
</script>