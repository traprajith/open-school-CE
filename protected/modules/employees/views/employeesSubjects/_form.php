<style>
hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0; 
}
</style>

<script language="javascript">
function course()
{
var id = document.getElementById('cou').value;
window.location= 'index.php?r=employees/employeesSubjects/create&cou='+id;	
}
function coursename()
{
var id = document.getElementById('bid').value;
window.location= 'index.php?r=employees/employeesSubjects/create&bid='+id;	
}
function batch()
{
var id_1 = document.getElementById('cou').value;
var id = document.getElementById('sub').value;
window.location= 'index.php?r=employees/employeesSubjects/create&cou='+id_1+'&sub='+id;	
}
function batchname()
{
	
var id_1 = document.getElementById('bid').value;
var id = document.getElementById('elect').value;
window.location= 'index.php?r=employees/employeesSubjects/create&bid='+id_1+'&elect='+id;	
}
function departme()
{
var id_1 = document.getElementById('cou').value;
var id = document.getElementById('sub').value;
var dep = document.getElementById('depart').value;
window.location= 'index.php?r=employees/employeesSubjects/create&cou='+id_1+'&sub='+id+'&dept='+dep;		
}
function depname()
{
	
var id_1 = document.getElementById('bid').value;
var id = document.getElementById('elect').value;
var dep = document.getElementById('depart_id').value;
window.location= 'index.php?r=employees/employeesSubjects/create&bid='+id_1+'&elect='+id+'&dep='+dep;		
}
</script>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employees-subjects-form',
	'enableAjaxValidation'=>false,
)); ?>

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
	$is_insert = PreviousYearSettings::model()->findByAttributes(array('id'=>2));
	$is_delete = PreviousYearSettings::model()->findByAttributes(array('id'=>4));
	
	if($year != $current_academic_yr->config_value and ($is_insert->settings_value==0 or $is_delete->settings_value==0))
	{
	?>
		<div>
			<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
				<div class="y_bx_head" style="width:650px;">
				<?php 
					echo Yii::t('app','You are not viewing the current active year. ');
					if($is_insert->settings_value==0 and $is_delete->settings_value!=0)
					{ 
						echo Yii::t('app','To assign an teacher, enable Insert option in Previous Academic Year Settings.');
					}
					elseif($is_insert->settings_value!=0 and $is_delete->settings_value==0)
					{
						echo Yii::t('app','To remove the assigned, enable Delete option in Previous Academic Year Settings.');
					}
					else
					{
						echo Yii::t('app','To manage teacher subject association, enable the required options in Previous Academic Year Settings.');	
					}
				?>
				</div>
				<div class="y_bx_list" style="width:650px;">
					<h1><?php echo CHtml::link(Yii::t('app','Previous Academic Year Settings'),array('/previousYearSettings/create')) ?></h1>
				</div>
			</div>
		</div><br />
	<?php
	}

	/*********************** Normal Course Subject Dropdowns *****************************/	
	
	$data = CHtml::listData(Courses::model()->findAll("is_deleted =:x and academic_yr_id =:y", array(':x'=>0,':y'=>$year),array('order'=>'course_name DESC')),'id','coursename');
	
	if(isset($_REQUEST['cou']))
	{
		$sel= $_REQUEST['cou'];
	}
	else
	{
		$sel='';
	}
	echo '<div class="formCon"><div class="formConInner"><div class="two-Inputarea"><span>'.Yii::t('app','Course').'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
	echo CHtml::dropDownList('id','',$data,array('prompt'=>Yii::t('app','Select'), 'encode'=>false,'onchange'=>'course()','id'=>'cou','options'=>array($sel=>array('selected'=>true)))); 
	echo '</div>';
	echo '<div class="two-Inputarea"><span>'.Yii::t('app','Subject').'</span>&nbsp;&nbsp;'; ?>
	
	
	<?php 
	$data_1= array();
	if(isset($_REQUEST['cou']))
	{
		$batches = Batches::model()->findAll("course_id=:x AND is_deleted=:y and is_active=:z", array(':x'=>$_REQUEST['cou'],':y'=>0,':z'=>1));
		$data_1 = CHtml::listData(Subjects::model()->findAll(array('join' => 'JOIN batches ON batch_id = batches.id','condition'=>'batches.course_id=:id and batches.is_active=:is_active and batches.is_deleted=:is_deleted and elective_group_id=:x','params'=>array(':id'=>(int) $_REQUEST['cou'], ':is_active'=>1, ':is_deleted'=>0,':x'=>0))),'id','batchname');			  
		  
	
	}
	if(isset($_REQUEST['sub']))
	{
		$sel_1 = $_REQUEST['sub'];	
	}
	else
	{
		$sel_1 ='';
	}
	echo CHtml::dropDownList('sub','',$data_1,array('prompt'=>Yii::t('app','Select'),'onchange'=>'course()','id'=>'sub','onchange'=>'batch()','options'=>array($sel_1=>array('selected'=>true)))); 
	echo '<br/></div><div class="clear"></div></div></div>';
	/*********************** END Normal Course Subject Dropdowns *****************************/ 
	?>
    
