<?php

/**
 * This is the model class for table "holidays".
 *
 * The followings are the available columns in table 'holidays':
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $desc
 * @property integer $allDay
 * @property string $start
 * @property string $end
 * @property integer $editable
 */
class Holidays extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Holidays the static model class
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
		return 'holidays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			
			
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, desc, allDay, start, end, editable', 'safe', 'on'=>'search'),
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
			'title' => Yii::t("app",'Title'),
			'desc' => Yii::t("app",'Desc'),
			'allDay' => Yii::t("app",'All Day'),
			'start' => Yii::t("app",'Start'),
			'end' => Yii::t("app",'End'),
			'editable' => Yii::t("app",'Editable'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('allDay',$this->allDay);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('editable',$this->editable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function afterFind()
    {
         $this->allDay = (bool)$this->allDay;
         $this->editable = (bool)$this->editable;
    }
}