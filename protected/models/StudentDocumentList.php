<?php

/**
 * This is the model class for table "student_document_list".
 *
 * The followings are the available columns in table 'student_document_list':
 * @property integer $id
 * @property integer $name
 * @property integer $is_required
 */
class StudentDocumentList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StudentDocumentList the static model class
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
		return 'student_document_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'unique'),
			//array('name, is_required', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, is_required, mandatory', 'safe', 'on'=>'search'),
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
			'name' => Yii::t("app",'Document Name'),
			'is_required' => Yii::t("app",'Show in Online Registration'),
			'mandatory' => Yii::t("app",'Mandatory'),
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
		$criteria->compare('name',$this->name);
		$criteria->compare('is_required',$this->is_required);
		$criteria->compare('mandatory',$this->mandatory);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getIs_require()
	{
		if($this->is_required=='1')
		{
			echo Yii::t("app","Yes");
		}
		else
		{
			echo Yii::t("app","No");
		}
	}
	public function getIs_mandatory()
	{
		if($this->mandatory=='0')
		{
			echo Yii::t('app',"No");				
		}
		elseif($this->mandatory=='1')
		{
			echo Yii::t('app',"Yes,cannot be skipped");
		}
		else
		{
			echo Yii::t('app',"Yes,can be skipped");
		}
	}
}