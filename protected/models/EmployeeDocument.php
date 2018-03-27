<?php

/**
 * This is the model class for table "student_document".
 *
 * The followings are the available columns in table 'student_document':
 * @property integer $id
 * @property integer $student_id
 * @property string $title
 * @property string $file
 * @property string $file_type
 * @property string $created_at
 */
class EmployeeDocument extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return StudentDocument the static model class
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
		return 'employee_document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, is_approved, uploaded_by', 'numerical', 'integerOnly'=>true),
			array('title, file_type', 'length', 'max'=>120),
			//array('file', 'length', 'max'=>200),
			array('file', 'file', 'types'=>'jpg, jpeg, png, gif, pdf, mp4, doc, txt, ppt, docx', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, employee_id, title, file, file_type, is_approved, uploaded_by, created_at', 'safe', 'on'=>'search'),
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
			'employee_id' => Yii::t("app",'Teacher'),
			'title' => Yii::t("app",'Title'),
			'file' => Yii::t("app",'File'),
			'file_type' => Yii::t("app",'File Type'),
			'is_approved' => Yii::t("app",'Status'),
			'uploaded_by' => Yii::t("app",'Uploaded By'),
			'created_at' => Yii::t("app",'Created At'),
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
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('file_type',$this->file_type,true);
		$criteria->compare('is_approved',$this->is_approved,true);
		$criteria->compare('uploaded_by',$this->uploaded_by,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}