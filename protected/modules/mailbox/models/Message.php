<?php

/**
 * This is the model class for table "{{mailbox_message}}".
 *
 * The followings are the available columns in table '{{mailbox_message}}':
 * @property string $message_id
 * @property string $conversation_id
 * @property string $created
 * @property string $sender_id
 * @property string $recipient_id
 * @property string $text
 * @property string $is_kiss
 * @property string $is_readable
 * @property string $hash
 */
class Message extends CActiveRecord
{
	public $modified;
	public $subject;
	public $is_replied;
	public $initiator_id;
	public $bm_read;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return MailboxModule::TBL_MSG;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$module =& Yii::app()->controller->module;
		$p = new CHtmlPurifier();
		if(Yii::app()->controller->module->isAdmin())
			$p->options = $module->adminHtml;
		else
			$p->options = $module->html;
		return array(
			array('text', 'required'),
			array('created, sender_id, recipient_id', 'length', 'max'=>10),
			array('text','filter','filter'=>array($p,'purify')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('message_id, conversation_id, created, sender_id, recipient_id, text, hash', 'safe', 'on'=>'search'),
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
                    'conversation'=>array(self::HAS_ONE, 'Mailbox','conversation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'message_id' => 'Message',
			'conversation_id' => 'Conversation Id',
			'created' => 'Time Stamp',
			'sender_id' => 'Sender',
			'recipient_id' => 'Recipient',
			'text' => 'Text',
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

		$criteria->compare('message_id',$this->message_id,true);
		$criteria->compare('conversation_id',$this->conversation_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('recipient_id',$this->recipient_id,true);
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function conversation($conversation_id)
	{
		if(!preg_match('/^[0-9]+$/',$conversation_id))
			die('Conversation Id must be an integer:'.$conversation_id);
		$this->getDbCriteria()->mergeWith(array(
			'select'=>'*',
			'condition'=>'conversation_id = :cid',
			'params'=>array(':cid'=>$conversation_id)
		));
		return $this;
	}
	
	public function sent($userid)
	{
		
		$this->getDbCriteria()->mergeWith(array(
			'select'=>'m.message_id,  m.sender_id, m.recipient_id, 
			m.text, m.created,
			c.conversation_id, c.initiator_id , c.interlocutor_id, c.subject, c.bm_read, 
			c.bm_deleted, c.modified, c.is_system,
			ms.created as is_replied',
			'alias'=>'m',
			'join'=>"
			INNER JOIN ".MailboxModule::TBL_CONV."  AS c ON(c.conversation_id=m.conversation_id)
			LEFT JOIN (
				SELECT conversation_id, created FROM ".MailboxModule::TBL_MSG." 
				WHERE recipient_id=:userid AND created
			) AS ms ON(ms.conversation_id=m.conversation_id AND ms.created > m.created)
			",
			'condition'=>'sender_id=:userid',
			'order'=>"m.created DESC",
			'params'=>array(':userid'=>$userid),
		));
		return $this;
		
		/* old */
		$is_replied = "
			INNER JOIN (
				SELECT conversation_id, IF(sender_id=:userid,'yes','no') AS is_replied FROM ".MailboxModule::TBL_MSG." 
				WHERE (recipient_id=:userid OR sender_id=:userid) ORDER BY created DESC 
			) AS ms ON(ms.conversation_id=c.conversation_id)";
	}
	
	public static function crc64($text)
	{
		$crc64 = sprintf('%u',hash('crc32', $text)) . sprintf('%u',hash('crc32b', $text));
		return base_convert($crc64,16,10); // 64bit INT
	}
	
	public function isRead($userid)
	{
		if($this->is_replied)
			return 1;
		if($this->initiator_id == Yii::app()->controller->module->getUserId() )
			$flag = Mailbox::INTERLOCUTOR_FLAG;
		else
			$flag = Mailbox::INITIATOR_FLAG;
		
		return $this->bm_read & $flag;
	}
}