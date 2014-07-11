<?php

/**
 * This is the model class for table "attendances".
 *
 * The followings are the available columns in table 'attendances':
 * @property integer $id
 * @property integer $student_id
 * @property integer $period_table_entry_id
 * @property integer $forenoon
 * @property integer $afternoon
 * @property string $reason
 */
class Attendances extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Attendances the static model class
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
		return 'attendances';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, period_table_entry_id, forenoon, afternoon', 'numerical', 'integerOnly'=>true),
			array('reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, period_table_entry_id, forenoon, afternoon, reason', 'safe', 'on'=>'search'),
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
			'period_table_entry_id' => 'Period Table Entry',
			'forenoon' => 'Forenoon',
			'afternoon' => 'Afternoon',
			'reason' => 'Reason',
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
		$criteria->compare('period_table_entry_id',$this->period_table_entry_id);
		$criteria->compare('forenoon',$this->forenoon);
		$criteria->compare('afternoon',$this->afternoon);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}