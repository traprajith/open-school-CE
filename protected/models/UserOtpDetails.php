<?php

/**
 * This is the model class for table "user_otp_details".
 *
 * The followings are the available columns in table 'user_otp_details':
 * @property integer $id
 * @property integer $user_id
 * @property integer $otp
 * @property string $otp_key
 * @property string $created_at
 * @property integer $otp_status
 */
class UserOtpDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserOtpDetails the static model class
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
		return 'user_otp_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, otp, key, created_at', 'required'),
			array('user_id, otp, status', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, otp, key, created_at, status', 'safe', 'on'=>'search'),
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
			'otp' => 'Otp',
			'key' => 'Otp Key',
			'created_at' => 'Created At',
			'status' => 'Otp Status',
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
		$criteria->compare('otp',$this->otp);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}