<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic' rel='stylesheet' type='text/css'>-->

 <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/scripts/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/scripts/jquery-ui-1.7.2.custom.min.js"></script>
    <link rel="Stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/style/jqueryui/ui-lightness/jquery-ui-1.7.2.custom.css" />

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/scripts/jHtmlArea-0.7.5.js"></script>
    <link rel="Stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/style/jHtmlArea.css" />
    


<style>
[placeholder]:focus::-webkit-input-placeholder {
  transition: opacity 0.5s 0.5s ease; 
  opacity: 0;
}

.mail_cmpose_tbl input[type="text"], input[type="password"], textArea, select{
	
	border:#efefef 1px solid !important;
	padding:5px;
	background:#fff;
	color:#6b6b6b;
	font-family: 'Open Sans', sans-serif;
    font-size: 13px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	width:705px;
}



  /* body { background: #ccc;} */
        div.jHtmlArea .ToolBar ul li a.custom_disk_button 
        {
            background: url(<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/images/disk.png) no-repeat;
            background-position: 0 0;
        }
        
        div.jHtmlArea { border: none; width:750px !important; }
		div.jHtmlArea div iframe { width:750px !important; border:none; padding:10px 0px 0px 0px; }
	

</style>
    <script type="text/javascript">    
        // You can do this to perform a global override of any of the "default" options
        // jHtmlArea.fn.defaultOptions.css = "jHtmlArea.Editor.css";

        $(function() {
            //$("textarea").htmlarea(); // Initialize all TextArea's as jHtmlArea's with default values

            $("#txtDefaultHtmlArea").htmlarea(); // Initialize jHtmlArea's with all default values

            $("#txtCustomHtmlArea").htmlarea({
                // Override/Specify the Toolbar buttons to show
                toolbar: [
                    ["bold", "italic", "underline", "|", "forecolor"],
                    ["p", "h1", "h2", "h3", "h4", "h5", "h6"],
                    ["link", "unlink", "|", "image"],                    
                    [{
                        // This is how to add a completely custom Toolbar Button
                        css: "custom_disk_button",
                        text: "Save",
                        action: function(btn) {
                            // 'this' = jHtmlArea object
                            // 'btn' = jQuery object that represents the <A> "anchor" tag for the Toolbar Button
                            alert('SAVE!\n\n' + this.toHtmlString());
                        }
                    }]
                ],

                // Override any of the toolbarText values - these are the Alt Text / Tooltips shown
                // when the user hovers the mouse over the Toolbar Buttons
                // Here are a couple translated to German, thanks to Google Translate.
                toolbarText: $.extend({}, jHtmlArea.defaultOptions.toolbarText, {
                        "bold": "fett",
                        "italic": "kursiv",
                        "underline": "unterstreichen"
                    }),

                // Specify a specific CSS file to use for the Editor
                css: "<?php echo Yii::app()->request->baseUrl; ?>/js/ck_editor/style//jHtmlArea.Editor.css",

                // Do something once the editor has finished loading
                loaded: function() {
                    //// 'this' is equal to the jHtmlArea object
                    //alert("jHtmlArea has loaded!");
                    //this.showHTMLView(); // show the HTML view once the editor has finished loading
                }
            });
        });
    </script>


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
            New Message
            	<span>Compose new message here..</span>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top" width="75%">
                    	<div class="mailbx_viewcon_inbx">
                        	<div class="mail_cmpose_bx">
                            	<div class="mail_view_prfl_imgbx">
                                	<div class="mail_view_prfl_hdng">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mail_view_prfl_image.png"/>
									<h1><strong>Steve Flann </strong>Steve.flann@gmail.com</h1>
                                 	<div class="clear"></div>
                                  </div>
                                </div>
                                <div class="clear"></div>
                             </div>
                             <div class="mail_cmpose_tbl">
                                 <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>
                                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="8%" valign="top">To:</td>
                                            <td width="92%"><input name=""  placeholder="" type="text" /></td>
                                          </tr>
                                        </table>
									</td>
                                  </tr>
                                  <tr>
                                    <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="8%" valign="top">Subject:</td>
                                            <td width="92%"><input name=""  placeholder="" type="text" /></td>
                                          </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div class="mail_cmpose_cont_areabx">
                            	<div class="mail_cmpose_cont_area">
                                <textarea id="txtDefaultHtmlArea" cols="50" rows="15"><p style="color:#202020;font-family: 'Open Sans', sans-serif;
			font-size: 13px;">This is some sample text to test out....</p></textarea>
                                </div>
                            </div>
                            <div class="mail_cmpose_bttnbx">
                            	<div class="mail_attach_bttnbx">
                                	<a href="#">Attach</a>
                                </div>
                                <div class="mail_send_bttnbx">
                                	<ul>
                                    	<li><a href="#">Save</a></li>
                                        <li class="sendbttn"><a href="#">Send</a></li>
                                    </ul>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
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

   
<script type="text/javascript">
       $.ui.dialog.defaults.bgiframe = true;
       $(function () {
           $("#dialog").dialog({
               width: 420, autoOpen: false,
               open: function (evt, ui) {
                   $("#dialogEditor").htmlarea();
               }
           });

           $("#dialogShowButton").click(function () {
               $('#dialog').dialog('open');

           });
       });
    </script>