<!--
 * Ajax Crud Administration Form
 * Attendances *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="attendances_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header">Create New Attendances</h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header">Update Attendances <?php  echo
        $model->id;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.Attendances was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'Attendances was created successfuly.' :
            'Attendances  was updated successfuly.';
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
<?php   $formId='attendances-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('attendances/ajax_create')
                                                                 :CController::createUrl('attendances/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'attendances-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
    // 'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
     'focus'=>array($model,'name'),
     'errorMessageCssClass' => 'input-notification-error  error-simple png_bg',
     'clientOptions'=>array('validateOnSubmit'=>true,
                                        'validateOnType'=>false,
                                        'afterValidate'=>'$js_afterValidate',
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
            <?php echo $form->labelEx($model,'student_id'); ?>
            <?php echo $form->textField($model,'student_id'); ?>
        <span id="success-Attendances_student_id"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'student_id'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'period_table_entry_id'); ?>
            <?php echo $form->textField($model,'period_table_entry_id'); ?>
        <span id="success-Attendances_period_table_entry_id"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'period_table_entry_id'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'forenoon'); ?>
            <?php echo $form->textField($model,'forenoon'); ?>
        <span id="success-Attendances_forenoon"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'forenoon'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'afternoon'); ?>
            <?php echo $form->textField($model,'afternoon'); ?>
        <span id="success-Attendances_afternoon"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'afternoon'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'reason'); ?>
            <?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-Attendances_reason"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'reason'); ?>
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


