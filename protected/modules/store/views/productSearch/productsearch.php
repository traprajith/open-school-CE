<?php
$this->breadcrumbs=array(
	'Books'=>array('/store'),
	'ProductSearch',
);?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

 
<div id="parent_Sect">
   <?php $this->renderPartial('/default/left_side');?>
    
    <div id="parent_rightSect">
        	<div class="parentright_innercon">
            	<h1>Product List</h1>
                <div class="profile_details">
        	<div class="form_wrapper " >
    <div class="formConInner">
  
    <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
 
    <td align="right" style="padding-right:5px;">
    
    <?php
echo CHtml::label(Yii::t('store','Search Product by'),'').'</td><td style="padding-right:10px;">'; 
echo CHtml::dropDownList('search','',array('1'=>'brand'),array('prompt'=>'Select','id'=>'search_id')).'</td><td>';
echo CHtml::textField('text','');
?>

<input type="submit" value="search" class="formbut" />
</td>
 </tr>
</table>
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
		$cat=StoreCategory::model()->findByAttributes(array('id'=>$list_1->ca_name));
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
</table>
</div>
</div>
</td>
</tr>
</table>
    <?php
	}

  ?>

</div>

 	</div>
    
     <div class="clear"></div> 
     </div>
     <div class="clear"></div> 
    </div>
     <?php } else { ?>
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
    <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
 
    <td align="right" style="padding-right:5px;">
 

<?php
echo CHtml::label(Yii::t('store','Search Product by'),'').'</td><td style="padding-right:10px;">'; 
echo CHtml::dropDownList('search','',array('1'=>'brand'),array('prompt'=>'Select','id'=>'search_id')).'</td><td>';
echo CHtml::textField('text','');
				
				
?>

<input type="submit" value="search" class="formbut" />
</td>
 </tr>
</table>
</div>
</div>
<?php

if(isset($list))
{
	 if($list==NULL)
		{
			echo '<div align="center">'.Yii::t('library','<strong>OOPS!!&nbsp;Its an invalid search.Try again..</strong>').'</div>';
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
		$cat=StoreCategory::model()->findByAttributes(array('id'=>$list_1->ca_name));
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
</table>
</div>
</div>
</td>
</tr>
</table>
    <?php
	}
}
  }
?>
          <?php $this->endWidget(); ?>