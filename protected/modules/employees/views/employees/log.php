<?php
$this->breadcrumbs=array(
	Yii::t('app','Teacher')=>array('index'),
	Yii::t('app','Log'),
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('profileleft');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <!--<div class="searchbx_area">
                    <div class="searchbx_cntnt">
                        <ul>
                            <li><a href="#"><img src="images/search_icon.png" width="46" height="43" /></a></li>
                            <li><input class="textfieldcntnt"  name="" type="text" /></li>
                        </ul>
                    </div>
                
                </div>-->
                <h1><?php echo Yii::t('app','Teacher Profile');?></h1> 
                <div class="button-bg">
                <div class="top-hed-btn-left"></div>
                <div class="top-hed-btn-right">
                <ul>                                    
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('update', 'id'=>$_REQUEST['id']),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
                <li><?php echo CHtml::link('<span>'.Yii::t('app','Teachers').'</span>', array('employees/manage'),array('class'=>'a_tag-btn')); ?><!--<a class=" edit last" href="">Edit</a>--></li>                                  
                </ul>
                </div>
                </div>

                
                <div class="clear"></div>
                <div class="emp_right_contner">
                    <div class="emp_tabwrapper">
                     
						<?php $this->renderPartial('tab');?>
                      
                        <div class="clear"></div>
                        <div class="emp_cntntbx">
                        	<div class="formCon">
                            	<div class="formConInner">
                               
                                <?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'log-form',
									'enableAjaxValidation'=>true,
									'enableClientValidation'=>true,
								)); ?>
                                <div class="txtfld-col-box">
    								<div class="txtfld-col txtfld-col-height">
										<?php 
                                            $criteria = new CDbCriteria;
                                            $criteria->compare('type',2,true);
                                            $data_1 = CHtml::listData(LogCategory::model()->findAll($criteria),'id','name');
                                            echo $form->dropDownList($model1,'category_id',$data_1,
                                            array('prompt'=>Yii::t('app','Select Category'),'id'=>'category',
                                            'options'=>array()));  ?>
                                        <?php echo $form->error($model1,'category_id'); ?>
                                    </div>
                                    </div>
                                    <div class="txtfld-col-box">
 									<div class="text-fild-block-full">
										<?php echo $form->textArea($model1,'comment',array('rows'=>6,'id'=>'comment_text'));?>
                                        <?php echo $form->error($model1,'comment'); ?>
                                    </div>
									</div>
<div class="txtfld-col-btn">
<?php echo $form->hiddenField($model1,'user_id',array('value'=>$_REQUEST['id']));?>
                       					<?php 
					   
                                echo CHtml::ajaxSubmitButton(Yii::t('app','Submit'),
                                CHtml::normalizeUrl(array('/employees/logcomment/create')),
                         array('dataType'=>'json', 'type'=>'post','success'=>'js: function(data) {
											 

                        if (data.status == "error")
                        {

                                $.each(data.error, function(key, val) {

                                        $("#"+key+"_em_").html(String(val)).show();
                                });

                        }
                        else
											{
												
												$("#outer_div").prepend(data.content).show();
												$("#comment_text").val("");
												
											}
											    
										}'),array('id'=>'cmnt_button'.'_'.time(),'name'=>'','class'=>'formbut','style'=>'')); 
							
										?>
                                    </div>
                                    <?php $this->endWidget(); ?>
                                
                                
                                </div>
                                
                            </div>
                            <div id="outer_div">
                            <?php 
							$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                            foreach($comments as $comment)
							{
								$user_com=Profile::model()->findByAttributes(array('user_id'=>$comment->created_by));
								
							?>
                            
								
                            	<div class="log_comment_box" id="delete_div_<?php echo $comment->id; ?>">
                                	<h1><?php echo $user_com->fullname; ?><span>
                                <?php   $roles=Yii::app()->authManager->getRoles($comment->created_by);
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
        								echo  CHtml::ajaxSubmitButton('',CHtml::normalizeUrl(array("logcomment/deletecomment","id"=>$comment->id)),
                                		array(
										'data'=>'js:{"'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
										'beforeSend'=>'function(){
                                       	   
                                    		}',
                                   			 'success'=>'function(result){
													$( "#delete_div_'.$comment->id.'").remove();
											}'
									
                                ),array('confirm'=>Yii::t('app',"Delete Your Post!"),'id'=>'deletecomment_'.$comment->id,"name"=>'yt_'.$comment->id,'style'=>'background: url("'.Yii::app()->request->baseUrl.'/images/delete_1.png");')); 
								?>
                                </div>
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
                               
							<?php 	
							}
							?>
							</div>	
						<?php
					$this->widget('application.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
						'contentSelector' => '#outer_div',
						'itemSelector' => 'div.individual_feed',
						//'navigationLinkText' => false,
						'loadingText' => Yii::t('app','Loading...'),
						'donetext' => Yii::t('app','No more feeds to show..!'),
						'pages' => $pages,
					));
					
					
				?>
                        </div> <!-- END div class="emp_cntntbx" -->
                    </div> <!-- END div class="emp_tabwrapper" -->
                </div> <!-- END div class="emp_right_contner" -->
            </div> <!-- END div class="cont_right formWrapper" -->
        </td>
    </tr>
</table>

<script type="text/javascript">
/*
$( document ).ready(function() {
 
	$("#cmnt_button").click(function()
	{
    var dataString = $("#comment_text").val();

           $.ajax({
             type: "POST",
             url: <?php echo CJavaScript::encode(Yii::app()->createUrl('employees/logcomment/create'))?>,
             data: {'data':$("#log-form").serialize(),'id':<?php echo $_REQUEST['id']; ?>,'user_id':<?php echo Yii::app()->user->id ?>},
             success: function(result){
			
		
             $("#outer_div").prepend(result);
			 
			 $("#comment_text").val('');
			 
			 			 
			 //$("#comment_count").html(result2);
			 
				
              }
           });   
    });
	
	
});*/

</script>      
