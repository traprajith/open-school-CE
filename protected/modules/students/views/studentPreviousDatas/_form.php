
<div class="captionWrapper">
  <ul>
    	<li><h2 >Student Details</h2></li>
        <li><h2 >Parent Details</h2></li>
        <li><h2>Emergency Contact</h2></li>
        <li><h2 class="cur">Previous Details</h2></li>
        <li class="last"><h2>Student Profile</h2></li>
    </ul>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-previous-datas-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php if($form->errorSummary($model)){; ?>
    
    <div class="errorSummary">Input Error<br />
    <span>Please fix the following error(s).</span>
    </div>
    <?php } ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="formCon" >

<div class="formConInner">

<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('students','institution')); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','year')); ?></td>

   
  </tr>
  <tr>
    <td><?php echo $form->textField($model,'institution',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'institution'); ?></td>
    <td>&nbsp;</td>
    <td>
	
	
	
	
	<?php echo $form->dropDownList($model,'year',$model->getYears(),array('prompt'=>'select')); ?>
	<?php echo $form->error($model,'year'); ?></td>
   
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   
  </tr>
  <tr>
  	 <td><?php echo $form->labelEx($model,Yii::t('students','course')); ?></td>
     <td>&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('students','total_mark')); ?></td>
   
  </tr>
  <tr>
  	<td><?php echo $form->textField($model,'course',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'course'); ?></td>
         <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'total_mark',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'total_mark'); ?></td>
  
    
  </tr>
 
</table>


	<div class="row">
		<?php //echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->hiddenField($model,'student_id',array('value'=>$_REQUEST['id'])); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	
</div>
</div>
	<div class="row">
		<?php //echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->hiddenField($model,'student_id',array('value'=>$_REQUEST['id'])); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div style="padding:0px 0 0 0px;text-align:left;">
    <?php //echo CHtml::link('Save And Add Another', array('students/create'),array('class'=>'formbut','style'=>'padding:8px 20px')); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'SAVE' : 'Save',array('class'=>'formbut')); ?>
        <?php 
			if(Yii::app()->controller->action->id=='update'){
				echo '&nbsp;&nbsp;'.CHtml::button('Remove', array('submit' => array('StudentPreviousDatas/delete','id'=>$_REQUEST['pid'],'sid'=>$_REQUEST['id']),'class'=>'formbut','confirm'=>'Are you sure?'));
			}
		?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->