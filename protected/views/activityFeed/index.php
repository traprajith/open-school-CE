<?php
$this->breadcrumbs=array(
	Yii::t('app', 'Activity Feed'),
);?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('mailbox.views.default.left_side'); ?>
        </td>
        <td valign="top">
        
            <div class="cont_right formWrapper">
                <h1><?php echo Yii::t('app','Activity Feed');?></h1>
             
                <div class="a_feed_cntnr" >
                	<div class="full-formWrapper opnsl_new_edtn_block">                   
							            <div class="add_banner_block">
							                <h2>The Community Edition is feature-limited.</h2>
							                <p>Buy our latest Premium version to get this feature and manage your institution more efficiently!</p>
							            </div>
							            <div class="opnsl_tbl_editon_footer">
							                <a href="https://open-school.org/pricing" target="_blank" class="upgrade_btn">Talk to Sales</a>
							            </div>
						        	</div>
                </div> <!-- END div class="a_feed_cntnr" --> 
				
            </div> <!-- END div class="cont_right formWrapper" -->
        </td>
    </tr>
</table>
