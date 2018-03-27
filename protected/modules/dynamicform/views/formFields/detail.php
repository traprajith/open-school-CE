<?php
$this->breadcrumbs=array(
    Yii::t('app','Settings')=>array('/configurations'),
	Yii::t('app','Form Field')=>array('/dynamicform/formFields/list'),
	Yii::t('app','View'),
);


?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    <?php $this->renderPartial('/default/left_side');?>
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
    
    <h1 style="margin-top:.67em;"><?php echo Yii::t('app','Field Details');?> <br /></h1>    

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
    <ul><li><?php echo CHtml::link('<span>'.Yii::t('app','Back').'</span>', array('list'), array('class'=>'a_tag-btn')); ?></li>
    <li><?php 
    if($model->is_dynamic==1)
    {
        echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('dynamic','id'=>$model->id) ,array('class'=>'a_tag-btn')); 
    }
    else
    {
        echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update','id'=>$model->id) ,array('class'=>'a_tag-btn')); 
    }
        ?></li>
    </ul>    
    </div> 
    </div>  
    <div class="emp_right_contner">    
    <div class="table_listbx">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('app','General');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Title');?></td>
    <td class="subhdng_nrmal"><?php echo $model->title; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Required');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->required); ?></td>  
  </tr>
<!--  <tr>
    <td class="listbx_subhdng"><?php //echo Yii::t('app','Field Type');?></td>
    <td class="subhdng_nrmal"><?php //echo $model->field_type; ?></td>
    <td class="listbx_subhdng"><?php //echo Yii::t('app','Field Size');?></td>
    <td class="subhdng_nrmal"><?php //echo $model->field_size; ?></td>
  </tr>-->
  <!--<tr>    
    <td class="listbx_subhdng"><?php echo Yii::t('app','Model');?></td>
    <td class="subhdng_nrmal"><?php echo $model->model; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Order');?></td>
    <td class="subhdng_nrmal"><?php echo $model->required; ?></td>
  </tr> -->
  
  <tr>
    
    
  </tr>
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('app','Portal Details');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Admin Student Registration Form');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->admin_student_reg_form); ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Online Admission Form');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->online_admission_form); ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Student Profile PDF');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->student_profile_pdf); ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Student Profile');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->student_profile); ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Student Portal');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->student_portal); ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Parent Portal');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->parent_portal); ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('app','Teacher Portal');?></td>
    <td class="subhdng_nrmal"><?php echo FormFields::Status($model->teacher_portal); ?></td>
	<td></td>
	<td></td>
    
  </tr>

  
    
  <!--</tr>-->
  </table>

 
    </div>
    
    
    </div>
    </div>
   
    </td>
  </tr>
</table>