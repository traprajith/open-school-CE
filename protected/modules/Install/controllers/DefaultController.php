<?php

class DefaultController extends CController
{
    public function init() {
        parent::init();
        Yii::app()->Theme = 'Installer';
        Yii::app()->layout = 'main';
	}
	
	
    
    /**
    * Show welcome page
    */
    public function actionIndex() { 
		
        Yii::app()->layout = null;
		Yii::app()->session->remove('key');
		
		if(isset($_POST['email']) && !isset($_POST['serial'])){
            
            $key_info['email']      = $_POST['email'];
            $key_info['fname']      = $_POST['fname'];
            $key_info['lname']      = $_POST['lname'];
            $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();

            // this is the url where you have your server script
                  
              $serverurl = "http://licence-server.open-school.org/community.php";
              
              // start a curl session
              $ch = curl_init ($serverurl);
              
              // return the output, don't print it
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
              
              // set curl to send post data
              curl_setopt ($ch, CURLOPT_POST, true);
              
              // set the post data to be sent
              curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
              
              // get the server response
              $result = curl_exec ($ch);
              

            $this->render('welcome');
        }

		if(isset($_POST['serial'])){
	
				  $key_info['key'] = $_POST['serial'];
				  //$key_info['key'] = '0123-4567-8901-2345';
				  
				  // the match key we are using here is the clients
				  // email, this would be saved when they 
				  // purchase the script/program from your website
				  $key_info['email'] = $_POST['email'];
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  
				  
				  // this is the url where you have your server script
				  
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  
				  // start a curl session
				  $ch = curl_init ($serverurl);
				  
				  // return the output, don't print it
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  
				  // set curl to send post data
				  curl_setopt ($ch, CURLOPT_POST, true);
				  
				  // set the post data to be sent
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  
				  // get the server response
				  $result = curl_exec ($ch);
				  
				  //echo $result;exit;
				  
				  // convert the json to an array
				  $result = json_decode($result, true);
				  
				  //echo $result['valid'];exit;
				  // check if the key was valid
				  if($result['valid'] == 'true'){
					  Yii::app()->session['key'] = $_POST['serial'];
                      Yii::app()->session['email'] = $_POST['email'];
					  $this->redirect(array('step1'));
					  //echo 'Valid Key';
					  // do nothing and let the script to continue running
					  
				  }
				  else {
					  
					  // key is not valid so stop it
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  //exit;
					  $this->redirect(array('index'));
					  
				  }
				  }
		
		
        $this->render('welcome');
    }

