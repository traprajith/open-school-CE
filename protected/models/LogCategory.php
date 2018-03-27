<?php

/**
 * This is the model class for table "log_category".
 *
 * The followings are the available columns in table 'log_category':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $is_deleted
 */
class LogCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LogCategory the static model class
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
		return 'log_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('status, is_deleted', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('name', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, status, is_deleted,editable,visible', 'safe', 'on'=>'search'),
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
			'name' => Yii::t("app",'Name'),
			'status' => Yii::t("app",'Status'),
			'is_deleted' => Yii::t("app",'Is Deleted'),
			'editable' => Yii::t("app",'Allow Teachers to Manage'),
			'visible' => Yii::t("app",'Visible to Student/Parent'),
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
		if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'employees')
			$criteria->compare('type',2,true);
		if(isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == 'students')
			$criteria->compare('type',1,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}