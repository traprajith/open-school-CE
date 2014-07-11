
<?php
$this->breadcrumbs=array(
	'Subjects',
);

?>
<script language="javascript">
function batch()
{
	var id= document.getElementById('batchdrop').value;
	window.location ='index.php?r=courses/subjects&id='+id;
}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1><?php echo  Yii::t('subjects','Subjects');?></h1>
<br />
<div class="formCon">

<div class="formConInner">
<span style="font-size:14px; font-weight:bold; color:#666;">Departments</span>&nbsp;&nbsp;&nbsp;
 <?php   $models = Batches::model()->findAll("is_deleted=:x", array(':x'=>'0'));
				$data = array();
				foreach ($models as $model_1)
				{
					$posts=Batches::model()->findByPk($model_1->id);
					$data[$model_1->id] = $posts->course123->code.'-'.$model_1->name;
				}
	?>
    
    <?php 
		

$data = CHtml::listData(Courses::model()->findAll(array('order'=>'course_name DESC')),'id','course_name');

echo Yii::t('subjects','Course');
echo CHtml::dropDownList('cid','',$data,
array('prompt'=>'-Select-',
'ajax' => array(
'type'=>'POST',
'url'=>CController::createUrl('Weekdays/batch'),
'update'=>'#batchdrop',
'data'=>'js:$(this).serialize()',
))); 
echo '&nbsp;&nbsp;&nbsp;';
echo Yii::t('subjects','Batch');

$data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name DESC')),'id','name');
 ?>
        
		<?php echo CHtml::dropDownList('batch_id','batch_id',$data1,array('empty'=>'-Select-','onchange'=>'batch()','id'=>'batchdrop')); ?>

<?php if(isset($_REQUEST['id']))
{
	echo '<br><br>';
 echo CHtml::ajaxLink(Yii::t('job','Add Normal subject'),$this->createUrl('subjects/Addnew'),array(
        'onclick'=>'$("#jobDialog").dialog("open"); return false;',
        'update'=>'#jobDialog',
		'type' =>'GET','data' => array( 'val1' => $_REQUEST['id'] ),'dataType' => 'text',
        ),array('id'=>'showJobDialog'));
		echo '<br><br>';
		$normal = Subjects::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['id'],'elective_group_id'=>NULL));
		if(count($normal)>0)
		{
			?>
            
       <div class="tableinnerlist">
          <table width="50%">  
         <?php   
		foreach($normal as $normal_1)
		{
			echo '<tr>';
			echo '<td>'.$normal_1->name.'</td>';
			echo '<td>'.Yii::t('subjects','Edit').'</td>';
			echo '<td>'.Yii::t('subjects','Delete').'</td>';
			echo '</tr>';
		}
		?>
        </table>
        </div>
        <?php
		}
		else {
		echo Yii::t('subjects','No Subjects Found');	
		}
		echo '<br>';
        
         //echo CHtml::link('New Elective Group', array('electiveGroups/create','id'=>$_REQUEST['id']));
		  echo '<br><br>';
		 echo '<br>';

 /*echo CHtml::ajaxLink(Yii::t('job','Add Subject'),$this->createUrl('subjects/Addnew1'),array(
        'onclick'=>'$("#jobDialog1").dialog("open"); return false;',
        'update'=>'#jobDialog1',
		'type' =>'GET','data' => array( 'val1' => $_REQUEST['id'] ),'dataType' => 'text',
        ),array('id'=>'showJobDialog1'));*/
		 echo '<br><br>';
		//Elective
		$elective = Subjects::model()->findAllByAttributes(array('batch_id'=>$_REQUEST['id'],'elective_group_id'=>1));
		if(count($elective)>0)
		{
			?>
            <div class="tableinnerlist">
          <table width="50%">  
         <?php   
		foreach($elective as $elective_1)
		{
			echo '<tr>';
			echo '<td>'.$elective_1->name.'</td>';
			echo '<td>'.Yii::t('subjects','Edit').'</td>';
			echo '<td>'.Yii::t('subjects','Delete').'</td>';
			echo '</tr>';
		}
		?>
        </table>
        </div>
        <?php
		}
		echo '<br>';
		
	
}
?>
<div id="jobDialog"></div>
        <div id="jobDialog1"></div>	
 </div>
 </div>
 </div>
    </td>
  </tr>
</table>
</div>
