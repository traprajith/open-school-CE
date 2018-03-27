<?php

/**
 * This is the model class for table "guardians".
 *
 * The followings are the available columns in table 'guardians':
 * @property integer $id
 * @property integer $ward_id
 * @property string $first_name
 * @property string $last_name
 * @property string $relation
 * @property string $email
 * @property string $office_phone1
 * @property string $office_phone2
 * @property string $mobile_phone
 * @property string $office_address_line1
 * @property string $office_address_line2
 * @property string $city
 * @property string $state
 * @property integer $country_id
 * @property string $dob
 * @property string $occupation
 * @property string $income
 * @property string $education
 * @property string $created_at
 * @property string $updated_at
 */
class Guardians extends CActiveRecord
{
	public $radio;
	public $user_create;
    public $relation_other;
	public $same_address;
    public $student_name;
	
	private $_model;
	private $_modelReg;
	private $_rules = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @return Guardians the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'guardians';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		if(Yii::app()->controller->module->id != 'user'){ //In case of edit from user module
			if (!$this->_rules) {
				$rules = array();
				if(Yii::app()->controller->id != 'archive' and Yii::app()->controller->id != 'androidApi'){	
					$required = array();
					$numerical = array();					
					$decimal = array();
					$safe	= array();
					
					$model=$this->getFields();
					
					foreach ($model as $field) {
						$field_rule 	= array();
						$rule_added		= false;
						if ($field->required==FormFields::REQUIRED_YES){
							if ($field->form_field_type==5){
								array_push($rules,array($field->varname, 'compare', 'compareValue'=>true, 'message'=>Yii::t('app', '{attribute} cannot be blank')));
							}
							array_push($required,$field->varname);
							$rule_added		= true;
						}
						if ($field->field_type=='DECIMAL'){
							array_push($decimal,$field->varname);
							$rule_added		= true;
						}
						if ($field->field_type=='INTEGER'){
							array_push($numerical,$field->varname);
							$rule_added		= true;
						}
						
						if($rule_added==false){
							array_push($safe,$field->varname);
						}
					}			
					array_push($rules,array(implode(',',$required), 'required'));
					array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));			
					array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));
					array_push($rules,array(implode(',',$safe), 'safe'));
					array_push($rules,array('email','email'));			
					array_push($rules,array('email','check'));
					array_push($rules,array('mobile_phone','checkPhone'));
					array_push($rules,array('dob','checkDateOfBirth')); 
					array_push($rules,array('relation_other','check_relation'));
					array_push($rules,array('first_name, last_name, email','required','on'=>'user_edit'));//In case of edit user from manage users
				}
				else{
					array_push($rules,array('email, mobile_phone','required'));
					array_push($rules,array('email','email'));			
					array_push($rules,array('email','check'));
					array_push($rules,array('mobile_phone','checkPhone'));
				}
			}
			
			$this->_rules = $rules;
		}
		return $this->_rules;  				
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		 'emergency'=>array(self::BELONGS_TO, 'Students', 'id'),
		 'active'=>array(self::BELONGS_TO, 'Students', 'is_active'),
		);
	}
        
	//for check relation is others and validation
	public function check_relation()
	{
		if($this->relation=='Others' and $this->relation_other == ""){			
			$this->addError('relation_other', $this->getAttributeLabel('relation_other').' '.Yii::t("app","Cannot be Blank"));			
		}
	}
    
	//Check the date of birth is less than today
	public function checkDateOfBirth($attribute,$params)
	{
		if($this->$attribute != ''){
			$today			= date('Y-m-d'); 
			$selected_date	= date('Y-m-d', strtotime($this->$attribute));
			if($selected_date >= $today){
				$settings	= UserSettings::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
				if($settings != NULL){
					$date = date($settings->displaydate, strtotime($selected_date));
				}
				else{
					$date = $this->$attribute; 
				}
				$this->addError($attribute,$this->getAttributeLabel('dob').' '.'"'.$date.'"'.' '.Yii::t('app','is invalid'));
			}
		}
	}  
	    
	//check the email is unique
	public function check($attribute,$params)
    {
		if($this->$attribute!=''){
			$parent		= Guardians::model()->findByAttributes(array('email'=>$this->$attribute,'is_delete'=>0));	            				
			$student	= StudentsUser::model()->findByAttributes(array('email'=>$this->$attribute, 'is_deleted'=>0)); //This model is for checking all Students(Both normal & online)
			$employee	= Employees::model()->findByAttributes(array('email'=>$this->$attribute, 'is_deleted'=>0));
			$user	 	= User::model()->findByAttributes(array('email'=>$this->$attribute));		
			if(($parent != NULL and $parent->id != $this->id) or ($user!=NULL and $user->id!=$this->uid) or $employee!=NULL or $student!=NULL){
				$this->addError($attribute,$this->getAttributeLabel('email').' '.'"'.$this->$attribute.'"'.' '.Yii::t('app','has already been taken'));
			}
		}                               
    }
	//check the mobile number is unique
	public function checkPhone($attribute,$params)
	{	
		if($this->$attribute!=''){			
			$parent		= Guardians::model()->findByAttributes(array('mobile_phone'=>$this->$attribute,'is_delete'=>0));
			$student	= StudentsUser::model()->findByAttributes(array('phone1'=>$this->$attribute,'is_deleted'=>0)); //This model is for checking all Students(Both normal & online)				
			$employee	= Employees::model()->findByAttributes(array('mobile_phone'=>$this->$attribute,'is_deleted'=>0));			
			$user		= User::model()->findByAttributes(array('mobile_number'=>$this->$attribute));
			if(($parent != NULL and $parent->id != $this->id) or $employee != NULL or $student != NULL or ($user != NULL and $user->id != $this->uid)){
				$this->addError($attribute,$this->getAttributeLabel('mobile_phone').' '.'"'.$this->$attribute.'"'.' '.Yii::t('app','has already been taken'));				
			}
		}
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$labels = array(
			'uid' => Yii::t('app','User ID'),
			'id' => Yii::t("app",'ID'),
			'ward_id' => Yii::t("app",'Students'),
			'relation_other'=>Yii::t("app",'Specify Relation'),
			'same_address'=>Yii::t("app",'Same Address')
		);
		$model=$this->getFields();
		
		foreach ($model as $field){
			$labels[$field->varname] = Yii::t('app',$field->title);
		}
			
		return $labels;			
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->join = 'JOIN guardian_list t2 ON t.id = t2.guardian_id JOIN students t1 ON t1.id = t2.student_id'; 
		$criteria->distinct = true;
		$criteria->condition = 't1.type=:type';
		$criteria->params = array(':type'=>0);
		if(isset($this->first_name) && $this->first_name!=NULL){
			//$criteria->join 			= 'LEFT JOIN profiles as t2 ON t2.user_id = user.id';  
			if((substr_count( $this->first_name,' '))==0)
			{ 	
				$criteria->condition='(t.first_name LIKE :name or t.last_name LIKE :name)';
				$criteria->params[':name'] = '%'.$this->first_name.'%';
			}
			else if((substr_count( $this->first_name,' '))>=1)
			{
				$name=explode(" ",$this->first_name);
				$criteria->condition='(t.first_name LIKE :name or t.last_name LIKE :name)';
				$criteria->params[':name'] = '%'.$name[0].'%';
				$criteria->condition=$criteria->condition.' and '.'(t.first_name LIKE :name1 or t.last_name LIKE :name1)';
				$criteria->params[':name1'] = '%'.$name[1].'%';			
			}
		}
		$criteria->compare('t.id',$this->id);                
		$criteria->compare('t.ward_id',$this->ward_id);
		//$criteria->compare('t.first_name',$this->first_name,true);
		//$criteria->compare('t.last_name',$this->last_name,true);
		$criteria->compare('t.relation',$this->relation,true);
		$criteria->compare('t.email',$this->email,true);
		$criteria->compare('t.office_phone1',$this->office_phone1,true);
		$criteria->compare('t.office_phone2',$this->office_phone2,true);
		$criteria->compare('t.mobile_phone',$this->mobile_phone,true);
		$criteria->compare('t.office_address_line1',$this->office_address_line1,true);
		$criteria->compare('t.office_address_line2',$this->office_address_line2,true);
		$criteria->compare('t.city',$this->city,true);
		$criteria->compare('t.state',$this->state,true);
		$criteria->compare('t.country_id',$this->country_id);
		$criteria->compare('t.dob',$this->dob,true);
		$criteria->compare('t.occupation',$this->occupation,true);
		$criteria->compare('t.income',$this->income,true);
		$criteria->compare('t.education',$this->education,true);
		$criteria->compare('t.created_at',$this->created_at,true);
		$criteria->compare('t.updated_at',$this->updated_at,true);
		$criteria->compare('t.is_delete',0,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function studentname($data,$row)
	{
           //echo $data->id;
		$posts = Students::model()->findAllByAttributes(array('parent_id'=>$data->id));
		if($posts!=NULL)
		{
			$students = array();
			foreach($posts as $post)
			{
				echo $post->first_name.' '.$post->last_name.'<br/>';
			}
		}
		else
		{
			return '-';
		}
	}
        
        function students($data,$row)
	{
          
           $array_list= array();
           $glist= GuardianList::model()->findAllByAttributes(array('guardian_id'=>$data->id));
           if($glist)
           {
               foreach ($glist as $student)
               {
                   $st_list= Students::model()->findByAttributes(array('id'=>$student->student_id,'is_active'=>1,'is_deleted'=>0));
                   if($st_list)
                   {
                       
                       $array_list[]=  ucfirst($st_list->first_name)." ".  ucfirst($st_list->last_name); 
                   }
               }
           }
           return implode(",", $array_list);
           
		
	}
        function studentlist($data,$row)
	{
          
           $array_list= array();
           $glist= GuardianList::model()->findAllByAttributes(array('guardian_id'=>$data->id));
           if($glist)
           {
               foreach ($glist as $student)
               {
                   $st_list= Students::model()->findByAttributes(array('id'=>$student->student_id,'is_active'=>1,'is_deleted'=>0));
                   if($st_list)
                   {
                       $name='';
                       if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))
                        {
                           $name='';
                            $name=  $st_list->studentFullName('forStudentProfile');
                        }
                       $array_list[]=  $name; 
                   }
               }
           }
           return implode(",", $array_list);
           
		
	}
        
        //action for het student name - multiple parent
        function studentname_parent($data,$row)
	{
            $list= GuardianList::model()->findByAttributes(array('guardian_id'=>$data->id));
            if($list)
            {
                $student_id= $list->student_id;
            }
            
		$posts = Students::model()->findByPk($student_id);
		if($posts!=NULL)
		{
			$students = array();
			//foreach($posts as $post)
			{
                            
				echo $posts->first_name.' '.$posts->last_name.'<br/>';
			}
		}
		else
		{
			return '-';
		}
	}
	
	function parentname($data,$row)
	{
		$name= "";
		//$posts=Students::model()->findByAttributes(array('id'=>$data->ward_id));
		if(FormFields::model()->isVisible('first_name','Guardians','forAdminRegistration'))
		{
			$name.= ucfirst($data->first_name);
		}
		if(FormFields::model()->isVisible('last_name','Guardians','forAdminRegistration'))
		{
			$name.= " ".ucfirst($data->last_name);
		}

		if($name=="")
		{
			return "-";
		}
		else
		{
			return CHtml::link($name, array('/students/guardians/view','id'=>$data->id));
		}

        //return CHtml::link(ucfirst($data->first_name).' '.ucfirst($data->last_name), array('/students/guardians/view','id'=>$data->id));
		//return ucfirst($data->first_name).' '.ucfirst($data->last_name);	
	}
        function parentnamedata($data,$row)
	{
		$name= "";
		//$posts=Students::model()->findByAttributes(array('id'=>$data->ward_id));
		if(FormFields::model()->isVisible('first_name','Guardians','forStudentProfile'))
		{
			$name.= ucfirst($data->first_name);
		}
		if(FormFields::model()->isVisible('last_name','Guardians','forStudentProfile'))
		{
			$name.= " ".ucfirst($data->last_name);
		}

		if($name=="")
		{
			return "-";
		}
		else
		{
			return CHtml::link($name, array('/students/guardians/view','id'=>$data->id));
		}

        //return CHtml::link(ucfirst($data->first_name).' '.ucfirst($data->last_name), array('/students/guardians/view','id'=>$data->id));
		//return ucfirst($data->first_name).' '.ucfirst($data->last_name);	
	}

	public function getFullname(){
		$name 	= "";
		if(FormFields::model()->isVisible('first_name','Guardians','forStudentPortal'))
        {
            $name 	.= ucfirst($this->first_name);
        }

        if(FormFields::model()->isVisible('last_name','Guardians','forStudentPortal'))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
        }

        return $name;
	}

	public function parentFullName($scope='forStudentPortal'){
		$name 	= "";

		if(FormFields::model()->isVisible('first_name', 'Guardians', $scope))
        {
            $name 	.= ucfirst($this->first_name);
        }
        
        if(FormFields::model()->isVisible('last_name','Guardians', $scope))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
        }

        return $name;
	}
        
	//function for return guardian relation - parent details
	function Guardian_relations()
	{
		   
		$id= $_REQUEST['id'];
		$relations= CHtml::listData(GuardianList::model()->findAllByAttributes(array('student_id'=>$id)), 'id', 'relation');
		$list= array('Father'=>Yii::t("app",'Father'),'Mother'=>Yii::t("app",'Mother'),'Others'=>Yii::t("app",'Others'));                        
	   
		//$list= array('Father'=>Yii::t("app",'Father'),'Mother'=>Yii::t("app",'Mother'),'Others'=>Yii::t("app",'Others'));
		return array_diff($list, $relations);
		
		
	}
	
	function Guard_relations()
	{                          
		$list= array('Father'=>Yii::t("app",'Father'),'Mother'=>Yii::t("app",'Mother'),'Others'=>Yii::t("app",'Others'));                                   
		//$list= array('Father'=>Yii::t("app",'Father'),'Mother'=>Yii::t("app",'Mother'),'Others'=>Yii::t("app",'Others'));
		return ($list);                        
	}
	
