<?php
/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.3
 *
 *
 *
 *
 * Result of choosing table and delimiter
 */

if($error==1) {
    
    // first error: Delimiter can not be empty
    
    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": ".Yii::t('importcsvModule.importcsv', 'Fields Delimiter can not be empty')."</span>");
}
elseif($error==0){

    //making options width csv columns for $csvKey

	
    $lengthCsv       = sizeof($fromCsv);
    $optionsContent4 = '<option value=\"\"></option>';

    for($i=0; $i<$lengthCsv; $i++) {
        $valOpt = $i+1;
        $selected4 = ($paramsArray['csvKey']==$valOpt) ? 'selected=\"selected\"' : '';
        $optionsContent4 = $optionsContent4.'<option value=\"'.$valOpt.'\" '.$selected4.'>'.trim($fromCsv[$i]).'</option>';
    }
    $optionsContent4 = trim($optionsContent4);


    //making options width table rows for $tableKey
    
    $length = sizeof($tableColumns);
    $optionsContent2 = '<option value=\"\"></option>';
    $optionsContent3 = '<option value=\"\"></option>';
    for($i=0; $i<$length ; $i++) {
        $valOpt2 = $i+1;

        $selected3 = ($paramsArray['tableKey']==trim($tableColumns[$i])) ? 'selected=\"selected\"' : '';

        $optionsContent2 = $optionsContent2.'<option value=\"'.$valOpt2.'\">'.trim($tableColumns[$i]).'</option>';
        $optionsContent3 = $optionsContent3.'<option value=\"'.trim($tableColumns[$i]).'\" '.$selected3.'>'.trim($tableColumns[$i]).'</option>';
    }

    $optionsContent2 = trim($optionsContent2);
    $optionsContent3 = trim($optionsContent3);

    /*
     * making table width columns for third step
     */

    $selected1   = ($paramsArray['mode']==1) ? 'selected=\"selected\"' : '';
    $selected2   = ($paramsArray['mode']==2) ? 'selected=\"selected\"' : '';
    $selected3   = ($paramsArray['mode']==3) ? 'selected=\"selected\"' : '';

    $modeContent = '<select name=\"Mode\" id=\"Mode\">'.$modeOption1.$modeOption2.$modeOption3.'</select>';
    $keysContent = '<tr><td>'.Yii::t('importcsvModule.importcsv', 'Table field').'</td><td><select name=\"Tablekey\">'.$optionsContent3.'</select></td></tr><tr><td>'.Yii::t('importcsvModule.importcsv', 'CSV field').'</td><td><select name=\"CSVkey\">'.$optionsContent4.'</select></td></tr>';


    $perRequest = ($paramsArray['perRequest']!='') ? $paramsArray['perRequest'] : '10000';
	
	
	/*$thirdContent	.=	'<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"84%\"><tr><td><span style=\"font-size:14px;\">Batches  :</span></td><td><select name=\"batch[]\" multiple=\"multiple\"  style=\"width:300px\">';
	foreach($batches as $batch){
		$thirdContent	.=	'<option value=\"'.$batch->id.'\">'.addslashes($batch->name).'</option>';
	}*/
	/*$thirdContent	.=	'</select></td></tr></table></div>';
	
	$thirdContent	.=	'<div style=\"padding-top:0px;  border:#e2e2e2 1px solid;\">';
	
	$thirdContent	.=	'<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"color:#666666; background:#F0F0F0; padding:0px; text-align:center;\"><tr ><td width=\"20%\">Table column</td><td width=\"20%\">CSV column</td><td width=\"20%\">&nbsp;</td><td width=\"20%\">&nbsp;</td></tr></table>';
	
	$thirdContent .= '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"color:#666666;\">';
	*/
	
	
	
    $thirdContent = '<table class=\"importCsvTable\" cellpadding=\"5\" cellspacing=\"1\" border=\"0\" width=\"100%\"><tr><td width=\"50%\">'.Yii::t('importcsvModule.importcsv', 'Mode').' <span class=\"require\">*</span></td><td width=\"50%\">'.$modeContent.'</td></tr><tr><td width=\"50%\">'.Yii::t('importcsvModule.importcsv', 'Items per one request').' <span class=\"require\">*</span></td><td width=\"50%\"><input type=\"text\" name=\"perRequest\" id=\"perRequest\" value=\"'.$perRequest.'\"/></td></tr><tr><th colspan=\"2\">'.Yii::t('importcsvModule.importcsv', 'Keys for compare').'</th>'.$keysContent.'</tr><tr><th>'.Yii::t('importcsvModule.importcsv', 'Table column').'</th><th>'.Yii::t('importcsvModule.importcsv', 'CSV column').'</th></tr>';
   for($i=0; $i<$length; $i++) {

        $optionsContent  = '<option value=\"\"></option>';
        for($n=0; $n<$lengthCsv; $n++) {
            $valOpt = $n+1;
            $selected = (isset($paramsArray['columns'][$tableColumns[$i]]) && $paramsArray['columns'][$tableColumns[$i]]==$valOpt) ? 'selected=\"selected\"' : '';
            $optionsContent  = $optionsContent.'<option value=\"'.$valOpt.'\" '.$selected.'>'.trim($fromCsv[$n]).'</option>';
        }
        $optionsContent  = trim($optionsContent);

        $thirdContent = $thirdContent.'<tr><td>'.$tableColumns[$i].'</td><td><select name=\"Columns['.$i.']\" id=\"select_'.$i.'\">'.$optionsContent.'</select></td></tr>';
    }
		/* $thirdContent = $thirdContent.'<tr><td  align=\"center\" width=\"30%\" style=\"border-bottom:#e2e2e2 1px solid;\">'.$tableColumns[$i].'</td><td width=\"70%\" style=\"border-bottom:#e2e2e2 1px solid;\"><select name=\"Columns['.$i.']\" id=\"select_'.$i.'\">'.$optionsContent.'</select></td></tr>';*/
    
   
    $thirdContent = $thirdContent.'</table>';
    $thirdContent = trim($thirdContent);

    // Going to third step
    
    ?>
    <script type="text/javascript">
        toThirdStep("<?php echo($thirdContent);?>", "<?php echo addslashes($delimiter);?>", "<?php echo($table);?>", "<?php echo addslashes($textDelimiter);?>");
    </script>
    <?php
}
?>
