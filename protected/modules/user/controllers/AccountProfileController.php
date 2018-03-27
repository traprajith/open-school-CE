<?php

class AccountProfileController extends Controller
{
	public $defaultAction = 'profile';
	//public $layout='//layouts/column2';	
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		//disable jquery autoload
		Yii::app()->clientScript->scriptMap=array(
			'jquery.js'=>false,
		);
		$model = $this->loadUser();
	    $this->render('profile',array(
	    	'model'=>$model,
			'profile'=>$model->profile,
	    ));
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		//disable jquery autoload
		Yii::app()->clientScript->scriptMap=array(
			'jquery.js'=>false,
		);
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			
                   
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
                                
                                $usermodel= $this->Usermodel();
                                if($usermodel)
                                {
                                    if($usermodel==1)
                                    {
                                        $usr_model= Guardians::model()->findByAttributes(array('uid'=>  Yii::app()->user->id));
                                        $usr_model->email= $model->email;                                                                                
                                        $usr_model->save();
                                    }
                                    if($usermodel==2)
                                    {
                                        $usr_model= Students::model()->findByAttributes(array('uid'=>  Yii::app()->user->id));
                                        $usr_model->email=$model->email;
                                        $usr_model->save();
                                    }
                                    if($usermodel==3)
                                    {
                                        $usr_model= Employees::model()->findByAttributes(array('uid'=>  Yii::app()->user->id));
                                        $usr_model->email= $model->email;
                                        $usr_model->save();
                                    }
                                }
                                
                //Yii::app()->user->updateSession();
				Yii::app()->user->setFlash('profileMessage',Yii::t('app',"Changes is saved."));
				$this->redirect(array('/user/accountProfile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
        
        
        //check the user type and model
        public function Usermodel()
        {
            $user_model="";
            $roles=Rights::getAssignedRoles(Yii::app()->user->Id); // check for single role					
		foreach($roles as $role)
		{
                    $user_base= $role->name;
                    if($user_base=='parent')
                    {
                        $user_model= "1";
                    }
                    else if($user_base=='student')
                    {
                        $user_model= "2";
                    }
                    else if($user_base=='teacher')
                    {
                        $user_model= "3";
                    }                                        
                }
                return $user_model;
        }


        /**
	 * Change password
	 */
	public function actionChangepassword() {
		//disable jquery autoload
		Yii::app()->clientScript->scriptMap=array(
			'jquery.js'=>false,
		);
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
                                                $salt= User::model()->getSalt();  
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($salt.$model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
                                                $new_password->salt= $salt;
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',Yii::t('app',"New password is saved."));
						$this->redirect(array("/user/accountProfile"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
}