<?php

/**
 * This is the model class for table "floor".
 *
 * The followings are the available columns in table 'floor':
 * @property integer $id
 * @property string $floor_no
 * @property string $created
 */
class Floor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Floor the static model class
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
		return 'floor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hostel_id, floor_no, no_of_rooms', 'required'),
			array('hostel_id, floor_no,no_of_rooms, created', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hostel_id, floor_no,no_of_rooms, created', 'safe', 'on'=>'search'),
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
			'hostel_id' => 'Hostel ID',
			'floor_no' => 'Floor No',
			'no_of_rooms' => 'No Of Rooms',
			'created' => 'Created',
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
		$criteria->compare('hostel_id',$this->hostel_id);
		$criteria->compare('floor_no',$this->floor_no,true);
		$criteria->compare('no_of_rooms',$this->no_of_rooms,true);
		
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	 public function getHostelname()
	{
		$hostel=Hosteldetails::model()->findByAttributes(array('id'=>$this->hostel_id,'is_deleted'=>0));
			return $this->floor_no.' ('.$hostel->hostel_name.')';
	}
}