<?php 
if(isset($_REQUEST['sub']))
{

	/******************************** Assigned List *******************************************/	
	$emp_sub = EmployeesSubjects::model()->findAll("subject_id=:x", array(':x'=>$_REQUEST['sub']));	
	
	if(count($emp_sub)==0)
	{
		echo '<i class="errorMessage eror-top">'.Yii::t('app','No Teacher assigned yet.').'</i>';
	}
	else
	{
	?>
        <div class="clear"></div>
		
        <h3><?php echo Yii::t('app','Currently Assigned:');?></h3>
        <div id="success" style="color:#F00; display:none;"><?php echo Yii::t('app','Details Removed Successfully'); ?></div>
        
        <div class="tableinnerlist">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th><?php echo Yii::t('app','Teacher Name');?></th>
                    <th><?php echo Yii::t('app','Department');?></th>
                    <?php
					if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
					{
					?>
                    <th><?php echo Yii::t('app','Action');?></th>
                    <?php
					}
					?>
                </tr>
                
                <?php 
				if((!isset($_REQUEST['dept'])) or (isset($_REQUEST['dept']) and $_REQUEST['dept']==NULL))
                {
                	$_REQUEST['dept']='';
                }
                foreach($emp_sub as $emp_sub_1)
                { 
                ?>
                    <tr>
                        <td>
							<?php 
                            $emp_name = Employees::model()->findByAttributes(array('id'=>$emp_sub_1->employee_id));
                            echo $emp_name->first_name.'  '.$emp_name->middle_name.'  '.$emp_name->last_name;
                            ?>
                        </td>
                        <?php $batc = EmployeeDepartments::model()->findByAttributes(array('id'=>$emp_name->employee_department_id)); 
                        if($batc!=NULL)
                        {
                        ?>
                        	<td><?php echo $batc->name; ?></td> 
                        <?php 
						}
                        else
						{
						?> 
                        	<td>-</td> <?php 
						}
						if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
						{
						?>
                        	<td>
							<?php echo CHtml::link(Yii::t('app','Remove'), "#", array('submit'=>array('deleterow','id'=>$emp_sub_1->id,'sub'=>$_REQUEST['sub'],'cou'=>$_REQUEST['cou'],'dept'=>$_REQUEST['dept']), 'confirm'=>Yii::t('app','Are you sure?'), 'csrf'=>true));?>
                            </td>
						<?php
						}
						?>
                    </tr>
                <?php 
				}
				?>
            </table>
        </div> <!-- END div class="tableinnerlist" -->
	<?php
	}
	
	/******************************** END Assigned List *******************************************/
	
	/************************************ Assign New *********************************/
	if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
	{
		echo '<div class="formCon"><div class="formConInner"><div class="two-Inputarea">';
		echo '<label>'.Yii::t('app','Departments').'</label>&nbsp;&nbsp;';
		if(isset($_REQUEST['dept']))
		{
			$sel_2 = $_REQUEST['dept'];	
		}
		else
		{
			$sel_2 = '';	
		}
	
		echo CHtml::dropDownList('dep','',CHtml::listData(EmployeeDepartments::model()->findAll(),'id','name'),array('prompt'=>Yii::t('app','Select'),'id'=>'depart','onchange'=>'departme()','options'=>array($sel_2=>array('selected'=>true))));
	
		echo '</div><div class="clear"></div></div></div>';
		
		if(isset($_REQUEST['dept']) and $_REQUEST['dept']!=NULL)
		{
			$employee = $model->Employeenotassigned($_REQUEST['dept'],$_REQUEST['sub']);
			
			if(count($employee)!=0)
			{
			?>
				<h3><?php echo Yii::t('app','Assign New:');?></h3>
				<div class="tableinnerlist">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<th><?php echo Yii::t('app','Teacher Name');?></th>
							<th><?php echo Yii::t('app','Action');?></th>
						</tr>
						
						<?php   
						foreach($employee as $employee_1)
						{
							echo '<tr>';
							echo '<td>'.$employee_1['first_name'].'  '.$employee_1['middle_name'].'  '.$employee_1['last_name'].'</td>';
							echo '<td>'.CHtml::link(Yii::t('app','Assign'), "#", array('submit'=>array('employeesSubjects/Assign','emp_id'=>$employee_1['id'],'sub'=>$_REQUEST['sub'],'cou'=>$_REQUEST['cou'],'dept'=>$_REQUEST['dept']), 'confirm'=>Yii::t('app','Are you sure?'), 'csrf'=>true)).'</td>';
							echo '</tr>';
						}
						?>
					</table>
				</div>
				
			<?php 
			}
			else
			{
				echo '<br> <br><i>'.Yii::t('app','Nothing Found.').'</i><br> <br>';
			}
		}
	}
	/************************************ END Assign New *********************************/

}

