<?php

/**
 * This is the model class for table "mess_fee".
 *
 * The followings are the available columns in table 'mess_fee':
 * @property integer $id
 * @property string $student_id
 * @property string $allotment_id
 * @property string $is_paid
 * @property string $created
 */
class MessFee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return MessFee the static model class
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
		return 'mess_fee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, allotment_id, is_paid, status', 'length', 'max'=>120),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, allotment_id, is_paid, created, status', 'safe', 'on'=>'search'),
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
			'student_id' => 'Student',
			'allotment_id' => 'Allotment',
			'is_paid' => 'Is Paid',
			'created' => 'Created',
			'status' => 'Status',
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
		$criteria->compare('student_id',$this->student_id,true);
		$criteria->compare('allotment_id',$this->allotment_id,true);
		$criteria->compare('is_paid',$this->is_paid,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}