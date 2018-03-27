
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subjects-form',
	'enableAjaxValidation'=>true,
)); 
$model;
?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?><span class="required">*</span><?php echo Yii::t('app','are required.'); ?></p>
<?php $data = CHtml::listData(SubjectName::model()->findAll(),'id','name') ?>
	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','name')); ?></td>
    <td><?php echo $form->dropDownList($model,'name',$data,array('prompt'=>Yii::t('app','Select'))); ?>
		<?php echo $form->error($model,'name'); ?></td>
    
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','max_weekly_classes')); ?></td>
    <td><?php echo $form->textField($model,'max_weekly_classes'); ?>
		<?php echo $form->error($model,'max_weekly_classes'); ?></td>
        </tr>
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('app','no_exams')); ?></td>
    <td><?php echo $form->checkBox($model,'no_exams'); ?>
		<?php echo $form->error($model,'no_exams'); ?></td>
  </tr>
  
</table>


	<div class="row">
		<?php //echo $form->labelEx($model,'batch_id'); ?>
		<?php echo $form->hiddenField($model,'batch_id',array('value'=>$batch_id)); ?>
		<?php echo $form->error($model,'batch_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'elective_group_id'); ?>
        <?php if($id==1)
		{
		echo $form->hiddenField($model,'elective_group_id');
		}
		else
		{
			echo $form->hiddenField($model,'elective_group_id',array('value'=>'1'));
		}
		 ?>
		<?php echo $form->error($model,'elective_group_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->hiddenField($model,'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created_at'); ?>
		
		 <?php  if(Yii::app()->controller->action->id == 'create')
		{
         echo $form->hiddenField($model,'created_at',array('value'=>date('d-m-Y')));
		}
		else
		{
			echo $form->hiddenField($model,'created_at');
		}
		  ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->hiddenField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div style="padding:20px 0 0 0px; text-align:right">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
         <?php if($id==1)
		{
		echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('subjects/create','render'=>false)),array('success'=>'js: function(data) {
                       $("#jobDialog").dialog("close");
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit')));
		}
		else
		{
			echo CHtml::ajaxSubmitButton(Yii::t('app','Save'),CHtml::normalizeUrl(array('subjects/create','render'=>false)),array('success'=>'js: function(data) {
                       $("#jobDialog1").dialog("close");
                    }'),array('id'=>'closeJobDialog','name'=>Yii::t('app','Submit')));
		}
		 ?>
       
	</div>

<?php $this->endWidget(); ?>
