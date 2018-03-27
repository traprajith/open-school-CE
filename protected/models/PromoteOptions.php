<?php

/**
 * This is the model class for table "promote_options".
 *
 * The followings are the available columns in table 'promote_options':
 * @property integer $id
 * @property string $option_name
 * @property integer $option_value
 */
class PromoteOptions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PromoteOptions the static model class
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
		return 'promote_options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_name, option_value', 'required'),
			array('option_value', 'numerical', 'integerOnly'=>true),
			array('option_name', 'length', 'max'=>225),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, option_name, option_value', 'safe', 'on'=>'search'),
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
			'option_name' => Yii::t("app",'Option Name'),
			'option_value' => Yii::t("app",'Option Value'),
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
		$criteria->compare('option_name',$this->option_name,true);
		$criteria->compare('option_value',$this->option_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}