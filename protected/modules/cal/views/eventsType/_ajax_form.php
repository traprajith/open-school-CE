
<style>
.fancybox-inner{ width:auto !important; height:auto !important;}
.client-val-form input{ width:100% !important;  -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.fancybox-wrap{
	 width:350px !important;	
}
</style>
<!--
 * Ajax Crud Administration Form
 * EventsType *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @v
 -->
<div id="events-type_form_con" class="client-val-form" style="max-width:400px;">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header"><?php echo Yii::t('app','Create New Event Type');?></h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header"><?php echo Yii::t('app','Update Event Type');?> </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = Yii::t('app','Error.EventsType was not saved.');
    $val_success_message = ($model->isNewRecord) ?
            Yii::t('app','Event Type was created successfully.') :
            Yii::t('app','Event Type  was updated successfully.');
  ?>

    <div id="success-note" class="notification success-fancy"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_success_message;  ?>        </div>
    </div>

    <div id="error-note" class="notification errorshow-fancy"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_error_msg;  ?>        </div>
    </div>

    <div id="ajax-form"  class='form'>
<?php   $formId='events-type-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('eventsType/ajax_create')
                                                                 :CController::createUrl('eventsType/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'events-type-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
     'enableAjaxValidation'=>true,
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
    <div style="font-weight:bold">'.Yii::t('app','Please correct these errors:').'</div>
    ', NULL, array('class' => 'errorsum notification errorshow-fancy')); ?>    <p class="note"> <?php echo Yii::t('app','Fields with');?> <span class="required">*</span><?php echo Yii::t('app','are required.');?></p>


    <div class="row">
            <?php echo $form->labelEx($model,'name',array('style'=>'color:#222222')); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>120)); ?>
        <span id="success-EventsType_name"
              class="hid input-notification-success  success-fancy right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'name'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'colour_code',array('style'=>'color:#222222')); ?>
            <?php //echo $form->textField($model,'colour_code',array('size'=>60,'maxlength'=>120)); 
            
            /* $this->widget('ext.colorpicker.ColorPicker', array(
            'model' => $model,
            'attribute' => 'colour_code',
            'options' => array( // Optional
                'pickerDefault' => "ccc", // Configuration Object for JS
            ),
        )); */
		
		$this->widget('ext.SMiniColors.SActiveColorPicker', array(
			'model' => $model,
			'attribute' => 'colour_code',
			'hidden'=>false, // defaults to false - can be set to hide the textarea with the hex
			'options' => array(), // jQuery plugin options
			'htmlOptions' => array(), // html attributes
		));
		?>
        <span id="success-EventsType_colour_code"
              class="hid input-notification-success  success-fancy right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'colour_code'); ?>
    </div>

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="row buttons">
        <?php   echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Submit') : Yii::t('app','Save'),array('class' =>
        'formbut')); ?>    </div>

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


