<!--
 * Ajax Crud Administration Form
 * Events *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="events_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header">Create New Events</h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header">Update Events <?php  echo
        $model->id;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.Events was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'Events was created successfuly.' :
            'Events  was updated successfuly.';
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
<?php   $formId='events-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('events/ajax_create')
                                                                 :CController::createUrl('events/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'events-form',
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
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-Events_title"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'title'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'description'); ?>
            <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-Events_description"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'description'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'start_date'); ?>
            <?php echo $form->textField($model,'start_date'); ?>
        <span id="success-Events_start_date"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'start_date'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'end_date'); ?>
            <?php echo $form->textField($model,'end_date'); ?>
        <span id="success-Events_end_date"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'end_date'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'is_common'); ?>
            <?php echo $form->textField($model,'is_common'); ?>
        <span id="success-Events_is_common"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_common'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'is_holiday'); ?>
            <?php echo $form->textField($model,'is_holiday'); ?>
        <span id="success-Events_is_holiday"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_holiday'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'is_exam'); ?>
            <?php echo $form->textField($model,'is_exam'); ?>
        <span id="success-Events_is_exam"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_exam'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'is_due'); ?>
            <?php echo $form->textField($model,'is_due'); ?>
        <span id="success-Events_is_due"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_due'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'created_at'); ?>
            <?php echo $form->textField($model,'created_at'); ?>
        <span id="success-Events_created_at"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'created_at'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'updated_at'); ?>
            <?php echo $form->textField($model,'updated_at'); ?>
        <span id="success-Events_updated_at"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'updated_at'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'origin_id'); ?>
            <?php echo $form->textField($model,'origin_id'); ?>
        <span id="success-Events_origin_id"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'origin_id'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'origin_type'); ?>
            <?php echo $form->textField($model,'origin_type',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-Events_origin_type"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'origin_type'); ?>
    </div>

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="row buttons">
        <?php   echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class' =>
        'button align-right')); ?>    </div>

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


