<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//assesments/left_side');?>
    
    </td>
    <td valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%"><div style="padding-left:20px;">
<h1>Assessments Dashboard</h1>
<div class="jgaugehead" style="border-left:none; border-top:none">Anual Exam Pass Percentage</div>
<div class="jgaugehead" style="border-top:none">Anual Exam Average Marks</div>
<div class="clear"></div>
<div id="jGaugeDemo1" class="jgauge" style="border-left:none;border-top:none"></div>
<div id="jGaugeDemo2" class="jgauge"></div>
<div class="clear"></div>
<div class="jgaugehead" style="border-left:none">Last Assessment Pass</div>
<div class="jgaugehead">Last Assessment Average</div>
<div class="clear"></div>
<div id="jGaugeDemo3" class="jgauge" style="border-left:none"></div>
<div id="jGaugeDemo4" class="jgauge"></div>
<!--<div id="jGaugeDemo2" class="jgauge"></div>
<div id="jGaugeDemo3" class="jgauge"></div>-->
<div class="clear"></div>
<div class="pdtab_Con" style="width:97%">
                <div style="font-size:13px; padding:5px 0px"><strong>Recent Employee Admissions</strong></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                    <tr class="pdtab-h">
                      <td align="center" height="18">Date</td>
                      <td align="center">Assessment Type</td>
                      <td align="center">Teacher</td>
                      <td align="center">Department</td>
                      <td align="center">Average %</td>
                      
                    </tr>
                  </tbody>
                    <tbody>
                    <tr>
                    <td align="center">2012-02-23&nbsp;</td>
                    <td align="center">Class Test</td>
                    <td align="center">Matthew George</td>
                    <td align="center">Computer Science</td>
                    <td align="center">23</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-18&nbsp;</td>
                    <td align="center">Mid Term</td>
                    <td align="center">Arsha Sebastian</td>
                    <td align="center">Electrical</td>
                    <td align="center">93</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-23&nbsp;</td>
                    <td align="center">Class Test</td>
                    <td align="center">Matthew George</td>
                    <td align="center">Computer Science</td>
                    <td align="center">23</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-18&nbsp;</td>
                    <td align="center">Mid Term</td>
                    <td align="center">Arsha Sebastian</td>
                    <td align="center">Electrical</td>
                    <td align="center">93</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-23&nbsp;</td>
                    <td align="center">Class Test</td>
                    <td align="center">Matthew George</td>
                    <td align="center">Computer Science</td>
                    <td align="center">23</td>
                    
                  </tr>
               </tbody> 
                <tbody>
                    <tr>
                    <td align="center">2012-02-18&nbsp;</td>
                    <td align="center">Mid Term</td>
                    <td align="center">Arsha Sebastian</td>
                    <td align="center">Electrical</td>
                    <td align="center">93</td>
                    
                  </tr>
                     
               </tbody>
                <tbody>
                    <tr>
                    <td align="center">2012-02-18&nbsp;</td>
                    <td align="center">Mid Term</td>
                    <td align="center">Arsha Sebastian</td>
                    <td align="center">Electrical</td>
                    <td align="center">93</td>
                    
                  </tr>
                     
               </tbody>
               </table>
              </div>
 	</div></td>
        
      </tr>
    </table>

    </td>
  </tr>
</table>
<link rel="stylesheet" href="css/page.css" type="text/css" />
<!-- This script block defines the gauge parameters and includes some simple
			     functions to test the jGauge with (the above links use this) -->
			<script type="text/javascript">
				
			
			        // DEMOGAUGE1 - A very basic 'bare-bones' example...
				var demoGauge1 = new jGauge(); // Create a new jGauge.
				demoGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.
				demoGauge1.width = 233;
				demoGauge1.height = 160;
				demoGauge1.needle.yOffset = 40;
				demoGauge1.label.yOffset = 35;
				demoGauge1.ticks.labelRadius = 95;
				demoGauge1.range.radius=0;
				demoGauge1.ticks.count=10;
				demoGauge1.ticks.start=10;
				demoGauge1.ticks.end = 100;
				demoGauge1.ticks.color = 'rgba(255, 255, 255, 0)';
				demoGauge1.ticks.labelColor = '#969698';
				
				// DEMOGAUGE2 - A very basic 'bare-bones' example...
				var demoGauge2 = new jGauge(); // Create a new jGauge.
				demoGauge2.id = 'jGaugeDemo2'; // Link the new jGauge to the placeholder DIV.
				demoGauge2.width = 233;
				demoGauge2.height = 160;
				demoGauge2.needle.yOffset = 40;
				demoGauge2.label.yOffset = 35;
				demoGauge2.ticks.labelRadius = 95;
				demoGauge2.range.radius=0;
				demoGauge2.ticks.count=10;
				demoGauge2.ticks.start=10;
				demoGauge2.ticks.end = 100;
				demoGauge2.ticks.color = 'rgba(255, 255, 255, 0)';
				demoGauge2.ticks.labelColor = '#969698';
				
				// DEMOGAUGE3 - A very basic 'bare-bones' example...
				var demoGauge3 = new jGauge(); // Create a new jGauge.
				demoGauge3.id = 'jGaugeDemo3'; // Link the new jGauge to the placeholder DIV.
				demoGauge3.width = 233;
				demoGauge3.height = 160;
				demoGauge3.needle.yOffset = 40;
				demoGauge3.label.yOffset = 35;
				demoGauge3.ticks.labelRadius = 95;
				demoGauge3.range.radius=0;
				demoGauge3.ticks.count=10;
				demoGauge3.ticks.start=5;
				demoGauge3.ticks.end = 50;
				demoGauge3.ticks.color = 'rgba(255, 255, 255, 0)';
				demoGauge3.ticks.labelColor = '#969698';
				
				// DEMOGAUGE4 - A very basic 'bare-bones' example...
				var demoGauge4 = new jGauge(); // Create a new jGauge.
				demoGauge4.id = 'jGaugeDemo4'; // Link the new jGauge to the placeholder DIV.
				demoGauge4.width = 233;
				demoGauge4.height = 155;
				demoGauge4.needle.yOffset = 40;
				demoGauge4.label.yOffset = 35;
				demoGauge4.ticks.labelRadius = 95;
				demoGauge4.range.radius=0;
				demoGauge4.ticks.count=10;
				demoGauge4.ticks.start=10;
				demoGauge4.ticks.end = 100;
				demoGauge4.ticks.color = 'rgba(255, 255, 255, 0)';
				demoGauge4.ticks.labelColor = '#969698';				
				      
				// This function is called by jQuery once the page has finished loading.
				$(document).ready(function()
				{
					demoGauge1.init(); // Put the jGauge on the page by initializing it.
					demoGauge2.init(); // Put the jGauge on the page by initializing it.
					demoGauge3.init(); // Put the jGauge on the page by initializing it.
					demoGauge4.init(); // Put the jGauge on the page by initializing it.
					
					// Configure demoGauge3 for random value updates.
					demoGauge1.setValue(<?php echo '90'; ?>);
					demoGauge2.setValue(<?php echo '90'; ?>);
					demoGauge3.setValue(<?php echo '45'; ?>);
					demoGauge4.setValue(<?php echo '50'; ?>);
				});
				
				
			</script>