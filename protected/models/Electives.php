<?php

/**
 * This is the model class for table "electives".
 *
 * The followings are the available columns in table 'electives':
 * @property integer $id
 * @property integer $elective_group_id
 * @property string $name
 * @property string $code
 * @property integer $is_deleted
 * @property string $created_at
 * @property string $updated_at
 */
class Electives extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Electives the static model class
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
		return 'electives';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elective_group_id, batch_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('elective_group_id, name', 'required'),
			array('name, code', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			array('name','nameCheck'),
			//array('code','unique', 'on' => 'insert,update', 'message' => '{attribute}:{value} already exists!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, elective_group_id, name, batch_id, code, is_deleted, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'elective_group_id' => Yii::t("app",'Elective Group'),
			'name' => Yii::t("app",'Name'),
			'code' => Yii::t("app",'Code'),
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
		$criteria->compare('elective_group_id',$this->elective_group_id);
		$criteria->compare('batch_id ',$this->batch_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function groupname($data,$row)
    {
		//print_r($data);
		$group = ElectiveGroups::model()->findByAttributes(array('id'=>$data->elective_group_id));
		return $group->name;
		
	}
	public function nameCheck($attribute,$params)
	{
		$elective	=	Electives::findByAttributes(array('name'=>$this->name));
		if($this->elective_group_id == $elective->elective_group_id and $this->batch_id == $elective->batch_id){
			$this->addError($attribute,$this->getAttributeLabel($attribute).' "'.$this->name.'" '.Yii::t("app",'has already been taken in this batch.'));
		}
	}
}