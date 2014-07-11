
<?php
/**
 * Works with javascript on/off
 * 
 * Displays properly on:
 *	FF 3+
 *	IE 6+
 *	Minefield 3+
 *	Flock 2+
 *	Seamonkey 2+
 *	Konqueror 3+ 
 *	Safari 4+
 *	Epiphany 2+
 *	Iceape 2+
 *	Iceweasal 3.5+
 */
class MailboxModule extends CWebModule
{
	/*
	 * set the database table names
	 */
	const TBL_CONV = 'mailbox_conversation';
	const TBL_MSG = 'mailbox_message';
	
	/**
	* @property string the name of the user model class.
	*/
	public $userClass = 'User';
	/**
	* @property string the name of the id column in the user table.
	*/
	public $userIdColumn ='id';
	/**
	* @property string the name of the username column in the user table.
	*/
	public $usernameColumn = 'username';
	/**
	* @property string the name of the column in your User model that defines whether user is an admin or not.
	*/
	public $superuserColumn = 'superuser';
	/**
	* @property string text to display if user not found.
	*/
	public $deletedUser = 'user deleted';
	/**
	* @property integer number of conversations to display per page.
	*/
	public $pageSize = 10;
	/**
	* @property mixed if you want to use an authManager (such as the Rights module) to control the access rules
	* then set to true or if your using the Rights module set to 'rights' in order to include the Rights filter.
	*/
	public $authManager = 'rights';
	/**
	 *
	 * @property boolean enable a read-only mailbox for users. Admins will still have fully functional mailbox. 
	 */
	public $readOnly = false;
	/**
	 *
	 * @property boolean whether to allow user's to message other users. Ie false means users can only contact admins 
	 */
	public $userToUser = true;
	/*
	 * The following properties do not have an affect if you are using an authManager such as Rights. In this case the authManager will control the access.
	 *	- sendMsgs
	 *	- sentbox
	 *	- trashbox
	 */
	
