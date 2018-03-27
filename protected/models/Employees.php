<?php

/**
 * This is the model class for table "employees".
 *
 * The followings are the available columns in table 'employees':
 * @property integer $id
 * @property integer $employee_category_id
 * @property string $employee_number
 * @property string $joining_date
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $gender
 * @property string $job_title
 * @property integer $employee_position_id
 * @property integer $employee_department_id
 * @property integer $reporting_manager_id
 * @property integer $employee_grade_id
 * @property string $qualification
 * @property string $experience_detail
 * @property integer $experience_year
 * @property integer $experience_month
 * @property integer $status
 * @property string $status_description
 * @property string $date_of_birth
 * @property string $marital_status
 * @property integer $children_count
 * @property string $father_name
 * @property string $mother_name
 * @property string $husband_name
 * @property string $blood_group
 * @property integer $nationality_id
 * @property string $home_address_line1
 * @property string $home_address_line2
 * @property string $home_city
 * @property string $home_state
 * @property integer $home_country_id
 * @property string $home_pin_code
 * @property string $office_address_line1
 * @property string $office_address_line2
 * @property string $office_city
 * @property string $office_state
 * @property integer $office_country_id
 * @property string $office_pin_code
 * @property string $office_phone1
 * @property string $office_phone2
 * @property string $mobile_phone
 * @property string $home_phone
 * @property string $email
 * @property string $fax
 * @property string $photo_file_name
 * @property string $photo_content_type
 * @property string $photo_data
 * @property string $created_at
 * @property string $updated_at
 * @property integer $photo_file_size
 * @property integer $user_id
 */
class Employees extends CActiveRecord
{
	
