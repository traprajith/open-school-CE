<?php

/**
 * This is the model class for table "elective_groups".
 *
 * The followings are the available columns in table 'elective_groups':
 * @property integer $id
 * @property string $name
 * @property integer $batch_id
 * @property integer $is_deleted
 * @property string $created_at
 * @property string $updated_at
 */
class ElectiveGroups extends CActiveRecord
{
	public $max_weekly_classes;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ElectiveGroups the static model class
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
		return 'elective_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		if(Yii::app()->controller->id != 'academicYears'){
			return array(
				array('batch_id, name, code, max_weekly_classes', 'required'),
				array('batch_id, is_deleted, max_weekly_classes', 'numerical', 'integerOnly'=>true),
				array('name , code', 'length', 'max'=>255),			
				array('created_at, updated_at', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, name, batch_id, is_deleted, created_at, updated_at', 'safe', 'on'=>'search'),
			);
		}
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
			'name' => Yii::t("app",'Name'),
			'code' => Yii::t("app",'Code'),
			Yii::app()->getModule('students')->fieldLabel("Students", "batch_id"),
			'is_deleted' => Yii::t("app",'Is Deleted'),
			'created_at' => Yii::t("app",'Created At'),
			'updated_at' => Yii::t("app",'Updated At'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}