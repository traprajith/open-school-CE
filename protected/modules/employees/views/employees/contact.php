<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher')=>array('index'),
	Yii::t('app','Contact'),
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
 <?php $this->renderPartial('profileleft');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1 ><?php echo Yii::t('app','Teacher Profile :');?><?php echo Employees::model()->getTeachername($model->id); ?><br /></h1>
<div class="edit_bttns">
    <ul>
    <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$_REQUEST['id']),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
     <li><?php echo CHtml::link('<span>'.Yii::t('app','Teachers').'</span>', array('employees/manage'),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
    </ul>
    </div>
    
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <div class="emp_tab_nav">
    <?php $this->renderPartial('tab');?>
   </div>
    <div class="clear"></div>
 <div class="emp_cntntbx">
    <div class="table_listbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('app','Contact');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Home Phone');?></td>
    <td class="subhdng_nrmal"><?php echo $model->home_phone; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Office Phone1');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_phone1; ?></td>
  </tr>

  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Mobile Number');?></td>
    <td class="subhdng_nrmal"><?php echo $model->mobile_phone; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Office Phone2');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_phone2; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Email');?></td>
    <td class="subhdng_nrmal"><?php echo $model->email; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Fax');?></td>
    <td class="subhdng_nrmal"><?php echo $model->fax; ?></td>
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