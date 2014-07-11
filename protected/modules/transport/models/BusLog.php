<?php

/**
 * This is the model class for table "bus_log".
 *
 * The followings are the available columns in table 'bus_log':
 * @property integer $id
 * @property string $vehicle_id
 * @property string $start_time_reading
 * @property string $end_time_reading
 * @property string $fuel_consumption
 */
class BusLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BusLog the static model class
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
		return 'bus_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		array('vehicle_id,start_time_reading,end_time_reading','required'),
		array('start_time_reading,end_time_reading', 'numerical', 'integerOnly'=>true),
			array('vehicle_id, start_time_reading, end_time_reading, fuel_consumption', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, start_time_reading, end_time_reading, fuel_consumption', 'safe', 'on'=>'search'),
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
			'start_time_reading' => 'Start Time Reading',
			'end_time_reading' => 'End Time Reading',
			'fuel_consumption' => 'Fuel Consumption',
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
		$criteria->compare('start_time_reading',$this->start_time_reading,true);
		$criteria->compare('end_time_reading',$this->end_time_reading,true);
		$criteria->compare('fuel_consumption',$this->fuel_consumption,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}