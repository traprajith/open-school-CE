<?php

/**
 * This is the model class for table "batches".
 *
 * The followings are the available columns in table 'batches':
 * @property integer $id
 * @property string $name
 * @property integer $course_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $employee_id
 */
class Batches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Batches the static model class
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
		return 'batches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name, employee_id', 'length', 'max'=>25),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			array('name, start_date, end_date', 'required'),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/','message'=>"{attribute} should not contain any special character(s)."),
			// Please remove those attributes that should not be searched.
			array('id, name, course_id, start_date, end_date, is_active, is_deleted, employee_id', 'safe', 'on'=>'search'),
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
		 'course123'=>array(self::BELONGS_TO, 'Courses', 'course_id'),
        
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
			'course_id' => 'Course',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_active' => 'Is Active',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('employee_id',$this->employee_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getval()
	{
		return '"123"';
	}
	 public function getCoursename()
	{
		$course=Courses::model()->findByAttributes(array('id'=>$this->course_id,'is_deleted'=>0));
			return $this->name.' ('.$course->course_name.')';
	}
}