?>



    <!--Elective association - anupama-->
    <h3><?php echo Yii::t('app','Elective Subjects');?></h3>
    <?php
    /*********************** Elective Batch Subject Dropdowns *****************************/	
    $data2 = CHtml::listData(Batches::model()->findAll("is_deleted=:x AND academic_yr_id=:y AND is_active=:z", array(':x'=>0,':y'=>$year,':z'=>1),array('order'=>'name DESC')),'id','name');
    if(isset($_REQUEST['bid']))
    {
    	$sel= $_REQUEST['bid'];
    }
    else
    {
    	$sel='';
    }
    echo '<div class="formCon"><div class="formConInner"><div class="two-Inputarea"><span>'.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>&nbsp;&nbsp;&nbsp;&nbsp;';
    echo CHtml::dropDownList('bid','',$data2,array('prompt'=>Yii::t('app','Select'),'onchange'=>'coursename()','id'=>'bid','options'=>array($sel=>array('selected'=>true))));
    echo '</div>';
    echo '<div class="two-Inputarea"><span>'.Yii::t('app','Subject').'</span>&nbsp;&nbsp;'; ?>
    
    <?php 
    $data_2= array();
    if(isset($_REQUEST['bid']))
    {
		$batches = ElectiveGroups::model()->findAll("batch_id=:x and is_deleted=:y", array(':x'=>$_REQUEST['bid'],':y'=>0));
		$data_2 = CHtml::listData(Electives::model()->findAll(array('join' => 'JOIN elective_groups ON elective_group_id = elective_groups.id','condition'=>'elective_groups.batch_id=:id','params'=>array(':id'=>(int) $_REQUEST['bid']))),'id','name');	
    
    }
    if(isset($_REQUEST['elect']))
    {
   		$sel_1 = $_REQUEST['elect'];	
    }
    else
    {
    	$sel_1 ='';
    }
    echo CHtml::dropDownList('elective','',$data_2,array('prompt'=>Yii::t('app','Select'),'id'=>'elect','onchange'=>'batchname()','options'=>array($sel_1=>array('selected'=>true)))); 
    
    echo '</div><div class="clear"></div></div></div>';
    
    /*********************** END Elective Batch Subject Dropdowns *****************************/	
    ?>
<?php 

