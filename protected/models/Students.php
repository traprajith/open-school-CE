<?php
class Students extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Students the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public $status;
	public $dobrange;
	public $admissionrange;
	public $task_type;
	
	private $_model;
	private $_modelReg;
	private $_rules = array();
	public $max_adm_no;
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'students';
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
					array_push($rules,array('phone1','checkPhone'));
					array_push($rules,array('email','checkEmail'));
					array_push($rules,array('admission_no','numerical', 'integerOnly'=>true));
					array_push($rules,array('admission_no','checkAdmissionNo'));
					array_push($rules,array('date_of_birth','checkDateOfBirth')); 
					array_push($rules,array('first_name, last_name, email','required','on'=>'user_edit'));//In case of edit user from manage users                  
					array_push($rules,array('national_student_id','checkNationalId'));
					
					array_push($rules,array('photo_data', 'file', 'types'=>'jpg, jpeg,gif, png', 'allowEmpty' => true));
				}
				else{
					array_push($rules,array('email, phone1','required'));   
					array_push($rules,array('email','email'));                    
					array_push($rules,array('phone1','checkPhone'));
					array_push($rules,array('email','checkEmail'));          
				}
				$this->_rules = $rules;
			}
		}
		return $this->_rules;                                   
	}

	
	public function relations()
	{
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array(
            );
	}
	
	public function defaultScope()
	{
		if((isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=="onlineadmission")) or (isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=="courses") and Yii::app()->controller->action->id == 'waitinglist') or (isset(Yii::app()->controller->module->id) and (Yii::app()->controller->module->id=="parentportal") and Yii::app()->controller->action->id == 'checkStatus')){
				return parent::defaultScope();
		}else{
				return array(
						'condition'=> $this->getTableAlias(false, false).".type=:not_online",
						'params' => array(":not_online"=>0)
				);
			
		} 
	}
     
	public function checkAdmissionNo($attribute,$params)
	{
		if($this->$attribute != '' and Yii::app()->controller->module->id != 'onlineadmission'){
			$criteria				= new CDbCriteria;		
			$criteria->condition 	= 'admission_no=:admission_no';
			$criteria->params		= array(':admission_no'=>$this->$attribute);
			$student				= Students::model()->find($criteria);
			
			if($student != NULL and $student->id != $this->id){
				$this->addError($attribute,$this->getAttributeLabel('admission_no').' '.Yii::t("app",'already exist'));
			}
			
			if($this->$attribute <= 0){
				$this->addError($attribute,$this->getAttributeLabel('admission_no').' '.Yii::t("app",'must be greater than zero'));
			}
		}		
	}
	public function checkNationalId($attribute,$params)
	{
		$model= StudentsUser::model()->findByAttributes(array('national_student_id'=>$this->$attribute,'is_deleted'=>'0')); //This model is for checking all Students(Both normal & online)				
		if($this->$attribute!=''){
			if(($model!=NULL and $model->id!=$this->id)){
				$this->addError($attribute,$this->getAttributeLabel('national_student_id').' '.Yii::t("app",'already exist'));
			}
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
				$this->addError($attribute,$this->getAttributeLabel('date_of_birth').' '.'"'.$date.'"'.' '.Yii::t('app','is invalid'));
			}
		}
	}
	//Check the email is unique
	public function checkEmail($attribute,$params)
	{
		if($this->$attribute!=''){
			$student	= StudentsUser::model()->findByAttributes(array('email'=>$this->$attribute,'is_deleted'=>0)); //This model is for checking all Students(Both normal & online)				
			$employee	= Employees::model()->findByAttributes(array('email'=>$this->$attribute,'is_deleted'=>0));
			$parent		= Guardians::model()->findByAttributes(array('email'=>$this->$attribute,'is_delete'=>0));
			$user		= User::model()->findByAttributes(array('email'=>$this->$attribute));
			if(($student != NULL and $student->id != $this->id) or $employee != NULL or $parent != NULL or ($user != NULL and $user->id != $this->uid)){
				$this->addError($attribute,$this->getAttributeLabel('email').' '.'"'.$this->$attribute.'"'.' '.Yii::t('app','has already been taken'));
			}	
		}
	}
    
	//check the phone number is unique
	public function checkPhone($attribute,$params)
	{
		if($this->$attribute!=''){				
			$student	= StudentsUser::model()->findByAttributes(array('phone1'=>$this->$attribute,'is_deleted'=>0)); //This model is for checking all Students(Both normal & online)
			$employee	= Employees::model()->findByAttributes(array('mobile_phone'=>$this->$attribute,'is_deleted'=>0));
			$parent		= Guardians::model()->findByAttributes(array('mobile_phone'=>$this->$attribute,'is_delete'=>0));
			$user		= User::model()->findByAttributes(array('mobile_number'=>$this->$attribute));
			if(($student != NULL and $student->id != $this->id) or $employee != NULL or $parent != NULL or ($user != NULL and $user->id != $this->uid)){
				$this->addError($attribute,$this->getAttributeLabel('phone1').' '.'"'.$this->$attribute.'"'.' '.Yii::t('app','has already been taken'));
			}
		}
	}
    
        
	       
	public function attributeLabels()
	{
		$labels = array(
			'uid' => Yii::t('app','User ID'),
			'id' => Yii::t("app",'ID')
		);
		$model=$this->getFields();
		
		foreach ($model as $field)
			$labels[$field->varname] = Yii::t('app',$field->title);
			
		return $labels;		
	}

	public function scopes()
	{
		return array(
			'lastRecord'=>array(
				'condition' => 'is_online=1',
				'order'=>'id DESC',
				'limit'=>1,
			),
		);
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

		$criteria->compare('id',$this->id);
		$criteria->compare('admission_no',$this->admission_no,true);
		$criteria->compare('class_roll_no',$this->class_roll_no,true);
		$criteria->compare('admission_date',$this->admission_date,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('birth_place',$this->birth_place,true);
		$criteria->compare('nationality_id',$this->nationality_id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('religion',$this->religion,true);
		$criteria->compare('student_category_id',$this->student_category_id);
		$criteria->compare('address_line1',$this->address_line1,true);
		$criteria->compare('address_line2',$this->address_line2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pin_code',$this->pin_code,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('phone1',$this->phone1,true);
		$criteria->compare('phone2',$this->phone2,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('immediate_contact_id',$this->immediate_contact_id);
		$criteria->compare('is_sms_enabled',$this->is_sms_enabled);
		$criteria->compare('photo_file_name',$this->photo_file_name,true);
		$criteria->compare('photo_content_type',$this->photo_content_type,true);
		$criteria->compare('photo_data',$this->photo_data,true);
		$criteria->compare('status_description',$this->status_description,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('has_paid_fees',$this->has_paid_fees);
		$criteria->compare('photo_file_size',$this->photo_file_size);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getval()
	{
		return '"123"';
	}
	
	public function getFullname()
	{
	
		return '</td><td style="padding-left:15px;">'.CHtml::link($this->first_name.' '.$this->last_name, array('/students/students/view', 'id'=>$this->id)).'
								   </td><td style="padding-left:15px;">'.$this->admission_no.'</td>'.
								 '</tr>';
									 
	}
        
        public function getFullnames()
	{
            $name 	= "";

		if(FormFields::model()->isVisible('first_name', 'Students', 'forStudentProfile'))
                {
                    $name 	.= ucfirst($this->first_name);
                }

                if(FormFields::model()->isVisible('middle_name','Students', 'forStudentProfile'))
                {
                    $name 	.= (($name!="")?" ":"").ucfirst($this->middle_name);
                }

                if(FormFields::model()->isVisible('last_name','Students', 'forStudentProfile'))
                {
                    $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
                }
				
				$batch_student 	= BatchStudents::model()->findByAttributes(array('student_id'=>$this->id, 'batch_id'=>$_REQUEST['id'], 'status'=>1));						
				if($batch_student != NULL and $batch_student->roll_no != NULL){
					$roll_no	= $batch_student->roll_no;
				}
				else{
					$roll_no	= '-';
				}
                
                if(FormFields::model()->isVisible("fullname", "Students", "forStudentProfile"))                                            
                {					
					if(Yii::app()->controller->id == 'batches' and Yii::app()->controller->action->id == 'promote'){
						$batch_student 	= BatchStudents::model()->findByAttributes(array('student_id'=>$this->id, 'batch_id'=>$_REQUEST['id'], 'status'=>1));						
						if($batch_student != NULL and $batch_student->roll_no != NULL){
							$roll_no	= $batch_student->roll_no;
						}
						else{
							$roll_no	= '-';
						}
						$data			= '</td>';
						if(Configurations::model()->rollnoSettingsMode() != 2){
							$data	.= '<td style="padding-left:15px;">'.$roll_no.'</td>';
						}
						if(Configurations::model()->rollnoSettingsMode() != 1){ 
							$data	.= '<td style="padding-left:15px;">'.$this->admission_no.'</td>';
						}							
						$data	.= '<td style="padding-left:15px;">'.CHtml::link($name, array('/students/students/view', 'id'=>$this->id)).'</td>
									  
									  <td style="padding-left:15px;"></td></tr>';
						return $data;
					}
					else{
						return '</td><td style="padding-left:15px;">'.$roll_no.'</td>
									<td style="padding-left:15px;">'.CHtml::link($name, array('/students/students/view', 'id'=>$this->id)).'</td>
									  <td style="padding-left:15px;">'.$this->admission_no.'</td></tr>';
					}
                }
                else
                {
                    return '</td><td style="padding-left:15px;">'.$this->admission_no.'</td>'.
								 '</tr>';
                }
	
		
									 
	}
	
	public function getT_fullname()
	{
            $name= "";
            $no="";
            if(FormFields::model()->isVisible('first_name','Students','forTeacherPortal'))
            {
                $name.= $this->first_name;
            }
            if(FormFields::model()->isVisible('last_name','Students','forTeacherPortal'))
            {
                $name.= " ".$this->last_name;
            }
            if(FormFields::model()->isVisible('admission_no','Students','forTeacherPortal'))
            {
                $no= $this->admission_no;
            }
			if(Yii::app()->controller->module->id == 'teachersportal'){
				if($this->studentFullName('forTeacherPortal')){
					return '</td><td>'.$name.'</td><td >'.$no.'</td>'.'</tr>';	
				}else{
					return '</td><td >'.$no.'</td>'.'</tr>';								   								 
				}
			}else{
            	return '</td><td>'.$name.'</td><td >'.$no.'</td>'.'</tr>';								   								 
			}
            
            //		return '</td><td>'.$this->first_name.' '.$this->last_name.'
            //								   </td><td >'.$this->admission_no.'</td>'.
            //								 '</tr>';
									 
	}
	public function getStudentname()
	{
		return ucfirst($this->first_name).' '.ucfirst($this->middle_name).' '.ucfirst($this->last_name);
	}
	
	public function getStudentnameforstudentprofile()
	{
		$name 	= "";

		if(FormFields::model()->isVisible('first_name', 'Students', 'forStudentProfile'))
        {
            $name 	.= ucfirst($this->first_name);
        }

        if(FormFields::model()->isVisible('middle_name','Students', 'forStudentProfile'))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->middle_name);
        }

        if(FormFields::model()->isVisible('last_name','Students', 'forStudentProfile'))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
        }
		if($name !=""){
        	return $name;
		}else{
			return '-';
		}
	}
	
	public function getStudentnameforparentportal()
	{
		$name 	= "";

		if(FormFields::model()->isVisible('first_name', 'Students', 'forParentPortal'))
        {
            $name 	.= ucfirst($this->first_name);
        }

        if(FormFields::model()->isVisible('middle_name','Students', 'forParentPortal'))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->middle_name);
        }

        if(FormFields::model()->isVisible('last_name','Students', 'forParentPortal'))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
        }
		if($name !=NULL){
        	return $name;
		}else{
			return '-';
		}
	}

	public function studentFullName($scope='forStudentProfile'){
		$name 	= "";

		if(FormFields::model()->isVisible('first_name', 'Students', $scope))
        {
			
            $name 	.= ucfirst($this->first_name);
        }

        if(FormFields::model()->isVisible('middle_name','Students', $scope))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->middle_name);
        }

        if(FormFields::model()->isVisible('last_name','Students', $scope))
        {
            $name 	.= (($name!="")?" ":"").ucfirst($this->last_name);
			
        }

        return $name;
	}
        
        
	
