<div class="captionWrapper">
	<ul>
    	<li><h2  class="cur">Employee Details</h2></li>
        <li><h2>Employee Contact Details</h2></li>
    </ul>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php if($form->errorSummary($model)){; ?>
    
    <div class="errorSummary">Input Error<br />
    <span>Please fix the following error(s).</span>
    </div>
    
    <?php } ?>
    
<p class="note">Fields with <span class="required">*</span> are required.</p>
<div class="formCon" style="background:#fcf1d4; width:100%; border:0px #fac94a solid; color:#000;background:url(images/yellow-pattern.png); width:100%; border:0p ">

<div class="formConInner" style="padding:5px;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<?php
		$emp_id_1= '';
	 if(Yii::app()->controller->action->id=='create')
			{
			$emp_id	= Employees::model()->findAll(array('order' => 'id DESC','limit' => 1));
			$emp_id_1='E'.($emp_id[0]['id']+1);
			}
			else
			{
				$emp_id	= Employees::model()->findByAttributes(array('id' => $_REQUEST['id']));
				$emp_id_1=$emp_id->employee_number;
			}
			?>
	<?php echo $form->labelEx($model,Yii::t('employees','employee_number')); ?></td>
    <td><?php echo $form->textField($model,'employee_number',array('size'=>20,'maxlength'=>255,'value'=>$emp_id_1)); ?>
		<?php echo $form->error($model,'employee_number'); ?></td>
    
    <td><?php echo $form->labelEx($model,Yii::t('employees','joining_date')); ?></td>
    <td><?php 
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	if($settings!=NULL)
	{
		$date=$settings->dateformat;
		
		
	}
	else
	$date = 'dd-mm-yy';	
	//echo $form->textField($model,'joining_date',array('size'=>30,'maxlength'=>255));
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							//'name'=>'Employees[joining_date]',
							'attribute'=>'joining_date',
							'model'=>$model,
							
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date,
								'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1970:'
							),
							'htmlOptions'=>array(
								//'style'=>'height:20px;'
								'value' => date('m-d-y'),
							),
						))
	
	 ?>
		<?php echo $form->error($model,'joining_date'); ?></td>
   
  </tr>
  </table>
</div>
</div>
<div class="formCon" >

<div class="formConInner">

