<div class="pdtab_Con">
	<h3><?php echo Yii::t('app','Guardian(s)'); ?></h3>
	<table width="100%" cellpadding="0" cellspacing="0">
        <tr class="pdtab-h">            
            <td align="center" width="150"><?php echo Yii::t('app','Name'); ?></td> 
            <td align="center" width="150"><?php echo Guardians::model()->getAttributeLabel('relation'); ?></td> 
            <td align="center" width="150"><?php echo Guardians::model()->getAttributeLabel('email'); ?></td>
            <td align="center" width="150"><?php echo Yii::t('app','Actions'); ?></td>                                            
        </tr> 
<?php
		foreach($guardians as $guardian){
			$guardian_list = GuardianList::model()->findByAttributes(array('guardian_id'=>$guardian->id, 'student_id'=>$_REQUEST['id']));
?>
			<tr>
            	<td align="center"><?php echo CHtml::link($guardian->parentFullName("forStudentProfile"),array('/students/guardians/view','id'=>$guardian->id)); ?></td>
                <td align="center">
					<?php
						if($guardian_list){
							echo ucfirst($guardian_list->relation); 
						}
						else{
							echo '-';
						}
					?>
                </td>
                <td align="center"><?php echo $guardian->email; ?></td>
                <td align="center">
        			<div class="tt-wrapper-new">
                
<?php
						$student = Students::model()->findByPk($_REQUEST['id']);
						//Manage Primary Contact
						if($student->parent_id == $guardian->id){
?>
							<a href="javascript:void(0);" class="makeprimary-active"><span><?php echo Yii::t('app','Primary Contact'); ?></span></a>
<?php							
						}
						else{
							if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){ //Edit from student Profile
								echo CHtml::link('<span>'.Yii::t('app','Make Primary Contact').'</span>', "#", array('submit'=>array('/students/guardians/makePrimary','id'=>$guardian->id, 'sid'=>$_REQUEST['id'], 'status'=>1),'confirm'=>Yii::t('app','Are you sure?'), 'class'=>'makeprimary', 'csrf'=>true));
							}
							else{
								echo CHtml::link('<span>'.Yii::t('app','Make Primary Contact').'</span>', "#", array('submit'=>array('/students/guardians/makePrimary','id'=>$guardian->id, 'sid'=>$_REQUEST['id']),'confirm'=>Yii::t('app','Are you sure?'), 'class'=>'makeprimary', 'csrf'=>true));
							}
						}
						//Manage Emergency Contact	
						if($student->immediate_contact_id == $guardian->id){			
?>
							<a href="javascript:void(0);" class="makeemrgency-active"><span><?php echo Yii::t('app','Emergency Contact'); ?></span></a>
<?php													
						}
						else{
							if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){ //Edit from student Profile
								echo CHtml::link('<span>'.Yii::t('app','Make Emergency Contact').'</span>', "#", array('submit'=>array('/students/guardians/makeEmergency','id'=>$guardian->id, 'sid'=>$_REQUEST['id'], 'status'=>1),'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makeemrgency ', 'csrf'=>true));
							}
							else{
								echo CHtml::link('<span>'.Yii::t('app','Make Emergency Contact').'</span>', "#", array('submit'=>array('/students/guardians/makeEmergency','id'=>$guardian->id, 'sid'=>$_REQUEST['id']),'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makeemrgency ', 'csrf'=>true));
							}
						}
						
						//Edit Guardian Details	
						if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){ //Edit from student Profile
							echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/guardians/update','id'=>$guardian->id, 'sid'=>$_REQUEST['id'], 'status'=>1),array('class'=>'makeedit'));
						}
						else{
							echo CHtml::link('<span>'.Yii::t('app','Edit').'</span>', array('/students/guardians/update','id'=>$guardian->id, 'sid'=>$_REQUEST['id']),array('class'=>'makeedit'));
						}
						
						//Remove Guardian 
						if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){ //student Profile
							echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/guardians/removeGuardian','id'=>$guardian->id,'sid'=>$_REQUEST['id'],'status'=>1), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makedelete', 'csrf'=>true));
						}
						else{
							echo CHtml::link('<span>'.Yii::t('app','Delete').'</span>', "#", array('submit'=>array('/students/guardians/removeGuardian','id'=>$guardian->id,'sid'=>$_REQUEST['id']), 'confirm'=>Yii::t('app','Are you sure?'),'class'=>'makedelete', 'csrf'=>true));
						}
?>                	
    
    				</div>            	
                </td>
            </tr>
<?php			
		}
?>	        
	</table>              
</div>

