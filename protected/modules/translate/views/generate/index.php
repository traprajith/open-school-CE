<?php
	$this->breadcrumbs=array(
		Yii::t('app','Settings')=>array('/configurations'),
		Yii::t('app','Translation'),	
	);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Translations')." - ".TranslateModule::translator()->acceptedLanguages[Yii::app()->getLanguage()]?></h1>            
                <table width="719px">
                    <tr>
                        <td>
                            <span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','Language');?> :</span>
                            <br />
							<?php echo TranslateModule::translator()->g_dropdown("lang");?>
                        </td>
                        <td>
                        	<span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','Filter by');?> :</span>
                            <br />
                            <?php
                                echo CHtml::dropDownList("filter_by", $filter_by, array(1=>Yii::t("app", "All"), 2=>Yii::t("app", "Completed Translations"), 3=>Yii::t("app", "Missing Translations")));
                            ?>
                        </td>
                        <td align="rigsht">                            
                            <?php
                            	$form = $this->beginWidget('CActiveForm', array(
									'method' => 'GET',
								));
							?>
                            <span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','Items');?> :</span>
                            <br />
                            <?php
                                echo CHtml::dropDownList("page_size", $page_size, array(10=>10, 20=>20, 50=>50, 100=>100, 150=>150, 200=>200));
                            ?>
                            <?php $this->endWidget(); ?>
                        </td>
                    </tr>
                </table>
                
                <div class="list_contner_hdng">
                    <div class="letterNavCon">
                        <ul>
                            <?php
								if((isset($_GET['val']) and $_GET['val']==NULL) or !isset($_GET['val'])){
                                    echo '<li class="ln_active">'.CHtml::link('All', 'javascript:void(0);', array('class'=>'alphabet-box active', 'data-alphabet'=>'')).'</li>';
                                }
                                else{
                                    echo '<li>'.CHtml::link('All', 'javascript:void(0);', array('data-alphabet'=>'', 'class'=>'alphabet-box')).'</li>';
                                }
								
                                foreach (range('A', 'Z') as $char) {
                                    if(isset($_GET['val']) and strtolower($_GET['val'])==strtolower($char)){
                                        echo '<li class="ln_active">'.CHtml::link($char, 'javascript:void(0);', array('class'=>'vtip alphabet-box active', 'data-alphabet'=>$char)).'</li>';
                                    }
									else{
										echo '<li>'.CHtml::link($char, 'javascript:void(0);', array('class'=>'vtip alphabet-box', 'data-alphabet'=>$char)).'</li>';
									}
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <br/>
				
                <?php
                if(count($models)==0){
				?>
                	<div class="formCon">
                        <div class="formConInner">                             
                            <div style="padding:0px 0 0 0px; text-align:left">
                                <?php echo Yii::t('app','No data found !!');?>
                            </div>                      
                        </div>
                    </div>
                <?php
				}
				else{
				?>
					<?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'method' => 'POST',
                        ));
                        echo CHtml::hiddenField("MessageSource[language]", $language);
                    ?>
                        <?php                                          
                            $this->widget('CLinkPager', array(
                                'currentPage'=>$pages->getCurrentPage(),
                                'itemCount'=>$item_count,
                                'pageSize'=>$page_size,
                                'maxButtonCount'=>5,
                                //'nextPageLabel'=>'My text >',
                                'header'=>'',
                                'htmlOptions'=>array('class'=>'pages'),
                            ));
                        ?>
                        <div class="clear"></div>
                        <div>
                        	<a>** <?php echo Yii::t('app','Please read the instructions before translation');?>.</a> <a style="text-decoration:underline;" href="javascript:void(0);" id="read_t_instructions"><?php echo Yii::t('app','Click here');?></a>.
                        </div>
                        <br />
                        <div class="formCon" style="display:none;" id="t_instructions">
                            <div class="formConInner">
                            	<h3 style="margin:0px; color:#396"><?php echo Yii::t('app','Read these instructions carefully before translating the application');?>.</h3>
                                <ol style="margin:10px 0px 0px; padding:0px 30px 0px 10px; line-height:17px; text-align:justify;">
                                	<li><?php echo Yii::app()->params['app_name']; ?> <?php echo Yii::t('app','tranlate module helps you to convert the whole application to a language of your choice, given it is present in the list of languages available in the application (check the language dropdown to check availability of your language)');?>. <?php echo Yii::app()->params['app_name'] ?> <?php echo Yii::t('app','uses ENGLISH as the default language');?>.</li>
                                    <li><?php echo Yii::t('app','Select the desired language your want to add translations for from the Language dropdown above');?>.</li>
                                	<li><?php echo Yii::t('app','Once you have selcted your language Labels / Phrases in the application are listed in the table below. You can filter it using the "Filter by" dropdown above');?>.</li>
                                    <li><?php echo Yii::t('app','Each label has a textbox next to it. Enter your translation in this box');?>.</li>
                                    <li><?php echo Yii::t('app','Please do not translate the words inside the labels that look like {word} and :word. These are actually used for background label generations. Do not change such words as it might interfere in application processes');?>!!</li>
                                    <li><?php echo Yii::t('app','After entering your translations for each label, click on the " Generate Translations" button given at the bottom of the current page to save them');?>.</li>
                                    <li><?php echo Yii::t('app','Repeat steps 3-6 to complete all the translations');?>.</li>
                                    <li><?php echo Yii::t('app','You can now import and export translations without having to enter them manually. Check the left side menu for these options');?></li>
                                    <li><?php echo Yii::t('app','Once you have entered your translations, go to Settings - School Configurations select your language and hit save. Try refreshing the page if you do not see the translations take effect right away');?></li>
                                </ol>
                                <br />
                                <br />
                                <a href="javascript:void(0);" id="hide_t_instructions"><?php echo Yii::t('app','Hide instructions');?></a>
                            </div>
                        </div>
                        <div class="formCon">
                            <div class="formConInner">
                                <table width="680px">
                                    <tr>
                                        <td colspan="2">
                                            <h4 style="margin:0px; color:#396"><?php echo Yii::t('app', "Number of items in this page")." : ".count($models);?></h4>
                                            <br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:5px;">
                                            <h3 style="margin:0px; color:#09C"><?php echo Yii::t('app', "Label in Application");?></h3>
                                        </td>
                                        <td style="padding-bottom:5px;">
                                            <h3 style="margin:0px; color:#09C"><?php echo Yii::t('app', "Your Translation");?></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom:20px;" colspan="2">
                                        </td>
                                    </tr>            	
                                    <?php
                                    foreach($models as $item){
                                        $item->language	= $language;
                                        echo "<tr style='padding-bottom:10px;'>";
                                        echo "<td style='padding-bottom:10px; width:300px'>".$item->message."</td>";
                                        echo "<td style='padding-bottom:10px;'>".CHtml::textField("MessageSource[items][".$item->id."]", $item->translation, array("style"=>"width:100%;"))."</td>";
                                        echo "</tr>";
                                    }
                                    ?>                  
                                </table>  
                                <div style="padding:0px 0 0 0px; text-align:left">
                                    <input type="submit" value="<?php echo Yii::t('app','Generate Translations');?>" name="yt0" class="formbut" />
                                </div>                      
                            </div>
                        </div>
                        <?php                                          
                            $this->widget('CLinkPager', array(
                                'currentPage'=>$pages->getCurrentPage(),
                                'itemCount'=>$item_count,
                                'pageSize'=>$page_size,
                                'maxButtonCount'=>5,
                                //'nextPageLabel'=>'My text >',
                                'header'=>'',
                                'htmlOptions'=>array('class'=>'pages'),
                            ));
                        ?>
                        <div class="clear"></div>                    
                    <?php $this->endWidget(); ?>
                <?php
				}
				?>							
            </div>
        </td>
    </tr>    
</table>
<script>
$("#lang, #filter_by, #page_size").change(function(e) {
	var lan		= $("#lang").val();
	var filter	= $("#filter_by").val();
	var size	= $("#page_size").val();	
	var alpha	= $(".alphabet-box.active").attr('data-alphabet');
	var redirect	= "<?php echo Yii::app()->createUrl("/translate/generate/index");?>&lang=" + lan + "&filter_by=" + filter + "&page_size=" + size;
	if(typeof alpha!="undefined" && alpha!=null && alpha!=""){
		redirect	+= "&val=" + alpha;
	}
	window.location.href	= redirect;
});

$(".alphabet-box").click(function(e) {
	var lan		= $("#lang").val();
	var filter	= $("#filter_by").val();
	var size	= $("#page_size").val();
	var alpha	= $(this).attr('data-alphabet');
	window.location.href	= "<?php echo Yii::app()->createUrl("/translate/generate/index");?>&lang=" + lan + "&filter_by=" + filter + "&page_size=" + size + "&val=" + alpha;
});

$("#read_t_instructions").click(function(e) {
    $("#t_instructions").slideDown();
});

$("#hide_t_instructions").click(function(e) {
    $("#t_instructions").slideUp();
});
</script>