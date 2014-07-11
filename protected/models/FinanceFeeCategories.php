<?php

/**
 * This is the model class for table "finance_fee_categories".
 *
 * The followings are the available columns in table 'finance_fee_categories':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $batch_id
 * @property integer $is_deleted
 * @property integer $is_master
 * @property string $created_at
 * @property string $updated_at
 */
class FinanceFeeCategories extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FinanceFeeCategories the static model class
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
		return 'finance_fee_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_id, is_deleted, is_master', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			array('name','required'),
			array('description, created_at, updated_at', 'safe'),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, batch_id, is_deleted, is_master, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'description' => 'Description',
			'batch_id' => 'Batch',
			'is_deleted' => 'Is Deleted',
			'is_master' => 'Is Master',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('batch_id',$this->batch_id);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('is_master',$this->is_master);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}