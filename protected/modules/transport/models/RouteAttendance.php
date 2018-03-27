<?php

/**
 * This is the model class for table "route_attendance".
 *
 * The followings are the available columns in table 'route_attendance':
 * @property integer $id
 * @property integer $section_id
 * @property integer $mode
 * @property integer $route_id
 * @property integer $student_id
 * @property string $created_at
 * @property integer $created_by
 */
class RouteAttendance extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RouteAttendance the static model class
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
		return 'route_attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('section_id, mode, route_id, student_id, created_at, created_by', 'required'),
			array('section_id, mode, route_id, student_id, created_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, section_id, mode, route_id, student_id, created_at, created_by', 'safe', 'on'=>'search'),
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
			'section_id' => 'Section',
			'mode' => 'Mode',
			'route_id' => 'Route',
			'student_id' => 'Student',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
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
		$criteria->compare('section_id',$this->section_id);
		$criteria->compare('mode',$this->mode);
		$criteria->compare('route_id',$this->route_id);
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function checkStatus($student_id, $section_id, $mode, $date, $route_id)
        {
            $criteria= new CDbCriteria;
            $criteria->condition= "student_id=:student_id AND section_id=:section_id AND mode=:mode AND  STR_TO_DATE(created_at,'%Y-%m-%d')=:date AND route_id=:route_id";
            $criteria->params= array(':section_id'=>$section_id, ':mode'=>$mode,':route_id'=>$route_id, ':student_id'=>$student_id, ':date'=>date("Y-m-d", strtotime($date)));
            $model= RouteAttendance::model()->find($criteria);
            if($model!=NULL)
            {
                return date("g:i a", strtotime($model->created_at));
            }
            else
            {
                 return "-";
            }
           
        }
}