	/**
	* @property boolean whether or not to allow users to send messages.
	*/
	public $sendMsgs = true;
	/**
	* @property boolean whether or not to enable/disable sent folder for viewing sent messages.
	*/
	public $sentbox = true;
	/**
	* @property boolean whether or not to enable/disable trash folder for recycling deleted messages. 
	 * If trashbox is enabled then you must run the cron() method at least once daily, ideally each morning.
	*/
	public $trashbox = true;
	/**
	* @property integer number of days to keep deleted items in trash folder before being permanently deleted by the cron() method.
	*/
	public $recyclePeriod = 30;
	/**
	* @property boolean whether or not to enable/disable drag-n-drop deleting.
	*/
	public $dragDelete = true;
	/**
	* @property integer wether to ask the user for confirmation before deleting messages. Note that if trashbox is turned off, values of 1 and 2 have the same effect (since messages are always permanently).
	 *	0 - Never ask for user confirmation.
	 *	1 - Ask for user confirmation, but only when deleting permanently.
	 *	2 - Ask for user confirmation when moving messages to trash, and when deleting permanently (ie. deleting from trash).
	*/
	public $confirmDelete = 1;
	/**
	* @property boolean whether to allow users, when viewing the sent folder, to see if recipient has read the sent message.
	*/
	public $recipientRead = true;
	/**
	 * @property string|boolean set to custom css file location relative to base URL or set to false to skip css includes
	 */
	public $cssFile;
	/**
	 * @property string set to either 'left' or 'top' to position the mailbox menu. If readOnly set to true this is ignored for user and only applied for admins (since there is no menu in readOnly mode). 
	 */
	public $menuPosition = 'top';
	/**
	 * @property string|boolean custom left menu css
	 */
	public $cssFileColumn;
	/**
	 * @property string apply JUI widget styles. Can be one of the following: 
	 *	- 'none' Don't add any JUI themes
	 *	- 'basic' Adds themes to buttons and some elements but keeps the background/font color of the parent element. Ie. <body> or #content
	 *	- 'widget' Full JUI themes
	 */
	public $juiThemes='widget';
	/**
	 * @property boolean enable/disable the JUI themes for buttons. Eg. if you want to use Twitter Bootstrap buttons instead.
	 */
	public $juiButtons=true;
	/**
	 * @property boolean whether to add icons to menu buttons (only if juiButtons is enabled)
	 */
	public $juiIcons=true;
	/**
	 * @property string default subject to use when no subject is provided.
	 */
	public $defaultSubject = '(no subject)';
	/**
	 * @property string list or allowable characters to check Subject field against 
	 * using case-insensitive regular expression. Square brackets '[]', dashes '-', 
	 * single quotes, and slashes '/\' need to be escaped in order to be used literally.
	 */
	public $allowableCharsSubject = '0-9a-z.,!?@\s*$%#&;:+=_(){}\[\]\/\\-';
	/**
	 * The maximum chars to display in the subject line.
	 * @property integer 
	 */
	public $subjectMaxCharsDisplay = 100;
	/**
	 * If a row of text needs to be truncated, use this string as the ellipsis.
	 * @property string 
	 */
	public $ellipsis = '...';
	/**
	 * @property array HTML Purify options array used to purify HTML input from admins. 
	 * See http://htmlpurifier.org/live/configdoc/plain.html for list of options.
	 * Set to an empty string to strip all HTML tags from message input.
	*/
	public $adminHtml = array('HTML.Allowed'=>'a[href],b,strong,p,u,i,hr,br,img[src|alt|border]');
	/**
	 * @property array HTML Purify options array used to purify HTML input from non-admins. 
	 * See http://htmlpurifier.org/live/configdoc/plain.html for list of options. 
	 * Set to an empty string to strip all HTML tags from message input.
	*/
	public $html = array('HTML.Allowed'=>'a[href],b,strong,p,u,i,hr,br');
	/**
	* @property boolean whether to allow users to be able to enter user Id's instead of username when sending messages.
	*/
	public $allowLookupById = true;
	/**
	* @property boolean whether to allow users to be able to search list of usernames to contact when sending messages.
	*/
	public $allowUsernameSearch = true;
	/**
	* @property boolean whether to allow users to be able to edit the To field when sending messages.
	*/
	public $editToField = true;
	/**
	* @property boolean whether to create a drop down menu for the To field ( from array created by getUserSupportList() method). This attribute is always true for admins unless the getUserSupportList() method returns false.
	*/
	public $userSupportList = true;
	/**
	* @property boolean whether to create a link for the From field to user's profile etc (link created by getUrl() method). This attribute is always true for admins unless the getUrl() method returns false.
	*/
	public $linkUser = false;
	/**
	 * @property boolean whether to use checksums when storing messages. Checksums can be used not only for validating data but also to help implement certain spam protection.
	 * I.e. if a user copy and paste a message and sends it to multiple users you can easily find these messages by searching for other messages with the same checksum. 
	 */
	public $checksums = 1;
	/**
	 * TODO: not yet implemented. Please ignore.
	 * @property integer whether to validate the checksum when reading a message. If validation fails an error message will show. Set to 0 to ignore this feature, you can still use checksums for spam blocking.
	 *	0 - Do not validate (recommended)
	 *	1 - Only validate for admins
	 *	2 - Validate for all
	 */
	public $validateChecksum = 0;
	/**
	 * @property boolean whether to alternate the row colors when viewing message list (ie. inbox etc). 
	 */
	public $alternateRows = true;
	/**
	 * TODO: not yet implemented. Please ignore.
	 * @property boolean whether to highlight the message row on hover when viewing message list (ie. inbox etc). 
	 */
	public $highlightRows = false;
	/**
	 * @property boolean whether to highlight the message row on hover when viewing message list (ie. inbox etc). 
	 */
	public $newsUserId = 0;
	
	
	