<h3>General Details</h3>
<table width="75%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="bottom" style="padding-bottom:3px;"><?php echo $form->labelEx($model,Yii::t('employees','first_name')); ?></td>
    
    <td valign="bottom" style="padding-bottom:3px;"><?php echo $form->labelEx($model,Yii::t('employees','middle_name')); ?></td>
   
    <td valign="bottom" style="padding-bottom:3px;"><?php echo $form->labelEx($model,Yii::t('employees','last_name')); ?></td>
  </tr>
  <tr>
    <td valign="top" width="45%"><?php echo $form->textField($model,'first_name',array('size'=>32,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'first_name'); ?></td>
    
    <td valign="top" width="20%"><?php echo $form->textField($model,'middle_name',array('size'=>10,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'middle_name'); ?></td>
   
    <td valign="top"><?php echo $form->textField($model,'last_name',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'last_name'); ?></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','gender')); ?></td>
    <td><?php //echo $form->textField($model,'gender',array('size'=>30,'maxlength'=>255)); ?>
     <?php echo $form->dropDownList($model,'gender',array('M' => 'Male', 'F' => 'Female'),array('empty' =>'Select a gender')); ?>
		<?php echo $form->error($model,'gender'); ?></td>
        <td >&nbsp;</td>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','date_of_birth')); ?></td>
    <td><?php //echo $form->textField($model,'date_of_birth',array('size'=>30,'maxlength'=>255));
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							//'name'=>'Employees[date_of_birth]',
							'attribute'=>'date_of_birth',
							'model'=>$model,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								'dateFormat'=>$date,
								'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1950:'
							),
							'htmlOptions'=>array(
								'style' => 'width:100px;',
							),
						))
	 ?>
		<?php echo $form->error($model,'date_of_birth'); ?></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','employee_department_id')); ?></td>
    <td><?php echo $form->dropDownList($model,'employee_department_id',CHtml::listData(EmployeeDepartments::model()->findAll(),'id','name'),array('empty' => 'Select Department')); ?>
		<?php echo $form->error($model,'employee_department_id'); ?></td>
    <td valign="middle">&nbsp;</td>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','employee_position_id')); ?></td>
    <td valign="middle"><?php echo $form->dropDownList($model,'employee_position_id',CHtml::listData(EmployeePositions::model()->findAll(),'id','name'),array('empty' => 'Select Postition')); ?>
		<?php echo $form->error($model,'employee_position_id'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','employee_category_id')); ?></td>
    <td><?php echo $form->dropDownList($model,'employee_category_id',CHtml::listData(EmployeeCategories::model()->findAll(),'id','name'),array('empty' => 'Select Department')); ?>
		<?php echo $form->error($model,'employee_category_id'); ?></td>
    <td valign="middle">&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','employee_grade_id')); ?></td>
    <td valign="middle"><?php echo $form->dropDownList($model,'employee_grade_id',CHtml::listData(EmployeeGrades::model()->findAll(),'id','name'),array('empty' => 'Select Department')); ?>
		<?php echo $form->error($model,'employee_grade_id'); ?></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','job_title')); ?></td>
    <td><?php echo $form->textField($model,'job_title',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'job_title'); ?></td>
    <td valign="middle">&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','qualification')); ?></td>
    <td valign="middle"><?php echo $form->textField($model,'qualification',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'qualification'); ?></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td valign="bottom"><?php echo $form->labelEx($model,Yii::t('employees','status')); ?></td>
    <td><?php echo $form->textField($model,'status',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'status'); ?></td>
    <td valign="bottom">&nbsp;</td>
    <td><?php echo $form->labelEx($model,Yii::t('employees','total_experience'),array('style'=>'float:left')); ?>&nbsp;<span class="required">*</span></td>
    <td valign="bottom"><?php echo $form->dropDownList($model,'experience_year',array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5
																			  ,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11
																			  ,'12'=>12,'13'=>13,'14'=>14,'15'=>15,'16'=>16,'17'=>17
																			  ,'18'=>18,'19'=>19,'20'=>20),array('empty' => 'Years')); ?>
		<?php echo $form->error($model,'experience_year'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form->dropDownList($model,'experience_month',array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,
																				'6'=>6,'7'=>7,'8'=>8,'9'=>9,'10'=>10,'11'=>11,),array('empty' => 'Months')); ?>
		<?php echo $form->error($model,'experience_month'); ?></td>
  </tr>
  
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td valign="middle" style="padding-bottom:3px;"><?php echo $form->labelEx($model,Yii::t('employees','experience_detail')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" valign="top"><?php echo $form->textArea($model,'experience_detail',array('rows'=>6, 'cols'=>48)); ?>
		<?php echo $form->error($model,'experience_detail'); ?></td>
  
  </tr>
</table>

</div>
</div>

<div class="formCon">

<div class="formConInner">
<h3><?php echo Yii::t('employees','Personal Details');?></h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','marital_status')); ?></td>
    <td><?php echo $form->dropDownList($model,'marital_status',array('Single'=>'Single','Married'=>'Married','Divorced'=>'Divorced')); ?>
		<?php echo $form->error($model,'marital_status'); ?></td>
    <td valign="middle">&nbsp;</td>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','children_count')); ?></td>
    <td valign="middle"><?php echo $form->textField($model,'children_count',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'children_count'); ?></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','father_name')); ?></td>
    <td valign="middle"><?php echo $form->textField($model,'father_name',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'father_name'); ?></td>
    <td valign="middle">&nbsp;</td>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','mother_name')); ?></td>
    <td valign="middle"><?php echo $form->textField($model,'mother_name',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mother_name'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','husband_name')); ?></td>
    <td valign="middle"><?php echo $form->textField($model,'husband_name',array('size'=>15,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'husband_name'); ?></td>
    <td valign="bottom">&nbsp;</td>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','blood_group')); ?></td>
    <td valign="middle"><?php echo $form->dropDownList($model,'blood_group',array('A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'O+' => 'O+', 'O-' => 'O-', 'AB+-' => 'AB+', 'AB-' => 'AB-'),
									array('empty' => 'Unknown')); ?>
		<?php echo $form->error($model,'blood_group'); ?></td>
  </tr>
 
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="middle"><?php echo $form->labelEx($model,Yii::t('employees','nationality_id')); ?></td>
    <td valign="middle"><?php echo $form->dropDownList($model,'nationality_id',CHtml::listData(Countries::model()->findAll(),'id','name'),array(
									'style'=>'width:140px;'
								)); ?>
		<?php echo $form->error($model,'nationality_id'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
</table>
</div>
</div>
<div class="formCon" style=" background:#EDF1D1; border:0px #c4da9b solid; color:#393; background:#EDF1D1 url(images/green-bg.png); border:0px #c4da9b solid; color:#393;  ">

<div class="formConInner" style="padding:10px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	
  <tr>
    <td></td>
    <td> </td>
    <td><?php 
	if($model->photo_data==NULL)
	{
	echo $form->labelEx($model,'upload_photo');
	}
	else
	{
	echo $form->labelEx($model,'Photo');	
	}
	
	 ?>
		</td>
    <td>
	<?php 
       
		if($model->isNewRecord)
		{
			echo $form->fileField($model,'photo_data'); 
		    echo $form->error($model,'photo_data'); 
		}
		else
		{
			if($model->photo_data==NULL)
			{
				echo $form->fileField($model,'photo_data'); 
		        echo $form->error($model,'photo_data'); 
			}
			else
			{
				echo CHtml::link(Yii::t('employees','Remove'), array('Employees/remove', 'id'=>$model->id),array('confirm'=>'Are you sure?')); 
				echo '<img class="imgbrder" src="'.$this->createUrl('DisplaySavedImage&id='.$model->primaryKey).'" alt="'.$model->photo_file_name.'" width="100" height="100" />';
			}
		}
		
		 ?>
        
        </td>
  </tr>

</table>
<div class="row">
		<?php //echo $form->labelEx($model,'photo_file_size'); ?>
		<?php echo $form->hiddenField($model,'photo_file_size'); ?>
		<?php echo $form->error($model,'photo_file_size'); ?>
	</div>

</div>
</div>
<div class="clear"></div>
	<div style="padding:0px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Next Step »' : 'Save',array('class'=>'formbut')); ?>
	</div>


</div>
</div><!-- form -->
<?php $this->endWidget(); ?>