<?php

class BackgroundProcessController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actionNotifyHoliday()
	{
		$settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		$notification = NotificationSettings::model()->findByAttributes(array('id'=>16));
		if($settings!=NULL)
		{
			$timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));
			date_default_timezone_set($timezone->timezone);
		}
		$date = new DateTime();
		$today = $date->getTimestamp();
		$today_date = date('d-m-Y');
		
		$phone_numbers = array();
		$emails = array();
		$uid = array();
		
		$stud_criteria = new CDbCriteria;
		$stud_criteria->select = 'phone1, email';
		$stud_criteria->distinct = true;
		$stud_criteria->condition = 'phone1 <>:null and is_active =:is_active and is_deleted =:is_deleted';
		$stud_criteria->params = array(':null'=>'',':is_active'=>1,':is_deleted'=>0);
		if($notification->student == '1')
		{
			$students = Students::model()->findAll($stud_criteria);
		
		
			foreach($students as $student)
			{
				if(!in_array($student->phone1,$phone_numbers))
				{
					$phone_numbers[] = $student->phone1;
				}
				if(!in_array($student->email,$emails))
				{
					$emails[] = $student->email;
				}
				if(!in_array($student->uid,$uid))
				{
					$uid[] = $student->uid;
				}
			}
		}
		
		
		$guard_criteria = new CDbCriteria;
		$guard_criteria->select = 'mobile_phone, email';
		$guard_criteria->distinct = true;
		$guard_criteria->condition = 'mobile_phone <>:null';
		$guard_criteria->params = array(':null'=>'');
		if($notification->parent_1 == '1')
		{
			$guardians = Guardians::model()->findAll($guard_criteria);
		
		
			foreach($guardians as $guardian)
			{
				if(!in_array($guardian->mobile_phone,$phone_numbers))
				{
					$phone_numbers[] = $guardian->mobile_phone;
				}
				if(!in_array($guardian->email,$emails))
				{
					$emails[] = $guardian->email;
				}
				if(!in_array($guardian->uid,$uid))
				{
					$uid[] = $guardian->uid;
				}
			}
		}
		
		
		$emp_criteria = new CDbCriteria;
		$emp_criteria->select = 'mobile_phone, email';
		$emp_criteria->distinct = true;
		$emp_criteria->condition = 'mobile_phone <>:null';
		$emp_criteria->params = array(':null'=>'');
		if($notification->employee == '1')
		{
			$employees = Employees::model()->findAll($emp_criteria);
			
			foreach($employees as $employee)
			{
				if(!in_array($employee->mobile_phone,$phone_numbers))
				{
					$phone_numbers[] = $employee->mobile_phone;
				}
				if(!in_array($employee->email,$emails))
				{
					$emails[] = $employee->email;
				}
				if(!in_array($employee->uid,$uid))
				{
					$uid[] = $employee->uid;
				}
			}
		}
		
		/*var_dump($phone_numbers);
		var_dump($emails);*/
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'start >= :today';
		$criteria->params[':today'] = $today;
		$holidays = Holidays::model()->findAll($criteria);
		
		$college=Configurations::model()->findByPk(1);
		$from = ucfirst($college->config_value);
		
		$notification = NotificationSettings::model()->findByAttributes(array('id'=>16));
		foreach($holidays as $holiday)
		{
			$holiday_date = date('d-m-Y',$holiday->start);
			$diff = $holiday_date - $today_date;
			
			if($diff == 1) // Tomorrow Holiday
			{
				if($notification->sms_enabled == '1')
				{					
					$college=Configurations::model()->findByPk(1);
					$from = $college->config_value;				
					$sms_template = SystemTemplates::model()->findByAttributes(array('id'=>33));
					$sms = str_replace("<Holiday Title>",$holiday->title,$sms_template->template);
					$sms = str_replace("<Holiday Date>",$holiday_date,$sms);
					$sms = str_replace("<School Name>",ucfirst($college->config_value),$sms);
					//$sms = $holiday->title.' ('.$holiday_date.') : Tomorrow is a holiday for all students and staff of '.ucfirst($college->config_value);
					/*$subject = 'Holiday Notice ('.$holiday_date.')';
					$message = 'This is for the information to all the Students, Academic and Administrative staff of '.ucfirst($college->config_value).' that '.$holiday_date.' will be a holiday for the institution.<br/>';
					$message = $message.'<b>'.$holiday_date.' : '.$holiday->title.'</b><br/>';
					$message = $message.'Description : '.$holiday->desc;*/
				}
				
				if($notification->mail_enabled == '1')
				{
					$email = EmailTemplates::model()->findByPk(23);					
					$subject = str_replace("{{HOLIDAY DATE}}",$holiday_date,$email->subject);
					$message = str_replace("{{SCHOOL}}",ucfirst($college->config_value),$email->template);
					$message = str_replace("{{HOLIDAY DATE}}",$holiday_date,$message);
					$message = str_replace("{{HOLIDAY TITLE}}",$holiday->title,$message);
					$message = str_replace("{{HOLIDAY DISCRIPTION}}",$holiday->desc,$message);					
				}
				
				if($notification->msg_enabled == '1')
				{
					$subject1 = Yii::t('app','Holiday Notice :').' '.$holiday_date;
					$message1 = Yii::t('app','Hi, This is for the information to all the Students, Academics and Administrative staff of').' '.ucfirst($college->config_value).' '.Yii::t('app','that').' '.$holiday_date.' '.Yii::t('app','will be a holiday for the institution.');
				}
				
			}
			
			if($sms)
			{
				foreach($phone_numbers as $phone_number)
				{
					SmsSettings::model()->sendSms($phone_number,$from,$sms);
				}
				
			}
			
			if($message)
			{
				foreach($emails as $email)
				{
					UserModule::sendMail($email,strip_tags($subject),$message);
				}
			}
			
			if($message1)
			{
				foreach($uid as $to)
				{
					NotificationSettings::model()->sendMessage($to,$subject1,$message1);
				}
			}
			
			
		}
		
	}
	
}