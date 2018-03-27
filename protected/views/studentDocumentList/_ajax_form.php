<!--
 * Ajax Crud Administration Form
 * StudentDocumentList *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
 <style type="text/css">
.fancybox-inner{ width:auto !important; height:auto !important; overflow:hidden !important;}
.client-val-form input{ width:100% !important;  -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box ;
}
.client-val-form label{
	margin-bottom:5px;
	 display:inline-block !important;	
}
.client-val-form select{ width:100% !important;  
-webkit-box-sizing: border-box !important ;
    -moz-box-sizing: border-box !important ;
    box-sizing: border-box !important;
}
.fancybox-wrap{
	 width:350px !important;	
}

.client-val-form .input-checkbox input{ width:inherit !important; display:inline !important;}
 
 </style>
 
<div id="student-document-list_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header"><?php echo Yii::t('app','Create New Student Document Type');?></h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header"><?php echo Yii::t('app','Update Student Document Type');?> </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = Yii::t('app','Error.Student Document Type was not saved.');
    $val_success_message = ($model->isNewRecord) ?
            Yii::t('app','Student Document Type was created successfully.') :
            Yii::t('app','Student Document Type was updated successfully.');
  ?>

    <div id="success-note" class="notification success"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_success_message;  ?>        </div>
    </div>

    <div id="error-note" class="notification errorshow"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_error_msg;  ?>        </div>
    </div>

    <div id="ajax-form"  class='form'>
<?php   $formId='student-document-list-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('studentDocumentList/ajax_create')
                                                                 :CController::createUrl('studentDocumentList/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'student-document-list-form',
    //  'htmlOptions' => array('enctype' => 'multipart/form-data'),
         'action' => $actionUrl,
    //'enableAjaxValidation'=>true,
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
    <?php /*echo $form->errorSummary($model, '
    <div style="font-weight:bold">'.Yii::t('app','Please correct these errors:').'</div>
    ', NULL, array('class' => 'errorsum notification errorshow png_bg')); */?>    
    <p class="note"><?php echo Yii::t('app','Fields with').'<span class="required">'.'*'.'</span>'.Yii::t('app','are required.');?></p>


    <div class="fancy_box_form ">
            <?php echo $form->labelEx($model,'name',array('style'=>'color:#000')); ?>
            <?php echo $form->textField($model,'name'); ?>
        <span id="success-StudentDocumentList_name"
              class="hid input-notification-success  success"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'name'); ?>
    </div>
    
    <div class="fancy_box_form input-checkbox " style="display: inline-block; ">
    	<?php echo $form->labelEx($model,'mandatory'); ?>
        <?php
         $mandatorylist = array('0'=>Yii::t('app','No'), '1'=>Yii::t('app','Yes,cannot be skipped during Registration'),'2'=>Yii::t('app','Yes,can be skipped during Registration'));
                echo $form->radioButtonList($model,'mandatory',$mandatorylist,array('separator'=>'</br> '));?>
		<?php echo $form->error($model,'mandatory'); ?>
    </div>

        <div class="fancy_box_form input-checkbox  ">
            <?php echo $form->labelEx($model,'is_required',array('style'=>'color:#000')); ?>
           <div style="display: inline-block; margin: 0 0 -6px;"> <?php echo $form->checkBox($model,'is_required'); ?></div>
        <span id="success-StudentDocumentList_is_required" class="hid input-notification-success  success"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_required'); ?>&nbsp;
    </div>

    
    <input width="20" type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input width="20" type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
    <div class="buttons">
        <?php   echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Submit') : Yii::t('app','Save'),array('class' =>
        'button align-right','style'=>'')); ?>    </div>

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


