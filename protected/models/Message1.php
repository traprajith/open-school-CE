<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $msg_id
 * @property string $subject
 * @property string $msg_content
 * @property string $msg_uploads
 * @property integer $user_id
 * @property string $msg_time
 * @property string $msg_date
 * @property integer $is_read
 */
class Message extends CActiveRecord
{
	/* PROPERTY FOR RECEIVING THE FILE FROM FORM*/       
	public $msg_uploads;
	public $to;
	public $attribute_id;	
							
							
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
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, msg_content, msg_time, msg_date,to', 'required'),
			array('user_id, is_read, sender_id, user_id, is_task, is_deleted', 'numerical', 'integerOnly'=>true),
			array('subject, msg_uploads', 'length', 'max'=>120),
			array('msg_content', 'length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('msg_id, subject, msg_content, msg_uploads, user_id, msg_time, msg_date, is_read', 'safe', 'on'=>'search'),
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
			'msg_id' => 'Msg',
			'subject' => 'Subject',
			'msg_content' => 'Msg Content',
			'msg_uploads' => 'Msg Uploads',
			'user_id' => 'User',
			'msg_time' => 'Msg Time',
			'msg_date' => 'Msg Date',
			'is_read' => 'Is Read',
			'is_task' => 'Is Task'
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

		$criteria->compare('msg_id',$this->msg_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('msg_content',$this->msg_content,true);
		$criteria->compare('msg_uploads',$this->msg_uploads,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('msg_time',$this->msg_time,true);
		$criteria->compare('msg_date',$this->msg_date,true);
		$criteria->compare('is_read',$this->is_read);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	public function actionSearch($term)
     {
          if(Yii::app()->request->isAjaxRequest && !empty($term))
        {
              $variants = array();
              $criteria = new CDbCriteria;
              $criteria->select='tag';
              $criteria->addSearchCondition('tag',$term.'%',false);
              $tags = tagsModel::model()->findAll($criteria);
              if(!empty($tags))
              {
                foreach($tags as $tag)
                {
                    $variants[] = $tag->attributes['tag'];
                }
              }
              echo CJSON::encode($variants);
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
     }
	
	
	// functions
	
	public function setMsg()
	{
	
			$connection = Yii::app()->db;
			$sql="SELECT * FROM user";
			$command = $connection->createCommand($sql);
			$results = $command->queryAll();
			return $results;
	
	}
	
	public function setGroup()
	{
	
			$connection = Yii::app()->db;
			$sql="SELECT * FROM groups";
			$command = $connection->createCommand($sql);
			$results = $command->queryAll();
			return $results;
	
	}
	public function getMsg($id)
	{

        $i=0;
		$connection = Yii::app()->db;
		$sql="SELECT t1.message_id,t1.user_id FROM message_user AS t1 INNER JOIN message AS t2 ON t1.message_id = t2.msg_id WHERE t2.is_task IS NULL ORDER BY t2.msg_id DESC";
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
		
		$data=array();
		foreach($results as $temp)
		{
		//print_r($temp['user_id']);
		$msg=$temp['message_id'];
		
		
		$value1 = explode(",",$temp['user_id']);
		//print_r($value1);
		foreach($value1 as $value2)
		{ 
		
		  
	     //print_r($value2);
		 if($value2==$id)
		 {
		 //echo 'message';
		 //print_r($msg);

		 $data[$i]=$msg;
		 $i++;
		 }
		 
		}
		
		} 
       
		return $data;
     }
	 
	 
	 
	 public function getTasks($id,$status)
	{

        $i=0;
		$connection = Yii::app()->db;
		$sql="SELECT t1.message_id,t1.user_id FROM message_user AS t1 INNER JOIN message AS t2 ON t1.message_id = t2.msg_id WHERE t2.is_task IS NOT NULL ORDER BY t2.msg_id DESC";
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
		$data=array();
		foreach($results as $temp)
		{
		//print_r($temp['user_id']);
		$msg=$temp['message_id'];
		
		
		
		$task=TaskAssignToPatients::model()->findByAttributes(array('id'=>$msgids->is_task,'status'=>$status));
		if($task != NULL )
		{
		$value1 = explode(",",$temp['user_id']);
		//print_r($value1);
		foreach($value1 as $value2)
		{ 
	     //print_r($value2);
		 if($value2==$id)
		 {
		 

		 $data[$i]=$msg;
		 $i++;
		 }
		 }
		 }
		 else if($status=='T')
		 {$value1 = explode(",",$temp['user_id']);
		//print_r($value1);
		foreach($value1 as $value2)
		{ 
	     //print_r($value2);
		 if($value2==$id)
		 {
		 

		 $data[$i]=$msg;
		 $i++;
		 }
		
		 
		}
		}
		}

		return $data;
     }
	 
	 
	 
	 
	 
			
		public function getMsgcontent($msgid)
		{
		
			  $connection = Yii::app()->db;
			$sql="SELECT * FROM message WHERE msg_id =".$msgid;
			$command = $connection->createCommand($sql);
			$users= $command->queryAll();
			return $users;
		}
		public function getMsgvalue($msgid)
		{
		
			$connection = Yii::app()->db;
		    $sql="SELECT t1.subject, t1.msg_id, t1.msg_date,t1.user_id,t1.sender_id FROM message AS t1,message_user AS t2 WHERE t1.msg_id=t2.message_id AND t1.user_id=113 AND t1.is_task IS NULL";
			$command = $connection->createCommand($sql);
			$users= $command->queryAll();
			return $users;
		}
		public function getTaskvalue($msgid)
		{
		
			  $connection = Yii::app()->db;
			$sql="SELECT * FROM message WHERE msg_id =".$msgid." AND is_task!='NULL'";
			$command = $connection->createCommand($sql);
			$users= $command->queryAll();
			return $users;
		}
			
    		// TO set Isread	
	public function setRead($msgid)	
	{
	        $connection = Yii::app()->db;
			$sql="UPDATE message SET is_read = 1 WHERE msg_id =".$msgid;
			$command = $connection->createCommand($sql);
			$command->queryAll();
	
	}		


	public function getUnreadMessages()
	{
		/*	$command = Yii::app()->dbadvert->createCommand()
			->select ('*')
			->from('message')
			->where('is_read=0')
			->limit(14,0)
			->order('msg_date desc')
			->queryAll();
			return $command;*/
			$connection = Yii::app()->db;
			$sql = 'SELECT * FROM  `message` WHERE `is_read`=0 ORDER BY  `message`.`msg_date` ASC LIMIT 0 , 30';
			$command = $connection->createCommand($sql);
			$uread_messages = $command->queryAll();
			//For getting total number of messages
			$sql = 'SELECT * FROM  `message` WHERE `is_read`=0';
			$command = $connection->createCommand($sql);
			$total = $command->queryAll();
			$total = sizeof($total);
			return array ($uread_messages,$total);
	}
		public function getSysMessages()
	{
		/*	$command = Yii::app()->dbadvert->createCommand()
			->select ('*')
			->from('message')
			->where('is_read=0')
			->limit(14,0)
			->order('msg_date desc')
			->queryAll();
			return $command;*/
			$connection = Yii::app()->sys_db;
			$sql = 'SELECT * FROM  `messages` WHERE `is_read`=0 ORDER BY  `messages`.`date` ASC LIMIT 0 , 30';
			$command = $connection->createCommand($sql);
			$uread_messages = $command->queryAll();
			//For getting total number of messages
			$sql = 'SELECT * FROM  `messages` WHERE `is_read`=0';
			$command = $connection->createCommand($sql);
			$total = $command->queryAll();
			$total = sizeof($total);
			return array ($uread_messages,$total);
	}
	
	
	// For Message Forward
	public function messageForward()
	{
		$model=new Message;

		

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
			{
			
			    $insert_id = Yii::app()->db->getLastInsertID();
				$list = implode(",", $_POST['msg']);
				//DB Insertion
				$connection = Yii::app()->db;
				$command = $connection->createCommand();
				$results = $command->insert('message_user',array('user_id'=>$list,'message_id'=>$insert_id));
				
				
				}
		}

		
		
	}
	
	
	//To Delete user id from List of Message-User
	
	public function deleteMessage($uid,$mid)
	{
	
	    $connection = Yii::app()->db;
		$sql="SELECT user_id FROM message_user WHERE message_id =".$mid;
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
		
		foreach($results as $temp)
		{
	      //print_r($temp['user_id');
		
		//$msg=$temp['message_id'];
		$list='';
		$value1 = explode(",",$temp['user_id']);
		foreach($value1 as $value2)
		{
	      if($value2!=$uid)
		  {
		 $list .=$value2.',';
		
		}}
		$list1=trim($list,',');
		
		    $connection = Yii::app()->db;
			$sql="UPDATE message_user SET user_id = '".$list1."' WHERE message_id =".$mid;
		    $command = $connection->createCommand($sql);
			$command->execute();
	
		
		}
		
	
	}
	
	// To get message Contents field by field
	public function getMsgcontentView($msgid,$variable)
		{
		
			  $connection = Yii::app()->db;
			$sql="SELECT * FROM message WHERE msg_id =".$msgid;
		
			$command = $connection->createCommand($sql);
			$users= $command->queryAll();
			foreach($users as $users1)
			return $users1[$variable];
		}
		
		//To get Patient Name for Message
		public function getName($id)
	{
	$users = Yii::app()->dbadvert->createCommand()
			->select('patient_lname')
			->from('patients')
			->where('patient_id='.$id)
			->queryAll();
			foreach($users as $users1)
		return $users1['patient_lname'];
	
	
	}
	
	//For Sent Message List
	public function getSentmessage()
	{
	    $connection = Yii::app()->db;
		$sql="SELECT * FROM message_user ORDER BY id DESC";
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
		return $results;
	
	}
	
	public function getUserName($id)
	{
	
	 $connection = Yii::app()->db;
		$sql="SELECT username FROM blog_user WHERE id=".$id;
		$command = $connection->createCommand($sql);
		$results = $command->queryAll();
	
			foreach($results as $users1)
		return $users1['username'];
	
	
	}
	
	public function getPhoto($id)
	{

		$connection = Yii::app()->db;
		$sql="SELECT photo FROM user_details WHERE user_id =".$id;
		$command = $connection->createCommand($sql);	
		$result=$command->queryAll();
		if(count($result) == 0)
		return '<img src="users/user.jpg" width="48" height="51" />';
		else
		return '<img src="users/'.$id.'/'.$result[0]['photo'].'.jpg" width="48" height="51" />';
		
	}
	
	
	public function getPhototask($id)
	{

		$connection = Yii::app()->db;
		$sql="SELECT photo FROM user_details WHERE user_id =".$id;
		$command = $connection->createCommand($sql);	
		$result=$command->queryAll();
		if(count($result) == 0)
		return '<img src="users/user.jpg" width="48" height="51" />';
		else
		return '<img src="users/'.$id.'/'.$result[0]['photo'].'.jpg" width="100" height="100" />';
		
	}
	
	public function getUserPhototask($id)
	{

		$connection = Yii::app()->db;
		$sql="SELECT photo FROM user_details WHERE user_id =".$id;
		$command = $connection->createCommand($sql);	
		$result=$command->queryAll();
		if(count($result) == 0)
		return '<img src="users/user.jpg" width="43" height="43" />';
		else
		return '<img src="users/'.$id.'/'.$result[0]['photo'].'.jpg" width="43" height="43" />';
		
	}
	// Reccurssive Function For Reply Ajax Link and disply Div, Rajith 
	public function getReply1($rid)
	{
	
	$next = Reply::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'rid'=>$rid)); 
	if($next!=NULL)
	{
	$details = Message::model()->findByAttributes(array('msg_id'=>$next->mid));
	
	echo '<div >';
	
                                                
                                                
	echo CHtml::ajaxLink('From &nbsp; ::- '.Message::model()->getUserName($details->sender_id).' &nbsp;  &nbsp;     Subject  &nbsp; ::-   '.$details->subject,Yii::app()->createUrl('Message/message_details' ),
									array('type' =>'GET','data' => array('msg'=>$next->mid),
									'dataType' => 'text','update' =>'#'.$next->mid));
									echo '</div>';
	echo '<div id='.$next->mid.'></div>';
	
	Message::model()->getReply($next->mid);
									
	}
	else
	{
	return ;
	}
	
	}
	
	
	public function getReply($mid)
	{
	
	$next = Reply::model()->findAll(array('order'=>'rid DESC', 'condition'=>'(uid=:x or sid=:y) and mid=:z', 'params'=>array(':x'=>Yii::app()->user->id,':y'=>Yii::app()->user->id,':z'=>$mid)));
	
	
	if($next!=NULL)
	{
	$i=0;
	foreach($next as $next1)
	{
	if($i!=0)
	{
	$details = Message::model()->findByAttributes(array('msg_id'=>$next1['rid']));
	

	echo '<div class="msgacc_Con">';
	
                                                
                                                
	echo CHtml::ajaxLink('&nbsp;<strong>From</strong> &nbsp;:&nbsp;'.Message::model()->getUserName($details->sender_id).'<br/><strong>Subject</strong>  &nbsp;:&nbsp'.$details->subject,Yii::app()->createUrl('Message/message_details' ),
									array('type' =>'GET','data' => array('msg'=>$next1['rid']),
									'dataType' => 'text','update' =>'#'.$next1['rid']));
									echo '</div>';
	echo '<div id='.$next1['rid'].'></div>';
	
	}
	$i++;
	}	
	
	$details = Message::model()->findByAttributes(array('msg_id'=>$mid));
	
	echo '<div class="msgacc_Con">';
	
                                                
                                                
	echo CHtml::ajaxLink('&nbsp;<strong>From</strong> &nbsp;:&nbsp;'.Message::model()->getUserName($details->sender_id).' <br/><strong>Subject</strong>  &nbsp;:&nbsp;'.$details->subject,Yii::app()->createUrl('Message/message_details' ),
									array('type' =>'GET','data' => array('msg'=>$mid),
									'dataType' => 'text','update' =>'#'.$mid));
									echo '</div>';
	echo '<div id='.$mid.'></div>';
	
								
	}
	else
	{
	return ;
	}
	
	}
	
	
	
	
	// Reccurssive Function For Reply ID, Rajith 
	
	public function getReplyid1($mid)
	{
	
	$next = Reply::model()->findByAttributes(array('uid'=>Yii::app()->user->id,'mid'=>$mid)); 
	
	if($next!=NULL)
	{
	
	$rid=Message::model()->getReplyid($next->rid);
	return $rid;
	
	}
	
	return $mid;
	
	}
	
	
	public function getReplycount($mid)
	{
	
	$next = Reply::model()->findAll(array('order'=>'rid DESC', 'condition'=>'(uid=:x or sid=:y) and mid=:z', 'params'=>array(':x'=>Yii::app()->user->id,':y'=>Yii::app()->user->id,':z'=>$mid)));
	
	if($next!=NULL)
	{
	return count($next);
	}
	else
	{
	return 0;
	}
	}
	
	
	public function getReplyid($mid)
	{
	
	$next = Reply::model()->findAll(array('order'=>'rid DESC', 'condition'=>'(uid=:x or sid=:y) and mid=:z', 'params'=>array(':x'=>Yii::app()->user->id,':y'=>Yii::app()->user->id,':z'=>$mid)));
	
	if($next!=NULL)
	{
	return $next[0]['rid'];
	}
	else
	{
	return $mid;
	}
	}
	
	
	// Sort for task- Rajith
	
	public function sorts($t,$status,$page)
	{
	
	   switch($t)
	   {
	   case 0:
			$subject='msg_id DESC';
			break;
	   case 1:
			$subject='subject';
			break;
	   case 2:
			$subject='subject DESC';
			break;
	   
	   }
	
		$i=0;
		$messageids=NULL;
		
		$connection = Yii::app()->db;
		$sql="SELECT t1.msg_id,t1.is_task FROM message AS t1 INNER JOIN message_user AS t2 ON t1.msg_id = t2.message_id WHERE t1.is_task IS NOT NULL AND t2.user_id =".Yii::app()->user->id." ORDER BY t1.".$subject;
		$command = $connection->createCommand($sql);
		$msgids = $command->queryAll();
	
		
				
			if($msgids!=NULL)
			{
			 foreach($msgids as $msgids1)
			 {
			 
					 //only for T
					 if($status=='T')
					 {
						 $messageids[$i]=$msgids1['msg_id'];
						 $i++;
					 
					 }
					 else
					 {
					 $task=TaskAssignToPatients::model()->findByAttributes(array('id'=>$msgids1['is_task'],'status'=>$status));
		             if($task != NULL )
		             {
						 $messageids[$i]=$msgids1['msg_id'];
						 $i++;
					 }
					 
					 }
					 
					 
			     
			  }
	 
			 }
					 
							
	     return $messageids;
	
	
	
	
	}
	public function sortsUsertask($t,$status,$user_id)
	{
	
	   switch($t)
	   {
	   case 0:
			$subject='msg_id DESC';
			break;
	   case 1:
			$subject='subject';
			break;
	   case 2:
			$subject='subject DESC';
			break;
	   
	   }
	
		$i=0;
		$messageids=NULL;
		
		$connection = Yii::app()->db;
		$sql="SELECT t1.msg_id,t1.is_task FROM message AS t1 INNER JOIN message_user AS t2 ON t1.msg_id = t2.message_id WHERE t1.is_task IS NOT NULL AND t2.user_id =".$user_id." ORDER BY t1.".$subject;
		$command = $connection->createCommand($sql);
		$msgids = $command->queryAll();
	
		
				
			if($msgids!=NULL)
			{
			 foreach($msgids as $msgids1)
			 {
			 
					 //only for T
					 if($status=='T')
					 {
						 $messageids[$i]=$msgids1['msg_id'];
						 $i++;
					 
					 }
					 else
					 {
					 $task=TaskAssignToPatients::model()->findByAttributes(array('id'=>$msgids1['is_task'],'status'=>$status));
		             if($task != NULL )
		             {
						 $messageids[$i]=$msgids1['msg_id'];
						 $i++;
					 }
					 
					 }
					 
					 
			     
			  }
	 
			 }
					 
							
	     return $messageids;
	
	
	
	
	}
	
	
	public function sortsAgencytask($t,$status)
	{
	
	   switch($t)
	   {
	   case 0:
			$subject='id DESC';
			break;
	   case 1:
			$subject='subject';
			break;
	   case 2:
			$subject='id DESC';
			break;
	   
	   }
	
		$i=0;
		$messageids=NULL;
	
		//$msgids=TaskAssignToPatients::model()->findAll(array('order'=>$subject, 'condition'=>'is_task!=:z', 'params'=>array(':z'=>'')));
		
		$msgids=TaskAssignToPatients::model()->findAll(array('order'=>$subject));
				
		return $msgids;
	
	}
	
	

}