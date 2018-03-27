<script>
	function addRow(tableID) 
	{
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if(rowCount < 13)// limit the user from creating fields more than your limits
		{
			var row = table.insertRow(rowCount);
			var colCount = table.rows[0].cells.length;
			for(var i=0; i<colCount; i++) 
			{
				var newcell = row.insertCell(i);
				newcell.innerHTML = "&nbsp;";
			}   
			rowCount++;                     
			for(var j=0; j<2; j++)
			{
				var row = table.insertRow(rowCount);
				var colCount = table.rows[j].cells.length;
				for(var i=0; i<colCount; i++) 
				{
					var newcell = row.insertCell(i);
					newcell.innerHTML = table.rows[j].cells[i].innerHTML;
				}
				rowCount++;
			}
			addDiv("employee_id");
			addDiv("file_type");
			addDiv("created_at");
		}
		else
		{
			 alert('<?php echo Yii::t('app',"Only 5 files can be uploaded at a time."); ?>');
				   
		}
	}
	
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
	'id'=>'employee-document-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'action'=>CController::createUrl('employeeDocument/create')
)); ?>

	<?php 
		if($form->errorSummary($model)){
	?>
        <div class="errorSummary"><?php echo Yii::t('app','Input Error'); ?><br />
        	<span><?php echo Yii::t('app','Please fix the following error(s).'); ?></span>
        </div>
    <?php 
		}
		if(Yii::app()->controller->action->id!="document")
        {
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
		}
	?>

    <div class="formCon" style="clear:left;">
        <div class="formConInner" id="innerDiv">
        	<table width="80%" border="0" cellspacing="0" cellpadding="0" id="documentTable">
            	<tr>
                	<td><label><?php echo Yii::t('app','Document Name'); ?><font color="#FF0000">*</font></label></td>
                    <td><label><?php echo Yii::t('app','Choose The File Size Is Maximum 200 Kb'); ?></label></td>
                </tr>
                <tr>
                	<td>
						<?php echo $form->textField($model,'title[]',array('size'=>25,'maxlength'=>225)); ?>
                         <?php echo $form->error($model,'title'); ?>
                    </td>
                    <td>
						<?php echo $form->fileField($model,'file[]'); ?>
                        <?php echo $form->error($model,'file'); ?>
                    </td>
                    
                </tr>
            </table>
            <?php
            if(Yii::app()->controller->action->id=="document")
            {
			?>
            <div class="row">
                <?php echo $form->hiddenField($model,'document',array('value'=>1)); ?>
                <?php echo $form->error($model,'document'); ?>    
            </div>
			<?php  
			}
			?>
            <div class="row">
                <?php echo $form->hiddenField($model,'sid',array('value'=>$_REQUEST['id'])); ?>
                <?php echo $form->error($model,'sid'); ?>    
            </div>
			
            <div class="row" id="employee_id">
                <?php echo $form->hiddenField($model,'employee_id[]',array('value'=>$_REQUEST['id'])); ?>
                <?php echo $form->error($model,'employee_id'); ?>
            </div>
        
            <div class="row" id="file_type">
                <?php //echo $form->labelEx($model,'file_type'); ?>
                <?php echo $form->hiddenField($model,'file_type[]'); ?>
                <?php echo $form->error($model,'file_type'); ?>
            </div>
        
            <div class="row" id="created_at">
                <?php //echo $form->labelEx($model,'created_at'); ?>
                <?php echo $form->hiddenField($model,'created_at[]'); ?>
                <?php echo $form->error($model,'created_at'); ?>
            </div>
        </div>
    </div>
    <div class="row buttons">
        <?php echo CHtml::button(Yii::t('app','Add Another'), array('class'=>'formbut','id'=>'addAnother','onclick'=>'addRow("documentTable");')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','SAVE') : Yii::t('app','Save'),array('class'=>'formbut')); ?>
    </div>
    	

<?php $this->endWidget(); ?>

</div><!-- form -->