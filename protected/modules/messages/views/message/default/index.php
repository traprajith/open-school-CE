<?php
$this->breadcrumbs=array(
'Messages'=>array('/message'),
	
);

?>
<div style="background:#FFF;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" >
            <div style="padding:0px 20px 20px 20px;">
            <div align="right">
            <div style="padding:6px 0px;">
            <?php $form=$this->beginWidget('CActiveForm'); ?>
            	<table width="26%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input type="checkbox" name="dontshow" id="checkbox" />
      <label for="checkbox"></label></td>
    <td style="font-size:11px; color:#999"><strong>Don't show this messages again.</strong></td>
    <td><input name="hide" type="submit" class="wel_subbut"  value="Hide" /></td>
  </tr>
</table>
<?php $this->endWidget(); ?>
</div>
		
            </div>	
            
              <div class="welcome_Con">
                <h1>Congratulations, Your Open-School Setup is Complete !</h1>
                <p>Your Open-School System is up and running. If you need live assistance when you're on the application, <br/>do click the chat box at the bottom right of the screen and ask away.</p>
                </div>
              <div class="yellow_bx">
                <div class="thakyo_strip"></div>
                <div class="y_bx_head">
                  It appears that this is the first time that you are using this Open-School setup. For any new installation we recommend that you configure the following:
                  </div>
                <div class="y_bx_list">
                  <h1>Create Your School Configurations</h1>
                  <p>Before Creating Timetable, Attendance and Examinations, make sure you completed your school configurations like School name, Logo and School Timings. <br/><?php echo CHtml::link('Application Configurations',array('/configurations/create')) ?></p>
                  </div>
                <div class="y_bx_list">
                  <h1>Add New Course & Batch</h1>
                  <p>After Creating your School Courses and Batches, You will be able to create attendance, Generate Timetable, Create Exams and Collect Fees.<br/><?php echo CHtml::link('Create New Course & Batch',array('/courses/courses/create')) ?></p>
                  </div>
                <div class="y_bx_list">
                  <h1>Create New Students</h1>
                  <p>Before Creating Students, make sure you created Student Categories and the Cources & Batches for enrolling Students.<br/><?php echo CHtml::link('Create New Student',array('/students/students/create')) ?></p>
                  </div>
                <div class="y_bx_list">
                  <h1>Create New Employee</h1>
                  <p>Before Creating Employees, make sure you created Employee Categories, Employee Departments
                  and Employee Positions.<br/><?php echo CHtml::link('Create New Employee',array('/employees/employees/create')) ?></p>
                  </div>
                <div class="y_bx_list">
                  <h1>Roles and Permissions</h1>
                  <p>By using roles and, you have the ability to control who has access your Open-School installation.<br/><?php echo CHtml::link('User Management',array('/user/admin')) ?></p>
                  </div>
                
                </div>
            </div>
          </td>
          
        </tr>
      </table>
    </td>
  </tr>
</table>
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