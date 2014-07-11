<?php 
/**
-------------------------
GNU GPL COPYRIGHT NOTICES
-------------------------
This file is part of Open-School.

Open-School is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Open-School is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Open-School.  If not, see <http://www.gnu.org/licenses/>.*/

/**
 * $Id$
 *
 * @author Open-School team <contact@Open-School.org>
 * @link http://www.Open-School.org/
 * @copyright Copyright &copy; 2009-2012 wiwo inc.
 * @Matthew George,@Rajith Ramachandran,@Arun Kumar,
 * @Anupama,@Laijesh V Kumar.
 * @license http://www.Open-School.org/
 */
 ?>
 
  <?php 
 $courses = Courses::model()->findAll("is_deleted=:x", array(':x'=>'1'));
 
 foreach($courses as $course)
 {
 
 $batches = Batches::model()->findAll("course_id=:x", array(':x'=>$course->id));
 foreach($batches as $batche)
 {
	  $batche->is_deleted=1;
	  $batche->save();
	 
 }
 
 }
 ?>

 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <!--left-col starts Here-->

						 <?php $this->renderPartial('/..//modules/messages/views'.Yii::app()->getModule('message')->viewPath . '/left_side');?>
                            <!--left-col ends Here-->
    
    </td>
    <td valign="top" >
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top" width="75%"><div style="padding-left:20px;">
  <h1>Website Dashboard</h1>
  <div class="overview">
    <div class="overviewbox ovbox1">
      <h1><strong>Unique Visitors</strong></h1>
      <div class="ovrBtm">1249</div>
      </div>
    <div class="overviewbox ovbox2">
      <h1><strong>Returning Visitors</strong></h1>
      <div class="ovrBtm">278</div>
      </div>
    <div class="overviewbox ovbox3">
      <h1><strong>Bounces</strong></h1>
      <div class="ovrBtm">356</div>
      </div>
    <div class="clear"></div>
    
  </div>
  <div class="clear"></div>
          <div style="margin-top:20px; width:80%;" id="container"></div>
          <div class="pdtab_Con" style="width:97%">
            <div style="font-size:13px; padding:5px 0px"><strong>Recent Employee Admissions</strong></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr class="pdtab-h">
                  <td align="center" height="18">Date</td>
                  <td align="center"> Browser </td>
                  <td align="center">Visits:</td>
                  <td align="center">Country/Territory</td>
                  <td align="center">New Visits</td>
                  
                  </tr>
                </tbody>
              <tbody>
                <tr>
                  <td align="center">2012-02-13&nbsp;</td>
                  <td align="center">Mozilla</td>
                  <td align="center">2345</td>
                  <td align="center">United States</td>
                  <td align="center">12</td>
                  
                  </tr>
                
                </tbody>
              <tbody>
                <tr>
                  <td align="center">2012-04-13&nbsp;</td>
                  <td align="center">Chrome</td>
                  <td align="center">275</td>
                  <td align="center">United States</td>
                  <td align="center">132</td>
                  
                  </tr>
                
                </tbody>
              <tbody>
                <tr>
                  <td align="center">2012-04-18&nbsp;</td>
                  <td align="center">Chrome</td>
                  <td align="center">275</td>
                  <td align="center">India</td>
                  <td align="center">132</td>
                  
                  </tr>
                
                </tbody>
              <tbody>
                <tr>
                  <td align="center">2012-04-18&nbsp;</td>
                  <td align="center">Chrome</td>
                  <td align="center">275</td>
                  <td align="center">India</td>
                  <td align="center">132</td>
                  
                  </tr>
                
                </tbody>
              <tbody>
                <tr>
                  <td align="center">2012-04-18&nbsp;</td>
                  <td align="center">Chrome</td>
                  <td align="center">275</td>
                  <td align="center">India</td>
                  <td align="center">132</td>
                  
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