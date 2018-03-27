<style type="text/css">
.pagetab-bg .li_hide{
	display:none !important;
}

.student-postn{
	 top:16px;
	 right:19px;	
}
</style>
<?php
	$student_active 	= '';
	$parent_active		= '';
	$previous_active 	= '';
	$document_active	= '';
		
	if(Yii::app()->controller->id == 'students' and (Yii::app()->controller->action->id == 'create' or Yii::app()->controller->action->id == 'update')){
		$student_active = 'active';
		if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
			$student_hide 		= '';			
			$parent_hide		= 'li_hide';
			$previous_hide		= 'li_hide';
			$document_hide		= 'li_hide';
		}
	}
	if(Yii::app()->controller->id == 'guardians' and Yii::app()->controller->action->id == 'create'){
		$parent_active = 'active';
		if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
			$parent_hide 		= '';
			$student_hide 		= 'li_hide';			
			$previous_hide		= 'li_hide';
			$document_hide		= 'li_hide';
		}
	}
	if(Yii::app()->controller->id == 'studentPreviousDatas' and (Yii::app()->controller->action->id == 'create' or Yii::app()->controller->action->id == 'update')){
		$previous_active = 'active';
		if(isset($_REQUEST['status']) and $_REQUEST['status'] == 1){
			$previous_hide 		= '';
			$student_hide 		= 'li_hide';
			$parent_hide		= 'li_hide';			
			$document_hide		= 'li_hide';
		}
	}
	if(Yii::app()->controller->id == 'studentDocument' and (Yii::app()->controller->action->id == 'create' or Yii::app()->controller->action->id == 'update')){
		$document_active = 'active';
	}
	
?>
<div class="right-pg-hd">

<?php /*?>        <h1>
            <?php 
                echo Yii::t('app','Enrolment');
                if(isset($_REQUEST['id']) and $_REQUEST['id'] != NULL){
                    $current_student = Students::model()->findByPk($_REQUEST['id']);
                    if(FormFields::model()->isVisible("fullname", "Students", 'forStudentProfile')){
                        echo ' : '.$current_student->studentFullName('forAdminRegistration');
                    } 
                }
            ?>
        </h1><?php */?>
<h1><?php echo Yii::t('app','Enrolment');?></h1>       
</div>

<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php
		if(isset($_REQUEST['id'])){
			echo CHtml::link(Yii::t('app','View Profile'), array('/students/students/view','id'=>$_REQUEST['id']), array('class'=>'a_tag-btn'));
		}
	?></li>                                   
</ul>
</div> 
</div>
<div class="page-tab">
    <div class="pagetab-bg">
        <ul>
            <li class="<?php echo $student_active.' '.$student_hide; ?>">            	
<?php 
					if(isset($_REQUEST['id']) and !isset($_REQUEST['status'])){
						echo '<h2 class="hvr-syle">'.CHtml::link(Yii::t('app','Student Details'), array('/students/students/update','id'=>$_REQUEST['id'], 'flag'=>0)).'</h2>';
					}
					else{
						echo '<h2 class="no_hvr_style">'.Yii::t('app','Student Details').'</h2>';
					}
?>                                     	
            </li>
            <li class="<?php echo $parent_active.' '.$parent_hide; ?>">            	
<?php 
				if(isset($_REQUEST['id']) and !isset($_REQUEST['status'])){
					echo '<h2 class="hvr-syle">'.CHtml::link(Yii::t('app','Guardian Details'), array('/students/guardians/create','id'=>$_REQUEST['id'])).'</h2>';
				}
				else{
					echo '<h2 class="no_hvr_style">'.Yii::t('app','Guardian Details').'</h2>';
				}
?>                                     	
            </li>
            <li class="<?php echo $previous_active.' '.$previous_hide; ?>">            	
<?php 
				if(isset($_REQUEST['id']) and !isset($_REQUEST['status'])){
					echo '<h2 class="hvr-syle">'.CHtml::link(Yii::t('app','Previous Details'), array('/students/studentPreviousDatas/create','id'=>$_REQUEST['id'])).'</h2>';
				}
				else{
					echo '<h2 class="no_hvr_style">'.Yii::t('app','Previous Details').'</h2>';
				}
?>                                     	
            </li>
            <li class="<?php echo $document_active.' '.$document_hide; ?>">            	
<?php 
				if(isset($_REQUEST['id']) and !isset($_REQUEST['status'])){
					echo '<h2 class="hvr-syle">'.CHtml::link(Yii::t('app','Student Documents'), array('/students/studentDocument/create','id'=>$_REQUEST['id'])).'</h2>';
				}
				else{
					echo '<h2 class="no_hvr_style">'.Yii::t('app','Student Documents').'</h2>';
				}
?>                                     	
            </li>                        
        </ul>
    </div>	
</div>

