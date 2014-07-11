<?php
$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	
);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="css/innerpagestyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="outer_wrapper">
<div class="wrapperinner">
<div class="banner_wrapperinner">
<div class="inner_logo"><a href="../index.html"><img src="images/inner_logo-n.png" width="169" height="137"></a></div>
<div class="inner_navebx" id="fix">
<!--<div class="innerhdng">Plans &amp; Pricing
<div class="innerarrow_drop_pricing"><img src="../images/innerarrow_down.png" width="11" height="20"></div>
<div class="drop_prcing">
<div class="droparrow"></div>
<ul>
<li><a href="../index.html">Home</a></li>
<li><a href="../for_admin.html">Features</a></li>
<li><a href="../contact_us.html" style="border-bottom:none;">Contact us</a></li>
</ul>
</div>
</div>-->

<!--<div class="innernav">
<ul>
<li><a class="active" href="#">about us</a></li>
<li><a href="team.html">meet the team</a></li>

</ul>
</div>-->
<div class="innerline"></div>
<div class="clear"></div>
</div>
<div class="contentbxtop_pricng">
<div class="pricinghhdng">Step 2: Enter You Basic Info.
<div class="pricingh2">Your Basic Information, And Your Unique O-S Address </div>
</div>
<div class="pricinghhdng_rht"><img src="images/showingupdation4.png" width="230" height="49"/></div>
<div class="clear"></div>
<div class="signbx">
<div class="signbx_left">
<div class="formbx">
<h1>Setup Your First Administrator Account</h1>
            	<div><div style="float:left; color:#D00;">*</div><div class="smltext_signup" style="float:left">Denotes required field</div></div>
            	<div class="clear"></div>

                						<form id="members-form" action="/osfinal/signup/index.php?r=signupstep2&amp;plan=pro" method="post">                                       											<input value="pro" name="Members[plan]" id="Members_plan" type="hidden">                                        <input value="" name="Members[activation_key]" id="Members_activation_key" type="hidden">                                        <input value="0" name="Members[activation_status]" id="Members_activation_status" type="hidden">                                    
                                        <div class="formfield">
                                        										<ul>
											<li class="first">
                                            <label for="Members_First Name">User  Name</label>                                            </li><li>
											<?php echo $form->textField($model,'username'); ?>                                            </li>
											<strong></strong>
                                        </ul>
                                           <div style="clear:both"></div>
<ul>
											<li class="first"><label for="Members_Last Name">Password</label></li>
                                            <li>
		<?php echo $form->passwordField($model,'password'); ?></li>
		<strong></strong>
                                        </ul>
                                        <div style="clear:both"></div>
                                        <h1>Your School Information</h1>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-weight:bold;">
  <tbody><tr>
    <td>        School / College Name </td>
    <td> <input type="text"  name="collegename" id="collegename"></td>
    <td>School/College Address</td>
    <td><input type="text" name="address" id="address"></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>School/College Phone </td>
    <td><input type="text"  name="phone" id="phone"></td>
    <td>Student Attendance Type</td>
    <td><select name="attentance" id="attentance">
<option value="Daily" selected="selected">Daily</option>
<option value="SubjectWise">SubjectWise</option>
</select></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Finance year start date</td>
    <td> <input type="text" name="startyear" id="startyear"></td>
    <td>Finance year end date</td>
    <td> <input type="text" name="endyear" id="endyear"></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Language</td>
    <td> <input type="text" name="language" id="language"></td>
    <td>Currency Type</td>
    <td> <input type="text" name="currency" id="currency"></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>Upload Logo</td>
    <td><input name="" type="file" /></td>
    <td>Network State</td>
    <td><select name="network" id="network">
<option value="Online" selected="selected">Online</option>
<option value="Offline">Offline</option>
</select></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

  </tbody>
                                        </table>
