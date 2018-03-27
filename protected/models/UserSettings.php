<?php

/**
 * This is the model class for table "user_settings".
 *
 * The followings are the available columns in table 'user_settings':
 * @property integer $id
 * @property string $user_id
 * @property string $date_format
 * @property string $time_format
 */
class UserSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserSettings the static model class
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
		return 'user_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, dateformat, displaydate, timezone, timeformat, name_format, language', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, dateformat, displaydate timezone, timeformat, name_format, language', 'safe', 'on'=>'search'),
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
			'id' => Yii::t("app",'ID'),
			'user_id' => Yii::t("app",'User'),
			'dateformat' => Yii::t("app",'Date Format'),
			'displaydate' => Yii::t("app",'Display Date'),
			'timezone' => Yii::t("app",'Time Zone'),
			'timeformat' => Yii::t("app",'Time Format'),
			'name_format' => Yii::t("app",'Name Format'),
			'language' => Yii::t("app",'Language'),
			
			
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('dateformat',$this->dateformat,true);
		$criteria->compare('displaydate',$this->displaydate,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('timeformat',$this->timeformat,true);
		$criteria->compare('name_format',$this->name_format,true);
		$criteria->compare('language',$this->language,true);
		
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}