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
                'id'=>'partial'.$model->id,
                'options'=>array(
                    'title'=>Yii::t('app',"Change Status"),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
$id = $model->id;				
?>
<div class="formCon">
    
    <div class="formConInner">
    <div class="popup-bg-block">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'course_status_form',
            'enableAjaxValidation'=>false,
        )); ?>
        
       		
        	<div><?php echo Yii::t('app','Status'); ?><span class="required"> *</span></div>
<?php							                                
			echo $form->dropDownList($model,'result_status',  CHtml::listData(PromoteOptions::model()->findAll(),'option_value','option_name'),array('empty'=>Yii::t('app','Select'))); 
			echo $form->error($model,'id'); 
?>				
            <div id="status_error" style="color: #E26214"></div>
            <?php echo $form->hiddenField($model,'id',array('value'=>$model->id)); ?>

			<div class="js_popup_form_blk">
            <?php
            echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('/students/students/liststatus')),array('dataType'=>'json','success'=>'js: 				
                function(data) { 
                        $(".errorMessage").remove();									
                        if(data.status == "success")
                        {
                                $("#course_status'.$model->id.'").dialog("close");
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
                }'),array('id'=>'closeDialog'.$model->id,'name'=>'save')); 
            ?>
</div>
         <?php $this->endWidget(); ?>
    </div>
    </div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
<script>
$("#closeDialog<?php echo $model->id; ?>").click(function(e) {
   var status = $('#BatchStudents_result_status').val();
   if(status == ''){
        $('#status_error').html('<?php echo Yii::t('app','Cannot be blank'); ?>');
   }   
});
</script>