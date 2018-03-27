<?php

/**
 * This is the model class for table "driver_details".
 *
 * The followings are the available columns in table 'driver_details':
 * @property integer $id
 * @property string $vehicle_id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $dob
 * @property string $license_no
 * @property string $expiry_date
 */
class DriverDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DriverDetails the static model class
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
		return 'driver_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
			return array(
				array('first_name, last_name, phn_no, license_no ,expiry_date, dob', 'required'),
				array('vehicle_id, first_name, last_name, address, dob, license_no,status', 'length', 'max'=>120),
				array('expiry_date', 'safe'),
				array('phn_no', 'numerical', 'integerOnly'=>true),
				array('phn_no','unique'),
				array('license_no','unique'),
				array('dob', 'dobvalid'),
				array('expiry_date', 'checkexp'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
				array('id, vehicle_id, first_name, last_name, address, phn_no, dob, license_no, expiry_date, status', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_id' =>  Yii::t('app','Vehicle'),
			'first_name' =>  Yii::t('app','First name'),
			'last_name' =>  Yii::t('app','Last Name'),
			'address' =>  Yii::t('app','Address'),
			'phn_no'=> Yii::t('app','Phone Number'),
			'dob' =>  Yii::t('app','Dob'),
			'age' =>  Yii::t('app','Age'),
			'license_no' =>  Yii::t('app','License No'),
			'expiry_date' =>  Yii::t('app','Expiry Date'),
			'status' =>  Yii::t('app','Status'),
			
			
			
			
			
			
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
		$criteria->compare('vehicle_id',$this->vehicle_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('license_no',$this->license_no,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function checkexp($attribute, $params){
		$date	= date("Y-m-d", strtotime($this->$attribute));
		$today	= date("Y-m-d");
		if($date<=$today){
			$this->addError($attribute, Yii::t("app", "Expiry date should be a date greater than today's date"));
		}
	}
	
	public function dobvalid($attribute, $params){
		$dob 	= new DateTime($this->$attribute);
		$today	= new DateTime('today');
		$age	= $dob->diff($today)->y;
		if($age<18){
			$this->addError($attribute, Yii::t("app", "Can't accept your date of birth.The minimum age will be 18"));
		}
	}
	
	public function getAge(){
		$dob 	= new DateTime($this->dob);
		$today	= new DateTime('today');
		$age	= $dob->diff($today)->y;
		return $age;
	}
}