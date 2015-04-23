

<?php
 $this->breadcrumbs=array(
	 'Default'
);
?>

<?php 

                 $serverurl = "http://licence-server.open-school.org/news.php";
				 
				 $info['severname'] = Yii::app()->request->hostInfo.Yii::app()->request->baseUrl ;
				 
				  // start a curl session
				  $ch = curl_init ($serverurl);
				  
				  // return the output, don't print it
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  
				  // set curl to send post data
				  curl_setopt ($ch, CURLOPT_POST, true);
				  
				  // set the post data to be sent
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $info);
				  
				  // get the server response
				  $result = curl_exec ($ch);
				  
				  // convert the json to an array
				  $result = json_decode($result, true);
				  
				  
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top" id="port-left">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top" width="75%">
                    <div class="cont_right formWrapper" style="padding:3px 0px;">
                        
                        <div class="news_cntnr">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/latest_news_bnnr.png" width="720" height="130" />
                        <div class="latest_news_bx">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/app_ftr_img.png" width="705" height="132" />
                        <div class="latest_news_cntnt">
                        	<div class="latest_news_app_bx"></div>
                        	<h1>Latest News</h1>
                            
                          
                               <?php if(isset($result) and sizeof($result) > 0)
							{
							
							foreach($result as $news)
							{
								?>
                           
                           
                            
                         
                        	<div class="latest_news_cntntbx">
                            <div>
                            	<div class="latest_news_cntntbx_date"><?php echo date('d M Y',strtotime($news['date'])) ; ?></div>
                            	<div class="latest_news_cntntbx_brdr"></div>
                            
                            <div class="clear"></div>
                            </div>
                            
                            <div class="latest_news_cntntbx_cntnt"><?php echo $news['news'] ; ?> </div>
                            </div>
                            
                            <?php }}
							else
							{ ?>
                            
                            <div class="latest_news_cntntbx">
                            
                            <div class="latest_news_cntntbx_cntnt">
                            <div class="no_news_icon_bx">
                            	 <div class="no_news_icon">
                              	Nothing Found !!
                            </div>
                            </div>
                            
                            </div>
                            <div class="clear"></div>
                            </div>
                            
                            
                            <?php } ?>
                            
                        
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

