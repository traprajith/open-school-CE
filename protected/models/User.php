<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $salt
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'blog_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, password, salt', 'length', 'max'=>100),
			array('username', 'unique', 'className'=>'User'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, salt', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'salt' => 'Salt',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	 public function getFullName() {
				return $this->username;
			}
		
			public function getSuggest($q) {
				$c = new CDbCriteria();
				$c->addSearchCondition('username', $q, true, 'OR');
				$c->addSearchCondition('email', $q, true, 'OR');
				return $this->findAll($c);
			}
			public function validatePassword($password)
	{
		return $this->hashPassword($password,$this->salt)===$this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}
	public function generateSalt()
	{
		return uniqid('',true);
	}
	public function getUsername($id)
	{
		$res = User::model()->findByAttributes(array('id'=>$id));
		return ucfirst($res['username']).' '.ucfirst($res['username']);
	}
	
	public function getConcatened()
    {
        return ucfirst($this->firstname).' '.ucfirst($this->lastname);
    }
	
	public function getdateofbirth($date)
	{
		
		if($date==NULL)
		{
			return 0;
		}
		else
		{
	 list($year,$month,$day) = explode("-",$date);
	 $year_diff  = date("Y") - $year;
	 $month_diff = date("m") - $month;
	 $day_diff   = date("d") - $day;
	 if ($day_diff < 0 || $month_diff < 0)
     $year_diff--;
   return $year_diff;
		}
		
	}
	/*public function getFullname()
    {
		$name=User::model()->findByAttributes(array('id'=>$this->id));
		return $name->firstname.' '.$name->lastname;
    }*/
	
	
	
	public function getphoto()
	{
		$name=UserDetails::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
		if($name != NULL)
		return  '<img src="users/'.Yii::app()->user->id.'/'.$name->photo.'.jpg" width="182" height="169" />';
		else
		return  '<img src="images/user.jpg" width="182" height="169" />';
	}
	public function getuserphoto($id)
	{
		$name=UserDetails::model()->findByAttributes(array('user_id'=>$id));
		if($name->photo != NULL)
		return  '<img src="users/'.$id.'/'.$name->photo.'.jpg" width="182" height="169" />';
		else
		return  '<img src="images/user.jpg" width="182" height="169" />';
	}
	
	public function completedtask($id)
	{
		$connection = Yii::app()->dbadvert;
		$sql="SELECT * FROM task_assign_to_patients WHERE assigned_user_id=".$id." AND status='S'";
		$command = $connection->createCommand($sql);
		$result=$command->queryAll();
		return $result;
		
	}
	public function incompletedtask($id)
	{
		$connection = Yii::app()->dbadvert;
		$sql="SELECT * FROM task_assign_to_patients WHERE assigned_user_id=".$id." AND status='C'";
		$command = $connection->createCommand($sql);
		$result=$command->queryAll();
		return $result;
		
	}
	public function assignedtask($id)
	{
		$connection = Yii::app()->dbadvert;
		$sql="SELECT * FROM task_assign_to_patients WHERE assigned_user_id=".$id." AND status IS NULL ";
		$command = $connection->createCommand($sql);
		$result=$command->queryAll();
		return $result;
		
	}
	public function getUserelepass($id)
	{
		$pass=UserDetails::model()->findByAttributes(array('user_id'=>$id));
		return $pass->sign;
		
	}
}