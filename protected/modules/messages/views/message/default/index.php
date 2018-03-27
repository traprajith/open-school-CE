<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Message'),	
);

?>
<div style="background:#FFF; min-height:800px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" >
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top" >
            <div>
                <div class=" full-formWrapper opnsl_new_edtn_block">
					<img class="latst_img_bnr" src="images/latest_news_bnr.png" />
                    
                    <div class="opnsl_modl_block">
                    <div class="opnsl_tbl_editon_hd">
            <h2>Upgrade to Open-School Premium Edition and help support future development of Open-School CE!</h2>
            <p>Here is a comparison between Community edition and Premium edition.</p>
                    </div>
                    <div class="panel-body">
                    	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="opnsl_tbl_editon">
                        	<thead>
                            	<tr>
                                	<th></th>
                                    <th>Community Edition</th>
                                    <th>Premium Edition</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr class="odd">
                                	<td>Version</td>
                                    <td class="tabl_cnt">Older version of the application</td>
                                    <td class="tabl_cnt">Latest version of the application</td>
                                </tr>
                            	<tr class="even">
                                	<td>Modules</td>
                                    <td class="tabl_cnt">6</td>
                                    <td class="tabl_cnt">33</td>
                                </tr>
                            	<tr class="odd">
                                	<td>Online Training</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt">Upto 5 hours</td>
                                </tr>
                                <tr class="even">
                                    <td>Online Knowledgebase</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt"><i class="fa fa-check" aria-hidden="true"></i></td>  
                                </tr>
                            	<tr class="odd">
                                	<td>Email and Chat Support</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt"><i class="fa fa-check" aria-hidden="true"></i></td>                                    
                                </tr>
                                <tr class="even">
                                    <td>Software Implementation Assistance</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt">3</td>
                                </tr>  
                                <tr class="odd">
                                    <td>Open-School Test Case Document</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt"><i class="fa fa-check" aria-hidden="true"></i></td>                                    
                                </tr>  
                                <tr class="even">
                                    <td>Android & iOS Mobile Apps</td>
                                    <td class="tabl_cnt">Not supported</i></td>
                                    <td class="tabl_cnt">Supported</td>
                                </tr>
                                <tr class="odd">
                                    <td>Customization Services</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt"><i class="fa fa-check" aria-hidden="true"></i></td>                                    
                                </tr> 
                                <tr class="even">
                                    <td>Payment Gateway & SMS API</td>
                                    <td class="tabl_cnt">Not supported</td>
                                    <td class="tabl_cnt">Supported</i></td>
                                </tr> 
                                <tr class="odd">
                                    <td>GPS based Vehicle Tracking</td>
                                    <td class="tabl_cnt"><i class="fa fa-times" aria-hidden="true"></i></td>
                                    <td class="tabl_cnt"><i class="fa fa-check" aria-hidden="true"></i></td>                                    
                                </tr>                                  
                            </tbody>
                        </table>	
                    </div>
                    <div class="opnsl_tbl_editon_footer">
                    <h2>Your Community Edition is feature-limited!</h2>
                    <p>Buy our latest premium version and get access to all the above benefits and more!</p>
                    <a href="https://open-school.org/pricing" target="_blank" class="upgrade_btn">Upgrade to Premium</a>
                    </div>
                    </div>
                </div>
              
            </div>
          </td>
          
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
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