//Student Profile Image Path
	public function getProfileImagePath($id){
		$model = Students::model()->findByPk($id);
		$path = 'uploadedfiles/student_profile_image/'.$model->id.'/'.$model->photo_file_name;	
		return $path;
	}
//Get the fiedls from form_fields	
	public function getFields() {
		$scope 		= NULL;
		if(Yii::app()->controller->module->id == 'students' or Yii::app()->controller->module->id == 'studentportal' or Yii::app()->controller->module->id == 'admin'){
			$scope 	= "forAdminRegistration";
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$scope 	= "forOnlineRegistration";
		}

		$criteria	= new CDbCriteria;
		if(Yii::app()->controller->id == 'guardians' and Yii::app()->controller->action->id == 'addguardian'){
			$criteria->condition	= "`tab_selection`=:tab_selection AND `model`=:model";
			$criteria->params		= array(':tab_selection'=>3, 'model'=>"Students");
		}		
		else{
			$criteria->condition	= "`tab_selection`=:tab_selection AND `model`=:model";
			$criteria->params		= array(':tab_selection'=>1, 'model'=>"Students");
		}		

		if($scope!=NULL){
			$this->_modelReg	= FormFields::model()->$scope()->findAll($criteria);
		}
		else{
			$this->_modelReg	= FormFields::model()->findAll($criteria);
		}

		return $this->_modelReg;		
	}
	

    //return full name of father
    public function getFatherName($student_id)
    {
        $name="";
        $guardian_list_data = GuardianList::model()->findAllByAttributes(array('student_id'=>$student_id));
        if($guardian_list_data)
        {
            foreach($guardian_list_data as $key=>$data)
            {
                if($data->relation=="Father")
                {
                    $guardian_model= Guardians::model()->findByPk($data->guardian_id);
                    if(FormFields::model()->isVisible('first_name','Guardians','forStudentProfile'))
                    {                        
                        $name= ucfirst($guardian_model->first_name);
                    }
                    if(FormFields::model()->isVisible('last_name','Guardians','forStudentProfile'))
                    {                        
                        $name.= " ".ucfirst($guardian_model->last_name);
                    }
                    return $name;
                }
            }
    	
        }else
            return "-";				
    }
    
    public function getMotherName($student_id)
    {
        $name="";
        $guardian_list_data = GuardianList::model()->findAllByAttributes(array('student_id'=>$student_id));
        if($guardian_list_data)
        {
            foreach($guardian_list_data as $key=>$data)
            {
                if($data->relation=="Mother")
                {
                    $guardian_model= Guardians::model()->findByPk($data->guardian_id);
                    if(FormFields::model()->isVisible('first_name','Guardians','forStudentProfile'))
                    {                        
                        $name= ucfirst($guardian_model->first_name);
                    }
                    if(FormFields::model()->isVisible('last_name','Guardians','forStudentProfile'))
                    {                        
                        $name.= " ".ucfirst($guardian_model->last_name);
                    }
                    return $name;
                }
            }
    	
        }else
            return "-";				
    }