if(isset($_REQUEST['elect']))
{

	/******************************** Elective Assigned List *******************************************/	
	$emp_electsub = EmployeeElectiveSubjects::model()->findAll("elective_id=:x", array(':x'=>$_REQUEST['elect']));	
	if(count($emp_electsub)==0)
	{
		echo '<li>'.Yii::t('app','No Teacher assigned yet').'</li>';
	}
	else
	{
	?>
	
        <div class="clear"></div>
		
        <h3><?php echo Yii::t('app','Currently Assigned:');?></h3>
        <div id="success" style="color:#F00; display:none;">Details Removed Successfully</div>
        
        <div class="tableinnerlist">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th><?php echo Yii::t('app','Teacher Name');?></th>
                    <th><?php echo Yii::t('app','Department');?></th>
                    <?php
					if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
					{
					?>
                    <th><?php echo Yii::t('app','Action');?></th>
                    <?php
					}
					?>
                </tr>
                
                <?php if((!isset($_REQUEST['dep'])) or (isset($_REQUEST['dep']) and $_REQUEST['dep']==NULL))
                {
                	$_REQUEST['dep']='';
                }
                foreach($emp_electsub as $emp_electsub_1)
                { 
                ?>
                    <tr>
                        <td>
                        <?php 
                        $emp_detail = Employees::model()->findByAttributes(array('id'=>$emp_electsub_1->employee_id));
                        echo $emp_detail->first_name.'  '.$emp_detail->middle_name.'  '.$emp_detail->last_name?>
                        </td>
                        <?php $deptname = EmployeeDepartments::model()->findByAttributes(array('id'=>$emp_detail->employee_department_id)); 
                        if($deptname!=NULL)
                        {
                        ?>
                            <td><?php echo $deptname->name; ?></td> 
                        <?php 
                        }
                        else
                        {
                        ?> 
                            <td>-</td> 
                        <?php 
                        }
						if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
						{
                        ?>
                        <td>
							<?php echo CHtml::link(Yii::t('app','Remove'), "#", array('submit'=>array('employeeElectiveSubjects/deleterow','id'=>$emp_electsub_1->id,'elect'=>$_REQUEST['elect'],'bid'=>$_REQUEST['bid'],'dep'=>$_REQUEST['dep']), 'confirm'=>Yii::t('app','Are you sure?'), 'csrf'=>true)); ?>
						</td>
                       
                        <?php
						}
						?>
                    </tr>
                <?php 
				}
				?>
            </table>
        </div> <!-- END div class="tableinnerlist" -->
	<?php
	}
	/******************************** Elective Assigned List *******************************************/	


	/******************************** Elective Assign New *******************************************/
		
	if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_insert->settings_value!=0))
	{
		echo '<br><span>'.Yii::t('app','Departments').'</span>&nbsp;&nbsp;';
		
		if(isset($_REQUEST['dep']))
		{
			$sel_2 = $_REQUEST['dep'];	
		}
		else
		{
			$sel_2 = '';	
		}
		
		echo CHtml::dropDownList('dep_id','',CHtml::listData(EmployeeDepartments::model()->findAll(),'id','name'),array('prompt'=>Yii::t('app','Select'),'id'=>'depart_id','onchange'=>'depname()','options'=>array($sel_2=>array('selected'=>true))));
		
		
		echo '<br>';
		if(isset($_REQUEST['dep']) and $_REQUEST['dep']!=NULL)
		{
			$employee = EmployeeElectiveSubjects::model()->Employeenotassigned($_REQUEST['dep'],$_REQUEST['elect']);
			
			if(count($employee)!=0)
			{
			?>
				<h3><?php echo Yii::t('app','Assign New:');?></h3>
				<div class="tableinnerlist">
					<table width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<th><?php echo Yii::t('app','Teacher Name');?></th>
							<th><?php echo Yii::t('app','Action');?></th>
						</tr>
						
						<?php   
						foreach($employee as $employee_1)
						{
						echo '<tr>';
							echo '<td>'.$employee_1['first_name'].'  '.$employee_1['middle_name'].'  '.$employee_1['last_name'].'</td>';
							echo '<td>'.CHtml::link(Yii::t('app','Assign'), "#", array('submit'=>array('employeeElectiveSubjects/assign','emp_id'=>$employee_1['id'],'elect'=>$_REQUEST['elect'],'bid'=>$_REQUEST['bid'],'dep'=>$_REQUEST['dep']), 'confirm'=>Yii::t('app','Are you sure?'), 'csrf'=>true)).'</td>';							
						echo '</tr>';
						
						}
						?>
					</table>
				</div>
			<?php 
			}
			else
			{
				echo '<i><br> <br>'.Yii::t('app','Nothing Found').'.</i><br> <br>';
			}
		
		}
	}
	/******************************** END Elective Assign New *******************************************/
}

?>

<?php $this->endWidget(); ?>
<script>
function show()
{
	$("#success").css("display","block").animate({opacity: 1.0}, 3000).fadeOut("slow")
}

</script>