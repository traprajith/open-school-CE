   
    <?php 
	$sender 		= Profile::model()->findByAttributes(array('user_id'=>$data->sender_id));
	$sender_name 	= ucfirst($sender->firstname).' '.ucfirst($sender->lastname); 
	$roles 			= Rights::getAssignedRoles($data->sender_id);	
	if($index%2)
	$class='mail_blue';
	else
	$class='mail_orange';
	
	echo CHtml::link('<li class="'.$class.'">
				<div class="mail-box-bg">
					<h3>'.$data->subject.'</h3>
				   '.$data->text.'
					<div class="mail_box_view"> </div>
				</div>
				<div class="mail-box-sender">

					<div class="mail_box_name"><p>- '.Yii::t("app","By")." ".$sender_name." ( ".ucfirst(key($roles))." ) ".'</p></div>
				</div>
				
                 </li>
                 <div class="clear"></div>', array('/mailbox/message/view','id'=>$data->conversation_id));?>
               
                 
    
  
   
   
   





