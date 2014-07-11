<?php

/**
 * This is the model class for table "period_entries".
 *
 * The followings are the available columns in table 'period_entries':
 * @property integer $id
 * @property string $month_date
 * @property integer $batch_id
 * @property integer $subject_id
 * @property integer $class_timing_id
 * @property integer $employee_id
 */
class PeriodEntries extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PeriodEntries the static model class
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
		return 'period_entries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id, subject_id, class_timing_id, employee_id', 'numerical', 'integerOnly'=>true),
			array('month_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, month_date, batch_id, subject_id, class_timing_id, employee_id', 'safe', 'on'=>'search'),
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
			'month_date' => 'Month Date',
			'batch_id' => 'Batch',
			'subject_id' => 'Subject',
			'class_timing_id' => 'Class Timing',
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
		$criteria->compare('month_date',$this->month_date,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('class_timing_id',$this->class_timing_id);
		$criteria->compare('employee_id',$this->employee_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}