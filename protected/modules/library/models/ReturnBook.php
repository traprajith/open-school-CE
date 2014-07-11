<?php

/**
 * This is the model class for table "return_book".
 *
 * The followings are the available columns in table 'return_book':
 * @property integer $id
 * @property string $student_id
 * @property string $book_id
 * @property string $borrow_book_id
 * @property string $issue_date
 * @property string $return_date
 * @property string $created_date
 * @property string $status
 */
class ReturnBook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ReturnBook the static model class
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
		return 'return_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('return_date', 'required'),
			array('student_id, book_id, borrow_book_id, status', 'length', 'max'=>120),
			array('issue_date, return_date, created_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, book_id, borrow_book_id, issue_date, return_date, created_date, status', 'safe', 'on'=>'search'),
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
			'book_id' => 'Book',
			'borrow_book_id' => 'Borrow Book',
			'issue_date' => 'Issue Date',
			'return_date' => 'Return Date',
			'created_date' => 'Created Date',
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
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('borrow_book_id',$this->borrow_book_id,true);
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('return_date',$this->return_date,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}