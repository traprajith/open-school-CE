<?php

/**
 * This is the model class for table "weekdays".
 *
 * The followings are the available columns in table 'weekdays':
 * @property integer $id
 * @property integer $batch_id
 * @property string $weekday
 */
class Weekdays extends CActiveRecord
{
	public $sunday;
	public $monday;
	public $tuesday;
	public $wednesday;
	public $thursday;
	public $friday;
	public $saturday;
	public $subject;
	public $mydropdownlist;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Weekdays the static model class
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
		return 'weekdays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id', 'numerical', 'integerOnly'=>true),
			array('weekday', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batch_id, weekday', 'safe', 'on'=>'search'),
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
			'weekday' => 'Weekday',
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
		$criteria->compare('weekday',$this->weekday,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}