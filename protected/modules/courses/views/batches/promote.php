<style>
.errorSummary{
	margin-top:50px;
}

</style>

 <?php
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	Yii::t('app','Promote'),
);
?>
<?php $batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); ?>
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
	$is_create = PreviousYearSettings::model()->findByAttributes(array('id'=>1));
?>
          
<div style="background:#FFF; min-height:800px;">	
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td  valign="top">
                <?php 
				if($batch!=NULL)
                {
                ?>
                    <div class="full-formWrapper">
                        <h1><?php echo Yii::t('app','Manage').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id");?></h1>
                        
                        <div class="clear"></div>
                        <div class="emp_right_contner">
                            <div class="emp_tabwrapper">
								<?php $this->renderPartial('tab');?>
                                <div style="position:relative;">
                                	<?php
									if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
									{
									?>
<div class="button-bg">
<div class="top-hed-btn-left"> </div>
<div class="top-hed-btn-right">
<ul>                                    
<li><?php echo CHtml::ajaxLink('<span>'.Yii::t('app','Add New').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</span>',$this->createUrl('batches/Addnew'),array('onclick'=>'$("#jobDialog").dialog("open"); return false;','update'=>'#jobDialog','type' =>'GET','data' => array( 'val1' =>$batch->course_id ),'dataType' => 'text'),array('id'=>'showJobDialog1','class'=>'a_tag-btn')); ?></li>
                                    
</ul>
</div> 

</div>
                                    
                                    <?php
									}
									?>
                                </div>
                              
                                <?php $this->beginWidget('CActiveForm') ?>
                                
                                <?php
                                /* Error Message */
                                if(Yii::app()->user->hasFlash('errorMessage')): 
                                ?>
                                    <div class="errorSummary">
                                    <?php echo Yii::app()->user->getFlash('errorMessage'); ?>
                                    </div>
                                <?php endif;
                                /* End Error Message */
                                ?>
                                
                            	<h1><?php echo Yii::t('app','Promote').' '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></h1>
                              <div style="color:#F00"> * <?php echo Yii::t('app','Assign Elective');?> : <?php echo Yii::t('app','Promoted batch should have the same assigned elctive name.');?></div>
                                <div class="formCon" style="margin-bottom:10px; position:relative;margin-top:10px;">
                                    <div class="formConInner">
                                         <!-- END div class="edit_bttns" -->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>                                                
                                                <td width="14%">
                                                    <strong><?php echo Yii::t('app','Select Action'); ?></strong>
                                                    <?php 
                                                        $actions = PromoteOptions::model()->findAll(array('condition'=>'option_value <> "In Progress"'));
                                                        $options = CHtml::listData($actions,'option_value','option_name');
                                                        echo CHtml::dropDownList('action', (isset($_POST['action']))?$_POST['action']:'', $options,array('id'=>'action_drop','prompt'=>Yii::t('app','Select'))); 
                                                    ?>
                                                </td>        
                                                <td  width="1%"></td>
                                                <td width="14%">
                                                    <strong><?php echo Yii::t('app','Select Academic Year'); ?></strong><br>
                                                    <?php                                                   
                                                    $years = AcademicYears::model()->findAll("is_deleted=:x ORDER BY id DESC", array(':x'=>0));
                                                    $data =  CHtml::listData($years,'id','name');
                                                    echo CHtml::dropDownList('year',(isset($_POST['year']))?$_POST['year']:'',$data,array('prompt'=>Yii::t('app','Select'),
                                                                                    'ajax' => array(
                                                                                    'type'=>'POST',
                                                                                    'url'=>CController::createUrl('batches/courses'),
                                                                                     'beforeSend'=>'js:function(){
                                                                                                $("#semester_id").find("option").not(":first").remove();
                                                                                                $("#batch_id").find("option").not(":first").remove();
                                                                                                $("#course_id").find("option").not(":first").remove();
                                                                                                
                                                                                    }',                                                                                                                                                                                
                                                                                    'update'=>'#course_id',
                                                                                    'data'=>'js:{year:$(this).val(), id:"'.$_REQUEST['id'].'", "'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
                                                                                    ),
                                                                                    'disabled'=>(isset($_POST['action']) and ($_POST['action']==-1 or $_POST['action']==1))?false:true,
                                                                                    //'style'=>'width:170px;',
                                                                                    'id'=>'year_drop',
                                                                                    'options' => array()));
                                                    ?>
                                                </td>
                                                <td  width="1%"></td>
                                                <td  width="14%">
                                                    <strong><?php echo Yii::t('app','Select Course'); ?></strong><br>
                                                    <?php 
                                                    if((isset($_POST['year']) && $_POST['year']!=NULL))
                                                    {
                                                       $criteria	= new CDbCriteria;
                                                        $criteria->distinct		= true;                  
                                                        $criteria->condition            = '`t`.`academic_yr_id`=:year AND `t`.`is_deleted`=:is_deleted';
                                                        $criteria->params		= array(':year'=>$_POST['year'], ':is_deleted'=>0);
                                                        $criteria->order		= '`t`.`course_name` ASC';
                                                        $data	= Courses::model()->findAll($criteria);                   
                                                        $data		= CHtml::listData($data, 'id', 'course_name');	
                                                    }
                                                    else
                                                    {
                                                        $data =  array();
                                                    }
                                                   
                                                    echo CHtml::dropDownList('course_id',(isset($_POST['course_id']))?$_POST['course_id']:'',$data,array('prompt'=>Yii::t('app','Select'),
                                                                                    'ajax' => array(
                                                                                    'type'=>'POST',
                                                                                    'url'=>CController::createUrl('batches/semesters'),
                                                                                    'dataType'=>'JSON',
                                                                                    //'update'=>'#batch_id',
                                                                                    'beforeSend'=>'js:function(){
                                                                                        
                                                                                                $("#semester_id").find("option").not(":first").remove();
                                                                                                $("#batch_id").find("option").not(":first").remove();                                                                                                
                                                                                                $("#sem_div").hide();
                                                                                    }', 
                                                                                    'success'=>'js:function(response){
                                                                                    if(response.status=="success")
                                                                                    {
                                                                                        if(response.sem_status=="1")
                                                                                        {
                                                                                            $("#sem_div").show();
                                                                                            $("#semester_id").html(response.semester);
                                                                                        }
                                                                                            $("#batch_id").html(response.batch);
                                                                                    }
                                                                                        
                                                                                    }',
                                                                                    'data'=>'js:{year:$("#year_drop").val(),course_id:$(this).val(), id:"'.$_REQUEST['id'].'", "'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
                                                                                    ),
                                                                                    'disabled'=>(isset($_POST['action']) and ($_POST['action']==-1 or $_POST['action']==1))?false:true,
                                                                                    //'style'=>'width:170px;',
                                                                                    'id'=>'course_id',
                                                                                    'options' => array()));
                                                    ?>
                                                </td>
                                                <td  width="1%"></td>
                                                                              
                                                <td>
                                                    <?php 
                                                    $disp_status='none';
                                                    if(isset($_POST['course_id']) && $_POST['course_id']!=NULL)
                                                    {
                                                        $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($_POST['course_id']);
                                                        if($sem_enabled==1)
                                                        {
                                                            $disp_status='block';
                                                        }
                                                    }
                                                    ?>
                                                    <div width="14%" style="display:<?php echo $disp_status; ?>; padding-right: 10px" id="sem_div">  
                                                    <strong><?php echo Yii::t('app','Select Semester'); ?></strong><br>
                                                    <?php   
                                                    if((isset($_POST['year']) && $_POST['year']!=NULL) && (isset($_POST['course_id']) && $_POST['course_id']!=NULL))
                                                    {
                                                        $criteria=new CDbCriteria;
                                                        $criteria->join= 'JOIN semester_courses `sc` ON t.id = `sc`.semester_id';
                                                        $criteria->condition='`sc`.course_id =:course_id';
                                                        $criteria->params=array(':course_id'=>$_REQUEST['course_id']);
                                                        $data	= Semester::model()->findAll($criteria);			
                                                        $data	= CHtml::listData($data, 'id', 'name');	
                                                    }
                                                    else
                                                    {
                                                        $data =  array();
                                                    }
                                                    echo CHtml::dropDownList('semester_id',(isset($_POST['semester_id']))?$_POST['semester_id']:'',$data,array('prompt'=>Yii::t('app','Select'),
                                                                                    'ajax' => array(
                                                                                    'type'=>'POST',
                                                                                    'url'=>CController::createUrl('batches/batches'),
                                                                                    'update'=>'#batch_id',
                                                                                    'beforeSend'=>'js:function(){                                                                                               
                                                                                                $("#batch_id").find("option").not(":first").remove();                                                                                                
                                                                                                
                                                                                    }', 
                                                                                    'data'=>'js:{year:$("#year_drop").val(),course_id:$("#course_id").val(), semester_id:$(this).val(), id:"'.$_REQUEST['id'].'", "'.Yii::app()->request->csrfTokenName.'":"'.Yii::app()->request->csrfToken.'"}',
                                                                                    ),
                                                                                    'disabled'=>(isset($_POST['action']) and ($_POST['action']==-1 or $_POST['action']==1))?false:true,
                                                                                    //'style'=>'width:170px;',
                                                                                    'id'=>'semester_id',
                                                                                    'options' => array()));
                                                    ?>
                                                    
                                                    </div>
                                                </td>
                                               
                                            <td  width="1%"></td>
                                                
                                                <td  width="14%">
                                                    <strong><?php echo Yii::t('app','Select').' '. Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"); ?></strong>
                                                    <?php 
                                                    $sem_enabled= Configurations::model()->isSemesterEnabledForCourse($_POST['course_id']);
                                                    if((isset($_POST['year']) && $_POST['year']!=NULL) && (isset($_POST['course_id']) && $_POST['course_id']!=NULL) && (isset($_POST['semester_id']) && $_POST['semester_id']!=NULL))
                                                    {                                                        
                                                        $year= $_POST['year'];
                                                        $course_id= $_POST['course_id'];
                                                        $data = Batches::model()->findAll('academic_yr_id=:x AND is_deleted=:y AND is_active=1 AND semester_id=:sem_id AND course_id=:course_id',array(':x'=>$_POST['year'],':y'=>0,':sem_id'=>$_POST['semester_id'],':course_id'=>$course_id));				                                                        
                                                        $data=CHtml::listData($data,'id','coursename');
                                                    }
                                                    else if((isset($_POST['year']) && $_POST['year']!=NULL) && (isset($_POST['course_id']) && $_POST['course_id']!=NULL))
                                                    {
                                                        $criteria=new CDbCriteria;                    
                                                        $criteria->condition='course_id =:course_id AND is_deleted=0 AND is_active=1 AND academic_yr_id=:year';
                                                        $criteria->params=array(':course_id'=>$_POST['course_id'],':year'=>$_POST['year']);
                                                        
                                                        if($sem_enabled==1){
                                                            $criteria->addCondition('semester_id IS NULL');
                                                        }
                                                        $data	= Batches::model()->findAll($criteria);
                                                        $data	= CHtml::listData($data, 'id', 'name');	
                                                    }
                                                    else
                                                    {
                                                        $data =  array();
                                                    }
                                                    
                                                    
                                                    $data1 = CHtml::listData(Batches::model()->findAll(array('order'=>'name ASC', 'condition'=>'is_deleted=0')),'id','coursename');
                                                    echo CHtml::dropDownList('batch_id',(isset($_POST['batch_id']))?$_POST['batch_id']:'',$data,array('prompt'=>Yii::t('app','Select'),'id'=>'batch_id','disabled'=>(isset($_POST['action']) and ($_POST['action']==-1 or $_POST['action']==1))?false:true,)); 
													
                                                    ?>
                                                </td>
                                                <td><?php echo CHtml::checkBox('elective_premote',0,array());  ?><?php echo  Yii::t('app','Assign Elective');?>
                                                 
                                                </td>
                                                
                                                
                                                <td>&nbsp;</td>
                                                <td>
                                                
                                                    <?php echo CHtml::submitButton(Yii::t('app','Save'),array('name'=>'promote','id'=>'1','class'=>'formbut-n','confirm'=>Yii::t('app','Are you sure you want to save?'),'class'=>'formbut')); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div> <!-- END div class="formConInner" -->
                                    
                                </div> <!-- END div class="formCon" -->
                                
                                
                                <div class="table_listbx1" >
									<?php
                                    if(isset($_REQUEST['id']))
                                    {
                                        $posts = Yii::app()->getModule('students')->studentsOfBatch($_REQUEST['id']);
										if($posts!=NULL)
										{
										?>                                        	
                                            <div class="pdtab_Con" style="padding-top:0px;">
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <tr class="pdtab-h">
                                                        <td style="padding-left:20px;"><?php echo CHtml::checkBox('promote_all',false,array('id'=>'ch','onClick'=>'checkall()')). Yii::t('app', 'All'); ?></td>
                                                          <?php 
														  		$flag	= 0;
														  		if(Configurations::model()->rollnoSettingsMode() != 2){
																	$flag	= 1;
															  		
															?>
                                                            <td style="padding-left:20px;"><?php echo Yii::t('app','Roll No');?></td> 
														  <?php } ?>
                                                           <?php if(Configurations::model()->rollnoSettingsMode() != 1){ ?>
                                                        			<td style="padding-left:20px;"><?php echo Yii::t('app','Admission Number');?></td> 
                                                        	<?php }else{
																$flag	= 0;
															}?>
                                                        <?php if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))
                                                        { ?>
                                                        <td style="padding-left:20px;"><?php echo Yii::t('app','Student Name');?></td><?php } ?>
                                                     
                                                        <td style="padding-left:20px;"><?php echo Yii::t('app','Status');?></td>  
                                                    </tr>
                                               <tr>
                                                        <td style="padding:8px 0 8px 20px;" >
                                                        <?php $posts1=CHtml::listData($posts, 'id', 'Fullnames');?>
                                                        <?php
                                                        echo CHtml::checkBoxList('sid','',$posts1, array('class'=>'promote_check','id'=>'1','onClick'=>'selectcheck()','template' => '{input}{label}</td></tr><tr><td width="10%" style="padding:0 0 10px 20px;" class="rbr">')); ?>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <?php if($flag == 1){ ?>
                                                        	<td>&nbsp;</td>
                                                        <?php } ?>    
                                                    </tr>
                                                </table>
                                            </div>
										<?php    	
										} // END if $posts!=NULL
										else
										{
											echo '<br><div class="notifications nt_red" style="padding-top:10px"><i>'.Yii::t('app','No Active Students In This').' ',Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").'</i></div>'; 
										}
                                    
                                    } // END isset($_REQUEST['id'])
                                    ?>
                                    
                                    <?php $this->endWidget(); ?>
                                    <div id="jobDialog"></div>
                                    <div id="promoteDialog"></div>
                                
                                </div> <!-- END div class="table_listbx1" -->
                            </div> <!-- END div class="emp_tabwrapper" -->
                        </div> <!-- END div class="emp_right_contner" -->
                    </div>
                
                <?php    	
                } // END if($batch!=NULL)
                else
                {
					echo '<div class="emp_right" style="padding-left:20px; padding-top:50px;">';
					echo '<div class="notifications nt_red">'.'<i>'.Yii::t('app','Nothing Found!').'</i></div>'; 
					echo '</div>';
                }
                ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
$("#action_drop").change(function(){
	if($(this).val()!="" && $(this).val()==2){
		$("#year_drop").prop("disabled", true);
                $("#course_id").prop("disabled", true);	
		$("#batch_id").prop("disabled", true);	
                $("#semester_id").prop("disabled", true);	
	}
	else{
		$("#year_drop").prop("disabled", false);
                 $("#course_id").prop("disabled", false);	
		$("#batch_id").prop("disabled", false);
                $("#semester_id").prop("disabled", false);	
	}
	
});

</script>
