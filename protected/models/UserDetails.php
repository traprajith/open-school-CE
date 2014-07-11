<?php

/**
 * This is the model class for table "user_details".
 *
 * The followings are the available columns in table 'user_details':
 * @property integer $id
 * @property integer $user_id
 * @property integer $agency_employee_id
 * @property string $lastname
 * @property string $firstname
 * @property string $suffix
 * @property string $address1
 * @property string $address2
 * @property integer $zip_code
 * @property string $city
 * @property string $state
 * @property integer $phone1
 * @property integer $phone2
 * @property string $dob
 * @property integer $ssn
 * @property string $includepayroll
 * @property string $employee_type
 * @property string $weekend_access
 * @property string $earliest_login_time
 * @property string $automatic_lodout_time
 * @property string $hire_date
 * @property string $termination_date
 * @property string $File
 * @property string $attachment
 * @property string $photo
 */
class UserDetails extends MyActiveRecord {
    
    public function getDbConnection()
    {
        return self::getAdvertDbConnection();
    }
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserDetails the static model class
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
		return 'user_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,lastname, firstname, sign', 'required'),
			array('user_id, agency_employee_id, zip_code, phone1, phone2, ssn', 'numerical', 'integerOnly'=>true),
			array('lastname, suffix, firstname, suffix, address1, address2, city, state, includepayroll, sign, employee_type, weekend_access', 'length', 'max'=>120),
			array('File, attachment, photo, photo_thumb', 'length', 'max'=>256),
			array('dob, earliest_login_time, automatic_lodout_time, hire_date, termination_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, agency_employee_id, lastname, firstname, sign, suffix, address1, address2, zip_code, city, state, phone1, phone2, dob, ssn, includepayroll, employee_type, weekend_access, earliest_login_time, automatic_lodout_time, hire_date, termination_date, File, attachment, photo, photo_thumb', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'agency_employee_id' => 'Agency Employee',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'suffix' => 'Suffix',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'zip_code' => 'Zip Code',
			'city' => 'City',
			'state' => 'State',
			'phone1' => 'Phone1',
			'phone2' => 'Phone2',
			'dob' => 'Dob',
			'ssn' => 'Ssn',
			'includepayroll' => 'Includepayroll',
			'employee_type' => 'Employee Type',
			'weekend_access' => 'Weekend Access',
			'earliest_login_time' => 'Earliest Login Time',
			'automatic_lodout_time' => 'Automatic Lodout Time',
			'hire_date' => 'Hire Date',
			'termination_date' => 'Termination Date',
			'File' => 'File',
			'attachment' => 'Attachment',
			'photo' => 'Photo',
			'photo_thumb' => 'photo_thumb',
			'sign' => 'signature'
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('agency_employee_id',$this->agency_employee_id);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('suffix',$this->suffix,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('zip_code',$this->zip_code);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('phone1',$this->phone1);
		$criteria->compare('phone2',$this->phone2);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('ssn',$this->ssn);
		$criteria->compare('includepayroll',$this->includepayroll,true);
		$criteria->compare('employee_type',$this->employee_type,true);
		$criteria->compare('weekend_access',$this->weekend_access,true);
		$criteria->compare('earliest_login_time',$this->earliest_login_time,true);
		$criteria->compare('automatic_lodout_time',$this->automatic_lodout_time,true);
		$criteria->compare('hire_date',$this->hire_date,true);
		$criteria->compare('termination_date',$this->termination_date,true);
		$criteria->compare('File',$this->File,true);
		$criteria->compare('attachment',$this->attachment,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('photo_thumb',$this->photo_thumb,true);
		

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	public function getPhoto($id)
	{
         
		$connection = Yii::app()->dbadvert;
		$sql="SELECT photo FROM user_details WHERE user_id =".$id;
		$command = $connection->createCommand($sql);	
		$result=$command->queryAll();
		if(count($result) == 0)
		return '<img src="users/user.jpg" width="45" height="45" />';
		else
		return '<img src="users/'.$id.'/'.$result[0]['photo'].'.jpg" width="45" height="45" />';
		
	}
	
	public function getPhotothumb($id)
	{
         
		$connection = Yii::app()->dbadvert;
		$sql="SELECT photo FROM user_details WHERE user_id =".$id;
		$command = $connection->createCommand($sql);	
		$result=$command->queryAll();
		if(count($result) == 0)
		return '<img src="users/user.jpg" width="68" height="68" />';
		else
		return '<img src="users/'.$id.'/'.$result[0]['photo'].'.jpg" width="68" height="68" />';
		
	}
	public function getuserphoto($id)
	{
		$name=UserDetails::model()->findByAttributes(array('user_id'=>$id));
		if($name->photo != NULL)
		return  '<img src="users/'.$id.'/'.$name->photo.'.jpg" width="59" height="59" />';
		else
		return  '<img src="images/user.jpg" width="59" height="59" />';
	}
	
	
	
	 public function saveImage($id)
      {
     //import the class for image manipulation from the extension folder
     Yii::import('application.extensions.upload.Upload');
	$ss=array('name'=>$_FILES['UserDetails']['name']['photo'],'type'=>$_FILES['UserDetails']['type']['photo'],
	'tmp_name'=>$_FILES['UserDetails']['tmp_name']['photo'],'error'=>$_FILES['UserDetails']['error']['photo'],'size'=>$_FILES['UserDetails']['size']['photo']);

     //Receive file/image data from the post request
     $Upload = new Upload((isset($ss) ? $ss : null) );
     $Upload->jpeg_quality = 100;
     $Upload->no_script    = false;
     $Upload->image_resize = true;
     $Upload->image_x      = 300;
     $Upload->image_y      = 250;
     $Upload->image_ratio  = true;

     //some vars
     $rand = rand(1000,9000);
     $newName = $rand;
     $image_path = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/users/'.$id.'/';
     $image_thumb_path = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/users/3/thumbs/';
     $destPath = $_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/users/3/thumbs/';

     //Verify if was uloaded
     if($Upload->uploaded) {
         $Upload->file_new_name_body = $id;
         $Upload->process($image_path);

         //if was processed
                        if ($Upload->processed) {
                            $destName = $Upload->file_dst_name;    
                            $this->photo = $id;
                            $this->photo_thumb  = 'thumb_'.$id;
                            $this->save();
                        
                            // create the thumb  
                            unset($Upload);                       
                            $Upload = new Upload($image_path.$destName);
                            $Upload->file_new_name_body   = 'thumb_'.$id;
                            $Upload->no_script            = false;
                            $Upload->image_resize         = true;
                            $Upload->image_x              = 34;
                            $Upload->image_y              = 34;
                            $Upload->image_ratio          = true;
                            $Upload->process($image_path);
                              Patients::model()->sqThm($image_path.'thumb_'.$id.'.jpg',$image_path.'thumb_'.$id.'.jpg');      
                        } else {
                            echo($Upload->error);
                        }

     }  else {
         echo "Select an image to upload";
     }
	  }
}