<?php
$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'View',
);

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
 <?php $this->renderPartial('profileleft');?>
    
    </td>
    <td valign="top">
    <div class="cont_right formWrapper">
<h1 ><?php echo Yii::t('employees','Employee Profile :');?><?php echo $model->first_name.'&nbsp;'.$model->last_name; ?><br /></h1>
<div class="edit_bttns">
    <ul>
    <li><?php echo CHtml::link(Yii::t('employees','<span>Edit</span>'), array('update', 'id'=>$_REQUEST['id']),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
     <li><?php echo CHtml::link(Yii::t('employees','<span>Employees</span>'), array('employees/manage'),array('class'=>'edit last')); ?><!--<a class=" edit last" href="">Edit</a>--></li>
    </ul>
    </div>
    
    <div class="emp_right_contner">
    <div class="emp_tabwrapper">
    <div class="emp_tab_nav">
    <ul style="width:698px;">
    <li><?php echo CHtml::link(Yii::t('employees','Profile'), array('view', 'id'=>$_REQUEST['id']),array('class'=>'active')); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Address'), array('address', 'id'=>$_REQUEST['id'])); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Contact'), array('contact', 'id'=>$_REQUEST['id'])); ?></li>
    <li><?php echo CHtml::link(Yii::t('employees','Additional Info'), array('addinfo', 'id'=>$_REQUEST['id'])); ?></li>
    </ul>
    </div>
    <div class="clear"></div>
 <div class="emp_cntntbx">
    <div class="table_listbx">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="listbxtop_hdng">
    <td><?php echo Yii::t('employees','General');?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Join Date');?></td>
    <td class="subhdng_nrmal"><?php $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
										if($settings!=NULL)
										{	
											$date1=date($settings->displaydate,strtotime($model->joining_date));
											echo $date1;
		
										}
										else
										echo $model->joining_date;  ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Department');?></td>
    <td class="subhdng_nrmal"><?php $dep=EmployeeDepartments::model()->findByAttributes(array('id'=>$model->employee_department_id));
							  if($dep!=NULL)
							  {
							  echo $dep->name;	
							  }
							  ?></td>
  </tr>

  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Category');?></td>
    <td class="subhdng_nrmal"><?php $cat=EmployeeCategories::model()->findByAttributes(array('id'=>$model->employee_category_id));
							  if($cat!=NULL)
							  {
							  echo $cat->name;	
							  }
							  ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Position');?></td>
    <td class="subhdng_nrmal"><?php $pos=EmployeePositions::model()->findByAttributes(array('id'=>$model->employee_position_id));
							  if($pos!=NULL)
							  {
							  echo $pos->name;	
							  }
							  ?></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Grade');?> </td>
    <td class="subhdng_nrmal"><?php $grd=EmployeeGrades::model()->findByAttributes(array('id'=>$model->employee_grade_id));
							  if($grd!=NULL)
							  {
							  echo $grd->name;	
							  }
							  ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Job Title');?></td>
    <td class="subhdng_nrmal"><?php echo $model->job_title; ?></td>
  </tr>
  <tr>
    
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Gender');?></td>
    <td class="subhdng_nrmal"><?php if($model->gender=='M')
										echo 'Male';
									else 
										echo 'Female';	 ?></td>
                                        
    <td class="listbx_subhdng"></td>
    <td class="subhdng_nrmal"></td>
  </tr>
  <tr>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Status');?></td>
    <td class="subhdng_nrmal"><?php echo $model->status; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Qualification');?></td>
    <td class="subhdng_nrmal"><?php echo $model->qualification; ?>
	</td>
  </tr>
  <tr>
    <td class="listbx_subhdng"> <?php echo Yii::t('employees','Total Experience');?> </td>
    <td class="subhdng_nrmal"><?php echo $model->experience_year; ?></td>
    <td class="listbx_subhdng"><?php echo Yii::t('employees','Experience Info');?></td>
    <td class="subhdng_nrmal"><?php echo $model->experience_detail; ?></td>
  </tr>
  </table>
  <div class="ea_pdf" style="top:4px; right:6px;"><?php echo CHtml::link('<img src="images/pdf-but.png">', array('Employees/pdf','id'=>$_REQUEST['id']),array('target'=>'_blank')); ?></div>
   
 </div>
 
 </div>
</div>
</div>
</div>
    
    </td>
  </tr>
</table>