<!--
 * Ajax Crud Administration Form
 * GradingLevels *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="grading-levels_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header"><?php echo Yii::t('Gradelevel','Create New GradingLevels');?></h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header"><?php echo Yii::t('Gradelevel','Update GradingLevels');?> </h3>
       <?php   endif;  ?>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ui-style.css" />
    <?php      $val_error_msg = 'Error.GradingLevels was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            'GradingLevels was created successfuly.' :
            'GradingLevels  was updated successfuly.';
		
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
<?php   $formId='grading-levels-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('gradingLevels/ajax_create')
                                                                 :CController::createUrl('gradingLevels/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'grading-levels-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
    // 'enableAjaxValidation'=>true,
      'enableClientValidation'=>true,
     'focus'=>array($model,'name'),
     'errorMessageCssClass' => 'input-notification-error  error-simple png_bg',
     'clientOptions'=>array('validateOnSubmit'=>true,
                                        'validateOnType'=>false,
                                       /* 'afterValidate'=>$js_afterValidate,*/
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
    <?php /*?><?php echo $form->errorSummary($model, '
    <div style="font-weight:bold">Please correct these errors:</div>
    ', NULL, array('class' => 'errorsum notification errorshow png_bg')); ?><?php */?>    <p class="note">Fields with <span class="required">*</span> are required.</p>


    <div class="row">
            <?php echo $form->labelEx($model,Yii::t('Gradelevel','name'),array('style'=>'color:#000000')); ?>
            <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <span id="success-GradingLevels_name"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php  echo $form->error($model,'name'); ?>
    </div>

        <?php if($model->batch_id==NULL)
			{ 
            echo $form->hiddenField($model,'batch_id',array('value'=>$_POST['batch_id']));
			}?>

        <div class="row">
            <?php echo $form->labelEx($model,Yii::t('Gradelevel','min_score'),array('style'=>'color:#000000')); ?>
            <?php echo $form->textField($model,'min_score'); ?>
        <span id="success-GradingLevels_min_score"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'min_score'); ?>
    </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'order'); ?>
            <?php echo $form->hiddenField($model,'order'); ?>
        <span id="success-GradingLevels_order"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'order'); ?>
    </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'is_deleted'); ?>
            <?php echo $form->hiddenField($model,'is_deleted'); ?>
        <span id="success-GradingLevels_is_deleted"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_deleted'); ?>
    </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'created_at'); ?>
            <?php echo $form->hiddenField($model,'created_at',array('value'=>date('m-d-Y'))); ?>
        <span id="success-GradingLevels_created_at"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'created_at'); ?>
    </div>

        <div class="row">
            <?php //echo $form->labelEx($model,'updated_at'); ?>
            <?php echo $form->hiddenField($model,'updated_at',array('value'=>date('m-d-Y'))); ?>
        <span id="success-GradingLevels_updated_at"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'updated_at'); ?>
    </div>

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div style="width:150px;">
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


