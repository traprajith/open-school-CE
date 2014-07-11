<div class="wz-navWrapper">
	<ul>
    	<li class="fstep-Current">1</li>
        <li class="sstep">2</li>
        <li class="tstep">3</li>
        <li class="fostep">4</li>
        <li class="fistep">5</li>
    </ul>
<div class="clear"></div>
</div>
<div class="captionWrapper">
	<ul>
    	<li><h2  class="cur">1.Student details</h2><span>General Details</span></li>
        <li><h2>2.Parent details</h2><span>General Details</span></li>
        <li><h2>3.Student details</h2><span>General Details</span></li>
        <li><h2>4.Student details</h2><span>General Details</span></li>
        <li class="last"><h2>5.Student details</h2><span>General Details</span></li>
    </ul>
</div>
<div class="formCon">
<h2><span>Step 1.</span> Student details</h2>
<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'students-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'admission_no'); ?></td>
    <td><?php echo $form->textField($model,'admission_no',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'admission_no'); ?></td>
    <td><?php echo $form->labelEx($model,'admission_date'); ?></td>
    <td><?php //echo $form->textField($model,'admission_date');
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Students[admission_date]',
								'model'=>$model,
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>'dd-mm-yy',
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));
		 ?>
		<?php echo $form->error($model,'admission_date'); ?></td>
  </tr>
</table>
<h3>Personal Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'first_name'); ?></td>
    <td><?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?></td>
    <td><?php echo $form->labelEx($model,'middle_name'); ?>
		</td>
    <td><?php echo $form->textField($model,'middle_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'middle_name'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'last_name'); ?></td>
    <td><?php echo $form->textField($model,'last_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?></td>
    <td><?php echo $form->labelEx($model,'batch_id'); ?></td>
    <td>  <?php   $models = Batches::model()->findAll("is_deleted=:x", array(':x'=>'0'));
				$data = array();
				foreach ($models as $model_1)
				{
					$posts=Batches::model()->findByPk($model_1->id);
					$data[$model_1->id] = $posts->course123->course_name.'-'.$model_1->name;
				}
	?>
        
		<?php echo $form->dropDownList($model,'batch_id',$data); ?>
		<?php echo $form->error($model,'batch_id'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'date_of_birth'); ?></td>
    <td><?php //echo $form->textField($model,'date_of_birth');
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'name'=>'Students[date_of_birth]',
								'model'=>$model,
								// additional javascript options for the date picker plugin
								'options'=>array(
									'showAnim'=>'fold',
									'dateFormat'=>'dd-mm-yy',
								),
								'htmlOptions'=>array(
									'style'=>'height:20px;'
								),
							));
		 ?>
		<?php echo $form->error($model,'date_of_birth'); ?></td>
    <td><?php echo $form->labelEx($model,'gender'); ?></td>
    <td><?php //echo $form->textField($model,'gender',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model,'gender',array('M' => 'Male', 'F' => 'Female'),array('empty' => 'Select a gender')); ?>
		<?php echo $form->error($model,'gender'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'blood_group'); ?></td>
    <td><?php //echo $form->textField($model,'blood_group',array('size'=>60,'maxlength'=>255)); ?>
         <?php echo $form->dropDownList($model,'blood_group',
		 							array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+-' => 'AB+', 'AB-' => 'AB-'),
									array('empty' => 'Unknown')); ?>
		<?php echo $form->error($model,'blood_group'); ?></td>
    <td><?php echo $form->labelEx($model,'birth_place'); ?></td>
    <td><?php echo $form->textField($model,'birth_place',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'birth_place'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'nationality_id'); ?></td>
    <td><?php //echo $form->textField($model,'nationality_id'); ?>
        <?php echo $form->dropDownList($model,'nationality_id',CHtml::listData(Countries::model()->findAll(),'id','name')); ?>
		<?php echo $form->error($model,'nationality_id'); ?></td>
    <td><?php echo $form->labelEx($model,'language'); ?></td>
    <td><?php echo $form->textField($model,'language',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'language'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'religion'); ?></td>
    <td><?php echo $form->textField($model,'religion',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'religion'); ?></td>
    <td><?php echo $form->labelEx($model,'student_category_id'); ?></td>
    <td><?php //echo $form->textField($model,'student_category_id'); ?>
        <?php echo $form->dropDownList($model,'student_category_id',CHtml::listData(StudentCategories::model()->findAll(),'id','name')); ?>
		<?php echo $form->error($model,'student_category_id'); ?></td>
  </tr>
 
</table>
<h3>Contact Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'address_line1'); ?></td>
    <td><?php echo $form->textField($model,'address_line1',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address_line1'); ?></td>
    <td><?php echo $form->labelEx($model,'address_line2'); ?></td>
    <td><?php echo $form->textField($model,'address_line2',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address_line2'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'city'); ?></td>
    <td><?php echo $form->textField($model,'city',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?></td>
    <td><?php echo $form->labelEx($model,'state'); ?></td>
    <td><?php echo $form->textField($model,'state',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'state'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'pin_code'); ?></td>
    <td><?php echo $form->textField($model,'pin_code',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pin_code'); ?></td>
    <td><?php echo $form->labelEx($model,'country_id'); ?></td>
    <td><?php //echo $form->textField($model,'country_id'); ?>
        <?php echo $form->dropDownList($model,'country_id',CHtml::listData(Countries::model()->findAll(),'id','name')); ?>
		<?php echo $form->error($model,'country_id'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'phone1'); ?></td>
    <td><?php echo $form->textField($model,'phone1',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone1'); ?></td>
    <td><?php echo $form->labelEx($model,'phone2'); ?></td>
    <td><?php echo $form->textField($model,'phone2',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone2'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'email'); ?></td>
    <td><?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</table>
<h3>Contact Details</h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'photo_file_name'); ?></td>
    <td><?php echo $form->textField($model,'photo_file_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_file_name'); ?></td>
    <td><?php echo $form->labelEx($model,'photo_content_type'); ?>
		</td>
    <td><?php echo $form->textField($model,'photo_content_type',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'photo_content_type'); ?></td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'photo_data'); ?>
		</td>
    <td><?php echo $form->fileField($model,'photo_data'); ?>
		<?php echo $form->error($model,'photo_data'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

	<div class="row">
		<?php //echo $form->labelEx($model,'class_roll_no'); ?>
		<?php echo $form->hiddenField($model,'class_roll_no',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'class_roll_no'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'immediate_contact_id'); ?>
		<?php echo $form->hiddenField($model,'immediate_contact_id'); ?>
		<?php echo $form->error($model,'immediate_contact_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'is_sms_enabled'); ?>
		<?php echo $form->hiddenField($model,'is_sms_enabled'); ?>
		<?php echo $form->error($model,'is_sms_enabled'); ?>
	</div>


	<div class="row">
		<?php //echo $form->labelEx($model,'status_description'); ?>
		<?php echo $form->hiddenField($model,'status_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'status_description'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->hiddenField($model,'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
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
		<?php echo $form->hiddenField($model,'updated_at',array('value'=>date('d-m-Y'))); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'has_paid_fees'); ?>
		<?php echo $form->hiddenField($model,'has_paid_fees'); ?>
		<?php echo $form->error($model,'has_paid_fees'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'photo_file_size'); ?>
		<?php echo $form->hiddenField($model,'photo_file_size'); ?>
		<?php echo $form->error($model,'photo_file_size'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->hiddenField($model,'user_id',array('value'=>'1')); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div style="padding:20px 0 0 0px; text-align:center">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Next Step »' : 'Save',array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->