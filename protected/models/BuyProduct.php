<?php

/**
 * This is the model class for table "buy_product".
 *
 * The followings are the available columns in table 'buy_product':
 * @property integer $id
 * @property integer $student_id
 * @property string $pr_name
 * @property string $pr_brand
 * @property integer $product_id
 * @property string $issued_date
 */
class BuyProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BuyProduct the static model class
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
		return 'buy_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, pr_name, pr_brand, product_id, issued_date', 'required'),
			array('student_id, product_id', 'numerical', 'integerOnly'=>true),
			array('pr_name, pr_brand', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, student_id, pr_name, pr_brand, product_id, issued_date', 'safe', 'on'=>'search'),
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
			'student_id' => 'Student',
			'pr_name' => 'Pr Name',
			'pr_brand' => 'Pr Brand',
			'product_id' => 'Product',
			'issued_date' => 'Issued Date',
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
		$criteria->compare('pr_name',$this->pr_name,true);
		$criteria->compare('pr_brand',$this->pr_brand,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('issued_date',$this->issued_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}