	/**
	 * @property boolean set to true in order to skip all javascript includes (mostly for testing, may not be implemented in release version). 
	 */
	public $disableJS = false;
	/**
	* @property boolean whether to enable debug mode.
	*/
	public $debug = true;
	
	public $defaultController = 'message';
	private $_assetsUrl;
	private $_cs;
	private $_cssCoreUrl;
	private $_new;
	private $_userid;
	private $_username;
	private $_jsOptions;
	
	public function init()
	{
		// import the module-level models and components
		$this->setImport(array(
			'mailbox.models.*',
			'mailbox.components.*',
		));
		
		$this->registerScripts();
		
	}
	
	public function getUserId($username='')
	{
		if($username)
		{
			$r = call_user_func(array($this->userClass, 'model'))
				->findByAttributes(array($this->usernameColumn=>$username));
				
			if(!is_null($r)) return $r->{$this->userIdColumn};
		}
		else	
		{
			if(!$this->_userid)
				$this->_userid = Yii::app()->user->{$this->userIdColumn};
			return $this->_userid;
		}
	}
	
	public function getUserName($userid=0)
	{
		if($userid)
		{
			$r = call_user_func(array($this->userClass, 'model'))->findByPk($userid);
			if(!is_null($r)) return $r->{$this->usernameColumn}; return false;
			
		}
		if(!$this->_username) {
			$userid = Yii::app()->user->{$this->userIdColumn};
			$this->_username = call_user_func(array($this->userClass, 'model'))->findByPk($userid)->{$this->usernameColumn};
		}
		return $this->_username; 
	}
	
	public function getFromLabel($userid)
	{
		return $this->getUserName($userid);
	}
	
	public function getUrl($userid)
	{
		return Yii::app()->createUrl('user', array('user' => $userid));
	}
	
	public function isAdmin($userid=0)
	{
		if(Yii::app()->user->isGuest)
			return false;
		if(!$userid)
			$userid = $this->getUserId();
		
		return call_user_func(array($this->userClass, 'model'))->findByPk($userid)->{$this->superuserColumn};
		
		//return User::model()->findbyPk($userid)->superuser;
	}
	/**
	* Autocomplete function for 'To' field in view/compose. Search for usernames etc that match the string.
	*  
	* @param string $term
	* #return array output json array of usernames and labels.
	*/
	public function autoComplete($term)
	{
		$criteria = new CDbCriteria;

		$criteria->compare($this->usernameColumn, $term, true, 'OR');
		$criteria->compare($this->userIdColumn, $term, true, 'OR');
		//$criteria->compare('email', $term, true, 'OR');
		$criteria->mergeWith(array('limit'=>25));
		$users = call_user_func(array($this->userClass, 'model'))
			->findAll($criteria);
		//$users = User::model()->keyword($term)->limit(100)->findAll();
		$json = '[';
		foreach($users as $user)
		{
			if($user->{$this->userIdColumn}==$this->newsUserId)
				continue;
			
			$json .= '{"label":"'.$user->{$this->usernameColumn}.'",'
				.'"value":"'.$user->{$this->usernameColumn}.'"},';
		}
		$json = rtrim($json,',') . ']';
		die($json);
	}
	
	/**
	 * If the config var userSupport is enabled then the module will use this method to
	 * create a drop down list of contacts in the To field when the user is creating a 
	 * new message. This script should return an array, with keys set to the username 
	 * and the value set to the username's label (may be the same). If userToUser messaging 
	 * is enabled then this will create a drop down along with regular user input. If 
	 * userToUser is disabled then the users will only be able to select contacts from this list.
	 * 
	 * Tip: If using an authManager you could create a new role called "support" and use 
	 * this method to fetch an array of users who are assigned to the "support" role.
	 * 
	 * @return array array of admin usernames who provide customer support
	 */
	public function getUserSupportList()
	{
		$list = array('admin'=>'Site Administrator','support'=>'Customer Support','billing'=>'Billing Administrator' );
		
		// we add site news as an option for the admin to create news updates by messaging the news box...
 		if($this->isAdmin())
			$list[$this->getUserName($this->newsUserId)] = 'Site News';
		return $list;
	}
	
