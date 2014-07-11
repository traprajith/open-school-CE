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
class News extends Mailbox
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function isNew($userid)
	{
		/*
		 * If your database keeps track of user logins date/time you could rewrite
		 * this method to return true if the modified timestamp is greater than
		 * (ie. more recent) the user's previous login timestamp (ie the last time
		 * the user successfully logged-in, not counting the current login).
		 */
		/*
		if($this->modified > Yii::app()->user->previousLogin )
			return true;
		return false;
		 */
		
		// for now we just use a static time limit...
		if($this->modified > time() - 3600 * 24 * 7)
			return true;
		return false;
	}
	
	public function delete()
	{
		return $this->destroy();
	}

}