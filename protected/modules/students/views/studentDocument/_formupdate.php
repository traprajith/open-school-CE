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

<?php
 	if(isset($_REQUEST['flag']) and $_REQUEST['flag']==1){ //In case of update from student registration
		$values = array('document_id'=>$model->id, 'flag'=>1);
	}
	else{
		$values = array('document_id'=>$model->id);
	}
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'student-document-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'action'=>CController::createUrl('studentDocument/update',$values)
	)); 
?>

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
                	<td>
                    	<?php
							
							$criteria = new CDbCriteria;
							$criteria->join = 'LEFT JOIN student_document sd ON sd.doc_type = t.name and sd.doc_type <> "'.$model->doc_type.'" and sd.student_id = '.$_REQUEST['id'].'';							
							$criteria->addCondition('sd.doc_type IS NULL');
							$static = array('Others' => 'Others');
							$data_1 = CHtml::listData(StudentDocumentList::model()->findAll($criteria),'name','name');							
							
							echo $form->dropDownList($model,'doc_type',$data_1+$static,array('prompt'=>Yii::t('app','Select Document')));
						?>
                    </td>
                	<td id="doc_title_td">
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
                                <?php echo CHtml::link('<span>'.Yii::t('app','View').'</span>', array('studentDocument/download','id'=>$model->id,'student_id'=>$model->student_id),array('class'=>'tt-download')); ?>
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
                <tr>
                	<td>&nbsp;</td>
                    <td><div id="doc_title_error" style="color:#F00"></div></td>
                </tr>
            </table>
			
            <div class="row" id="student_id">
                <?php echo $form->hiddenField($model,'student_id',array('value'=>$model->student_id)); ?>
                <?php echo $form->error($model,'student_id'); ?>
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
<?php if($model->doc_type == 'Others'){ ?>
	<script>$('#doc_title_td').show();</script>
<?php }else{ ?>  
	<script>$('#doc_title_td').hide();</script>
<?php } ?>   

<script type="text/javascript">
$('#StudentDocument_doc_type').change(function(ev){
	var doc_type = $(this).val();
	if(doc_type == 'Others'){
		$('#doc_title_td').show('slow');
	}
	else{
		$('#StudentDocument_title').val('');
		$('#doc_title_td').hide('slow');
	}
});

$('.formbut').click(function(ev){
	$('#doc_title_error').html('');
	var doc_type	= $('#StudentDocument_doc_type').val();
	var title 		= $('#StudentDocument_title').val();
	if(doc_type == 'Others' && title == ''){		
		$('#doc_title_error').html('<?php echo Yii::t('app','Cannot be blank'); ?>');
		return false;
	}
});
</script>