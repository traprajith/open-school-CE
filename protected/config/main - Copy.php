<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//require_once(dirname(__FILE__).'/environment.php');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'openschool',
	

	// preloading 'log' component
	
	'preload'=>array('log','translate'),
	
	'defaultController'=>'message/index',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'application.modules.translate.TranslateModule',
		'application.modules.user.models.*',//for user module
		'application.modules.students.controllers.*',
	),

	'modules'=>array('dashboard','mailbox',
		// uncomment the following to enable the Gii tool
		'translate'=>array(
            'class'=>'application.modules.translate.TranslateModule',
    ),
	'mailbox'=>
    array(  
    'userClass' => 'User',
    'userIdColumn' => 'id',
    'usernameColumn' =>  'username',
	'newsUserId' => 1,
        
      ),
   

	/*'user' => array(
			'debug' => true,
			'install'=>true,
			),*/

	 'students',
	 'employees',
	 'courses',
	 'library',
	 'examination',
	 'fees',
	 'attendance',
	 'timetable',
	 'hostel',
	 'transport',
	 
        
    //Modules Rights
   'rights'=>array(
			//'debug'=>true,
			//'install'=>true,
			//'cssFile'=>'style.css',
			//'enableBizRuleData'=>true,
				'superuserName'=>'Admin', // Name of the role with super user privileges. 
			   'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
			   'userIdColumn'=>'id', // Name of the user id column in the database. 
			   'userNameColumn'=>'username',  // Name of the user name column in the database. 
			   'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
			   'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
			   'displayDescription'=>true,  // Whether to use item description instead of name. 
			   'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
			   'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
			   //'install'=>true,  // Whether to install rights. 
			   'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
			   'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
			   'appLayout'=>'application.views.layouts.main', // Application layout. 
			   'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
			   'install'=>false,  // Whether to enable installer. 
			   'debug'=>false, 
		),
	 'message' => array(
	 			'class'=>'application.modules.messages.MessageModule',
                'userModel' => 'User',
                'getNameMethod' => 'getFullName',
                'getSuggestMethod' => 'getSuggest',
            ),
	 'cal'=>array('debug'=>true),
	 
		                                'gii'=>array(
											'class'=>'system.gii.GiiModule',
											'password'=>'1234567',
											// If removed, Gii defaults to localhost only. Edit carefully to taste.
											'ipFilters'=>array('127.0.0.1','::1','192.168.9.13'),
											
										),	
										'gii'=>array(
												'class'=>'system.gii.GiiModule',
												'password'=>'1',
												// If removed, Gii defaults to localhost only. Edit carefully to taste.
												'ipFilters'=>array('127.0.0.1','::1','192.168.9.13','*'),
															'generatorPaths' => array(
															'application.gii'  //Ajax Crud template path
												 ),
												 ),	
		
	),

	// application components
	'components'=>array(
	'db'=>(defined('DB_CONNECTION') ? array(
                    'connectionString'=>DB_CONNECTION,
                    'username'=>DB_USER,
                    'password'=>DB_PWD,
                    'charset'=>'utf8',
                    'emulatePrepare' => true,
                    'enableParamLogging'=>true,
					'initSQLs'=>array("set time_zone='+00:00';"), 
                ) : array()),
	'messages'=>array(
            'class'=>'CDbMessageSource',
            'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
        ),
	'translate'=>array(
            'class'=>'application.modules.translate.components.MPTranslate',
            //any avaliable options here
            'acceptedLanguages'=>array(
                'en_us'=>'English',
                'vi_vn'=>'Tiếng Việt'                                                                           
            ),
            
        ),
		'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf123'     => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
               
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
	// Pdf extension Ends
                 
	        //User Componenets
			'user'=>array(
			'class'=>'RWebUser',
			// enable cookie-based authentication
			//'application.modules.user.components.YumWebUser',//for user module
      'allowAutoLogin'=>true,
      //'loginUrl' => array('//user/user/login'),
			//'allowAutoLogin'=>true,
		),
	        
	        
            //Use Cache System by File
            'cache'=>array(
                'class'=>'system.caching.CFileCache',
            ),
		
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
/*		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=openschool',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),*/
		'authManager'=>array(
            'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
			'itemChildTable'=>'authitemchild',
			'assignmentTable'=>'authassignment',
			'rightsTable'=>'rights',
        ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'localtime'=>array(
        'class'=>'LocalTime',
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);