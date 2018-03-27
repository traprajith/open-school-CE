<?php

/**
 * This is the model class for table "semester".
 *
 * The followings are the available columns in table 'semester':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $start_date
 * @property string $end_date
 * @property string $created_date
 */
class Semester extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Semester the static model class
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
		return 'semester';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, start_date, end_date, created_date', 'required'),
			array('name', 'length', 'max'=>225),
			array('description', 'length', 'max'=>500),
			array('start_date', 'checkstartdate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, start_date, end_date, created_date', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'created_date' => 'Created Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function startdate($data,$row){
		if($data->start_date=='0000-00-00')
		 {
			 return '-';
		 }
		 else
		 {
			  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
			  date_default_timezone_set($timezone->timezone);
			  $date = date($settings->displaydate,strtotime($data->start_date));
			  return $date;
		 }
       
    }
	public function name($data,$row){
		$semester = Semester::model()->findByAttributes(array('id'=>$data->id));
		return CHtml::link($semester->name,array("semester/view","id"=>$data->id));
	}
	public function enddate($data,$row){
		if($data->end_date=='0000-00-00')
		 {
			 return '-';
		 }
		 else
		 {
			  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
			  date_default_timezone_set($timezone->timezone);
			  $date = date($settings->displaydate,strtotime($data->end_date)); 
			  return $date;
		 }
       
    }
	public function checkstartdate($attribute,$params)
	{		
		if($this->start_date!='' and $this->end_date!=''){
			$start_date = date('Y-m-d', strtotime($this->start_date));
			$end_date = date('Y-m-d', strtotime($this->end_date));
			if($start_date > $end_date){
				$this->addError($attribute,Yii::t("app",'Start date must be less than End date'));
			}
		}
	}
}
