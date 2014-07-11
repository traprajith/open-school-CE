
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subjects-form',
	'enableAjaxValidation'=>true,
)); 

?>

<script language="javascript">
function batch()
{
	var id= document.getElementById('batchdrop').value;
	window.location ='index.php?r=batches/batchstudents&id='+id;
}
</script>
<?php $data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo 'Course';
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'-Select-',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Weekdays/batch'),
'update'=>'#batchdrop',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo 'Batch';

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
 ?>
        
		<?php echo CHtml::dropDownList('batch_id','batch_id',$data1,array('empty'=>'-Select-','onchange'=>'batch()','id'=>'batchdrop')); ?>

	<?php $this->endWidget(); ?>
