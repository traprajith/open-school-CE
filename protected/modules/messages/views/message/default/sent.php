<?php
$this->breadcrumbs=array(
'Messages'=>array('/message'),
'Sent Item',	
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        
        <div style="padding-left:20px;">
<h1><?php echo Yii::t('messages','Sent Items');?></h1>

	<?php if($messagesAdapter->data!=NULL){?>
<div class="inbox_con" style="width:97%; padding-top:10px">
                        <?php if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-delete-form',
                                'enableAjaxValidation'=>false,
                                'action' => $this->createUrl('delete/')
                            )); ?>
                       
                            <table  width="100%" cellpadding="0" cellspacing="0">
                                <?php foreach ($messagesAdapter->data as $index => $message): ?>
                                    <tr>
                                        <td  width="5%" valign="top">
                                           
                                            <?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?> 
                                        </td>
                                         <td align="left" width="22%">
                                         <strong><?php 
										$user=Profile::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										echo ucfirst($user->lastname.' '.$user->firstname);
										 ?></strong>
                                         </td>
                                        <td align="left" width="40%">
                                        
                                        <a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
                                       
                                      
                                        <td align="left" class="date"><span class="date">
										<?php 
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$data=explode(" ",$message->created_at);
									
									$date1=date($settings->displaydate,strtotime($data[0]));
									$time=date($settings->timeformat,strtotime($data[1]));
									
		
								}
								echo $date1.' '.$time;?></span></td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                         <div style="margin:10px 0 0px 0px" >
                                <?php echo CHtml::submitButton('',array('class'=>'m-del-but')); ?>
            </div>
                            
                        
                        <?php $this->endWidget(); ?>
                            <?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
                        <?php endif; ?>
                        <?php }?>
              </div>
 	</div>
    <?php if($messagesAdapter->data==NULL){?>
		<div style="padding:0px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    	<?php echo Yii::t('messages','No Messages To Display.');?>
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    	<h1><?php echo CHtml::link(Yii::t('messages','Compose New Message'),array('/message/compose'),array('class'=>'ico4')) ?></h1>
                    </div>
                    
                </div>

                </div>
		
	<?php }?>    
    </td>
        
      </tr>
    </table>
    </td>
  </tr>
</table>