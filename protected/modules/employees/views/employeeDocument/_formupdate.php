<script>
	function removeFile() 
	{	
		if(document.getElementById("new_file").style.display == "none")
		{
			document.getElementById("existing_file").style.display = "none";
			document.getElementById("new_file").style.display = "block";
			document.getElementById("new_file_field").value = "1";
		}
		
		return false;
	}
</script>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>CController::createUrl('employeeDocument/update',array('document_id'=>$model->id))
)); ?>

	<?php 
		if($form->errorSummary($model)){
	?>
        <div class="errorSummary"><?php echo Yii::t('app','Input Error'); ?><br />
        	<span><?php echo Yii::t('app','Please fix the following error(s).'); ?></span>
        </div>
    <?php 
		}
		//var_dump($model->attributes);exit;
	?>
    
  	<p class="note" style="float:left"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app','are required.'); ?></p>
    
    
    <?php
	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$(".error").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	   CClientScript::POS_READY
	);
	if(Yii::app()->user->hasFlash('errorMessage')): 
	?>
        <div class="error" style="background:#FFF; color:#C00; padding-left:200px; top:150px; width:200px;">
            <?php echo Yii::app()->user->getFlash('errorMessage'); ?>
        </div>
	<?php
	endif;
	?>

    <div class="formCon" style="clear:left;">
        <div class="formConInner" id="innerDiv">
        	<table width="80%" border="0" cellspacing="0" cellpadding="0" id="documentTable">
            	<tr>
                	<td width="10%"><?php echo $form->labelEx($model,'Document Name'); ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;<?php //echo $form->labelEx($model,Yii::t('employees','file')); ?></td>
                </tr>
                <tr>
                	<td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                	<td>
						<?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>225)); ?>
                         <?php echo $form->error($model,'title'); ?>
                    </td>
                    <td id="existing_file">
                    	<?php 
						if($model->file!=NULL and $model->file_type!=NULL)
						{
						?>
                        <ul class="tt-wrapper">
                            <li>
                                <?php echo CHtml::link('<span>'.Yii::t('app','View').'</span>', array('employeeDocument/download','id'=>$model->id,'employee_id'=>$model->employee_id),array('class'=>'tt-download')); ?>
                            </li>
                            <li>
								<?php echo CHtml::link('<span>'.Yii::t('app','Remove').'</span>', array('#'),array('class'=>'tt-delete','onclick'=>'return removeFile();')); ?>
                            </li>
						</ul>
                        <?php
						}
						?>
                    </td>
                    <td id="new_file" style="display:none; padding-left:20px;">
						<?php echo $form->fileField($model,'file'); ?>
                        <?php echo $form->error($model,'file'); ?>
                        <?php echo $form->hiddenField($model,'new_file_field',array('value'=>0,'id'=>'new_file_field')); ?>
                    </td>
                </tr>
            </table>
			
            <div class="row" id="employee_id">
                <?php echo $form->hiddenField($model,'employee_id',array('value'=>$model->employee_id)); ?>
                <?php echo $form->error($model,'employee_id'); ?>
            </div>
        
            <div class="row" id="file_type">
                <?php //echo $form->labelEx($model,'file_type'); ?>
                <?php echo $form->hiddenField($model,'file_type'); ?>
                <?php echo $form->error($model,'file_type'); ?>
            </div>
        
            <div class="row" id="created_at">
                <?php //echo $form->labelEx($model,'created_at'); ?>
                <?php echo $form->hiddenField($model,'created_at'); ?>
                <?php echo $form->error($model,'created_at'); ?>
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php //echo CHtml::button('Add Another', array('class'=>'formbut','id'=>'addAnother','onclick'=>'addRow("documentTable");')); ?>
        <?php echo CHtml::submitButton(Yii::t('app','Update'),array('class'=>'formbut')); ?>
    </div>
    	

<?php $this->endWidget(); ?>

</div><!-- form -->