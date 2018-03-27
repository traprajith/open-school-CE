<style>
table.studenace_table{
	border-top:1px #CCC solid;
	margin:30px 0px;
	font-size:12px;
	border-right:1px #CCC solid;
}
.studenace_table td{
	border:1px #CCC solid;
	padding:5px 6px;
	border-bottom:1px #CCC solid;
	
}
table{ border-collapse:collapse;}

hr{ border-bottom:1px solid #ccc;
	border-top:0px solid #000}
	
h5{ margin:0px;
	font-size:14px;
	padding:0px;}
	
</style>


<!-- Header -->
	
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <td class="first">
                           <?php
						    $filename=  Logo::model()->getLogo();
							if($filename!=NULL)
                            {
                                //Yii::app()->runController('Configurations/displayLogoImage/id/'.$logo[0]->primaryKey);
                                echo '<img src="uploadedfiles/school_logo/'.$filename[2].'" alt="'.$filename[2].'" class="imgbrder" height="100" />';
                            }
                            ?>
                </td>
                <td align="center" valign="middle" class="first" style="width:300px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:22px; width:300px;  padding-left:10px;">
                                <?php $college=Configurations::model()->findAll(); ?>
                                <?php echo $college[0]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo $college[1]->config_value; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="listbxtop_hdng first" style="text-align:left; font-size:14px; padding-left:10px;">
                                <?php echo Yii::t('app','Phone:')." ".$college[2]->config_value; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <hr />
    <br />
    <!-- End Header -->

	<?php
    if($employee)
    {
    ?>
       <h5 align="center"><?php echo Yii::t('app','TEACHERS LIST');?></h5>
      
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="studenace_table">
                            <tr style="background:#dfdfdf;">
                            <td height="20" width="30"><?php echo Yii::t('app','Sl. No.');?></td>	
                          	<td width="120"><?php echo Yii::t('app','Teacher Name');?></td>
                            <td width="80"><?php echo Yii::t('app','Teacher No');?></td>
                            <td width="120"><?php echo Yii::t('app','Department');?></td>
                             <td width="60"><?php echo Yii::t('app','Gender');?></td>
                            </tr>
                           
							
                            <?php
								$i=1;
								foreach($employee as $employeeitem)
								{
									?>
                                    <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo Employees::model()->getTeachername($employeeitem->id);?></td>
                                    <td><?php echo $employeeitem->employee_number;?></td>
                                    <?php $batc = EmployeeDepartments::model()->findByAttributes(array('id'=>$employeeitem->employee_department_id)); 
									if($batc!=NULL)
									{
									?>
									    <td><?php echo $batc->name; ?></td> 
									<?php }
									else{
									?>
                                          <td>-</td>
                                   <?php }?>
                                   
                                 <td>
									<?php 
                                    if($employeeitem->gender=='M')
                                    {
                                    	echo Yii::t('app','Male');
                                    }
                                    elseif($employeeitem->gender=='F')
                                    {
                                    	echo Yii::t('app','Female');
                                    }
                                    ?>
                                </td>
                               
                               </tr>
                                    <?php
									$i++;
									
							}
							
 
						?>
                        </table>
  
<?php
	}
else
{?>
<h5 align="center"><?php echo Yii::t('app','Nothing Found!!!');?></h5>
<?php
}
?>
	