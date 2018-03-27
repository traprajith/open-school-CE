
<?php $user_com=Profile::model()->findByAttributes(array('user_id'=>$comment->created_by));

	$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));?>



<div class="log_comment_box" id="delete_div_<?php echo $comment->id;?>">
       <h1><?php echo $user_com->fullname; ?><span><?php   $roles=Yii::app()->authManager->getRoles($comment->created_by);
										foreach ($roles as $role)
										{
											echo $role->name;
										}
										?></span></h1>
       <h2><?php echo $comment->category->name;?></h2>
       <div class="clear"></div>
       <p><?php echo $comment->comment;?></p>
       
       <span class="log_cmnt_date"><?php echo date($settings->displaydate,strtotime($comment->date)).' '.date($settings->timeformat,strtotime($comment->date));?></span>
        <div class="log_cmnt_but">
                                   <ul>
                                   	<li class="logdelete">
                                    <div class="side_icons">
                                     <i class="fa fa-trash"></i>
       <?php 
        								echo  CHtml::ajaxSubmitButton('',CHtml::normalizeUrl(array("logcomment/deletecomment","id"=>$comment->id, "style"=>'margin-left:10px;')),
                                		array(
											'data'=>'js:{"'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
											'beforeSend'=>'function(){
                                       		
                                    		}',
                                   			 'success'=>'function(result){
													$( "#delete_div_'.$comment->id.'").remove();
											}'
									
                                ),array('confirm'=>Yii::t('app',"Delete Your Post!"),'id'=>'deletecomment_'.$comment->id.'_'.time(),"name"=>'yt_'.$comment->id,'style'=>'background: url("'.Yii::app()->request->baseUrl.'/images/delete_1.png");')); 
								?></div>
                                 </li>
                                <li class="logedit">
                                <div class="side_icons">
                                <i class="fa fa-pencil"></i>
                                
                                 <?php 
        							echo  CHtml::ajaxSubmitButton('',
                                			CHtml::normalizeUrl(array("logcomment/editcomment","id"=>$comment->id)),
                                	array(
											'data'=>'js:{"'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
											'beforeSend'=>'function(){
											  
											}',
											'success'=>'function(result){
												$( "#delete_div_'.$comment->id.'").html(result);
											}'
									
                                	),array('confirm'=>Yii::t('app',"Edit Your Post!"),'id'=>'editcomment_'.$comment->id.'_'.time(),"name"=>'yt_'.$comment->id.'_'.time(),'style'=>'background: url("'.Yii::app()->request->baseUrl.'/images/edit_1.png");')); 
								?>
                                </div>
                                </li>
                                </ul>
                                    </div>
                                </div>
       </div>













			
		
    
        
        