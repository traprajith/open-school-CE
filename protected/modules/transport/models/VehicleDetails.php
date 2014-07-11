<?php

/**
 * This is the model class for table "vehicle_details".
 *
 * The followings are the available columns in table 'vehicle_details':
 * @property integer $id
 * @property string $vehicle_no
 * @property string $vehicle_code
 * @property string $no_of_seats
 * @property string $maximum_capacity
 * @property string $vehicle_type
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $phone
 * @property string $insurance
 * @property string $tax_remitted
 * @property string $permit
 */
class VehicleDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VehicleDetails the static model class
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
		return 'vehicle_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_no, vehicle_code, no_of_seats, maximum_capacity', 'required'),
			array('no_of_seats,maximum_capacity', 'numerical', 'integerOnly'=>true),
			array('vehicle_no, vehicle_code, no_of_seats, maximum_capacity, vehicle_type, address, city, state, phone, insurance, tax_remitted, permit,status', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			
			
			array('id, vehicle_no, vehicle_code, no_of_seats, maximum_capacity, vehicle_type, address, city, state, phone, insurance, tax_remitted, permit,  status', 'safe', 'on'=>'search'),
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
			'vehicle_no' => 'Vehicle No',
			'vehicle_code' => 'Vehicle Code',
			'no_of_seats' => 'No Of Seats',
			'maximum_capacity' => 'Maximum Capacity',
			'vehicle_type' => 'Vehicle Type',
			'address' => 'Address',
			'city' => 'City',
			'state' => 'State',
			'phone' => 'Phone',
			'insurance' => 'Insurance',
			'tax_remitted' => 'Tax Remitted',
			'permit' => 'Permit',
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
		$criteria->compare('vehicle_no',$this->vehicle_no,true);
		$criteria->compare('vehicle_code',$this->vehicle_code,true);
		$criteria->compare('no_of_seats',$this->no_of_seats,true);
		$criteria->compare('maximum_capacity',$this->maximum_capacity,true);
		$criteria->compare('vehicle_type',$this->vehicle_type,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('insurance',$this->insurance,true);
		$criteria->compare('tax_remitted',$this->tax_remitted,true);
		$criteria->compare('permit',$this->permit,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}