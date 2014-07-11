<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-subjects-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



    
    <?php 

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('id','',$data,
array('prompt'=>'Select',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('EmployeesSubjects/subject'),
'update'=>'#subject_id',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Subject'; ?>


<?php 
//$data=CHtml::listData(Subjects::model()->findAll(),'id','name');
echo CHtml::activeDropDownList($model,'subject_id',array(),array('prompt'=>'Select','id'=>'subject_id','ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('EmployeesSubjects/current'),
'update'=>'#current',

))); ?>

	<div id="current"></div> 
    
<?php 
$data = CHtml::listData(EmployeeDepartments::model()->findAll(array('order'=>'name DESC')),'id','name');

echo 'Departments';
echo CHtml::dropDownList('did','',$data,
array('prompt'=>'Select',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('EmployeesSubjects/employee'),
'update'=>'#employee_id',
'data'=>'js:$(this).serialize()',
))); 

echo '&nbsp;&nbsp;&nbsp;';


?>

<?php $data1 = CHtml::listData(Employees::model()->findAll(array('order'=>'first_name DESC')),'id','first_name'); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'Select Employee'); ?>
		<?php echo CHtml::activeDropDownList($model,'employee_id',$data1,array('prompt'=>'Select','id'=>'employee_id'));?>
		<?php echo $form->error($model,'employee_id'); ?>
	</div>




	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Assign' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->