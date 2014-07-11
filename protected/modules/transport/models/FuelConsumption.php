<?php

/**
 * This is the model class for table "fuel_consumption".
 *
 * The followings are the available columns in table 'fuel_consumption':
 * @property integer $id
 * @property string $vehicle_id
 * @property string $fuel_consumed
 * @property string $amount
 * @property string $date
 */
class FuelConsumption extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FuelConsumption the static model class
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
		return 'fuel_consumption';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id, fuel_consumed, amount', 'length', 'max'=>120),
			array('consumed_date', 'safe'),
			array('fuel_consumed,amount', 'numerical', 'integerOnly'=>true),
			array('fuel_consumed,amount,consumed_date', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, fuel_consumed, amount, consumed_date', 'safe', 'on'=>'search'),
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
			'fuel_consumed' => 'Fuel Consumed',
			'amount' => 'Amount',
			'consumed_date' => 'Date',
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
		$criteria->compare('fuel_consumed',$this->fuel_consumed,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('consumed_date',$this->consumed_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}