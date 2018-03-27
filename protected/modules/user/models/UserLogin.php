<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserLogin extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
        public $verifyCode;
        
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
            if($this->hasCaptcha()){
				return array(
					// username and password are required
					array('username, password', 'required'),
					// rememberMe needs to be a boolean
					array('rememberMe', 'boolean'),
					array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
					// password needs to be authenticated
					array('password', 'authenticate'),
				);
			}else{
                                return array(
                                        // username and password are required
                                        array('username, password', 'required'),
                                        // rememberMe needs to be a boolean
                                        array('rememberMe', 'boolean'),
                                        // password needs to be authenticated
                                        array('password', 'authenticate'),
                                );
                        }
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>Yii::t('app',"Remember me next time"),
			'username'=>Yii::t('app',"username or email"),
			'password'=>Yii::t('app',"password"),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			 
			$identity=new UserIdentity($this->username,$this->password);
			$identity->authenticate();
                        
                        //check login settings, default - single step
                        $auth_status=1;
                        $var1 = Configurations::model()->findByAttributes(array('config_key'=>"Two Step Authentication"));
                        if($var1!=NULL)
                        {
                            $auth_status=$var1->config_value;
                        }
                        
                            if($identity->errorCode==0)
                            {
                               
                                switch($identity->errorCode)
                                 {
                                 case UserIdentity::ERROR_NONE:
                                         $duration=$this->rememberMe ? Yii::app()->controller->module->rememberMeTime : 0;
                                         ($auth_status==1)?Yii::app()->user->login($identity,$duration):"";
                                         break;
                                 case UserIdentity::ERROR_EMAIL_INVALID:
                                         $this->addError("username",Yii::t('app',"Email is incorrect."));
                                         break;
                                 case UserIdentity::ERROR_USERNAME_INVALID:
                                         $this->addError("username",Yii::t('app',"Username is incorrect."));
                                         break;
                                 case UserIdentity::ERROR_STATUS_NOTACTIV:
                                         $this->addError("status",Yii::t('app',"You account is not activated."));
                                         break;
                                 case UserIdentity::ERROR_STATUS_BAN:
                                         $this->addError("status",Yii::t('app',"You account is blocked."));
                                         break;
                                 case UserIdentity::ERROR_PASSWORD_INVALID:
                                         $this->addError("password",Yii::t('app',"Password is incorrect."));
                                         break;
                                 }
                            }
                            else
                            {
                                switch($identity->errorCode)
                                {
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? Yii::app()->controller->module->rememberMeTime : 0;
					//Yii::app()->user->login($identity,$duration);
                                        ($auth_status==1)?Yii::app()->user->login($identity,$duration):"";
					break;
				case UserIdentity::ERROR_EMAIL_INVALID:
					$this->addError("username",Yii::t('app',"Email is incorrect."));
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError("username",Yii::t('app',"Username is incorrect."));
					break;
				case UserIdentity::ERROR_STATUS_NOTACTIV:
					$this->addError("status",Yii::t('app',"You account is not activated."));
					break;
				case UserIdentity::ERROR_STATUS_BAN:
					$this->addError("status",Yii::t('app',"You account is blocked."));
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password",Yii::t('app',"Password is incorrect."));
					break;
                                }
                            }
		}
		
	}
        
        public function ClearIP(){
            
		$remote_addr	=	$_SERVER['REMOTE_ADDR'];
		$ipfilter		=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
		if(count($ipfilter)>0){
			$from_time 	= strtotime($ipfilter->created_at);
			$to_time 	= strtotime(date('Y-m-d H:i:s'));
			$diff 		= round(abs($to_time - $from_time)/(3600),2);
			if($diff>5){ // check the difference is 5 Hours
				$ipfilter->saveAttributes(array("mismatch_count"=>0,"is_blocked"=>0));
			}
		}
	}
	
	public function SaveIP(){
		$remote_addr	=	$_SERVER['REMOTE_ADDR'];
		if($remote_addr){
                    if(!$this->isBlocked())
                    {
			$ipfilter	=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
			if(count($ipfilter)==0){
				$ipfilter	=	new IpFilters;
				$ipfilter->mismatch_count =	1; 
			}else{
				$ipfilter->mismatch_count +=	1; 
			}
			$ipfilter->ip_address	=	$remote_addr;
			$ipfilter->created_at	=	date('Y-m-d H:i:s');
			$ipfilter->save();
                    }
		}
	}
	
	public function isBlocked(){
		$remote_addr	=	$_SERVER['REMOTE_ADDR'];
		if($remote_addr){
			$ipfilter	=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
			if(count($ipfilter)>0){
				if($ipfilter->mismatch_count>10){
					return true;
				}else{
					return false;
				}
			}
		}
		return false;
	}
	
	public function hasCaptcha(){
		$remote_addr	=	$_SERVER['REMOTE_ADDR'];
		if($remote_addr){
			$ipfilter	=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
			if(count($ipfilter)>0){
				if($ipfilter->mismatch_count>3){
					return true;
				}else{
					return false;
				}
			}
		}
		return false;
	}
}
