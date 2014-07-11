<div id="othleft-sidebar">
                   <!--<div class="lsearch_bar">
             	<input name="" type="text" class="lsearch_bar_left" value="Search" />
                <input name="" type="button" class="sbut" />
                <div class="clear"></div>
  </div>-->
  <h1>MailBox (<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ; ?>)</h1>  
                    <?php
					function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
							  {
								  return $message;
							  }
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
			//The Welcome Link
			//array('label'=>''.t('Welcome'),  'url'=>array('/message/index') ,'linkOptions'=>array('class'=>'menu_1' ), 'itemOptions'=>array('id'=>'menu_1') 
					       //),
						   
				
			// The MailBox Link
		
						array('label'=>Yii::t('messages','Inbox ('.Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())).')<span>'.Yii::t('messages','All Received Messages').'</span>', 'url'=>array('/message/inbox'),
								'active'=> ((Yii::app()->controller->action->id=='inbox') ? true : false),'linkOptions'=>array('class'=>'inbox_ico')),
								array('label'=>Yii::t('messages','New Message').'<span>'.Yii::t('messages','Create New Message').'</span>', 'url'=>array('/message/compose'),
								'active'=> ((Yii::app()->controller->action->id=='compose') ? true : false),'linkOptions'=>array('class'=>'messgnew_ico')),
								array('label'=>Yii::t('messages','Sent Items').'<span>'.Yii::t('messages','All Sent Messages').'</span>', 'url'=>array('/message/sent/sent'),
								'active'=> ((Yii::app()->controller->action->id=='sent') ? true : false),'linkOptions'=>array('class'=>'sentitem_ico')),
			
				  
			//The Events Link
			//'label'=>''.t('Events'), 'url'=>'javascript:void(0);', 'itemOptions'=>array('id'=>'menu_2'),
			array('label'=>''.'<h1>'.Yii::t('messages','Events').'</h1>',
					     
						'active'=> ((Yii::app()->controller->module->id=='cal') ? true : false)),
								array('label'=>Yii::t('messages','Events List').'<span>'.Yii::t('messages','All Events').'</span>', 'url'=>array('/dashboard/default/events'),
								'active'=> ((Yii::app()->controller->module->id=='dashboard') ? true : false),'linkOptions'=>array('class'=>'evntlist_ico')),
								array('label'=>Yii::t('messages','Calendar').'<span>'.Yii::t('messages','Schedule Events').'</span>', 'url'=>array('/cal'),
								'active'=> ((Yii::app()->controller->module->id=='dashboard') ? true : false),'linkOptions'=>array('class'=>'cal_ico')),
					   
				),
			)); ?>
		
		</div>
        <script type="text/javascript">

	$(document).ready(function () {
            //Hide the second level menu
            $('#othleft-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });
    </script>