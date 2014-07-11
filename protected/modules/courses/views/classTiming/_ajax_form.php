<!--
 * Ajax Crud Administration Form
 * ClassTimings *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
 

<div id="class-timings_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header"><?php echo Yii::t('Timing','Set New Class Timing');?></h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header"><?php echo Yii::t('Timing','Update Class Timing');?></h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.Class Timing was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'Class Timing was set successfuly.' :
            'Class Timing was updated successfuly.';
  ?>

    <div id="success-note" class="notification success png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_success_message;  ?>        </div>
    </div>

    <div id="error-note" class="notification errorshow png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_error_msg;  ?>        </div>
    </div>

    <div id="ajax-form"  class='form'>
<?php   $formId='class-timings-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('classTiming/ajax_create')
                                                                 :CController::createUrl('classTiming/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'class-timings-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
    // 'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
     'focus'=>array($model,'name'),
     'errorMessageCssClass' => 'input-notification-error  error-simple png_bg',
     'clientOptions'=>array('validateOnSubmit'=>true,
                                        'validateOnType'=>false,
                                        'afterValidate'=>'js_afterValidate',
                                        'errorCssClass' => 'err',
                                        'successCssClass' => 'suc',
                                        'afterValidate' => 'js:function(form,data,hasError){ $.js_afterValidate(form,data,hasError);  }',
                                         'errorCssClass' => 'err',
                                        'successCssClass' => 'suc',
                                        'afterValidateAttribute' => 'js:function(form, attribute, data, hasError){
                                                                                                 $.js_afterValidateAttribute(form, attribute, data, hasError);
                                                                                                                            }'
                                                                             ),
));

     ?>
    <?php echo $form->errorSummary($model, '
    <div style="font-weight:bold">Please correct these errors:</div>
    ', NULL, array('class' => 'errorsum notification errorshow png_bg')); ?>    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div class="row">
            
            <?php if($model->batch_id==NULL)
			{ 
            echo $form->hiddenField($model,'batch_id',array('value'=>$_POST['batch_id']));
			}?>
            
        <span id="success-ClassTimings_batch_id"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'batch_id'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,Yii::t('Timing','name'),array('style'=>'color:#4F4E4E')); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-ClassTimings_name"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'name'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,Yii::t('Timing','start_time'),array('style'=>'color:#4F4E4E')); ?>
            <?php 
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($settings!=NULL)
			{
				$time=$settings->timeformat;
			if (!$model->isNewRecord)
			{
				$model->start_time=date($settings->timeformat,strtotime($model->start_time));
				$model->end_time=date($settings->timeformat,strtotime($model->end_time));
		
			}
		
			}
			if($time=='h:i A')
			{
				$this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'start_time',
     'name'=>'ClassTimings[start_time]',
	 'options'=>array(
         'showPeriod'=>true,
		 'showPeriodLabels'=> true,
		 'showCloseButton'=> true,    
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
    'nowButtonText'=> 'Now',        
    'showDeselectButton'=> true,   
    'deselectButtonText'=> 'Deselect' 
         ),
	 
     
   )); 
			}
			else if($time=='H:i')
			{
			$this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'start_time',
     'name'=>'ClassTimings[start_time]',
	 'options'=>array(
         'showPeriod'=>false,  
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
   
         ),
	 
     
   ));
			}
    ?> 
        <span id="success-ClassTimings_start_time"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'start_time'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,Yii::t('Timing','end_time'),array('style'=>'color:#4F4E4E')); ?>
           <?php
		   if($time=='h:i A')
		   {
			    $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'end_time',
     'name'=>'ClassTimings[end_time]',
	 'options'=>array(
         'showPeriod'=>true,
		 'showPeriodLabels'=> true,
		 'showCloseButton'=> true,    
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
    'nowButtonText'=> 'Now',        
    'showDeselectButton'=> true,   
    'deselectButtonText'=> 'Deselect'
	 
         ),
	 
     
   ));
		   }
		   
		  else if($time=='H:i')
		   {
		   
		    $this->widget('application.extensions.jui_timepicker.JTimePicker', array(
     'model'=>$model,
	 'attribute'=>'end_time',
     'name'=>'ClassTimings[end_time]',
	 'options'=>array(
         'showPeriod'=>false,
		 //'showPeriodLabels'=> false,
		 //'showCloseButton'=> true,       
    'closeButtonText'=> 'Done',     
    'showNowButton'=> true,        
    'nowButtonText'=> 'Now',        
    //'showDeselectButton'=> true,   
    //'deselectButtonText'=> 'Deselect' ,
	 //'hours'=>array(
       //'starts' => 0,
        //'ends'=> 23, ),
         ),
	 
     
   ));
		   }
    ?> 
        <span id="success-ClassTimings_end_time"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'end_time'); ?>
    </div>

        <div class="row">
            <table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> <?php echo $form->checkBox($model,'is_break'); ?></td>
    <td><?php echo $form->labelEx($model,Yii::t('Timing','is_break')); ?></td>
    <td> <?php echo $form->error($model,'is_break'); ?></td>
  </tr>
</table>

           
    </div>

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="row buttons" style="width:30%;">
        <?php   echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class'=>'formbut')); ?>    </div>

  <?php  $this->endWidget(); ?></div>
    <!-- form -->

</div>
<script type="text/javascript">

    //Close button:

    $(".close").click(
            function () {
                $(this).parent().fadeTo(400, 0, function () { // Links with the class "close" will close parent
                    $(this).slideUp(600);
                });
                return false;
            }
    );


</script>


