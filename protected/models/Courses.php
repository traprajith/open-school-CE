<?php

/**
 * This is the model class for table "courses".
 *
 * The followings are the available columns in table 'courses':
 * @property integer $id
 * @property string $course_name
 * @property string $code
 * @property string $section_name
 * @property integer $is_deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Courses extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Courses the static model class
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
		return 'courses';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('course_name, code, section_name', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			array('course_name, code, section_name', 'required'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course_name, code, section_name, is_deleted, created_at, updated_at', 'safe', 'on'=>'search'),
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
		
         //'courses'=>array(self::HAS_ONE, 'Courses', 'id'),
		 
		 'batches'=>array(self::HAS_MANY, 'Batches', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'course_name' => 'Course Name',
			'code' => 'Code',
			'section_name' => 'Section Name',
			'is_deleted' => 'Is Deleted',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('course_name',$this->course_name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('section_name',$this->section_name,true);
		$criteria->compare('is_deleted',0);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}