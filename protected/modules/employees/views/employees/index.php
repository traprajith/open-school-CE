<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<?php
$this->breadcrumbs=array(
	Yii::t('app','Teachers'),
); 
?>
<?php if($list!=NULL)
{?>
<?php
//$sub = Employees::model()->findAll("is_deleted=:x", array(':x'=>0));

$data = '';

	$empy = EmployeeDepartments::model()->findAll();
	foreach($empy as $empy_1)
	{
		$emp_number=Employees::model()->findAll("employee_department_id=:x", array(':x'=>$empy_1->id));
	$data .='{name:"'.$empy_1->name.'",
			y:'.count($emp_number).',
			sliced: true,
			selected: true,},';
	}



//echo $data;
?>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: 'Employee Strength'
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage*100)/100 +' %';
			}
		},
		credits: {
			enabled: false
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				borderWidth:0,
				shadow:0,
				dataLabels: {
					enabled: true,
					color: '#969698',
					connectorColor: '#d8d8d8',
					formatter: function() {
						return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage*100)/100 +' %';
					}
				}
			}
		},
		
		series: [{
			type: 'pie',
			name: <?php echo Yii::t('app','Teacher Strenght'); ?>,
			data: [
				<?php echo $data; ?>
				]
		}]
	});
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%">
        <div class="cont_right">
<h1><?php echo Yii::t('app','Teacher Dashboard');?></h1>
<div class="overview">
	<div class="overviewbox ovbox1" style="margin-left:0px;">
    	<h1><strong><?php echo Yii::t('app','Total Teachers');?></strong></h1>
        <div class="ovrBtm"><?php echo $total ?></div>
    </div>
    <div class="overviewbox ovbox2">
    	<h1><strong><?php echo Yii::t('app','Recently Hired');?></strong></h1>
        <div class="ovrBtm"><?php echo count($list) ?></div>
    </div>
   <?php /*?> <div class="overviewbox ovbox3">
    	<h1><strong><?php echo Yii::t('app','Inactive Users');?></strong></h1>
        <div class="ovrBtm">0</div>
    </div><?php */?>
  <div class="clear"></div>
    
</div>
<div class="clear"></div>
  <div style="margin-top:20px; width:90%" id="container"></div>
  <div class="pdtab_Con" style="width:97%">
                <div style="font-size:13px; padding:5px 0px"><strong><?php echo Yii::t('app','Recent Teacher Admissions');?></strong></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr class="pdtab-h">
                      <td align="center" height="18"><?php echo Yii::t('app','Date');?></td>
                      <td align="center"><?php echo Yii::t('app','Teacher Name');?></td>
                      <td align="center"><?php echo Yii::t('app','Teacher No');?></td>
                      <td align="center"><?php echo Yii::t('app','Department');?></td>
                      <td align="center"><?php echo Yii::t('app','Position');?></td>
                      
                    </tr>
                  </tbody>
                  <?php foreach($list as $list_1)
	              { ?>
                    <tbody>
                    <tr>
                    <td align="center"><?php 
											$settings=UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
								if($settings!=NULL)
								{	
									$date1=date($settings->displaydate,strtotime($list_1->joining_date));
									echo $date1;
		
								}
								else
								echo $list_1->joining_date;
					 ?>&nbsp;</td>
                    <td align="center"><?php echo CHtml::link(Employees::model()->getTeachername($list_1->id),array('view','id'=>$list_1->id)) ?>&nbsp;</td>
                    <td align="center"><?php echo $list_1->employee_number; ?></td>
					<?php  $dept = EmployeeDepartments::model()->findByAttributes(array('id'=>$list_1->employee_department_id)); ?>
                    <td align="center"><?php if($dept!=NULL){echo $dept->name; }else{ echo '-';}?> </td>
                    <?php  $pos = EmployeePositions::model()->findByAttributes(array('id'=>$list_1->employee_position_id)); ?>
                    <td align="center"><?php if($pos!=NULL){echo $pos->name; }else{ echo '-';}?> </td>
                    
                  </tr>
                     
               </tbody>
               <?php
               } ?>
                               
               </table>
              </div>
 	</div></td>
        
      </tr>
    </table>
    </td>
  </tr>
</table>
<br />
<br />
<br />
<?php }
else
{ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('/employees/left_side');?>
    
    </td>
    <td valign="top">
    <div style="padding:20px 20px">
<div class="yellow_bx" style="background-image:none;width:680px;padding-bottom:45px;">
                
                	<div class="y_bx_head" style="width:650px;">
                    	<?php echo Yii::t('app','It appears that this is the first time that you are using this Open-School Setup. For any new installation we recommend that you configure the following:'); ?>
                    </div>
                    <div class="y_bx_list" style="width:650px;">
                    	<h1><?php echo CHtml::link(Yii::t('app','Create New Teacher'),array('create')) ?></h1>
                        <p><?php echo Yii::t('app','Before Creating Teachers, make sure you created'); ?> 
                            <?php echo CHtml::link(Yii::t('app','Teacher Categories'),array('employeeCategories/create')) ?>, 
                            <?php echo CHtml::link(Yii::t('app','Teacher Departments'),array('employeeDepartments/create')) ?><br/> 
                                <?php echo Yii::t('app','and'); ?> 
                                <?php echo CHtml::link(Yii::t('app','Teacher Positions'),array('employeePositions/create')) ?>.</p>
                    </div>
                    
                </div>

                </div>
    
    
    </td>
  </tr>
</table>

<?php } ?>
