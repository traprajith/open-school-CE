
<?php

/**
 * This is the model class for table "batch_students".
 *
 * The followings are the available columns in table 'batch_students':
 * @property integer $id
 * @property integer $student_id
 * @property integer $batch_id
 * @property integer $academic_yr_id
 * @property integer $status
 */
class BatchStudents extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BatchStudents the static model class
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
		return 'batch_students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('academic_yr_id, status', 'required'),
			array('student_id, batch_id, academic_yr_id, status, result_status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, batch_id, academic_yr_id, status, result_status,roll_no', 'safe', 'on'=>'search'),
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
			'id' => Yii::t("app",'ID'),
			'student_id' => Yii::t("app",'Student'),
			'batch_id' => Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),
			'academic_yr_id' => Yii::t("app",'Academic Yr'),
			'status' => Yii::t("app",'Status'),
			'result_status' => Yii::t("app",'Result Status'),
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
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('academic_yr_id',$this->academic_yr_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('result_status',$this->result_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function BatchStudent($batch_id)
        {
            $criteria               = new CDbCriteria;           
            $criteria->join         = "JOIN `batch_students` `bs` ON `bs`.`student_id`=`t`.`id`";           
            $criteria->condition    = "`t`.`is_active`=1 AND `t`.`is_deleted`=0 AND `bs`.`batch_id`=:batch_id AND `bs`.`status`=1 AND `bs`.`result_status`=0";
            $criteria->params       = array(":batch_id"=>$batch_id);
            $criteria->order        = "`t`.`first_name` ASC, `t`.`last_name` ASC";
            $students               = Students::model()->findAll($criteria);
            
            return $students;
        }
		public function StudentBatch($student_id)
        {
            $criteria				= new CDbCriteria();
			$criteria->join			= 'LEFT JOIN batch_students t1 ON t.id = t1.batch_id';
			$criteria->condition	= 't.is_active=:is_active AND t.is_deleted=:is_deleted AND t1.student_id=:student_id AND t1.result_status=:result_status';
			$criteria->params		= array(':is_active'=>1, ':is_deleted'=>0, ':student_id'=>$student_id, ':result_status'=>0);
			$criteria->group		= 't1.batch_id';
			$batches				= Batches::model()->findAll($criteria);
            
            return $batches;
        }
	
	
}