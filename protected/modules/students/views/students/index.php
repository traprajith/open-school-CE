<style>
.overviewbox{
	width:226px;
}
</style>
<?php
$this->breadcrumbs=array(
	Yii::t('app',$this->module->id),
);
?>
<?php if($list!=NULL)
{?>
<?php
$currdate = date('d-m-Y');

	$one =date("m"); 
	$one_1=date("M");
	
	$two =date("m d y", strtotime("-1 months", strtotime($currdate))); 
	$two_1 =date("M", strtotime("-1 months", strtotime($currdate))); 
	
	$three =date("m", strtotime("-2 months", strtotime($currdate))); 
	$three_1=date("M", strtotime("-2 months", strtotime($currdate))); 
	
	$four =date("m", strtotime("-3 months", strtotime($currdate))); 
	$four_1 =date("M", strtotime("-3 months", strtotime($currdate))); 
	
	$five =date("m", strtotime("-4 months", strtotime($currdate))); 
	$five_1 =date("M", strtotime("-4 months", strtotime($currdate))); 
	
	$six =date("m", strtotime("-5 months", strtotime($currdate))); 
	$six_1 =date("M", strtotime("-5 months", strtotime($currdate))); 
	
	$seven =date("m", strtotime("-6 months", strtotime($currdate))); 
	$seven_1 =date("M", strtotime("-6 months", strtotime($currdate))); 
	
	$eight =date("m", strtotime("-7 months", strtotime($currdate))); 
	$eight_1 =date("M", strtotime("-7 months", strtotime($currdate))); 
	
	$nine =date("m", strtotime("-8 months", strtotime($currdate))); 
	$nine_1 =date("M", strtotime("-8 months", strtotime($currdate))); 
	
	$ten =date("m", strtotime("-9 months", strtotime($currdate))); 
	$ten_1 =date("M", strtotime("-9 months", strtotime($currdate))); 
	
	$eleven =date("m", strtotime("-10 months", strtotime($currdate))); 
	$eleven_1 =date("M", strtotime("-10 months", strtotime($currdate))); 
	
	$twelve =date("m", strtotime("-11 months", strtotime($currdate))); 
	$twelve_1 =date("M", strtotime("-11 months", strtotime($currdate))); 
	
	 $data_1 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$one,':status'=>'0'));	
	 $data_2 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$two,':status'=>'0'));
	 $data_3 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$three,':status'=>'0'));
	 $data_4 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$four,':status'=>'0'));
	 $data_5 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$five,':status'=>'0'));
	 $data_6 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$six,':status'=>'0'));
	 $data_7 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$seven,':status'=>'0'));
	 $data_8 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$eight,':status'=>'0'));
	 $data_9 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$nine,':status'=>'0'));
	 $data_10 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$ten,':status'=>'0'));
	 $data_11 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$eleven,':status'=>'0'));
	 $data_12 = Students::model()->findAll('month(admission_date)=:id AND is_deleted=:status',array(':id'=>$twelve,':status'=>'0'));
	 
	 $month = '["'.$one_1.'","'.$two_1.'","'.$three_1.'","'.$four_1.'","'.$five_1.'","'.$six_1.'","'.$seven_1.'","'.$eight_1.'","'.$nine_1.'","'.$ten_1.'","'.$eleven_1.'","'.$twelve_1.'",]';
	 $data = "[".count($data_1).",".count($data_2).",".count($data_3).",".count($data_4).",".count($data_5).",".count($data_6).",".count($data_7).",".count($data_8).",".count($data_9).",".count($data_10).",".count($data_11).",".count($data_12).",]";
?>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			type: 'column'
		},
		title: {
			text: '<?php echo Yii::t('app','Monthly Average Admissions'); ?>'
		},
		subtitle: {
			/*text: 'Cource: Computer Applications'*/
		},
		xAxis: {
			categories: 
				<?php echo $month; ?>
			
		},
		yAxis: {
			min: 0,
			title: {
				text: '<?php echo Yii::t('app','No.of Admissions'); ?>'
			}
		},
		credits: {
			enabled: false
		},

		legend: {
			layout: 'none',

		},
		tooltip: {
			formatter: function() {
				return ''+
					this.x +': '+ this.y +' '+'<?php echo Yii::t('app','Admissions'); ?>';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: '<?php echo Yii::t('app','Month'); ?>',
			data: <?php echo $data; ?>,
			color:'#adce5c',

		}, ]
	});
});
</script>
			
		
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        <div  class="os-left-block">
<h1><?php echo Yii::t('app','Admissions Dashboard');?></h1>
<div class="os-overview-box">
	<div class="overviewbox ovbox1">
    	<h1><?php echo '<strong>'.Yii::t('app','Total Students').'</strong>';?></h1>
        <?php  $tot =   Students::model()->countByAttributes(array('is_active'=> 1,'is_deleted'=>0)); ?>
        <div class="ovrBtm"><?php echo $total ?></div>
    </div>
    <div class="overviewbox ovbox2">
    	<h1><?php echo '<strong>'.Yii::t('app','New Admissions').'</strong>';?></h1>
        <div class="ovrBtm"><?php echo count($list) ?></div>
    </div>
    <div class="overviewbox ovbox3">
    	<h1><?php echo '<strong>'.Yii::t('app','Inactive Students').'</strong>';?></h1>
           <?php  $students =   Students::model()->findAll(array('condition'=>'is_active=:x AND is_deleted=:y','params'=>array(':x'=>'0',':y'=>'0'),'group'=>'id')); ?>
        <div class="ovrBtm"><?php echo count($students); ?></div>
    </div>
  <div class="clear"></div>
    