	public function getDate($time)
	{
		$timediff = time() - $time;
		if($timediff < 60 )
			$date = $timediff . ' sec ago';
		elseif($timediff < 3600 - 60) // within last hour
			$date = ceil($timediff / 60) . ' min ago';
		elseif($time > strtotime('today')) // today
			$date = date('h:i a',$time);
		elseif($time > strtotime(date('Y-1-01'))) // within this year
			$date = date('M j',$time);
		else
			$date = date('m/d/y',$time); // last year or more
		return $date;
	}
	
	
	/*
	 * 
	 *	YOU DO NOT NEED TO EDIT BELOW THESE LINES
	 * 
	 */
	
	
	/**
	* Registers the necessary scripts.
	*/
	public function registerScripts()
	{
		if($this->_assetsUrl)
			return $this->_assetsUrl;
		$this->_assetsUrl = $this->getAssetsUrl();
		$this->_cs = Yii::app()->getClientScript();
		//$this->_cs->registerScriptFile($this->_assetsUrl.'/js/prototype.js');
		$this->_cs->registerCoreScript($this->_assetsUrl.'/js/jquery.js');;
		$this->_cs->registerCoreScript('jquery.ui');
		$this->_cs->registerScriptFile($this->_assetsUrl.'/js/flash.js');
		$this->_cs->registerScriptFile($this->_assetsUrl.'/js/jquery.colors.js');
		
		if(!isset(Yii::app()->controller->module->id))
		{
		$this->_cs->registerScriptFile($this->_assetsUrl.'/js/menu.js',CClientScript::POS_END);
		}
		$this->_cs->registerScriptFile($this->_assetsUrl.'/js/jquery.qtip.min.js');
		$this->_cs->registerCssFile($this->_assetsUrl. '/css/jquery.qtip.min.css'); 
		$this->_cssCoreUrl = $this->_cs->getCoreScriptUrl();
		//$this->_cs->registerCssFile($this->_cssCoreUrl . '/jui/css/base/jquery-ui.css');
		//$cs->registerCssFile($assetsUrl.'/css/mailbox.css');
		
		if( $this->cssFile!==false )
		{
			// Default style sheet is used unless one is provided.
			if( $this->cssFile===null )
				$this->cssFile = $this->_assetsUrl.'/css/mailbox.css';
			else
				$this->cssFile = Yii::app()->request->baseUrl.$this->cssFile;
			
			if( $this->menuPosition == 'left' &$this->cssFileColumn===null  && !$this->readOnly)
				$this->cssFileColumn = $this->_assetsUrl.'/css/mailbox_column.css';
			elseif($this->menuPosition == 'left' && !$this->readOnly)
				$this->cssFileColumn = Yii::app()->request->baseUrl.$this->cssFileColumn;
			
			$this->_cs->registerCssFile($this->cssFile);
			if($this->cssFileColumn)
				$this->_cs->registerCssFile($this->cssFileColumn);
		
			if($this->juiThemes=='widget')
				$this->_cs->registerCssFile($this->_assetsUrl.'/css/mailbox_widget.css');
		}
		// NOTE: button styles do not only get set here. Please look in the mailbox.js as well.
		if( ($this->juiThemes=='basic' || $this->juiThemes=='widget') &$this->juiButtons)
		{
			$js = '$(".btn").button(); $(".btn-group").buttonset();';
		}
		$this->_cs->registerScript('mailbox-buttons',$js,CClientScript::POS_READY);
	}
	
