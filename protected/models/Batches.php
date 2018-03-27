<?php

/**
 * This is the model class for table "batches".
 *
 * The followings are the available columns in table 'batches':
 * @property integer $id
 * @property string $name
 * @property integer $course_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_active
 * @property integer $is_deleted
 * @property string $employee_id
 */
class Batches extends CActiveRecord
{
	 public $duplicate;
	 public $batch_list;
	 public $duplicate_options;
	 public $subject;
	 public $electives;
	 public $classtimimg;
	 public $subject_ass;
	 public $timetable;
	 public $all;
	 
	 
	/**
	 * Returns the static model of the specified AR class.
	 * @return Batches the static model class
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
		return 'batches';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		
		if(Yii::app()->controller->id == 'academicYears')
		{
			return array(
				array('course_id, exam_format, is_active, is_deleted', 'numerical', 'integerOnly'=>true),
				array('name, employee_id', 'length', 'max'=>25),
				array('academic_yr_id, start_date, end_date, timetable_format', 'safe'),
				// The following rule is used by search().
				array('name', 'required'),
				// Please remove those attributes that should not be searched.
				array('id, name, course_id, academic_yr_id, exam_format, start_date, end_date, is_active, is_deleted, employee_id, batch_list', 'safe', 'on'=>'search'),
			);
		}
		else
		{
			return array(
				array('course_id, is_active, exam_format, is_deleted', 'numerical', 'integerOnly'=>true),
				array('name, employee_id', 'length', 'max'=>25),
				array('academic_yr_id, start_date, end_date, timetable_format', 'safe'),
				// The following rule is used by search().
				array('name, start_date, end_date', 'required'),
				array('start_date', 'checkstartdate'),
				array('batch_list','check'),
				array('semester_id', 'required','on'=>'sem_enabled'),
				array('semester_id','checkDate','on'=>'sem_enabled'),
				// Please remove those attributes that should not be searched.
				array('id, name, course_id, academic_yr_id, start_date, end_date, exam_format, is_active, is_deleted, employee_id, batch_list, semester_id', 'safe', 'on'=>'search'),
			);
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'course123'=>array(self::BELONGS_TO, 'Courses', 'course_id'),
		);
	}
	
	public function check($attribute,$params){					
		if($this->duplicate == 1 and $this->$attribute == NULL){			
			$this->addError($attribute,Yii::t('app','Cannot be blank'));
		}
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'name' => Yii::t('app', 'Name'),
			'course_id' => Yii::t('app','Course'),
			'academic_yr_id' => Yii::t("app",'Academic Year ID'),
			'start_date' => Yii::t('app','Start Date'),
			'end_date' => Yii::t('app','End Date'),
			'is_active' => Yii::t("app",'Is Active'),
			'is_deleted' => Yii::t("app",'Is Deleted'),
			'employee_id' => Yii::t('app','Class Teacher'),
			'exam_format' => Yii::t('app','Exam Format'),
			'duplicate' => Yii::t('app','Is Duplicate'),
                        'semester_id' => Yii::t('app','Semester'),
			'batch_list' => Yii::app()->getModule('students')->fieldLabel("Students", "batch_id")
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
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('exam_format',$this->exam_format,true);
		$criteria->compare('duplicate',$this->employee_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getval()
	{
		return '"123"';
	}
	 public function getCoursename()
	{
		$course=Courses::model()->findByAttributes(array('id'=>$this->course_id,'is_deleted'=>0));
			return $this->name.' ('.$course->course_name.')';
	}
	
	public function Daycount($day, $startdate, $enddate, $counter)
	{
		if($startdate > $enddate)
		{
			return $counter;
		}
		else
		{
			$next_day = strtotime("next ".$day, $startdate);
			if($next_day<=$enddate)
			{
				$counter = $counter+1;
				
			}
			return $this->Daycount($day, strtotime("next ".$day, $startdate) , $enddate,  $counter);
		}
	
	}
	public function getDay($str)
	{
		if($str == 'sunday')
		{
			return 0;
		}
		elseif($str == 'monday')
		{
			return 1;
		}
		elseif($str == 'tuesday')
		{
			return 2;
		}
		elseif($str == 'wednesday')
		{
			return 3;
		}
		elseif($str == 'thursday')
		{
			return 4;
		}
		elseif($str == 'friday')
		{
			return 5;
		}
		elseif($str == 'saturday')
		{
			return 6;
		}
		else
		{
			return;
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
        
        public function checkDate($attribute,$params)
	{	                        
            if(($this->start_date!='' or $this->end_date!='') and $this->semester_id!='' and $this->course_id!='')
            {                                                                          
                $semester = Semester::model()->findByPk($this->semester_id);
                if($semester!=NULL )
                {
                    $sem_start      = strtotime($semester->start_date);
                    $sem_end        = strtotime($semester->end_date);                                        
                    $batch_start    = strtotime($this->start_date);
                    $batch_end      = strtotime($this->end_date);
                    if(($batch_start < $sem_start) or ($batch_start > $sem_end))
                    {
                        $this->addError('start_date',Yii::t("app",'Start date must be in between semester date range'));
                    } 

                    if(($batch_end < $sem_start) or ($batch_end > $sem_end))
                    {
                        $this->addError('end_date',Yii::t("app",'End date must be in between semester date range'));
                    } 
               }                                    
            }
	}
	
	public function getSemester(){
		$criteria				= new CDbCriteria;
		$criteria->join			= 'JOIN `semester_courses` `sc` ON `sc`.`semester_id`=`t`.`id`';
		$criteria->condition	= '`t`.`id`=:semester_id AND`sc`.`course_id`=:course_id';
		$criteria->params		= array(':semester_id'=>$this->semester_id, ':course_id'=>$this->course_id);
		$semester				= Semester::model()->find($criteria);
		
		return $semester;
	}
        
        public function getCourse()
	{
		$course=Courses::model()->findByAttributes(array('id'=>$this->course_id,'is_deleted'=>0));
                if($course!=NULL)
                {
                    return $course->course_name;
                }
                else
                    return '-';
	}
}