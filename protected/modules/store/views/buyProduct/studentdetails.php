<?php
$this->breadcrumbs=array(
	'Buy Products'=>array('/store'),
	'StudentDetails',
);
?>

<script language="javascript">
function productlist()
{
	var val=document.getElementById('student_id').value;
	window.location = "index.php?r=store/buyProduct/studentdetails&id="+val;
}

</script>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buy-product-form',
	'enableAjaxValidation'=>false,
)); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <?php $this->renderPartial('/default/left_side');?>
 </td>
    <td valign="top">
     <div class="cont_right">  
     <h1><?php echo Yii::t('store','View Student Details');?></h1>
     <div class="formCon">
    <div class="formConInner">
<?php echo Yii::t('store','<strong>Select Student ID</strong>').'&nbsp;';
echo CHtml::dropDownList('Book ID',isset($_REQUEST['id'])? $_REQUEST['id'] : '',CHtml::listData(BuyProduct::model()->findAll(array('group'=>'student_id')),'student_id','student_id'),
				array('prompt'=>'select', 'onchange'=>"javascript:productlist();", 'id'=>'student_id'));
                     
                        if(isset($_REQUEST['id']))
						{
							$product=BuyProduct::model()->findAll('student_id=:t2',array(':t2'=>$_REQUEST['id']));
							$student=Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
							
							if($product!=NULL)
							{
								
								
								
						?>
                        </div>
                        </div>
                        <div class="pdtab_Con" style="padding:0px;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0" >
<tr class="pdtab-h">
<td align="center"><?php echo Yii::t('store','Student Name');?></td>
<td align="center"><?php echo Yii::t('store','Product Name');?></td>
<td align="center"><?php echo Yii::t('store','Product Brand');?></td>
<td align="center"><?php echo Yii::t('store','Quantity');?></td>
<td align="center"><?php echo Yii::t('store','Price');?></td>
</tr>
<?php foreach($book as $book_1)
{
	
?>
<tr>

<td align="center"><?php echo $student->first_name.' '.$student->last_name;?></td>
<td align="center"><?php echo $product->pr_name;?></td>
<td align="center"><?php echo $product->pr_brand;?></td>

<td align="center"><?php 
if($author!=NULL)
{
echo CHtml::link($author->author_name,array('/library/authors/authordetails','id'=>$author->auth_id));
}
?></td>


</tr>
<?php }
				} 
				else
				{
					echo '<tr><td colspan="5">'.Yii::t('library','No data available').'</td></tr>';
				}
				 ?>
</table>
</div>
</div>
</td>
</tr>
</table>
<?php } ?>
<?php $this->endWidget(); ?>

