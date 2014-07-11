<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->id,
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
<?php $this->renderPartial('profileleft');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1 ><?php echo Yii::t('employees','Employee Profile : ');?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
<div class="edit_bttns">
    <ul>
    <li><?php echo CHtml::link(Yii::t('employees','<span>Edit</span>'), array('update', 'id'=>$_REQUEST['id']),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
     <li><?php echo CHtml::link(Yii::t('employees','<span>Employees</span>'), array('employees/manage'),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
    </ul>
    </div>
    
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <div class="emp_tab_nav">
    <ul style="width:698px;">
    <li><?php echo CHtml::link(Yii::t('employees','Profile'), array('view', 'id'=>$_REQUEST['id'])); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Address'), array('address', 'id'=>$_REQUEST['id']),array('class'=>'active')); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Contact'), array('contact', 'id'=>$_REQUEST['id'])); ?></li>
     <li><?php echo CHtml::link(Yii::t('employees','Additional Info'), array('addinfo', 'id'=>$_REQUEST['id'])); ?></li>
    </ul>
    </div>
    <div class="clear"></div>
 <div class="emp_cntntbx">
    <div class="table_listbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('employees','Address');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home Address Line 1');?></td>
    <td class="subhdng_nrmal"><?php echo $model->home_address_line1; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office Address Line 1');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_address_line1; ?></td>
  </tr>

  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home Address Line 2');?></td>
    <td class="subhdng_nrmal"><?php echo $model->home_address_line2; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office Address Line 2');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_address_line2; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home City');?> </td>
    <td class="subhdng_nrmal"><?php echo $model->home_city; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office City');?> </td>
    <td class="subhdng_nrmal"><?php echo $model->office_city; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home state');?></td>
    <td class="subhdng_nrmal"><?php echo $model->home_state; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office state');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_state;?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home Country');?></td>
    <td class="subhdng_nrmal"><?php 
	$count = Countries::model()->findByAttributes(array('id'=>$model->home_country_id));
	if(count($count)!=0)
	echo $count->name; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office Country');?></td>
    <td class="subhdng_nrmal"><?php
		$count_1 = Countries::model()->findByAttributes(array('id'=>$model->office_country_id));
	if(count($count_1)!=0)	
	 echo $count_1->name; ?>
	</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Home PIN');?></td>
    <td class="subhdng_nrmal"><?php echo $model->home_pin_code; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office PIN');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_pin_code; ?></td>
  </tr>
  </table>
  <div class="ea_pdf" style="top:4px; right:6px;"><?php //echo CHtml::link('<img src="images/pdf-but.png">', array('Employees/pdf','id'=>$_REQUEST['id'])); ?></div>
   
 </div>
 
 </div>
</div>
</div>
</div>
    
    </td>
  </tr>
</table>