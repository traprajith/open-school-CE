<?php

/**
 * This is the model class for table "savedsearches".
 *
 * The followings are the available columns in table 'savedsearches':
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property integer $type
 * @property string $name
 */
class Savedsearches extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Savedsearches the static model class
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
		return 'savedsearches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, type', 'numerical', 'integerOnly'=>true),
			array('url', 'length', 'max'=>20000),
			array('name', 'length', 'max'=>120),
			array('name','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, url, type, name', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'url' => 'Url',
			'type' => 'Type',
			'name' => 'Name',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}