<?php
/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.3
 *
 * module form
 */

$this->breadcrumbs=array(
	Yii::t('importcsvModule.importcsv', 'Import')." CSV",
);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="247" valign="top">
    
    <?php $this->renderPartial('//configurations/left_side');?>
    
    </td>
    <td valign="top">
    <div class="cont_right ">
<div id="importCsvSteps">
    <h1><?php echo Yii::t('importcsvModule.importcsv', 'Import'); ?> CSV</h1>

    <strong><?php echo Yii::t('importcsvModule.importcsv', 'File'); ?> :</strong> <span id="importCsvForFile">&nbsp;</span><br/>
    <strong><?php echo Yii::t('importcsvModule.importcsv', 'Fields Delimiter'); ?> :</strong> <span id="importCsvForDelimiter">&nbsp;</span><br/>
    <strong><?php echo Yii::t('importcsvModule.importcsv', 'Text Delimiter'); ?> :</strong> <span id="importCsvForTextDelimiter">&nbsp;</span><br/>
    <strong><?php echo Yii::t('importcsvModule.importcsv', 'Table'); ?> :</strong> <span id="importCsvForTable">&nbsp;</span><br/><br/>
    
    

    <?php echo CHtml::beginForm('','post',array('enctype'=>'multipart/form-data')); ?>
    <?php echo CHtml::hiddenField("fileName", ""); ?>
    <?php echo CHtml::hiddenField("thirdStep", "0"); ?>
     <?php echo CHtml::hiddenField("table", $table); ?>

    <div id="importCsvFirstStep">
        <div id="importCsvFirstStepResult">
            &nbsp;
        </div>
        <?php  echo CHtml::button(Yii::t('importcsvModule.importcsv', 'Select CSV File'), array("id"=>"importStep1")); ?>
    </div>
    <div id="importCsvSecondStep">
        <div id="importCsvSecondStepResult">
            &nbsp;
        </div>
         <strong><?php echo Yii::t('importcsvModule.importcsv', 'Fields Delimiter'); ?></strong> <span class="require">*</span><br/>
        <?php echo CHtml::textField("delimiter", $delimiter); ?>
        <br/><br/>
	
	<strong><?php echo Yii::t('importcsvModule.importcsv', 'Text Delimiter'); ?></strong><br/>
        <?php echo CHtml::textField("textDelimiter", $textDelimiter); ?>
        <br/><br/>

        <strong><?php echo Yii::t('importcsvModule.importcsv', 'Table'); ?></strong> <span class="require">*</span><br/>
        <?php echo CHtml::dropDownList('table', '', $tablesArray);?><br/><br/>

        <?php
        echo CHtml::ajaxSubmitButton(Yii::t('importcsvModule.importcsv', 'Next'), '', array(
            'update' => '#importCsvSecondStepResult',
        ));
        ?>
       <?php /*?> <strong><?php echo Yii::t('importcsvModule.importcsv', 'Fields Delimiter'); ?></strong> <span class="require">*</span><br/>
        <?php echo CHtml::textField("delimiter", $delimiter); ?>
        <br/><br/>
	
	<strong><?php echo Yii::t('importcsvModule.importcsv', 'Text Delimiter'); ?></strong><br/>
        <?php echo CHtml::textField("textDelimiter", $textDelimiter); ?>
        <br/><br/>

        <strong><?php echo Yii::t('importcsvModule.importcsv', 'Table'); ?></strong> <span class="require">*</span><br/>
        <?php echo CHtml::dropDownList('table', '', $tablesArray);?><br/><br/>

        <?php
        echo CHtml::ajaxSubmitButton(Yii::t('importcsvModule.importcsv', 'Next'), '', array(
            'update' => '#importCsvSecondStepResult',
        ));
        ?><?php */?>
    </div>
    <?php echo CHtml::endForm(); ?>

    <div id="importCsvThirdStep">
        <?php echo CHtml::beginForm('','post'); ?>
            <?php echo CHtml::hiddenField("thirdStep", "1"); ?>
            <?php echo CHtml::hiddenField("thirdDelimiter", ""); ?>
	    <?php echo CHtml::hiddenField("thirdTextDelimiter", ""); ?>
            <?php echo CHtml::hiddenField("thirdTable", ""); ?>
            <?php echo CHtml::hiddenField("thirdFile", ""); ?>
            <?php echo CHtml::hiddenField("perRequest", "10000"); ?>
            <div id="importCsvThirdStepResult">
                &nbsp;
            </div>
            <div id="importCsvThirdStepColumnsAndForm">
                <div id="importCsvThirdStepColumns">&nbsp;</div><br/>
                <?php
                    echo CHtml::ajaxSubmitButton(Yii::t('importcsvModule.importcsv', 'Import'), '', array(
                        'update' => '#importCsvThirdStepResult',
                    ));
                ?>
            </div>
        <?php echo CHtml::endForm(); ?>
    </div>
    <br/>
    <span id="importCsvBread1">&laquo; <?php echo CHtml::link(Yii::t('importcsvModule.importcsv', 'Start over'), array("/importcsv"));?></span>
    <span id="importCsvBread2"> &laquo; <a href="javascript:void(0)" id="importCsvA2"><?php echo Yii::t('importcsvModule.importcsv', 'Fields Delimiter').", ".Yii::t('importcsvModule.importcsv', 'Text Delimiter')." ".Yii::t('importcsvModule.importcsv', 'and')." ".Yii::t('importcsvModule.importcsv', 'Table');?></a></span>
</div>
 </td>
  </tr>
</table>
<script>
function validate()
{
	
}
</script>