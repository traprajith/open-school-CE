<?php

/**
 * This is the model class for table "configurations".
 *
 * The followings are the available columns in table 'configurations':
 * @property integer $id
 * @property string $config_key
 * @property string $config_value
 */
class Configurations extends CActiveRecord
{
	public $college_name;
	public $logo;
	public $help_link;
	public $achievements;
	public $complaints;
	public $exam_format;
	public $timetable_format;
    public $authentication;


        /**
	 * Returns the static model of the specified AR class.
	 * @return Configurations the static model class
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
		return 'configurations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('config_key, config_value', 'required'),
			array('config_key, config_value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, config_key, config_value', 'safe', 'on'=>'search'),
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
			'config_key' => Yii::t("app",'Config Key'),
			'config_value' => Yii::t("app",'Config Value'),
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
		$criteria->compare('config_key',$this->config_key,true);
		$criteria->compare('config_value',$this->config_value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function daterange($strDateFrom,$strDateTo)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.
	
		// could test validity of dates here but I'm already doing
		// that in the main script
	
		$aryRange=array();
	
		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
	
		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
        
    public function getDirection()
	{
		$direction 		= 'ltr';
		$language_arr 	= array('ar', 'cz');
		//$language_arr 	= array('');
		$user_id		= (!isset(Yii::app()->user->Id))?1:Yii::app()->user->Id;
		$settings		= UserSettings::model()->findByAttributes(array('user_id'=>$user_id));
		if($settings!= NULL and $settings->language!=NULL and in_array($settings->language, $language_arr)){
			$direction = 'rtl';		
		}
		return $direction;
	}
	
//Check whether Android App is enabled or not
	public function isAndroidEnabled()
	{
		$model = Configurations::model()->findByAttributes(array('config_key'=>'Android'));
		if($model){
			if($model->config_value == 1){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	
	// student attendance type
	public function studentAttendanceMode(){
		$model 	= Configurations::model()->findByAttributes(array('config_key'=>'Student Attendance'));		// 1 - Daliy, 2 - Subject wise, 3 - Both
		return ($model!=NULL)?$model->config_value:1;
	}
	
	// teacher attendance type
	public function teacherAttendanceMode(){
		$model 	= Configurations::model()->findByAttributes(array('config_key'=>'Teacher Attendance'));		// 1 - Daliy, 2 - Subject wise, 3 - Both
		return ($model!=NULL)?$model->config_value:1;
	}
	
	// enabled / disabled semester settings
	public function isSemesterEnabled(){
		$model 	= Configurations::model()->findByAttributes(array('config_key'=>'Semester Settings'));		// 1 - Yes, 0 - No
		return ($model!=NULL)?$model->config_value:0;
	}
	
	// enabled / disabled semester for course
	public function isSemesterEnabledForCourse($id){
		$model 	= Courses::model()->findByPk($id);		// 1 - Yes, 0 - No
		return ($this->isSemesterEnabled() and $model!=NULL)?$model->semester_enabled:0;
	}

	public function timetableFormat($bid=NULL){
		$config		= Configurations::model()->findByAttributes(array('config_key'=>'TimetableFormat'));
		$format 	= 1;		// default format - fixed
		if($config!=NULL){
			if($config->config_value<0){	// batch level or course level
				if($bid!=NULL){
					$batch	= Batches::model()->findByPk($bid);
					if($batch!=NULL){
						if($config->config_value==-2){		// batch level
							$format	= $batch->timetable_format;
						}
						else if($config->config_value==-1){	// course level
							$course	= Courses::model()->findByPk($batch->course_id);
							if($course!=NULL){
								$format	= $course->timetable_format;
							}
						}
					}
				}
			}		// fixed or flexible
			else{
				$format	= ($config->config_value==0)?$format:$config->config_value;
			}
		}
		
		return $format;
	}
	
	public function timetableConfig($bid=NULL){
		$config		= Configurations::model()->findByAttributes(array('config_key'=>'TimetableFormat'));
		return ($config!=NULL and $config->config_value!=NULL)?$config->config_value:NULL;
	}
	public function convertTime($time) {
		
		$user_id		= (!isset(Yii::app()->user->Id))?1:Yii::app()->user->Id;
		$settings		= UserSettings::model()->findByAttributes(array('user_id'=>$user_id));
		// check rtl
		if(Configurations::model()->direction=="rtl"){
			// check time formate null
			if($settings->timeformat!=NULL){
				if(strpos($settings->timeformat,'A') !== false ) {
					$format = str_replace('A','',$settings->timeformat);
					$t_interval1 = date($format, strtotime($time));	
					$t_interval2 = date('A', strtotime($time));
				}else{
					$t_interval1 = date($settings->timeformat, strtotime($time)); 
				}				
			}else{
				$t_interval1 = date('h:i', strtotime($time));	
				$t_interval2 = date('A', strtotime($time));
			}
			
		}else{// not rtl
			if($settings->timeformat!=NULL){ 
					$t_interval1 = date($settings->timeformat, strtotime($time));
			}else{
					$t_interval1 = date('h:i A', strtotime($time));
			}			
		}
		// AM or PM set
		if(isset ($t_interval2) and $t_interval2!=NULL)
			$t_interval1 = $t_interval1." ".Yii::t("app",$t_interval2);
			
		return $t_interval1;
 	}
	public function convertDate($date) {
		
		$user_id		= (!isset(Yii::app()->user->Id))?1:Yii::app()->user->Id;
		$settings		= UserSettings::model()->findByAttributes(array('user_id'=>$user_id));
		if($settings->displaydate=NULL){
			$settings		= UserSettings::model()->findByAttributes(array('user_id'=>1));
		}
		// check rtl
		if(Configurations::model()->direction=="rtl"){
			// check time formate null
			if($settings->displaydate!=NULL){
				if(strpos($settings->displaydate,'M') !== false ) {
					// code
					if($settings->displaydate=='M d.yy'){
						$date1 	=	Yii::t("app",date('M',strtotime($date)));
						$date1	=	$date1.' '.date('d',strtotime($date));						
						$date1 	=	$date1.'.'.date('yy',strtotime($date));
					}else if($settings->displaydate=='D, M d.yy'){
						$date1 	=	Yii::t("app",date('D',strtotime($date)));
						$date1 	=	$date1.', '.Yii::t("app",date('M',strtotime($date)));
						$date1	=	$date1.' '.date('d',strtotime($date));						
						$date1 	=	$date1.'.'.date('yy',strtotime($date));
					}else if($settings->displaydate=='d M yy'){
						$date1=date('d',strtotime($date));
						$date1 =$date1.' '.Yii::t("app",date('M',strtotime($date)));
						$date1 =$date1.' '.date('yy',strtotime($date));
					}else if($settings->displaydate=='d M Y'){
						$date1=date('d',strtotime($date));
						$date1 =$date1.' '.Yii::t("app",date('M',strtotime($date)));
						$date1 =$date1.' '.date('Y',strtotime($date));
					}else{						
						$date1=date('d',strtotime($date));
						$date1 =$date1.' '.Yii::t("app",date('M',strtotime($date)));
						$date1 =$date1.' '.date('Y',strtotime($date));
					}
				}else{
					$date1 = date($settings->displaydate,$date);
				}
			}else{ 
				$date1=date('d',strtotime($date)).' '.Yii::t("app",date('M',strtotime($date))).' '.date('Y',strtotime($date)); 
				echo $date1;
			}
			
		}else{// not rtl
			if($settings->displaydate!=NULL){ 
					$date1 = date($settings->displaydate, strtotime($date));
			}else{
					$date1 = date('d M Y', strtotime($date));
			}
		}
		
		
 	}
	public function convertDateTime($datetime) {
		$date		=	Configurations::model()->convertDate($datetime); 
		$time		=	Configurations::model()->convertTime($datetime);
		return $date.' '.$time;
	}
	public function rollnoSettingsMode(){
		$model 	= Configurations::model()->findByAttributes(array('id'=>49));		// 1 - roll no only, 2 - admission no only, 3 - Both
		return ($model!=NULL)?$model->config_value:1;
	}
	
//For Android
	public static function devicenotice($argument_arr, $title, $tag){		
		$message			= $argument_arr['message'];
		$devices			= $argument_arr['device_id'];		
		$sender_name		= $argument_arr['sender_name'];				
		$settings			= UserSettings::model()->findByAttributes(array('user_id'=>1));
		$timezone 			= Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
       	date_default_timezone_set($timezone->timezone);		
		$date 				= date("Y-m-d H:m:s");
		
		if($tag == 'student_subjectwise_attendance'){ //Student Subjectwise Attendance
			$class_timing_id	= '';
			$batch_id			= '';	
			$student_id			= '';
			if(isset($argument_arr['student_id']) and $argument_arr['student_id'] != NULL){
				$student_id	= $argument_arr['student_id'];
			}		
			if(isset($argument_arr['class_timing_id']) and $argument_arr['class_timing_id'] != NULL){
				$class_timing_id	= $argument_arr['class_timing_id'];
			}
			if(isset($argument_arr['batch_id']) and $argument_arr['batch_id'] != NULL){
				$batch_id	= $argument_arr['batch_id'];
			}
			$msg	= array(
							"message"			=> $message, 
							"tag"				=> $tag, 
							"title"				=> $title, 
							"timestamp"			=> $date, 
							'sender_name'		=> $sender_name, 
							'student_id'		=> $student_id, 
							'batch_id'			=> $batch_id, 
							'date'				=> $argument_arr['date'], 
							'class_timing_id'	=> $class_timing_id
						);
		}
		else if($tag == 'inbox'){ //Internal Messaging					
			$msg	= array(
							"message" 			=> $message, 
							"tag"				=> $tag, 
							"title"				=> $title, 
							"timestamp"			=> $date, 
							'sender_email'		=> $argument_arr['sender_email'], 
							'sender_name'		=> $sender_name, 
							'conversation_id'	=> $argument_arr['conversation_id'],
							'content'			=> $argument_arr['content'],
							'subject'			=> $argument_arr['subject']
						);
		}
		else{			
			$msg	= array("message" =>$message, "tag"=>$tag, "title"=>$title, "timestamp"=>$date, 'sender_email'=>$sender_email, 'sender_name'=>$sender_name);
		}
		                                  
		return true;
	}
	
	public function getUserName($uid)
	{
		$role 	= Rights::getAssignedRoles($uid);
		$name	= '';
		if(key($role) == 'student'){
			$model	= Students::model()->findByAttributes(array('uid'=>$uid));
			if($model){
				$name	= ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name);
			}
		}
		else if(key($role) == 'parent'){
			$model	= Guardians::model()->findByAttributes(array('uid'=>$uid));
			if($model){
				$name	= ucfirst($model->first_name).' '.ucfirst($model->last_name);
			}
		}
		else if(key($role) == 'teacher'){
			$model	= Employees::model()->findByAttributes(array('uid'=>$uid));
			if($model){
				$name	= ucfirst($model->first_name).' '.ucfirst($model->middle_name).' '.ucfirst($model->last_name);
			}
		}
		else{
			$model	= Profile::model()->findByAttributes(array('user_id'=>$uid));
			if($model){
				$name	= ucfirst($model->firstname).' '.ucfirst($model->lastname);
			}
		}
		return $name;		
	}
}