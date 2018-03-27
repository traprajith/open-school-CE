<?php

/**
 * This is the model class for table "document_uploads".
 *
 * The followings are the available columns in table 'document_uploads':
 * @property integer $id
 * @property integer $model_id
 * @property integer $file_id
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $reason
 */
class DocumentUploads extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DocumentUploads the static model class
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
		return 'document_uploads';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('model_id, file_id, status, created_by, created_at', 'required'),
			array('reason','required', 'on'=>'for_reason_required'),
			array('model_id, file_id, status, created_by', 'numerical', 'integerOnly'=>true),			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_id, file_id, status, created_by, created_at, reason', 'safe', 'on'=>'search'),
		);
	}

	public function setIdentifier()
	{
		$list = array(
			1 => Yii::t('app','Student Achievement Document'),
			2 => Yii::t('app','Employee Achievement Document'),
			3 => Yii::t('app','Employee Document'),
			4 => Yii::t('app','Employee Profile Image'),
			5 => Yii::t('app','Student Document'),
			6 => Yii::t('app','Student Profile Image'),
			7 => Yii::t('app','File Upload'),
			8 => Yii::t('app','School Logo'),
			9 => Yii::t('app','Fav Icon')                
		);
		return $list;
	}
	
	public function getIdentifierData($identifier)
	{
		$list = array(
			1 => Yii::t('app','Achievement Document'),
			2 => Yii::t('app','Achievement Document'),
			3 => Yii::t('app','Document'),
			4 => Yii::t('app','Profile Image'),
			5 => Yii::t('app','Document'),
			6 => Yii::t('app','Profile Image'),
			7 => Yii::t('app','File Upload'),
			8 => Yii::t('app','School Logo'),
			9 => Yii::t('app','Fav Icon')                
		);
		return $list[$identifier];
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
			'id' => Yii::t('app','ID'),
			'model_id' => Yii::t('app','Model'),
			'file_id' => Yii::t('app','File'),
			'status' => Yii::t('app','Status'),
			'created_by' => Yii::t('app','Created By'),
			'created_at' => Yii::t('app','Created At'),
			'reason' => Yii::t('app','Reason'),
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
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('reason',$this->reason,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
//Generate salt        
	public function generateSalt()
	{
		$charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$randStringLen = 32;
		$randString = "";
		for ($i = 0; $i < $randStringLen; $i++) {
			$randString .= $charset[mt_rand(0, strlen($charset) - 1)];
		}
		return $randString;                        
	}
//Get the new file name	
	public function getFileName($file_name)
	{           
		$new_file_name = '';
		if($file_name!=NULL){
			$value = explode('.',$file_name);
			$extension = end($value); // Get extension of the file
			$salt = DocumentUploads::model()->generateSalt(); //Get Salt
			$new_file_name = $salt.'.'.$extension;			
		}
		return $new_file_name;
	}
	
//Insert date to this model
	public function insertData($model_id, $file_id, $new_file_name, $identifier, $old_file_name = NULL, $user_id = NULL, $request_type = NULL,$status = 0) 
	{
		if($user_id!=NULL){
			$roles	= Rights::getAssignedRoles($user_id);
		}
		else{
			$roles	= Rights::getAssignedRoles(Yii::app()->user->Id);
		}
		
		$is_model = '';
		if($old_file_name!=NULL){
			$is_model = DocumentUploads::model()->findByAttributes(array('model_id'=>$model_id, 'file_id'=>$file_id, 'file_name'=>$old_file_name));
		}
		if($is_model!=NULL){
			$is_model->file_name 	= $new_file_name;
			if(key($roles)!=NULL and (key($roles) == 'Admin')){
				$is_model->status		= 1;
			}
			else{
				$is_model->status		= $status;
			}
			$is_model->save();
		}
		else{			
			if($model_id!=NULL and $file_id!=NULL){
				$model	= new DocumentUploads;
				$model->model_id	= $model_id;
				$model->file_id		= $file_id;
				$model->file_name	= $new_file_name;
				$model->identifier	= $identifier;
				if(key($roles)!=NULL and (key($roles) == 'Admin')){		
					$model->status		= 1;		
				}
				else{
					$model->status		= $status;
				}
				if($request_type==1){					
					$created_by = $user_id;
				}
				else{  					
					$created_by = Yii::app()->user->id;
				}
				$model->created_by	= $created_by;
				$model->created_at	= date('Y-m-d');  
				$model->save();
			}
		}
	}
	
//Get Role	
	
//for get model name 
	public function getModel($id)
	{
		$model = DocumentModels::model()->findByPk($id);
		if($model!=NULL){
			return $model->model;
		}
		else{
			return "-";
		}
	}
	
	public function getStatus($id)
	{
		if($id==0){
			return Yii::t('app','Pending');
		}
		else if($id==1){
			return Yii::t('app','Approved');
		}
		else if($id==2){
			return Yii::t('app','Disapproved');
		}
	}
	
	public function displayName($uid)
	{
		$profile = Profile::model()->findByAttributes(array('user_id'=>$uid));
		if($profile){
			echo ucfirst($profile->firstname).' '.ucfirst($profile->lastname);
		}
		else{
			echo '-';
		}		
	}	
	
//Get the saved file path
	public function getFilePath($identifier, $file_id, $file_name)
	{
		$path = '';
		if($identifier!=NULL){
			//Student Achievement Documents Path
			if($identifier == 1){
				$model = Achievements::model()->findByPk($file_id);
				$path = 'uploadedfiles/achievement_document/'.$model->user_id.'/'.$file_name;
			}
			
			//Employee Achievement Documents Path
			if($identifier == 2){
				$model = Achievements::model()->findByPk($file_id);
				$path = 'uploadedfiles/employee_achievement_document/'.$model->user_id.'/'.$file_name;
			}
			
			//Employee Documents Path
			if($identifier == 3){
				$model = EmployeeDocument::model()->findByPk($file_id);
				$path = 'uploadedfiles/employee_document/'.$model->employee_id.'/'.$file_name;
			}
			
			//Employee Profile Image Path
			if($identifier == 4){				
				$path = 'uploadedfiles/employee_profile_image/'.$file_id.'/'.$file_name;
			}
			
			//Student Documents Path
			if($identifier == 5){
				$model = StudentDocument::model()->findByPk($file_id);
				$path = 'uploadedfiles/student_document/'.$model->student_id.'/'.$file_name;
			}
			
			//Student Profile Image Path
			if($identifier == 6){
				$path = 'uploadedfiles/student_profile_image/'.$file_id.'/'.$file_name;
			}
			
			//Shared Documents Path
			if($identifier == 7){
				$path = 'uploads/shared/'.$file_id.'/'.$file_name;
			}
			
			//School Logo Path
			if($identifier == 8){
				$path = 'uploadedfiles/school_logo/'.$file_name;
			}
			
			//Fav Icon Path
			if($identifier == 9){
				$path = 'uploadedfiles/school_favicon/'.$file_name;
			}
			
		}
		return $path;
	}
        
        
	//for checking file approved/rejected
	public function fileStatus($model_id, $file_id, $filename)
	{           
		$model= DocumentUploads::model()->findByAttributes(array('model_id'=>$model_id, 'file_id'=>$file_id, 'file_name'=>$filename,'status'=>1));           
		if($model!=NULL){                
			return true;
		}
		else{
			return false;
		}
	}
	
//Check the file is image
	public function checkIsImage($identifier, $file_id, $file_name)
	{
		$path = DocumentUploads::model()->getFilePath($identifier, $file_id, $file_name);	
		$type = mime_content_type($path);				
		if($type == 'image/jpeg' or $type == 'image/jpg' or $type == 'image/png' or $type == 'image/gif'){
			return true;
		}
		else{
			return false;
		}
	}
	
//Get Identifier
	public function getIdentifier($identifier)
	{
		$data = '';
		if($identifier!=NULL){
			//Student Achievement Documents Path
			if($identifier == 1){
				$data = Yii::t('app','Student Achievement Document');
			}
			
			//Employee Achievement Documents Path
			if($identifier == 2){
				$data = Yii::t('app','Employee Achievement Document');
			}
			
			//Employee Documents Path
			if($identifier == 3){
				$data = Yii::t('app','Employee Documents');
			}
			
			//Employee Profile Image Path
			if($identifier == 4){
				$data = Yii::t('app','Employee Profile Image');
			}
			
			//Student Documents Path
			if($identifier == 5){
				$data = Yii::t('app','Student Document');
			}
			
			//Student Profile Image Path
			if($identifier == 6){
				$data = Yii::t('app','Student Profile Image');
			}
			
			//Shared Documents Path
			if($identifier == 7){
				$data = Yii::t('app','File Upload');
			}	
			
			//For School Logo
			if($identifier == 8){
				$data = Yii::t('app','School Logo');
			}	
			//For Fav icon
			if($identifier == 9){
				$data = Yii::t('app','Fav Icon');
			}			
		}
		return $data;
	}
        
        
	public function deleteDocument($model_id, $file_id, $filename)
	{
		$model= DocumentUploads::model()->findByAttributes(array('model_id'=>$model_id, 'file_id'=>$file_id, 'file_name'=>$filename));           
		if($model!=NULL){         
			$model->delete();
			return true;
		}
	}
        
}