<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher')=>array('index'),
	Yii::t('app','Additional Information'),
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
     <li><?php echo CHtml::link('<span>'.Yii::t('app','Teacher').'</span>', array('employees/manage'),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
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
    <td><?php echo Yii::t('app','Additional Info');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Marital Status');?></td>
    <td class="subhdng_nrmal"><?php echo $model->marital_status; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Date of Birth');?></td>
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
    <td class="listbx_subhdng"><?php echo Yii::t('app','Children Count');?></td>
    <td class="subhdng_nrmal"><?php echo $model->children_count; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Office Phone2');?></td>
    <td class="subhdng_nrmal"><?php echo $model->office_phone2; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Father Name');?></td>
    <td class="subhdng_nrmal"><?php echo $model->father_name; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Mother Name');?></td>
    <td class="subhdng_nrmal"><?php echo $model->mother_name; ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Blood Group');?></td>
    <td class="subhdng_nrmal"><?php echo $model->blood_group; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Nationality');?></td>
    <td class="subhdng_nrmal"><?php
	$count = Nationality::model()->findByAttributes(array('id'=>$model->nationality_id));
			if(count($count)!=0)
	 echo $count->name;
	  ?>
    </td>
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