<div class="row">

        <input checked="checked" type="checkbox" value="1" name="admission_number" id="admission_number"><strong>Enable Auto increment Student admission no.</strong> 
       
        <input checked="checked" type="checkbox" value="1" name="employee_number" id="employee_number"><strong>Enable Auto increment Employee no.</strong>
        
			</div>
										
                                      
                                      
                                        </div>
                                        <!--<div><p style="padding:0px; color:#333333; font-weight:300; font-size:13px; font-weight:bold;">Select Your Instalation Url</p></div>-->
                                        
                                        <div class="bttnbx">
                                        
										<div class="nextbttn">
                                        
                                        <?php echo CHtml::submitButton($model->isNewRecord ? '' : ''); ?>										<div></div>
                                        <!--<a href="#"><img src="../images/proceedbttn.png" width="217" height="47" /></a>-->
			 							</div>
                                                         <div class="clear"></div>
									</div></form>
            </div>
             <div class="clear"></div>
            </div>
            
            
</div>
<div class="clear"></div>
</div>
<!--<div class="clear"></div>
<div class=" innershadow"></div>
<div class="clear"></div>

<div class="contentbxtop">
<div class="innerside" style="padding:0px;">
<h1>Transport Management</h1>
<p class="inner_sb_hdng">Whether you install it yourself on your own server, or have us do it for you, you'll be up and running quickly so you can focus on crafting your new community.</p>
<div class="featurestext" style="padding:0px 0px 0px 0px">
      <ul>
      <li>Excellent management of timings of bus stops and bus routes according to the Institutional timings.</li>
      <li>Allotment of bus to the students and managing their Pick and Drop timings.
</li>
      <li>Custom campus map ( On request ) 
</li>
 </ul>
      </div>
</div>
<div class="sideimg" style="margin:60px 0px 0px 80px"><img src="images/transport_icon.png" width="132" height="190" /></div>
<div class="clear"></div>
</div>-->
</div>



<div class="space"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="footer">
<div class="footerbxinner">
<div class="footerarea">

<div class="footerlogo"><img src="images/footer_logo.png" width="137" height="164"></div>
<div class="footerlink">
<ul>
<li><a style="color:#d19a02; font-size:14px; ">OS</a></li>
<li><a href="../index.html">Home</a></li>
<li><a href="../about_us.html">About</a></li>
<li><a href="../for_admin.html">Features</a></li>
<li><a href="../download.html">Downloads</a></li>
<li><a href="../contact_us.php">Partner</a></li>
<li><a href="../contact_us.php">Contact Us</a></li>
</ul>
</div>
<div class="footerlink" style="padding-left:100px;">
<ul>
<li><a style="color:#d19a02; font-size:14px; ">SignUp</a></li>
<li><a href="https://www.open-school.org/signup/">15 Day Free Trail</a></li>
<li><a href="../pricing.html">Plans &amp; Pricing</a></li>
<li><a href="../contact_us.php">Resellers</a></li>
<li><a href="../contact_us.php">Non Profit</a></li>
<li><a href="../contact_us.php">Contact Us</a></li>

</ul>
</div>
<div class="footerlink" style="padding-left:100px;">
<ul>
<li><a style="color:#d19a02; font-size:14px; ">Support</a></li>
<li><a href="https://www.open-school.org/support/">Support Center</a></li>
<li><a href="https://www.open-school.org/support/open.php">New Ticket</a></li>
<li><a href="../contact_us.php">Contact Us</a></li>
<li><a href="https://www.open-school.org/forum/">Forum</a></li>
<li><a href="https://www.open-school.org/kb/">Knowledge Base</a></li>

</ul>
</div>
<!--<div class="footerlink">
<ul>
<li style="padding:50px 0px 0px 40px"><a href="http://wiwoinc.com"><img src="images/wiwo-logo.png" width="142" height="31" /></a></li>
</ul>
</div>-->
<div class="sociallink" style="float:right;">
<ul>
<li><a style="color:#d19a02; font-size:14px; padding:0px; ">Connect</a></li>
<li><a class="twitter" href="#">Twitter</a></li>
<li><a class="facebook" href="#">Facebook</a></li>
<li><a class=" youtube" href="#">Youtube</a></li>
</ul>
</div>

</div>
</div>
</div>

		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
				</div><!-- sidebar -->
	</div>
</div>
<?php $this->endWidget(); ?>
</body></html>