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
<h1 ><?php echo Yii::t('employees','Employee Profile :');?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
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
    <li><?php echo CHtml::link(Yii::t('employees','Address'), array('address', 'id'=>$_REQUEST['id'])); ?></li>
   <li><?php echo CHtml::link(Yii::t('employees','Contact'), array('contact', 'id'=>$_REQUEST['id'])); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Additional Info'), array('addinfo', 'id'=>$_REQUEST['id']),array('class'=>'active')); ?></li>
    </ul>
    </div>
    <div class="clear"></div>
 <div class="emp_cntntbx">
    <div class="table_listbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('employees','Additional Info');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Marital Status');?></td>
    <td class="subhdng_nrmal"><?php echo $model->marital_status; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Date of Birth');?></td>
    <td class="subhdng_nrmal"><?php 
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										if($settings!=NULL)
										{	
											$date1=date($settings->displaydate,strtotime($model->date_of_birth));
											echo $date1;
		
										}
										else
										echo $model->date_of_birth; 
										?></td>
  </tr>

  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Children Count');?></td>
    <td class="subhdng_nrmal"><?php echo $model->children_count; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Office Phone2');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_phone2; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Father Name');?></td>
    <td class="subhdng_nrmal"><?php echo $model->father_name; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Mother Name');?></td>
    <td class="subhdng_nrmal"><?php echo $model->mother_name; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Blood Group');?></td>
    <td class="subhdng_nrmal"><?php echo $model->blood_group; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Nationality');?></td>
    <td class="subhdng_nrmal"><?php
	$count = Countries::model()->findByAttributes(array('id'=>$model->nationality_id));
	if(count($count)!=0)
	 echo $count->name; ?></td>
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