    /**
    * Step 1
    *  - Check writable folders
    *  - Show copyright notice
    *
    * @return void
    */
    public function actionStep1() {
		
			   if(isset(Yii::app()->session['key']) and isset(Yii::app()->session['email']))
			   {
				   
	
				  $key_info['key'] = Yii::app()->session['key'];
				  Yii::app()->session->remove('key');//Remove
				  $key_info['email'] = Yii::app()->session['email'];
				  Yii::app()->session->remove('email');//Remove
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  $ch = curl_init ($serverurl);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  curl_setopt ($ch, CURLOPT_POST, true);
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  $result = curl_exec ($ch);
				  $result = json_decode($result, true);
					if($result['valid'] == 'true')
					{
					  Yii::app()->session['key'] = $key_info['key'];
                      Yii::app()->session['email'] = $key_info['email'];
					  $folders = $this->getFoldersWritable();
					  $writables = array();
					  clearstatcache();
					  foreach($folders as $path) {
						  if (is_writable($path) === true)
							  $writables[] = true;
						   else
							  $writables[] = false;
					  }
					  if (count($folders) === count($writables)) {
						  $folders = array_combine($folders, $folders);
					  }
					  
					  $this->render('step1', array('folders'=>$folders));
					  
				  }
				  else {
					  
					  // key is not valid so stop it
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
				  }
				  else {
					  
					  // key is not valid so stop it
					  //die("Invalid Key!");
					  //echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
		
		
		
        
    }
    
    protected function getFoldersWritable() {
        return array(
            Yii::getPathOfAlias('webroot.assets'),
            Yii::getPathOfAlias('webroot.uploadedfiles'),
            Yii::getPathOfAlias('application.runtime'),
            Yii::getPathOfAlias('application.runtime.cached'),
        );
    }

    /**
    * input and check if database connection is valid
    * create ./protected/config/environment.php file
    *
    * @return void
    */
    public function actionStep2() {
        Yii::app()->session->remove('env');
        $model=new ConfigForm();
        if(isset($_POST['ConfigForm']) === true) {
            $model->attributes=$_POST['ConfigForm'];
            $model->password=$_POST['ConfigForm']['password'];
            if($model->validate() === true) {
				if($model->checkConnection() !== true) {
					//Attemting To Create The Database
					$conn = new mysqli($model->host, $model->username, $model->password);
					$sql = "CREATE DATABASE $model->dbName";
					if ($conn->query($sql) === TRUE) {
						$flag_db_created = 1;
					} else {
						$flag_db_created = 0;
					}
				}
                if($model->checkConnection() === true) {
                    //create enviroment file
                    $configPath = Yii::getPathOfAlias('application.config');
                    $envSampleFile = $configPath.DIRECTORY_SEPARATOR.'environment-sample.php';
                    if (file_exists($envSampleFile) === false) {
                        throw new CHttpException(500, 'File not found "'.$envSampleFile.'"');
                    }

                    $content = file_get_contents($envSampleFile);
                    $searches = array('@base_url@', '@host@', '@port@', '@dbname@', '@username@', '@password@');
                    $replaces = array($model->baseUrl, $model->host, $model->port, $model->dbName, $model->username, $model->password);
                    $content = str_replace($searches, $replaces, $content);
                    if (is_writable($configPath) === true || is_writable($configPath.'/environment.php') === true) {
                        file_put_contents($configPath.'/environment.php', $content);
                    } else {
                        Yii::app()->session['env'] = $content;
                    }
                    $this->redirect(array('default/step3'));
                } else {
                    $this->render('Step2ErrorDb');
                }
            }
        }
		
		//Check
		
		if(isset(Yii::app()->session['key']) and isset(Yii::app()->session['email']))
			   {
	
				  $key_info['key'] = Yii::app()->session['key'];
				  Yii::app()->session->remove('key');//Remove
				  $key_info['email'] = Yii::app()->session['email'];
				  Yii::app()->session->remove('email');//Remove
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  $ch = curl_init ($serverurl);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  curl_setopt ($ch, CURLOPT_POST, true);
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  $result = curl_exec ($ch);
				  $result = json_decode($result, true);
					if($result['valid'] == 'true')
					{
					  Yii::app()->session['key'] = $key_info['key'];
                      Yii::app()->session['email'] = $key_info['email'];
					  $this->render('step2', array('model'=>$model));
					  
				  }
				  else {
					  //session contains invalid key
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
				  }
				  else {
					  //session expired or direct link 
					  $this->redirect(array('index'));
					  
				  }
		
        
    }

    /**
    * build database structures,
    * optional: insert data example
    *
    * @return void
    */
    public function actionStep3() {
		$canConnect = false;
        $configPath = Yii::getPathOfAlias('application.config');
        $envFile = $configPath.DIRECTORY_SEPARATOR.'environment.php';
        if (file_exists($envFile) === true) {
            Yii::app()->session->remove('config');
            include_once $envFile;
            $connection=new CDbConnection(DB_CONNECTION, DB_USER, DB_PWD);
            $connection->charset='utf8';
            $connection->active=true;
            $canConnect = true;
        }

        if (isset($_POST['install']) === true) {
			
            if (is_object($connection) === true) {				
				
                //create db schema
                $sql = $this->getSql($this->module->structuresPath);
                $sqlArr =  $this->splitQueries($sql);
                foreach ($sqlArr as $script) {
                    if (preg_match('/(CREATE\s+TABLE|DROP\s+TABLE|ALTER\s+TABLE|CREATE\s+VIEW|DROP\s+VIEW)/i', $script))
                        $result = $connection->createCommand($script)->execute();
                }
               
                //insert example data
                $dataPath = $this->module->dataPath;
                if (isset($_POST['example']) === true) {
                    $dataPath .= '_full';
                }
                $sql = $this->getSql($dataPath);
                $sqlDataArr =  $this->splitQueries($sql);
                $db = $this->getDbConnection();
                while (count($sqlDataArr)) {
                    $remove = array();
                    foreach ($sqlDataArr as $index => $script) {
                        if (preg_match('/insert\s+into/i', $script)) {
//                            Yii::trace('$script:'.$script);
                            if (mysqli_query($db,$script) === true) {
                                $remove[] = $index;
                            }
                        } else {
                            $remove[] = $index;
                        }
                    }
                    foreach ($remove as $i) unset($sqlDataArr[$i]);
                }
				
				$this->initDbConnection();
				
				// change this for new user module !!!

				
                $user = User::model()->findByPk(1);
				$salt= User::model()->getSalt();  
                $password = substr(md5(uniqid(mt_rand(), true)), 0, 10);        
                $user->password=Yii::app()->controller->module->encrypting($salt.$password);
                $user->salt= $salt;
				
                if ($user->save() === true) {
                    Yii::app()->session['aemail'] = 'admin';
                    Yii::app()->session['password'] = $password;
                    $this->redirect(array('step4'));
                }
                
            }
        }
		
		
		//Check
		
		if(isset(Yii::app()->session['key']) and isset(Yii::app()->session['email']))
			   {
	
				  $key_info['key'] = Yii::app()->session['key'];
				  Yii::app()->session->remove('key');//Remove
				  $key_info['email'] = Yii::app()->session['email'];
				  Yii::app()->session->remove('email');//Remove
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  $ch = curl_init ($serverurl);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  curl_setopt ($ch, CURLOPT_POST, true);
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  $result = curl_exec ($ch);
				  $result = json_decode($result, true);
					if($result['valid'] == 'true')
					{
					  Yii::app()->session['key'] = $key_info['key'];
                      Yii::app()->session['email'] = $key_info['email'];
					  $this->render('step3', array('canConnect' => $canConnect));
					  
				  }
				  else {
					  //session contains invalid key
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
				  }
				  else {
					  //session expired or direct link 
					  $this->redirect(array('index'));
					  
				  }
		}
    
    /**
    * split queries for execute
    * 
    * @param string $sql
    * @return string
    */
    protected function splitQueries($sql)
    {
        // Initialise variables.
        $buffer        = array();
        $queries    = array();
        $in_string    = false;

        // Trim any whitespace.
        $sql = trim($sql);

        // Remove comment lines.
        $sql = preg_replace("/\n\#[^\n]*/", '', "\n".$sql);

        // Parse the schema file to break up queries.
        for ($i = 0; $i < strlen($sql) - 1; $i ++)
        {
            if ($sql[$i] == ";" && !$in_string) {
                $queries[] = substr($sql, 0, $i);
                $sql = substr($sql, $i +1);
                $i = 0;
            }

            if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
                $in_string = false;
            }
            elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\")) {
                $in_string = $sql[$i];
            }
            if (isset ($buffer[1])) {
                $buffer[0] = $buffer[1];
            }
            $buffer[1] = $sql[$i];
        }

        // If there is anything left over, add it to the queries.
        if (!empty($sql)) {
            $queries[] = $sql;
        }

        return $queries;
    }
    
    protected function getDbConnection() {
        list(,$str) = explode(':', DB_CONNECTION);
        //export to $host,$port,$dbname
        $dbinfo = explode(';', $str);
        foreach($dbinfo as $info)
            parse_str($info);
        $db=mysqli_connect($host,DB_USER,DB_PWD,$dbname,$port);
        return $db;
    }

    /**
    * get schema file
    *
    * @param string $file schema filename
    *
    * @return string
    */
    protected function getSql($path){
        if (strpos('/',$path) === false)
            $filePath = Yii::getPathOfAlias($path).'.sql';
        else
            $filePath = $path;
        if (file_exists($filePath) === false) {
            throw new Exception("File not found '{$filePath}.");
        }

        //mb_internal_encoding('UTF-8');
        $sql = @file_get_contents($filePath);
        //remove comment
        $sql = preg_replace('/\/\*.*?\*\/;/', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//', '', $sql);
        return $sql;
    }

    /**
    * finish install applcation
    * redirect user to admin panel or home site.
    *
    * @return void
    */
    public function actionStep44() {
        Yii::setPathOfAlias('Cms', Yii::getPathOfAlias('application.modules.Cms'));
        Yii::setPathOfAlias('User', Yii::getPathOfAlias('application.modules.User'));
        $model = new SettingInfoForm();
        if (isset($_POST['SettingInfoForm']) === true) {
            $model->attributes=$_POST['SettingInfoForm'];
            if($model->validate() === true)
            {
                Yii::import('application.modules.Cms.models.Setting');
                
                $this->initDbConnection();
                //Site name
                $siteNameSetting = Setting::model()->find('Name=:Name', array(':Name'=>'SITE_NAME'));
                if (is_null($siteNameSetting))
                {
                    $siteNameSetting = new Setting();
                    $siteNameSetting->Module = '';
                    $siteNameSetting->Name = 'SITE_NAME';
                    $siteNameSetting->Label = 'Site name';
                    $siteNameSetting->Description = "Site name, displayed on browser's title and used for SEO";
                    $siteNameSetting->GroupName = '1. General settings';
                    $siteNameSetting->Ordering = 4;
                }
                $siteNameSetting->Value = $model->siteName;
                $siteNameSetting->save();
                
                //Site secret key
                $siteSecretKey = Setting::model()->find('Name=:Name', array(':Name'=>'SITE_SECRET_KEY'));
                if (is_null($siteSecretKey))
                {
                    $siteSecretKey = new Setting();
                    $siteSecretKey->Module = '';
                    $siteSecretKey->Name = 'SITE_SECRET_KEY';
                    $siteSecretKey->Label = 'Site secret key';
                    $siteSecretKey->Description = "Site secret key";
                    $siteSecretKey->GroupName = '1. General settings';
                    $siteSecretKey->Module = '';
                }
                $siteSecretKey->Value = md5(uniqid(mt_rand(), true));
                $siteSecretKey->save();

                //param ADMIN_EMAIL
                $emailSetting = Setting::model()->find('Name=:Name', array(':Name'=>'ADMIN_EMAIL'));
                if (is_null($emailSetting))
                {
                    $emailSetting = new Setting();
                    $emailSetting->Module = '';
                    $emailSetting->Name = 'ADMIN_EMAIL';
                    $emailSetting->Label = "Administrator's email";
                    $emailSetting->Description = 'Administrator email';
                    $emailSetting->GroupName = '1. General settings';
                    $emailSetting->Ordering = 5;
                }
                $emailSetting->Value = $model->adminEmail;
                $emailSetting->save();
                
                //Administrator account                
                Yii::import('application.modules.User.models.User');
                $user = User::model()->findByPk(1);
                $user->setScenario('init');
                $user->Username = 'admin';
                $user->Email = $model->adminEmail;
                $salt= User::model()->getSalt();  
                $password = substr(md5(uniqid(mt_rand(), true)), 0, 10);        
                $user->password=Yii::app()->controller->module->encrypting($salt.$password);
                $user->salt= $salt;
                $user->ValidationType = 1;
                $user->ValidationExpired = 1;
                $user->Status = User::STATUS_MEMBER;
                $user->FirstName = 'Site';
                $user->LastName = 'Administrator';
                if ($user->save() === true) {
                    Yii::app()->session['aemail'] = $user->Email;
                    Yii::app()->session['password'] = $password;
                    $this->redirect(array('step5'));
                }
            }
        }
        $this->render('step44', array('model' => $model));
    }

    /**
    * finish install applcation
    * redirect user to admin panel or home site.
    *
    * @return void
    */
    public function actionStep4() {
        //redirect previous step
        if (Yii::app()->session->contains('aemail') === false && Yii::app()->session->contains('password') === false)
            $this->redirect(array('step3'));
        
        
        
        $model = new RegisterForm;
        if (isset($_POST['RegisterForm'])) {
            $model->attributes = $_POST['RegisterForm'];
            if ($model->validate() === true) {
                //post to www.open-school.org/register
                // create a new cURL resource
                $ch = curl_init();
                $data = http_build_query(CMap::mergeArray($model->attributes, array('ip'=>gethostbyname($_SERVER['SERVER_NAME']),'domain'=>Yii::app()->request->hostInfo.Yii::app()->request->baseUrl,'key'=>Yii::app()->session['key'])), null, '&');
				 // set URL and other appropriate options
                $options = array(
				    CURLOPT_URL => 'http://licence-server.open-school.org/community.register.php',
                    CURLOPT_HEADER => false,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $data,
                    CURLOPT_RETURNTRANSFER => true,
                );
				
                curl_setopt_array($ch, $options);
                $content = curl_exec($ch);
                $content=trim($content,'()');
                $result = CJSON::decode($content, true);
                curl_close($ch);
                
//                if (is_array($result) && isset($result['ReturnedData']) && $result['ReturnedData'] === 'OK') {
                    //create Settings.php
					
					
					
                    /*Yii::setPathOfAlias('Cms', Yii::getPathOfAlias('application.modules.Cms'));
                    Yii::setPathOfAlias('User', Yii::getPathOfAlias('application.modules.User'));
                    Yii::setPathOfAlias('Category', Yii::getPathOfAlias('application.modules.Category'));
                    Yii::setPathOfAlias('Page', Yii::getPathOfAlias('application.modules.Page'));
                    Yii::setPathOfAlias('News', Yii::getPathOfAlias('application.modules.News'));
                    Yii::setPathOfAlias('Statistics', Yii::getPathOfAlias('application.modules.Statistics'));
                    Yii::setPathOfAlias('Messaging', Yii::getPathOfAlias('application.modules.Messaging'));
                    Yii::setPathOfAlias('Support', Yii::getPathOfAlias('application.modules.Support'));
                    
                    $this->initDbConnection();
                    //Generate module settings

                    //Modify this array for modules in this package
                    $modules = array('Cms','User','News','Statistics','Messaging','Support','Gallery','Statistics');

                    foreach($modules as $module)
                        //SettingsService::db2php(array('Module' => $module));
                        Cms::rawService('Cms/Settings/db2php', array('Module' => $module));

                    //Cache pages and categories
                    Cms::rawService('Cms/Page/cache',array());
                    Cms::rawService('Cms/Category/cache',array());

                    //Permission
                    Cms::rawService('Cms/Permission/createAuthItems',array('cleanup' => 1));*/
                    
					
                    
                    //update .htaccess
					$this->redirect(array('step5'));
                    
//                }
            }
        }
		
		
		
		//Check
		
		if(isset(Yii::app()->session['key']) and isset(Yii::app()->session['email']))
			   {
	
				  $key_info['key'] = Yii::app()->session['key'];
				  Yii::app()->session->remove('key');//Remove
				  $key_info['email'] = Yii::app()->session['email'];
				  Yii::app()->session->remove('email');//Remove
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  $ch = curl_init ($serverurl);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  curl_setopt ($ch, CURLOPT_POST, true);
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  $result = curl_exec ($ch);
				  $result = json_decode($result, true);
					if($result['valid'] == 'true')
					{
					  Yii::app()->session['key'] = $key_info['key'];
                      Yii::app()->session['email'] = $key_info['email'];
					  $this->render('step5', array('model'=>$model));
					  
				  }
				  else {
					  //session contains invalid key
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
				  }
				  else {
					  //session expired or direct link 
					  $this->redirect(array('index'));
					  
				  }
		
        
    }

    /**
    * send environment.php file
    *
    * @return void
    */
	
	 public function actionStep5() 
	 {
                    $updateHtaccess = false;
					$htaccessUpdated  = false;
                    $htaccessPath = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.'.htaccess';
                    if (file_exists($htaccessPath) === true && is_writable($htaccessPath) === true) {
                        if (@file_put_contents($htaccessPath, $this->getHtaccessContent()))
                            $htaccessUpdated = true;
                    }
					
					//Check
		
		if(isset(Yii::app()->session['key']) and isset(Yii::app()->session['email']))
			   {
	
				  $key_info['key'] = Yii::app()->session['key'];
				  Yii::app()->session->remove('key');//Remove
				  $key_info['email'] = Yii::app()->session['email'];
				  Yii::app()->session->remove('email');//Remove
				  $key_info['reg_domain'] = Yii::app()->controller->module->getRegdomain();
				  $serverurl = "http://licence-server.open-school.org/community.server.php";
				  $ch = curl_init ($serverurl);
				  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  curl_setopt ($ch, CURLOPT_POST, true);
				  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
				  $result = curl_exec ($ch);
				  $result = json_decode($result, true);
					if($result['valid'] == 'true')
					{
					  $key_info['deactivate'] = 1;
					  $serverurl = "http://licence-server.open-school.org/community.server.php";
					  $ch = curl_init ($serverurl);
					  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
					  curl_setopt ($ch, CURLOPT_POST, true);
					  curl_setopt ($ch, CURLOPT_POSTFIELDS, $key_info);
					  $result = curl_exec ($ch);
					  $this->render('Finish', array('htaccessUpdated'=>$htaccessUpdated));
                      Yii::app()->session->remove('email');
                      Yii::app()->session->remove('password');
                      Yii::app()->end();
					  
				  }
				  else {
					  //session contains invalid key
					  //die("Invalid Key!");
					  echo 'Invalid Key';
					  $this->redirect(array('index'));
					  
				  }
				  }
				  else {
					  //session expired or direct link 
					  $this->redirect(array('index'));
					  
				  }
					
					
					
                    
    }
    public function actionDownloadEnvironment() {
        if (Yii::app()->session->contains('env') === true) {
            $fileName = 'environment.php';
            $content = Yii::app()->session['env'];
            $mimeType = 'txt/php';
            Yii::app()->request->sendFile($fileName, $content, $mimeType);
        } else {
            throw new CHttpException(404,'File not found. Your session might be expired, please try again.');
        }
    }

    /**
    * send .htaccess file
    *
    * @return void
    */
    public function actionHtaccess() {
        $content = $this->getHtaccessContent();
        if (empty($content) === false) {
            Yii::app()->request->sendFile('.htaccess', $content, 'txt/text');
        } else
            throw new CHttpException(404);
    }
    
    protected function getHtaccessContent() {
        $configPath = Yii::getPathOfAlias('application.config');
        $content = '';
        $htaccess = $configPath.DIRECTORY_SEPARATOR.'htaccess';
        if (file_exists($htaccess) === true) {
            $base = parse_url(Yii::app()->getBaseUrl(true), PHP_URL_PATH);
            $base = '/'.ltrim($base, '/');
            $content = file_get_contents($htaccess);
            $content = str_replace('@base@' , $base, $content);
        }
        return $content;
    }
    
    protected function initDbConnection() {
        include_once Yii::getPathOfAlias('application.config').DIRECTORY_SEPARATOR.'environment.php';
        $db = Yii::createComponent(array(
            'class'=>'CDbConnection',
            'connectionString'=>DB_CONNECTION,
            'username'=>DB_USER,
            'password'=>DB_PWD,
            'charset'=>'utf8',
            'emulatePrepare' => true,
            'enableParamLogging'=>true,
        ));
        Yii::app()->setComponent('db', $db);
    }
}