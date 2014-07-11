<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container'
		},
		title: {
			text: 'Campus Performance'
		},
				subtitle: {
			text: 'School A, School B, School C'
		},
		xAxis: {
			categories: ['Average Attendance', 'Average Anual Percentage', 'Average Passout', 'Average Dropout', 'Average Tacher Leave']
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Percentage'
			}
		},
		tooltip: {
			formatter: function() {
				var s;
				if (this.point.name) { // the pie chart
					s = ''+
						this.point.name +': '+ this.y +' Percentage';
				} else {
					s = ''+
						this.x  +': '+ this.y;
				}
				return s;
			}
		},
		credits: {
			enabled: false
		},
		labels: {
			items: [{
				html: 'Total No.of Students',
				style: {
					left: '40px',
					top: '8px',
					color: 'black'
				}
			}]
		},
		series: [{
			type: 'column',
			shadow:0,
			color: '#efc25d',
			name: 'School A',
			data: [30, 20, 10, 30, 10]
		}, {
			type: 'column',
			shadow:0,
			color: '#f09447',
			name: 'School B',
			data: [20, 30, 10, 5, 35]
		}, {
			type: 'column',
			shadow:0,
			color: '#8ac8c3',
			name: 'School C',
			data: [40, 10, 15, 25, 10]
		}, {
			type: 'spline',
			name: 'State Average',
			//shadow:0,
			lineColor:'#ea90ab',
			lineWidth :4,
					marker: {
					enabled: true,
					symbol: 'circle',
					radius: 6,
					fillColor :'#ea90ab',
					lineColor : '#fff',
					lineWidth:2,

		},
			data: [35, 26, 17, 70, 20]
		}, {
			type: 'pie',
			shadow:0,
			name: 'Total No.of Students',
			data: [{
				name: 'School A',
				y: 30,
				color: '#efc25d' // Jane's color
			}, {
				name: 'School B',
				y: 60,
				color: '#f09447' // John's color
			}, {
				name: 'School C',
				y: 20,
				color: '#8ac8c3' // Joe's color
			}],
			center: [100, 80],
			size: 100,
			showInLegend: false,
			dataLabels: {
				enabled: false
			}
		}]
	});
});
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%"><div style="padding-left:20px;">
<h1>Reports Dashboard</h1>
<div class="clear"></div>
  <div style="margin-top:20px; width:80%" id="container"></div>
  <div class="pdtab_Con" style="width:97%">
                <div style="font-size:13px; padding:5px 0px"><strong>Recent Employee Admissions</strong></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr class="pdtab-h">
                      <td align="center" height="18">Date</td>
                      <td align="center">Employee Name</td>
                      <td align="center">Employee No:</td>
                      <td align="center">Department</td>
                      <td align="center">Position</td>
                      
                    </tr>
                  </tbody>
                    <tbody>
                    <tr>
                    <td align="center">2012-02-13&nbsp;</td>
                    <td align="center"><a href="#">Solove Richard</a>&nbsp;</td>
                    <td align="center">2345</td>
                    <td align="center">Computer Science</td>
                    <td align="center">HOD</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-13&nbsp;</td>
                    <td align="center"><a href="#">Aravind Swami</a></td>
                    <td align="center">2345</td>
                    <td align="center">Computer Science</td>
                    <td align="center">HOD</td>
                    
                  </tr>
                     
               </tbody>
               </table>
              </div>
              <div class="pdtab_Con" style="width:97%">
	<div style="font-size:13px; padding:5px 0px">
		<strong>Recent Admissions</strong>
	</div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
	<tr class="pdtab-h">
		<td align="center" height="18">
			Date
		</td>
		<td align="center">
			Student Name
		</td>
		<td align="center">
			Admission No.
		</td>
		<td align="center">
			Course/Batch
		</td>
		<td align="center">
			Gender
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			0000-00-00&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=41"></a>&nbsp;
		</td>
		<td align="center">
			dsfdsfdsfsdfsd
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			1970-01-01&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=33">Alex </a>&nbsp;
		</td>
		<td align="center">
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			2012-03-21&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=25">Anand </a>&nbsp;
		</td>
		<td align="center">
			9887654
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">&nbsp;
			
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=29">Anupama </a>&nbsp;
		</td>
		<td align="center">
			84345
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">&nbsp;
			
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=27">Arun </a>&nbsp;
		</td>
		<td align="center">
			23468
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">&nbsp;
			
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=21">babu </a>&nbsp;
		</td>
		<td align="center">
			567
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			0000-00-00&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=1">Balusamy M</a>&nbsp;
		</td>
		<td align="center">
			1
		</td>
		<td align="center">
			 My Test / teewtweteww
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">&nbsp;
			
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=2">Catrine </a>&nbsp;
		</td>
		<td align="center">
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			2012-03-23&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=42">dfssssssssss </a>&nbsp;
		</td>
		<td align="center">
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	<tbody>
	<tr>
		<td align="center">
			2012-03-07&nbsp;
		</td>
		<td align="center">
			<a href="/osv2.1/osadmin/index.php?r=students/view&amp;id=35">gggg </a>&nbsp;
		</td>
		<td align="center">
			6666666666666
		</td>
		<td align="center">
			 My Test / fghfg
		</td>
		<td align="center">
		</td>
	</tr>
	</tbody>
	</table>
</div>
 	</div></td>
        
      </tr>
    </table>
    </td>
  </tr>
</table><br />
<br />
