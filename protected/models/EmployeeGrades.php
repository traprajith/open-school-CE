<?php

/**
 * This is the model class for table "employee_grades".
 *
 * The followings are the available columns in table 'employee_grades':
 * @property integer $id
 * @property string $name
 * @property integer $priority
 * @property integer $status
 * @property integer $max_hours_day
 * @property integer $max_hours_week
 */
class EmployeeGrades extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EmployeeGrades the static model class
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
		return 'employee_grades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('priority, status, max_hours_day, max_hours_week', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			array('max_hours_day,max_hours_week', 'length', 'max'=>10),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			array('name, priority, status', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, priority, status, max_hours_day, max_hours_week', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'priority' => 'Priority',
			'status' => 'Status',
			'max_hours_day' => 'Max Hours Day',
			'max_hours_week' => 'Max Hours Week',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('status',$this->status);
		$criteria->compare('max_hours_day',$this->max_hours_day);
		$criteria->compare('max_hours_week',$this->max_hours_week);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}