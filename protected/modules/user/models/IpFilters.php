<?php

/**
 * This is the model class for table "ip_filters".
 *
 * The followings are the available columns in table 'ip_filters':
 * @property integer $id
 * @property string $ip_address
 * @property integer $mismatch_count
 * @property string $created_at
 * @property integer $is_blocked
 */
class IpFilters extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return IpFilters the static model class
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
		return 'ip_filters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip_address, mismatch_count, created_at', 'required'),
			array('mismatch_count, is_blocked', 'numerical', 'integerOnly'=>true),
			array('ip_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ip_address, mismatch_count, created_at, is_blocked', 'safe', 'on'=>'search'),
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
			'ip_address' => 'Ip Address',
			'mismatch_count' => 'Mismatch Count',
			'created_at' => 'Created At',
			'is_blocked' => 'Is Blocked',
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
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('mismatch_count',$this->mismatch_count);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('is_blocked',$this->is_blocked);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}