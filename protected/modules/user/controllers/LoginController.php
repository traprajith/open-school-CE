<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
	public $layout='//layouts/login';
        
        public function actions()
        {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }
        
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		
            $remote_addr	=	$_SERVER['REMOTE_ADDR'];
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
                        $model->ClearIP();
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				
				// validate user input and redirect to previous page if valid
				if($model->validate()) 
                                {   
								
                                    //check login settings, default - single step
                                    $auth_status=1;
                                    $var1 = Configurations::model()->findByAttributes(array('id'=>42));
                                    if($var1!=NULL)
                                    {
                                        $auth_status=$var1->config_value;
                                    }
                                    if($auth_status==2)
                                    {
                                        $username= $model->username;
                                        $usr_model= User::model()->findByAttributes(array('username'=>$username));
                                        if($usr_model)
                                        {
											
											
                                            $user_id= $usr_model->id;
                                            $mobile_number= $usr_model->mobile_number;
                                            $otp_model= new UserOtpDetails;                                              
                                            $otp_model->otp= rand(100000, 999999);;
                                            $otp_model->key= User::model()->getSalt();
                                            $otp_model->created_at= date("Y-m-d H:i:s");
                                            $otp_model->status=0;
                                            $otp_model->user_id= $user_id;
                                            $otp_model->save();
                                            
                                                $notification = NotificationSettings::model()->findByAttributes(array('id'=>20));
						$college=Configurations::model()->findByPk(1);
						$to = '';
						if($notification->sms_enabled=='1') // Checking if SMS is enabled.
						{
							$to= $mobile_number;
							if($to!=''){ // Send SMS if phone number is provided									
								$from = $college->config_value;
								$template=SystemTemplates::model()->findByPk(36);
								$message = $template->template;
								$message = str_replace("<Login OTP>",$otp_model->otp,$message);																
								SmsSettings::model()->sendSms($to,$from,$message);								
							} // End send SMS
						} // End check if SMS is enabled
                                                
                                                if($notification->mail_enabled == '1')
						{								
							$template=EmailTemplates::model()->findByPk(27);
							$subject = $template->subject;
							$message = $template->template;													
							$message = str_replace("{{OTP}}",$otp_model->otp,$message);														
							UserModule::sendMail($usr_model->email,$subject,$message);
						}
                                        }
                                        $this->redirect(array('otp','key'=>$otp_model->key));
                                    }
                                    else
                                    {
                                    
					$this->lastVisit();
                                        $ipfilter	=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
					if(count($ipfilter)>0){
						$ipfilter->saveAttributes(array("mismatch_count"=>0,"is_blocked"=>0));
					}
					//Yii::import('application.controllers.ActivityFeedController');
					//SmsSettings::model()->sendSms($to,$from,$message); To call an action written on a controller
					//Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
					ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'1',NULL,NULL,NULL,NULL,NULL); 
					$roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
					       foreach($roles as $role)
						   if(sizeof($roles)==1 and $role->name == 'parent')
						   {
							   $this->redirect(array('/parentportal/default/dashboard'));
							   
						   }
						   if(sizeof($roles)==1 and $role->name == 'student')
						   {
							   $this->redirect(array('/studentportal/default/dashboard'));
							   
						   }
						   if(sizeof($roles)==1 and $role->name == 'teacher')
						   {
							   $this->redirect(array('/teachersportal/default/dashboard'));
							   
						   } 
						 if(Yii::app()->user->checkAccess('admin'))
						 {	
							 if (Yii::app()->user->returnUrl=='/index.php')
								$this->redirect(Yii::app()->controller->module->returnUrl);
							else
								$this->redirect(Yii::app()->user->returnUrl);
						 }
						 else
					     {
							 $this->redirect(array('/dashboard'));
						 }
                                    
                                                 
                                    }    
                                                 
				}
                                else
                                {
                                    $model->SaveIP();
                                }
			}
                        
                        if(!$model->isBlocked())
                        {
                            // display the login form
                            $this->render('/user/login',array('model'=>$model));
                        }
                        else
                        {
                            $this->render("/user/block",array('model'=>$model));
                        }
			// display the login form
			//$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastVisit() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}
        
        
        public function actionOtp()
        {
            $flag=0;                                   
            $remote_addr	=	$_SERVER['REMOTE_ADDR'];
            $model=new OtpForm;                    
            if(isset($_POST['OtpForm']))
            {               
                $model->otp= $_POST['OtpForm']['otp'];
                if($model->validate())
                {      
                    $flag=1;
                    $usr_model= UserOtpDetails::model()->findByAttributes(array('key'=>$_REQUEST['key']));
                    if($usr_model!=NULL)
                    {
                        $user_id= $usr_model->user_id;
                        $u_model= User::model()->findByPk($user_id);                        
                        $user_name= $u_model->username;
                    }
                                        
                    $duration=Yii::app()->controller->module->rememberMeTime;
                    $identity=new UserIdentity($user_name);
                    $identity->otp_authenticate();                   
                    Yii::app()->user->login($identity,$duration);
                    
                    
                    
                    
                    $this->lastVisit();
                    $ipfilter	=	IpFilters::model()->findByAttributes(array("ip_address"=>$remote_addr));
                    if(count($ipfilter)>0){
                            $ipfilter->saveAttributes(array("mismatch_count"=>0,"is_blocked"=>0));
                    }
                    //Yii::import('application.controllers.ActivityFeedController');
                    //SmsSettings::model()->sendSms($to,$from,$message); To call an action written on a controller
                    //Adding activity to feed via saveFeed($initiator_id,$activity_type,$goal_id,$goal_name,$field_name,$initial_field_value,$new_field_value)
                    ActivityFeed::model()->saveFeed(Yii::app()->user->Id,'1',NULL,NULL,NULL,NULL,NULL); 
                    $roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role
                           foreach($roles as $role)
                               if(sizeof($roles)==1 and $role->name == 'parent')
                               {
                                       $this->redirect(array('/parentportal/default/dashboard'));

                               }
                               if(sizeof($roles)==1 and $role->name == 'student')
                               {
                                       $this->redirect(array('/studentportal/default/dashboard'));

                               }
                               if(sizeof($roles)==1 and $role->name == 'teacher')
                               {
                                       $this->redirect(array('/teachersportal/default/dashboard'));

                               } 
                             if(Yii::app()->user->checkAccess('admin'))
                             {	
                                     if (Yii::app()->user->returnUrl=='/index.php')
                                            $this->redirect(Yii::app()->controller->module->returnUrl);
                                    else
                                            $this->redirect(Yii::app()->user->returnUrl);
                             }
                             else
                            {
                                     $this->redirect(array('/dashboard'));
                             }
                }                                  
                
            }
            
            //for redirect to login, in page refresh
            if(isset($_POST['uniqid']))
            {
                if(isset($_POST['uniqid']) AND $_POST['uniqid'] == $_SESSION['uniqid'])
                {
                    $flag=1;
                }
                else
                {                    
                    $_SESSION['uniqid'] = $_POST['uniqid'];
                }
                
            }
            else
            {
                $flag=1;
            }
            if(isset($_REQUEST['key']) && $_REQUEST['key']!=NULL)
            {
                $usr_model= UserOtpDetails::model()->findByAttributes(array('key'=>$_REQUEST['key']));
                if($usr_model!=NULL && $usr_model->status==1 && $flag==1)
                {
                    $this->redirect(array('/user/login'));
                } 
                else if($usr_model!=NULL)
                {
                    $usr_model->status=1;
                    $usr_model->save();
                }
            }
            
             $this->render('/user/otp',array('model'=>$model));
        }
        
        public function actionResendotp()
        {
            if(Yii::app()->request->isPostRequest)
            {
                $key= $_POST['key'];
                $usr_model= UserOtpDetails::model()->findByAttributes(array('key'=>$key));
                if($usr_model)
                {
                    $user_id= $usr_model->user_id;  
                    $u_model= User::model()->findByPk($user_id);     
                    $otp_model= new UserOtpDetails;  
                    $mobile_number= $u_model->mobile_number;
                    $otp_model->otp= rand(100000, 999999);;
                    $otp_model->key= User::model()->getSalt();
                    $otp_model->created_at= date("Y-m-d H:i:s");
                    $otp_model->user_id= $user_id;
                    $otp_model->status=0;
                    if($otp_model->save())
                    {
                        $notification = NotificationSettings::model()->findByAttributes(array('id'=>20));
                        $college=Configurations::model()->findByPk(1);
                        $to = '';
                        if($notification->sms_enabled=='1') // Checking if SMS is enabled.
                        {
                                $to= $mobile_number;
                                if($to!=''){ // Send SMS if phone number is provided									
                                        $from = $college->config_value;
                                        $template=SystemTemplates::model()->findByPk(36);
                                        $message = $template->template;
                                        $message = str_replace("<Login OTP>",$otp_model->otp,$message);																
                                        SmsSettings::model()->sendSms($to,$from,$message);								
                                } // End send SMS
                        } // End check if SMS is enabled

                        if($notification->mail_enabled == '1')
                        {								
                                $template=EmailTemplates::model()->findByPk(27);
                                $subject = $template->subject;
                                $message = $template->template;													
                                $message = str_replace("{{OTP}}",$otp_model->otp,$message);														
                                UserModule::sendMail($u_model->email,$subject,$message);
                        }
                        
                        echo json_encode(array('status'=>'success','url'=>Yii::app()->createUrl('/user/login/otp&key='.$otp_model->key)));
                    }
                }
                else
                {
                    echo json_encode(array('status'=>'error'));
                }
                
                Yii::app()->end();
                
            }
        }
        
        
       
}