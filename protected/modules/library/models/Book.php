<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property string $isbn
 * @property string $title
 * @property string $subject
 * @property string $category
 * @property string $author
 * @property string $edition
 * @property string $publisher
 * @property integer $copy
 * @property string $book_position
 * @property string $shelf_no
 * @property string $date
 * @property string $status
 */
class Book extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Book the static model class
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
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isbn,title, subject, category, author', 'required'),
			array('isbn,shelf_no', 'numerical', 'integerOnly'=>true),
			array('isbn, book_position, shelf_no, status, copy_taken', 'length', 'max'=>120),
			array('title, subject, category, author, edition, publisher', 'length', 'max'=>255),
			array('date', 'safe'),
			array('copy','CRegularExpressionValidator', 'pattern'=>'/^[1-9]\d{0,2}$/','message'=>"{attribute} should contain only positive integers."),
			array('title','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, isbn, title, subject, category, author, edition, publisher, copy,copy_taken, book_position, shelf_no, date, status', 'safe', 'on'=>'search'),
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
			'isbn' => 'Isbn',
			'title' => 'Title',
			'subject' => 'Subject',
			'category' => 'Category',
			'author' => 'Author',
			'edition' => 'Edition',
			'publisher' => 'Publisher',
			'copy' => 'Copy',
			'copy_taken' => 'Copy Remaining',
			'book_position' => 'Book Position',
			'shelf_no' => 'Shelf No',
			'date' => 'Date',
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
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('edition',$this->edition,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('copy',$this->copy);
		$criteria->compare('copy_taken',$this->copy_taken);
		$criteria->compare('book_position',$this->book_position,true);
		$criteria->compare('shelf_no',$this->shelf_no,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}