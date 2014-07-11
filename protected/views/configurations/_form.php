<div class="formCon">

<div class="formConInner">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configurations-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?><br />
    <?php
	 $usersettings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php //echo $form->labelEx($model,'config_key'); ?>
        <?php echo Yii::t('settings','School / College Name');?> </td>
    <td> <?php 
		$val_1 = $model->findByPk(1);
		echo CHtml::textField('collegename',$val_1->config_value,array()); ?></td>
    <td><?php echo Yii::t('settings','School/College Address');?></td>
    <td><?php 
		$val_2 = $model->findByPk(2);
		echo CHtml::textField('address',$val_2->config_value,array()); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo Yii::t('settings','School/College Phone');?> </td>
    <td><?php 
		$val_3 = $model->findByPk(3);
		echo CHtml::textField('phone',$val_3->config_value,array()); ?></td>
    <td>Student Attendance Type</td>
    <td><?php 
		$val_4 = $model->findByPk(4);
		echo CHtml::dropDownlist('attentance','',array('Daily'=>'Daily','SubjectWise'=>'SubjectWise'),array('options'=>array($val_4->config_value=>array('selected'=>true)))); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo Yii::t('settings','Finance year start date');?></td>
    <td> <?php $val_5 = $model->findByPk(13);?>
		
		<?php
   				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							
							'name'=>'startyear',
							'value'=>$val_5->config_value,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;'
							),
						));
    ?></td>
    <td><?php echo Yii::t('settings','Finance year end date');?></td>
    <td> <?php $val_6 = $model->findByPk(14);?>
		 <?php
   				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							
							'name'=>'endyear',
							'value'=>$val_6->config_value,
							// additional javascript options for the date picker plugin
							'options'=>array(
								'showAnim'=>'fold',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;'
							),
						));
    ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php echo Yii::t('settings','Language');?></td>
    <td>  <?php if($usersettings!=NULL)
   {
	 
	   echo CHtml::dropDownlist('language','',array('en_us'=>'English', 
	   			'af'=>'Afrikaans',
				'sq'=>'shqiptar',
				'ar'=>'العربية',
				'cz'=>'中国的 ',
				'cs'=>'český', 
				'nl'=>'Nederlands', 
				'fr'=>'français', 
				'de'=>'Deutsch', 
				'el'=>'ελληνικά',
				 'gu'=>'Γκουτζαρατικά',
				 'hi'=>'हिंदी',
				'id'=>'Indonesia', 
				'ga'=>'Gaeilge',
				'it'=>'italiano',  
				'ja'=>'日本人',
				'kn'=>'ಕನ್ನಡ', 
				'ko'=>'한국의', 
				'la'=>'Latine',
				'ms'=>'Melayu', 
				'pt'=>'português', 
				'ru'=>'русский', 
				'es'=>'español',
				'ta'=>'தமிழ்',
				'te'=>'తెలుగు',
				'th'=>'ภาษาไทย',
				'uk'=>'Український',
				'ur'=>'اردو',
				'vi'=>'Việt',
				'vi_vn'=>'Tiếng Việt'),array('options'=>array($usersettings->language=>array('selected'=>true))));
   }
   else
   {
	   
	   echo CHtml::dropDownlist('language','',array('en_us'=>'English',
				'af'=>'Afrikaans',
				'sq'=>'shqiptar',
				'ar'=>'العربية',
				'cz'=>'中国的 ',
				'cs'=>'český', 
				'nl'=>'Nederlands', 
				'fr'=>'français', 
				'de'=>'Deutsch', 
				'el'=>'ελληνικά',
				 'gu'=>'Γκουτζαρατικά',
				 'hi'=>'हिंदी',
				'id'=>'Indonesia', 
				'ga'=>'Gaeilge',
				'it'=>'italiano',  
				'ja'=>'日本人',
				'kn'=>'ಕನ್ನಡ', 
				'ko'=>'한국의', 
				'la'=>'Latine',
				'ms'=>'Melayu', 
				'pt'=>'português', 
				'ru'=>'русский', 
				'es'=>'español',
				'ta'=>'தமிழ்',
				'te'=>'తెలుగు',
				'th'=>'ภาษาไทย',
				'uk'=>'Український',
				'ur'=>'اردو',
				'vi'=>'Việt',
				'vi_vn'=>'Tiếng Việt'),array('options'=>array(
				)));
   }?></td>
    <td><?php echo Yii::t('settings','Currency Type').' ( Symbols/short forms ) ';?></td>
    <td> <?php 
		$val_8 = $model->findByPk(5);
		echo CHtml::textField('currency',$val_8->config_value,array()); ?></td> 
  </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
    <td>&nbsp;</td>
    <td><div class="row"></div></td>
    <td><?php echo Yii::t('settings','Network State');?></td>
    <td><?php 
		$val_9 = $model->findByPk(12);
		echo CHtml::dropDownlist('network','',array('Online'=>'Online','Offline'=>'Offline'),array('options'=>array($val_9->config_value=>array('selected'=>true)))); ?></td>
  </tr>
   <tr>
     <td>&nbsp;</td>
     <td colspan="2">&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
   <td><?php echo Yii::t('settings','Date Format');?></td>
   <td><?php
   
   if($usersettings!=NULL)
   {
	   
	   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array('options'=>array($usersettings->dateformat=>array('selected'=>true))));
   }
   else
   {
	   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array());
   }
  
 ?></td>
 <td><?php echo Yii::t('settings','Time Format');?></td>
   <td><?php if($usersettings!=NULL)
   {
	  $timezone=Timezone::model()->findByAttributes(array('id'=>$usersettings->timezone ));
	    date_default_timezone_set($timezone->timezone); 
	   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
   }
   else
   {
	   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
   }?></td>
 </tr>
 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 <tr>
   <td><?php echo Yii::t('settings','Time Zone');?></td>
   <td colspan="3"> <?php if($usersettings!=NULL)
   {
	   echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
   }
   else
   {
	   echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
   }?></td>
   
   </tr>
   
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
     <td><?php echo Yii::t('settings','Upload Logo');?></td>
     <td colspan="2"><?php 
		?>
       <div class="row">
         <?php
