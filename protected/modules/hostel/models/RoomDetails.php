<?php

/**
 * This is the model class for table "room_details".
 *
 * The followings are the available columns in table 'room_details':
 * @property integer $id
 * @property string $room_no
 * @property string $no_of_bed
 * @property string $no_of_floors
 * @property string $mode_of_allotment
 * @property string $created
 * @property string $status
 */
class RoomDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RoomDetails the static model class
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
		return 'room_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_no, bed_no, no_of_floors, mode_of_allotment, status', 'length', 'max'=>120),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, room_no ,bed_no, no_of_floors, mode_of_allotment, created, status', 'safe', 'on'=>'search'),
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
			'room_no' => 'Room No',
			 'bed_no' => 'Bed No',
			'no_of_floors' => 'No Of Floors',
			'mode_of_allotment' => 'Mode Of Allotment',
			'created' => 'Created',
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
		$criteria->compare('room_no',$this->room_no);
		$criteria->compare('bed_no',$this->bed_no,true);
		$criteria->compare('no_of_floors',$this->no_of_floors,true);
		$criteria->compare('mode_of_allotment',$this->mode_of_allotment,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}