<?php
$this->breadcrumbs=array(
Yii::t('app','Teacher')=>array('index'),
Yii::t('app','Document'),
);


?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('application.modules.employees.views.employees.profileleft');?>
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
                  
						<?php $this->renderPartial('application.modules.employees.views.employees.tab');?>
                       
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
                                        echo Yii::t('app','You are not viewing the current active year. ');
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
								$documents = EmployeeDocument::model()->findAllByAttributes(array('employee_id'=>$_REQUEST['id'])); // Retrieving documents of employee with id $_REQUEST['id'];
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
												$document_status= DocumentUploads::model()->fileStatus(4, $document->id, $document->file);     
												        
                   							 if($document_status==true)
                   							 {
										?>
                                                <tr>
                                                    <td width="90"><?php echo ucfirst($document->title);?></td>
                                                    <td width="100">
                                                    	<?php                                               $status_data="";
														// Setting class for status label
														if($document->is_approved == -1)
														{
															$class = 'tag_disapproved';
                                                                                                                        $status_data=Yii::t('app',"Disapproved");
														}
														elseif($document->is_approved == 0)
														{
															$class = 'tag_pending';
                                                                                                                        $status_data=Yii::t('app',"Pending");
														}
														elseif($document->is_approved == 1)
														{
															$class = 'tag_approved';
                                                                                                                        $status_data=Yii::t('app',"Approved");
														}
														echo '<div style="width:127px">';
														echo '<div class="'.$class.'">'.$status_data.'</div>';
														echo '</div>';
														?>
                                                    </td>
                                                    <td width="100">
                                                    	<ul class="tt-wrapper">
                                                        	<?php
															 if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_approve->settings_value!=0))
                                                            {
															?>
															<li>
                                                            	<?php
																if($document->is_approved == 1)
																{ 
																	echo CHtml::link('<span>'.Yii::t('app','Approved').'</span>', array('employeeDocument/approve','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-approved-disabled','onclick'=>'return false;'));
																}
																else
																{
																	echo CHtml::link('<span>'.Yii::t('app','Approve').'</span>', array('employeeDocument/approve','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-approved','confirm'=>Yii::t('app','Are you sure you want to approve this?'))); 
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
																	
																	echo CHtml::link('<span>'.Yii::t('app','Disapproved').'</span>', array('employeeDocument/disapprove','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-disapproved-disabled','onclick'=>'return false;')); 
																}
																else
																{
																	echo CHtml::link('<span>'.Yii::t('app','Disapprove').'</span>', array('employeeDocument/disapprove','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-disapproved','confirm'=>Yii::t('app','Are you sure you want to disapprove this?'))); 
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
																echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('employeeDocument/update','id'=>$document->employee_id,'document_id'=>$document->id),array('class'=>'tt-edit')); 
																?>
															</li>
															<?php
															}
															
                                                            
                                                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
                                                            {
															?>
															<li>
																<?php echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', array('employeeDocument/deletes','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-delete','confirm'=>Yii::t('app','Are you sure you want to delete this?'))); ?>
															</li>
                                                            <?php
															}
															?>
															<li>
                                                           		<?php echo CHtml::link('<span>'.Yii::t('app','Download').'</span>', array('employeeDocument/download','id'=>$document->id,'employee_id'=>$document->employee_id),array('class'=>'tt-download')); ?>
															</li>
                                                        </ul>
                                                    </td>
												</tr>
                                        <?php
											 } // end document_status
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
                           
                       	</div> <!-- END div class="emp_cntntbx" -->
                        	<?php
							if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
							{
							?>
                        	<div style="width:712px;">
								<?php
                            	if($documents==NULL) 
                                {
									$document = new EmployeeDocument;
								}
                            	  echo $this->renderPartial('/employeeDocument/_form', array('model'=>$document)); 
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
