<?php

/**
 * This is the model class for table "stop_details".
 *
 * The followings are the available columns in table 'stop_details':
 * @property integer $id
 * @property integer $route_id
 * @property string $stop_name
 * @property string $fare
 * @property string $arrival_mrng
 * @property string $departure_mrng
 * @property string $arrival_evng
 * @property string $departure_evng
 */
class StopDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StopDetails the static model class
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
		return 'stop_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id,fare', 'numerical', 'integerOnly'=>true),
			array('stop_name, fare, arrival_mrng, departure_mrng, arrival_evng, departure_evng', 'length', 'max'=>120),
			//array('stop_name, fare, arrival_mrng, arrival_evng', 'check'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route_id, stop_name, fare, arrival_mrng, departure_mrng, arrival_evng, departure_evng', 'safe', 'on'=>'search'),
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
			'route_id' => 'Route',
			'stop_name' => 'Stop Name',
			'fare' => 'Fare',
			'arrival_mrng' => 'Morning Arrival',
			'departure_mrng' => 'Departure Mrng',
			'arrival_evng' => 'Evening Arrival',
			'departure_evng' => 'Departure Evng',
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
		$criteria->compare('route_id',$this->route_id);
		$criteria->compare('stop_name',$this->stop_name,true);
		$criteria->compare('fare',$this->fare,true);
		$criteria->compare('arrival_mrng',$this->arrival_mrng,true);
		$criteria->compare('departure_mrng',$this->departure_mrng,true);
		$criteria->compare('arrival_evng',$this->arrival_evng,true);
		$criteria->compare('departure_evng',$this->departure_evng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*public function check($attribute,$params){
		$count = count($this->$attribute);
		for($i=0;$i<$count;$i++){
			if(!$this->$attribute[$i]){
				$this->addError($attribute[$i], 'This field cannot be blank');
			}
		}
	}
*/}