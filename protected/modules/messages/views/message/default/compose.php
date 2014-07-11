<?php
$this->breadcrumbs=array(
'Messages'=>array('/message'),
'Compose Message',	
);

?>
<script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="assets/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
	var config =
	    {
		height: 300,
		width : '95%',
		resize_enabled : false,
		toolbar :

		[

		['Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','SelectAll','RemoveFormat'],

		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],

		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

	/*	['BidiLtr', 'BidiRtl'],

		['Link','Unlink','Anchor'],

		['Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','-','Save','NewPage','Preview','-','Templates','-','Cut','Copy','Paste','PasteText','PasteFromWord'],

		'/',

		['Undo','Redo','-','Find','Replace','-','Styles','Format','Font','FontSize'],

		['TextColor','BGColor'],*/

		]

	};
        //Set for the CKEditor
		$('#Message_body').ckeditor(config);

    });
</script>


<?php               $roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					
						  foreach($roles as $role)
						   if(sizeof($roles)==1 and $role->name == 'parent')
						   { ?>
                           
                           <div id="parent_Sect">
    <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/leftside');?>
    
    <div id="parent_rightSect">
    <div class="parentright_innercon">
    <h1>Compose New Message</h1>
    <div class="form_wrapper" >
    <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-form',
                                'enableAjaxValidation'=>false,
                            )); ?>
                        
                            <p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
                        
                          <?php echo $form->errorSummary($model); ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('messages','receiver_id')); ?></td>
    <td> <?php echo CHtml::textField('receiver', $receiverName,array('size'=>60,'maxlength'=>255)) ?>
     <?php echo $form->hiddenField($model,'receiver_id'); ?>
                                <?php echo $form->error($model,'receiver_id'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>  <?php echo $form->labelEx($model,Yii::t('messages','subject')); ?></td>
    <td> <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
                                <?php echo $form->error($model,'subject'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

                            <div class="row">
                                <?php echo $form->labelEx($model,Yii::t('messages','Message')); ?>
                                <?php echo $form->textArea($model,'body',array('class'=>'txtarea')); ?>
                                <?php echo $form->error($model,'body'); ?>
                            </div>
                        
                            <div style="margin:0px 0 0 5px">
                                <?php echo CHtml::submitButton(MessageModule::t("Send"),array('class'=>'formbut')); ?>
                            </div>
                        
                            <?php $this->endWidget(); ?>
                        
                        </div>
                    </div>  
                    </div>  
                        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
    
     <div class="clear"></div> 
     </div>
<?php
						   }
else if(sizeof($roles)==1 and $role->name == 'student')
{
?>   
<div id="parent_Sect">
    <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/studentleft');?>
    
    <div id="parent_rightSect">
    <div class="parentright_innercon">
    <h1>Compose New Message</h1>
    <div class="form_wrapper">
    <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-form',
                                'enableAjaxValidation'=>false,
                            )); ?>
                        
                            <p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
                        
                          <?php echo $form->errorSummary($model); ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php echo $form->labelEx($model,Yii::t('messages','receiver_id')); ?></td>
    <td> <?php echo CHtml::textField('receiver', $receiverName,array('size'=>60,'maxlength'=>255)) ?>
     <?php echo $form->hiddenField($model,'receiver_id'); ?>
                                <?php echo $form->error($model,'receiver_id'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>  <?php echo $form->labelEx($model,Yii::t('messages','subject')); ?></td>
    <td> <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
                                <?php echo $form->error($model,'subject'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

                            <div class="row">
                                <?php echo $form->labelEx($model,Yii::t('messages','Message')); ?>
                                <?php echo $form->textArea($model,'body',array('class'=>'txtarea')); ?>
                                <?php echo $form->error($model,'body'); ?>
                            </div>
                        
                            <div style="margin:0px 0 0 5px">
                                <?php echo CHtml::submitButton(MessageModule::t("Send"),array('class'=>'formbut')); ?>
                            </div>
                        
                            <?php $this->endWidget(); ?>
                        
                        </div>
                    </div>  
                    </div>  
                        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
    
     <div class="clear"></div> 
     </div> 
<?php 
						  
					}else{?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
     <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="100%"><div style="padding-left:20px;">
<h1><?php echo Yii::t('messages','Compose New Message');?></h1>
<div class="clear"></div>
  
  <div class="formCon" style="width:97%">

<div class="formConInner">
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-form',
                                'enableAjaxValidation'=>false,
                            )); ?>
                        
                            <p class="note"><?php echo MessageModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
                        
                          <?php echo $form->errorSummary($model); ?>
                        
                            <div class="row">
                                <?php echo $form->labelEx($model,Yii::t('messages','receiver_id')); ?>
                                <?php echo CHtml::textField('receiver', $receiverName,array('size'=>60,'maxlength'=>255)) ?>
                                <?php echo $form->hiddenField($model,'receiver_id'); ?>
                                <?php echo $form->error($model,'receiver_id'); ?>
                            </div>
                        
                            <div class="row">
                                <?php echo $form->labelEx($model,Yii::t('messages','subject')); ?>
                                <?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255)); ?>
                                <?php echo $form->error($model,'subject'); ?>
                            </div>
                        
                            <div class="row">
                                <?php echo $form->labelEx($model,Yii::t('messages','Message')); ?>
                                <?php echo $form->textArea($model,'body',array('class'=>'txtarea')); ?>
                                <?php echo $form->error($model,'body'); ?>
                            </div>
                        
                            <div style="margin:10px 0 0 0px">
                                <?php echo CHtml::submitButton(MessageModule::t("Send"),array('class'=>'formbut')); ?>
                            </div>
                        
                            <?php $this->endWidget(); ?>
                        
                        </div>
                        
                        <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>

              </div>
 	</div></td>
        
      </tr>
    </table>
    </td>
  </tr>
</table>
<?php } ?>