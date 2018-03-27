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
class StudentDocument extends CActiveRecord
{
	private $_model;
	private $_modelReg;
	private $_rules = array();
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
		return 'student_document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		if (!$this->_rules) {
			$required = array();
			$numerical = array();				
			$decimal = array();
			$rules = array();
			
			$model=$this->getFields();
			
			foreach ($model as $field) {
				$field_rule = array();
				if ($field->required == FormFields::REQUIRED_YES)
					array_push($required,$field->varname);				
				if ($field->field_type == 'DECIMAL')
					array_push($decimal,$field->varname);
				if ($field->field_type == 'INTEGER')
					array_push($numerical,$field->varname);
				if ($field->field_type == 'VARCHAR'||$field->field_type=='TEXT') {
					$field_rule = array($field->varname, 'length', 'max'=>$field->field_size, 'min' => $field->field_size_min);
					if ($field->error_message) $field_rule['message'] = Yii::t('app',$field->error_message);
					array_push($rules,$field_rule);
				}								
			}			
			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));			
			array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));		
			array_push($rules,array('file', 'file', 'types'=>'jpg, jpeg, png, gif, pdf, mp4, doc, txt, ppt, docx', 'allowEmpty'=>true));			
			
			$this->_rules = $rules;
		}
		return $this->_rules;  	
		
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
		$labels = array(			
			'id' => Yii::t("app",'ID'),			
		);
		$model=$this->getFields();
		
		foreach ($model as $field){
			$labels[$field->varname] = Yii::t('app',$field->title);
		}			
		return $labels;			
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
		$criteria->compare('doc_type',$this->doc_type);
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
	
//Get the fiedls from form_fields	
	public function getFields() {
		if(Yii::app()->controller->module->id == 'students'){
			$this->_modelReg=ProfileField::model()->forAdminRegistration()->findAll();
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$this->_model=ProfileField::model()->forOnlineRegistration()->findAll();
		}
			
	}	
}