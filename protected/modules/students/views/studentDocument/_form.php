<style type="text/css">
.formbut{
	padding: 10px 15px;
}
</style>
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'student-document-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'action'=>CController::createUrl('studentDocument/create')
    )); ?>

<?php 			
		if(Yii::app()->controller->action->id!="document"){
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
                        <td class="doc_drop">
<?php							
                            $criteria = new CDbCriteria;
                            $criteria->join = 'LEFT JOIN student_document sd ON sd.doc_type = t.name and sd.student_id = '.$_REQUEST['id'].'';
                            $criteria->addCondition('sd.doc_type IS NULL');
                             
                            if(isset($_REQUEST['doc']) and ($_REQUEST['doc']!=NULL)){                            
                            	$sel = $_REQUEST['doc'];
                            }
                            else{
                            	$sel = '';
                            }
                            $static = array('Others' => 'Others');
                            
                            $data_1 = CHtml::listData(StudentDocumentList::model()->findAll($criteria),'name','name');
                            echo $form->dropDownList($model,'doc_type[]',$data_1+$static,array('prompt'=>Yii::t('app','Select Document'), 'class'=>'dropclass doc_type','options'=>array()));
?>	                            
                        </td>
                        <td class="doc_title" style="display:none;">
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
                if(Yii::app()->controller->action->id=="document"){
					echo $form->hiddenField($model,'document',array('value'=>1)); 
                }
				echo $form->hiddenField($model,'sid',array('value'=>$_REQUEST['id']));
				echo $form->hiddenField($model,'student_id[]',array('value'=>$_REQUEST['id']));
				echo $form->hiddenField($model,'file_type[]');
				echo $form->hiddenField($model,'created_at[]');
?>                                
            </div>
        </div>

<div class="button-bg">

<div class="top-hed-btn-right">
<ul>                                    
<li>
<?php 
				echo CHtml::button(Yii::t('app','Add Another'), array('class'=>'formbut-n','id'=>'addAnother')).'&nbsp;'; 
				if(Yii::app()->controller->action->id=='create'){
?>
					<div style="float:right">
<?php					
						echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save and Continue') : Yii::t('app','Save'),array('class'=>'formbut-n')).'&nbsp;';
?>
					</div>
<?php					  
				}
				else{
					echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Save') : Yii::t('app','Save'),array('class'=>'')).'&nbsp;'; 
				}
			?>
</li>
                                  
</ul>
</div> 
<div class="top-hed-btn-left"> </div>
</div>  	
	<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
$("#addAnother").click(function(){
	var $table 	= $("#documentTable");
	if($table.find('tr').length<13){
		var tr1			= $('<tr />');
		var firstrow	= $table.find('tr').first();
		var colCount	= firstrow.find('td').length;

		for(var i=0; i<colCount; i++){
			var newcell = $('<td />');
			newcell.html("&nbsp;");
			tr1.append(newcell);
		}

		$table.append(tr1);

		var tr2 	= firstrow.clone();
		tr2.find('.doc_title').hide();
		tr2.find('.doc_type').change(function(){
			show_hide_title(this);
		});

		$table.append(tr2);
	}
	else{
		alert("<?php echo Yii::t('app','Only 5 files can be uploaded at a time. Go to the student profile to add more.'); ?>");
	}
});

var show_hide_title 	= function(that){
	var id = $(that).val();
	if(id=='Others')
		$(that).closest('tr').find('.doc_title').show();
	else
		$(that).closest('tr').find('.doc_title').hide();
};

$(".doc_type").change(function(){
	show_hide_title(this);
});
</script>