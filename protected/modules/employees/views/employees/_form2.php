


<div class="captionWrapper">
	<?php $this->renderPartial('application.modules.employees.views.employees.createtab');?>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payslip-form',
	'enableAjaxValidation'=>true,	
)); ?>

	<p class="note"><?php echo Yii::t('app','Fields with'); ?> <span class="required">*</span><?php echo Yii::t('app','are required.'); ?> </p>
<div class="formCon">

<div class="formConInner">


<?php /*?>	<?php if($form->errorSummary($model)){; ?>
    
    <div class="errorSummary">Input Error<br />
    <span>Please fix the following error(s).</span>
    <?php echo $form->errorSummary($model);?>
    </div>
    <?php } ?><?php */?>
<h3><?php echo Yii::t('app','Payslip Details'); ?></h3>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,'date_join'); ?>
		</td>
    <td><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							//'name'=>'date_join',
							'attribute'=>'date_join',
							'model'=>$model,
							
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								//'dateFormat'=>$date,
								'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1970:2030'
							),
							'htmlOptions'=>array(
							'placeholder'=>'mm-dd-yyyy',
							'readonly'=>'readonly',
								//'style'=>'height:20px;'
								//'value' => date('m-d-y'),
							),
						))
	
	 ?>	
	
	
		<?php echo $form->error($model,'date_join'); ?></td>
        
        
         <td><?php echo $form->labelEx($model,'salary_date'); ?>
		</td>
    <td><?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
							//'name'=>'date_join',
							'attribute'=>'salary_date',
							'model'=>$model,
							
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
								//'dateFormat'=>$date,
								'changeMonth'=> true,
									'changeYear'=>true,
									'yearRange'=>'1970:2030'
							),
							'htmlOptions'=>array(
							'placeholder'=>'mm-dd-yyyy',
							'readonly'=>'readonly',
								//'style'=>'height:20px;'
								//'value' => date('m-d-y'),
							),
						))
	
	 ?>	
		<?php echo $form->error($model,'salary_date'); ?></td>
      
  </tr>
  <tr>
   	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'bank_name'); ?></td>
   <td><?php echo $form->dropDownList($model,'bank_name',
          array('Axis Bank ltd.'=>'Axis Bank ltd.','American Express Banking Corporation'=>'American Express Banking Corporation','Bank of America'=>'Bank of America','Calyon Bank'=>'Calyon Bank','Citibank'=>'Citibank','J P Morgan Chase Bank'=>'J P Morgan Chase Bank',
		  		'Standard Chartered Bank '=>'Standard Chartered Bank',' ICICI Bank ltd'=>' ICICI Bank ltd',' IndusInd Bank ltd'=>'IndusInd Bank ltd',
				' HDFC Bank Lt'=>' HDFC Bank Lt','Yes Bank ltd'=>'Yes Bank ltd', 
		  'Other'=>'Other',),array('prompt'=>Yii::t('app','Select'),'style'=>'width:189px !important;')); ?>
		<?php echo $form->error($model,'bank_name'); ?></td>
        
        
        
    <td><?php echo $form->labelEx($model,'bank_acc_no'); ?>
		</td>
    <td><?php echo $form->textField($model,'bank_acc_no',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'bank_acc_no'); ?></td>
      
  </tr>
  
  <tr>
   	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
   	<td colspan="4"><?php echo Yii::t('app','Earnings'); ?></td>
    
  </tr>
  
  <tr>
    <td><?php echo $form->labelEx($model,'basic_pay'); ?>
		</td>
    <td><?php echo $form->textField($model,'basic_pay',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'basic_pay'); ?></td>
        
        
        
    <td><?php echo $form->labelEx($model,'HRA'); ?>
		</td>
    <td><?php echo $form->textField($model,'HRA',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'HRA'); ?></td>
    </tr><tr>    
    <td><?php echo $form->labelEx($model,'DA'); ?>
		</td>
    <td><?php echo $form->textField($model,'DA',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'DA'); ?></td>
        
    <td><?php echo $form->labelEx($model,'others1'); ?>
		</td>
    <td><?php echo $form->textField($model,'others1',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'others1'); ?></td>   
     
      
  </tr>
  
  <tr>
   	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
   	<td colspan="4"><?php echo Yii::t('app','Dedections'); ?></td>
    
  </tr>
  <tr>
    <td><?php echo $form->labelEx($model,'PF'); ?>
		</td>
    <td><?php echo $form->textField($model,'PF',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'PF'); ?></td>
        
        
        
    <td><?php echo $form->labelEx($model,'TDS'); ?>
		</td>
    <td><?php echo $form->textField($model,'TDS',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'TDS'); ?></td>
      
  </tr>
   <tr>
   <td><?php echo $form->labelEx($model,'others2'); ?>
		</td>
    <td><?php echo $form->textField($model,'others2',array('size'=>25,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'others2'); ?></td>  
   </tr>
 
  <tr>
  	<td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
<!-- form -->
	<!-- Hidden Values Ends -->
<tr>
	<div style="padding:0px 0 0 0px; text-align:left">
<td>		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Finish') : Yii::t('app','Save'),array('class'=>'formbut')); ?></td>
	</div>
</tr>
<?php $this->endWidget(); ?>
</table></div>
</div>
