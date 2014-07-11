<?php

/**
 * This is the model class for table "exam_groups".
 *
 * The followings are the available columns in table 'exam_groups':
 * @property integer $id
 * @property string $name
 * @property integer $batch_id
 * @property string $exam_type
 * @property integer $is_published
 * @property integer $result_published
 * @property string $exam_date
 */
class ExamGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ExamGroups the static model class
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
		return 'exam_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id, is_published, result_published', 'numerical', 'integerOnly'=>true),
			array('name, exam_type', 'length', 'max'=>25),
			array('exam_date', 'safe'),			
			array('exam_type,name,exam_date', 'required'),
			array('exam_date','type','type' =>'datetime','dateFormat' => 'Y-m-d','message' => "{attribute}: is not a date!"),                   
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, batch_id, exam_type, is_published, result_published, exam_date', 'safe', 'on'=>'search'),
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
			'batch_id' => 'Batch',
			'exam_type' => 'Exam Type',
			'is_published' => 'Is Published',
			'result_published' => 'Result Published',
			'exam_date' => 'Exam Date',
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
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('exam_type',$this->exam_type,true);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('result_published',$this->result_published);
		$criteria->compare('exam_date',$this->exam_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}