<?php

/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.3
 *
 * ImportCSV is used for load positions from CSV file to database.
 * Import occurs in three steps:
 *
 * Upload file;
 * Select delimiter and table;
 * Select mode and columns in table.
 * Module has 3 modes:
 * 
 * Insert all - Add all rows;
 * Insert new - Add new rows. Old rows remain unchanged;
 * Insert new and replace old - Add new rows. Old rows replace.
 * All parameters from the previous imports will be saved in a special .php file in upload folder.
 * 
 * Requirements 
 * 
 * Yii 1.1
 * 
 * Usage 
 * 
 * 1) Copy all the 'importcsv' folder under /protected/modules;
 * 
 * 2) Register this module in /protected/config/main.php
 * 
 * 'modules'=>array(
 *         .........
 *         'importcsv'=>array(
 *             'path'=>'upload/importCsv/', // path to folder for saving csv file and file with import params
 *         ),
 *         ......
 *     ),
 * 3) Create a directory which you use in 'path'. Do not forget to set access permissions for directory 'path';
 * 
 * 4) The module is available here:
 * 
 * http://yourproject/importcsv.
 * 
 * Or here:
 * 
 * http://yourproject/index.php?r=importcsv.
 * 
 * Or somewhere else:-) It depends from path settings in your project;
 * 
 * 5) ATTENTION! The first row of your csv-file must will be a row with column names. 
 *
*/

class DefaultController extends RController {

    public $colsArray = array();
	
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

    /*
     * action for form
     */