	public function registerConfig($actionId)
	{
		if(isset($_GET['Message_sort']))
			$sortby = $_GET['Message_sort'];
		elseif(isset($_GET['Mailbox_sort']))
			$sortby = $_GET['Mailbox_sort'];
		else
			$sortby = '';
		// set module vars in javascript
		$js = <<<EOD
\$.yiimailbox = {
	trashbox:{$this->jsVar('trashbox')},
	dragDelete:{$this->jsVar('dragDelete')},
	confirmDelete:{$this->jsVar('confirmDelete')},
	menuPosition:{$this->jsVar('menuPosition')},
	juiThemes:{$this->jsVar('juiThemes')},
	juiButtons:{$this->jsVar('juiButtons')},
	juiIcons:{$this->jsVar('juiIcons')},
	alternateRows:{$this->jsVar('alternateRows')},
	highlightRows:{$this->jsVar('highlightRows')},
	sortBy:'{$sortby}',
	currentFolder:'{$actionId}'
};
EOD;
		
		$this->_cs->registerScript('mailbox-js',$js,CClientScript::POS_HEAD);
	}
	
	public function jsVar($var)
	{
		if(!isset($this->$var) || !$this->$var)
			return '0';
		if(is_int($this->$var))
			return $this->$var;
		if(is_bool($this->$var))
			return '1';
		return "'".$this->$var."'";
			
	}
	
	public function getOptions()
	{
		if($this->_jsOptions)
			return $this->_jsOptions;
		
		
		//// set module vars in javascript
		$this->_jsOptions = <<<EOD
{
	trashbox:{$this->jsVar('trashbox')},
	dragDelete:{$this->jsVar('dragDelete')},
	confirmDelete:{$this->jsVar('confirmDelete')},
	menuPosition:{$this->jsVar('menuPosition')},
	juiThemes:{$this->jsVar('juiThemes')},
	juiButtons:{$this->jsVar('juiButtons')},
	juiIcons:{$this->jsVar('juiIcons')},
	alternateRows:{$this->jsVar('alternateRows')},
	highlightRows:{$this->jsVar('highlightRows')}
}
EOD;
		return $this->_jsOptions;
	}

	/**
	* Publishes the module assets path.
	* @return string the base URL that contains all published asset files of Rights.
	*/
	public function getAssetsUrl()
	{
		if( $this->_assetsUrl===null )
		{
			$assetsPath = Yii::getPathOfAlias('mailbox.assets');

			// We need to republish the assets if debug mode is enabled.
			if( $this->debug===true )
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
			else
				$this->_assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
		}

		return $this->_assetsUrl;
	}
	
	public function getClientScript()
	{
		return $this->_cs;
	}

	public function beforeControllerAction($controller, $action)
	{
		if (Yii::app()->user->isGuest) {
			if($controller->getId()!='news')
			{
				if (Yii::app()->user->loginUrl) {
					$controller->redirect($controller->createUrl(reset(Yii::app()->user->loginUrl)));
				} else {
					$controller->redirect($controller->createUrl('/'));
				}
			}
			else
				return true;
		} else if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else {
			return false;
		}
	}

	public static function t($str='',$params=array(),$dic='message') {
		return Yii::t("MessageModule.".$dic, $str, $params);
	}
	
	
	public function getNewMsgs($userid=0)
	{
		if(!$userid)
			$userid = $this->getUserId();
		return Mailbox::newMsgs($userid);
		
		// Update message count only once every 30 seconds
		if(!$this->_new)
			$this->_new = Mailbox::newMsgs(Yii::app()->user->id);
		return $this->_new;
		
		
		// Update message count only once every 30 seconds
		if(!$_SESSION['Mailbox']['new'] || $_SESSION['Mailbox']['timestamp'] < (time() + 30) )
		{
			$_SESSION['Mailbox']['new'] = Mailbox::newMsgs($userid);
			$_SESSION['Mailbox']['timestamp'] = time();
		}
		return $_SESSION['Mailbox']['new'];
	}
	
	public function cron()
	{
		$deleted_convs = Mailbox::model()->deleted()->findAll();
		
		foreach($deleted_convs as $conv)
		{
			$conv->recycle();
		}
	}
}
