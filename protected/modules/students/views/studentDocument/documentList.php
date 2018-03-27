<style type="text/css">
.document_table{
	margin-top:10px;
}
</style>
<?php
$criteria 				= new CDbCriteria;
$criteria->condition 	= 'student_id=:student_id AND is_approved<>:is_approved';
$criteria->params		= array(':student_id'=>$_REQUEST['id'],':is_approved'=> -1);
$documents = StudentDocument::model()->findAll($criteria); 

if($documents){
?>
	<div class="document_table">
        <table width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                	<th><?php echo Yii::t('app','Document Name'); ?></th>
                </tr>
            </tbody>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:none;">
<?php
			foreach($documents as $document){
				$document_status= DocumentUploads::model()->fileStatus(3, $document->id, $document->file);     												
				if($document_status==true){
?>										
                	<tr>
                    	<td width="40%">
							<?php
								if($document->doc_type == 'Others' and $document->title != NULL){									 
									echo ucfirst($document->title);																
								}else{
									echo ucfirst($document->doc_type);
								}
							?>
                        </td>
                        <td width="30%">
<?php                                                    	                                                   
							$status_data="";														
							if($document->is_approved == -1){
								$class = 'tag_disapproved';
								$status_data=Yii::t('app',"Disapproved");
							}
							elseif($document->is_approved == 0){
								$class = 'tag_pending';
								$status_data=Yii::t('app','Pending');
							}
							elseif($document->is_approved == 1){
								$class = 'tag_approved';
								$status_data=Yii::t('app','Approved');
							}
							echo '<div style="width:127px">';
							echo '<div class="'.$class.'">'.$status_data.'</div>';
							echo '</div>';
?>														
						</td>
                        <td width="30%">
                            <ul class="tt-wrapper">
<?php                                                        	
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_approve->settings_value!=0)){
?>															
                                    <li>
<?php                               
                                        if($document->is_approved == 1){ 
                                            echo CHtml::link('<span>'.Yii::t('app','Approved').'</span>', array('studentDocument/approve','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-approved-disabled','onclick'=>'return false;'));
                                        }
                                        else{
                                            echo CHtml::link('<span>'.Yii::t('app','Approve').'</span>', array('studentDocument/approve','id'=>$document->id,'student_id'=>$document->student_id, 'flag'=>1),array('class'=>'tt-approved','confirm'=>Yii::t('app','Are you sure you want to approve this?'))); 
                                        }
?>                                
                                    </li>
<?php                                                            
								}
															
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_disapprove->settings_value!=0)){
?>															
                                    <li>
<?php                                     
										if($document->is_approved == -1){										
											echo CHtml::link('<span>'.Yii::t('app','Disapproved').'</span>', array('studentDocument/disapprove','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-disapproved-disabled','onclick'=>'return false;')); 
										}
										else{
											echo CHtml::link('<span>'.Yii::t('app','Disapprove').'</span>', array('studentDocument/disapprove','id'=>$document->id,'student_id'=>$document->student_id, 'flag'=>1),array('class'=>'tt-disapproved','confirm'=>Yii::t('app','Are you sure you want to disapprove this?'))); 
										}                                    
?>                                    
                                    </li>
<?php                                                            
								}
                                                            
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0)){
?>															
                                     <li>
<?php                                        	
                                        echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('studentDocument/update','id'=>$document->student_id,'document_id'=>$document->id,'flag'=>1),array('class'=>'tt-edit')); 
?>                                        
                                    </li>
<?php															
								}
															
                                                            
								if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0)){
?>															
                                    <li>
<?php                                     
										echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('studentDocument/deletes','id'=>$document->id,'student_id'=>$document->student_id,'flag'=>1), 'class'=>'tt-delete','confirm'=>Yii::t('app','Are you sure you want to delete this?'), 'csrf'=>true)); 
?>										
                                    </li>
<?php                                                            
								}
?>															
                                <li>
                                	<?php echo CHtml::link('<span>'.Yii::t('app','Download').'</span>', array('studentDocument/download','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-download')); ?>
                                </li>
							</ul>
						</td>
					</tr>
<?php                                        	
				}
			}
?>        
        </table>
    </div>
<?php	
}
?>
