
<style>

.fancybox-inner{ width:auto;}
.notification{ width:89% !important;}
.client-val-form h3{ margin-left:3px;}

</style>

<!--
 * Ajax Crud Administration Form
 * StudentCategories *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="student-categories_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header">Create New Student Category</h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header">Update Student Category <?php  echo
        $model->id;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.StudentCategories was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'StudentCategories was created successfuly.' :
            'StudentCategories  was updated successfuly.';
  ?>

    <div id="success-note" class="notification success png_bg"
         style="display:none;margin:-41px 25px 0 0px;">
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

    <div id="ajax-form"  class='form' style="margin-left:3px;">
<?php   $formId='student-categories-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('studentCategory/ajax_create')
                                                                 :CController::createUrl('studentCategory/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'student-categories-form',
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
            <?php echo $form->labelEx($model, Yii::t('students','name'),array('style'=>'float:left;color:#444444;')); ?>
            <span style="float:left; display:inline; padding-left:40">
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,)); ?></span>
        <span id="success-StudentCategories_name" class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div> 
        <span style="float:left; display:inline;">
            <?php echo $form->error($model,'name'); ?></span>
    	</div>

        <div class="row">
            <?php //echo $form->labelEx($model,'is_deleted'); ?>
            <?php echo $form->hiddenField($model,'is_deleted'); ?>
        <span id="success-StudentCategories_is_deleted"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_deleted'); ?>
    </div>

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="row buttons" style="width:30%; clear:both;"><br /><br />
        <?php   echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class' =>
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


