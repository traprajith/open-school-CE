<?php
$this->breadcrumbs=array(
	'Products'=>array('/store'),
	'ProductSearch',
);?>




 <?php echo $test; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <?php $this->renderPartial('/default/left_side');?>
 </td>
    <td valign="top">
    <div class="cont_right">
    <h1><?php echo Yii::t('store','Search Products');?></h1>
    <div class="formCon" >
    <div class="formConInner">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

 

<?php
echo CHtml::label(Yii::t('store','Search Product by'),''); 
echo CHtml::dropDownList('search','',array('1'=>'brand'),array('prompt'=>'Select','id'=>'search_id'));
echo CHtml::textField('text','');
				
				
?>

<input type="submit" value="search" class="formbut" />

<?php $this->endWidget(); ?>
</div>
</div>
<?php

if(isset($list))
{
	 if($list==NULL)
		{
			echo '<div align="center">'.Yii::t('store','<strong>OOPS!!&nbsp;Its an invalid search.Try again..</strong>').'</div>';
		}
		else
		{
	
	?>
    
    <div class="pdtab_Con" style="padding-top:10px;">
     <table width="100%" cellpadding="0" cellspacing="0" border="0" >
<tr class="pdtab-h">
<th align="center"><?php echo Yii::t('store','Product Name');?></th>
<th align="center"><?php echo Yii::t('store','Product Brand');?></th>
<th align="center"><?php echo Yii::t('store','Product Quantity');?></th>
<th align="center"><?php echo Yii::t('store','Product Category');?></th>
<th align="center"><?php echo Yii::t('store','Price');?></th>
</tr>
<?php
foreach($list as $list_1)
	{
		$cat=StoreCategory::model()->findByAttributes(array('ca_id'=>$list_1->c_id));
	?>
<tr>
<td align="center"><?php echo $list_1->product_name;?></td>
<td align="center"><?php echo $list_1->product_brand;?></td>
<td align="center"><?php echo $list_1->product_quantity;?></td>
<td align="center"><?php 
if($cat!=NULL)
{
echo CHtml::link($cat->ca_name,array('/store/storeCategory','id'=>$cat->ca_id));
}
?></td>
<td align="center"><?php echo $list_1->price;?></td>
</tr>
<?php } ?>
</table></div>
</div>

</td>
</tr>
</table>
    <?php
	}
}
 
?>
          