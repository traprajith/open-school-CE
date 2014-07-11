<?php

/**
 * This is the model class for table "events_user_preference".
 *
 * The followings are the available columns in table 'events_user_preference':
 * @property string $user_id
 * @property string $mobile
 * @property integer $mobile_alert
 * @property string $email
 * @property integer $email_alert
 */
class EventsUserpreference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EventsUserpreference the static model class
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
		return 'events_user_preference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('mobile_alert, email_alert', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			array('mobile', 'length', 'max'=>20),
			array('email', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, mobile, mobile_alert, email, email_alert', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('CalModule.EventsUserPreference', 'User'),
			'mobile' => Yii::t('CalModule.EventsUserPreference', 'Mobile'),
			'mobile_alert' => Yii::t('CalModule.EventsUserPreference', 'Mobile Alert'),
			'email' => Yii::t('CalModule.EventsUserPreference', 'Email'),
			'email_alert' => Yii::t('CalModule.EventsUserPreference', 'Email Alert'),
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('mobile_alert',$this->mobile_alert);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_alert',$this->email_alert);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

        public function afterFind()
        {
            $this->mobile_alert = (bool)$this->mobile_alert;
            $this->email_alert = (bool)$this->email_alert;
        }
}