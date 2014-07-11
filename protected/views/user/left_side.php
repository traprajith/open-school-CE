<div id="othleft-sidebar">
                    
                    <?php
					function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return Yii::t($category, $message, $params, $source, $language);
}
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
			// The MailBox Link
			array('label'=>''.t('MailBox (' . Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) . ')<span>Send / Receive Messages</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_1'),
					       'items'=>array(
						array('label'=>t('Inbox ('.Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()).')'), 'url'=>array('/message/inbox'),
								'active'=> ((Yii::app()->controller->module->id=='message') ? true : false)),
								array('label'=>t('New Message'), 'url'=>array('/message/compose'),
								'active'=> ((Yii::app()->controller->module->id=='message') ? true : false)),
								array('label'=>t('Sent Items'), 'url'=>array('/message/sent/sent'),
								'active'=> ((Yii::app()->controller->module->id=='message') ? true : false)),
					    )),
			//The Events Link
			array('label'=>''.t('Events<span>Your Calendar and Schedules</span>'), 'url'=>'javascript:void(0);','linkOptions'=>array('id'=>'menu_3','class'=>'menu_3'), 'itemOptions'=>array('id'=>'menu_2'),
					       'items'=>array(
						array('label'=>t('Calander'), 'url'=>array('/cal/'),
								'active'=> ((Yii::app()->controller->module->id=='cal') ? true : false)),
								array('label'=>t('Events List'), 'url'=>array('/dashboard/default/events'),
								'active'=> ((Yii::app()->controller->module->id=='dashboard') ? true : false)),
					    )),
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