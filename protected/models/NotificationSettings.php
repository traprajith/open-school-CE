<?php

/**
 * This is the model class for table "notification_settings".
 *
 * The followings are the available columns in table 'notification_settings':
 * @property integer $id
 * @property string $settings_key
 * @property integer $sms_enabled
 * @property integer $mail_enabled
 * @property integer $msg_enabled
 */
class NotificationSettings extends CActiveRecord
{
	public $sms_all;
	public $mail_all;
	public $msg_all;
	public $student_all;
	public $parent_1_all;	
	public $employee_all;
	public $sms_std_ad;
	public $mail_std_ad;
	public $msg_std_ad;
	public $sms_std_attnd;
	public $mail_std_attnd;
	public $msg_std_attnd;
	public $sms_emp_apmnt;
	public $mail_emp_apmnt;
	public $msg_emp_apmnt;
	public $sms_exm_schedule;
	public $mail_exm_schedule;
	public $msg_exm_schedule;
	public $sms_exm_result;
	public $mail_exm_result;
	public $msg_exm_result;
	public $sms_fees;
	public $mail_fees;
	public $msg_fees;
	public $sms_library;
	public $mail_library;
	public $msg_library;
	public $sms_student_log;
	public $mail_student_log;
	public $msg_student_log;
	public $sms_user;
	public $mail_user;
	public $msg_user;
	public $sms_online_admission;
	public $mail_online_admission;
	public $sms_online_admission_approval;
	public $mail_online_admission_approval;
	public $msg_online_admission_approval;
	public $sms_application_status_change;
	public $mail_application_status_change;
	public $sms_public_holidays;
	public $mail_public_holidays;
	public $msg_public_holidays;
	
	public $student_std_ad;
	public $parent_1_std_ad;	
	
	public $parent_1_std_attnd;
			
	public $employee_emp_apmnt;
	
	public $student_exm_schedule;
		
	public $student_exm_result;	
	
	public $student_fees;
	public $parent_1_fees;
			
	public $student_library;
		
	public $student_student_log;
	public $parent_1_student_log;
		
	public $student_user;
	public $parent_1_user;
	
	public $employee_user;
	
	public $student_online_admission;
	public $parent_1_online_admission;
		
	public $student_online_admission_approval;
	public $parent_1_online_admission_approval;
		
	public $student_application_status_change;
	public $parent_1_application_status_change;
		
	public $student_public_holidays;
	public $parent_1_public_holidays;
	
	public $employee_public_holidays;
	
	public $sms_behaviour;
	public $mail_behivour;
	public $employee_behaviour;
	
	public $sms_hostel;
	public $mail_hostel;
	public $msg_hostel;
	public $student_hostel;
	
	public $sms_document;
	public $mail_document;
	public $student_document;
	public $parent_1_document;
        
        public $sms_userlogin;
	public $mail_userlogin;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return NotificationSettings the static model class
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
		return 'notification_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('settings_key', 'required'),
			array('sms_enabled, mail_enabled, msg_enabled', 'numerical', 'integerOnly'=>true),
			array('settings_key', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, settings_key, sms_enabled, mail_enabled, msg_enabled, student, parent_1, employee', 'safe', 'on'=>'search'),
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
			'settings_key' => Yii::t("app",'Settings Key'),
			'sms_enabled' => Yii::t("app",'Sms Enabled'),
			'mail_enabled' => Yii::t("app",'Mail Enabled'),
			'msg_enabled' => Yii::t("app",'Msg Enabled'),
			'student' => Yii::t("app",'Student'),
			'parent_1' => Yii::t("app",'Guardian 1'),			
			'employee' => Yii::t("app",'Teacher'),
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
		$criteria->compare('settings_key',$this->settings_key,true);
		$criteria->compare('sms_enabled',$this->sms_enabled);
		$criteria->compare('mail_enabled',$this->mail_enabled);
		$criteria->compare('msg_enabled',$this->msg_enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function sendMessage($to,$subject,$message)
	{
				
		if(isset($to))
		{
			$t = time();
			$conv = new Mailbox();
			$conv->subject = ($subject)? $subject : Yii::app()->getModule('mailbox')->defaultSubject;
			$conv->to = $to;
			$conv->initiator_id = Yii::app()->getModule('mailbox')->getUserIdMail();

			// Check if username exist
			if(strlen($to)>1)
				$conv->interlocutor_id = Yii::app()->getModule('mailbox')->getUserIdMail($to);
			else
				$conv->interlocutor_id = 0;
			// ...if not check if To field is user id
			if(!$conv->interlocutor_id)
			{
				if($to && (Yii::app()->getModule('mailbox')->allowLookupById || Yii::app()->getModule('mailbox')->isAdmin()))
					$username = Yii::app()->getModule('mailbox')->getUserName($to);
				if(@$username) {
					$conv->interlocutor_id = $to;
					$conv->to = $username;
				}
				else {
					// possible that javscript was off and user selected from the userSupportList drop down.
					if( Yii::app()->getModule('mailbox')->getUserIdMail($to)) {
						$conv->to = $to;
						$conv->initiator_id = Yii::app()->getModule('mailbox')->getUserIdMail($to);
					}
					else
						$conv->addError('to',Yii::t("app",'User not found?'));
				}
			}
			
			if($conv->interlocutor_id && $conv->initiator_id == $conv->interlocutor_id) {
				$conv->addError('to', Yii::t("app","Can't send message to self!"));
			}
			
			if(!Yii::app()->getModule('mailbox')->isAdmin() && $conv->interlocutor_id == Yii::app()->getModule('mailbox')->newsUserId){
				$conv->addError('to', Yii::t("app","User not found?"));
			}
			
			// check user-to-user perms
			if(!$conv->hasErrors() && !Yii::app()->getModule('mailbox')->userToUser && !Yii::app()->getModule('mailbox')->isAdmin())
			{
				if(!Yii::app()->getModule('mailbox')->isAdmin($conv->to))
					$conv->addError('to', Yii::t("app","Invalid user!"));
			}
			
			$conv->modified = $t;
			$conv->bm_read = Mailbox::INITIATOR_FLAG;
			if(Yii::app()->getModule('mailbox')->isAdmin())
				$msg = new Message('admin');
			else
				$msg = new Message('user');
			$msg->text = $message;
			$validate = $conv->validate(array('text'),false); // html purify
			$msg->created = $t;
			$msg->sender_id = $conv->initiator_id;
			$msg->recipient_id = $conv->interlocutor_id;
			if(Yii::app()->getModule('mailbox')->checksums) {
				$msg->crc64 = Message::crc64($msg->text); // 64bit INT
			}
			else
				$msg->crc64 = 0;
			// Validate
			$validate = $conv->validate(null,false); // don't clear errors
			$validate = $msg->validate() && $validate;
			
			if($validate)
			{
				$conv->save();
				$msg->conversation_id = $conv->conversation_id;
				$msg->save();
				//Yii::app()->user->setFlash('success', "Message has been sent!");
				//$this->redirect(array('message/inbox'));
				return Yii::t("app",'success');
			}
			else
			{
				//Yii::app()->user->setFlash('error', "Error sending message!");
				return Yii::t("app",'error');
			}
		}
	}
}