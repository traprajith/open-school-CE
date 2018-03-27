<?php

/**
 * This is the model class for table "coursemanager".
 *
 * The followings are the available columns in table 'coursemanager':
 * @property integer $id
 * @property integer $user_id
 * @property string $course_1
 * @property string $course_2
 * @property string $course_3
 * @property string $course_4
 * @property string $course_5
 * @property integer $is_deleted
 */
class Coursemanager extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Coursemanager the static model class
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
		return 'coursemanager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,course', 'required'),
			array('user_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('course', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, course,  is_deleted', 'safe', 'on'=>'search'),
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
			'id' => Yii::t("app",'ID'),
			'user_id' => Yii::t("app",'User'),
			'course' => Yii::t("app",'Course 1'),
			'is_deleted' => Yii::t("app",'Is Deleted'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('course',$this->course_1,true);
		
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}