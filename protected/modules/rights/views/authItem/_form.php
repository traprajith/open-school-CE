<div class="form span-12 first">

<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>
	
<?php $form=$this->beginWidget('CActiveForm'); ?>
<div class="O-box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><?php echo $form->labelEx($model, 'name'); ?></td>
    <td><?php echo $form->textField($model, 'name', array('maxlength'=>255,'size'=>30, 'class'=>'txtfld')); ?>
		<?php echo $form->error($model, 'name'); ?></td>
  </tr>
  <tr>
    <td colspan="2"><p class="hint"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></p></td>
    </tr>
  <tr>
    <td><?php echo $form->labelEx($model, 'description'); ?></td>
    <td><?php echo $form->textField($model, 'description', array('maxlength'=>255,'size'=>30, 'class'=>'txtfld')); ?>
		<?php echo $form->error($model, 'description'); ?></td>
  </tr>
 
  <tr>
    <td colspan="2"><p class="hint"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></p></td>
   
  </tr>
  <?php if( Rights::module()->enableBizRule===true ): ?>
  <tr>
    <td><?php echo $form->labelEx($model, 'bizRule'); ?></td>
    <td><?php echo $form->textField($model, 'bizRule', array('maxlength'=>255,'size'=>30,'class'=>'txtfld')); ?>
			<?php echo $form->error($model, 'bizRule'); ?></td>
  </tr>
  <tr>
    <td colspan="2"><p class="hint"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></p></td>
    
  </tr>
  <?php endif; ?>
  <?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>
  <tr>
    <td>	<?php echo $form->labelEx($model, 'data'); ?></td>
    <td><?php echo $form->textField($model, 'data', array('maxlength'=>255,'size'=>30, 'class'=>'txtfld')); ?>
			<?php echo $form->error($model, 'data'); ?></td>
  </tr>
  <tr>
  	<td colspan="2"><p class="hint"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></p></td>
  </tr>
</table>

	<?php endif; ?>
</div>
<div style="padding-top:10px;">
		<?php echo CHtml::submitButton(Rights::t('core', 'Save'),array('class'=>'formbut')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl,array('class'=>'greenbutton')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>