<script>
	
	
	function addDiv(divID)
	{
		var divTag = document.createElement("div");
		divTag.className = "row";
		divTag.innerHTML = document.getElementById(divID).innerHTML;
		document.getElementById("innerDiv").appendChild(divTag);
	}
	
	
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
	'id'=>'employee-achievement-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>CController::createUrl('achievements/update')
)); ?>

    
  	<p class="note" style="float:left"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app','are required.'); ?></p>
    
    
    <?php
	
	Yii::app()->clientScript->registerScript(
	   'myHideEffect',
	   '$(".error").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	   CClientScript::POS_READY
	);
	?>
	<?php
	if(Yii::app()->user->hasFlash('errorMessage')): 
	?>
	<div class="error" style="background:#FFF; color:#C00; padding-left:200px; top:150px;">
		<?php echo Yii::app()->user->getFlash('errorMessage'); ?>
	</div>
	<?php
	endif;
		
	?>

    <div class="formCon" style="clear:left;">
        <div class="formConInner" id="innerDiv">
        <?php
		 $employee=Employees::model()->findByAttributes(array('uid'=>$model->user_id));
		?>
        	<table width="80%" border="0" cellspacing="0" cellpadding="0" id="documentTable">
            <tr>
             <td><label><?php echo Yii::t('app','Achievement Title');?><font color="#FF0000">*</font></label></td>
            <td><?php echo $form->textField($model,'achievement_title');?>
            <?php echo $form->error($model,'achievement_title'); ?>
             <div id="title_error" style="color:#F00"></div>
            </td>
            </tr>
          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
           </tr>
            <tr>
                 <td><label><?php echo Yii::t('app','Description');?><font color="#FF0000">*</font></label></td>
                <td><?php echo $form->textArea($model,'description');?>
                <?php echo $form->error($model,'description'); ?>
                <div id="description_error" style="color:#F00"></div>
                </td>
            </tr>
             <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
           </tr>
                
            <tr>
                <td><label><?php echo Yii::t('app','Document Name');?><font color="#FF0000">*</font></label></td>
                <?php 
						if($model->file==NULL and $model->file_type==NULL)
						{
						?>
                <td><label><?php echo Yii::t('app','Choose The File Size Is Maximum 200 Kb');?></label></td>
                <?php
						}
						else
						{
						?>
                        <td></td>
                <?php
						}
						?>
                        
            </tr>
          <tr>
                <td>
                <?php
				$valid_image_types = array('image/jpeg','image/png','image/gif','image/gif','image/bmp','image/jpg');
				?>
                    <?php echo $form->textField($model,'doc_title',array('size'=>25,'maxlength'=>225)); ?>
                     <?php echo $form->error($model,'doc_title'); ?>
                     <div id="name_error" style="color:#F00"></div>
                </td>
                <td id="existing_file">
                    	<?php 
						if($model->file!=NULL and $model->file_type!=NULL)
						{
						?>
                        <ul class="tt-wrapper">
							
                            <li>
                                <?php echo CHtml::link('<span>'.Yii::t('app','Download').'</span>', array('achievements/download','id'=>$model->id,'employee_id'=>$employee->id),array('class'=>'tt-download')); ?>
                            </li>
                            <?php
                            if(in_array($model->file_type,$valid_image_types)) 
                            {
                            
                          
								 $path = 'uploadedfiles/employee_achievement_document/'.$model->user_id.'/'.$model->file;
	 	                         echo '<li><a class="tt-image" href="#"><span style="width:170px;height:140px; left:-30px;"><img  src="'.$path.'" width="170" height="140" /></span></a>	</li>';
							}
							?>
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
                         <div id="file_error" style="color:#F00"></div>
                    </td>
                
               </tr>
         </table>
           <div class="row" id="student_id">
           <?php
		   $student=Employees::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		   ?>
                <?php echo $form->hiddenField($model,'user_id',array('value'=>$employee->uid)); ?>
                <?php echo $form->error($model,'user_id'); ?>
           </div> 
            <div class="row">
                <?php echo $form->hiddenField($model,'eid',array('value'=>$_REQUEST['employee_id'])); ?>
                <?php echo $form->error($model,'eid'); ?>    
            </div>
            <div class="row">
                <?php echo $form->hiddenField($model,'did',array('value'=>$model->id)); ?>
                <?php echo $form->error($model,'did'); ?>    
            </div>
            
           
        </div>
    </div>
    <div class="row buttons">
       
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','SAVE') : Yii::t('app','Save'),array('class'=>'formbut','id'=>'submit_button_form')); ?>
    </div>
    	

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	$('#submit_button_form').click(function(ev) {
		$('#title_error').html('');
		$('#description_error').html('');
		$('#name_error').html('');
		$('#file_error').html('');
		var title = $('#Achievements_achievement_title').val();
		var description = $('#Achievements_description').val();
		var doc_name = $('#Achievements_doc_title').val();
		var is_file = $('#Achievements_file').val();		
		if(title == ''){
			$('#title_error').html('<?php echo Yii::t('app','Title cannot be blank');?>');
			return false;
		}
		if(description == ''){
			$('#description_error').html('<?php echo Yii::t('app','Description cannot be blank');?>');
			return false;
		}
		if(doc_name == ''){
			$('#name_error').html('<?php echo Yii::t('app','Document Name cannot be blank');?>');
			return false;
		}
		
	});
</script>