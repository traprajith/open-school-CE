<?php

/**
 * This is the model class for table "borrow_book".
 *
 * The followings are the available columns in table 'borrow_book':
 * @property integer $id
 * @property string $student_id
 * @property string $book_name
 * @property string $book_id
 * @property string $issue_date
 * @property string $due_date
 * @property string $created
 * @property string $status
 */
class BorrowBook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BorrowBook the static model class
	 */
	 public $student_admission_no;
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'borrow_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(Yii::app()->controller->action->id == 'create'  and  Yii::app()->controller->id == 'borrowBook')
		{
			return array(
			array('student_admission_no,subject, book_name, issue_date, due_date', 'required'),
			array('student_admission_no', 'numerical', 'integerOnly'=>true),
			array('student_admission_no,subject, book_name, issue_date, due_date, student_id, book_name, subject, book_id, status', 'length', 'max'=>120),
			array('issue_date, due_date, created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, book_name, subject, book_id, issue_date, due_date, created, status', 'safe', 'on'=>'search'),
		);
		}
		else
		{
			return array(
			array('student_id', 'required'),
			array('student_id', 'length', 'max'=>120),
			);
		}
		
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
			'student_id' => 'Student ',
			'book_name' => 'Book Name',
			'subject' => 'Subject',
			'book_id' => 'Book',
			'issue_date' => 'Issue Date',
			'due_date' => 'Due Date',
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
		$criteria->compare('book_name',$this->book_name,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
   }
}