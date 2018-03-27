<?php

/**
 * This is the model class for table "subjects_common_pool".
 *
 * The followings are the available columns in table 'subjects_common_pool':
 * @property integer $id
 * @property integer $course_id
 * @property string $subject_name
 * @property string $subject_code
 * @property integer $max_weekly_classes
 */
class SubjectsCommonPool extends CActiveRecord
{
	public $all_batches; 
	public $subject_tilte1;
	public $subject_tilte2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return SubjectsCommonPool the static model class
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
		return 'subjects_common_pool';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, subject_name, max_weekly_classes', 'required'),
			array('course_id, max_weekly_classes', 'numerical', 'integerOnly'=>true),
			array('max_weekly_classes', 'numerical', 'integerOnly'=>true,'min'=>1,'max'=>100),
			array('subject_name, subject_code', 'length', 'max'=>70),
		//	array('subject_name,subject_code','unique'),
			array('subject_name','subjectCheck'),
			array('subject_code','codeCheck'),
			array('subject_tilte1','checkSubject1'),
			array('subject_tilte2','checkSubject2'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, course_id, subject_name, subject_code, max_weekly_classes,split_subject,subject_tilte1,subject_tilte2', 'safe', 'on'=>'search'),
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
			'course_id' => Yii::t('app','Course'),
			'subject_name' => Yii::t('app','Subject Name'),
			'subject_code' => Yii::t('app','Subject Code'),
			'max_weekly_classes' => Yii::t('app','Maximum Weekly Classes'), 
			'subject_tilte1' => Yii::t('app','First Sub Category'),
			'subject_tilte2' => Yii::t('app','Second Sub Category '),
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
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('subject_name',$this->subject_name,true);
		$criteria->compare('subject_code',$this->subject_code,true);
		$criteria->compare('max_weekly_classes',$this->max_weekly_classes);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function checkSubject1($attribute,$params)
	{
		if($this->split_subject!="" and $this->split_subject!=0){ 
			if($this->subject_tilte1=='')
				$this->addError($attribute,$this->getAttributeLabel($attribute).' '.Yii::t("app",'cannot be blank.'));
		}
	}
	public function checkSubject2($attribute,$params)
	{
		if($this->split_subject!="" and $this->split_subject!=0){ 
			if($this->subject_tilte2=='')
				$this->addError($attribute,$this->getAttributeLabel($attribute).' '.Yii::t("app",'cannot be blank.'));
		}
	}
	public function subjectCheck($attribute,$params)
	{
		if($this->course_id!='' and $this->subject_name!=''){ 
				$subject_common	=	SubjectsCommonPool::findByAttributes(array('subject_name'=>$this->subject_name));
				if($this->id !=$subject_common->id and $this->course_id == $subject_common->course_id){
					$this->addError($attribute,$this->getAttributeLabel($attribute).' "'.$this->subject_name.'" '.Yii::t("app",'has already been taken in this course.'));
				}
		}
	}
	public function codeCheck($attribute,$params)
	{
		if($this->course_id!='' and $this->subject_code!=''){ 
				$subject_common	=	SubjectsCommonPool::findByAttributes(array('subject_code'=>$this->subject_code));
				if($this->id !=$subject_common->id and  $this->course_id == $subject_common->course_id){
					$this->addError($attribute,$this->getAttributeLabel($attribute).' "'.$this->subject_name.'" '.Yii::t("app",'has already been taken in this course.'));
				}
		}
	}
	
	
}