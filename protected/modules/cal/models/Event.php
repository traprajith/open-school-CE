<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property integer $allDay
 * @property string $start
 * @property string $end
 * @property integer $editable
 */
class Event extends CActiveRecord
{
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Event the static model class
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
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, desc', 'required',),
			array('end', 'checkTime'),
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
			'user_id' => Yii::t('app', 'User'),
			'title' => Yii::t('app', 'Title'),
			'placeholder' => Yii::t("app",'Event Privacy'),
			'type' => Yii::t("app",'Event Type'),
			'desc' => Yii::t("app",'Description'),
			'allDay' => Yii::t('app', 'All Day'),
			'start' => Yii::t('app', 'Start'),			
			'end' => Yii::t('app', 'End'),
			'organizer'=>Yii::t('app', 'Organizer/In charge'),
			'editable' => Yii::t('app', 'Editable'),
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
		$criteria->compare('allDay',$this->allDay);
		$criteria->compare('start',$this->start,true);
		$criteria->compare('end',$this->end,true);
		$criteria->compare('editable',$this->editable);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function afterFind()
	{
		$this->allDay = (bool)$this->allDay;
		$this->editable = (bool)$this->editable;
	}
	
	public function checkTime($attriue){
		if($this->start>=$this->end){
			$this->addError("end", Yii::t("app", "End time must be greater than start time"));
		}
	}
}