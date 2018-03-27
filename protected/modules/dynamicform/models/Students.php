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
		if (!$this->_rules) {
			$required = array();
			$numerical = array();	
			$decimal = array();
			$rules = array();
			
			$model=$this->getFields();
			
			foreach ($model as $field) {
				$field_rule = array();
				if ($field->required==FormFields::REQUIRED_YES)
					array_push($required,$field->varname);				
				if ($field->field_type=='DECIMAL')
					array_push($decimal,$field->varname);
				if ($field->field_type=='INTEGER')
					array_push($numerical,$field->varname);
				if ($field->field_type=='VARCHAR'||$field->field_type=='TEXT') {
					$field_rule = array($field->varname, 'length', 'max'=>$field->field_size, 'min' => $field->field_size_min);
					if ($field->error_message) $field_rule['message'] = Yii::t('app',$field->error_message);
					array_push($rules,$field_rule);
				}								
			}			
			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));			
			array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));
			array_push($rules,array('email','email'));
			array_push($rules,array('admission_no, phone1, email','unique'));
			array_push($rules,array('email','check'));
			array_push($rules,array('photo_data', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true));
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
		);
	}
	public function check($attribute,$params)
    {
		$guardians= Guardians::model()->findByAttributes(array('email'=>$this->$attribute,'is_delete'=>'0'));
		$employee= Employees::model()->findByAttributes(array('email'=>$this->$attribute,'is_deleted'=>'0'));
		$validate = User::model()->findByAttributes(array('email'=>$this->$attribute));
		
		if($this->$attribute!='')
		{
			if(($validate!=NULL and $validate->id!=$this->uid) or $employee!=NULL or $guardians!=NULL)
			{
				$this->addError($attribute,Yii::t("app",'Email ').'"'.$this->$attribute.'"'.Yii::t('app',' has already been taken'));
			}
		}
    }
	//check the phone number is unique
	/*public function check_phone($attribute,$params)
    {
		
		$student= Students::model()->findByAttributes(array('phone1'=>$this->$attribute));
		$employee= Employees::model()->findByAttributes(array('mobile_phone'=>$this->$attribute));
		$parent= Guardians::model()->findByAttributes(array('mobile_phone'=>$this->$attribute));
		
		if(Yii::app()->controller->action->id!='update' and $this->$attribute!='')
		{
			
			if($student!=NULL or $employee!=NULL or $parent!=NULL)
			{
			
				$this->addError($attribute,' Mobile Phone already in use');
			}
		}
		elseif(Yii::app()->controller->action->id == 'update' and $this->$attribute!='')
		{
			if($student!=NULL or $employee!=NULL or $parent!=NULL)
			{
				if($student->id != $this->id)
					$this->addError($attribute,'Phone Number already in use');
			}
		}
    }*/
	//end 
	/**
	 * @return array customized attribute labels (name=>label)
	 */
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
	
	public function getT_fullname()
	{
	
		return '</td><td>'.$this->first_name.' '.$this->last_name.'
								   </td><td >'.$this->admission_no.'</td>'.
								 '</tr>';
									 
	}
	public function getStudentname()
	{
		return ucfirst($this->first_name).' '.ucfirst($this->middle_name).' '.ucfirst($this->last_name);
	}
	
//Student Profile Image Path
	public function getProfileImagePath($id){
		$model = Students::model()->findByPk($id);
		$path = 'uploadedfiles/student_profile_image/'.$model->id.'/'.$model->photo_file_name;	
		return $path;
	}
//Get the fiedls from form_fields	
	public function getFields() {
		if(Yii::app()->controller->module->id == 'students'){
			$this->_modelReg=ProfileField::model()->forAdminRegistration()->findAll();
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$this->_model=ProfileField::model()->forOnlineRegistration()->findAll();
		}
			
	}
	
	
}