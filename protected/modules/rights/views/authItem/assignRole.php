<?php $this->breadcrumbs = array(
	//'Rights'=>Rights::getBaseUrl(),
	Yii::t('app', 'Settings')=>array('/configurations'),
	Yii::t('app', 'User Roles'),
	Yii::t('app', 'Create New Role')=>array('authItem/assignrole'),	
);?>

<?php 

$heading = 0 ;

if(isset($_GET['id']) and $_GET['id']!=NULL)
{
	$heading = 1 ;
?>
<h1><?php echo Yii::t('app', 'Assign Role'); ?></h1>

<?php $form1=$this->beginWidget('CActiveForm', array(
	'id'=>'user-roles-assign-form',
	'enableAjaxValidation'=>false,
)); ?>

<div style="margin-bottom:10px;"><?php echo $form1->errorSummary($role); ?></div>

<div class="formCon">
	<div class="formConInner">
	

	<p class="note"><?php echo Yii::t('app','Fields with').'<span class="required">'.'*'.'</span>'.Yii::t('app','are required.');?></p>

	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo $form1->dropDownList($role,'name',CHtml::listData(UserRoles::model()->findAll(),'name','name'),array(
                        'style'=>'width:140px;','empty'=>Yii::t('app','Select Role')
                        )); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo CHtml::submitButton(Yii::t('app','Save'),array('class'=>'formbut')); ?></td>
      </tr>
    </table>


</div>
</div>
<?php $this->endWidget(); ?>
<div class="or_con"><div class="or_txt"><?php echo Yii::t('app','OR'); ?></div></div>


<?php } ?>

<h1>
<?php if($heading==1)
{
	echo Yii::t('app', 'Create New Role and Assign');
}
else
{
	echo Yii::t('app', 'Create New Role');
}

?>
</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-roles-create-assign-form',
	'enableAjaxValidation'=>false,
)); ?>

<div style="margin-bottom:10px;">
<?php echo $form->errorSummary($model); ?></div>
<div class="formCon">	
<div class="formConInner">
	

	<p class="note"><?php echo Yii::t('app','Fields with').'<span class="required">'.' * '.'</span>'.Yii::t('app','are required.');?></p>
    <p class="note"><?php echo Yii::t('app','Some modules are interrelated');?></p>

	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'name'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'description'); ?></td>
    <td>&nbsp;</td>
    <td><?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>120,'style'=>'width:58%!important')); ?>
		<?php echo $form->error($model,'description'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  
    <td colspan="3"><div class="checkboxlist"><ul>
	<?php 
	
	$modulenames = CHtml::listData(Modules::model()->findAll(array('condition'=>'control=:control','params'=>array(':control'=>1))),'id','name');
	
	
	foreach($modulenames as $key=>$modulename)
	{
		$modulenames[$key]= Yii::t('app',$modulename);
	}
	
	
	echo $form->checkBoxList($model, 'modules', $modulenames, array('checkAll'=>Yii::t('app','Select All'),'separator'=>'','template'=>'<li>{input}&nbsp;{label}<li>')); ?>
    </ul>
    <div class="clear"></div>
    </div></td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Save'),array('class'=>'formbut')); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>
</div>

<?php $this->endWidget(); ?>