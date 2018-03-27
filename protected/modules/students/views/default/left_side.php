<style>
#othleft-sidebar ul li{
	position:relative;
}

</style>
<div id="othleft-sidebar">
	<h1><?php echo Yii::t('app','Manage Students');?></h1>          
    <?php	
				
		$countof_student_pendinglist = Yii::app()->db->createCommand()
			  ->select("*")
			  ->from('students')
			  ->where('status=:status and is_completed=:is_completed and academic_yr=:academic_yr', array(':status'=>0,':is_completed'=>3,':academic_yr'=>Yii::app()->user->year))
			  ->queryAll();
										
		function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
		{
			return $message;
		}

		$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
				array('label'=>''.Yii::t('app','Students List').'<span>'.Yii::t('app','All Students Details').'</span>', 'url'=>array('/students/students/manage') ,'linkOptions'=>array('class'=>'studentlist_ico'),
					'active'=> ((Yii::app()->controller->id=='students') && (in_array(Yii::app()->controller->action->id,array('manage')))) ? true : false
				),                               
				array('label'=>''.Yii::t('app','Create New Student').'<span>'.Yii::t('app','New Admission').'</span>',  'url'=>array('/students/students/create') ,'linkOptions'=>array('class'=>'creatnew-student_ico' ),'active'=> ((Yii::app()->controller->action->id=='create' and  Yii::app()->controller->id=='students') or (Yii::app()->controller->action->id=='create' and  Yii::app()->controller->id=='guardians') or Yii::app()->controller->id=='studentPreviousDatas' or Yii::app()->controller->id=='studentDocument'), 'itemOptions'=>array('id'=>'menu_1') 
				),						   
				array('label'=>''.Yii::t('app','Student Field Settings').'<span>'.Yii::t('app','Add Additional Fields').'</span>',  'url'=>array('/dynamicform/formFields/create') ,'linkOptions'=>array('class'=>'mg_ico' ),'active'=> (Yii::app()->controller->id=='formfields'), 'itemOptions'=>array('id'=>'menu_1') 
				),
				array('label'=>''.Yii::t('app','Manage Log Category').'<span>'.Yii::t('app','Manage Student Log Category').'</span>',  'url'=>array('/students/logCategory') ,'linkOptions'=>array('class'=>'managelog-catgry_ico' ),'active'=> (Yii::app()->controller->id=='logCategory'), 'itemOptions'=>array('id'=>'menu_1') 
				),						   
				array('label'=>Yii::t('app','Manage Student Category').'<span>'.Yii::t('app','Manage Students Category').'</span>', 'url'=>array('/students/studentCategory'),'linkOptions'=>array('class'=>'managestudent-catgry_ico' ),'active'=> (Yii::app()->controller->id=='studentCategory'),),
				
				
				array('label'=>''.t('<h1>'.Yii::t('app','Manage Guardians').'</h1>')),				
				array('label'=>''.Yii::t('app','List Guardians').'<span>'.Yii::t('app','All Guardians Details').'</span>', 'url'=>array('/students/guardians/admin'),'active'=> ((Yii::app()->controller->id=='guardians') && (in_array(Yii::app()->controller->action->id,array('update','view','admin','index'))) ? true : false),'linkOptions'=>array('id'=>'menu_2','class'=>'list-guardians_ico ')),
				array('label'=>''.t('<h1>'.Yii::t('app','Online Registration').'<span class="leftside_premicon"></span></h1>')),
				array('label'=>Yii::t('app','Online Applicants').'<span>'.Yii::t('app','Manage Online Registrations').'</span>', 'url'=>array('/students'),'linkOptions'=>array('class'=>'sm_ico' ),'active'=> ((Yii::app()->controller->id=='admin') && (in_array(Yii::app()->controller->action->id,array('onlineapplicants','view','profileedit'))) ? true : false),'linkOptions'=>array('id'=>'menu_3','class'=>'online-registration_ico')),
				array('label'=>Yii::t('app','Student Approval').'<span class="count">'.count($countof_student_pendinglist).'</span><span>'.Yii::t('app','Approve Online Registrations').'</span>', 'url'=>array('/students'),'linkOptions'=>array('class'=>'sm_ico' ),'active'=> ((Yii::app()->controller->id=='admin' && in_array(Yii::app()->controller->action->id,array('approval')))  ? true : false),'linkOptions'=>array('id'=>'menu_3','class'=>'student-approval_ico ')),
				array('label'=>Yii::t('app','Waiting List').'<span>'.Yii::t('app','Manage Waiting List').'</span>', 'url'=>array('/students'),'linkOptions'=>array('class'=>'sm_ico' ),'active'=> ((Yii::app()->controller->id=='waitinglistStudents')  ? true : false),'linkOptions'=>array('id'=>'menu_3','class'=>'waiting-list_ico')),
				array('label'=>Yii::t('app','Incomplete Registrations').'<span>'.Yii::t('app','Manage Incomplete Registrations').'</span>', 'url'=>array('/students'),'linkOptions'=>array('class'=>'sm_ico' ),'active'=> ((Yii::app()->controller->id=='admin') and (Yii::app()->controller->action->id == 'incompleteReg')  ? true : false),'linkOptions'=>array('id'=>'menu_3','class'=>'complt-regs_ico')),
				array('label'=>''.t('<h1>'.Yii::t('app','Student Leave Management').'<span class="leftside_premicon"></span></h1>')),
				array('label'=>Yii::t('app','Add Leave Type').'<span>'.Yii::t('app','Manage Leave Type').'</span>', 'url'=>array('/students'),'linkOptions'=>array('class'=>'addleave-type_ico'),'active'=> (Yii::app()->controller->id=='studentLeaveTypes')),
				
				array('label'=>''.t('<h1>'.Yii::t('app','Archive').'</h1>')),	
				array('label'=>Yii::t('app','Students').'<span>'.Yii::t('app','Manage Students Archive').'</span>', 'url'=>array('/students/archive/students'),'linkOptions'=>array('class'=>'students_ico'),'active'=> (Yii::app()->controller->id=='archive' and Yii::app()->controller->action->id == 'students')),
				array('label'=>Yii::t('app','Guardians').'<span>'.Yii::t('app','Manage Guardians Archive').'</span>', 'url'=>array('/students/archive/guardians'),'linkOptions'=>array('class'=>'guardians_ico'),'active'=> (Yii::app()->controller->id=='archive' and Yii::app()->controller->action->id == 'guardians')),
			),
		)); 
			
			
