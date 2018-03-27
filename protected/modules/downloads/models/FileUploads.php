<?php

/**
 * This is the model class for table "file_uploads".
 *
 * The followings are the available columns in table 'file_uploads':
 * @property integer $id
 * @property string $title
 * @property integer $category
 * @property string $placeholder
 * @property integer $course
 * @property integer $batch
 * @property string $file
 * @property string $file_type
 * @property integer $created_by
 * @property string $created_at
 */
class FileUploads extends CActiveRecord
{
	public $students;
	/**
	 * Returns the static model of the specified AR class.
	 * @return FileUploads the static model class
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
		return 'file_uploads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, category, file', 'required'),
			array('category, course, batch, academic_yr_id, created_by', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('file', 'file', 'types'=>'jpg, jpeg, png, gif, pdf, mp4, doc, txt, ppt, docx, pptx','allowEmpty'=>true),			
			array('placeholder', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, category, placeholder, course, batch, file, file_type, academic_yr_id,created_by, created_at, description, is_special_student', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app','ID'),
			'title' => Yii::t('app','Title'),
			'category' => Yii::t('app','Category'),
			'placeholder' => Yii::t('app','Placeholder'),
			'course' => Yii::t('app','Course'),
			'batch' => Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),
			'file' => Yii::t('app','File'),
			'file_type' => Yii::t('app','File Type'),
			'academic_yr_id' => Yii::t('app','Academic Year'),
			'created_by' => Yii::t('app','Created By'),
			'created_at' => Yii::t('app','Created At'),
			'student' => Yii::t('app', 'Students'),
			'description' => Yii::t('app', 'Description')
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('placeholder',$this->placeholder,true);
		$criteria->compare('course',$this->course);
		$criteria->compare('batch',$this->batch);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('academic_yr_id',$this->academic_yr_id,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_at',$this->created_at,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function GetCourse($data,$row)
	{  
		if($data->course)
		{
			$course = Courses::model()->findByAttributes(array('id'=>$data->course));
			
			if($course->course_name)
			{
				return ucfirst($course->course_name);
			}
			else
			{
				echo '-';
			}
		}
		else
		{
			echo '-';
		}
	}
	
	public function GetBatch($data,$row)
	{
		if($data->batch)
		{
			$batch = Batches::model()->findByAttributes(array('id'=>$data->batch));
			if($batch->name)
			{
				return ucfirst($batch->name);
			}
			else
			{
				echo '-';
			}
		}
		else
		{
			echo '-';
		}
	}
	
	public function GetYear($data,$row)
	{
		if($data->academic_yr_id)
		{
			$year = AcademicYears::model()->findByAttributes(array('id'=>$data->academic_yr_id));
			if($year->name)
			{
				return ucfirst($year->name);
			}
			else
			{
				echo '-';
			}
		}
		else
		{
			echo '-';
		}
	}
	
	public function GetPlaceholder($data,$row)
	{
		if($data->placeholder)
		{
			return ucfirst($data->placeholder);
		}
		else
		{
			return 'Public';
		}
	}
        
        public function searchs()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.		
		$criteria=new CDbCriteria;
		$criteria->join = 'JOIN document_uploads du ON du.file_name= t.file';
		$criteria->condition= 't.created_by=:created_by AND du.status=1 AND du.model_id=5';
		$criteria->params= array(':created_by'=>  Yii::app()->user->id);
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.title',$this->title,true);
		$criteria->compare('t.category',$this->category);
		$criteria->compare('t.placeholder',$this->placeholder,true);
		$criteria->compare('t.course',$this->course);
		$criteria->compare('t.batch',$this->batch);
		$criteria->compare('t.file',$this->file,true);
		$criteria->compare('t.file_type',$this->file_type,true);
		$criteria->compare('t.academic_yr_id',$this->academic_yr_id,true);
		$criteria->compare('t.created_by',$this->created_by);
		$criteria->compare('t.created_at',$this->created_at,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getStudents($id) //id => id of file_uploads table
	{
		$student_upload	= FileUploadsStudents::model()->findAllByAttributes(array('table_id'=>$id));
		if($student_upload){
			$student_arr = array();
			foreach($student_upload as $value){
				$student	= Students::model()->findByPk($value->student_id);
				if($student){						
					$student_arr[]	= $student->studentFullName('forTeacherPortal');
				}
			}
			if(count($student_arr) > 0){
				echo implode(', ', $student_arr);
			}
			else{
				echo '-';
			}
		}
		else{
			echo '-';
		}
	}
	
	public function sendNotification($id)
	{
		$model	= FileUploads::model()->findByPk($id);
		if($model){	
			$students		= '';
			$profile		= Profile::model()->findByAttributes(array('user_id'=>$model->created_by));				
			$notification 	= NotificationSettings::model()->findByAttributes(array('id'=>22));
			$college		= Configurations::model()->findByPk(1);	
			
			$parent_mail_template	= EmailTemplates::model()->findByPk(32);									
			$parent_sms_template	= SystemTemplates::model()->findByPk(40);
									
			$student_mail_template	= EmailTemplates::model()->findByPk(33);									
			$student_sms_template	= SystemTemplates::model()->findByPk(41);
			
			if($model->is_special_student == 1){ //If the document uploded for a particular students
				$criteria				= new CDbCriteria();
				$criteria->join			= 'LEFT JOIN file_uploads_students t1 ON t1.student_id = t.id';
				$criteria->condition	= 't.is_active=:is_active AND t.is_deleted=:is_deleted AND t1.table_id=:table_id';
				$criteria->params		= array(':is_active'=>1, ':is_deleted'=>0, ':table_id'=>$model->id);
				$students				= Students::model()->findAll($criteria);							
			}
			else{
				if($model->batch != NULL and $model->batch != 0){ //If the document uploded for a particular batch
					$students	= Yii::app()->getModule('students')->studentsOfBatch($model->batch);
				}
				else if($model->course != NULL and $model->course != 0){ //If the document uploded for a particular course
					$criteria				= new CDbCriteria();
					$criteria->join			= 'LEFT JOIN batch_students t1 ON t1.student_id = t.id LEFT JOIN batches t2 ON t2.id = t1.batch_id';
					$criteria->condition	= 't.is_active=:is_active AND t.is_deleted=:is_deleted AND t1.status=:status AND t1.result_status=:result_status AND t2.course_id=:course_id AND t2.is_active=:is_active AND t2.is_deleted=:is_deleted';
					$criteria->params		= array(':is_active'=>1, ':is_deleted'=>0, ':status'=>1, ':result_status'=>0, ':course_id'=>$model->course);
					$criteria->group		= 't.id';
					$students				= Students::model()->findAll($criteria);					 
				}
				else{ //If the document uploded for all Students
					$criteria				= new CDbCriteria();
					$criteria->condition	= 't.is_active=:is_active AND t.is_deleted=:is_deleted';
					$criteria->params		= array(':is_active'=>1, ':is_deleted'=>0);
					$students				= Students::model()->findAll($criteria);									 		
				}
			}
			
			if($students){
				foreach($students as $student){
					//Student Mail
					if($notification->mail_enabled == '1'  and $notification->student == '1'){	
						$student_mail_subject	= $student_mail_template->subject;
						$student_mail_message	= $student_mail_template->template;
						
						$student_mail_subject	= str_replace("{{SCHOOL NAME}}",$college->config_value,$student_mail_subject);
						$student_mail_message	= str_replace("{{SCHOOL NAME}}",$college->config_value,$student_mail_message);
						$student_mail_message	= str_replace("{{UPLOADED BY}}",ucfirst($profile->firstname).' '.ucfirst($profile->lastname),$student_mail_message);
						$student_mail_message	= str_replace("{{NAME}}",$student->studentFullName('forStudentProfile'),$student_mail_message);
						
						UserModule::sendMail($student->email,$student_mail_subject,$student_mail_message);	
					}
					//Student SMS
					if($notification->sms_enabled == '1'  and $notification->student == '1'){	
						$student_sms_message	= $student_sms_template->template;
						$student_sms_message 	= str_replace("<School Name>",$college->config_value,$student_sms_message);
						$student_sms_message 	= str_replace("<Uploaded By>",ucfirst($profile->firstname).' '.ucfirst($profile->lastname),$student_sms_message);
						
						SmsSettings::model()->sendSms($student->phone1, $college->config_value,$student_sms_message);
					}
					
					$parent	= Students::model()->getPrimaryGuardian($student->id); //Get primary Gurdian details
					if($parent){
						//Guardian Mail
						if($notification->mail_enabled == '1'  and $notification->parent_1 == '1'){	
							$parent_mail_subject	= $parent_mail_template->subject;
							$parent_mail_message	= $parent_mail_template->template;
							
							$parent_mail_subject	= str_replace("{{SCHOOL NAME}}",$college->config_value,$parent_mail_subject);
							$parent_mail_message	= str_replace("{{SCHOOL NAME}}",$college->config_value,$parent_mail_message);
							$parent_mail_message	= str_replace("{{UPLOADED BY}}",ucfirst($profile->firstname).' '.ucfirst($profile->lastname),$parent_mail_message);
							$parent_mail_message	= str_replace("{{NAME}}", ucfirst($parent->first_name).' '.ucfirst($parent->last_name),$parent_mail_message);
							$parent_mail_message	= str_replace("{{STUDENT NAME}}",$student->studentFullName('forStudentProfile'),$parent_mail_message);
							
							UserModule::sendMail($parent->email,$parent_mail_subject,$parent_mail_message);	
						}
						if($notification->sms_enabled == '1'  and $notification->parent_1 == '1'){	
							$parent_sms_message		= $parent_sms_template->template;
							$parent_sms_message 	= str_replace("<School Name>",$college->config_value,$parent_sms_message);
							$parent_sms_message 	= str_replace("<Uploaded By>",ucfirst($profile->firstname).' '.ucfirst($profile->lastname),$parent_sms_message);
							$parent_sms_message 	= str_replace("<Student Name>",$student->studentFullName('forStudentProfile'),$parent_sms_message);
							
							SmsSettings::model()->sendSms($parent->mobile_phone, $college->config_value,$parent_sms_message);
						}
					}												
				}					
			}				
		}
		return;
	}
}