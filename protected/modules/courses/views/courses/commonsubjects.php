<style>
#jobDialog123
{
		height:auto;
}	
.del_err{ text-align:center; color:#F60;}	
.del_sub_err{ text-align:center; color:#F00;}


</style>

<?php
$this->breadcrumbs=array(
Yii::t('app',$this->module->id),
);
?>
<script>
	function rowdelete(id)
	{
		$(".del_err").html("<?php echo Yii::app()->getModule('students')->fieldLabel("Students", "batch_id").' '.Yii::t('app','successfully deleted!'); ?>");
		$(".del_err").fadeOut(7000);
		$("#batchrow"+id).fadeOut("slow");
	}
</script>
<form action="" method="get" class="form-inline">
<div id="jobDialog">
    <div id="jobDialog1">
        <?php $this->renderPartial('_flash');?>                
    </div>
</div>
<div id="jobDialog123">
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('left_side');?>        
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Subjects Common Pool');?></h1>
                
          <div class="formCon">
            <div class="formConInner">
                 <div class="c_batch_tbar-subwise">
                    <div class="filter-box-table">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="s_search">
                            <tr>
                                <td  width="13%"><strong><?php echo Yii::t('app','Select Course');?></strong></td>
                                <td width="25%">
                                <?php
                                        $current_academic_yr = Configurations::model()->findByPk(35);
                                        if(Yii::app()->user->year)
                                        {
                                            $year = Yii::app()->user->year;
                                        }
                                        else
                                        {
                                            $academic_yr = Configurations::model()->findByAttributes(array('id'=>35));
                                            $year = $academic_yr->config_value;
                                        }
                                        $criteria = new CDbCriteria;							
                                        $criteria->condition = 'is_deleted = :is_deleted and academic_yr_id = :academic_yr_id';
                                        $criteria->params = array(':is_deleted'=>0,':academic_yr_id'=>$year);
                                        
                                        
                                        echo CHtml::dropDownList('course',(isset($_GET['course']))?$_GET['course']:'',CHtml::listData(Courses::model()->findAll($criteria), 'id', 'course_name'),
                                            array(
                                                'prompt'=>Yii::t('app','Select Course'),
                                                'onchange'=>'subjectload()',
                                                'id'=>'course',
                                                'class'=>'form-control chosen-select'
                                            )
                                        );
                                ?>
                                </td>
                                <td width="2%"></td>
                                <td width="23%">
                            <?php
                            if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_create->settings_value!=0))
                            {					
                                echo CHtml::ajaxLink(Yii::t('app','Add Subject'),$this->createUrl('/courses/subjectsCommonPool/Addnew'),
                                                    array('onclick'=>'$("#jobDialog").dialog("open"); return false;','update'=>'#jobDialog','type' =>'GET',
                                                    'data' => array( 'val1' =>$_GET['course']),'dataType' => 'text',),
                                                    array('id'=>'showJobDialog2'.$_GET['course'],'class'=>'formbut-n'));
                            }
                            ?>
                       
                            </td>
                            </tr>
                           </table>
               			</div>
               		</div>
             	</div>
                </div>
                <?php
                   if( isset($_GET['course'])){  ?>
                        <div class="pdtab_Con" id="dropwin<?php echo $_GET['course']; ?>" style="padding:0px 0px 10px 0px; ">
                      <br />

							<strong><?php echo Yii::t('app','Subjects');?></strong>
                            <br />
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tbody>
									<!--class="cbtablebx_topbg"  class="sub_act"-->
									<tr class="pdtab-h">
                                   		<td align="center" width="8%"><?php echo Yii::t('app','#');?></td>
										<td align="center" width="30%"><?php echo Yii::t('app','Subject Name');?></td>
                                        <td align="center" width="30%"><?php echo Yii::t('app','First Sub Category');?></td>
                                        <td align="center" width="30%"><?php echo Yii::t('app','Second Sub Category');?></td>
									<?php /*?>	<td align="center" width="22%"><?php echo Yii::t('app','Subject Code');?></td><?php */?>
										<td align="center" width="25%"><?php echo Yii::t('app','Maximum Weekly Classes');?></td>
                                        <td align="center" width="15%"><?php echo Yii::t('app','Action');?></td>
                                   	</tr>
                                    <?php
									$subjects = SubjectsCommonPool::model()->findAll("course_id =:x", array(':x'=>$_GET['course']));
									$i=1;
									if(count($subjects)){
										foreach($subjects as $subject){									
										 echo '<tr id="subrow'.$subject->id.'">';
										?>
                                   		<td align="center"><?php echo $i++?></td>
										<td align="center"><?php echo $subject->subject_name;?></td>
                                        <?php   
												$common_cps	=	SubjectCommonpoolSplit::model()->findAllByAttributes(array('subject_id'=>$subject->id));
												$k=1;
												if($common_cps !=NULL){
													foreach($common_cps as $common_cp){ 
													?>
													<td align="center"><?php echo $common_cp->split_name;?></td>
													<?php 
													}
												}else{
													?>
													<td align="center">-</td>
                                                    <td align="center">-</td>
													<?php
												}?>
										<?php /*?><td align="center"><?php echo $subject->subject_code;?></td><?php */?>
										<td align="center"><?php echo $subject->max_weekly_classes;?></td>
                                        <td align="center"  class="sub_act"><?php 
										if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_edit->settings_value!=0))
										{
											echo CHtml::ajaxLink(Yii::t('app','Edit'),$this->createUrl('subjectsCommonPool/addupdate'),array(
											'onclick'=>'$("#jobDialog123").dialog("open"); return false;',
											'update'=>'#jobDialog123','type' =>'GET','data' => array( 'sub_id' =>$subject->id,'course_id'=>$subject->course_id),'dataType' => 'text'),array('id'=>'showJobDialogsub'.$subject->id,'class'=>'add edit-subject')); 
										}
										if(($year == $current_academic_yr->config_value) or ($year != $current_academic_yr->config_value and $is_delete->settings_value!=0))
										{
										echo ''.CHtml::ajaxLink(Yii::t('app','Delete'), $this->createUrl('subjectsCommonPool/remove'), array('success'=>'rowdeletesub('.$subject->id.')','type' =>'POST',
																'data' => array( 'sub_id' =>$subject->id , Yii::app()->request->csrfTokenName=>Yii::app()->request->csrfToken),'dataType' => 'text'),
																array('id'=>'showJobDialogdelete'.$subject->id,'confirm'=>Yii::t('app','Are you sure you want to delete this Subject?')));
										}
										?> </td>
                                   	</tr>
                                    <?php
										}
								}else{
									?>
                                    <tr>
                                    <td colspan="6" align="center"><strong><?php echo Yii::t('app','No common subjects added!');?></strong></td>
                                    </tr>
                                    <?php
									
								}
									
									?>
                           </tbody>   
                           </table>
                            <div class="del_sub_err"></div>

                           </div>                     
						</div>
						
                        </div>
                        <?php
                    }?>
                               </div> 
        </td>
    </tr>
</table>
</form>
<script >
function subjectload(){
  	 var favorite = $('#course').val();
	 window.location= 'index.php?r=courses/courses/commonsubjects&course='+favorite;
		 
}
function rowdeletesub(id){
	$(".del_sub_err").html("<?php echo Yii::t('app','Subject Successfully Deleted!'); ?>");		
	$("#subrow"+id).fadeOut("slow");
	$(".del_sub_err").fadeOut(9000);
}

$(".edit-subject").click(function(e) {
    $("form#subjects-common-pool-form").remove();
});
</script>