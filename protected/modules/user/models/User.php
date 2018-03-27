<?php

class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
	
	//TODO: Delete for next version (backward compatibility)
	const STATUS_BANED=-1;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
     * @var timestamp $create_at
     * @var timestamp $lastvisit_at
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return Yii::app()->getModule('user')->tableUsers;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.CConsoleApplication
		return ((get_class(Yii::app())=='CConsoleApplication' || (get_class(Yii::app())!='CConsoleApplication' && Yii::app()->getModule('user')->isAdmin()))?array(
			array('username', 'length', 'max'=>20, 'min' => 1,'message' => Yii::t('app',"Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 1,'message' => Yii::t('app',"Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
                        array('email','check'),
                        
			array('username', 'unique', 'message' => Yii::t('app',"This user's name already exists.")),
			//array('email', 'unique', 'message' => Yii::t('app',"This user's email address already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t('app',"Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
			array('superuser', 'in', 'range'=>array(0,1)),
                        array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
                        array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('username,password,email, superuser, status', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('mobile_number', 'safe'),
                        //array('mobile_number', 'numerical', 'integerOnly'=>true),
                                             
			array('id, salt, username, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
		):((Yii::app()->user->id==$this->id or Yii::app()->controller->id == 'androidApi')?array(
			array('username, email,password', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 1,'message' => Yii::t('app',"Incorrect username (length between 3 and 20 characters).")),
            array('email', 'email'),
			array('username', 'unique', 'message' => Yii::t('app',"This user's name already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t('app',"Incorrect symbols (A-z0-9).")),
			//array('email', 'unique', 'message' => Yii::t('app',"This user's email address already exists.")),
			//array('email', 'length', 'max'=>30),
			array('salt', 'length', 'max'=>255),
			array('email','check'),					                        
			
		):array()));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        $relations = Yii::app()->getModule('user')->relations;
        if (!isset($relations['profile']))
            $relations['profile'] = array(self::HAS_ONE, 'Profile', 'user_id');
        return $relations;
	}
        
        
        
	public function check($attribute,$params)
	{
		if($this->$attribute!=''){
			$student	= NULL;
			$employee	= NULL; 
			$guardians	= NULL;
			$user		= NULL;		    			
						
			$criteria				= new CDbCriteria();
			$criteria->condition	= 'id<>:id AND email=:email';
			$criteria->params		= array(':id'=>$this->id, ':email'=>$this->email);                    
			$user					= User::model()->findAll($criteria); 
			    
			$criteria				= new CDbCriteria();
			$criteria->condition	= 'uid<>:uid AND email=:email AND is_delete=:is_delete';
			$criteria->params		= array(':uid'=>$this->id, ':email'=>$this->email, ':is_delete'=>0);                    
			$guardians				= Guardians::model()->findAll($criteria); 
				
			$criteria				= new CDbCriteria();
			$criteria->condition	= 'uid<>:uid AND email=:email AND is_deleted=:is_deleted';
			$criteria->params		= array(':uid'=>  $this->id, ':email'=>$this->$attribute, ':is_deleted'=>0);                    
			$employee				= Employees::model()->findAll($criteria);		
			
			$criteria				= new CDbCriteria();
			$criteria->condition	= 'uid<>:uid AND email=:email AND is_deleted=:is_deleted';
			$criteria->params		= array(':uid'=>$this->id,':email'=>$this->$attribute, ':is_deleted'=>0);   			                   
			$student 				= StudentsUser::model()->findAll($criteria); //This model is for checking all Students(Both normal & online)
				
			if($student!=NULL or $employee!=NULL or $guardians!=NULL or $user != NULL){
				$this->addError($attribute,Yii::t("app","This email address already exists."));
			}
		}
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app',"Id"),
			'username'=>Yii::t('app',"username"),
			'password'=>Yii::t('app',"password"),
			'verifyPassword'=>Yii::t('app',"Retype Password"),
			'email'=>Yii::t('app',"E-mail"),
			'mobile_number'=>Yii::t('app',"Mobile Number"),
			'verifyCode'=>Yii::t('app',"Verification Code"),
			'activkey' => Yii::t('app',"activation key"),
			'createtime' => Yii::t('app',"Registration date"),
			'create_at' => Yii::t('app',"Registration date"),
			
			'lastvisit_at' => Yii::t('app',"Last visit"),
			'superuser' => Yii::t('app',"Superuser"),
			'status' => Yii::t('app',"Status"),
		);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANNED,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, create_at, lastvisit_at, superuser, status, salt',
            ),
        );
    }
	
	public function defaultScope()
    {
        return CMap::mergeArray(Yii::app()->getModule('user')->defaultScope,array(
            'alias'=>'user',
            'select' => 'user.id, user.username, user.password, user.email, user.create_at, user.lastvisit_at, user.superuser, user.status, user.mobile_number',
        ));
    }
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => Yii::t('app','Not active'),
				self::STATUS_ACTIVE => Yii::t('app','Active'),
				self::STATUS_BANNED => Yii::t('app','Banned'),
			),
			'AdminStatus' => array(
				'0' => Yii::t('app','No'),
				'1' => Yii::t('app','Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
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
		if(isset($this->username) && $this->username!=NULL){
			$criteria->join 			= 'LEFT JOIN profiles as t2 ON t2.user_id = user.id';  
			if((substr_count( $this->username,' '))==0)
			{ 	
				$criteria->condition='(t2.firstname LIKE :name or t2.lastname LIKE :name)';
				$criteria->params[':name'] = $this->username.'%';
			}
			else if((substr_count( $this->username,' '))>=1)
			{
				$name=explode(" ",$this->username);
				$criteria->condition='(t2.firstname LIKE :name or t2.lastname LIKE :name)';
				$criteria->params[':name'] = $name[0].'%';
				$criteria->condition=$criteria->condition.' and '.'(t2.firstname LIKE :name1 or t2.lastname LIKE :name1)';
				$criteria->params[':name1'] = $name[1].'%';			
			}
		}
		$criteria->compare('id',$this->id);
        $criteria->compare('password',$this->password);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('activkey',$this->activkey);
        $criteria->compare('create_at',$this->create_at);
        $criteria->compare('lastvisit_at',$this->lastvisit_at);
        $criteria->compare('superuser',$this->superuser);
        $criteria->compare('status',$this->status);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        	'pagination'=>array(
				'pageSize'=>Yii::app()->getModule('user')->user_page_size,
			),
        ));
    }

    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at=date('Y-m-d H:i:s',$value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at=date('Y-m-d H:i:s',$value);
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
	public function name($data,$row){
		$name = Profile::model()->findByAttributes(array('user_id'=>$data->id));
		return CHtml::link($name->firstname.' '.$name->lastname,array("admin/view","id"=>$data->id));
	}
	public function role($data,$row)
	{
		$roles=Rights::getAssignedRoles($data->id); // check for single role
		    if(count($roles)<1)
			{
				return 'No roles';
			}
		    else
			{
				foreach($roles as $role)
				{
				return $role->name;
			    }
	        }
		
		
	}
	public function getCreat_at()
	 {
	  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
	  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
	  date_default_timezone_set($timezone->timezone);
	  $date = date($settings->displaydate,strtotime($this->create_at)); 
	  $time = date($settings->timeformat,strtotime($this->create_at)); 
	  return $date.' '.$time;
	  //return date('d-m-Y H:i:s',strtotime($this->created_at));
	 }
	 public function getLast_at()
	 {
		 if($this->lastvisit_at=='0000-00-00 00:00:00')
		 {
			 return '-';
		 }
		 else
		 {
		  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
		  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
		  date_default_timezone_set($timezone->timezone);
		  $date = date($settings->displaydate,strtotime($this->lastvisit_at)); 
		  $time = date($settings->timeformat,strtotime($this->lastvisit_at)); 
		  return $date.' '.$time;
		  //return date('d-m-Y H:i:s',strtotime($this->created_at));
		 }
	 }
	
	public function lastvisit($data,$row){
		if($data->lastvisit_at=='0000-00-00 00:00:00')
		 {
			 return '-';
		 }
		 else
		 {
			  $settings=UserSettings::model()->findByAttributes(array('user_id'=>1));
			  $timezone = Timezone::model()->findByAttributes(array('id'=>$settings->timezone));  
			  date_default_timezone_set($timezone->timezone);
			  $date = date($settings->displaydate,strtotime($data->lastvisit_at)); 
			  $time = date($settings->timeformat,strtotime($data->lastvisit_at)); 
			  return $date.' '.$time;
			  //return date('d-m-Y H:i:s',strtotime($this->created_at));
		 }
       
    }
    
    public function getSalt()
    {
        $bytes = openssl_random_pseudo_bytes(16, $cstrong);
        $salt   = bin2hex($bytes);
        return $salt;

    }
}