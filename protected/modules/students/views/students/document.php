<?php
$this->breadcrumbs=array(
Yii::t('app','Students')=>array('index'),
Yii::t('app','Document'),
);


?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('profileleft');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">

<h1><?php echo Yii::t('app','Student Profile');?></h1>

                 <!-- END div class="edit_bttns last" -->
                <div class="clear"></div>
                
                <div class="emp_right_contner">
                 	<?php
					// Display Success Flash Messages 
					Yii::app()->clientScript->registerScript(
					   'myHideEffect',
					   '$(".flashMessage").animate({opacity: 1.0}, 3000).fadeOut("slow");',
					   CClientScript::POS_READY
					);
					?>
					<?php
					if(Yii::app()->user->hasFlash('successMessage')): 
					?>
					<div class="flashMessage" style="background:#FFF; color:#C00; padding-left:200px; top:150px;">
						<?php echo Yii::app()->user->getFlash('successMessage'); ?>
					</div>
					<?php
					endif;
					// END Display Success Flash Messages
					?>
                    
                    <?php
					// Display Error Flash Messages
					if(Yii::app()->controller->action->id=='document')
					{
					?>
						<?php
						if(Yii::app()->user->hasFlash('errorMessage')): 
						?>
						<div class="flashMessage" style="background:#FFF; color:#C00; padding-left:200px; top:150px;">
							<?php echo Yii::app()->user->getFlash('errorMessage'); ?>
						</div>
						<?php
						endif;
						// END Display Error Flash Messages
					}
                    ?>
                    
                    
                    <div class="emp_tabwrapper">
						<?php $this->renderPartial('application.modules.students.views.students.tab');?>
                        <div class="clear"></div>
                        <div class="emp_cntntbx">
                        	<?php
							$current_academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
							if(Yii::app()->user->year)
							{
								$year = Yii::app()->user->year;
							}
							else
							{
								$year = $current_academic_yr->config_value;
							}
							$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
							$is_edit = PreviousYearSettings::model()->findByAttributes(array('id'=>3));
							$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
							$is_approve = PreviousYearSettings::model()->findByAttributes(array('id'=>5));
							$is_disapprove = PreviousYearSettings::model()->findByAttributes(array('id'=>6));
							
							if($year != $current_academic_yr->config_value and ($is_create ->settings_value==0 or $is_edit->settings_value==0 or $is_delete->settings_value==0 or $is_approve->settings_value==0 or $is_disapprove->settings_value==0))
{
?>
                            <div>
                                <div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                                    <div class="y_bx_head" style="width:650px;">
                                    <?php 
                                        echo Yii::t('app','You are not viewing the current active year.');
                                        if($is_create->settings_value==0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_approve->settings_value!=0 and $is_disapprove->settings_value!=0)
                                        { 
                                            echo Yii::t('app','To upload the documents, enable Create option in Previous Academic Year Settings.');
                                        }
                                        elseif($is_create->settings_value!=0 and $is_edit->settings_value==0 and $is_delete->settings_value!=0 and $is_approve->settings_value!=0 and $is_disapprove->settings_value!=0)
                                        {
                                            echo Yii::t('app','To edit the documents, enable Edit option in Previous Academic Year Settings.');
                                        }
                                        elseif($is_create->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value==0 and $is_approve->settings_value!=0 and $is_disapprove->settings_value!=0)
                                        {
                                            echo Yii::t('app','To delete the documents, enable Delete option in Previous Academic Year Settings.');
                                        }
										elseif($is_create->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_approve->settings_value==0 and $is_disapprove->settings_value!=0)
                                        {
                                            echo Yii::t('app','To approve the documents, enable Approve option in Previous Academic Year Settings.');
                                        }
										elseif($is_create->settings_value!=0 and $is_edit->settings_value!=0 and $is_delete->settings_value!=0 and $is_approve->settings_value!=0 and $is_disapprove->settings_value==0)
                                        {
                                            echo Yii::t('app','To dispprove the documents, enable Approve option in Previous Academic Year Settings.');
                                        }
                                        else
                                        {
                                            echo Yii::t('app','To manage the documents, enable the required options in Previous Academic Year Settings.');	
                                        }
                                    ?>
                                    </div>
                                    <div class="y_bx_list" style="width:650px;">
                                        <h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
                                    </div>
                                </div>
                            </div>
                            <br />
                        <?php
                        }
                        ?>
                            <div class="document_table">
                            	<?php
								$documents = StudentDocument::model()->findAllByAttributes(array('student_id'=>$_REQUEST['id'])); // Retrieving documents of student with id $_REQUEST['id'];
								
								?>
                                <table width="100%" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                       <th><?php echo Yii::t('app','Document Name'); ?></th>
                                    </tr>
                                </tbody>
                                </table>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:none;">
                                    	<?php
                                    	if($documents) // If documents present
										{
											foreach($documents as $document) // Iterating the documents
											{
												$document_status= DocumentUploads::model()->fileStatus(3, $document->id, $document->file);     
												        
                   							 if($document_status==true)
                   							 {
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
                                                    	<?php                                                   $status_data="";
														// Setting class for status label
														if($document->is_approved == -1)
														{
															$class = 'tag_disapproved';
                                                                                                                        $status_data=Yii::t('app',"Disapproved");
														}
														elseif($document->is_approved == 0)
														{
															$class = 'tag_pending';
                                                                                                                        $status_data=Yii::t('app','Pending');
														}
														elseif($document->is_approved == 1)
														{
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
															 if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_approve->settings_value!=0))
                                                            {
															?>
															<li>
                                                            	<?php
																if($document->is_approved == 1)
																{ 
																	echo CHtml::link('<span>'.Yii::t('app','Approved').'</span>', array('studentDocument/approve','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-approved-disabled','onclick'=>'return false;'));
																}
																else
																{
																	echo CHtml::link('<span>'.Yii::t('app','Approve').'</span>', array('studentDocument/approve','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-approved','confirm'=>Yii::t('app','Are you sure you want to approve this?'))); 
																}
																?>
															</li>
                                                            <?php
															}
															
															 if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_disapprove->settings_value!=0))
                                                            {
															?>
                                                            <li>
                                                            	<?php 
																if($document->is_approved == -1)
																{
																	
																	echo CHtml::link('<span>'.Yii::t('app','Disapproved').'</span>', array('studentDocument/disapprove','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-disapproved-disabled','onclick'=>'return false;')); 
																}
																else
																{
																	echo CHtml::link('<span>'.Yii::t('app','Disapprove').'</span>', array('studentDocument/disapprove','id'=>$document->id,'student_id'=>$document->student_id),array('class'=>'tt-disapproved','confirm'=>Yii::t('app','Are you sure you want to disapprove this?'))); 
																}
																
																?>
															</li>
                                                            <?php
															}
                                                            
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
                                                            {
															?>
															 <li>
                                                             	<?php	
																echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('studentDocument/update','id'=>$document->student_id,'document_id'=>$document->id),array('class'=>'tt-edit')); 
																?>
															</li>
															<?php
															}
															
                                                            
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                            {
															?>
															<li>
																<?php echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('studentDocument/deletes','id'=>$document->id,'student_id'=>$document->student_id), 'class'=>'tt-delete','confirm'=>Yii::t('app','Are you sure you want to delete this?'), 'csrf'=>true)); ?>
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
											 } // End document_status
											} // End foreach($documents as $document)
										}
										else // If no documents present
										{
										?>
                                            <tr>
                                                <td colspan="3" style="text-align:center;"><?php echo Yii::t('app','No document(s) uploaded'); ?></td>
                                            </tr>
                                        <?php
										}
										?>
                                    </table>
                              
                            </div><!-- END div class="document_table" -->
                            <br />
                            
                            
                             <!--missing documents-->
                           <h3><?php echo Yii::t('app','Missing Documents'); ?></h3>
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
								
								
								  $criteria = new CDbCriteria;
								  $criteria->join = 'LEFT JOIN student_document sd ON sd.doc_type = t.name and sd.student_id = '.$_REQUEST['id'].'';
								  $criteria->addCondition('sd.doc_type IS NULL');
									$doc_lists = StudentDocumentList::model()->findAll( $criteria);
									
									
								if($doc_lists!=NULL)
								{
				
									foreach($doc_lists as $list)
									{
										
										?>
                                        <tr>
                                         <td width="90%"><?php echo ucfirst($list->name);?></td>
                                        </tr>
                                        <?php
									}
								}
								else
								{
											?>  <tr>
                                                <td colspan="3" style="text-align:center;"><?php echo Yii::t('app','No missing document(s)'); ?></td>
                                            </tr>
                                            <?php
									}
									
								
								?>
                                    </table>
                              
                            </div>
                       	</div> <!-- END div class="emp_cntntbx" -->                   
						<br />

                        	<?php
							if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
							{
							?>
                        	<div style="width:712px;">
								<?php
                            	if($documents==NULL) 
                                {
									$document = new studentDocument;
								}
                            	  echo $this->renderPartial('/studentDocument/_form', array('model'=>$document)); 
								?>
                         	</div>
                            <?php
							}
							?>
                    </div> <!-- END div class="emp_tabwrapper" -->
                </div> <!-- END div class="emp_right_contner" -->
                
            </div> <!-- END div class="cont_right formWrapper" -->
          
        </td>
    </tr>
</table>
