<!--
 * Ajax Crud Administration Form
 * Electives *
 * InfoWebSphere {@link http://libkal.gr/infowebsphere}
 * @author  Spiros Kabasakalis <kabasakalis@gmail.com>
 * @link http://reverbnation.com/spiroskabasakalis/
 * @copyright Copyright &copy; 2011-2012 Spiros Kabasakalis
 * @since 1.0
 * @ver 1.3
 -->
  <style>
 	.fancybox-inner{ width:100% !important;}
 </style>
<div id="electives_form_con" class="client-val-form">
    <?php if ($model->isNewRecord) : ?>    <h3 id="create_header"><?php echo Yii::t('app','Create New Elective');?></h3>
    <?php  elseif (!$model->isNewRecord):  ?>    <h3 id="update_header"><?php echo Yii::t('app','Update Elective : ');?> <?php  echo
        $model->name;  ?>  </h3>
    <?php   endif;  ?>
    <?php      $val_error_msg = Yii::t('app','Error ! Elective was not saved.');
    $val_success_message = ($model->isNewRecord) ?
            Yii::t('app','Elective was created successfully.') :
            Yii::t('app','Elective was updated successfully.');
  ?>

    <div id="success-note" class="notification success png_bg"
         style="display:none;">
        <a href="#" class="close"><img
                src="<?php echo Yii::app()->request->baseUrl.'/js_plugins/ajaxform/images/icons/cross_grey_small.png';  ?>"
                title="Close this notification" alt="close"/></a>
        <div>
            <?php   echo $val_success_message; ?>        </div>
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
<?php   $formId='electives-form';
   $actionUrl =
   ($model->isNewRecord)?CController::createUrl('electives/ajax_create')
                                                                 :CController::createUrl('electives/ajax_update');


    $form=$this->beginWidget('CActiveForm', array(
     'id'=>'electives-form',
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
      <p class="note"><?php echo Yii::t('app','Fields with');?><span class="required">*</span><?php echo Yii::t('app','are required.');?></p>


<div class="fancy-box-block">
   <?php echo $form->labelEx($model,'elective_group_id', array('style'=>'color:#000000')); ?>
   				<?php 
				  if(isset($model->elective_group_id) and $model->elective_group_id!=NULL)
				  {
					  $models = ElectiveGroups::model()->findAll("is_deleted=:x and batch_id=:y", array(':x'=>0,':y'=>$model->batch_id));
				  }
				  else
				  {
					  $models = ElectiveGroups::model()->findAll("is_deleted=:x and batch_id=:y", array(':x'=>0,':y'=>$_POST['batch_id']));
				  }
				?>
             <?php   //$models = ElectiveGroups::model()->findAll("is_deleted=:x and batch_id=:y", array(':x'=>0,':y'=>$_POST['batch_id']));
				$data = array();
				foreach ($models as $model_1)
				{
					
					$data[$model_1->id] = @$model_1->name;
				}
				
				if(isset($model->elective_group_id) and $model->elective_group_id!=NULL)
				{	
								
					echo $form->dropDownList($model,'elective_group_id',$data,array('empty' =>Yii::t('app','Select Group'),'options' => array('selected'=>true)));
				}
				else
				{     
            		echo $form->dropDownList($model,'elective_group_id',$data,array('empty' =>Yii::t('app','Select Group')));
				}
	?>
            
            <?php //echo $form->dropDownList($model,'elective_group_id',$data,array('empty' => 'Select Group')); ?>
     <?php /*?><?php
	
			$data = CHtml::listData(ElectiveGroups::model()->findAll("is_deleted=:x", array(':x'=>0)),'id','name');	
			?>
            <?php echo $form->labelEx($model,'elective_group_id', array('style'=>'color:#000000')); ?>
            <?php echo $form->dropDownList($model,'elective_group_id',CHtml::listData(ElectiveGroups::model()->findAll("is_deleted=:x and batch_id=:y", array(':x'=>0,':y'=>$_POST['batch_id'])),'id','name'),array('empty' => 'Select')); ?><?php */?>
           
        <span id="success-Electives_elective_group_id"
              class="hid input-notification-success  success png_bg"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'elective_group_id'); ?>
    </div>

<div class="fancy-box-block">
            <?php echo $form->labelEx($model,'name', array('style'=>'color:#000000')); ?>
            <?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>100)); ?>
        <span id="success-Electives_name"class="hid input-notification-success  success png_bg"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'name'); ?>
    </div>

       <?php /*?> <div class="row">
            <?php echo $form->labelEx($model,'code', array('style'=>'color:#000000')); ?>
            <?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>10)); ?>
        <span id="success-Electives_code"
              class="hid input-notification-success  success png_bg right"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'code'); ?>
    </div><?php */?>

        <div class="fancy-box-block">
            <?php //echo $form->labelEx($model,'is_deleted'); ?>
           <?php echo $form->hiddenField($model,'is_deleted',array('value'=>0));  ?>
           <?php echo $form->hiddenField($model,'batch_id',array('value'=>$_POST['batch_id']));  ?>
        <span id="success-Electives_is_deleted"
              class="hid input-notification-success  success png_bg"></span>
        <div>
            <small></small>
        </div>
            <?php echo $form->error($model,'is_deleted'); ?>
    </div>
<?php  if($model->created_at == NULL)
			  {
				   //echo $form->labelEx($model,'created_at'); 
				   echo $form->hiddenField($model,'created_at',array('value'=>date('Y-m-d h:i:s')));
				   if(!isset($batch_id))
				   {
				   	echo $form->hiddenField($model,'batch_id',array('value'=>$_POST['batch_id']));
				   }
				   
			  }
			  else
			  {
				  //echo $form->labelEx($model,'updated_at');
				  echo $form->hiddenField($model,'updated_at',array('value'=>date('Y-m-d h:i:s'))); 
			  }
			  
		  ?>
        
 <?php if($model->batch_id==NULL)
			{ 
            echo $form->hiddenField($model,'batch_id',array('value'=>$_POST['batch_id']));
			}?>
        
        

    
    <input type="hidden" name="YII_CSRF_TOKEN"
           value="<?php echo Yii::app()->request->csrfToken; ?>"/>

    <?php  if (!$model->isNewRecord): ?>    <input type="hidden" name="update_id"
           value=" <?php echo $model->id; ?>"/>
    <?php endif; ?>
   <div class="fancy-box-block">
        <?php   echo CHtml::submitButton($model->isNewRecord ? Yii::t('app','Submit') : Yii::t('app','Update'),array('class' =>
        'formbut-n')); ?>    </div>
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


