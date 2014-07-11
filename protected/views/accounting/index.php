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
	
	 $data_1 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$one,':status'=>'0'));	
	 $data_2 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$two,':status'=>'0'));
	 $data_3 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$three,':status'=>'0'));
	 $data_4 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$four,':status'=>'0'));
	 $data_5 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$five,':status'=>'0'));
	 $data_6 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$six,':status'=>'0'));
	 $data_7 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$seven,':status'=>'0'));
	 $data_8 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$eight,':status'=>'0'));
	 $data_9 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$nine,':status'=>'0'));
	 $data_10 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$ten,':status'=>'0'));
	 $data_11 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$eleven,':status'=>'0'));
	 $data_12 = Students::model()->findAll('month(created_at)=:id AND is_deleted=:status',array(':id'=>$twelve,':status'=>'0'));
   
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
			text: 'Monthly Average Admissions'
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
				text: 'No.of Admissions'
			}
		},
		legend: {
			layout: 'none',

		},
		tooltip: {
			formatter: function() {
				return ''+
					this.x +': '+ this.y +' Admissions';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
			series: [{
			name: 'Month',
			data: <?php echo $data; ?>,
			color:'#6bb600',

		}, ]
	});
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//accounting/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%"><div style="padding-left:20px;">
<h1>Accounting Dashboard</h1>
<div class="overview">
	<div class="overviewbox ovbox1">
   <?php  $total = Students::model()->findAll('is_deleted=:status',array(':status'=>'0')); ?>
    	<h1><strong>Total Students</strong></h1>

        <div class="ovrBtm"><?php echo count($total); ?></div>
    </div>
    <div class="overviewbox ovbox2">
    	<h1><strong>New Admissions</strong></h1>
        <div class="ovrBtm">122</div>
    </div>
    <div class="overviewbox ovbox3">
    	<h1><strong>Pending Leads</strong></h1>
     <?php  $fees =   FinanceFees::model()->findAll('is_paid=:status group by student_id',array(':status'=>'0')); ?>
        <div class="ovrBtm"><?php echo count($fees); ?></div>
    </div>
  <div class="clear"></div>
    
</div>
<div class="clear"></div>
  <div style="margin-top:20px; width:80%" id="container"></div>
 	</div></td>
        
      </tr>
    </table>

    </td>
  </tr>
</table>