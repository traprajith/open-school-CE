<?php
/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.3
 *
 * Import result
 */

if($error==1) {

    // first error: No one column is selected

    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": ".Yii::t('importcsvModule.importcsv', 'No one column is selected')."</span>");
}
elseif($error==2) {

    // second error: Items per one request must not be empty
    
    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": '".Yii::t('importcsvModule.importcsv', 'Items per one request')."' - ".Yii::t('importcsvModule.importcsv', 'must not be empty')."</span>");
}
elseif($error==3) {

    // third error: Items per one request must be a number
    
    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": '".Yii::t('importcsvModule.importcsv', 'Items per one request')."' - ".Yii::t('importcsvModule.importcsv', 'must be a number')."</span>");
}
elseif($error==4) {

    // fourth error: Keys for compare must be selected (only for second and third modes)
    
    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": ".Yii::t('importcsvModule.importcsv', 'For this mode')." '".Yii::t('importcsvModule.importcsv', 'Keys for compare')."' - ".Yii::t('importcsvModule.importcsv', 'must be selected')."</span>");
}
elseif($error==0) {

    // No errors. The End

    if(empty($error_array)) {
        $strings = Yii::t('importcsvModule.importcsv', 'No');
    }
    else {
        $errorsLength = sizeof($error_array);
        for($k=0; $k<$errorsLength; $k++) {
           $strings = ($k == 0) ? $errorsLength[$k] : ", ".$errorsLength[$k];
        }
    }
    
    echo "<span class='importCsvNoError'>".Yii::t('importcsvModule.importcsv', 'Import was carried out')."</span>.<br/>".Yii::t('importcsvModule.importcsv', 'Errors in rows').": ".$strings;

    ?>
    <script type="text/javascript">
        toEnd();
    </script>
    <?php
}
?>
