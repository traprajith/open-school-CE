<style>
#othleft-sidebar ul li{
	position:relative;
}
.count{
	position:absolute;
	top:13px;
	right:19px;
	min-width:40px;
	padding:5px 0px !important;
	background-color:#405875;
	color:#FFF !important;
	text-align:center;
	font-size:12px;
	-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}
</style>
<div id="othleft-sidebar">
             <!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>-->    <h1><?php echo Yii::t('app','Manage Teacher');?></h1>   
                    <?php			
			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.Yii::t('app','List Teachers').'<span>'.Yii::t('app','All Teacher Details').'</span>', 'url'=>array('employees/manage') ,'linkOptions'=>array('class'=>'teacher-list_ico'),
                                   'active'=> (Yii::app()->controller->action->id=='manage')
					    ),  
						                
					array('label'=>''.Yii::t('app','Create Teacher').'<span>'.Yii::t('app','Add New Teacher Details').'</span>',  'url'=>array('employees/create'),'linkOptions'=>array('class'=>'creatnew-teacher_ico' ),'active'=> (Yii::app()->controller->id=='employees' and (Yii::app()->controller->action->id=='create' or Yii::app()->controller->action->id=='create2')), 'itemOptions'=>array('id'=>'menu_1') 
					       ), 
						   
						array('label'=>''.Yii::t('app','Manage Log Category').'<span>'.Yii::t('app','Manage Teacher Log Category').'</span>',  'url'=>array('/employees/logCategory'),'linkOptions'=>array('class'=>'managelog-catgry_ico' ),'active'=> (Yii::app()->controller->id=='logCategory'), 'itemOptions'=>array('id'=>'menu_1') 
					       ),
						   

						  array('label'=>''.'<h1>'.Yii::t('app','Attendance Management').'<span class="leftside_premicon"></span></h1>'),
					
						array('label'=>Yii::t('app','Attendance Register').'<span>'.Yii::t('app','Manage Teacher Attendance').'</span>', 'url'=>array('#'),'active'=>(Yii::app()->controller->id=='employeeAttendances' ? true : false),'linkOptions'=>array('class'=>'attendance-register_ico')),
						
						
						 array('label'=>''.'<h1>'.Yii::t('app','Teacher Settings').'</h1>'),
						
						array('label'=>Yii::t('app','Subject Association').'<span>'.Yii::t('app','Associate All Subjects').'</span>', 'url'=>array('employeesSubjects/create'),'active'=>(Yii::app()->controller->id=='employeesSubjects' ? true : false),'linkOptions'=>array('class'=>'subject-association_ico')),
						array('label'=>Yii::t('app','Manage Category').'<span>'.Yii::t('app','All Teacher Categories').'</span>', 'url'=>array('employeeCategories/admin'),'active'=>(Yii::app()->controller->id=='employeeCategories' ? true : false),'linkOptions'=>array('class'=>'managestudent-catgry_ico')),
						array('label'=>Yii::t('app','Manage Department').'<span>'.Yii::t('app','All Teacher Departments').'</span>', 'url'=>array('employeeDepartments/admin'),'active'=>(Yii::app()->controller->id=='employeeDepartments' ? true : false),'linkOptions'=>array('class'=>'manage-departnent_ico')),
						
						array('label'=>Yii::t('app','Manage Positions').'<span>'.Yii::t('app','Teacher Positions').'</span>', 'url'=>array('employeePositions/admin'),'active'=>(Yii::app()->controller->id=='employeePositions' ? true : false),'linkOptions'=>array('class'=>'manage-positions_ico')), 
						array('label'=>Yii::t('app','Manage Grades').'<span>'.Yii::t('app','All Teacher Grades').'</span>', 'url'=>array('employeeGrades/admin'),'active'=>(Yii::app()->controller->id=='employeeGrades' ? true : false),'linkOptions'=>array('class'=>'manage-grade_ico')), 
						//array('label'=>Yii::t('employees','Manage Employee PaySlip').'<span>'.Yii::t('employees','All Employee PaySlip').'</span>', 'url'=>array('employeePayslip/admin'),'active'=>(Yii::app()->controller->id=='employeePayslip' ? true : false),'linkOptions'=>array('class'=>'mg_ico')), 
					
				),
			)); ?>
		
		</div>
        
        <script type="text/javascript">

	$(document).ready(function () {
            //Hide the second level menu
            $('#othleft-sidebar ul li ul').hide();            
            //Show the second level menu if an item inside it active
            $('li.list_active').parent("ul").show();
            
            $('#othleft-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                 if($(this).parent().children('ul').length>0){                  
                    $(this).parent().children('ul').toggle();    
                 }
                 
            });
          
            
        });

    </script>