</div>
<div class="clear"></div>
  <div style="margin-top:20px; width:90%" id="container"></div>
  <div class="pdtab_Con" style="width:97%">
                <div style="font-size:13px; padding:5px 0px"><?php echo '<strong>'.Yii::t('app','Recent Admissions').'</strong>';?></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr class="pdtab-h">
                      <td align="center" height="18"><?php echo Yii::t('app','Date');?></td>
                       <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                         <td align="center" height="18"><?php echo Yii::t('app','Roll No');?></td>
                        <?php } ?>  
                      <?php
							if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
					  ?> 	
                      	<td align="center"><?php echo Yii::t('app','Student Name');?></td>
                      <?php } ?>  
                        <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>
                      <td align="center"><?php echo Yii::t('app','Admission No');?></td>
                     <?php } ?>
                      <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                      	<td align="center"><?php echo Yii::app()->getModule("students")->labelCourseBatch();?></td>
                      <?php } ?> 
                      <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?> 
                      	<td align="center"><?php echo Yii::t('app','Gender');?></td>
                      <?php } ?>  
                      
                    </tr>
                  
                  <?php 
				  foreach($list as $list_1)
	              { 
				  $batch_student=BatchStudents::model()->findByAttributes(array('student_id'=>$list_1->id, 'batch_id'=>$list_1->batch_id, 'status'=>1));
				  ?>
                    <tr>
                    <td align="center">
						<?php 
                        $settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
                        if($settings!=NULL)
                        {	
                            $date1=date($settings->displaydate,strtotime($list_1->admission_date));
                            echo $date1;
    
                        }
                        else
                        echo $list_1->admission_date;
                        ?>&nbsp;
                    </td>
                      <?php if(Configurations::model()->rollnoSettingsMode() != 2){?>
                      <td align="center">
						<?php if($batch_student!=NULL and $batch_student->roll_no!=0){
								  				echo $batch_student->roll_no;
								  			}
											else{
												echo '-';
											}?>
                    </td>
                      <?php } ?>    
                    <?php
						if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile")){						
				    ?> 
                        <td align="center">
                            <?php echo CHtml::link($list_1->studentFullName('forStudentProfile'),array('view','id'=>$list_1->id)) ?>&nbsp;
                        </td>
                    <?php } ?> 
                      <?php if(Configurations::model()->rollnoSettingsMode() != 1){?>   
                    <td align="center">
						<?php echo $list_1->admission_no ?>
                    </td>
                      <?php } ?> 
                    <?php if(FormFields::model()->isVisible('batch_id','Students','forStudentProfile')){?>
                        <td align="center">
                         <?php 
							$batchstudents    = 	BatchStudents::model()->studentBatch($list_1->id);
							if(count($batchstudents)>1){
								echo CHtml::link('View Course Details', array('/students/students/courses', 'id'=>$list_1->id), array('target'=>'_blank'));
							}elseif(count($batchstudents)==1){
							$batch_student = BatchStudents::model()->findByAttributes(array('student_id'=>$list_1->id,'result_status'=>0)); 
							$batc = Batches::model()->findByAttributes(array('id'=>$batch_student->batch_id));
							if($batc!=NULL)
							{
							$cours = Courses::model()->findByAttributes(array('id'=>$batc->course_id)); 
						  echo $cours->course_name.' / '.$batc->name; 
							}
						else{ echo '-'; }?> <?php                                 
							}
							?>
                        </td>
                    <?php } ?>  
                    <?php if(FormFields::model()->isVisible('gender','Students','forStudentProfile')){?>   
                        <td align="center">
                          <?php 
                          if($list_1->gender=='M')
                          {
                              echo Yii::t('app','Male');
                          }
                          elseif($list_1->gender=='F')
                          {
                              echo Yii::t('app','Female');
                          }
                          ?>
                        </td>
                     <?php } ?>
                  </tr>
                     
               </tbody>
               <?php
               } 
			   ?>
                
               </table>
              </div>
 	</div></td>
        
      </tr>
    </table>

    </td>
  </tr>
</table>
<br/><br/><br/>

<?php }
else
{ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/default/left_side');?>
    
    </td>
    <td valign="top">
    <div style="padding:20px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    	<?php echo Yii::t('app','It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following'); ?>:
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    	<h1><?php echo CHtml::link(Yii::t('app','Create New Students'),array('create')) ?></h1>
                        <p><?php echo Yii::t('app','Before Creating Students, make sure you created'); ?> <?php echo CHtml::link(Yii::t('app','Student Categories'),array('/students/studentCategory')); ?> <?php echo Yii::t('app','and the'); ?> <?php echo CHtml::link(Yii::t('app','Courses').' &amp; '.Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),array('/courses/courses/create')) ?> <?php echo Yii::t('app','for enrolling Students.') ?></p>
                    </div>
                    
                </div>

                </div>
    
    
    </td>
  </tr>
</table>

<?php } ?>