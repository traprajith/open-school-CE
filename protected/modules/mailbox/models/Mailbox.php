<?php

/**
 * This is the model class for table "{{mailbox_conversation}}".
 *
 * The followings are the available columns in table '{{mailbox_conversation}}':
 * @property string $conversation_id
 * @property integer $initiator_id
 * @property integer $interlocutor_id
 * @property string $subject
 * @property integer $bm_read
 * @property integer $bm_deleted
 * @property string $modified
 * @property string $is_system
 */
class Mailbox extends CActiveRecord
{
	const INITIATOR_FLAG = 1;
	const INTERLOCUTOR_FLAG = 2;
	public $to;
	public $text;
	public $sender_id;
	public $is_replied;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Mailbox the static model class
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
		return MailboxModule::TBL_CONV;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('initiator_del,interlocutor_del', 'default', 'setOnEmpty'=>true, 'value'=>null ),
			array('initiator_id, interlocutor_id, modified', 'required'),
			array('initiator_id, interlocutor_id, bm_read, bm_deleted, initiator_del, interlocutor_del', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>100),
			array('modified', 'length', 'max'=>10),
			array('is_system', 'length', 'max'=>3),
			array('subject','match','pattern'=>'/[^'.Yii::app()->controller->module->allowableCharsSubject.']+/i','not'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('conversation_id, initiator_id, interlocutor_id, subject, bm_read, bm_deleted, modified, is_system', 'safe', 'on'=>'search'),
			array('to','length','max'=>30),
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
                    'initiator'=>array(self::BELONGS_TO, 'User','initiator_id'),
                    'interlocutor'=>array(self::BELONGS_TO, 'User','interlocutor_id'),
		    'messages'=>array(self::HAS_MANY , 'Message','conversation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'conversation_id' => 'Id',
			'initiator_id' => 'From Id',
			'interlocutor_id' => 'To Id',
			'to' => 'To',
			'subject' => 'Subject',
			'last_message_ts' => 'Last Message Received',
			'modified' => 'Last Modified',
			'is_system' => 'Is System',
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

		$criteria->compare('conversation_id',$this->conversation_id,true);
		$criteria->compare('initiator_id',$this->initiator_id);
		$criteria->compare('interlocutor_id',$this->interlocutor_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('bm_read',$this->bm_read);
		$criteria->compare('bm_deleted',$this->bm_deleted);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('is_system',$this->is_system,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function trash($userid)
	{
		
		$this->getDbCriteria()->mergeWith(array(
			'select'=>'m.message_id, m.conversation_id as conversation, COUNT(m.message_id) AS mails_count, m.sender_id, m.recipient_id, 
			m.text, m.created AS last_message_ts, ms.is_replied, 
			c.conversation_id, c.initiator_id, c.interlocutor_id, c.subject, c.bm_read, 
			c.bm_deleted, c.modified, c.is_system',
			'alias'=>'c',
			'join'=>"INNER JOIN (
				SELECT message_id,conversation_id, sender_id,recipient_id,text,created FROM ".MailboxModule::TBL_MSG." 
				WHERE sender_id=:userid OR recipient_id=:userid ORDER BY created DESC  
			) AS m ON(m.conversation_id=c.conversation_id) 
			INNER JOIN (
				SELECT conversation_id, IF(sender_id=:userid,1,0) AS is_replied FROM ".MailboxModule::TBL_MSG." 
				WHERE (recipient_id=:userid OR sender_id=:userid) ORDER BY created DESC 
			) AS ms ON(ms.conversation_id=c.conversation_id)",
			'condition'=>'(initiator_id=:userid OR interlocutor_id=:userid) AND IF(initiator_id=:userid,initiator_del,interlocutor_del) > 0',
			'group'=>"c.conversation_id",
			'order'=>"MAX( m.created ) DESC",
			'params'=>array(':userid'=>$userid,
				      ':bminit'=>self::getBitMaskValues(self::INITIATOR_FLAG),
				      ':bminter'=>self::getBitMaskValues(self::INTERLOCUTOR_FLAG)),
		));
		return $this;
	}
	
	public function inbox($userid)
	{
		$this->getDbCriteria()->mergeWith(array(
			'select'=>'
			m.message_id, m.conversation_id as conversation, 
			COUNT(m.message_id) AS mails_count, m.sender_id, m.recipient_id, 
			m.text, m.created AS last_message_ts, ms.is_replied, 
			c.conversation_id, c.initiator_id, c.interlocutor_id, c.subject, c.bm_read, 
			c.bm_deleted, c.modified, c.is_system',
			'alias'=>'c',
			'join'=>"INNER JOIN (
				SELECT message_id,conversation_id, sender_id,recipient_id,text,created FROM ".MailboxModule::TBL_MSG." 
				WHERE recipient_id=:userid ORDER BY created DESC  
			) AS m ON(m.conversation_id=c.conversation_id) 
			INNER JOIN (
				SELECT conversation_id, IF(sender_id=:userid,1,0) AS is_replied FROM ".MailboxModule::TBL_MSG." 
				WHERE (recipient_id=:userid OR sender_id=:userid) ORDER BY created DESC 
			) AS ms ON(ms.conversation_id=c.conversation_id)",
			'condition'=>'(c.initiator_id=:userid OR c.interlocutor_id=:userid) AND (c.bm_deleted & IF(c.initiator_id=:userid,:bminit,:bminter)) = 0',
			'group'=>"c.conversation_id",
			'order'=>"MAX( m.created ) DESC",
			'params'=>array(':userid'=>$userid, 
				      ':bminit'=>self::INITIATOR_FLAG,
				      ':bminter'=>self::INTERLOCUTOR_FLAG),
		));
		return $this;
	}
	
	public function conversations($userid,$type='deleted')
	{
		switch ($type) {
			case 'deleted':
				$where = "c.initiator_del > 0 OR c.interlocator_del > 0";
				break;
			default: $where = 'c.bm_deleted != 3';
		}
		$query = "SELECT m.message_id, m.conversation_id, COUNT(m.message_id) AS mails_count, m.sender_id, m.recipient_id, 
			m.text, m.created AS last_message_ts, ms.is_replied, 
			c.conversation_id, c.initiator_id, c.interlocutor_id, c.subject, c.bm_read, 
			c.bm_deleted, c.modified, c.is_system
			FROM ".MailboxModule::TBL_CONV." AS c
			WHERE $where";
		
		$sql = Yii::app()->db->createCommand($query);
		$sql->bindValue(':userid',$userid,PDO::PARAM_STR);
		$sql->bindValue(':bminit',self::getBitMaskValues(self::INITIATOR_FLAG),PDO::PARAM_STR);
		$sql->bindValue(':bminter',self::getBitMaskValues(self::INTERLOCUTOR_FLAG),PDO::PARAM_STR);
		//$sql->bindParam(':page',$page,PDO::PARAM_INT);
		//$sql->bindParam(':perpage',$perpage,PDO::PARAM_INT);
		$convs = $sql->queryAll();
		
		// or using: $rawData=User::model()->findAll();
		$dataProvider=new CArrayDataProvider($convs, array(
			'keyField'=>'conversation_id',
			'id'=>'inboxDataProvider',
			'sort'=>array(
				'attributes'=>array(
				'subject',  'last_message_ts', 'sender_id',
				// 'mails_count','initiator_id', 'interlocutor_id', 'recipient_id', 'text', 
				// 'bm_read','bm_deleted', 'is_system', 'is_readable', 'is_replied', 'conversation_id',
				),
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->pageSize,
			),
		));
		
		return $dataProvider;
	}
	
	public static function newMsgs($userid)
	{
		// count messages
		$query = "SELECT SQL_CACHE COUNT(c.conversation_id) AS num_messages
			FROM ".MailboxModule::TBL_CONV." AS c
			INNER JOIN (
				SELECT message_id,conversation_id FROM mailbox_message
				WHERE recipient_id=:userid  ORDER BY created DESC
			) AS m ON(m.conversation_id=c.conversation_id)
			WHERE (c.initiator_id=:userid OR c.interlocutor_id=:userid)
			AND (c.bm_read & IF(c.initiator_id=:userid, :bminit, :bminter)) = 0
			AND (c.bm_deleted & IF(c.initiator_id=:userid, :bminit, :bminter)) = 0
			GROUP BY c.conversation_id
			";
		$sql = Yii::app()->db->createCommand($query);
		$sql->bindValue(':userid',$userid,PDO::PARAM_STR);
		$sql->bindValue(':bminit',self::INITIATOR_FLAG,PDO::PARAM_STR);
		$sql->bindValue(':bminter',self::INTERLOCUTOR_FLAG,PDO::PARAM_STR);
		
		
		$convs = $sql->queryAll();
		$count=0;
		foreach($convs as &$conv) {
			if ($conv['num_messages'] >= 1)
				$count++;
		}
		return $count;
	}
	
	public function deleted()
	{
		$this->getDbCriteria()->mergeWith(array(
			'select'=>'conversation_id, initiator_id, interlocutor_id, c.bm_deleted, c.modified, c.is_system',
			'condition'=>'c.initiator_del > 0 OR c.interlocutor_del > 0',
		));
		return $this;
	}
	
	
	public static function conversation($id,$order='DESC')
	{
		if(!is_int((int)$id))
			throw new Exception('Bad conversation Id');
		$with = array('messages'=>array('order'=>'created '.$order));
		return Mailbox::model()->with($with)->findByPk($id);
	}
	
	
	public function markRead($userid)
	{
		if($this->initiator_id == $userid)
			$this->bm_read = $this->bm_read | Mailbox::INITIATOR_FLAG;
		else
			$this->bm_read = $this->bm_read | Mailbox::INTERLOCUTOR_FLAG;
		$this->updateByPk($this->conversation_id,array('bm_read'=>$this->bm_read));
	}
	
	public function belongsTo($userid)
	{
		return ($this->initiator_id == $userid || $this->interlocutor_id == $userid);
	}
	
	public function isNew($userid)
	{
		if($this->initiator_id == $userid )
			$flag = self::INITIATOR_FLAG;
		else
			$flag = self::INTERLOCUTOR_FLAG;
		
		return !($this->bm_read & $flag);
	}
	
	/*
	 * Button Actions
	 */
	public function read($userid)
	{
		if($this->initiator_id == $userid) {
			$this->bm_read = $this->bm_read | self::INITIATOR_FLAG;
		}
		elseif($this->interlocutor_id == $userid) {
			$this->bm_read = $this->bm_read | self::INTERLOCUTOR_FLAG;
		}
		else
			throw new Exception('User denied');
		return true;
	}
	
	public function unread($userid)
	{
		if($this->initiator_id == $userid) {
			$this->bm_read = $this->bm_read & ~self::INITIATOR_FLAG;
		}
		elseif($this->interlocutor_id == $userid) {
			$this->bm_read = $this->bm_read & ~self::INTERLOCUTOR_FLAG;
		}
		else
			throw new Exception('User denied');
		return true;
	}
	
	public function restore($userid)
	{
		if($this->initiator_id == $userid) {
			$this->bm_deleted = $this->bm_deleted & ~self::INITIATOR_FLAG;
			$this->initiator_del = 0;
		}
		elseif($this->interlocutor_id == $userid) {
			$this->bm_deleted = $this->bm_deleted & ~self::INTERLOCUTOR_FLAG;
			$this->interlocutor_del = 0;
		}
		else throw new Exception('User denied');
		
		return true;
	}
	
	/**
	 * Delete the conversation in respect to user's perspective. When both initiator and interlocutor have 
	 * permenently deleted the conversation, only then is the conversation actually removed from the
	 * database. If 'trashbox' is enabled in the module configs then instead of marking the conversation
	 * as permanently deleted by that user, the conversation is moved to the trash folder by setting
	 * {perspective}_del field to the day of the half-year "date('z') / 2" that the message was deleted. 
	 * Also if 'trashbox' is enabled then the cron method in MailboxModule must be ran at least once
	 * daily in order to check the number of days the message has been in the trash folder, and delete it 
	 * permenantly if days is more than config var 'recyclePeriod'.
	 * 
	 * @param integer $userid the user's Id in which to delete the conversation in respect to. The parameter
	 * declaration is given a default value in order to overload the parents delete method and ensure that
	 * conversations are deleted via the destroy method.
	 * @return boolean true on success
	 */
	public function delete($userid=0)
	{
		//die((int)Yii::app()->controller->module->recyclePeriod);
		if(!$userid)
			throw new Exception('User Id must be supplied for delete method');
		$day = date("z") + 1;
		if($day > 183)
			$day = $day - 183;
		if($this->initiator_id == $userid) {
			// mark deleted
			$this->bm_deleted = $this->bm_deleted | self::INITIATOR_FLAG;
			// check if in trash already, or if trashbox is disabled
			if((!$this->initiator_del &$this->initiator_del > Yii::app()->controller->module->recyclePeriod)
				|| !Yii::app()->controller->module->trashbox) {
				// permanently delete
				$this->initiator_del = null;
			} else {
				
				// move to trash
				$this->initiator_del = $day;	
			}
		}
		elseif($this->interlocutor_id == $userid) {
			// mark deleted
			$this->bm_deleted = $this->bm_deleted | self::INTERLOCUTOR_FLAG;
			// check if in trash already, or if trashbox is disabled
			if($this->interlocutor_del > Yii::app()->controller->module->recyclePeriod || !Yii::app()->controller->module->trashbox) {
				// permanently delete
				$this->interlocutor_del = null;
			} else {
				// move to trash
				$this->interlocutor_del = $day;	
			}
		}
		else
			throw new Exception('User denied');
		
		// if both parties have permanently deleted conversation
		if(is_null($this->initiator_del) && is_null($this->interlocutor_del))
		{
			// delete conversation and messages from database
			$this->destroy();
		}
		return true;
	}
	/*
	 * End button actions
	 */
	
	/**
	 * This method is used by the cron method in the MailboxModule class to determine when a conversation
	 * should be marked as permanently deleted by a user depending on the recycling period defined in the
	 * module configs by the attribute 'recyclePeriod'. And if both users have the conversation marked
	 * as permanently deleted then remove the conversation from the database.
	 * 
	 * @param integer $mask 
	 * @param boolean $string_presentation
	 * @return string|array
	 */
	public function recycle()
	{
		// check initiator trash
		if($this->initiator_del > 0)
		{
			// if not within recycling period
			if(!self::withinDays(Yii::app()->controller->module->recyclePeriod,
					    $this->initiator_del)) {
				// mark permanently deleted
				$this->initiator_del = null;
			}
		}
		// check interlocutor trash
		if($this->interlocutor_del > 0)
		{
			// if not within recycling period
			if(!self::withinDays(Yii::app()->controller->module->recyclePeriod,
					    $this->interlocutor_del)) {
				// mark permanently deleted
				$this->interlocutor_del = null;
			}
		}
		// if both marked as permanently deleted
		if(is_null($this->initiator_del) && is_null($this->interlocutor_del))
		{
			// delete this conversation from database
			$this->destroy();
		}
		else{
			// otherwise save possible changes
			$this->save();
		}
	}
	
	public function destroy()
	{
		// delete all conversation messages
		$msg_count=Message::model()->deleteAll('conversation_id = :cid',array(':cid'=>$this->conversation_id));
		if(!$msg_count)
			throw new Exception('Conversation messages not found?');
		
		// delete conversation
		return parent::delete();
	}
	
	
	/**
	 * Get array of values that make up mask.
	 * 
	 * @param integer $mask 
	 * @param boolean $string_presentation
	 * @return string|array
	 */
	public static function getBitMaskValues( $mask, $string_presentation = true )
	{
		$available_mask_arr = array(self::INITIATOR_FLAG, self::INTERLOCUTOR_FLAG);
		
		if ( in_array( $mask, $available_mask_arr ) )
		{
			$values_count = pow( 2, 2 );
			if ( $string_presentation )
			{
				$return_arr = "";
				for ( $i = 1; $i < $values_count; $i++ )
					if ( ($mask & $i) == $mask )
						$return_arr .= $i.", ";
						
				return substr( $return_arr, 0, -2 );
			}
			else 
			{
				$return_arr = array();
				for ( $i = 1; $i < $values_count; $i++ )
					if ( ($mask & $i) == $mask )
						$return_arr[$i] = $i;
				return $return_arr;
			}
		}
	}
	
	public static function withinDays($period,$deleted_on)
	{
		$day = date("z") + 1;
		if($day > 183)
			$day = $day - 183;
		elseif($day < $deleted_on)
			$day += 183;
		
		if( ($day - $deleted_on) <= $period )
			return true;
		
		return false;
	}
}