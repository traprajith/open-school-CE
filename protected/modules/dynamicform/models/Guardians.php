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
		if (!$this->_rules) {
			$required = array();
			$numerical = array();					
			$decimal = array();
			$rules = array();
			
			$model=$this->getFields();
			
			foreach ($model as $field) {
				$field_rule = array();
				if ($field->required == FormFields::REQUIRED_YES)
					array_push($required,$field->varname);				
				if ($field->field_type == 'DECIMAL')
					array_push($decimal,$field->varname);
				if ($field->field_type == 'INTEGER')
					array_push($numerical,$field->varname);
				if ($field->field_type == 'VARCHAR'||$field->field_type=='TEXT') {
					$field_rule = array($field->varname, 'length', 'max'=>$field->field_size, 'min' => $field->field_size_min);
					if ($field->error_message) $field_rule['message'] = Yii::t('app',$field->error_message);
					array_push($rules,$field_rule);
				}								
			}			
			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));			
			array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));
			array_push($rules,array('email','email'));
			array_push($rules,array('email','unique'));
			array_push($rules,array('email','check'));
			array_push($rules,array('relation_other','check_relation'));
			
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
		if($this->relation=='Others')
		{
			if($this->relation_other==" ")
			{
				$this->addError('relation_other', Yii::t("app","Relation Cannot be Blank"));
			}
		}
	}
        
	//check the email is unique
	public function check($attribute,$params)
    {	            				
		$student= Students::model()->findByAttributes(array('email'=>$this->$attribute));
		$employee= Employees::model()->findByAttributes(array('email'=>$this->$attribute));
		$validate = User::model()->findByAttributes(array('email'=>$this->$attribute));
		if($this->$attribute!=''){
			if(($validate!=NULL and $validate->id!=$this->uid) or $employee!=NULL or $student!=NULL){
				$this->addError($attribute,Yii::t("app",'Email ').'"'.$this->$attribute.'"'.Yii::t('app',' has already been taken'));
			}
		}                               
    }
	//check the phone number is unique
	public function check_phone($attribute,$params)
    {
		
		$student= Students::model()->findByAttributes(array('phone1'=>$this->$attribute));
		$employee= Employees::model()->findByAttributes(array('mobile_phone'=>$this->$attribute));
		$parent= Guardians::model()->findByAttributes(array('mobile_phone'=>$this->$attribute));
		
		if(Yii::app()->controller->action->id!='update' and $this->$attribute!='')
		{
			
			if($student!=NULL or $employee!=NULL or $parent!=NULL)
			{
			
				$this->addError($attribute,Yii::t("app",'Mobile Phone already in use'));
			}
		}
		elseif(Yii::app()->controller->action->id == 'update' and $this->$attribute!='')
		{
			if($student!=NULL or $employee!=NULL or $parent!=NULL)
			{
				if($parent->id != $this->id)
					$this->addError($attribute,Yii::t("app",'Mobile Phone already in use'));
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
			'ward_id' => Yii::t("app",'Ward'),
			'relation_other'=>Yii::t("app",'Specify Relation')
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

		$criteria->compare('id',$this->id);
                
		$criteria->compare('ward_id',$this->ward_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('relation',$this->relation,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('office_phone1',$this->office_phone1,true);
		$criteria->compare('office_phone2',$this->office_phone2,true);
		$criteria->compare('mobile_phone',$this->mobile_phone,true);
		$criteria->compare('office_address_line1',$this->office_address_line1,true);
		$criteria->compare('office_address_line2',$this->office_address_line2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('occupation',$this->occupation,true);
		$criteria->compare('income',$this->income,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('is_delete',0,true);
		

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
		//$posts=Students::model()->findByAttributes(array('id'=>$data->ward_id));
                return CHtml::link(ucfirst($data->first_name).' '.ucfirst($data->last_name), array('/students/guardians/view','id'=>$data->id));
		//return ucfirst($data->first_name).' '.ucfirst($data->last_name);	
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
		if(Yii::app()->controller->module->id == 'students'){
			$this->_modelReg=ProfileField::model()->forAdminRegistration()->findAll();
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$this->_model=ProfileField::model()->forOnlineRegistration()->findAll();
		}
			
	}	
		
}