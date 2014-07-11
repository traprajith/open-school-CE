<?php

/**
 * This is the model class for table "{{messages}}".
 *
 * The followings are the available columns in table '{{messages}}':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $subject
 * @property string $body
 * @property string $is_read
 * @property string $deleted_by
 * @property string $created_at
 */
class Message extends CActiveRecord
{
	const DELETED_BY_RECEIVER = 'receiver';
	const DELETED_BY_SENDER = 'sender';

	public $userModel;
	public $userModelRelation;

	public $unreadMessagesCount;

	public function __construct($scenario = 'insert') {
		$this->userModel = Yii::app()->getModule('message')->userModel;
		$this->userModelRelation = Yii::app()->getModule('message')->userModelRelation;
		return parent::__construct($scenario);
	}


	/**
	 * Returns the static model of the specified AR class.
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
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, receiver_id', 'required'),
			array('sender_id, receiver_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'required'),
			array('subject', 'length', 'max'=>256),
			array('is_read', 'length', 'max'=>1),
			array('deleted_by', 'length', 'max'=>8),
			array('body', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, receiver_id, subject, body, is_read, deleted_by, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

		$module = Yii::app()->getModule('message');

		return array(
			'receiver' => $module->receiverRelation ? $module->receiverRelation : array(CActiveRecord::BELONGS_TO, $module->userModel, 'receiver_id'),
			'sender' => $module->senderRelation ? $module->senderRelation : array(CActiveRecord::BELONGS_TO, $module->userModel, 'sender_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender_id' => 'Sender',
			'receiver_id' => 'Receiver',
			'subject' => 'Subject',
			'body' => 'Body',
			'is_read' => 'Is Read',
			'deleted_by' => 'Deleted By',
			'created_at' => 'Created At',
		);
	}

	protected function beforeSave()
	{
		if($this->isNewRecord) {
			if ($this->hasAttribute('created_at')) {
			    $this->created_at = Date('Y-m-d H:i:s');
			}
		}
		return parent::beforeSave();
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
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('is_read',$this->is_read,true);
		$criteria->compare('deleted_by',$this->deleted_by,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getSenderName() {
		if ($this->sender) {
		    return call_user_func(array($this->sender, Yii::app()->getModule('message')->getNameMethod));
		}
	}

	public function getReceiverName() {
		if ($this->receiver) {
		    return call_user_func(array($this->receiver, Yii::app()->getModule('message')->getNameMethod));
		}
	}

	public static function getAdapterForInbox($userId) {
		$c = new CDbCriteria();
		$c->addCondition('t.receiver_id = :receiverId');
		$c->addCondition('t.deleted_by <> :deleted_by_receiver OR t.deleted_by IS NULL');
		$c->order = 't.created_at DESC';
		$c->params = array(
			'receiverId' => $userId,
			'deleted_by_receiver' => Message::DELETED_BY_RECEIVER,
		);
		$messagesProvider = new CActiveDataProvider('Message', array('criteria' => $c));
		return $messagesProvider;
	}

	public static function getAdapterForSent($userId) {
		$c = new CDbCriteria();
		$c->addCondition('t.sender_id = :senderId');
		$c->addCondition('t.deleted_by <> :deleted_by_sender OR t.deleted_by IS NULL');
		$c->order = 't.created_at DESC';
		$c->params = array(
			'senderId' => $userId,
			'deleted_by_sender' => Message::DELETED_BY_SENDER,
		);
		$messagesProvider = new CActiveDataProvider('Message', array('criteria' => $c));
		return $messagesProvider;
	}

	public function deleteByUser($userId) {

		if (!$userId) {
			return false;
		}

		if ($this->sender_id == $this->receiver_id && $this->receiver_id == $userId) {
			$this->delete();
			return true;
		}

		if ($this->sender_id == $userId) {
			if ($this->deleted_by == self::DELETED_BY_RECEIVER) {
				$this->delete();
			} else {
				$this->deleted_by = self::DELETED_BY_SENDER;
				$this->save();
			}

			return true;
		}

		if ($this->receiver_id == $userId) {
			if ($this->deleted_by == self::DELETED_BY_SENDER) {
				$this->delete();
			} else {
				$this->deleted_by = self::DELETED_BY_RECEIVER;
				$this->save();
			}

			return true;
		}

		// message was not deleted
		return false;
	}

	public function markAsRead() {
		if (!$this->is_read) {
			$this->is_read = true;
			$this->save();
		}
	}

	public function getCountUnreaded($userId) {
		if (!$this->unreadMessagesCount) {
			$c = new CDbCriteria();
			$c->addCondition('t.receiver_id = :receiverId');
			$c->addCondition('t.deleted_by <> :deleted_by_receiver OR t.deleted_by IS NULL');
			$c->addCondition('t.is_read = "0"');
			$c->params = array(
				'receiverId' => $userId,
				'deleted_by_receiver' => Message::DELETED_BY_RECEIVER,
			);
			$count = self::model()->count($c);
			$this->unreadMessagesCount = $count;
		}

		return $this->unreadMessagesCount;
	}
}
