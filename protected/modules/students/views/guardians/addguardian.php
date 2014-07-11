<?php
$this->breadcrumbs=array(
	'Guardians'=>array('admin'),
	'Guardian Details',
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
	$guardian = Students::model()->findByAttributes(array('id'=>$_REQUEST['id']));
	$posts=Guardians::model()->findAll("id=:x", array(':x'=>$guardian->parent_id));

 ?>
 <h1><?php echo Yii::t('students','New Admission');?></h1>
 
<div class="captionWrapper">
  <ul>
    	<li><h2 >Student Details</h2></li>
        <li><h2 >Parent Details</h2></li>
        <li><h2 class="cur">Emergency Contact</h2></li>
        <li><h2>Previous Details</h2></li>
        <li class="last"><h2>Student Profile</h2></li>
    </ul>
</div>
<div class="formCon">

<div class="formConInner">
<div class="tableinnerlist">
 <table width="96%" cellpadding="0" cellspacing="0">
 <tr>
  <th width="23%"><?php echo Yii::t('students','Guardian Name');?></th>
  <th width="77%"><?php echo Yii::t('students','Relationship');?></th>
 </tr>
 <?php
  echo $form->hiddenField($model,'ward_id',array('value'=>$_REQUEST['id']));
 foreach($posts as $posts_1)
 {
	 echo '<tr>';
	 echo '<td>'.
	  $form->radioButton($model, 'radio',array($posts_1->id => CHtml::link($posts_1->first_name, array('guardians/view', 'id'=>$posts_1->id)))).
          '</td>';
	 echo '<td>'.$posts_1->relation.'</td>';
	 echo '</tr>';
 }

?>
</table>
</div>
</div>
 	</div>
    <div class="clear"></div>
    <div style="padding:0px 0 0 0px; text-align:left;">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Previous Details »' : 'Save',array('class'=>'formbut')); ?></div>
<?php $this->endWidget(); ?>
     	</div>
    </td>
  </tr>
</table>