<?php

/**
 * This is the model class for table "timetable_entries".
 *
 * The followings are the available columns in table 'timetable_entries':
 * @property integer $id
 * @property integer $batch_id
 * @property integer $weekday_id
 * @property integer $class_timing_id
 * @property integer $subject_id
 * @property integer $employee_id
 */
class TimetableEntries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TimetableEntries the static model class
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
		return 'timetable_entries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('batch_id, weekday_id, subject_id, employee_id', 'required'),
			array('batch_id, weekday_id, class_timing_id, subject_id, employee_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batch_id, weekday_id, class_timing_id, subject_id, employee_id', 'safe', 'on'=>'search'),
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
			'batch_id' => 'Batch',
			'weekday_id' => 'Weekday',
			'class_timing_id' => 'Class Timing',
			'subject_id' => 'Subject',
			'employee_id' => 'Employee',
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
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('weekday_id',$this->weekday_id);
		$criteria->compare('class_timing_id',$this->class_timing_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('employee_id',$this->employee_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}