<?php
$this->breadcrumbs=array(
'Messages'=>array('/message'),
	'Inbox',
);

?>
<?php 

              $roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					foreach($roles as $role)
						  if(sizeof($roles)==1 and $role->name == 'parent')
						   { ?>
							   
      <div id="parent_Sect">
    <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/leftside');?>
    
    <div id="parent_rightSect">
        	<div class="parentright_innercon">
            	<h1>Inbox</h1>
        	<div class="inbox_filter">
                	<ul>
                    	<li style="margin:3px 0 0 0px;"><input type="checkbox" id="checkbox-1-1" class="regular-checkbox" /><label for="checkbox-1-1"></label></li>
                        <li><a href="#">Mark as Read</a></li>
                        <li><a href="#">Mark as Unread</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Archive</a></li>
                    </ul>
                    	<div class="but_right_con"><?php echo CHtml::link(Yii::t('messages','Compose New Message'),array('/message/compose'),array('class'=>'com_but')) ?></div>
                    <div class="clear"></div>
                </div>
                 
<?php if($messagesAdapter->data!=NULL){?>
<div class="inbox_con" style="width:100%; padding-top:10px">
<?php 
						
						if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-delete-form',
                                'enableAjaxValidation'=>false,
                                'action' => $this->createUrl('delete/')
                            )); 
						?>

 <?php foreach ($messagesAdapter->data as $index => $message): ?>
                                        
                                           
                                            <div class="mail_list_row">
                         <ul> 
                                          <li class="rfirst"><?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?> </li>
                                       
                                         <li class="rscnd"><img src="images/portal/m_001.png" width="55" height="55">
                                        <strong><?php 
										$user=Profile::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										echo ucfirst($user->lastname.' '.$user->firstname);
										 ?></strong>
                                          <span class="date">
										<?php 
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$data=explode(" ",$message->created_at);
									
									$date1=date($settings->displaydate,strtotime($data[0]));
									$time=date($settings->timeformat,strtotime($data[1]));
									
		
								}
								echo $date1.' '.$time;
										//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></li>
                                    <li class="rthrd">  <a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></li>
                                   </ul>
                                   <div class="clear"></div>
                                   </div>
                                   
                                    
                                                                                             
                                                              <?php endforeach ?>
                                                            
                                                            <?php $this->endWidget(); ?>
                            <?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
             <?php endif; ?>
             
                        <?php }?>
                        
                          <?php if($messagesAdapter->data==NULL){?>
		<div style="padding:0px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    <?php echo Yii::t('messages','No Messages To Display.');?>
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    
                    </div>
     
                </div>
		
	<?php }?>
              </div>
              </div>

 	</div>
    
     <div class="clear"></div> 
     </div>
     <div class="clear"></div> 
    </div> 
    <?php
	 }
	else if(sizeof($roles)==1 and $role->name == 'student')
	{
		
	?><div id="parent_Sect">
    <?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/studentleft');?>
    
    <div id="parent_rightSect">
        	<div class="parentright_innercon">
            	<h1>Inbox</h1>
        	<div class="inbox_filter">
                	<ul>
                    	<li style="margin:3px 0 0 0px;"><input type="checkbox" id="checkbox-1-1" class="regular-checkbox" /><label for="checkbox-1-1"></label></li>
                        <li><a href="#">Mark as Read</a></li>
                        <li><a href="#">Mark as Unread</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="#">Archive</a></li>
                    </ul>
                    	<div class="but_right_con"><?php echo CHtml::link(Yii::t('messages','Compose New Message'),array('/message/compose'),array('class'=>'com_but')) ?></div>
                    <div class="clear"></div>
                </div>
                 
<?php if($messagesAdapter->data!=NULL){?>
<div class="inbox_con" style="width:100%; padding-top:10px">
<?php 
						
						if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-delete-form',
                                'enableAjaxValidation'=>false,
                                'action' => $this->createUrl('delete/')
                            )); 
						?>

 <?php foreach ($messagesAdapter->data as $index => $message): ?>
                                        
                                           
                                            <div class="mail_list_row">
                         <ul> 
                                          <li class="rfirst"><?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?> </li>
                                       
                                         <li class="rscnd"><img src="images/portal/m_001.png" width="55" height="55">
                                        <strong><?php 
										$user=Profile::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										echo ucfirst($user->lastname.' '.$user->firstname);
										 ?></strong>
                                          <span class="date">
										<?php 
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$data=explode(" ",$message->created_at);
									
									$date1=date($settings->displaydate,strtotime($data[0]));
									$time=date($settings->timeformat,strtotime($data[1]));
									
		
								}
								echo $date1.' '.$time;
										//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></li>
                                    <li class="rthrd">  <a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></li>
                                   </ul>
                                   <div class="clear"></div>
                                   </div>
                                   
                                    
                                                                                             
                                                              <?php endforeach ?>
                                                            
                                                            <?php $this->endWidget(); ?>
                            <?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
             <?php endif; ?>
             
                        <?php }?>
                        
                          <?php if($messagesAdapter->data==NULL){?>
		<div style="padding:0px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    <?php echo Yii::t('messages','No Messages To Display.');?>
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    
                    </div>
     
                </div>
		
	<?php }?>
              </div>
              </div>

 	</div>
    
     <div class="clear"></div> 
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
        <td valign="top" width="75%">
        
        <div >
