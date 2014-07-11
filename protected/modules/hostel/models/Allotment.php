<?php

/**
 * This is the model class for table "allotment".
 *
 * The followings are the available columns in table 'allotment':
 * @property integer $id
 * @property string $student_id
 * @property string $bed_no
 * @property string $room_no
 * @property string $floor
 * @property string $status
 */
class Allotment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Allotment the static model class
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
		return 'allotment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, bed_no, room_no, floor, status, created', 'length', 'max'=>120),
			//array('student_id','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, bed_no, room_no, floor, status, created', 'safe', 'on'=>'search'),
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
			'student_id' => 'Student',
			'bed_no' => 'Bed No',
			'room_no' => 'Room No',
			'floor' => 'Floor',
			'status' => 'Status',
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
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('bed_no',$this->bed_no,true);
		$criteria->compare('room_no',$this->room_no,true);
		$criteria->compare('floor',$this->floor,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}