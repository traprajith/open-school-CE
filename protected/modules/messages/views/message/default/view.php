<?php
$this->breadcrumbs=array(
'Messages'=>array('/message'),
	'View',
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
 <h1>View Message</h1>
 <div class="form_wrapper">
 
 <?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'message-delete-form',
                        'enableAjaxValidation'=>false,
                        'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
                    )); ?>
                        <div class="but_right_con" style="top:15px; right:-50px;"><button class="com_but" title="Delete Message">Delete Message<?php echo MessageModule::t("") ?></button></div>
                    <?php $this->endWidget(); ?>
                    
                    <?php if ($isIncomeMessage): ?>
                       <div class="sub_h"><?php echo CHtml::encode($viewedMessage->subject) ?></div>
                        <div class="small_h">From: <?php echo $viewedMessage->getSenderName() ?>
                    <?php else: ?>
                         To: <?php echo $viewedMessage->getReceiverName() ?>
                    <?php endif; ?>
          
                    <span>on <?php 
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($viewedMessage->created_at));
									
		
								}
								echo $date1;
					//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></span></div>
                    <br />
                    <div class="mail_Con" >
                        <?php echo $viewedMessage->body; ?>
                    </div>
                    <div style="padding:10px 0 0 0px; margin-top:10px; border-top:1px #999999 dotted;">
                    <h3><?php echo MessageModule::t('Reply') ?></h3>
                    </div>
                    <div class="form" style="margin:20px 0 0 0px">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id'=>'message-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                    
                        <?php echo $form->errorSummary($message); ?>
                    
                        <div class="row">
                            <?php echo $form->hiddenField($message,'receiver_id'); ?>
                            <?php echo $form->error($message,'receiver_id'); ?>
                        </div>
                    
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','subject')); ?>
                            <?php echo $form->textField($message,'subject',array('size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($message,'subject'); ?>
                        </div>
                    <br />
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','Message')); ?>
                            <?php echo $form->textArea($message,'body',array('class'=>'txtarea')); ?>
                            <?php echo $form->error($message,'body'); ?>
                        </div>
                    
                        <div style="margin-top:10px;">
                            <?php echo CHtml::submitButton(MessageModule::t("Reply"),array('class'=>'formbut')); ?>
                        </div>
                    
                        <?php $this->endWidget(); ?>
                        </div>
                        
 <div class="clear"></div>
 </div>
 </div>
      </div>
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
 <h1>View Message</h1>
 <div class="form_wrapper">
 
 <?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'message-delete-form',
                        'enableAjaxValidation'=>false,
                        'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
                    )); ?>
                        <div class="but_right_con" style="top:15px; right:-50px;"><button class="com_but" title="Delete Message">Delete Message<?php echo MessageModule::t("") ?></button></div>
                    <?php $this->endWidget(); ?>
                    
                    <?php if ($isIncomeMessage): ?>
                       <div class="sub_h"><?php echo CHtml::encode($viewedMessage->subject) ?></div>
                        <div class="small_h"><?php echo Yii::t('messages','From:');?> <?php echo $viewedMessage->getSenderName() ?>
                    <?php else: ?>
                       <?php echo Yii::t('messages','To:');?> <?php echo $viewedMessage->getReceiverName() ?>
                    <?php endif; ?>
          
                    <span>on <?php 
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($viewedMessage->created_at));
									
		
								}
								echo $date1;
					//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></span></div>
                    <br />
                    <div class="mail_Con" >
                        <?php echo $viewedMessage->body; ?>
                    </div>
                    <div style="padding:10px 0 0 0px; margin-top:10px; border-top:1px #999999 dotted;">
                    <h3><?php echo MessageModule::t('Reply') ?></h3>
                    </div>
                    <div class="form" style="margin:20px 0 0 0px">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id'=>'message-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                    
                        <?php echo $form->errorSummary($message); ?>
                    
                        <div class="row">
                            <?php echo $form->hiddenField($message,'receiver_id'); ?>
                            <?php echo $form->error($message,'receiver_id'); ?>
                        </div>
                    
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','subject')); ?>
                            <?php echo $form->textField($message,'subject',array('size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($message,'subject'); ?>
                        </div>
                    <br />
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','Message')); ?>
                            <?php echo $form->textArea($message,'body',array('class'=>'txtarea')); ?>
                            <?php echo $form->error($message,'body'); ?>
                        </div>
                    
                        <div style="margin-top:10px;">
                            <?php echo CHtml::submitButton(MessageModule::t("Reply"),array('class'=>'formbut')); ?>
                        </div>
                    
                        <?php $this->endWidget(); ?>
                        </div>
                        
 <div class="clear"></div>
 </div>
 </div>
      </div>
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
        <td valign="top" width="75%"><div style="padding-left:20px;">
<h1><?php echo Yii::t('messages','View Message');?></h1>
 <div class="formCon" style="width:95%">

<div class="formConInner" >
					<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>
                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id'=>'message-delete-form',
                        'enableAjaxValidation'=>false,
                        'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
                    )); ?>
                        <button class="v-del-but" title="Delete Message"><?php echo MessageModule::t("") ?></button>
                    <?php $this->endWidget(); ?>
                    
                    <?php if ($isIncomeMessage): ?>
                       <div class="sub_h"><?php echo CHtml::encode($viewedMessage->subject) ?></div>
                        <div class="small_h"><?php echo  Yii::t('messages','From:');?> <?php echo $viewedMessage->getSenderName() ?>
                    <?php else: ?>
                        <?php echo Yii::t('messages',' To:');?> <?php echo $viewedMessage->getReceiverName() ?>
                    <?php endif; ?>
          
                    <span>on <?php 
					$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($viewedMessage->created_at));
									
		
								}
								echo $date1;
					//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></span></div>
                    <br />
                    <div class="mail_Con">
                        <?php echo $viewedMessage->body; ?>
                    </div>
                    <br /><br />
                    <h3><?php echo MessageModule::t('Reply') ?></h3>
                    
                    <div class="form">
                        <?php $form = $this->beginWidget('CActiveForm', array(
                            'id'=>'message-form',
                            'enableAjaxValidation'=>false,
                        )); ?>
                    
                        <?php echo $form->errorSummary($message); ?>
                    
                        <div class="row">
                            <?php echo $form->hiddenField($message,'receiver_id'); ?>
                            <?php echo $form->error($message,'receiver_id'); ?>
                        </div>
                    
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','subject')); ?>
                            <?php echo $form->textField($message,'subject',array('size'=>60,'maxlength'=>255)); ?>
                            <?php echo $form->error($message,'subject'); ?>
                        </div>
                    
                        <div class="row">
                            <?php echo $form->labelEx($message,Yii::t('messages','Message')); ?>
                            <?php echo $form->textArea($message,'body',array('class'=>'txtarea')); ?>
                            <?php echo $form->error($message,'body'); ?>
                        </div>
                    
                        <div style="margin-top:10px;">
                            <?php echo CHtml::submitButton(MessageModule::t("Reply"),array('class'=>'formbut')); ?>
                        </div>
                    
                        <?php $this->endWidget(); ?>
                    </div>
 </div>
              </div>
 	</div></td>
        
      </tr>
    </table>
    </td>
  </tr>
</table>


<?php } ?>



