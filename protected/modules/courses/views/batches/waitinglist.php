<style>
	.container
	{
		background:#FFF;
	}
	
	.max_student{ border-left: 3px solid #fff;
    margin: 0 3px;
    padding: 6px 0 6px 3px;
    word-break: break-all;}
	

</style>

<?php 
$batch=Batches::model()->findByAttributes(array('id'=>$_REQUEST['id'])); 
$this->breadcrumbs=array(
	Yii::t('app','Courses')=>array('/courses'),
	$batch->name =>array('/courses/batches/batchstudents','id'=>$_REQUEST['id']),
	Yii::t('app','Waitinglist'),
);
?>

<?php Yii::app()->clientScript->registerCoreScript('jquery');

//IMPORTANT about Fancybox.You can use the newest 2.0 version or the old one
//If you use the new one,as below,you can use it for free only for your personal non-commercial site.For more info see
//If you decide to switch back to fancybox 1 you must do a search and replace in index view file for "beforeClose" and replace with 
//"onClosed"
// http://fancyapps.com/fancybox/#license
// FancyBox2
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/js_plugins/fancybox2/jquery.fancybox.css', 'screen');
// FancyBox
//Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.js', CClientScript::POS_HEAD);
// Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/fancybox/jquery.fancybox-1.3.4.css','screen');
//JQueryUI (for delete confirmation  dialog)
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/js/jquery-ui-1.8.12.custom.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/jqui1812/css/dark-hive/jquery-ui-1.8.12.custom.css','screen');
///JSON2JS
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/json2/json2.js');


//jqueryform js
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/jquery.form.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/form_ajax_binding.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js_plugins/ajaxform/client_val_form.css','screen');  ?>
<?php
Yii::app()->clientScript->registerScript(
	'myHideEffect',
	'$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
	CClientScript::POS_READY
);
?>


<div style="background:#FFF;">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr>
                <td valign="top">
                        <div style="padding:20px;">
                            <div class="clear"></div>
                            <div class="emp_right_contner">
                                <div class="emp_tabwrapper">
									<?php $this->renderPartial('tab');?>
                                    <div class="clear"></div>
                                    	<div class="full-formWrapper opnsl_new_edtn_block">                   
							            <div class="add_banner_block">
							                <h2>The Community Edition is feature-limited.</h2>
							                <p>Buy our latest Premium version to get this feature and manage your institution more efficiently!</p>
							            </div>
							            <div class="opnsl_tbl_editon_footer">
							                <a href="https://open-school.org/pricing" target="_blank" class="upgrade_btn">Talk to Sales</a>
							            </div>
						        	</div>
                                </div> <!-- END div class="emp_tabwrapper" -->
                            </div> <!-- END div class="emp_right_contner" -->
                        </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>



