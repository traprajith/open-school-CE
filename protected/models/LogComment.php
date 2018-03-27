<?php

/**
 * This is the model class for table "log_comment".
 *
 * The followings are the available columns in table 'log_comment':
 * @property integer $id
 * @property string $created_by
 * @property string $student_id
 * @property string $comment
 * @property string $date
 * @property integer $notice_p1
 * @property integer $notice_p2
 * @property integer $visible_p
 * @property integer $visible_t
 * @property integer $visible_s
 */
class LogComment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LogComment the static model class
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
		return 'log_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, user_id,user_type, comment, date,category_id', 'required'),
			array('created_by, user_id,user_type, date', 'length', 'max'=>20),
			array('comment', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_by, user_id,user_type, comment, date,category_id', 'safe', 'on'=>'search'),
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
		'category' => array(self::BELONGS_TO, 'LogCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'created_by' => Yii::t("app",'Created By'),
			'user_id' => Yii::t("app",'User'),
			'comment' => Yii::t("app",'Complaint'),
			'date' => Yii::t("app",'Date'),
			'category_id' => Yii::t("app",'Category')
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
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}