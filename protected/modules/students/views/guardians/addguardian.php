<?php
$this->breadcrumbs=array(
	Yii::t('app','Guardians')=>array('admin'),
	Yii::t('app','Guardian Details'),
);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guardians-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
//echo Yii::app()->controller->action->id;
	//$guardian = Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
	$posts=  GuardianList::model()->findAll("student_id=:x", array(':x'=>$_REQUEST['id']));

 ?>
 <h1><?php echo Yii::t('app','New Admission');?></h1>
 
<div class="captionWrapper">
  <ul>
    	<li><h2 ><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Student Details'),array('students/update','id'=>$_REQUEST['id'],'status'=>0)); } else{ echo Yii::t('app','Student Details'); } ?></h2></li>
        <li><h2 ><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Parent Details'),array('guardians/create','id'=>$_REQUEST['id'])); } else{ echo Yii::t('app','Parent Details'); } ?></h2></li>
        <li><h2 class="cur" ><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Emergency Contact'),array('guardians/addguardian','id'=>$_REQUEST['id'])); } else { echo Yii::t('app','Emergency Contact'); } ?></h2></li>
        <li><h2 ><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Previous Details'),array('studentPreviousDatas/create','id'=>$_REQUEST['id'])); } else { echo Yii::t('app','Previous Details'); }?></h2></li>
        <li><h2><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Student Documents'),array('studentDocument/create','id'=>$_REQUEST['id'])); } else { echo Yii::t('app','Student Documents'); }?></h2></li>
        <li class="last"><h2><?php if(isset($_REQUEST['id'])){ echo CHtml::link(Yii::t('app','Student Profile'),array('students/view','id'=>$_REQUEST['id'])); } else{ echo Yii::t('app','Student Profile'); } ?></h2></li>
    </ul>
</div>
<div class="formCon">

<div class="formConInner">
  <h3><?php echo Yii::t('app','Emergency Contact'); ?></h3>
<div class="tableinnerlist">
 <table width="96%" cellpadding="0" cellspacing="0">
 <tr>
  <th width="10%"></th>
  <th width="20%"><?php echo Yii::t('app','Guardian Name');?></th>
  <th width="70%"><?php echo Yii::t('app','Relationship');?></th>
 </tr>
 <?php
 if($posts)
 {
     $smodel=Students::model()->findByPk($_REQUEST['id']);
     $contact_id= $smodel->immediate_contact_id;
     
  echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['id']));
  $count=0;
 foreach($posts as $posts_1)
 {
    $checked="";    
    if($contact_id == $posts_1->guardian_id)
     {
         $checked="checked";
     }    
     $guard_model= Guardians::model()->findByPk($posts_1->guardian_id);
         
	 echo '<tr>';
	 echo '<td>'.
	 $form->radioButton($model, 'immediate_contact_id',array('value'=>$posts_1->guardian_id,'uncheckValue'=>null,'checked'=>$checked)).
          '</td>';
         echo '<td>'.$guard_model->first_name.'</td>';
	 echo '<td>'.$posts_1->relation.'</td>';
	 echo '</tr>';
         $count= $count+1;
 }
 
 }
 else
 {
     echo '<tr><td colspan="3">'.Yii::t('app','No Guardians Found').'</td></tr>';
 }

?>
</table>
</div>
  
    <div class="clear"></div>
    <br />
    <!-- dynamic fields -->
    <?php
    $fields     = FormFields::model()->getDynamicFields(3, 1, "forAdminRegistration");
    foreach ($fields as $key => $field) {
        if($field->form_field_type!=NULL){
            $this->renderPartial("application.modules.dynamicform.views.fields.admin-form._field_".$field->form_field_type, array('model'=>$model, 'field'=>$field));                                                
        }                                               
    }
    ?>
    <!-- dynamic fields -->
    <div class="clear"></div>
</div>
 	</div>
    <div class="clear"></div>
    <div style="padding:0px 0 0 0px; text-align:left;">
<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Previous Details') : Yii::t('app','Save'),array('class'=>'formbut'));
?></div>
  
<div style="position:absolute; right:30px;bottom:35px;">
<?php  echo CHtml::link(Yii::t('app',"Skip"),array('studentPreviousDatas/create','id'=>$_REQUEST['id']),array('class'=>'formbut')); ?>
</div>
<?php $this->endWidget(); ?>
     	</div>
    </td>
  </tr>
</table>