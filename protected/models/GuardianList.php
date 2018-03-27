<?php

/**
 * This is the model class for table "guardian_list".
 *
 * The followings are the available columns in table 'guardian_list':
 * @property integer $id
 * @property integer $guardian_id
 * @property integer $student_id
 */
class GuardianList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GuardianList the static model class
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
		return 'guardian_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('guardian_id, student_id', 'required'),
			array('guardian_id, student_id', 'numerical', 'integerOnly'=>true),
                        array('relation','length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, guardian_id, relation, student_id', 'safe', 'on'=>'search'),
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
			'guardian_id' => Yii::t("app",'Guardian'),
			'student_id' => Yii::t("app",'Student'),
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
		$criteria->compare('guardian_id',$this->guardian_id);
		$criteria->compare('student_id',$this->student_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        function parentname($data,$row)
	{
		$id= $data->guardian_id;
                $model= Guardians::model()->findByPk($id);
                if($model)
                {
                    return ucfirst($model->first_name)." ".  ucfirst($model->last_name);
                }
	}
        function parentemail($data,$row)
	{
		$id= $data->guardian_id;
                $model= Guardians::model()->findByPk($id);
                if($model)
                {
                    return ($model->email);
                }
	}
        
        public function checkRelation($student_id,$guardian_id)
        {            
            $model= GuardianList::model()->findByAttributes(array('student_id'=>$student_id,'guardian_id'=>$guardian_id));
                                                   
            if($model!=NULL)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
}