<!--upgrade_div_starts-->
<div class="upgrade_bx">
	<div class="up_banr_imgbx"><a href="https://open-school.org/pricing" target="_blank"><img src="http://tryopenschool.com/images/promo_bnnr_innerpage.png" width="231" height="200" /></a></div>
	<div class="up_banr_firstbx">
   	  <h1>You are Using Community Edition</h1>
	  <a href="https://open-school.org/pricing" target="_blank">upgrade to premium version!</a>
    </div>
	
</div>
<!--upgrade_div_ends-->
<div id="othleft-sidebar">
             <!--<div class="lsearch_bar">
             	<input type="text" value="Search" class="lsearch_bar_left" name="">
                <input type="button" class="sbut" name="">
                <div class="clear"></div>
  </div>-->    <h1><?php echo Yii::t('employees','Manage Employee');?></h1>   
                    <?php
			function t($message, $category = 'cms', $params = array(), $source = null, $language = null) 
{
    return $message;
}

			$this->widget('zii.widgets.CMenu',array(
			'encodeLabel'=>false,
			'activateItems'=>true,
			'activeCssClass'=>'list_active',
			'items'=>array(
					array('label'=>''.Yii::t('employees','List Employees').'<span>'.Yii::t('employees','All Employee Details').'</span>', 'url'=>array('employees/manage') ,'linkOptions'=>array('class'=>'lbook_ico'),
                                   'active'=> (Yii::app()->controller->action->id=='manage')
					    ),  
						                
					array('label'=>''.Yii::t('employees','Create Employee').'<span>'.Yii::t('employees','Add New Employee Details').'</span>',  'url'=>array('employees/create'),'linkOptions'=>array('class'=>'sl_ico' ),'active'=> (Yii::app()->controller->id=='employees' and (Yii::app()->controller->action->id=='create' or Yii::app()->controller->action->id=='create2')), 'itemOptions'=>array('id'=>'menu_1') 
					       ),
						   array('label'=>''.'<h1>'.Yii::t('employees','Employee Leave Management').'</h1>'), 
					
						array('label'=>Yii::t('employees','Add Leave Type').'<span>'.Yii::t('employees','Manage Leave Type').'</span>', 'url'=>array('/employees/employeeLeaveTypes'),'linkOptions'=>array('class'=>'abook_ico'),'active'=> (Yii::app()->controller->id=='employeeLeaveTypes')),
		  				 
						  array('label'=>''.'<h1>'.Yii::t('employees','Attendance Management').'</h1>'),
					
						array('label'=>Yii::t('employees','Attendance Register').'<span>'.Yii::t('employees','Manage Employee Attendance').'</span>', 'url'=>array('/employees/employeeAttendances'),'active'=>(Yii::app()->controller->id=='employeeAttendances' ? true : false),'linkOptions'=>array('class'=>'ar_ico')),
						 array('label'=>''.'<h1>'.Yii::t('employees','Employee Settings').'</h1>'),
						
						array('label'=>Yii::t('employees','Subject Association'.'<span>'.'Associate All Subjects').'</span>', 'url'=>array('employeesSubjects/create'),'active'=>(Yii::app()->controller->id=='employeesSubjects' ? true : false),'linkOptions'=>array('class'=>'sa_ico')),
						array('label'=>Yii::t('employees','Manage Category').'<span>'.Yii::t('employees','All Employee Categories').'</span>', 'url'=>array('employeeCategories/admin'),'active'=>(Yii::app()->controller->id=='employeeCategories' ? true : false),'linkOptions'=>array('class'=>'sm_ico')),
						array('label'=>Yii::t('employees','Manage Department').'<span>'.Yii::t('employees','All Employee Departments').'</span>', 'url'=>array('employeeDepartments/admin'),'active'=>(Yii::app()->controller->id=='employeeDepartments' ? true : false),'linkOptions'=>array('class'=>'md_ico')),
						
						array('label'=>Yii::t('employees','Manage Positions').'<span>'.Yii::t('employees','Employee Employee Positions').'</span>', 'url'=>array('employeePositions/admin'),'active'=>(Yii::app()->controller->id=='employeePositions' ? true : false),'linkOptions'=>array('class'=>'mp_ico')), 
						array('label'=>Yii::t('employees','Manage Grades').'<span>'.Yii::t('employees','All Employee Grades').'</span>', 'url'=>array('employeeGrades/admin'),'active'=>(Yii::app()->controller->id=='employeeGrades' ? true : false),'linkOptions'=>array('class'=>'mg_ico')), 
						
					    
					
					
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