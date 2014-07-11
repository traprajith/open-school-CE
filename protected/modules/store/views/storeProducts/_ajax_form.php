<!--
 * Ajax Crud Administration Form
 * StoreProduct *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="store-product_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header">Create New StoreProduct</h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header">Update StoreProduct <?php  echo
        $model->id;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = 'Error.StoreProduct was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'StoreProduct was created successfuly.' :
            'StoreProduct  was updated successfuly.';
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
<?php   $formId='store-product-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('storeProducts/ajax_create')
                                                                 :CController::createUrl('storeProducts/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'store-product-form',
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
            <?php echo $form->labelEx($model,'product_name'); ?>
            <?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>200)); ?>
        <span id="success-StoreProduct_product_name"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'product_name'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'product_brand'); ?>
            <?php echo $form->textField($model,'product_brand',array('size'=>60,'maxlength'=>200)); ?>
        <span id="success-StoreProduct_product_brand"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'product_brand'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'product_quantity'); ?>
            <?php echo $form->textField($model,'product_quantity'); ?>
        <span id="success-StoreProduct_product_quantity"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'product_quantity'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'c_id'); ?>
            <?php echo $form->textField($model,'c_id'); ?>
        <span id="success-StoreProduct_c_id"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'c_id'); ?>
    </div>

        <div class="row">
            <?php echo $form->labelEx($model,'price'); ?>
            <?php echo $form->textField($model,'price'); ?>
        <span id="success-StoreProduct_price"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'price'); ?>
    </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'status'); ?>
            <?php echo $form->hiddenField($model,'status'); ?>
        <span id="success-StoreProduct_status"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'status'); ?>
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