    public function actionIndex() {
		//$this->layout ="/layouts/none";
		$delimiter 		= Yii::app()->controller->module->delimiter;
		$textDelimiter 	= Yii::app()->controller->module->textDelimiter;
		$table			= Yii::app()->controller->module->table;
		$perRequest		= Yii::app()->controller->module->perRequest;
		$mode			= Yii::app()->controller->module->mode;
		$tableKey		= Yii::app()->controller->module->tableKey;
		$csvKey			= Yii::app()->controller->module->csvKey;
		$allowedColumns	= Yii::app()->controller->module->allowedColumns;
		
		//publish css and js
	
		Yii::app()->clientScript->registerCssFile(
			Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('application.modules.importcsv.assets') . '/styles.css'
			)
		);
	
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('application.modules.importcsv.assets') . '/ajaxupload.js'
			)
		);
	
		Yii::app()->clientScript->registerScript('uploadActionPath', 'var uploadActionPath="' . $this->createUrl('default/upload') . '"', CClientScript::POS_BEGIN);
	
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('application.modules.importcsv.assets') . '/download.js'
			)
		);
	
		//getting all tables from db
	
		$tables = Yii::app()->getDb()->getSchema()->getTableNames();
	
		$tablesLength = sizeof($tables);
		$tablesArray = array();
		for ($i = 0; $i < $tablesLength; $i++) {
			$tablesArray[$tables[$i]] = $tables[$i];
		}
	
		if (Yii::app()->request->isAjaxRequest) {
			if ($_POST['thirdStep'] != 1) {
	
				//second step
		
				$delimiter = str_replace('&quot;', '"', str_replace("&#039;", "'", CHtml::encode(trim($_POST['delimiter']))));
				$textDelimiter = str_replace('&quot;', '"', str_replace("&#039;", "'", CHtml::encode(trim($_POST['textDelimiter']))));
				//$table = CHtml::encode($_POST['table']);
		
				if ($_POST['delimiter'] == '') {
					$error = 1;
					$csvFirstLine = array();
					$paramsArray = array();
				} else {
					// get all columns from csv file
		
					$error = 0;
					$uploaddir = Yii::app()->controller->module->path;
					$uploadfile = $uploaddir . basename($_POST['fileName']);
					$file = fopen($uploadfile, "r");
					$csvFirstLine = ($textDelimiter) ? fgetcsv($file, 0, $delimiter, $textDelimiter) : fgetcsv($file, 0, $delimiter);
					fclose($file);
		
					// checking file with earlier imports
		
					$paramsArray = $this->checkOldFile($uploadfile);
				}
		
				//get all columns from selected table
		
				$model = new ImportCsv;
				$tableColumns = $model->tableColumns($table);
				
		
				$this->layout = 'clear';
				$this->render('secondResult', array(
					'error' => $error,
					'tableColumns' => $allowedColumns,
					'delimiter' => $delimiter,
					'textDelimiter' => $textDelimiter,
					'table' => $table,
					'perRequest'=>$perRequest,
					'fromCsv' => $csvFirstLine,
					'paramsArray' => $paramsArray,
				));
			} else {
				//third step
				$delimiter = str_replace('&quot;', '"', str_replace("&#039;", "'", CHtml::encode(trim($_POST['thirdDelimiter']))));
				$textDelimiter = str_replace('&quot;', '"', str_replace("&#039;", "'", CHtml::encode(trim($_POST['thirdTextDelimiter']))));
				$table 		= CHtml::encode($_POST['thirdTable']);
				$uploadfile = CHtml::encode(trim($_POST['thirdFile']));
				$columns 	= $_POST['Columns'];
				$perRequest = CHtml::encode($_POST['perRequest']);
				
				$conLists	=	array();
				if(isset($_POST['contactList'])){
					$conLists	= $_POST['contactList'];
				}
				
				//$tableKey 	= CHtml::encode($_POST['Tablekey']);
				//$csvKey		= CHtml::encode($_POST['CSVkey']);
				//$mode 		= CHtml::encode($_POST['Mode']);
				$insertArray = array();
				$error_array = array();
				
				$allSelected	=	true;
				foreach($_POST['Columns'] as $singleColumn){
					if($singleColumn=='') $allSelected=false;
				}
				
				if($allSelected==true){
					if ($_POST['perRequest'] != '') {
					if (is_numeric($_POST['perRequest'])) {
		
		
						if (($mode == 2 || $mode == 3) && ($tableKey == '' || $csvKey == '')) {
						$error = 4;
						} else {
						$error = 0;
		
		
						//import from csv to db
		
						$model = new ImportCsv;
						$tableColumns = $model->tableColumns($table);
						
		
						//select old rows from table
		
						if ($mode == 2 || $mode == 3) {
							$oldItems = $model->selectRows($table, $tableKey);
						}
		
						$filecontent = file($uploadfile);
						$lengthFile = sizeof($filecontent);
						$insertCounter = 0;
						$stepsOk = 0;
		
						// begin transaction
		
						$transaction = Yii::app()->db->beginTransaction();
						try {
		
							// import to database
		
							for ($i = 0; $i < $lengthFile; $i++) {
							if ($i != 0 && $filecontent[$i] != '') {
								$csvLine = ($textDelimiter) ? str_getcsv($filecontent[$i], $delimiter, $textDelimiter) : str_getcsv($filecontent[$i], $delimiter);
		
								//Mode 1. insert All
								
								if ($mode == 1) {
									$insertArray[] = $csvLine;
									$insertCounter++;
									
									if ($insertCounter == $perRequest || $i == $lengthFile - 1) {
										$import = $model->InsertAll($table, $insertArray, $columns, $tableColumns, $conLists);
										$insertCounter = 0;
										$insertArray = array();
			
										if ($import != 1)
										$arrays[] = $i;
									}
								}
		
								// Mode 2. Insert new
		
								if ($mode == 2) {
									if ($csvLine[$csvKey - 1] == '' || !$this->searchInOld($oldItems, $csvLine[$csvKey - 1], $tableKey)) {
										$insertArray[] = $csvLine;
										$insertCounter++;
										if ($insertCounter == $perRequest || $i == $lengthFile - 1) {
										$import = $model->InsertAll($table, $insertArray, $columns, $tableColumns, $conLists);
										$insertCounter = 0;
										$insertArray = array();
			
										if ($import != 1)
											$arrays[] = $i;
										}
									}
								}
		
								// Mode 3. Insert new and replace old
		
								if ($mode == 3) {
									if ($csvLine[$csvKey - 1] == '' || !$this->searchInOld($oldItems, $csvLine[$csvKey - 1], $tableKey)) {
			
										// insert new
										$insertArray[] = $csvLine;
										$insertCounter++;
										if ($insertCounter == $perRequest || $i == $lengthFile - 1) {
										$import = $model->InsertAll($table, $insertArray, $columns, $tableColumns, $conLists);
										$insertCounter = 0;
										$insertArray = array();
			
										if ($import != 1)
											$arrays[] = $i;
										}
									}
									else {
			
										//replace old
			
										$import = $model->updateOld($table, $csvLine, $columns, $tableColumns, $csvLine[$csvKey - 1], $tableKey);
			
										if ($import != 1)
										$arrays[] = $i;
									}
								}
							}
							}
		
							if ($insertCounter != 0)
							$model->InsertAll($table, $insertArray, $columns, $tableColumns, $conLists);
		
							// commit transaction if not exception
		
							$transaction->commit();
						} catch (Exception $e) { // exception in transaction
							$transaction->rollBack();
						}
		
						// save params in file
						$this->saveInFile($table, $delimiter, $mode, $perRequest, $csvKey, $tableKey, $allowedColumns, $columns, $uploadfile, $textDelimiter);
						}
					} else {
						$error = 3;
					}
					} else {
					$error = 2;
					}
				} else {
					$error = 1;
				}
		
				$this->layout = 'clear';
				$this->render('thirdResult', array(
					'error' => $error,
					'delimiter' => $delimiter,
					'textDelimiter' => $textDelimiter,
					'table' => $table,
					'uploadfile' => $uploadfile,
					'error_array' => $error_array,
				));
			}
	
			Yii::app()->end();
		} else {
			// first loading
	
			$this->render('index', array(
			'delimiter' => $delimiter,
			'textDelimiter' => $textDelimiter,
			'table'=>$table,
			'tablesArray' => $tablesArray,
			));
		}
    }

    /*
     * action for file upload
     */

    public function actionUpload() {
	$uploaddir = Yii::app()->controller->module->path;
	$uploadfile = $uploaddir . basename($_FILES['myfile']['name']);

	$name_array = explode(".", $_FILES['myfile']['name']);
	$type = end($name_array);

	if ($type == "csv") {
	    if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {
		$importError = 0;
	    } else {
		$importError = 1;
	    }
	} else {
	    $importError = 2;
	}

	// checking file with earlier imports

	$paramsArray = $this->checkOldFile($uploadfile);
	$delimiterFromFile = $paramsArray['delimiter'];
	$textDelimiterFromFile = $paramsArray['textDelimiter'];
	$tableFromFile = $paramsArray['table'];

	// view rendering

	$this->layout = 'clear';
	$this->render('firstResult', array(
	    'error' => $importError,
	    'uploadfile' => $uploadfile,
	    'delimiterFromFile' => $delimiterFromFile,
	    'textDelimiterFromFile' => $textDelimiterFromFile,
	    'tableFromFile' => $tableFromFile,
	));
    }

    /*
     * search needle in old rows
     * 
     *  $array  - array with old items from database
     *  $needle - value from csv
     *  $key    - db column, where we search $needle
     *  @return boolean
     * 
     */

    public function searchInOld($array, $needle, $key) {
	$return = false;
	$arrayLength = sizeof($array);
	for ($i = 0; $i < $arrayLength; $i++) {
	    if ($array[$i][$key] == $needle)
		$return = true;
	}

	return $return;
    }

    /*
     * save import params in php file, for using in next imports
     *
     *  $table - db table
     *  $delimiter - csv delimiter
     *  $textDelimiter - csv text delimiter
     *  $mode - import mode
     *  $perRequest - items in one INSERT - mode
     *  $csvKey - key for compare from csv
     *  $tableKey - key for compare from table
     *  $tableColumns - list of table columns
     *  $csvColumns - list of csv columns
     *  $uploadfile - path to import file
     *
     */

    public function saveInFile($table, $delimiter, $mode, $perRequest, $csvKey, $tableKey, $tableColumns, $csvColumns, $uploadfile, $textDelimiter) {
	$columnsSize = sizeof($tableColumns);
	$columns = '';
	for ($i = 0; $i < $columnsSize; $i++) {
	    $columns = ($csvColumns[$i] != "") ? $columns . '"' . $tableColumns[$i] . '"=>' . $csvColumns[$i] . ', ' : $columns . '"' . $tableColumns[$i] . '"=>"", ';
	}

	$delimiter = addslashes($delimiter);
	$textDelimiter = addslashes($textDelimiter);

	$arrayToFile = '<?php
                $paramsArray = array(
                    "table"=>"' . $table . '",
                    "delimiter"=>"' . $delimiter . '",
		    "textDelimiter"=>"' . $textDelimiter . '",
                    "mode"=>' . $mode . ',
                    "perRequest"=>' . $perRequest . ',
                    "csvKey"=>"' . $csvKey . '",
                    "tableKey"=>"' . $tableKey . '",
                    "columns"=>array(
                        ' . $columns . '
                    ),
                );
            ?>';

	$uploadfileArray = explode(".", $uploadfile);
	$uploadfileArray[sizeof($uploadfileArray) - 1] = "php";
	$uploadfileNew = implode(".", $uploadfileArray);

	$fileForWrite = fopen($uploadfileNew, "w+");
	fwrite($fileForWrite, $arrayToFile);
	fclose($fileForWrite);
    }

    /*
     * checking file with earlier imports
     *
     * $uploadfile - path to import file
     * @return array Old params from file
     *
     */

    public function checkOldFile($uploadfile) {
	$selectfileArray = explode(".", $uploadfile);
	$selectfileArray[sizeof($selectfileArray) - 1] = "php";
	$selectfileNew = implode(".", $selectfileArray);

	if (file_exists($selectfileNew)) {
	    require_once($selectfileNew);
	    $paramsArray['delimiter'] = stripslashes($paramsArray['delimiter']);
	    $paramsArray['textDelimiter'] = stripslashes($paramsArray['textDelimiter']);
	} else {
	    $paramsArray['delimiter'] = ";";
	    $paramsArray['textDelimiter'] = '"';
	    $paramsArray['table'] = "";
	    $paramsArray['mode'] = "";
	    $paramsArray['perRequest'] = "10";
	    $paramsArray['csvKey'] = "";
	    $paramsArray['tableKey'] = "";
	    $paramsArray['columns'] = array();
	}

	return $paramsArray;
    }

	public function actionImportGoogleContacts(){
		if(isset($_GET["code"]) and $_GET["code"]!=NULL){
			$client_id 		= 	'762232144092.apps.googleusercontent.com';
			$client_secret 	=	'5csDrunh7dufwm0nl-N6lyTw';
			$redirect_uri 	= 	'http://127.0.0.1/womv2.0/importcsv/default/importGoogleContacts';
			$max_results 	= 	1000;
			$auth_code 		= 	$_GET["code"];
			
			function curl_file_get_contents($url)
			{
				$curl = curl_init();
				$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
				
				curl_setopt($curl, CURLOPT_URL,$url);   //The URL to fetch. This can also be set when initializing a session with curl_init().
				curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);    //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,5);   //The number of seconds to wait while trying to connect.    
				
				curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);  //To follow any "Location: " header that the server sends as part of the HTTP header.
				curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
				curl_setopt($curl, CURLOPT_TIMEOUT, 10);   //The maximum number of seconds to allow cURL functions to execute.
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //To stop cURL from verifying the peer's certificate.
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
				
				$contents = curl_exec($curl);
				curl_close($curl);
				return $contents;
			}
			
			$fields=array(
				'code'=>  urlencode($auth_code),
				'client_id'=>  urlencode($client_id),
				'client_secret'=>  urlencode($client_secret),
				'redirect_uri'=>  urlencode($redirect_uri),
				'grant_type'=>  urlencode('authorization_code')
			);
			$post = '';
			foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
			$post = rtrim($post,'&');
			
			$curl = curl_init();
			curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
			curl_setopt($curl,CURLOPT_POST,5);
			curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
			$result = curl_exec($curl);
			curl_close($curl);
			
			$response 		=  	json_decode($result);
			if($response!=NULL and isset($response->access_token)){
				$accesstoken 	= 	$response->access_token;
				
				$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
				$xmlresponse =  curl_file_get_contents($url);
				if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0))
				{
					echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
					exit();
				}
				$xml 		=  	new SimpleXMLElement($xmlresponse);
				$contacts	=	array();
				
				$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
				$result 	= 	$xml->xpath('//gd:email');
				
				/*$names 		= 	$xml->xpath('//gd:phoneNumber');				
				$i=0;
				foreach($names as $name){
					$contacts[$i++]['name']		=	(string)$name;
				}*/
				
				$i=0;
				foreach ($result as $title) {
					$contacts[$i++]['email']	=	(string)$title->attributes()->address;
				}
				
				if(count($contacts)>0){
					$addedCons	=	0;
					foreach($contacts as $contact){
						$f_name	=	'';
						$s_name	=	'';
						$email	=	$contact['email'];
						/*$parts	=	explode(' ',trim($contact['name']));
						if(isset($parts[0])) $f_name=$parts[0];
						if(isset($parts[1])) $s_name=$parts[1];*/
						
						$con	=	new EmailContacts;
						/*$con->first_name	=	$f_name;
						$con->last_name		=	$s_name;*/
						$con->email			=	$email;
						$con->owner			=	Yii::app()->user->id;
						$con->created		=	date('Y-m-d h:i:s');
						if($con->save()){
							$addedCons++;
						}
					}
					
					Yii::app()->user->setFlash('message',$addedCons.' contacts imported from Google');
				}
				else{
					Yii::app()->user->setFlash('message','No contacts found');
				}
			}
			else{
				Yii::app()->user->setFlash('message','No response found');
			}
		}
		else{
			Yii::app()->user->setFlash('message','Verification code not found');
		}
		$this->redirect('index');
	}
}
