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
 * @property string $age
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
		array('first_name, last_name, license_no ,expiry_date, dob', 'required'),
			array('vehicle_id, first_name, last_name, address, dob, age, license_no,status', 'length', 'max'=>120),
			array('expiry_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, first_name, last_name, address, dob, age, license_no, expiry_date, status', 'safe', 'on'=>'search'),
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
			'vehicle_id' => 'Vehicle',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'address' => 'Address',
			'dob' => 'Dob',
			'age' => 'Age',
			'license_no' => 'License No',
			'expiry_date' => 'Expiry Date',
			'status' => 'Status',
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
		$criteria->compare('age',$this->age,true);
		$criteria->compare('license_no',$this->license_no,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}