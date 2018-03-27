<div class="logedit_form">
                               
                                <?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'log-form',
									'enableAjaxValidation'=>true,
									'enableClientValidation'=>true,
								)); ?>
                                
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td width="83%"><?php
										$criteria = new CDbCriteria;
										$criteria->compare('type',1,true); 
										$data_1 = CHtml::listData(LogCategory::model()->findAll($criteria),'id','name');
										echo $form->dropDownList($model1,'category_id',$data_1,array('prompt'=>Yii::t('app','Select Category'),'id'=>'category','options'=>array()));  ?>
                                        <?php echo $form->error($model1,'category_id'); ?>
                                        </td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                        
                                      <tr>
                                        <td width="83%"><?php 											
											$model1->comment = strip_tags($model1->comment);
											echo $form->textArea($model1,'comment',array('style'=>'width:94% !important;min-width:94%','id'=>'comment_text'));?>
                                         <?php echo $form->error($model1,'comment'); ?></td>
                                        </tr>
                                        <tr><td>&nbsp;</td></tr>
                                     
                                        <tr>
                                        <td >
                                        <?php echo $form->hiddenField($model1,'user_id');?>
                                        <?php echo $form->hiddenField($model1,'id');?>
                       					<?php 
					   
										echo CHtml::ajaxSubmitButton(Yii::t('app','Submit'),
										CHtml::normalizeUrl(array('/students/logcomment/create')),
										 array('dataType'=>'json', 'type'=>'post','success'=>'js: function(data) {
											 
											
											if (data.status == "error")
											{
												
												$.each(data.error, function(key, val) {
													
													$("#delete_div_'.$model1->id.' #"+key+"_em_").html(String(val)).show();
												});
												
											}
											else
											{
												
												$( "#delete_div_'.$model1->id.'").replaceWith(data.content);
												
											}
											    
										}'),array('id'=>'cmnt_button_'.$model1->id.'_'.time(),'name'=>'','class'=>'formbut','style'=>'')); 
							
										?>
	
                                        
                                        
                                        </td>
                                      </tr>
                                    </table>
								 <?php $this->endWidget(); ?>
                                </div>