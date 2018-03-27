<?php

/**
 * This is the model class for table "previous_year_settings".
 *
 * The followings are the available columns in table 'previous_year_settings':
 * @property integer $id
 * @property string $settings_key
 * @property integer $settings_value
 */
class PreviousYearSettings extends CActiveRecord
{
	public $setting;
	public $create_action;
	public $insert_action;
	public $edit_action;
	public $delete_action;
	public $approve_action;
	public $disapprove_action;
	public $active_action;
	public $inactive_action;
	/**
	 * Returns the static model of the specified AR class.
	 * @return PreviousYearSettings the static model class
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
		return 'previous_year_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('settings_key, settings_value', 'required'),
			array('settings_value', 'numerical', 'integerOnly'=>true),
			array('settings_key', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, settings_key, settings_value', 'safe', 'on'=>'search'),
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
			'settings_key' => Yii::t("app",'Settings Key'),
			'settings_value' => Yii::t("app",'Settings Value'),
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
		$criteria->compare('settings_key',$this->settings_key,true);
		$criteria->compare('settings_value',$this->settings_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}