<?php

/**
 * This is the model class for table "class_timings".
 *
 * The followings are the available columns in table 'class_timings':
 * @property integer $id
 * @property integer $batch_id
 * @property string $name
 * @property string $start_time
 * @property string $end_time
 * @property integer $is_break
 */
class ClassTimings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ClassTimings the static model class
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
		return 'class_timings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id, is_break', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('start_time, end_time', 'length', 'max'=>120),
			array('name, start_time, end_time', 'required'),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z0-9_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, batch_id, name, start_time, end_time, is_break', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'is_break' => 'Is Break',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('is_break',$this->is_break);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}