//In case restore, check whether the email is already assigned to another user		
	public function checkEmailDuplicate($type, $id) //$type may be 'student' or 'guardian'
	{
		if($type == 'student'){
			$selected_user		= Students::model()->findByPk($id);
		}
		if($type == 'guardian'){
			$selected_user		= Guardians::model()->findByPk($id);
		}
		$student 	= Students::model()->findByAttributes(array('email'=>$selected_user->email, 'is_deleted'=>0));
		$guardian	= Guardians::model()->findByAttributes(array('email'=>$selected_user->email, 'is_delete'=>0));
		$employee	= Employees::model()->findByAttributes(array('email'=>$selected_user->email, 'is_deleted'=>0));
		$user		= User::model()->findByAttributes(array('email'=>$selected_user->email));
		if($student != NULL or $guardian != NULL or $employee != NULL or ($user != NULL and $user->id != $selected_user->uid)){
			return $id;
		}
		return;		
	}
//In case restore, check whether the phone is already assigned to another user		
	public function checkPhoneDuplicate($type, $id) //$type may be 'student' or 'guardian'
	{
		if($type == 'student'){
			$selected_user	= Students::model()->findByPk($id);
			$phone 			= $selected_user->phone1;
		}
		if($type == 'guardian'){
			$selected_user	= Guardians::model()->findByPk($id);
			$phone 			= $selected_user->mobile_phone;
		}		
		$student 	= Students::model()->findByAttributes(array('phone1'=>$phone, 'is_deleted'=>0));
		$guardian	= Guardians::model()->findByAttributes(array('mobile_phone'=>$phone, 'is_delete'=>0));
		$employee	= Employees::model()->findByAttributes(array('mobile_phone'=>$phone, 'is_deleted'=>0));
		$user		= User::model()->findByAttributes(array('mobile_number'=>$phone));
		
		if($student != NULL or $guardian != NULL or $employee != NULL or ($user != NULL and $user->id != $selected_user->uid)){
			return $id;
		}
		return;		
	}

	public function getPrimaryGuardian($student_id){		
		$student				= Students::model()->findByPk($student_id);
		if($student!=NULL and $student->parent_id!=NULL and $student->parent_id!=0){
			$guardian 				= Guardians::model()->findByPk($student->parent_id);
			return $guardian;
		}
		
		return NULL;
	}
	public function getstud()
	{		           
		$name = ucfirst($this->first_name).' '.ucfirst($this->middle_name).' '.ucfirst($this->last_name);		   
		return $name;
	}
        
        //Student batch name
        public static function getStudentBatch($student_id)
        {
            $criteria               =   new CDbCriteria;  
            $criteria->join         =   'LEFT JOIN batch_students t1 ON t1.batch_id = t.id';
            $criteria->condition    =   't.is_active=:is_active AND t.is_deleted=:is_deleted AND t1.student_id=:student_id AND t1.status=:status AND t1.result_status=:result_status';
            $criteria->params       =   array(':is_active'=>1, ':is_deleted'=>0, ':student_id'=>$student_id, ':status'=>1, ':result_status'=>0);   
            $criteria->order        =   't.id DESC';
            $batch                  =   Batches::model()->find($criteria);
            return $batch;            
        }
}