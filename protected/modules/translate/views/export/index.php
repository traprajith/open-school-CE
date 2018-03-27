<?php
	$this->breadcrumbs=array(
		Yii::t('app','Settings')=>array('/configurations'),
		Yii::t('app','Export Translation'),	
	);
             
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="247" valign="top">
        	<?php $this->renderPartial('/default/left_side');?>
        </td>
        <td valign="top">
            <div class="cont_right ">
            <h1><?php echo Yii::t('app','Export Translations')." - ".TranslateModule::translator()->acceptedLanguages[Yii::app()->getLanguage()]?></h1>
            <div class="form">
                <div class="inner_new_formCon">
                    <h3><?php echo Yii::t('app','Fields with').'<span class="required">*</span>'.Yii::t('app','are required.');?></h3>
                    <br>                   
                    <?php echo CHtml::beginForm('','post',array()); ?>
                    <table width="200px">
                        <tr>
                                <td colspan="2">
                                <div id="exportmsg">
                                <?php
                                if(Yii::app()->user->hasFlash('exporterror')){
									echo '<span style="display: block; margin-bottom: 10px; color:#F00;">'.Yii::app()->user->getFlash('exporterror')."</span>";
								}
								?>
                                </div>
                                </td>
                                </tr>
                        <tr>
                            <td>
                                <span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','Language');?></span>
                                <br />
                                <?php echo TranslateModule::translator()->g_dropdown("lang");?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','Filter by');?></span>
                                <br />
                                <?php
                                    $type='';
                                    if(isset($_REQUEST['type']) && $_REQUEST['type']!=NULL)
                                    {
                                        $type   =   $_REQUEST['type'];
                                    }
                                    echo CHtml::dropDownList("type", $type, array(1=>Yii::t("app", "All"), 2=>Yii::t("app", "Completed Translations"), 3=>Yii::t("app", "Missing Translations")));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-weight:600; margin:0px 0px -10px 2px; display:block;"><?php echo Yii::t('app','File Format');?></span>
                                <br />
                                <?php
                                    //echo CHtml::dropDownList("format", '', array('xls'=>Yii::t("app", "XLS"), 'csv'=>Yii::t("app", "CSV")), array('empty'=>Yii::t('app','Select')));
                                    echo CHtml::dropDownList("format", '', array('xls'=>Yii::t("app", "XLS")), array('empty'=>Yii::t('app','Select')));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo CHtml::submitButton(Yii::t('app', 'Export'), array('name'=>'export-database','id'=>'export-submit','class'=>'formbut'));?>
                            </td>
                        </tr>
                    </table>
                    <?php echo CHtml::endForm(); ?>
                </div>                
            </div>
            </div>
            
        </td>
    </tr>    
</table>
<script>
$("#lang, #type").change(function(e) {
	var lan		= $("#lang").val();
	var filter	= $("#type").val();	
	var alpha	= $(".alphabet-box.active").attr('data-alphabet');
	var redirect	= "<?php echo Yii::app()->createUrl("/translate/export/index");?>&lang=" + lan + "&type=" + filter ;
	if(typeof alpha!="undefined" && alpha!=null && alpha!=""){
		redirect	+= "&val=" + alpha;
	}
	window.location.href	= redirect;
});

$('#export-submit').click(function()
{
    var type= $("#format").val();
    if(type=='')
    {
        alert("<?php echo Yii::t('app','Select export file format'); ?>");
        return false;
    }            
});
</script>