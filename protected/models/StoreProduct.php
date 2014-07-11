<?php

/**
 * This is the model class for table "store_product".
 *
 * The followings are the available columns in table 'store_product':
 * @property integer $id
 * @property string $product_name
 * @property string $product_brand
 * @property integer $product_quantity
 * @property integer $c_id
 * @property integer $price
 * @property integer $status
 */
class StoreProduct extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StoreProduct the static model class
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
		return 'store_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, product_brand, product_quantity, c_id, price', 'required'),
			array('product_quantity, c_id, price, status', 'numerical', 'integerOnly'=>true),
			array('product_name, product_brand', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_name, product_brand, product_quantity, c_id, price, status', 'safe', 'on'=>'search'),
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
			'product_name' => 'Product Name',
			'product_brand' => 'Product Brand',
			'product_quantity' => 'Product Quantity',
			'c_id' => 'Category',
			'price' => 'Price',
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
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_brand',$this->product_brand,true);
		$criteria->compare('product_quantity',$this->product_quantity);
		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}