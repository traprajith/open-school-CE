<?php

/**
 * This is the model class for table "fee_paypal_config".
 *
 * The followings are the available columns in table 'fee_paypal_config':
 * @property integer $id
 * @property string $apiusername
 * @property string $apipassword
 * @property string $apisignature
 * @property string $apicurrency
 * @property integer $created_by
 */
class PaypalConfig extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PaypalConfig the static model class
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
		return 'fee_paypal_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('apiusername, apipassword, apisignature, apicurrency, created_by', 'required'),
			array('created_by', 'numerical', 'integerOnly'=>true),
			array('apicurrency', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, apiusername, apipassword, apisignature, apicurrency, created_by', 'safe', 'on'=>'search'),
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
			'apiusername' => Yii::t('app', 'API Username'),
			'apipassword' => Yii::t('app', 'API Password'),
			'apisignature' => Yii::t('app', 'API Signature'),
			'apicurrency' => Yii::t('app', 'Currency'),
			'created_by' => Yii::t('app', 'Created By'),
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
		$criteria->compare('apiusername',$this->apiusername,true);
		$criteria->compare('apipassword',$this->apipassword,true);
		$criteria->compare('apisignature',$this->apisignature,true);
		$criteria->compare('apicurrency',$this->apicurrency,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}