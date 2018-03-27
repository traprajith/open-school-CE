<script>
	
	function addDiv(divID)
	{
		var divTag = document.createElement("div");
		divTag.className = "row";
		divTag.innerHTML = document.getElementById(divID).innerHTML;
		document.getElementById("innerDiv").appendChild(divTag);
	}
</script>



<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-achievement-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>CController::createUrl('achievements/create')
)); ?>

	<?php 
	//var_dump($form->errorSummary($model));exit;
		
		
	?>
    
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
        	<table width="80%" border="0" cellspacing="0" cellpadding="0" id="documentTable">
            <tr>
             <td><label><?php echo Yii::t('app','Achievement Title');?><font color="#FF0000">*</font></label></td>
            <td><?php echo $form->textField($model,'achievement_title');?>
               <?php echo $form->error($model,'achievement_title'); ?>
               <div id="title_error" style="color:#F00"></div></td>
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
                <td><label><?php echo Yii::t('app','Choose The File Size Is Maximum 5MB');?></label></td>
            </tr>
           <tr>
                <td></td>
                <td><label><?php echo Yii::t('app','Choose The File Types').' '.Yii::t('app','doc,pdf,text,jpeg,png,excel').'';?></label></td>
            </tr>
            
            <tr>
                <td>
                    <?php echo $form->textField($model,'doc_title',array('size'=>25,'maxlength'=>225)); ?>
                     <?php echo $form->error($model,'doc_title'); ?>
                     <div id="name_error" style="color:#F00"></div>
                </td>
                <td>
                    <?php echo $form->fileField($model,'file'); ?>
                    <?php echo $form->error($model,'file'); ?>
                    <div id="file_error" style="color:#F00"></div>
                </td>
             </tr>
         </table>
         <?php
         if(Yii::app()->controller->action->id!='create')
		 {?>
           <div class="row" id="student_id">
           <?php
		   $student=Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
		   ?>
                <?php echo $form->hiddenField($model,'user_id',array('value'=>$student->uid)); ?>
                <?php echo $form->error($model,'user_id'); ?>
           </div> 
            <div class="row">
                <?php echo $form->hiddenField($model,'sid',array('value'=>$_REQUEST['id'])); ?>
                <?php echo $form->error($model,'sid'); ?>    
            </div>
           <?php
		 }
		 ?>
           
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
		var flag 	= 0; 	
		if(title == ''){
			flag 	= 1;
			$('#title_error').html('<?php echo Yii::t('app','Title cannot be blank');?>');			
		}
		if(description == ''){
			flag 	= 1;
			$('#description_error').html('<?php echo Yii::t('app','Description cannot be blank');?>');			
		}
		if(doc_name == ''){
			flag 	= 1;
			$('#name_error').html('<?php echo Yii::t('app','Document Name cannot be blank');?>');			
		}
		if(is_file == ''){
			flag 	= 1;
			$('#file_error').html('<?php echo Yii::t('app','Select Certificate');?>');			
		}
		if(flag == 1){
			return false;
		}
	});
</script>