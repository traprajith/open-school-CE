<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic' rel='stylesheet' type='text/css'>-->
<style type="text/css">
		label {margin-right:20px;}
		input[type=checkbox].css-checkbox {
							  position: absolute; 
							overflow: hidden; 
							clip: rect(0 0 0 0); 
							height:1px; 
							width:1px; 
							margin:-1px; 
							padding:0;
							border:0;
		}

						input[type=checkbox].css-checkbox + label.css-label {
							padding-left:25px;
							height:18px; 
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 1px;
							font-size:15px;
							vertical-align:middle;
							cursor:pointer;
							color:#4e4e4e;
							display: block;
							margin: 12px 15px 12px 0px;
							font-size:11px;
							font-weight: 600;
							font-family: 'Open Sans', sans-serif;
							text-transform:uppercase;
							
						}

						input[type=checkbox].css-checkbox:checked + label.css-label {
							background-position: 0 -18px;
						}
						
						.css-label{
							background-image: url(images/mail_checkbx_new.png);
						}
						
						
						
						input[type=checkbox].css-checkbox + label.css-label_nxt {
							padding-left:25px;
							height:18px; 
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 3px;
							font-size:15px;
							vertical-align:middle;
							cursor:pointer;
							color:#4e4e4e;
							display: block;
							margin: 0px;
							font-size:11px;
							font-weight: 600;
							font-family: 'Open Sans', sans-serif;
							text-transform:uppercase;
							
						}

						input[type=checkbox].css-checkbox:checked + label.css-label_nxt {
							background-position: 0 -16px;
						}
						
						.css-label_nxt{
							background-image: url(images/mail_checkbx_new.png);
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
                        	<div class="mailbx_con_menu_folders">
                            	<ul>
                                	<li style="border-right:#d8d8d8 1px solid;">
                                        <input id="demo_box_1" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_1" name="demo_lbl_1" class="css-label">select / deselect all</label></li>
                                	<li><a class="delete" href="#">delete</a></li>
                                    <li><a class="folder" style="padding-left:45px;" href="#">move to folder</a></li>
                                   
                                </ul>
                                <div class="clear"></div>
                                <div class="mail_pagination">
                                	<div class="mail_paginationbx"><span>1-100 of 631</span>
                                    	<div class="pagination_bttn">
                                        	<ul>
                                            	<li><a class="prev" href="#"></a></li>
                                                <li><a class="next" href="#"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mailbx_con_inbx">
                        	<div class="mailbx_con_tble_bx">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_2" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_2" name="demo_lbl_2" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper starred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_3" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_3" name="demo_lbl_3" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_4" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_4" name="demo_lbl_4" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_5" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_5" name="demo_lbl_5" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_6" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_6" name="demo_lbl_6" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_7" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_7" name="demo_lbl_7" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper starred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_8" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_8" name="demo_lbl_8" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_9" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_9" name="demo_lbl_9" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_2" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_2" name="demo_lbl_2" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_3" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_3" name="demo_lbl_3" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_2" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_2" name="demo_lbl_2" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper starred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today,<span>11.30 PM</span></td>
                                  </tr>
                                  <tr class="mailbx_con_tble_tbl_even">
                                    <td width="25">
                                    	<div class="mailbx_con_tble_bx_wrapper"><input id="demo_box_3" class="css-checkbox" type="checkbox" />
                                        <label for="demo_box_3" name="demo_lbl_3" class="css-label_nxt"></label></div>
                                    </td>
                                    <td width="25"><div class="mailbx_con_tble_bx_wrapper unstarred"></div></td>
                                    <td><div class="mailbx_con_tble_bx_wrapper">OT Evaluation</div></td>
                                    <td><div>[This is] Photoshop's version  of Lorem Ipsum... </div></td>
                                    <td>Today, 11.30 PM</td>
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





<!--<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>-->
</div>