<?php

/**
 * This is the model class for table "student_previous_datas".
 *
 * The followings are the available columns in table 'student_previous_datas':
 * @property integer $id
 * @property integer $student_id
 * @property string $institution
 * @property string $year
 * @property string $course
 * @property string $total_mark
 */
class StudentPreviousDatas extends CActiveRecord
{
	private $_model;
	private $_modelReg;
	private $_rules = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @return StudentPreviousDatas the static model class
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
		return 'student_previous_datas';
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
			$safe	= array();
			$rules = array();
			
			$model=$this->getFields();
			
			foreach ($model as $field) {
				$field_rule 	= array();
				$rule_added		= false;
				if ($field->required==FormFields::REQUIRED_YES){
					if ($field->form_field_type==5){
						array_push($rules,array($field->varname, 'compare', 'compareValue'=>true, 'message'=>Yii::t('app', '{attribute} cannot be blank')));
					}
					array_push($required,$field->varname);
					$rule_added		= true;
				}
				if ($field->field_type=='DECIMAL'){
					array_push($decimal,$field->varname);
					$rule_added		= true;
				}
				if ($field->field_type=='INTEGER'){
					array_push($numerical,$field->varname);
					$rule_added		= true;
				}
				
				if($rule_added==false){
					array_push($safe,$field->varname);
				}
			}
			array_push($required, 'student_id');	//student id
			array_push($rules,array(implode(',',$required), 'required'));
			array_push($rules,array(implode(',',$numerical), 'numerical', 'integerOnly'=>true));			
			array_push($rules,array(implode(',',$decimal), 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/'));			
			array_push($rules,array(implode(',',$safe), 'safe'));
			
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
		$criteria->compare('institution',$this->institution,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('course',$this->course,true);
		$criteria->compare('total_mark',$this->total_mark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getYears()
	{
		for ($i=date('Y');$i>=date('Y')-100;$i--)
		{
				$years["{$i}"]="{$i}";
		}
		return $years;                   
	}
	
//Get the fiedls from form_fields	
	public function getFields() {
		$scope 		= NULL;
		if(Yii::app()->controller->module->id == 'students'){
			$scope 	= "forAdminRegistration";
		}
		if(Yii::app()->controller->module->id == 'onlineadmission'){
			$scope 	= "forOnlineRegistration";
		}
		
		$criteria	= new CDbCriteria;
		$criteria->condition	= "`tab_selection`=:tab_selection AND `model`=:model";
		$criteria->params		= array(':tab_selection'=>4, 'model'=>"StudentPreviousDatas");
		if($scope!=NULL){
			$this->_modelReg	= FormFields::model()->$scope()->findAll($criteria);
		}
		else{
			$this->_modelReg	= FormFields::model()->findAll($criteria);
		}

		return $this->_modelReg;			
	}		
	
}