	public $status;
	public $dobrange;
	public $joinrange;
	public $total_experience;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Employees the static model class
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
		return 'employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(Yii::app()->controller->module->id == 'teachersportal' and Yii::app()->controller->action->id=='editprofile'){
			return array(
				array('first_name, last_name, gender, date_of_birth, home_address_line1, home_city, home_state, home_country_id, home_pin_code, email, mobile_phone, qualification','required'),
				array('home_pin_code, office_pin_code, mobile_phone','numerical', 'integerOnly'=>true),
				array('email','email'),
				array('email','checkEmail'),					
				array('mobile_phone','checkPhone'),				
				array('date_of_birth','checkDateOfBirth'),				
			);
		}
		if(Yii::app()->controller->action->id=='create2' or Yii::app()->controller->action->id=='update2'){
			return array(
				array('home_address_line1, home_city, home_state, home_country_id, home_pin_code, mobile_phone, qualification','required'),
				array('home_pin_code, office_pin_code, mobile_phone','numerical', 'integerOnly'=>true),						
				array('mobile_phone','checkPhone'),
				array('home_pin_code,office_pin_code','length', 'max'=>6),
				array('home_address_line1, home_address_line2, home_city, home_state, home_pin_code, office_address_line1, office_address_line2, office_city, office_state, office_pin_code, office_phone1, office_phone2, mobile_phone, home_phone, fax, photo_file_name, photo_content_type', 'length', 'max'=>255),
							
			);
		}
		
		return array(
			array('employee_category_id, employee_position_id, employee_department_id, reporting_manager_id, employee_grade_id, experience_year, experience_month, children_count, nationality_id, home_country_id, home_pin_code, office_country_id, office_pin_code, photo_file_size, is_deleted, user_id, uid', 'numerical', 'integerOnly'=>true),
			array('employee_number, gender, first_name, middle_name, last_name, job_title, qualification, status_description, marital_status, father_name, mother_name, husband_name, blood_group', 'length', 'max'=>255),
			array('joining_date, experience_detail, date_of_birth, created_at, updated_at', 'safe'),
			array('employee_number, first_name, last_name, gender, date_of_birth, employee_department_id, qualification, email', 'required'),
			array('experience_year, experience_month', 'exp_validation'),
			array('employee_number','unique'),
			array('email','checkEmail'),	
			array('date_of_birth','checkDateOfBirth'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('photo_data', 'file', 'types'=>'jpg, gif, png','allowEmpty' => true, 'maxSize' => 5242880),
			array('id, employee_category_id, employee_number, joining_date, first_name, middle_name, last_name, gender, job_title, employee_position_id, employee_department_id, reporting_manager_id, employee_grade_id, qualification, experience_detail, experience_year, experience_month, status, status_description, date_of_birth, marital_status, children_count, father_name, mother_name, husband_name, blood_group, nationality_id, home_address_line1, home_address_line2, home_city, home_state, home_country_id, home_pin_code, office_address_line1, office_address_line2, office_city, office_state, office_country_id, office_pin_code, office_phone1, office_phone2, mobile_phone, home_phone, email, fax, photo_file_name, photo_content_type, photo_data, created_at, updated_at, photo_file_size, user_id', 'safe', 'on'=>'search'),			
			array('email','email'),
			array('experience_detail', 'exp_details_validation', 'on' => 'hasExperience'),			
			//array('basic_pay,HRA,PF,TDS,others1,others2,DA', 'match', 'pattern'=>'/([1-9][0-9]*?)(\.[0-9]{2})?/'),
			//array('photo_data', 'file', 'allowEmpty'=>true, 'types'=>'jpg, jpeg, gif, png')
		);
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
	
	//Check the date of birth is less than today
	public function checkDateOfBirth($attribute,$params)
	{
		if($this->$attribute != ''){
			$today			= date('Y-m-d'); 
			$selected_date	= date('Y-m-d', strtotime($this->$attribute));
			if($selected_date >= $today){
				$settings	= UserSettings::model()->findByAttributes(array('user_id'=>1));
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
		if($this->$attribute != ''){
			$student	= StudentsUser::model()->findByAttributes(array('email'=>$this->$attribute,'is_deleted'=>0)); //This model is for checking all Students(Both normal & online)								
			$employee	= Employees::model()->findByAttributes(array('email'=>$this->$attribute,'is_deleted'=>0));
			$parent		= Guardians::model()->findByAttributes(array('email'=>$this->$attribute,'is_delete'=>0));
			$user		= User::model()->findByAttributes(array('email'=>$this->$attribute));
			
			if(($employee != NULL and $employee->id != $this->id) or $student != NULL or $parent != NULL or ($user != NULL and $user->id != $this->uid)){
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
			if(($employee != NULL and $employee->id != $this->id) or $student != NULL or $parent != NULL or ($user != NULL and $user->id != $this->uid)){
				$this->addError($attribute,$this->getAttributeLabel('mobile_phone').' '.'"'.$this->$attribute.'"'.' '.Yii::t('app','has already been taken'));
			}
		}
	}
	
	public function defaultScope()
	{
		return array(
						'condition'=> $this->getTableAlias(false, false).".user_type=:type",
						'params' => array(":type"=>0)
				);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'employee_category_id' => Yii::t("app",'Teacher Category'),
			'employee_number' => Yii::t("app",'Teacher Number'),
			'joining_date' => Yii::t("app",'Joining Date'),
			'first_name' => Yii::t("app",'First Name'),
			'middle_name' => Yii::t("app",'Middle Name'),
			'last_name' => Yii::t("app",'Last Name'),
			'gender' => Yii::t("app",'Gender'),
			'job_title' => Yii::t("app",'Job Title'),
			'employee_position_id' => Yii::t("app",'Teacher Position'),
			'employee_department_id' => Yii::t("app",'Teacher Department'),
			'reporting_manager_id' => Yii::t("app",'Reporting Manager'),
			'employee_grade_id' => Yii::t("app",'Teacher Grade'),
			'qualification' => Yii::t("app",'Qualification'),
			'experience_detail' => Yii::t("app",'Experience Details'),
			'experience_year' => Yii::t("app",'Experience Year'),
			'experience_month' => Yii::t("app",'Experience Month'),
			'status' => Yii::t("app",'Status'),
			'status_description' => Yii::t("app",'Status Description'),
			'date_of_birth' => Yii::t("app",'Date Of Birth'),
			'marital_status' => Yii::t("app",'Marital Status'),
			'children_count' => Yii::t("app",'Children Count'),
			'father_name' => Yii::t("app",'Father Name'),
			'mother_name' => Yii::t("app",'Mother Name'),
			'husband_name' => Yii::t("app",'Spouse Name'),
			'blood_group' => Yii::t("app",'Blood Group'),
			'nationality_id' => Yii::t("app",'Nationality'),
			'home_address_line1' => Yii::t("app",'Home Address Line 1'),
			'home_address_line2' => Yii::t("app",'Home Address Line 2'),
			'home_city' => Yii::t("app",'Home City'),
			'home_state' => Yii::t("app",'Home State'),
			'home_country_id' => Yii::t("app",'Home Country'),
			'home_pin_code' => Yii::t("app",'Home Pin Code'),
			'office_address_line1' => Yii::t("app",'Office Address Line 1'),
			'office_address_line2' => Yii::t("app",'Office Address Line 2'),
			'office_city' => Yii::t("app",'Office City'),
			'office_state' => Yii::t("app",'Office State'),
			'office_country_id' => Yii::t("app",'Office Country'),
			'office_pin_code' => Yii::t("app",'Office Pin Code'),
			'office_phone1' => Yii::t("app",'Office Phone 1'),
			'office_phone2' => Yii::t("app",'Office Phone 2'),
			'mobile_phone' => Yii::t("app",'Mobile Phone'),
			'home_phone' => Yii::t("app",'Home Phone'),
			'email' => Yii::t("app",'Email'),
			'fax' => Yii::t("app",'Fax'),
			'photo_file_name' => Yii::t("app",'Photo File Name'),
			'photo_content_type' => Yii::t("app",'Photo Content Type'),
			'photo_data' => Yii::t("app",'Photo Data'),
			'created_at' => Yii::t("app",'Created At'),
			'updated_at' => Yii::t("app",'Updated At'),
			'photo_file_size' => Yii::t("app",'Photo File Size'),
			'user_id' => Yii::t("app",'User'),
			
			'date_join' => Yii::t("app",'Date of Join'),
			'salary_date' => Yii::t("app",'Salary Date'),
			'bank_name' => Yii::t("app",'Bank Name'),
			'bank_acc_no' => Yii::t("app",'Bank Account No'),
			'basic_pay' => Yii::t("app",'Basic Pay'),
			//'HRA' => Yii::t("app",'HRA'),
			//'PF' => Yii::t("app",'PF'),
			//'TDS' => Yii::t("app",'TDS'),
			'others1' => Yii::t("app",'Others'),
			'others2' => Yii::t("app",'Others'),
			'DA' => Yii::t("app",'DA')
			
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
		$criteria->compare('employee_category_id',$this->employee_category_id);
		$criteria->compare('employee_number',$this->employee_number,true);
		$criteria->compare('joining_date',$this->joining_date,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('employee_position_id',$this->employee_position_id);
		$criteria->compare('employee_department_id',$this->employee_department_id);
		$criteria->compare('reporting_manager_id',$this->reporting_manager_id);
		$criteria->compare('employee_grade_id',$this->employee_grade_id);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('experience_detail',$this->experience_detail,true);
		$criteria->compare('experience_year',$this->experience_year);
		$criteria->compare('experience_month',$this->experience_month);
		$criteria->compare('status',$this->status);
		$criteria->compare('status_description',$this->status_description,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('marital_status',$this->marital_status,true);
		$criteria->compare('children_count',$this->children_count);
		$criteria->compare('father_name',$this->father_name,true);
		$criteria->compare('mother_name',$this->mother_name,true);
		$criteria->compare('husband_name',$this->husband_name,true);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('nationality_id',$this->nationality_id);
		$criteria->compare('home_address_line1',$this->home_address_line1,true);
		$criteria->compare('home_address_line2',$this->home_address_line2,true);
		$criteria->compare('home_city',$this->home_city,true);
		$criteria->compare('home_state',$this->home_state,true);
		$criteria->compare('home_country_id',$this->home_country_id);
		$criteria->compare('home_pin_code',$this->home_pin_code,true);
		$criteria->compare('office_address_line1',$this->office_address_line1,true);
		$criteria->compare('office_address_line2',$this->office_address_line2,true);
		$criteria->compare('office_city',$this->office_city,true);
		$criteria->compare('office_state',$this->office_state,true);
		$criteria->compare('office_country_id',$this->office_country_id);
		$criteria->compare('office_pin_code',$this->office_pin_code,true);
		$criteria->compare('office_phone1',$this->office_phone1,true);
		$criteria->compare('office_phone2',$this->office_phone2,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('home_phone',$this->home_phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('photo_file_name',$this->photo_file_name,true);
		$criteria->compare('photo_content_type',$this->photo_content_type,true);
		$criteria->compare('photo_data',$this->photo_data,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('photo_file_size',$this->photo_file_size);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_type',0);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function exp_validation()
	{
		if($this->experience_year == '' ){
			$this->addError('experience_year', Yii::t("app",'Enter experience details'));
		}
                
                if($this->experience_month == ''){
			$this->addError('experience_month', Yii::t("app",'Enter experience details'));
		}
	}
	
	public function exp_details_validation()
	{
		if(!$this->experience_detail){
			$this->addError('experience_detail', Yii::t("app",'Enter experience details'));
		}
	}
   
	public function getConcatened()
	{
		return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
	}
	
//Employee Profile Image Path
	public function getProfileImagePath($id){
		$model = Employees::model()->findByPk($id);
		$path = 'uploadedfiles/employee_profile_image/'.$model->id.'/'.$model->photo_file_name;	
		return $path;
	}
	
	public function getFullname()
	{		           
		$name = ucfirst($this->first_name).' '.ucfirst($this->middle_name).' '.ucfirst($this->last_name);		   
		return $name;
	}
	public function getTeachername($id,$type = 0)
	{
		$model = Employees::model()->findByPk($id);
		if($type == 0){	           
			$name = ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name);
		}
		if($type == 1){	           
			$name = ucfirst($model->first_name);
		}
		if($type == 2){	           
			$name = ucfirst($model->last_name);
		}
		return $name;
	}					
}