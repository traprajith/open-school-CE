<?php


class ApplicationStatus extends CFormModel
{
	public $registration_id;
	public $password;
	
	
	
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(Yii::app()->controller->module->id == 'students')
		{
			return array(
				// username and password are required
				array('registration_id, password', 'required'),
				// password needs to be authenticated
				array('password', 'authenticate'),
			);
		}
		elseif(Yii::app()->controller->module->id == 'employees')
		{
			return array(
				// username and password are required
				array('registration_id, password', 'required'),
				// password needs to be authenticated
				array('password', 'empauthenticate'),
			);
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'registration_id'=>Yii::t("app","Registration ID"),
			'password'=>Yii::t("app","PIN"),
		);
	}

	public function authenticate()
	{
		if($this->registration_id!=NULL and $this->password!=NULL){	
			$profile = Students::model()->findByAttributes(array('registration_id'=>$this->registration_id,'password'=>$this->password,'is_deleted'=>0,'is_online'=>1));
			
			if($profile == NULL)
			{
				
				$this->addError("password",(Yii::t("app","Registration ID or PIN is incorrect.")));
			}
			else
			{
				return $profile->id;
			}
		}else{
			$this->addError("password",(Yii::t("app","Registration ID or PIN is incorrect.")));
		}
		
	}
	
	public function empauthenticate()
	{
		$profile = RegisteredEmployees::model()->findByAttributes(array('registration_id'=>$this->registration_id,'password'=>$this->password,'is_deleted'=>0));
		if($profile == NULL)
		{
			
			$this->addError("password",Yii::t("app",("Registration ID or PIN is incorrect.")));
		}
		else
		{
			return $profile->id;
		}
		
	}
}

