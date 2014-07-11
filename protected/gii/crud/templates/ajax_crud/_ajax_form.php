<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<!--
 * Ajax Crud Administration Form
 * <?php echo $this->modelClass; ?>
 *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
<div id="<?php echo $this->class2id($this->modelClass); ?>_form_con" class="client-val-form">
    <?php echo '<?php '; ?>if ($model->isNewRecord) :<?php echo ' ?>'; ?>
    <h3 id="create_header">Create New <?php echo $this->modelClass; ?></h3>
    <?php echo '<?php '; ?> elseif (!$model->isNewRecord): <?php echo ' ?>'; ?>
    <h3 id="update_header">Update <?php echo $this->modelClass; ?> <?php echo '<?php '; ?> echo
        $model-><?php echo $this->tableSchema->primaryKey; ?>; <?php echo ' ?>'; ?>  </h3>
    <?php echo '<?php '; ?>  endif; <?php echo ' ?>'; ?>

    <?php echo '<?php  '; ?>
    $val_error_msg = 'Error.<?php echo $this->modelClass; ?> was not saved.';
    $val_success_message = ($model->isNewRecord) ?
            '<?php echo $this->modelClass; ?> was created successfuly.' :
            '<?php echo $this->modelClass; ?>  was updated successfuly.';
 <?php echo ' ?>'; ?>


    <div id="success-note" class="notification success png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo '<?php '; ?>echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png'; <?php echo ' ?>'; ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php echo '<?php  '; ?> echo $val_success_message; <?php echo ' ?>'; ?>
        </div>
    </div>

    <div id="error-note" class="notification errorshow png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo '<?php '; ?>echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png'; <?php echo ' ?>'; ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php echo '<?php  '; ?> echo $val_error_msg; <?php echo ' ?>'; ?>
        </div>
    </div>

    <div id="ajax-form"  class='form'>
<?php echo '<?php  '; ?>
 $formId='<?php echo $this->class2id($this->modelClass); ?>-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('<?php echo  $this->getControllerID();?>/ajax_create')
                                                                 :CController::createUrl('<?php echo  $this->getControllerID();?>/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'<?php echo $this->class2id($this->modelClass); ?>-form',
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

    <?php echo ' ?>'; ?>

    <?php echo '<?php '; ?>echo $form->errorSummary($model, '
    <div style="font-weight:bold">Please correct these errors:</div>
    ', NULL, array('class' => 'errorsum notification errorshow png_bg'));<?php echo ' ?>'; ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>


<?php
foreach ($this->tableSchema->columns as $column)
{
    if ($column->autoIncrement)
        continue;
    ?>
    <div class="row">
            <?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
            <?php echo "<?php echo " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
        <span id="success-<?php echo $this->modelClass; ?>_<?php echo $column->name; ?>"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small><?php //echo Yii::t('admin', ''); ?></small>
        </div>
            <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
    </div>

    <?php
}
    ?>

    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo '<?php '; ?>echo Yii::app()->request->csrfToken;<?php echo ' ?>'; ?>"/>

    <?php echo '<?php '; ?> if (!$model->isNewRecord):<?php echo ' ?>'; ?>
    <input type="hidden" name="update_id"
           value=" <?php echo '<?php '; ?>echo $model->id;<?php echo ' ?>'; ?>"/>
    <?php echo '<?php '; ?>endif;<?php echo ' ?>'; ?>

    <div class="row buttons">
        <?php echo '<?php '; ?>  echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',array('class' =>
        'button align-right'));<?php echo ' ?>'; ?>
    </div>

  <?php echo '<?php '; ?> $this->endWidget();<?php echo ' ?>'; ?>
</div>
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


