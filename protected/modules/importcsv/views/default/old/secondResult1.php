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
	$conLists		=	EmailList::model()->findAll();
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
	
	$thirdContent	=	'<input type=\"hidden\" name=\"perRequest\" id=\"perRequest\" value=\"'.$perRequest.'\" >';
	$thirdContent	.=	'<table width=\"100%\"><tr><th colspan=\"2\">Select the contact lists</th></tr><tr><td width=\"20%\">Contact lists</td><td><select name=\"contactList[]\" multiple=\"multiple\">';
	foreach($conLists as $conList){
		$thirdContent	.=	'<option value=\"'.$conList->id.'\">'.addslashes($conList->list_name).'</option>';
	}
	$thirdContent	.=	'</select></td></tr></table>';
	
	$thirdContent .= '<table width=\"100%\"><tr><th width=\"20%\">'.Yii::t('importcsvModule.importcsv', 'Table column').'</th><th align=\"left\">'.Yii::t('importcsvModule.importcsv', 'CSV column').'</th></tr>';
	
	
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

        $thirdContent = $thirdContent.'<tr><td>'.$tableColumns[$i].'</td><td><select name=\"Columns['.$i.']\" id=\"select_'.$i.'\">'.$optionsContent.'</select></td></tr>';
    }
	$thirdContent	.=	'</table>';
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