$img=Logo::model()->findAll();
if(count($img)!=0)
{
	
	foreach($img as $img_1)
	{
		
		echo CHtml::link(Yii::t('settings','Remove'), array('Configurations/remove', 'id'=>$img_1->primaryKey));
		
		echo '<img class="imgbrder" src="'.$this->createUrl('Configurations/DisplaySavedImage&id='.$img_1->primaryKey).'" alt="'.$img_1->photo_file_name.'" width="100" height="100" />'; 	
	
	
	}
}
else {
?>
        
        <?php echo $form->fileField($logo,'uploadedFile'); ?> 
		<?php echo $form->error($logo,'uploadedFile'); } ?> 
        
        </div>
        <strong><i>(supported formats : .jpg , .png ; max filesize: 60Kb)</i></strong></td>
     <td>&nbsp;</td>
   </tr>

</table>
<br />
	<div class="row">

        <?php 
		echo CHtml::checkBox('admission_number',array('checked'=>'checked')); ?>
        <?php echo Yii::t('settings','Enable Auto increment Student admission no.');?> 
       
        <?php 
		echo CHtml::checkBox('employee_number',array('checked'=>'checked')); ?>
         <?php echo Yii::t('settings','Enable Auto increment Employee no.');?>
        
		<?php /*?><?php echo $form->textField($model,'config_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'config_key'); ?><?php */?>
	</div>

	<div class="row">
		<?php /*?><?php echo $form->labelEx($model,'config_value'); ?>
		<?php echo $form->textField($model,'config_value',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'config_value'); ?><?php */?>
	</div>

	<div style="padding:0px 0 0 0px; text-align:left">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Apply' : 'Save',array('class'=>'formbut','name'=>'submit')); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->