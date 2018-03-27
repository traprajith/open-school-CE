<?php

/**
 * This is the model class for table "user_roles".
 *
 * The followings are the available columns in table 'user_roles':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $status
 */
class UserRoles extends CActiveRecord
{
	public $modules;
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserRoles the static model class
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
		return 'user_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name , modules', 'required'),
			array('name', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => Yii::t("app","Name contains Incorrect symbols (Use A-z,0-9).")),
			array('name', 'nameIsAvailable'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>120),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, status', 'safe', 'on'=>'search'),
		);
	}
	public function nameIsAvailable($attribute, $params)
	{
		// Make sure that an authorization item with the name does not already exist
		if( Rights::getAuthorizer()->authManager->getAuthItem($this->name)!==null )
			$this->addError('name', Yii::t("app", 'Role name already exists.'), array(':name'=>$this->name));
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
			'description' => Yii::t("app",'Description'),
			'status' => Yii::t("app",'Status'),
                        'modules'=>Yii::t('app','Modules'),
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
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}