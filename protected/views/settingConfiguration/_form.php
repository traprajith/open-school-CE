<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configurations-form',
	'enableAjaxValidation'=>true,	
)); ?>
<?php $usersettings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id)); ?>
<!-- Other Settings -->
<div class="formCon">
    <div class="formConInner">
    	<h3><?php echo Yii::t('settings','Application Settings'); ?></h3>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">        	   
            </tr>
                <tr>
                <td><?php echo Yii::t('settings','Date Format');?></td>
                <td>
				<?php
                if($usersettings!=NULL)
                {
                   
                   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array('options'=>array($usersettings->dateformat=>array('selected'=>true))));
                }
                else
                {
                   echo CHtml::dropDownlist('dateformat','',array('m/d/yy'=>'default ('.date('m/d/Y').' )','M d.yy'=>date('M d.Y'),'D, M d.yy'=>date('D, M d.Y'),'d M yy'=>date('d M Y'),'yy/m/d'=>date('Y/m/d'),'m/d/yy'=>date('m/d/Y')),array());
                }
                
                ?>
                </td>
			
            	
                
                <td><?php echo Yii::t('settings','Time Format');?></td>
                <td>
				<?php 
				if($usersettings!=NULL)
                {
                  $timezone=Timezone::model()->findByAttributes(array('id'=>$usersettings->timezone ));
                    date_default_timezone_set($timezone->timezone); 
                   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
                }
                else
                {
                   echo CHtml::dropDownlist('timeformat','',array('h:i A'=>'12-hour Format','H:i'=>'24-hour format'),array('options'=>array($usersettings->timeformat=>array('selected'=>true))));
                }
				?>
                </td>
                </tr>
                 <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
                <td><?php echo Yii::t('settings','Time Zone');?></td>
                <td> 
					<?php 
                    if($usersettings!=NULL)
                    {
                       echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
                    }
                    else
                    {
                       echo CHtml::dropDownlist('timezone','',CHtml::listData(Timezone::model()->findAll(),'id','timezone'),array('options'=>array($usersettings->timezone=>array('selected'=>true))));
                    }
                    ?>
                </td>
			</tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <?php /*?><tr>
                <td><?php echo Yii::t('settings','Student Attendance Type');?></td>
                <td>
					<?php 
                    $val_21 = $model->findByPk(4);
                    echo CHtml::dropDownlist('attentance','',array('Daily'=>'Daily','Subject Wise'=>'Subject Wise'),array('options'=>array($val_21->config_value=>array('selected'=>true)))); 
                    //echo CHtml::dropDownlist('attentance','',array('Daily'=>'Daily'),array('options'=>array($val_4->config_value=>array('selected'=>true))));
                    ?>
                </td>
                <td>
			</tr><?php */?>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
           <?php /*?> <tr>
            	<td colspan="2">
					<?php 
                    echo CHtml::checkBox('admission_number',array('checked'=>'checked')); 
                    echo Yii::t('settings','Enable Auto increment Student admission no.');
                    ?> 
       			</td>
                <td colspan="2">
					<?php 
                    echo CHtml::checkBox('employee_number',array('checked'=>'checked')); 
                    echo Yii::t('settings','Enable Auto increment Employee no.');
                    ?>
                </td>
   			</tr><?php */?>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
           
            
   
		</table>
	</div>
</div>
<!-- End Other Settings -->
<div style="padding:0px 0 0 0px; text-align:left">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Apply' : 'Save',array('class'=>'formbut','name'=>'submit')); ?>
</div>
<?php $this->endWidget(); ?>
