<style>
	.check{
		width:10px;
	}
	#spec{
		display: none;
	}
</style>
<?php // Display Successfull message. 
    Yii::app()->clientScript->registerScript(
       'myHideEffect',
       '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
       CClientScript::POS_READY
    );
?>
 
<?php if(Yii::app()->user->hasFlash('notification')):?>
    <div class="flash-success" style="color:#F00; padding-left:150px; font-size:12px; font-weight:bold;">
        <?php echo Yii::app()->user->getFlash('notification'); ?>
    </div>
<?php endif; ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'previous-year-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->
	
	<?php echo $form->errorSummary($model); ?>
    <div class="formCon">
        <div class="formConInner">
    
            <table width="100%">
            	<tr>
                	<td>
                    	<h3><?php echo Yii::t('app','By default, you will be able to perform only View, Edit and Approve actions in the other academic years.')?></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php
					$is_custom = PreviousYearSettings::model()->countByAttributes(array('settings_value'=>2));
					if($is_custom == 0)
					{
						$model->setting = 1;
					}
					else
					{
						$model->setting = 0;
					}
                   // echo CHtml::radioButtonList('setting',$check,array('0'=>Yii::t('app','Use Default Settings'),'1'=>Yii::t('app','Use Custom Settings')),array('separator'=>'<br/><br/>','style'=>'width:20px;'));
                    ?>
                    <?php echo $form->radioButtonList($model,'setting',array('0'=>Yii::t('app','Use Default Settings'),'1'=>Yii::t('app','Use Custom Settings')),array('separator'=>'<br/><br/>','style'=>'width:20px;')); ?>
                    
                    </td>
                </tr>
            </table>            
   
		</div>
    </div>
    
    <?php
	if($model->setting == 1)
	{
		$style = 'display:block';
	}
	else
	{
		$style = 'display:none';
	}
	?>
    
    <div class="formCon" id="custom_form">
    	<div class="formConInner">
        	<h3><?php echo Yii::t('app','Select the actions that should be available while viewing the previous academic years.'); ?></h3>
            <?php 
			$settings = PreviousYearSettings::model()->findAll(); 
			?>
            <table width="60%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td>  
                    	<?php
						if($settings[0]->settings_value=='1')
						{
							echo $form->checkBox($model,'create_action',array('id'=>'create_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'create_action',array('id'=>'create_action'));
						}
						?>
                        <?php echo Yii::t('app','Create');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[1]->settings_value=='1')
						{
							echo $form->checkBox($model,'insert_action',array('id'=>'insert_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'insert_action',array('id'=>'insert_action'));
						}
						?>
                        <?php echo Yii::t('app','Insert');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[2]->settings_value=='1' or $settings[2]->settings_value=='2')
						{
							echo $form->checkBox($model,'edit_action',array('id'=>'edit_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'edit_action',array('id'=>'edit_action'));
						}
						?>
                        <?php echo Yii::t('app','Edit');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[3]->settings_value=='1')
						{
							echo $form->checkBox($model,'delete_action',array('id'=>'delete_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'delete_action',array('id'=>'delete_action'));
						}
						?>
                        <?php echo Yii::t('app','Delete');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[4]->settings_value=='1' or $settings[4]->settings_value=='2')
						{
							echo $form->checkBox($model,'approve_action',array('id'=>'approve_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'approve_action',array('id'=>'approve_action'));
						}
						?>
                        <?php echo Yii::t('app','Approve');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[5]->settings_value=='1')
						{
							echo $form->checkBox($model,'disapprove_action',array('id'=>'disapprove_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'disapprove_action',array('id'=>'disapprove_action'));
						}
						?>
                        <?php echo Yii::t('app','Disapprove');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[6]->settings_value=='1')
						{
							echo $form->checkBox($model,'active_action',array('id'=>'active_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'active_action',array('id'=>'active_action'));
						}
						?>
                        <?php echo Yii::t('app','Active');?>
                    </td>
                </tr>
                <tr>
                	<td>&nbsp;</td>
                </tr>
                <tr>
                	<td>
                    	<?php
						if($settings[7]->settings_value=='1')
						{
							echo $form->checkBox($model,'inactive_action',array('id'=>'inactive_action','checked'=>'true'));
						}
						else
						{
							echo $form->checkBox($model,'inactive_action',array('id'=>'inactive_action'));
						}
						?>
                        <?php echo Yii::t('app','Inactive').' / '.Yii::t('app','Deactivate');?>
                    </td>
                </tr>
			</table>
        </div>
    
    </div>
	<?php /*?><div class="row">
		<?php echo $form->labelEx($model,'settings_key'); ?>
		<?php echo $form->textField($model,'settings_key',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'settings_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_enabled'); ?>
		<?php echo $form->textField($model,'is_enabled'); ?>
		<?php echo $form->error($model,'is_enabled'); ?>
	</div><?php */?>
	<br />
	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app','Save'),array('class'=>'formbut')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<!--<script> 
	/* 
* Import form show and hide
*/

$( "input[name=PreviousYearSettings[setting]]:radio" ).change(function() {
	if($(this).val() == 1)
	{
		$('#custom_form').show("slow");
	}
	else
	{
		$('#custom_form').hide("slow");
	}
});
</script>-->