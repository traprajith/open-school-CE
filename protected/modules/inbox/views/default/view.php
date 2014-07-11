<?php
 //echo 'View Page';
?>

<style>
[placeholder]:focus::-webkit-input-placeholder {
  transition: opacity 0.5s 0.5s ease; 
  opacity: 0;
}


.mail_view_reply_bx input[type="text"], input[type="password"], textArea, select{
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	border:1px #c8c8c8 solid !important;
	padding:8px !important;
	background:#fff;
	-moz-box-shadow:inset 0 2px 4px rgba(0, 0, 0, 0.05)!important;
  	-webkit-box-shadow:inset 0 2px 4px rgba(0, 0, 0, 0.05) !important;
  	box-shadow:inset 0 2px 4px rgba(0, 0, 0, 0.05) !important;
	
	color:#6b6b6b;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
}
</style>
<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="mail_container">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="80%">
    	<div id="mailleft-sidebar">
        	<div class="compose_bttn"><a href="#">Compose Mail</a></div>
            <ul>
            	<li class="list_active"><a href="#">Inbox <span>18</span></a></li>
                <li><a href="#">Sent Items </a></li>
                <li><a href="#">Drafts<span>23</span></a></li>
                <li><a href="#">Sent Items </a></li>
                <li><a href="#">Starred</a></li>
            </ul>
        </div>
    
    </td>
    <td valign="top">
    	<div class="mail_con_right">
        	<div class="mail_con_head">
            Inbox
            	<span>You have 18 unread messages.</span>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" width="75%">
                    	<div class="mailbx_con_menu">
                        	<div class="mailbx_con_menu_folders" style="padding-left:0px;">
                            	<ul>
                                	<li><a style="padding-left:29px;" class="inbox_icon" href="#">Back to inbox</a></li>
                                    
                                </ul>
                                <div class="clear"></div>
                                
                            </div>
                        </div>
                        <div class="mailbx__txt_bx">
                        	[This is] Photoshop's version  of Lorem Ipsum... 
                            <div class="mailbx_viewiconbx">
                            	<div class="mail_viewicon_cont">
                                	<ul>
                                    	<li><a class="reply" href="#"></a></li>
                                        <li><a class="forward" href="#"></a></li>
                                        <li><a class="delete" href="#"></a></li>
                                    </ul>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="mailbx_viewcon_inbx">
                        	<div class="mail_view_profile">
                            	<div class="mail_view_prfl_imgbx">
                                	<div class="mail_view_prfl_hdng">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mail_view_prfl_image.png"/>
									<h1><strong>Steve Flann </strong>Steve.flann@gmail.com</h1>
                                    <p>to Muhammad Bilal</p>
                                    <div class="clear"></div>
                                  </div>
                                </div>
                                <div class="mail_view_prfl_txtbx">September 10,2012</div>
                                <div class="clear"></div>
                            </div>
                            <div class="mail_view_txt">
                                <p>Hello Bial,</p>
                                <p>his is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus </p>
                                <p>Thanks,</p>
                                <p>Flann</p>
                                </div>
                                
                                <div class="mail_view_profile">
                            	<div class="mail_view_prfl_imgbx">
                                	<div class="mail_view_prfl_hdng">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mail_view_prfl_image1.png"/>
									<h1><strong>Muhammed Bilal</strong>bilal88@gmail.com</h1>
                                    <p>to me</p>
                                    <div class="clear"></div>
                                  </div>
                                </div>
                                <div class="mail_view_prfl_rpy_txtbx">September 10,2012<div class="mail_view_prfl_rpybttn"><a class="reply" href="#"></a></div></div>
                                
                                <div class="clear"></div>
                            </div>
                            <div class="mail_view_txt">
                                <p>Hello John,</p>
                                <p>his is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. </p>
                                <p>Thanks,</p>
                                <p>Arun</p>
                              </div>
                              <div class="mail_view_reply_bx">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="8%">
                                        <div class="mail_view_reply_img">
                                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mail_view_prfl_image.png"/>
                                        </div>
                                    </td>
                                    <td width="92%"><textarea style="width:667px;" name="" cols="" rows="" placeholder="Click here to Reply..."></textarea></td>
                                  </tr>
                               </table>
							 </div>
                            
                        </div>
                    </td>
                  </tr>
            </table>

        </div>
    </td>
  </tr>
</table>


</div>