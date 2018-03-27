<?php

/**
 * This is the model class for table "achievements".
 *
 * The followings are the available columns in table 'achievements':
 * @property integer $id
 * @property integer $created_by
 * @property integer $user_id
 * @property integer $user_type
 * @property string $achievement_title
 * @property string $description
 * @property string $doc_title
 * @property string $file
 * @property string $file_type
 * @property string $created_at
 * @property integer $is_deleted
 */
class Achievements extends CActiveRecord
{
	public $eid;
	public $sid;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Achievements the static model class
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
		return 'achievements';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, user_id, user_type, achievement_title, description, doc_title, file, file_type, created_at, is_deleted', 'required'),
			array('created_by, user_id, user_type, is_deleted', 'numerical', 'integerOnly'=>true),
			array('achievement_title, doc_title, file, file_type', 'length', 'max'=>220),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_by, user_id, user_type, achievement_title, description, doc_title, file, file_type, created_at, is_deleted', 'safe', 'on'=>'search'),
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
			'created_by' => 'Created By',
			'user_id' => 'User',
			'user_type' => 'User Type',
			'achievement_title' => 'Achievement Title',
			'description' => 'Description',
			'doc_title' => 'Doc Title',
			'file' => 'File',
			'file_type' => 'File Type',
			'created_at' => 'Created At',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('achievement_title',$this->achievement_title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('doc_title',$this->doc_title,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}