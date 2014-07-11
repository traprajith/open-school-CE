<?php

/**
 * This is the model class for table "route_details".
 *
 * The followings are the available columns in table 'route_details':
 * @property integer $id
 * @property string $route_name
 * @property string $vehicle_id
 */
class RouteDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RouteDetails the static model class
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
		return 'route_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_name, no_of_stops, vehicle_id', 'required'),
			array('no_of_stops', 'numerical', 'integerOnly'=>true),
			array('route_name, no_of_stops, vehicle_id', 'length', 'max'=>120),
			array('route_name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route_name, no_of_stops, vehicle_id', 'safe', 'on'=>'search'),
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
			'route_name' => 'Route Name',
			'no_of_stops' => 'No Of Stops',
			'vehicle_id' => 'Vehicle',
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
		$criteria->compare('route_name',$this->route_name,true);
		$criteria->compare('no_of_stops',$this->no_of_stops,true);
		$criteria->compare('vehicle_id',$this->vehicle_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}