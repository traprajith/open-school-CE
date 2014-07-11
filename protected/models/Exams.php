<?php

/**
 * This is the model class for table "exams".
 *
 * The followings are the available columns in table 'exams':
 * @property integer $id
 * @property integer $exam_group_id
 * @property integer $subject_id
 * @property string $start_time
 * @property string $end_time
 * @property string $maximum_marks
 * @property string $minimum_marks
 * @property integer $grading_level_id
 * @property integer $weightage
 * @property integer $event_id
 * @property string $created_at
 * @property string $updated_at
 */
class Exams extends CActiveRecord
{
	public $max_mark;
	public $min_mark;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Exams the static model class
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
		return 'exams';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('exam_group_id, subject_id, grading_level_id, weightage, event_id', 'numerical', 'integerOnly'=>true),
			array('maximum_marks, minimum_marks', 'length', 'max'=>10),
			array('start_time, end_time, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, exam_group_id, subject_id, start_time, end_time, maximum_marks, minimum_marks, grading_level_id, weightage, event_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'exam_group_id' => 'Exam Group',
			'subject_id' => 'Subject',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'maximum_marks' => 'Maximum Marks',
			'minimum_marks' => 'Minimum Marks',
			'grading_level_id' => 'Grading Level',
			'weightage' => 'Weightage',
			'event_id' => 'Event',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('exam_group_id',$this->exam_group_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('maximum_marks',$this->maximum_marks,true);
		$criteria->compare('minimum_marks',$this->minimum_marks,true);
		$criteria->compare('grading_level_id',$this->grading_level_id);
		$criteria->compare('weightage',$this->weightage);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function subjectname($data,$row)
    {
		$subject = Subjects::model()->findByAttributes(array('id'=>$data->subject_id));
		return $subject->name;
		
	}
	
	public function scorelabel($data,$row)
    {
		$employee = Employees::model()->findByAttributes(array('uid'=>Yii::app()->user->id));
		$is_teaching = TimetableEntries::model()->countByAttributes(array('subject_id'=>$data->subject_id,'employee_id'=>$employee->id));
		if($is_teaching>0 or Yii::app()->controller->action->id=='classexam'){
			return "Manage Scores";
		}
		else{
			return "View Scores";
		}
		
	}
	
	
	
}