<!--<h1>Inbox</h1>-->
<div class="inbox_filtr">
        <div class="chk_bx">
        	<ul>
        	<li><input name="" type="checkbox" value="" /></li>
         	<li style="padding:2px 5px;"><?php echo Yii::t('messages','Select All');?></li>
            </ul>
            </div>
        	<a href="#" class="compose"><?php echo Yii::t('messages','Compose Mail');?></a>
            <div class="mailnav">
            	<ul>
                	<li><a href="#" class="left"></a></li>
                    <li><a href="#" class="mid"></a></li>
                    <li><a href="#" class="last"></a></li>
                </ul>
            </div>
            <a href="#" class="del_but"></a>
        </div>
<?php if($messagesAdapter->data!=NULL){?>
<div class="inbox_con" style="width:100%; padding-top:10px">
<?php 
						
						if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-delete-form',
                                'enableAjaxValidation'=>false,
                                'action' => $this->createUrl('delete/')
                            )); 
						?>
<table width="100%" cellpadding="0" cellspacing="0">
 <?php foreach ($messagesAdapter->data as $index => $message): ?>
                                        <tbody><tr class="odd">
                                        <td width="5%" valign="middle">
                                           
                                            
                                            <?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?> 
                                        </td>
                                        <td align="left" width="22%">
                                        <strong><?php 
										$user=Profile::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										echo ucfirst($user->lastname.' '.$user->firstname);
										 ?></strong></td>
                                      <td align="left" width="10%"><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
                                        <td width="11%" align="left" class="date"><span class="date">
										<?php 
										$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$data=explode(" ",$message->created_at);
									
									$date1=date($settings->displaydate,strtotime($data[0]));
									$time=date($settings->timeformat,strtotime($data[1]));
									
		
								}
								echo $date1.' '.$time;
										//echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
                                    </tr>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                      
                                    
                                                                    
                                                                    
                                    
                                                            </tbody>
                                                              <?php endforeach ?>
                                                            </table>
                                                            <?php $this->endWidget(); ?>
                            <?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
             <?php endif; ?>
                        <?php }?>  
              </div>
<?php /*?>			
	<?php if($messagesAdapter->data!=NULL){?>
<div class="inbox_con" style="width:100%; padding-top:10px">
                        <?php 
						
						if ($messagesAdapter->data): ?>
                            <?php $form = $this->beginWidget('CActiveForm', array(
                                'id'=>'message-delete-form',
                                'enableAjaxValidation'=>false,
                                'action' => $this->createUrl('delete/')
                            )); 
						?>
                       
                            <table  width="100%" cellpadding="0" cellspacing="0">
                                <?php foreach ($messagesAdapter->data as $index => $message): ?>
                                    <tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>">
                                        <td  width="5%" valign="top">
                                           
                                            <?php echo CHtml::checkBox("Message[$index][selected]"); ?>
                                            <?php echo $form->hiddenField($message,"[$index]id"); ?> 
                                        </td>
                                        <td align="left" width="85%">
                                        
                                        <a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a>
                                        <br />
                                        <strong>From:</strong> <?php echo $message->getSenderName(); ?></td>
                                        <td align="left" class="date"><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
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
              </div><?php */?>
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

<?php } ?>

