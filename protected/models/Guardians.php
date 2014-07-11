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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ward_id, country_id,office_phone1, office_phone2, mobile_phone,income,uid', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, relation, email, office_phone1, office_phone2, mobile_phone, office_address_line1, office_address_line2, city, state, occupation, income, education', 'length', 'max'=>255),
			array('first_name, last_name, relation,mobile_phone,email', 'required'),
			array('email','check'),
			array('email', 'email'),
			array('dob, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ward_id, first_name, last_name, relation, email, office_phone1, office_phone2, mobile_phone, office_address_line1, office_address_line2, city, state, country_id, dob, occupation, income, education, created_at, updated_at', 'safe', 'on'=>'search'),
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
		 'emergency'=>array(self::BELONGS_TO, 'Students', 'id'),
		);
	}
	
	public function check($attribute,$params)
    {
		if(Yii::app()->controller->action->id!='update' and $this->$attribute!='')
		{
		$validate = User::model()->findByAttributes(array('email'=>$this->$attribute));
		if($validate!=NULL)
		{
        
            $this->addError($attribute,'Email allready in use');
		}
		}
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ward_id' => 'Ward',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'relation' => 'Relation',
			'email' => 'Email',
			'office_phone1' => 'Office Phone1',
			'office_phone2' => 'Office Phone2',
			'mobile_phone' => 'Mobile Phone',
			'office_address_line1' => 'Office Address Line1',
			'office_address_line2' => 'Office Address Line2',
			'city' => 'City',
			'state' => 'State',
			'country_id' => 'Country',
			'dob' => 'Dob',
			'occupation' => 'Occupation',
			'income' => 'Income',
			'education' => 'Education',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function studentname($data,$row)
	{
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
	
	function parentname($data,$row)
	{
		//$posts=Students::model()->findByAttributes(array('id'=>$data->ward_id));
		return ucfirst($data->first_name).' '.ucfirst($data->last_name);	
	}
}