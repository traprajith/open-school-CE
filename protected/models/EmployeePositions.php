<?php

/**
 * This is the model class for table "employee_positions".
 *
 * The followings are the available columns in table 'employee_positions':
 * @property integer $id
 * @property string $name
 * @property integer $employee_category_id
 * @property integer $status
 */
class EmployeePositions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return EmployeePositions the static model class
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
		return 'employee_positions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_category_id, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>25),
			array('name, employee_category_id', 'required'),
			array('name','CRegularExpressionValidator', 'pattern'=>'/^[A-Za-z_ ]+$/','message'=>"{attribute} should contain only letters."),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, employee_category_id, status', 'safe', 'on'=>'search'),
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
			'employee_category_id' => 'Employee Category',
			'status' => 'Status',
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
		$criteria->compare('employee_category_id',$this->employee_category_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function categoryname($data,$row)
    {
		$category = EmployeeCategories::model()->findByAttributes(array('id'=>$data->employee_category_id));
		return $category->name;
		
	}
}