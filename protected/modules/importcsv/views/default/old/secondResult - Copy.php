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
//var_dump($fromCsv);exit;
if($error==1) {
    
    // first error: Delimiter can not be empty
    
    echo("<span class='importCsvError'>".Yii::t('importcsvModule.importcsv', 'Error').": ".Yii::t('importcsvModule.importcsv', 'Fields Delimiter can not be empty')."</span>");
}
elseif($error==0){
    //making options width csv columns for $csvKey
	Yii::import('application.models.*');
	$batches		=	Batches::model()->findAll();
//var_dump($conLists);exit;
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
	$thirdContent	=	'<div style=\"padding:20px 0px;\">';
	$thirdContent	.=	'<input type=\"hidden\" name=\"perRequest\" id=\"perRequest\" value=\"'.$perRequest.'\" >';
	$thirdContent	.=	'<div class=\"imprt_csv_hdngbx\">Select the contact lists</div>';
	$thirdContent	.=	'<div style=\"color:#666666; font-weight:bold; font-size:14px;\">';
	
	
	
	
	$thirdContent	.=	'<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"84%\"><tr><td><span style=\"font-size:14px;\">Batch :</span></td><td><select name=\"batchlist[]\" multiple=\"multiple\"  style=\"width:300px\">';
	foreach($batches as $batch){
		$thirdContent	.=	'<option value=\"'.$batch->id.'\">'.addslashes($batch->name).'</option>';
	}
	$thirdContent	.=	'</select></td></tr></table></div>';
	
	$thirdContent	.=	'<div style=\"padding-top:0px;  border:#e2e2e2 1px solid;\">';
	
	$thirdContent	.=	'<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"color:#666666; background:#F0F0F0; padding:0px; text-align:center;\"><tr ><td width=\"20%\">Table column</td><td width=\"20%\">CSV column</td><td width=\"20%\">&nbsp;</td><td width=\"20%\">&nbsp;</td></tr></table>';
	
	$thirdContent .= '<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"color:#666666;\">';
	
	
    for($i=0; $i<$length; $i++) {

        $optionsContent  = '<option value=\"\"></option>';
        for($n=0; $n<$lengthCsv; $n++) {
            $valOpt = $n+1;
			$selected	=	'';
            $selected = (isset($paramsArray['columns'][$tableColumns[$i]]) && $paramsArray['columns'][$tableColumns[$i]]==$valOpt) ? 'selected=\"selected\"' : '';
            //$optionsContent  = $optionsContent.'<option value=\"'.$valOpt.'\" '.$selected.'>'.trim($fromCsv[$n]).'</option>';
			$optionsContent  = $optionsContent.'<option value=\"'.$valOpt.'\" '.$selected.'>'.addslashes(trim($fromCsv[$n])).'</option>';
        }
        $optionsContent  = trim($optionsContent);

        $thirdContent = $thirdContent.'<tr><td  align=\"center\" width=\"30%\" style=\"border-bottom:#e2e2e2 1px solid;\">'.$tableColumns[$i].'</td><td width=\"70%\" style=\"border-bottom:#e2e2e2 1px solid;\"><select name=\"Columns['.$i.']\" id=\"select_'.$i.'\">'.$optionsContent.'</select></td></tr>';
    }
	$thirdContent	.=	'</table>';
	$thirdContent	.=	'</div></div>';
    $thirdContent = trim($thirdContent);

	//echo $thirdContent;
    // Going to third step
    
    ?>
    <script type="text/javascript">
		//alert('');
        toThirdStep('<?php echo($thirdContent);?>', "<?php echo addslashes($delimiter);?>", "<?php echo($table);?>", "<?php echo addslashes($textDelimiter);?>");
    </script>
    <?php
}
?>
