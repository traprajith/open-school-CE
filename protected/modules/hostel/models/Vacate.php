<?php

/**
 * This is the model class for table "vacate".
 *
 * The followings are the available columns in table 'vacate':
 * @property integer $id
 * @property integer $student_id
 * @property string $room_no
 * @property string $allot_id
 * @property string $status
 * @property string $vacate_date
 */
class Vacate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Vacate the static model class
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
		return 'vacate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id', 'numerical', 'integerOnly'=>true),
			array('room_no, allot_id, status, admit_date', 'length', 'max'=>120),
			array('vacate_date , admit_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, room_no, allot_id, status, vacate_date , admit_date', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app','ID'),
			'student_id' => Yii::t('app','Student'),
			'room_no' => Yii::t('app','Room No'),
			'allot_id' => Yii::t('app','Allot'),
			'status' => Yii::t('app','Status'),
			'admit_date' => Yii::t('app','Admission Date'),
			'vacate_date' => Yii::t('app','Vacate Date'),
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
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('room_no',$this->room_no,true);
		$criteria->compare('allot_id',$this->allot_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('admit_date',$this->admit_date,true);
		$criteria->compare('vacate_date',$this->vacate_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}