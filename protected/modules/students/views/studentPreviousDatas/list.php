<style>
	.accordion-item-active .accordion-header h1{
		 float:none;	
	}
	.acordn-bg .accordion-header h1{
		 float:none;	
	}
</style>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/woco.accordion.min.js"></script>
<div class="acordn-bg">                      
	<div class="acrdn-tab-bg">                
    	<div class="accordion">       		
<?php            
			$previousDatas = StudentPreviousDatas::model()->findAllByAttributes(array('student_id'=>$_REQUEST['id']));
			$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
			if($previousDatas){
				$i = 1;
				foreach($previousDatas as $index=>$previousData){
?> 			      
                    <h1><?php echo Yii::t('app','Previous Detail').' #'.$i; ?>
                    
                        <div class="box-btn">
                            <div class="tt-wrapper-new">
                                <?php                        
                                    if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
                                        echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/studentPreviousDatas/update','id'=>$_REQUEST['id'], 'pid'=>$previousData->id, 'status'=>1),array('class'=>'makeedit')); 										
                                        echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/studentPreviousDatas/delete','id'=>$previousData->id,'sid'=>$_REQUEST['id'],'status'=>1), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makedelete', 'csrf'=>true));																
                                    }
                                    else{
                                        echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/studentPreviousDatas/update','id'=>$_REQUEST['id'], 'pid'=>$previousData->id),array('class'=>'makeedit'));								
                                        echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/studentPreviousDatas/delete','id'=>$previousData->id,'sid'=>$_REQUEST['id']), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makedelete', 'csrf'=>true)); 																		
                                    }                        
                                ?>
                            </div>  
                        </div>
                    </h1>
            
            		<div class="tab-cnt-bg" <?php if($index==0){?>style="display:none;"<?php }?>>
            			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-border-none">
							<tbody>
								<?php if(FormFields::model()->isVisible('institution','StudentPreviousDatas','forStudentProfile')){?> 
                                    <tr>                    	
                                        <td width="300"><?php echo $previousData->getAttributeLabel('institution');?></td>
                                        <td width="40">:</td>
                                        <td>
                                            <?php 
                                                if($previousData->institution!=NULL){
                                                    echo $previousData->institution;
                                                }
                                                else{ 
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
                                <?php if(FormFields::model()->isVisible('year','StudentPreviousDatas','forStudentProfile')){?> 
                                    <tr>                    	
                                        <td  width="300"><?php echo $previousData->getAttributeLabel('year');?></td>
                                         <td width="40">:</td>
                                        <td>
                                            <?php 
                                                if($previousData->year!=NULL){
                                                    echo $previousData->year;
                                                }
                                                else{ 
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
								<?php if(FormFields::model()->isVisible('course','StudentPreviousDatas','forStudentProfile')){?> 
                                    <tr>                    	
                                        <td  width="300"><?php echo $previousData->getAttributeLabel('course');?></td>
                                         <td width="40">:</td>
                                        <td>
                                            <?php 
                                                if($previousData->course!=NULL){
                                                    echo $previousData->course;
                                                }
                                                else{ 
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
								<?php if(FormFields::model()->isVisible('total_mark','StudentPreviousDatas','forStudentProfile')){?> 
                                    <tr>                    	
                                        <td  width="300"><?php echo $previousData->getAttributeLabel('total_mark');?></td>
                                         <td width="40">:</td>
                                        <td>
                                            <?php 
                                                if($previousData->total_mark!=NULL){
                                                    echo $previousData->total_mark;
                                                }
                                                else{ 
                                                    echo '-';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?> 
                    			<!-- DYNAMIC FIELDS START -->
								<?php 
                                $fields= FormFields::model()->getDynamicFields(4, 1, "forStudentProfile");
                                if($fields)
                                {
                                    foreach ($fields as $key => $field) 
                                    {							
                                        if($field->form_field_type!=NULL)
                                        {
                                            if(FormFields::model()->isVisible($field->varname,'StudentPreviousDatas','forStudentProfile'))
                                            {
                                                ?>    
                                                 <tr> 
                                                    <td  width="300"> <?php echo $previousData->getAttributeLabel($field->varname);?></td>    
                                                     <td width="40">:</td>
                                                    <td>
                                                    <?php
                                                     $field_name = $field->varname;
                                                      if(in_array($field->form_field_type, array(3, 4, 5))){  // dropdown, radio, checkbox
                                                        echo FormFields::model()->getFieldValue($previousData->$field_name);
                                                      }
                                                      else if($field->form_field_type==6){  // date value
													  		if($settings!=NULL and $previousData->$field_name!=NULL and $previousData->$field_name!="0000-00-00"){
																$date1  = date($settings->displaydate,strtotime($previousData->$field_name));
																echo $date1;
															}
															else{
																if($previousData->$field_name!=NULL and $previousData->$field_name!="0000-00-00"){
																	echo $previousData->$field_name;
																}
																else{
																	echo '-';
																}
															}															
                                                      }
                                                      else{
                                                        echo (isset($previousData->$field_name) and $previousData->$field_name!="")?$previousData->$field_name:"-";
                                                      }
                                                    ?>
                                                    </td>
                                                </tr>                                        
                                                <?php
                                            } 
                                        } 				                                            
                                    }
                                }
                                ?>
                   
                    			<!-- DYNAMIC FIELDS END -->   
							</tbody>
						</table> 
					</div>
<?php			
					$i++;
				}
			}
?>                          
        </div>
	</div>
</div>
<script type="text/javascript">
	$(".accordion").accordion();
</script> 
