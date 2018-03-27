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
			array('academic_yr_id, exam_format, is_deleted', 'numerical', 'integerOnly'=>true),
			array('course_name, code, section_name', 'length', 'max'=>255),
			array('semester_enabled, created_at, updated_at, timetable_format', 'safe'),
			array('course_name', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course_name, code, section_name, academic_yr_id, exam_format, is_deleted, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'id' => Yii::t("app",'ID'),
			'course_name' => Yii::t("app",'Course Name'),
			'code' => Yii::t("app",'Code'),
			'exam_format' => Yii::t("app",'Exam Format'),
			'section_name' => Yii::t("app",'Section Name'),
			'semester_enabled' => Yii::t("app",'Enable semester system'),
			'academic_yr_id' => Yii::t("app",'Academic Year ID'),
			'is_deleted' => Yii::t("app",'Is Deleted'),
			'created_at' => Yii::t("app",'Created At'),
			'updated_at' => Yii::t("app",'Updated At'),
			'timetable_format' => Yii::t('app', 'Timetable Format')
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	  public function getCoursename()
	{
		$CHtmlPurifier = new CHtmlPurifier();
		$CHtmlPurifier->options = array('HTML.ForbiddenElements' => array('&amp;'));
		$this->course_name = $CHtmlPurifier->purify($this->course_name);
		
			return htmlspecialchars_decode($this->course_name);exit;
	}
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('course_name',$this->course_name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('exam_format',$this->exam_format,true);
		$criteria->compare('section_name',$this->section_name,true);
		$criteria->compare('academic_yr_id',$this->academic_yr_id,true);
		$criteria->compare('is_deleted',0);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}