//Get the fiedls from form_fields	
	public function getFields() {
		$scope 		= NULL;
		if(Yii::app()->controller->module->id == 'students'){
			$scope 	= "forAdminRegistration";
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$scope 	= "forOnlineRegistration";
		}
		if(Yii::app()->controller->module->id == 'parentportal'){
			$scope 	= "forParentPortal";
		}
		
		$criteria	= new CDbCriteria;
		$criteria->condition	= "`tab_selection`=:tab_selection AND `model`=:model";
		$criteria->params		= array(':tab_selection'=>2, 'model'=>"Guardians");
		if($scope!=NULL){
			$this->_modelReg	= FormFields::model()->$scope()->findAll($criteria);
		}
		else{
			$this->_modelReg	= FormFields::model()->findAll($criteria);
		}

		return $this->_modelReg;	
	}	
	public function getVisible($data)
	{
	  
	}
	//Get student's guardians
	public function getGuardians($sid)
	{
		$guardian_arr 			= array(); 
		$criteria 				= new CDbCriteria;		
		$criteria->join 		= 'JOIN guardian_list t1 ON t.id = t1.guardian_id'; 
		$criteria->condition 	= 't1.student_id=:student_id AND t.is_delete=:is_delete';
		$criteria->params 		= array(':student_id'=>$sid,'is_delete'=>0);			
		$criteria->order		= 't.id ASC';
		$existing_guardians 	= Guardians::model()->findAll($criteria);
		if($existing_guardians){
			foreach($existing_guardians as $existing_guardian){
				if(!in_array($existing_guardian->id, $guardian_arr)){
					$guardian_arr[] = $existing_guardian->id;
				}
			}
		}
		return $guardian_arr;
	}
	
