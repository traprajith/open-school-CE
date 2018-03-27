<?php

/**
 * This is the model class for table "student_electives".
 *
 * The followings are the available columns in table 'student_electives':
 * @property integer $id
 * @property integer $student_id
 * @property integer $batch_id
 * @property integer $elective_id
 * @property integer $status
 * @property string $created
 */
class StudentElectives extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StudentElectives the static model class
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
		return 'student_electives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('student_id, batch_id, elective_id, elective_group_id, status', 'numerical', 'integerOnly'=>true),
			array('created', 'safe'),
			array('student_id, elective_id, elective_group_id','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, batch_id, elective_id, status, created', 'safe', 'on'=>'search'),
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
			'student_id' => Yii::t("app",'Student'),
			'batch_id' => Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),
			'elective_id' => Yii::t("app",'Elective'),
			'status' => Yii::t("app",'Status'),
			'created' => Yii::t("app",'Created'),
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
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('elective_id',$this->elective_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}