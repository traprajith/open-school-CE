<?php

/**
 * This is the model class for table "subjects".
 *
 * The followings are the available columns in table 'subjects':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $batch_id
 * @property integer $no_exams
 * @property integer $max_weekly_classes
 * @property integer $elective_group_id
 * @property integer $is_deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Subjects extends CActiveRecord
{
	public $job;
	public $subject_tilte1;
	public $subject_tilte2;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Subjects the static model class
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
		return 'subjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('batch_id, no_exams, max_weekly_classes, elective_group_id, is_deleted, cbsc_common', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>70),
			array('batch_id, name, max_weekly_classes', 'required'),
			array('subject_tilte1','checkSubject1'),
			array('subject_tilte2','checkSubject2'),
			//array('name','unique','message' => "This subject name already exists."),
			//array('name','codes','message' => "This  Event Type already exists."),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, batch_id, no_exams, max_weekly_classes, elective_group_id, is_deleted, created_at, updated_at, admin_id, is_edit,split_subject,subject_tilte1,subject_tilte2, cbsc_common', 'safe', 'on'=>'search'),
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
		 'batch123'=>array(self::BELONGS_TO, 'Batches', 'batch_id'),        
		);

	}
	
	#Checking unique subject name in a batch
	public function codes($attribute,$params)
	{
		
	    $flag=0;
		$subject=Subjects::model()->findAllByAttributes(array('batch_id'=>$this->batch_id,'is_deleted'=>0));
		foreach($subject as $subject_1)
		{
			if($subject_1->name == $this->name)
			{
			$flag=1;
			}
		} 
		if($flag==1)
		{
		$this->addError($attribute, Yii::t("app",'This subject is already added'));
		}
	}	
	 
	 /**
	 * @return array customized attribute labels (name=>label)
	 */
	 
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t("app",'ID'),
			'name' => Yii::t("app",'Name'),
			'code' => Yii::t("app",'Code'),
			'batch_id' => Yii::app()->getModule('students')->batchLabel("Students", "batch_id"),
			'no_exams' => Yii::t("app",'No Exams'),
			'max_weekly_classes' => Yii::t("app",'Max Weekly Classes'),
			'elective_group_id' => Yii::t("app",'Elective Group'),
			'is_deleted' => Yii::t("app",'Is Deleted'),
			'created_at' => Yii::t("app",'Created At'),
			'updated_at' => Yii::t("app",'Updated At'),
			'subject_tilte1' => Yii::t('app','First Sub Category '),
			'subject_tilte2' => Yii::t('app','Second Sub Category '),
			'Sub_category1' => Yii::t('app','First Sub Category '),
			'Sub_category2' => Yii::t('app','Second Sub Category '),
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
		$batch_id = $this->batch_id;
		
		 if($batch_id!=""){
			  $criteria->condition='cbsc_common =:cbsc_common';
			  $criteria->params=array(':cbsc_common'=>0);       
			 
		 }

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('no_exams',$this->no_exams);
		$criteria->compare('max_weekly_classes',$this->max_weekly_classes);
		$criteria->compare('elective_group_id',$this->elective_group_id);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getbatchname()
	{
		$batches=Batches::model()->findByAttributes(array('id'=>$this->batch_id,'is_deleted'=>0));
			return $this->name.'('.$batches->name.')';
	}
	public function checkSubject1($attribute,$params)
	{
		if($this->split_subject!="" and $this->split_subject!=0){ 
			if($this->subject_tilte1=='')
				$this->addError($attribute,$this->getAttributeLabel($attribute).' '.Yii::t("app",'cannot be blank.'));
		}
	}
	public function checkSubject2($attribute,$params)
	{
		if($this->split_subject!="" and $this->split_subject!=0){ 
			if($this->subject_tilte2=='')
				$this->addError($attribute,$this->getAttributeLabel($attribute).' '.Yii::t("app",'cannot be blank.'));
		}
	}
	public function getName($data,$row){
		echo $data->name;
	}
	public function getSub_category1($data,$row){		
		$subject_spits	=	SubjectSplit::model()->findByAttributes(array('subject_id'=>$data->id));
		if($subject_spits->split_name !=NULL or $subject_spits->split_name!='')
			echo $subject_spits->split_name; 
		else
			echo "-";
	}
	public function getSub_category2($data,$row){		
		$criteria=new CDbCriteria;
		$criteria->condition = "subject_id = :subject_id";
		$criteria->params = array(":subject_id"=>$data->id); 
		//$criteria->order = 'id DESC';
		$models = SubjectSplit::model()->findAll($criteria); 
		foreach($models as $model){			
		}
		if($model->split_name !=NULL or $model->split_name!='')
		echo $model->split_name;
		else
			echo "-";
	}   
	
}