//Create Student User
	public function createGuardianUser($id)
	{	
		$model = Guardians::model()->findByPk($id);
		if(($model->uid == 0 or $model->uid == '' or $model->uid == NULL) and $model->email != NULL){
			$user			= new User;
			$profile		= new Profile;
			$user->username = substr(md5(uniqid(mt_rand(), true)), 0, 10);
			$user->email 	= $model->email;
			$user->activkey	= UserModule::encrypting(microtime().$model->first_name);
			$password 		= substr(md5(uniqid(mt_rand(), true)), 0, 10);
			$salt			= User::model()->getSalt();          
			$user->password	= UserModule::encrypting($salt.$password);
			if(isset($model->mobile_phone)){
				$user->mobile_number	= $model->mobile_phone;
			}
			$user->superuser	= 0;
			$user->status		= 1;
			$user->salt			= $salt;
			if($user->save()){
				//Assign role
				$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
				$authorizer->authManager->assign('parent', $user->id);
			
				//Profile
				$profile->firstname = $model->first_name;
				$profile->lastname 	= $model->last_name;
				$profile->user_id	= $user->id;
				$profile->save();
			
				//Saving user id to guardian table.
				$model->saveAttributes(array('uid'=>$user->id));
				
				//SMS Notification
				$notification 	= NotificationSettings::model()->findByAttributes(array('id'=>3));
				$college		= Configurations::model()->findByPk(1);
				$to = '';
				if($notification->sms_enabled=='1' and $notification->parent_1 == '1'){ // Checking if SMS is enabled.						
					if($model->mobile_phone){
						$to = $model->mobile_phone;	
					}
				
					if($to!=''){ 							
						$from 			= $college->config_value;
						$template		= SystemTemplates::model()->findByPk(1);
						$message 		= $template->template;
						$message 		= str_replace("<School Name>",$college->config_value,$message);
						
						$template		= SystemTemplates::model()->findByPk(2);
						$login_message 	= $template->template;
						$login_message 	= str_replace("<School Name>",$college->config_value,$login_message);
						$login_message 	= str_replace("<Password>",$password,$login_message);
						
						SmsSettings::model()->sendSms($to,$from,$message);
						SmsSettings::model()->sendSms($to,$from,$login_message);
					} 
				} 
				
				//Mail Notifiaction	
				if($notification->mail_enabled == '1' and $notification->parent_1 == '1'){						
					$template	= EmailTemplates::model()->findByPk(2);
					$subject 	= $template->subject;
					$message 	= $template->template;				
					$subject 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$subject);																	
					$message 	= str_replace("{{SCHOOL NAME}}",$college->config_value,$message);
					$message 	= str_replace("{{EMAIL}}",$model->email,$message);
					$message 	= str_replace("{{PASSWORD}}",$password,$message);
					
					UserModule::sendMail($model->email,$subject,$message);						
				}
				//Message Notification	
				if($notification->msg_enabled == '1' and $notification->parent_1 == '1'){						
					$to 		= $model->uid;
					$subject 	= Yii::t('app','Welcome to').' '.$college->config_value;
					$message 	= Yii::t('app','Hi, Welcome to').' '.$college->config_value.'.'.Yii::t('app','We are looking forward to your esteemed presence and cooperation with our organization.');
					
					NotificationSettings::model()->sendMessage($to,$subject,$message);
				}	
			}
		}
		return;
	}
}